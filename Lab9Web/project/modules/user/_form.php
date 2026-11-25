<?php
// modules/user/_form.php - komponen form yang dipakai bersama add.php & edit.php
// Variabel yang dibutuhkan: $values, $errors, $action, $labelTombol
?>
<form method="post" action="<?= e($action) ?>" novalidate>
 <?= csrf_field() ?>
 <div class="field">
  <label for="nama">Nama</label>
  <input type="text" id="nama" name="nama" value="<?= e($values['nama']) ?>" required>
  <?php if (isset($errors['nama'])): ?><small class="error"><?= e($errors['nama']) ?></small><?php endif; ?>
 </div>
 <div class="field">
  <label for="email">Email</label>
  <input type="text" id="email" name="email" value="<?= e($values['email']) ?>" required>
  <?php if (isset($errors['email'])): ?><small class="error"><?= e($errors['email']) ?></small><?php endif; ?>
 </div>
 <div class="field">
  <label for="telepon">Telepon <span class="opsional">(opsional)</span></label>
  <input type="text" id="telepon" name="telepon" value="<?= e($values['telepon']) ?>">
  <?php if (isset($errors['telepon'])): ?><small class="error"><?= e($errors['telepon']) ?></small><?php endif; ?>
 </div>
 <button type="submit" class="btn"><?= e($labelTombol) ?></button>
 <a class="btn btn-gray" href="<?= e(url('user/list')) ?>">Batal</a>
</form>
