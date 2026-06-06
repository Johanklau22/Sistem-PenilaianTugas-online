<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$pageTitle = 'Login - Sistem Pengumpulan dan Penilaian Tugas Online';
$error = $_GET['error'] ?? '';
include 'includes/header.php';
?>

<main class="login-page">
    <section class="login-hero">
        <div class="hero-copy">
            <p class="eyebrow">Platform Akademik</p>
            <h1>Sistem Pengumpulan dan Penilaian Tugas Online</h1>
        </div>

        <form class="login-card" action="login.php" method="POST">
            <div class="form-header">
                <span class="status-dot"></span>
                <div>
                    <h2>Masukan Akun Anda</h2>
                    <p>Gunakan username dan password yang sudah terdaftar.</p>
                </div>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password">

            <div class="role-picker" aria-label="Pilih role login">
                <label>
                    <input type="radio" name="role" value="mahasiswa">
                    <span>Mahasiswa</span>
                </label>
                <label>
                    <input type="radio" name="role" value="dosen">
                    <span>Dosen</span>
                </label>
            </div>

            <button class="btn btn-primary btn-full" type="submit">Login Sekarang</button>

        </form>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
