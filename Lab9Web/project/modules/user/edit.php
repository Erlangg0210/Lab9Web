<?php
// modules/user/edit.php - ubah pengguna (UPDATE)
$title = 'Edit Pengguna';
$id    = get_id();

$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$stmt->execute([':id' => $id]);
$user = $id > 0 ? $stmt->fetch() : false;

if (!$user) {
 set_flash('error', 'Data pengguna tidak ditemukan.');
 redirect('user/list');
}

$values = ['nama' => $user['nama'], 'email' => $user['email'], 'telepon' => (string)$user['telepon']];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 if (!csrf_verify()) {
  http_response_code(403);
  $errors['umum'] = 'Token keamanan tidak valid. Muat ulang halaman.';
 } else {
  [$values, $errors] = validasiPengguna($pdo, $_POST, $id);
  if (!$errors) {
   $upd = $pdo->prepare('UPDATE users SET nama = :nama, email = :email, telepon = :telepon WHERE id = :id');
   $upd->execute([
    ':nama'    => $values['nama'],
    ':email'   => $values['email'],
    ':telepon' => $values['telepon'] !== '' ? $values['telepon'] : null,
    ':id'      => $id,
   ]);
   set_flash('success', 'Data pengguna "' . $values['nama'] . '" berhasil diperbarui.');
   redirect('user/list');
  }
 }
}

$action      = url('user/edit', ['id' => $id]);
$labelTombol = 'Perbarui';
?>
<section>
 <h2>Edit Pengguna</h2>
 <?php if (isset($errors['umum'])): ?><div class="alert alert-error"><?= e($errors['umum']) ?></div><?php endif; ?>
 <?php require __DIR__ . '/_form.php'; ?>
</section>
