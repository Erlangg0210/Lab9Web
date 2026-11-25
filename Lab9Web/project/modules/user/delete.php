<?php
// modules/user/delete.php - hapus pengguna (DELETE)
// Hanya diproses lewat POST + token CSRF. Membuka URL (GET) TIDAK menghapus data.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
 set_flash('error', 'Penghapusan hanya dapat dilakukan melalui tombol Hapus (metode POST).');
 redirect('user/list');
}

if (!csrf_verify()) {
 set_flash('error', 'Token keamanan tidak valid. Penghapusan dibatalkan.');
 redirect('user/list');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false || $id === null) {
 set_flash('error', 'ID pengguna tidak valid.');
 redirect('user/list');
}

$cek = $pdo->prepare('SELECT nama FROM users WHERE id = :id');
$cek->execute([':id' => $id]);
$nama = $cek->fetchColumn();

if ($nama === false) {
 set_flash('error', 'Data pengguna tidak ditemukan.');
} else {
 $del = $pdo->prepare('DELETE FROM users WHERE id = :id');
 $del->execute([':id' => $id]);
 set_flash('success', 'Pengguna "' . $nama . '" berhasil dihapus.');
}
redirect('user/list');
