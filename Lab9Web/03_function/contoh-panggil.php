<?php
require_once __DIR__ . '/helpers.php';
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><title>Contoh Panggil Helper</title>
<style>body{font-family:Arial;margin:30px;line-height:1.7}</style></head>
<body>
<h2>Contoh memanggil helpers.php</h2>
<p>formatRupiah(150000) = <b><?php echo formatRupiah(150000); ?></b></p>
<p>e('&lt;script&gt;alert("uji")&lt;/script&gt;') menghasilkan teks aman:
 <code><?php echo e('<script>alert("uji")</script>'); ?></code></p>
</body></html>
