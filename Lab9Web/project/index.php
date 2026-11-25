<?php
/**
 * index.php - titik masuk aplikasi + router (Praktikum 9)
 * Aplikasi PHP Modular | Erlangga Wahyutama Fitra - 312510146
 */
session_start();
ob_start(); // supaya redirect() masih bisa dipakai di dalam modul

require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/config/database.php';

// ---- Whitelist rute: kunci = nilai ?page=, nilai = file yang dimuat ----
$routes = [
 'dashboard'   => __DIR__ . '/views/dashboard.php',
 'login'       => __DIR__ . '/modules/auth/login.php',
 'logout'      => __DIR__ . '/modules/auth/logout.php',
 'user/list'   => __DIR__ . '/modules/user/list.php',
 'user/add'    => __DIR__ . '/modules/user/add.php',
 'user/edit'   => __DIR__ . '/modules/user/edit.php',
 'user/delete' => __DIR__ . '/modules/user/delete.php',
];

// Rute yang boleh diakses tanpa login
$publicRoutes = ['login'];

$page = $_GET['page'] ?? 'dashboard';

if (!is_string($page) || !array_key_exists($page, $routes)) {
 // rute tidak dikenal / kosong / bertipe array -> 404
 http_response_code(404);
 $page        = '404';
 $title       = 'Halaman tidak ditemukan';
 $contentFile = __DIR__ . '/views/404.php';
} else {
 // pembatasan akses: halaman selain login memerlukan sesi login
 if (!in_array($page, $publicRoutes, true) && !is_logged_in()) {
  set_flash('error', 'Silakan login terlebih dahulu.');
  redirect('login');
 }
 $contentFile = $routes[$page];
 $title       = '';
}

// Jalankan modul dalam buffer: modul boleh redirect sebelum ada output
ob_start();
require $contentFile;
$content = ob_get_clean();

require_once __DIR__ . '/views/header.php';
echo $content;
require_once __DIR__ . '/views/footer.php';
