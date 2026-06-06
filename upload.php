<?php
require_once 'includes/auth.php';
requireLogin();
require_once 'config/database.php';

if (!isMahasiswa()) {
    header('Location: dashboard.php?error=Halaman upload hanya untuk mahasiswa');
    exit;
}

$pageTitle = 'Upload Tugas';
$user = currentUser();
$success = '';
$error = '';
$selectedTaskId = (int) ($_GET['task_id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = (int) ($_POST['task_id'] ?? 0);
    $selectedTaskId = $taskId;

    if ($taskId <= 0 || !isset($_FILES['file_tugas'])) {
        $error = 'Pilih tugas dan file yang akan diupload.';
    } elseif ($_FILES['file_tugas']['error'] !== UPLOAD_ERR_OK) {
        $error = 'File gagal diupload. Silakan coba lagi.';
    } elseif ($_FILES['file_tugas']['size'] > 10 * 1024 * 1024) {
        $error = 'Ukuran file maksimal 10MB.';
    } else {
        $allowedExtensions = ['pdf', 'doc', 'docx'];
        $originalName = $_FILES['file_tugas']['name'];
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if (!in_array($extension, $allowedExtensions, true)) {
            $error = 'Format file harus Pdf, Doc, atau Docs.';
        } else {
            $uploadDir = __DIR__ . '/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            $safeName = uniqid('tugas_', true) . '.' . $extension;
            $targetPath = $uploadDir . $safeName;

            if (move_uploaded_file($_FILES['file_tugas']['tmp_name'], $targetPath)) {
                $publicPath = 'uploads/' . $safeName;
                $stmt = $pdo->prepare(
                    'INSERT INTO submissions (task_id, mahasiswa_id, file_name, file_path, keterangan, diupload_pada)
                     VALUES (?, ?, ?, ?, NULL, NOW())'
                );
                $stmt->execute([$taskId, $user['id'], $originalName, $publicPath]);
                header('Location: dashboard.php?success=' . rawurlencode('Upload Tugas Berhasil'));
                exit;
            } else {
                $error = 'File tidak bisa disimpan ke folder uploads.';
            }
        }
    }
}

$stmt = $pdo->query('SELECT id, judul, deadline FROM tasks ORDER BY deadline ASC');
$tasks = $stmt->fetchAll();

include 'includes/header.php';
include 'includes/navbar.php';
?>

<main class="app-shell upload-shell">
    <section class="upload-layout upload-layout-wide">
        <div class="upload-copy upload-copy-compact">
            <h1>Upload Tugas</h1>
        </div>

        <form class="upload-card upload-card-wide" method="POST" action="upload.php" enctype="multipart/form-data">
            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div class="field-group">
                <label>Pilih Tugas</label>
                <div class="task-choice-list">
                    <?php foreach ($tasks as $task): ?>
                        <label class="task-choice">
                            <input type="radio" name="task_id" value="<?= $task['id'] ?>" <?= $selectedTaskId === (int) $task['id'] ? 'checked' : '' ?> required>
                            <span class="task-choice-check">&#10003;</span>
                            <span class="task-choice-text">
                                <strong><?= htmlspecialchars($task['judul']) ?></strong>
                                <small>Deadline <?= date('d M Y', strtotime($task['deadline'])) ?></small>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="field-group">
                <div class="label-row">
                    <label for="file_tugas">File Tugas</label>
                    <div class="file-rules">
                        <span>maks 10MB</span>
                        <span>PDF/DOCS</span>
                    </div>
                </div>
                <input type="file" id="file_tugas" name="file_tugas" accept=".pdf,.doc,.docx" required>
            </div>

            <button class="btn btn-primary btn-full" type="submit">Upload Tugas</button>

        </form>
    </section>
</main>

<?php include 'includes/footer.php'; ?>