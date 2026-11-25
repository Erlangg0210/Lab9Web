<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title><?= e(($title ?? '') !== '' ? $title . ' - ' : '') ?>Aplikasi PHP Modular</title>
 <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
</head>
<body>
<div class="container">
 <header>
  <h1>Aplikasi PHP Modular</h1>
  <p>Praktikum 9 &bull; Erlangga Wahyutama Fitra &bull; 312510146</p>
 </header>
 <nav>
  <?php if (is_logged_in()): ?>
   <a href="<?= e(url('dashboard')) ?>" class="<?= is_active('dashboard') ? 'aktif' : '' ?>">Dashboard</a>
   <a href="<?= e(url('user/list')) ?>" class="<?= is_active('user/list') ? 'aktif' : '' ?>">Data Pengguna</a>
   <a href="<?= e(url('user/add')) ?>" class="<?= is_active('user/add') ? 'aktif' : '' ?>">Tambah Pengguna</a>
   <span class="spacer"></span>
   <span class="who">Masuk: <b><?= e($_SESSION['admin']) ?></b></span>
   <form method="post" action="<?= e(url('logout')) ?>" class="inline">
    <?= csrf_field() ?>
    <button type="submit" class="btn btn-small btn-gray">Logout</button>
   </form>
  <?php else: ?>
   <a href="<?= e(url('login')) ?>" class="<?= is_active('login') ? 'aktif' : '' ?>">Login</a>
  <?php endif; ?>
 </nav>
 <main>
  <?php foreach (get_flash() as $f): ?>
   <div class="alert alert-<?= e($f['tipe']) ?>"><?= e($f['pesan']) ?></div>
  <?php endforeach; ?>
