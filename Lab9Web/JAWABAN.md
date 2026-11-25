# Jawaban Praktikum 9 — PHP Modular

**Nama:** Erlangga Wahyutama Fitra  **NIM:** 312510146

---

## A. Hasil Praktik: Menguji `include` dan `require` (Bagian C.3)

| Percobaan | Hasil yang diamati |
|---|---|
| `include` + file ada | Teks `pesan.php` tampil di antara "Sebelum" dan "Sesudah pemanggilan". |
| `include` + file **hilang** | Muncul **Warning** (*Failed to open stream*), tetapi baris **"Sesudah pemanggilan" tetap tercetak** — eksekusi berlanjut. |
| `require` + file **hilang** | Muncul Warning dan **Fatal error**; baris **"Sesudah pemanggilan" tidak tercetak** — eksekusi berhenti. |

**Catatan `include_once`/`require_once`:** pada `uji-once.php`, `include` yang dipanggil dua kali mencetak isi `pesan.php` dua kali, sedangkan `include_once` yang dipanggil dua kali hanya mencetaknya satu kali. (Screenshot 01–04.)

---

## B. Analisis Hasil Template (Bagian D)

**1. Bagian mana yang digunakan bersama oleh semua halaman?**
`header.php` (awal dokumen HTML, `<head>`, judul, dan navigasi), `footer.php` (penutup `</main>`, footer, `</body></html>`), dan `style.css`. Yang berbeda hanya konten pada tiap file halaman.

**2. Apa yang terjadi jika teks navigasi diubah pada `header.php`?**
Perubahan langsung terlihat di **semua** halaman yang memuat header tersebut, cukup mengubah satu file.

**3. Mengapa konten halaman tidak diletakkan seluruhnya di `header.php`?**
Karena header dipakai bersama. Jika konten halaman ada di header, setiap halaman akan menampilkan konten yang sama dan tanggung jawab file menjadi campur aduk. Header hanya menangani kerangka bersama; konten khusus ditulis di file halaman masing-masing.

**4. Apa manfaat `require_once` dibanding menyalin kode header ke setiap halaman?**
Tidak ada duplikasi kode (satu sumber kebenaran), perubahan cukup di satu tempat, perawatan lebih mudah, dan karena `require_once` hanya memuat file satu kali, header tidak tampil ganda. `require` juga menghentikan eksekusi bila file template hilang, sehingga halaman tidak tampil rusak setengah-setengah.

---

## C. Latihan Function (Bagian E)

| No | Function | Contoh hasil |
|---|---|---|
| 1 | `konversiCelciusKeFahrenheit($c)` → `($c × 9/5) + 32` | 100 °C → 212 °F |
| 2 | `tentukanStatusNilai($nilai)` → A ≥ 85, B ≥ 75, C ≥ 65, D ≥ 50, E < 50 | 92 → "A (Sangat Baik)" |
| 3 | `hitungTotal($harga, $jumlah)` → `harga × jumlah` | 5000 × 10 → Rp 50.000 |
| 4 | Semua function dipindah ke `03_function/helpers.php` dan dipanggil dari `latihan-a.php` dan `latihan-b.php` (dua halaman berbeda) via `require_once`. | — |

---

## D. Ringkasan Latihan Terstruktur (Bagian J)

| Latihan | Lokasi | Kriteria | Status |
|---|---|---|---|
| 1 — Template multi-halaman | `latihan1_template/` | Home, Profil, Kontak memakai header/footer sama; tanpa salinan kode; navigasi berfungsi | ✔ |
| 2 — Library function | `latihan2_function/helpers/functions.php` | 4 function wajib (`formatRupiah`, `hitungDiskon`, `validasiEmail`, `ringkasTeks`) dipakai di 2 halaman (`produk.php`, `artikel.php`) | ✔ |
| 3 — Router aman | `latihan3_router/` | 5 rute + 404; input URL tidak dipakai langsung sebagai path | ✔ |
| 4 — Refactoring CRUD | `project/` | CRUD berjalan; koneksi hanya di `config/database.php`; tautan memakai routing | ✔ |
| Tantangan mandiri | `project/` | Menu aktif, flash message, pembatasan akses login, `.htaccess` | ✔ |

