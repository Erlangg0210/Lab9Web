<?php require_once __DIR__ . '/helpers/functions.php';
$produk = [
 ['Laptop Pelajar', 7500000, 15],
 ['Mouse Wireless', 150000, 10],
 ['Keyboard Mekanik', 450000, 20],
 ['Headset', 275000, 5],
];
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Latihan 2 - Produk</title>
<link rel="stylesheet" href="style.css"></head><body><div class="box">
<nav><a href="produk.php">Produk (formatRupiah &amp; hitungDiskon)</a><a href="artikel.php">Artikel &amp; Email (ringkasTeks &amp; validasiEmail)</a></nav>
<h2>Daftar Produk dengan Diskon</h2>
<table>
<tr><th>Produk</th><th>Harga</th><th>Diskon</th><th>Potongan</th><th>Harga Akhir</th></tr>
<?php foreach ($produk as [$nama, $harga, $persen]):
 $potongan = hitungDiskon($harga, $persen); ?>
<tr>
 <td><?= e($nama) ?></td>
 <td><?= formatRupiah($harga) ?></td>
 <td><?= $persen ?>%</td>
 <td><?= formatRupiah($potongan) ?></td>
 <td><b><?= formatRupiah($harga - $potongan) ?></b></td>
</tr>
<?php endforeach; ?>
</table>
<footer>Erlangga Wahyutama Fitra - 312510146</footer>
</div></body></html>
