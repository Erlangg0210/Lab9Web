<?php
// modules/user/list.php - daftar pengguna (READ) dengan pencarian
$title = 'Data Pengguna';
$q = $_GET['q'] ?? '';
$q = is_string($q) ? trim($q) : '';

if ($q !== '') {
 // Nama parameter harus unik karena EMULATE_PREPARES dimatikan
 $stmt = $pdo->prepare('SELECT * FROM users WHERE nama LIKE :q1 OR email LIKE :q2 ORDER BY id');
 $stmt->execute([':q1' => '%' . $q . '%', ':q2' => '%' . $q . '%']);
} else {
 $stmt = $pdo->query('SELECT * FROM users ORDER BY id');
}
$users = $stmt->fetchAll();
?>
<section>
 <h2>Data Pengguna</h2>

 <div class="toolbar">
  <form method="get" action="index.php" class="inline">
   <input type="hidden" name="page" value="user/list">
   <input type="text" name="q" placeholder="Cari nama / email..." value="<?= e($q) ?>">
   <button type="submit" class="btn btn-small">Cari</button>
  </form>
  <a class="btn" href="<?= e(url('user/add')) ?>">+ Tambah Pengguna</a>
 </div>

 <table>
  <tr><th>No</th><th>Nama</th><th>Email</th><th>Telepon</th><th>Dibuat</th><th>Aksi</th></tr>
  <?php if (!$users): ?>
   <tr><td colspan="6" class="kosong">Data tidak ditemukan.</td></tr>
  <?php endif; ?>
  <?php foreach ($users as $i => $u): ?>
   <tr>
    <td><?= $i + 1 ?></td>
    <td><?= e($u['nama']) ?></td>
    <td><?= e($u['email']) ?></td>
    <td><?= e($u['telepon'] ?: '-') ?></td>
    <td><?= e(formatTanggal($u['created_at'])) ?></td>
    <td class="aksi">
     <a class="btn btn-small btn-blue" href="<?= e(url('user/edit', ['id' => $u['id']])) ?>">Edit</a>
     <!-- Hapus memakai POST + CSRF, bukan link GET -->
     <form method="post" action="<?= e(url('user/delete')) ?>" class="inline"
           data-confirm="Hapus pengguna &quot;<?= e($u['nama']) ?>&quot;?">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= (int)$u['id'] ?>">
      <button type="submit" class="btn btn-small btn-red">Hapus</button>
     </form>
    </td>
   </tr>
  <?php endforeach; ?>
 </table>
 <p class="info">Total: <?= count($users) ?> pengguna</p>
</section>