---

## E. Jawaban Pertanyaan Pemahaman (Bagian L)

**1. Jelaskan pengertian modularisasi program dan minimal tiga manfaatnya.**
Modularisasi adalah teknik membagi aplikasi menjadi bagian-bagian kecil berdasarkan fungsi atau tanggung jawabnya, di mana setiap bagian (modul) dapat dipakai kembali. Manfaatnya:
- **Penggunaan ulang** — header, footer, koneksi database, dan fungsi validasi tidak ditulis ulang di setiap halaman.
- **Pemeliharaan mudah** — perubahan tampilan atau konfigurasi cukup dilakukan di satu modul.
- **Kode lebih terbaca dan terstruktur** — tanggung jawab tiap file jelas sehingga mudah ditelusuri saat aplikasi membesar.
- **Kerja tim lebih lancar** — pekerjaan dapat dibagi per modul dan mengurangi konflik pada satu file besar.

**2. Apa perbedaan `include` dan `require` ketika file yang dipanggil tidak ditemukan?**
`include` menghasilkan **peringatan (warning)** dan eksekusi **berlanjut**. `require` menghasilkan **error fatal** dan eksekusi **dihentikan**.

**3. Mengapa `require_once` sesuai digunakan untuk memuat konfigurasi database?**
Konfigurasi database adalah file **wajib** — tanpanya aplikasi tidak dapat bekerja, sehingga `require` (berhenti bila gagal) lebih tepat daripada `include`. Akhiran `_once` memastikan file hanya dimuat **satu kali**, sehingga koneksi/variabel/function tidak dideklarasikan berulang (menghindari error *already declared* dan koneksi ganda).

**4. Jelaskan perbedaan parameter, argumen, dan nilai return pada function.**
- **Parameter**: variabel yang didefinisikan pada deklarasi function (`function hitungTotal($harga, $jumlah)` → `$harga`, `$jumlah`).
- **Argumen**: nilai nyata yang dikirim saat function dipanggil (`hitungTotal(5000, 10)` → `5000`, `10`).
- **Nilai return**: hasil yang dikembalikan function kepada pemanggil melalui `return`; dapat disimpan ke variabel, dihitung lagi, atau dipakai pada kondisi — berbeda dengan `echo` yang hanya menampilkan keluaran.

**5. Mengapa header dan footer sebaiknya dipisahkan dari konten halaman?**
Karena keduanya dipakai bersama oleh banyak halaman. Dipisahkan, bagian ini ditulis sekali dan dimuat ulang, tampilan konsisten, perubahan cukup di satu file, dan file konten hanya berisi hal yang khas untuk halaman tersebut (prinsip satu file satu tanggung jawab).

**6. Apa fungsi `index.php` pada pola routing yang dipraktikkan?**
`index.php` adalah **titik masuk tunggal (front controller) sekaligus router**: membaca parameter `page`, memeriksa apakah rute ada di whitelist, memeriksa hak akses (login), lalu memuat file modul yang sesuai di antara template `header.php` dan `footer.php`. Rute yang tidak dikenal diarahkan ke halaman 404.

**7. Mengapa router sebaiknya menggunakan whitelist rute?**
Whitelist hanya mengizinkan halaman yang **secara eksplisit didaftarkan** oleh aplikasi. Input pengguna hanya menjadi *kunci* pencarian, bukan path file. Dengan begitu pengguna tidak dapat memanggil file sembarangan (mis. `config/database.php`), mencegah *path traversal* dan *file inclusion*, serta rute tidak dikenal otomatis menghasilkan 404.

**8. Apa risiko jika input `page` langsung digabungkan menjadi path file yang di-`require`?**
Pola seperti `require $_GET['page'] . '.php'` membuka celah **path traversal / Local File Inclusion**: penyerang dapat memakai `../` untuk memuat file di luar direktori yang dimaksud (konfigurasi, kode sumber, file sistem), atau memuat file yang tidak seharusnya dijalankan sehingga dapat membocorkan data atau mengeksekusi kode yang tidak diinginkan. Pada konfigurasi tertentu bahkan dapat berujung pada eksekusi kode jarak jauh.

