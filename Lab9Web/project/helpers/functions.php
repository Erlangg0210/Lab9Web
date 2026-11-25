<?php
/**
 * helpers/functions.php
 * Function umum yang dipakai bersama oleh banyak modul.
 */

/* ---------- Tampilan & format ---------- */

/** Escape output HTML (mencegah XSS). */
function e(?string $nilai): string {
 return htmlspecialchars((string)$nilai, ENT_QUOTES, 'UTF-8');
}

/** 150000 -> "Rp 150.000" */
function formatRupiah(float $angka): string {
 return 'Rp ' . number_format($angka, 0, ',', '.');
}

/** Nilai diskon (bukan harga akhir). */
function hitungDiskon(float $harga, float $persen = 10): float {
 return $harga * ($persen / 100);
}

/** Validasi format email. */
function validasiEmail(string $email): bool {
 return filter_var(trim($email), FILTER_VALIDATE_EMAIL) !== false;
}

/** Ringkas teks pada batas kata. */
function ringkasTeks(string $teks, int $batas = 100): string {
 $teks = trim(preg_replace('/\s+/', ' ', $teks));
 if (mb_strlen($teks) <= $batas) return $teks;
 $potong = mb_substr($teks, 0, $batas);
 $spasi  = mb_strrpos($potong, ' ');
 if ($spasi !== false) $potong = mb_substr($potong, 0, $spasi);
 return $potong . '...';
}

/** Format tanggal DB -> "25 Nov 2026". */
function formatTanggal(?string $tanggal): string {
 return $tanggal ? date('d M Y', strtotime($tanggal)) : '-';
}

/* ---------- URL & routing ---------- */

/** Folder URL aplikasi, mis. "/Lab9Web/project" (agar path aset konsisten). */
function base_url(): string {
 $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
 return rtrim($dir, '/');
}

/** Path aset: asset('css/style.css') -> "/Lab9Web/project/assets/css/style.css" */
function asset(string $path): string {
 return base_url() . '/assets/' . ltrim($path, '/');
}

/** Buat URL rute: url('user/edit', ['id' => 3]) -> "index.php?page=user%2Fedit&id=3" */
function url(string $page, array $params = []): string {
 $query = http_build_query(['page' => $page] + $params);
 return 'index.php?' . str_replace('%2F', '/', $query);
}

/** Redirect ke rute lain, lalu hentikan eksekusi. */
function redirect(string $page, array $params = []): void {
 while (ob_get_level() > 0) ob_end_clean();
 header('Location: ' . url($page, $params));
 exit;
}

/** Menu aktif: true bila rute saat ini sama dengan $rute. */
function is_active(string $rute): bool {
 global $page;
 return $page === $rute;
}

/* ---------- Flash message ---------- */

function set_flash(string $tipe, string $pesan): void {
 $_SESSION['flash'][] = ['tipe' => $tipe, 'pesan' => $pesan];
}

function get_flash(): array {
 $flash = $_SESSION['flash'] ?? [];
 unset($_SESSION['flash']);
 return $flash;
}

/* ---------- CSRF ---------- */

function csrf_token(): string {
 if (empty($_SESSION['csrf'])) {
  $_SESSION['csrf'] = bin2hex(random_bytes(32));
 }
 return $_SESSION['csrf'];
}

function csrf_field(): string {
 return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function csrf_verify(): bool {
 $kirim = $_POST['csrf'] ?? '';
 return is_string($kirim) && hash_equals($_SESSION['csrf'] ?? '', $kirim);
}

/* ---------- Auth & input ---------- */

function is_logged_in(): bool {
 return !empty($_SESSION['admin']);
}

/** Ambil & validasi parameter id (bilangan bulat positif) dari $_GET. 0 = tidak valid. */
function get_id(): int {
 $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
 return $id === false || $id === null ? 0 : $id;
}

/* ---------- Validasi form pengguna ---------- */

/**
 * Validasi input pengguna. Mengembalikan [nilaiBersih, daftarError].
 * $idAbaikan dipakai saat edit agar email milik diri sendiri tidak dianggap duplikat.
 */
function validasiPengguna(PDO $pdo, array $input, int $idAbaikan = 0): array {
 $values = [
  'nama'    => trim((string)($input['nama'] ?? '')),
  'email'   => trim((string)($input['email'] ?? '')),
  'telepon' => trim((string)($input['telepon'] ?? '')),
 ];
 $errors = [];

 if ($values['nama'] === '') {
  $errors['nama'] = 'Nama wajib diisi.';
 } elseif (mb_strlen($values['nama']) > 100) {
  $errors['nama'] = 'Nama maksimal 100 karakter.';
 }

 if ($values['email'] === '') {
  $errors['email'] = 'Email wajib diisi.';
 } elseif (!validasiEmail($values['email'])) {
  $errors['email'] = 'Format email tidak valid.';
 } else {
  $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email AND id <> :id');
  $stmt->execute([':email' => $values['email'], ':id' => $idAbaikan]);
  if ((int)$stmt->fetchColumn() > 0) {
   $errors['email'] = 'Email sudah terdaftar.';
  }
 }

 if ($values['telepon'] !== '' && !preg_match('/^[0-9+]{8,15}$/', $values['telepon'])) {
  $errors['telepon'] = 'Telepon harus 8-15 digit angka.';
 }

 return [$values, $errors];
}
