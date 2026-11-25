# Lab9Web — Praktikum 9: PHP Modular

**Modularisasi Program, Function, Template, dan Routing**

| | |
|---|---|
| **Nama** | Erlangga Wahyutama Fitra |
| **NIM** | 312510146 |
| **Mata Kuliah** | Pemrograman Web |
| **Praktikum** | 9 — PHP Modular |
| **Repository** | `Lab9Web` |

---

## 1. Tujuan Project

Project ini memisahkan aplikasi PHP ke dalam file-file dengan tanggung jawab yang jelas, mencakup:

1. Perbedaan `include`, `require`, `include_once`, `require_once`.
2. Template halaman bersama (`header.php`, `footer.php`).
3. Function PHP (parameter, nilai kembalian, type declaration, file helper).
4. Struktur direktori aplikasi modular.
5. Routing sederhana berbasis parameter URL (`?page=...`) dengan **whitelist** dan halaman **404**.
6. Integrasi modularisasi + routing ke aplikasi database (CRUD pengguna, PDO + MySQL/MariaDB).

## 2. Kebutuhan Perangkat

- PHP **8.0+** (diuji pada PHP 8.3) dengan ekstensi `pdo_mysql` dan `mbstring` (keduanya aktif secara default di XAMPP/Laragon)
- MySQL / MariaDB
- Web server lokal: Apache (XAMPP/Laragon) — atau server bawaan PHP untuk uji cepat
- Browser dan editor kode (Visual Studio Code)

## 3. Cara Menjalankan

### a. Letakkan project
Salin folder `Lab9Web` ke docroot, mis. `C:\xampp\htdocs\Lab9Web`.

### b. Impor database
1. Jalankan Apache dan MySQL di XAMPP.
2. Buka `http://localhost/phpmyadmin` → tab **Import** → pilih `database/db_latihan.sql` → **Go**.
   (atau lewat terminal: `mysql -u root < database/db_latihan.sql`)

Impor ini membuat database `db_latihan` dengan tabel `users` (5 data contoh) dan `admins`.

### c. Sesuaikan koneksi (jika perlu)
Edit `project/config/database.php`. Bawaan: host `localhost`, database `db_latihan`, user `root`, password kosong.

### d. Buka di browser

| Bagian | URL |
|---|---|
| Praktik include/require | `http://localhost/Lab9Web/01_praktik_include_require/uji-include.php` |
| Praktik template | `http://localhost/Lab9Web/02_template_layout/home.php` |
| Praktik function | `http://localhost/Lab9Web/03_function/function-dasar.php` |
| Latihan 1 | `http://localhost/Lab9Web/latihan1_template/home.php` |
| Latihan 2 | `http://localhost/Lab9Web/latihan2_function/produk.php` |
| Latihan 3 | `http://localhost/Lab9Web/latihan3_router/index.php` |
| **Latihan 4 (aplikasi CRUD modular)** | `http://localhost/Lab9Web/project/index.php` |

**Akun login aplikasi:** `admin` / `admin123`

### e. Alternatif tanpa Apache
```bash
cd Lab9Web
php -S localhost:8000
# lalu buka http://localhost:8000/project/index.php
```
Jika koneksi database memakai TCP, atur variabel lingkungan `DB_HOST=127.0.0.1` (`DB_NAME`, `DB_USER`, `DB_PASS` juga dapat di-override).

## 4. Struktur Direktori

```
Lab9Web/
├── README.md
├── JAWABAN.md                     # analisis, latihan, pertanyaan pemahaman, kendala
├── database/
│   └── db_latihan.sql
├── 01_praktik_include_require/    # bagian C
├── 02_template_layout/            # bagian D
├── 03_function/                   # bagian E
├── latihan1_template/             # Latihan 1
├── latihan2_function/             # Latihan 2
├── latihan3_router/               # Latihan 3
├── project/                       # Latihan 4 + integrasi (bagian F, G, H, I)
│   ├── index.php                  # titik masuk + router (whitelist)
│   ├── .htaccess                  # URL rewrite (opsional)
│   ├── config/database.php        # satu-satunya koneksi database
│   ├── views/                     # header, footer, dashboard, 404
│   ├── helpers/functions.php      # function umum
│   ├── modules/
│   │   ├── user/                  # list, add, edit, delete (+ _form.php)
│   │   └── auth/                  # login, logout
│   └── assets/                    # css, js
└── screenshots/                   # bukti hasil (40 gambar)
```

![Struktur repository](screenshots/24-struktur-direktori-repository.png)
![Struktur project modular](screenshots/25-struktur-direktori-project-modular.png)

