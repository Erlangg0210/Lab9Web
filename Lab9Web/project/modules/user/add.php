<?php
// modules/user/add.php - tambah pengguna (CREATE)
$title  = 'Tambah Pengguna';
$values = ['nama' => '', 'email' => '', 'telepon' => ''];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 if (!csrf_verify()) {
  http_response_code(403);
  $errors['umum'] = 'Token keamanan tidak valid. Muat ulang halaman.';
 } else {
  [$values, $errors] = validasiPengguna($pdo, $_POST);
  if (!$errors) {
   $stmt = $pdo->prepare('INSERT INTO users (nama, email, telepon) VALUES (:nama, :email, :telepon)');
   $stmt->execute([
    ':nama'    => $values['nama'],
    ':email'   => $values['email'],
    ':telepon' => $values['telepon'] !== '' ? $values['telepon'] : null,
   ]);
   set_flash('success', 'Pengguna "' . $values['nama'] . '" berhasil ditambahkan.');
   redirect('user/list');
  }
 }
}

$action      = url('user/add');
$labelTombol = 'Simpan';
?>
<section>
 <h2>Tambah Pengguna</h2>
 <?php if (isset($errors['umum'])): ?><div class="alert alert-error"><?= e($errors['umum']) ?></div><?php endif; ?>
 <?php require __DIR__ . '/_form.php'; ?>
</section>
