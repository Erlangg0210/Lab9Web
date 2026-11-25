<?php
// modules/auth/login.php
$title = 'Login';
if (is_logged_in()) {
 redirect('dashboard');
}

$errorLogin = '';
$username   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $username = trim((string)($_POST['username'] ?? ''));
 $password = (string)($_POST['password'] ?? '');

 if (!csrf_verify()) {
  http_response_code(403);
  $errorLogin = 'Token keamanan tidak valid. Muat ulang halaman.';
 } else {
  $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = :u');
  $stmt->execute([':u' => $username]);
  $admin = $stmt->fetch();

  if ($admin && password_verify($password, $admin['password_hash'])) {
   session_regenerate_id(true);
   $_SESSION['admin'] = $admin['username'];
   set_flash('success', 'Selamat datang, ' . $admin['username'] . '!');
   redirect('dashboard');
  }
  $errorLogin = 'Username atau password salah.';
 }
}
?>
<section class="login-box">
 <h2>Login Admin</h2>
 <?php if ($errorLogin !== ''): ?><div class="alert alert-error"><?= e($errorLogin) ?></div><?php endif; ?>
 <form method="post" action="<?= e(url('login')) ?>">
  <?= csrf_field() ?>
  <div class="field">
   <label for="username">Username</label>
   <input type="text" id="username" name="username" value="<?= e($username) ?>" required autofocus>
  </div>
  <div class="field">
   <label for="password">Password</label>
   <input type="password" id="password" name="password" required>
  </div>
  <button type="submit" class="btn">Masuk</button>
 </form>
 <p class="info">Akun praktikum: <code>admin</code> / <code>admin123</code></p>
</section>
