<?php
$total   = (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$terbaru = $pdo->query('SELECT nama, email, created_at FROM users ORDER BY id DESC LIMIT 5')->fetchAll();
?>
<section>
 <h2>Dashboard</h2>
 <div class="cards">
  <div class="card"><span class="angka"><?= $total ?></span><span>Total Pengguna</span></div>
  <div class="card"><span class="angka"><?= count($routes) ?></span><span>Rute Terdaftar</span></div>
  <div class="card"><span class="angka"><?= e(date('d/m/Y')) ?></span><span>Tanggal Hari Ini</span></div>
 </div>

 <h3>Pengguna Terbaru</h3>
 <table>
  <tr><th>Nama</th><th>Email</th><th>Dibuat</th></tr>
  <?php foreach ($terbaru as $u): ?>
   <tr><td><?= e($u['nama']) ?></td><td><?= e($u['email']) ?></td><td><?= e(formatTanggal($u['created_at'])) ?></td></tr>
  <?php endforeach; ?>
 </table>
 <p><a class="btn" href="<?= e(url('user/list')) ?>">Kelola Data Pengguna</a></p>
</section>
