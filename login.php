<?php
session_start();
require_once 'config/database.php';

function redirectLoginError(string $message): void
{
    header('Location: index.php?error=' . rawurlencode($message));
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

if ($username === '') {
    redirectLoginError('Harap Masukan Username');
}

if ($password === '') {
    redirectLoginError('Harap Masukan Password');
}

if ($role === '' || !in_array($role, ['mahasiswa', 'dosen'], true)) {
    redirectLoginError('Silahkan Pilih Opsi Mahasiswa/Dosen');
}

$stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user) {
    redirectLoginError('Username Anda Salah');
}

if (!password_verify($password, $user['password'])) {
    redirectLoginError('Password Anda Salah');
}

if ($user['role'] !== $role) {
    redirectLoginError('Pilihan Opsi Anda Salah');
}

$_SESSION['user'] = [
    'id' => $user['id'],
    'username' => $user['username'],
    'nama_lengkap' => $user['nama_lengkap'],
    'role' => $user['role'],
];

header('Location: dashboard.php');
exit;