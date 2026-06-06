CREATE DATABASE IF NOT EXISTS db_tugas_online;
USE db_tugas_online;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(120) NOT NULL,
    nim VARCHAR(20) NULL,
    role ENUM('mahasiswa', 'dosen') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dosen_id INT NOT NULL,
    judul VARCHAR(150) NOT NULL,
    deskripsi TEXT NOT NULL,
    deadline DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (dosen_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_id INT NOT NULL,
    mahasiswa_id INT NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    keterangan TEXT NULL,
    nilai INT NULL,
    catatan TEXT NULL,
    dinilai_oleh INT NULL,
    diupload_pada DATETIME NOT NULL,
    dinilai_pada DATETIME NULL,
    FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE,
    FOREIGN KEY (mahasiswa_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (dinilai_oleh) REFERENCES users(id) ON DELETE SET NULL
);

INSERT INTO users (id, username, password, nama_lengkap, nim, role) VALUES
(2, 'mahasiswa', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi', 'Rina Mahasiswa', NULL, 'mahasiswa'),
(3, 'dewinurhalina', '$2y$10$ZV3JDjMOZ77dXtunjZZyFO2jLYIz7LTocOaOw6Quq8ORLsCFgaH8K', 'Dewi Nurhalina', '230101047', 'mahasiswa'),
(4, 'khanzagishca', '$2y$10$1TTyNv8gzh9pPlBZtf0UP.OGST0ocefV8bM1JJUTPOxapMy9iFatm', 'Khanza Gishca', '230101055', 'mahasiswa'),
(5, 'margarethalucia', '$2y$10$2mo9LptDypI07ES9kql83O86roF3Xs/MKHoSEKT/jY5r2RTIUtnRK', 'Margaretha Lucia', '230101057', 'mahasiswa'),
(6, 'johanklau', '$2y$10$GMgLCI6MmyzdjdUAiYP2WOcUxDyj4pFnAtR/ZMeuL8tBAIJxlOLbO', 'Yohanes Johan', '230101075', 'mahasiswa'),
(7, 'dosen1', '$2y$10$80zIbJjuJ5Mpi3ZvUZBeC.MjirYsvjGJgFdJRBXi2PLGPyU4TTbZa', 'Hanifah Permatasari, M.Kom', NULL, 'dosen')
ON DUPLICATE KEY UPDATE
password = VALUES(password),
nama_lengkap = VALUES(nama_lengkap),
nim = VALUES(nim),
role = VALUES(role);

INSERT INTO tasks (id, dosen_id, judul, deskripsi, deadline) VALUES
(1, 7, 'Makalah Sistem Informasi', 'Buat makalah tentang penerapan sistem informasi pada lingkungan kampus.', '2026-06-10'),
(2, 7, 'Presentasi Basis Data', 'Kumpulkan file presentasi tentang rancangan ERD dan relasi tabel.', '2026-06-15'),
(3, 7, 'Proyek Web Sederhana', 'Buat halaman web sederhana menggunakan HTML, CSS, PHP, dan database MySQL.', '2026-06-20')
ON DUPLICATE KEY UPDATE judul = VALUES(judul);