## 5. Daftar Rute (`project/index.php`)

| Rute (`?page=`) | File yang dimuat | Keterangan | Login |
|---|---|---|---|
| `dashboard` (default) | `views/dashboard.php` | Ringkasan data | ya |
| `login` | `modules/auth/login.php` | Form login | tidak |
| `logout` | `modules/auth/logout.php` | Logout (POST + CSRF) | ya |
| `user/list` | `modules/user/list.php` | Daftar + pencarian (READ) | ya |
| `user/add` | `modules/user/add.php` | Tambah pengguna (CREATE) | ya |
| `user/edit` | `modules/user/edit.php` | Ubah pengguna (UPDATE) | ya |
| `user/delete` | `modules/user/delete.php` | Hapus pengguna (DELETE, **POST only**) | ya |
| *(lainnya)* | `views/404.php` | Status HTTP **404** | — |

Router **tidak pernah** menyusun path file dari input URL. Nilai `page` hanya dipakai sebagai kunci array whitelist `$routes`; nilai kosong, bertipe array, atau mengandung `../` otomatis berakhir di 404.

## 6. Langkah Praktikum & Bukti (Screenshot)

### C. Include vs Require
`pesan.php` dipanggil dengan `include` dan `require`. Saat `pesan.php` dihilangkan:

| `include` (file ada) | `include` (file hilang) | `require` (file hilang) |
|---|---|---|
| ![](screenshots/01-include-file-ada.png) | ![](screenshots/02-include-file-hilang-warning.png) | ![](screenshots/03-require-file-hilang-fatal.png) |

- `include` → hanya **Warning**, baris "Sesudah pemanggilan" **tetap dijalankan**.
- `require` → **Fatal error**, eksekusi **berhenti** (baris sesudahnya tidak tercetak).

Perbandingan `include` vs `include_once`:
![include_once](screenshots/04-include-vs-include_once.png)

### D. Template layout
`home.php`, `about.php`, `kontak.php` memuat `header.php` dan `footer.php` yang sama.

![Home](screenshots/05-template-home.png)
![Tentang](screenshots/06-template-tentang.png)
![Kontak](screenshots/07-template-kontak.png)

### E. Function
![Function dasar](screenshots/08-function-dasar.png)
![helpers.php](screenshots/09-function-helpers-contoh-panggil.png)

Latihan function (`konversiCelciusKeFahrenheit`, `tentukanStatusNilai`, `hitungTotal`) dipindahkan ke `03_function/helpers.php` dan dipanggil dari dua halaman:

![Latihan A](screenshots/10-latihan-function-halaman-a.png)
![Latihan B](screenshots/11-latihan-function-halaman-b.png)

### Latihan 1 — Template multi-halaman
Tidak ada salinan kode header/footer pada file halaman.

![Home](screenshots/12-latihan1-home.png)
![Profil](screenshots/13-latihan1-profil.png)
![Kontak](screenshots/14-latihan1-kontak.png)

### Latihan 2 — Library function
`helpers/functions.php` berisi `formatRupiah()`, `hitungDiskon()`, `validasiEmail()`, `ringkasTeks()` (+ `e()`), dipakai pada dua halaman.

![Produk](screenshots/15-latihan2-produk-formatRupiah-hitungDiskon.png)
![Email valid](screenshots/16-latihan2-artikel-email-valid.png)
![Email tidak valid](screenshots/17-latihan2-artikel-email-tidak-valid.png)

### Latihan 3 — Router aman (5 rute + 404)
![Home](screenshots/18-latihan3-router-home.png)
![Produk](screenshots/19-latihan3-router-produk.png)

Pengujian rute yang tidak sah — semuanya **404**:

![admin/rahasia](screenshots/20-latihan3-404-rute-tidak-terdaftar.png)
![kosong](screenshots/21-latihan3-404-page-kosong.png)
![array](screenshots/22-latihan3-404-page-bertipe-array.png)
![traversal](screenshots/23-latihan3-404-percobaan-path-traversal.png)

### Latihan 4 — Refactoring CRUD (integrasi, bagian I)

Langkah integrasi yang dilakukan:
1. Membuat direktori `config`, `views`, `helpers`, `modules`, `assets`.
2. Koneksi database dipindah ke `config/database.php` (`require_once`).
3. Header, navigasi, dan footer dipindah ke `views/header.php` dan `views/footer.php`.
4. Function umum (escape, validasi, format, flash, CSRF) dipindah ke `helpers/functions.php`.
5. Halaman CRUD dikelompokkan ke `modules/user/`.
6. `index.php` menjadi router dengan whitelist.
7. Semua tautan memakai pola `index.php?page=...`.

