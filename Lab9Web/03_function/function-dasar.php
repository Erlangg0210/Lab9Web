<?php
// 1. Function tanpa parameter
function tampilkanSalam() {
 echo "Selamat belajar PHP modular!";
}

// 2. Function dengan parameter
function sapaPengguna($nama) {
 echo "Halo, " . htmlspecialchars($nama, ENT_QUOTES, 'UTF-8');
}

// 3. Function dengan return
function hitungLuasPersegiPanjang($panjang, $lebar) {
 return $panjang * $lebar;
}

// 4. Type declaration dan nilai default
function hitungDiskon(float $harga, float $persen = 10): float {
 return $harga * ($persen / 100);
}
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><title>Function Dasar</title>
<style>body{font-family:Arial;margin:30px;line-height:1.7}</style></head>
<body>
<h2>Praktikum 9 - Function pada PHP</h2>
<p><b>1. Tanpa parameter:</b> <?php tampilkanSalam(); ?></p>
<p><b>2. Dengan parameter:</b> <?php sapaPengguna("Rina"); ?></p>
<?php $luas = hitungLuasPersegiPanjang(8, 5); ?>
<p><b>3. Dengan return:</b> Luas: <?php echo $luas; ?></p>
<p><b>4. Default parameter:</b>
 hitungDiskon(200000) = <?php echo hitungDiskon(200000); ?> (10%),
 hitungDiskon(200000, 15) = <?php echo hitungDiskon(200000, 15); ?> (15%)</p>
</body></html>
