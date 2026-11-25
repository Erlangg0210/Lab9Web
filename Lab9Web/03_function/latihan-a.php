<?php require_once __DIR__ . '/helpers.php'; ?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><title>Latihan Function A</title>
<style>body{font-family:Arial;margin:30px;line-height:1.7} table{border-collapse:collapse} td,th{border:1px solid #999;padding:6px 14px}</style></head>
<body>
<h2>Latihan Function - Halaman A (Suhu &amp; Nilai)</h2>
<h3>Konversi Celcius ke Fahrenheit</h3>
<table><tr><th>Celcius</th><th>Fahrenheit</th></tr>
<?php foreach ([0, 25, 37, 100] as $c): ?>
<tr><td><?= $c ?> &deg;C</td><td><?= konversiCelciusKeFahrenheit($c) ?> &deg;F</td></tr>
<?php endforeach; ?>
</table>
<h3>Predikat Nilai</h3>
<table><tr><th>Nilai</th><th>Predikat</th></tr>
<?php foreach ([92, 78, 66, 55, 30] as $n): ?>
<tr><td><?= $n ?></td><td><?= tentukanStatusNilai($n) ?></td></tr>
<?php endforeach; ?>
</table>
<p><a href="latihan-b.php">Ke Halaman B &raquo;</a></p>
</body></html>
