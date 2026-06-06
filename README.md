# Sistem Pengumpulan dan Penilaian Tugas Online

Website sederhana berbasis PHP dan MySQL untuk login mahasiswa/dosen, melihat daftar tugas, upload tugas, dan input nilai oleh dosen.

## Struktur File

- `index.php` - halaman login
- `login.php` - proses login
- `dashboard.php` - dashboard tugas mahasiswa dan dashboard penilaian dosen
- `upload.php` - halaman upload tugas mahasiswa
- `logout.php` - proses keluar akun
- `config/database.php` - konfigurasi koneksi database
- `includes/` - file header, navbar, footer, dan auth
- `assets/css/style.css` - styling tampilan
- `assets/js/script.js` - JavaScript sederhana
- `uploads/` - folder penyimpanan file tugas
- `database.sql` - database dan tabel yang dibutuhkan

## Cara Menjalankan

1. Pindahkan folder project ke `htdocs` jika memakai XAMPP, atau folder web server Laragon.
2. Buka phpMyAdmin.
3. Import file `database.sql`.
4. Sesuaikan koneksi database di `config/database.php` jika username atau password MySQL berbeda.
5. Jalankan melalui browser:

```text
http://localhost/Sistem Penilaian dan pengumpulan tugas online/
```

## Akun Contoh

```text
Mahasiswa
Username: mahasiswa
Password: password

Dosen
Username: dosen
Password: password
```
