<?php
/**
 * Latihan 3 - Router Aman
 * Input URL TIDAK PERNAH dipakai langsung sebagai path file.
 * Nilai ?page= hanya dipakai sebagai KUNCI untuk mencari file pada whitelist.
 */

// Whitelist rute (minimal 5 rute)
$routes = [
 'home'    => __DIR__ . '/pages/home.php',
 'profil'  => __DIR__ . '/pages/profil.php',
 'produk'  => __DIR__ . '/pages/produk.php',
 'artikel' => __DIR__ . '/pages/artikel.php',
 'kontak'  => __DIR__ . '/pages/kontak.php',
];

$page = $_GET['page'] ?? 'home';

// Validasi: harus string DAN terdaftar pada whitelist
if (!is_string($page) || !array_key_exists($page, $routes)) {
 http_response_code(404);
 $page = '404';
 $contentFile = __DIR__ . '/views/404.php';
} else {
 $contentFile = $routes[$page];
}

require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';