**Akses & autentikasi**

| Belum login → dialihkan ke login | Login gagal | Login berhasil (Dashboard) |
|---|---|---|
| ![](screenshots/26-project-tanpa-login-dialihkan-ke-login.png) | ![](screenshots/27-project-login-gagal.png) | ![](screenshots/28-project-dashboard-login-berhasil.png) |

**CRUD**

![READ](screenshots/29-project-crud-READ-daftar-pengguna.png)
![Cari](screenshots/30-project-crud-pencarian.png)
![Form tambah](screenshots/31-project-crud-CREATE-form-tambah.png)
![Validasi server](screenshots/32-project-crud-validasi-server-error.png)
![Create berhasil](screenshots/33-project-crud-CREATE-berhasil.png)
![Form edit](screenshots/34-project-crud-UPDATE-form-edit.png)
![Update berhasil](screenshots/35-project-crud-UPDATE-berhasil.png)
![Delete berhasil](screenshots/36-project-crud-DELETE-berhasil.png)

**Pengujian keamanan & router**

![Delete via GET ditolak](screenshots/37-project-delete-lewat-GET-ditolak.png)
![404 rute tak terdaftar](screenshots/38-project-router-404-rute-tidak-terdaftar.png)
![404 page array](screenshots/39-project-router-404-page-bertipe-array.png)
![Logout](screenshots/40-project-logout.png)

### H. URL ringkas dengan `.htaccess` (opsional)
File `project/.htaccess` berisi:
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.+)$ index.php?page=$1 [QSA,L]
```
Dengan aturan ini `/Lab9Web/project/user/list` diteruskan ke `index.php?page=user/list`.
Syarat: `mod_rewrite` aktif dan `AllowOverride All`. Jika aplikasi berada di sub-folder, aktifkan baris `RewriteBase` di dalam file tersebut. Path aset memakai `base_url()` agar CSS/JS tetap termuat saat URL berubah.

## 7. Fitur Keamanan yang Diterapkan

- **Whitelist rute** + validasi tipe `page` (`is_string`) → tidak ada path file dari input URL.
- **Prepared statement PDO** pada seluruh query → aman dari SQL injection.
- **Escape output** dengan `e()` (`htmlspecialchars`) → aman dari XSS.
- **Hapus data hanya lewat POST** + **token CSRF**; membuka URL `user/delete` lewat GET tidak menghapus apa pun.
- Logout, login, tambah, dan edit juga memverifikasi token CSRF.
- Password disimpan dengan `password_hash()` dan dicek dengan `password_verify()`; `session_regenerate_id()` setelah login.
- Detail error koneksi database tidak ditampilkan ke pengguna (`error_log` + pesan umum).
- Validasi input di sisi server (wajib, format email, email unik, format telepon).

## 8. Tantangan Mandiri yang Dikerjakan

- [x] Menu aktif (*active navigation*) berdasarkan rute (`is_active()`)
- [x] Helper pesan sukses/gagal (*flash message*: `set_flash()` / `get_flash()`)
- [x] Pembatasan akses: seluruh halaman selain `login` memerlukan sesi login
- [x] URL rewrite dengan `.htaccess` + dokumentasi konfigurasi

## 9. Kendala & Cara Mengatasi

Lihat bagian **Kendala** pada [`JAWABAN.md`](JAWABAN.md).

## 10. Pengujian

Pengujian dilakukan dengan PHP 8.3 + MariaDB 10.11 memakai server bawaan PHP. Skenario yang diuji (semua lulus): akses tanpa login, login benar/salah, login tanpa CSRF, rute tidak terdaftar/kosong/array/path traversal (404), tambah valid, validasi (kosong, format email, email duplikat, telepon), XSS ter-escape, edit, hapus via POST, hapus via GET (ditolak), hapus tanpa CSRF (ditolak), ID tidak valid, pencarian aman dari SQL injection, serta logout.
Screenshot diambil dari hasil pengujian tersebut (alamat `127.0.0.1:8080`). Fitur `.htaccess` perlu diuji pada Apache lokal masing-masing karena membutuhkan `mod_rewrite`.

## 11. Commit & Pengiriman

```bash
cd Lab9Web
git init
git add .
git commit -m "Praktikum 9: PHP Modular - Erlangga Wahyutama Fitra (312510146)"
git branch -M main
git remote add origin https://github.com/<username-anda>/Lab9Web.git
git push -u origin main
```
Kirim URL repository melalui e-learning sesuai instruksi dosen.
