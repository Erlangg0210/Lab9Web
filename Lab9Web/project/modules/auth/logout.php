<?php
// modules/auth/logout.php - logout hanya lewat POST + CSRF
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verify()) {
 redirect('dashboard');
}
unset($_SESSION['admin']);
session_regenerate_id(true);
set_flash('success', 'Anda telah logout.');
redirect('login');
