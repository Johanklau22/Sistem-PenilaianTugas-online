<?php $user = currentUser(); ?>
<header class="topbar">
    <a class="brand" href="dashboard.php">
        <?php if ($user): ?>
            <span class="brand-back-arrow" title="Kembali ke dashboard awal">&larr;</span>
        <?php endif; ?>
        <span class="brand-mark">SP</span>
        <span>Sistem Tugas Online</span>
    </a>

    <?php if ($user): ?>
        <nav class="nav-actions">
            <span class="user-chip"><?= htmlspecialchars($user['nama_lengkap']) ?> - <?= htmlspecialchars(ucfirst($user['role'])) ?></span>
            <a class="btn btn-ghost" href="logout.php">Keluar</a>
        </nav>
    <?php endif; ?>
</header>