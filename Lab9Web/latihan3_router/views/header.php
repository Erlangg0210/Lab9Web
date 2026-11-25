<?php
// $page tersedia dari index.php (dipakai untuk menu aktif)
function aktif(string $rute, string $sekarang): string {
 return $rute === $sekarang ? 'class="aktif"' : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Latihan 3 - Router Aman</title>
 <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
 <header><h1>Latihan 3 - Router Aman</h1><p>index.php?page=... dengan whitelist rute</p></header>
 <nav>
  <a href="index.php?page=home" <?= aktif('home', $page) ?>>Home</a>
  <a href="index.php?page=profil" <?= aktif('profil', $page) ?>>Profil</a>
  <a href="index.php?page=produk" <?= aktif('produk', $page) ?>>Produk</a>
  <a href="index.php?page=artikel" <?= aktif('artikel', $page) ?>>Artikel</a>
  <a href="index.php?page=kontak" <?= aktif('kontak', $page) ?>>Kontak</a>
 </nav>
 <main>
