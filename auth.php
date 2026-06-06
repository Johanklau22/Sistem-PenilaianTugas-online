<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function requireLogin(): void
{
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
        exit;
    }
}

function currentUser(): ?array
{
    return $_SESSION['user'] ?? null;
}

function isDosen(): bool
{
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'dosen';
}

function isMahasiswa(): bool
{
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'mahasiswa';
}
