<?php
// include biasa dipanggil 2x -> teks tercetak dua kali
include __DIR__ . '/pesan.php';
include __DIR__ . '/pesan.php';
echo "<hr>";
// include_once / require_once -> hanya sekali walaupun dipanggil 2x
include_once __DIR__ . '/pesan.php';
include_once __DIR__ . '/pesan.php';
