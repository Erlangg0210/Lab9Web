<?php require_once __DIR__ . '/helpers.php'; ?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><title>Latihan Function B</title>
<style>body{font-family:Arial;margin:30px;line-height:1.7} table{border-collapse:collapse} td,th{border:1px solid #999;padding:6px 14px}</style></head>
<body>
<h2>Latihan Function - Halaman B (Total Belanja)</h2>
<?php
$keranjang = [
 ['Buku Tulis', 5000, 10],
 ['Pulpen',     3500, 12],
 ['Penggaris',  4000, 5],
];
$grand = 0;
?>
<table><tr><th>Barang</th><th>Harga</th><th>Jumlah</th><th>Total</th></tr>
<?php foreach ($keranjang as [$nama, $harga, $jml]):
 $total = hitungTotal($harga, $jml); $grand += $total; ?>
<tr><td><?= e($nama) ?></td><td><?= formatRupiah($harga) ?></td><td><?= $jml ?></td><td><?= formatRupiah($total) ?></td></tr>
<?php endforeach; ?>
<tr><th colspan="3">Grand Total</th><th><?= formatRupiah($grand) ?></th></tr>
</table>
<p><a href="latihan-a.php">&laquo; Ke Halaman A</a></p>
</body></html>
