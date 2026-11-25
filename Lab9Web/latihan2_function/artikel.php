<?php require_once __DIR__ . '/helpers/functions.php';
$artikel = [
 ['Manfaat Modularisasi', 'Modularisasi adalah teknik membagi aplikasi menjadi bagian-bagian yang lebih kecil berdasarkan fungsi atau tanggung jawabnya sehingga kode lebih mudah dipahami, dipelihara, dan digunakan kembali oleh bagian aplikasi lain.'],
 ['Mengenal Router', 'Router menentukan bagian aplikasi yang harus dijalankan berdasarkan parameter URL. Dengan whitelist rute, aplikasi terhindar dari pemanggilan file yang tidak dimaksudkan serta risiko path traversal.'],
];
$email = $_POST['email'] ?? '';
$sudahKirim = $_SERVER['REQUEST_METHOD'] === 'POST';
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Latihan 2 - Artikel</title>
<link rel="stylesheet" href="style.css"></head><body><div class="box">
<nav><a href="produk.php">Produk (formatRupiah &amp; hitungDiskon)</a><a href="artikel.php">Artikel &amp; Email (ringkasTeks &amp; validasiEmail)</a></nav>
<h2>Ringkasan Artikel</h2>
<?php foreach ($artikel as [$judul, $isi]): ?>
 <h3><?= e($judul) ?></h3>
 <p><?= e(ringkasTeks($isi, 90)) ?></p>
<?php endforeach; ?>

<h2>Validasi Email</h2>
<form method="post">
 <input type="text" name="email" placeholder="contoh: nama@domain.com" value="<?= e($email) ?>">
 <button type="submit">Cek Email</button>
</form>
<?php if ($sudahKirim): ?>
 <?php if (validasiEmail($email)): ?>
  <p class="ok">&#10004; Email &quot;<?= e($email) ?>&quot; VALID.</p>
 <?php else: ?>
  <p class="err">&#10008; Email &quot;<?= e($email) ?>&quot; TIDAK valid.</p>
 <?php endif; ?>
<?php endif; ?>
<footer>Erlangga Wahyutama Fitra - 312510146</footer>
</div></body></html>