**9. Apa fungsi aturan `RewriteCond` dan `RewriteRule` pada `.htaccess`?**
- `RewriteCond %{REQUEST_FILENAME} !-f` dan `!-d` adalah **syarat**: aturan berikutnya hanya berlaku jika permintaan **bukan** file fisik dan **bukan** direktori yang ada (agar CSS, JS, gambar tetap dilayani langsung).
- `RewriteRule ^(.+)$ index.php?page=$1 [QSA,L]` adalah **aturan penulisan ulang**: permintaan lain (mis. `/user/list`) diteruskan ke `index.php?page=user/list`. `QSA` mempertahankan query string asli, `L` menandai aturan terakhir.

**10. Sebutkan bagian aplikasi CRUD yang paling tepat dipindahkan ke `config`, `views`, `helpers`, dan `modules`.**

| Direktori | Isi pada project ini |
|---|---|
| `config/` | `database.php` — koneksi database (PDO) |
| `views/` | `header.php`, `footer.php` (navigasi), `dashboard.php`, `404.php` — komponen tampilan bersama |
| `helpers/` | `functions.php` — `e()`, `formatRupiah()`, `validasiEmail()`, `ringkasTeks()`, `validasiPengguna()`, flash message, CSRF, `url()`/`redirect()` |
| `modules/` | `user/` (list, add, edit, delete, `_form.php`) dan `auth/` (login, logout) — logika fitur per domain |

---

## F. Kendala yang Ditemukan dan Cara Mengatasinya

Kendala 1–2 **ditemukan nyata saat pengujian**; kendala 3–6 adalah **masalah umum yang sengaja diantisipasi** pada rancangan (sesuai tabel debugging modul bagian K) sehingga dicegah sebelum terjadi.

| # | Jenis | Kendala | Penyebab | Solusi |
|---|---|---|---|---|
| 1 | Ditemukan | Pencarian di daftar pengguna error `SQLSTATE[HY093]: Invalid parameter number` | Koneksi memakai `ATTR_EMULATE_PREPARES => false`, sehingga satu nama parameter (`:q`) **tidak boleh dipakai dua kali** dalam satu query | Memakai nama parameter unik `:q1` dan `:q2` (`modules/user/list.php`) |
| 2 | Ditemukan | `Call to undefined function mb_strlen()` | Ekstensi `mbstring` belum aktif pada PHP yang dipakai | Mengaktifkan ekstensi `mbstring` (aktif bawaan di XAMPP/Laragon; di `php.ini`: `extension=mbstring`) dan mencantumkannya pada kebutuhan perangkat di README |
| 3 | Diantisipasi | *Headers already sent* saat `header('Location: ...')` dipanggil dari modul, karena router memuat `header.php` sebelum konten | Modul CRUD melakukan redirect setelah proses POST, padahal HTML sudah mulai dikirim | Modul dijalankan dalam *output buffering* (`ob_start()` / `ob_get_clean()`) di `index.php`; `redirect()` membersihkan buffer sebelum mengirim header |
| 4 | Diantisipasi | CSS tidak tampil jika URL berubah (mis. saat memakai `.htaccess`) | Path aset relatif (`style.css`) menjadi salah pada URL bersarang (`/user/list`) | Path aset konsisten lewat `asset()` berbasis `base_url()` |
| 5 | Diantisipasi | Data terhapus hanya karena membuka/menelusuri URL | Operasi ubah data lewat GET | Hapus diproses lewat **POST + token CSRF** dengan konfirmasi JavaScript; akses GET ditolak dan hanya menampilkan pesan |
| 6 | Diantisipasi | Header/footer tampil ganda | Layout dipanggil dari lebih dari satu tempat | Layout hanya dipanggil oleh `index.php`; file modul hanya berisi konten |
