<?php
session_start();
$entries = isset($_SESSION['entries']) ? $_SESSION['entries'] : array();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Daftar Semua Data</title>
  <link rel="stylesheet" href="style.css"/>
  <style>
    .list-wrap{max-width:1000px;margin:24px auto}
    .entry{background:#fff;padding:12px;border-radius:10px;margin-bottom:12px;border:1px solid #eef6ff}
    .meta{color:#6b7280;font-size:0.9rem}
  </style>
</head>
<body>
  <div class="wrap list-wrap">
    <h1>Riwayat Data (Session)</h1>
    <p class="muted">Semua data disimpan dalam PHP session array. Reload browser / tutup session akan hilangkan data.</p>

    <?php if (empty($entries)): ?>
      <div class="entry"><p class="muted">Belum ada data yang masuk.</p></div>
    <?php else: ?>
      <?php foreach (array_reverse($entries) as $e): ?>
        <div class="entry">
          <p><strong><?php echo $e['name']; ?></strong> — <span class="meta"><?php echo $e['email']; ?></span></p>
          <p><?php echo nl2br($e['comment']); ?></p>
          <p class="meta">Waktu: <?php echo $e['time']; ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <p><a href="index.html">Kembali ke Form</a></p>
  </div>
</body>
</html>
