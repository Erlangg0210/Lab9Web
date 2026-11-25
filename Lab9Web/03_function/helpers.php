<?php
// helpers.php - kumpulan function umum Praktikum 9 (bagian E)

function formatRupiah(float $angka): string {
 return 'Rp ' . number_format($angka, 0, ',', '.');
}

function e(string $nilai): string {
 return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}

// ---- Latihan function ----

// 1. Konversi Celcius ke Fahrenheit: F = (C x 9/5) + 32
function konversiCelciusKeFahrenheit(float $c): float {
 return ($c * 9 / 5) + 32;
}

// 2. Predikat nilai (rentang ditetapkan sendiri)
function tentukanStatusNilai(float $nilai): string {
 if ($nilai >= 85) return 'A (Sangat Baik)';
 if ($nilai >= 75) return 'B (Baik)';
 if ($nilai >= 65) return 'C (Cukup)';
 if ($nilai >= 50) return 'D (Kurang)';
 return 'E (Tidak Lulus)';
}

// 3. Total belanja
function hitungTotal(float $harga, int $jumlah): float {
 return $harga * $jumlah;
}
