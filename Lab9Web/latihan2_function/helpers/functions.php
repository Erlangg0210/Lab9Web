<?php
/**
 * helpers/functions.php - Latihan 2 (Library function)
 */

/** Format angka menjadi Rupiah, mis. 150000 -> "Rp 150.000" */
function formatRupiah(float $angka): string {
 return 'Rp ' . number_format($angka, 0, ',', '.');
}

/** Hitung NILAI diskon (bukan harga akhir). Persen default 10%. */
function hitungDiskon(float $harga, float $persen = 10): float {
 return $harga * ($persen / 100);
}

/** Validasi format email. Mengembalikan true/false. */
function validasiEmail(string $email): bool {
 return filter_var(trim($email), FILTER_VALIDATE_EMAIL) !== false;
}

/** Ringkas teks panjang, dipotong pada batas kata lalu ditambah "...". */
function ringkasTeks(string $teks, int $batas = 100): string {
 $teks = trim(preg_replace('/\s+/', ' ', $teks));
 if (mb_strlen($teks) <= $batas) {
  return $teks;
 }
 $potong = mb_substr($teks, 0, $batas);
 $spasi  = mb_strrpos($potong, ' ');
 if ($spasi !== false) {
  $potong = mb_substr($potong, 0, $spasi);
 }
 return $potong . '...';
}

/** Escape output HTML. */
function e(string $nilai): string {
 return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}
