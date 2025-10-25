<?php
// index.php
session_start();
if (!isset($_SESSION['orders'])) $_SESSION['orders'] = [];

// Jika datang dari proses.php (redirect setelah POST), tetap tampilkan daftar dari session
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Toko Kue Mini - Pesan Kue</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js" defer></script>
</head>
<body>
<header class="topbar">
  <div class="logo">🎂 CakeShop Mini</div>
</header>

<div class="wrap">
  <aside class="left">
    <h2>Pesan Kue Ulang Tahun</h2>
    <form id="orderForm" action="proses.php" method="POST">
      <label>Nama<span class="req">*</span></label>
      <input name="nama" id="nama" type="text">
      <div class="err" id="errNama"></div>

      <label>Email<span class="req">*</span></label>
      <input name="email" id="email" type="email">
      <div class="err" id="errEmail"></div>

      <label>Alamat Pengiriman</label>
      <textarea name="alamat" id="alamat" rows="2"></textarea>

      <label>Bentuk Kue</label>
      <div class="radios">
        <label><input type="radio" name="bentuk" value="round" checked> Round</label>
        <label><input type="radio" name="bentuk" value="square"> Square</label>
      </div>

      <label>Rasa</label>
      <select name="rasa" id="rasa">
        <option value="vanilla">Vanilla</option>
        <option value="chocolate">Chocolate</option>
        <option value="cheese">Cheese</option>
      </select>

      <label>Kartu Ucapan</label>
      <input name="kartu" id="kartu" type="text">

      <label>Pilih warna dekorasi (max 3)</label>
      <div id="colorPool">
        <!-- contoh swatch: data-color attribute -->
        <button type="button" class="swatch" data-color="#f44336" style="background:#f44336"></button>
        <button type="button" class="swatch" data-color="#ffeb3b" style="background:#ffeb3b"></button>
        <button type="button" class="swatch" data-color="#4caf50" style="background:#4caf50"></button>
        <button type="button" class="swatch" data-color="#2196f3" style="background:#2196f3"></button>
        <button type="button" class="swatch" data-color="#9c27b0" style="background:#9c27b0"></button>
        <button type="button" class="swatch" data-color="#ff9800" style="background:#ff9800"></button>
      </div>
      <div class="err" id="errColors"></div>

      <!-- hidden field for selected colors -->
      <input type="hidden" name="colors" id="colors">

      <label>Komentar</label>
      <textarea name="komentar" id="komentar" rows="3"></textarea>
      <div class="err" id="errKomentar"></div>

      <button class="btn primary" id="btnOrder" type="submit"><i class="fa fa-basket-shopping"></i> Pesan Sekarang</button>
    </form>

    <div class="preview">
      <h3>Preview Kue</h3>
      <!-- Simple SVG cake with 3 areas that will get picked colors -->
      <svg id="cakeSvg" width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <!-- cake base -->
        <rect id="cakeBase" x="40" y="110" width="120" height="50" rx="10" fill="#f5e6e8" stroke="#d3c1c3"/>
        <!-- frosting layer 1 -->
        <path id="layer1" d="M40 110 q60 -40 120 0" fill="#fff2f5"/>
        <!-- frosting layer 2 -->
        <path id="layer2" d="M40 95 q60 -35 120 0" fill="#fff7f2"/>
        <!-- topper circle -->
        <circle id="topper" cx="100" cy="70" r="18" fill="#ffdede" stroke="#d3c1c3"/>
      </svg>
    </div>
  </aside>

  <main class="right">
    <h2>Daftar Pesanan</h2>
    <div id="ordersList">
      <?php if (empty($_SESSION['orders'])): ?>
        <p>Belum ada pesanan.</p>
      <?php else: ?>
        <?php foreach ($_SESSION['orders'] as $idx => $o): ?>
          <div class="orderCard" data-id="<?= $o['id'] ?>">
            <div class="meta"><strong>#<?= $o['id'] ?></strong> - <?= htmlspecialchars($o['nama']) ?> (<?= htmlspecialchars($o['rasa']) ?>)</div>
            <div class="content">
              <div class="cakeSmall">
                <!-- small SVG with colors -->
                <svg width="80" height="60" viewBox="0 0 200 120">
                  <rect x="10" y="50" width="180" height="40" rx="6" fill="<?= $o['colors'][0] ?? '#eee' ?>"/>
                  <rect x="10" y="30" width="180" height="20" rx="6" fill="<?= $o['colors'][1] ?? '#ddd' ?>"/>
                  <circle cx="170" cy="20" r="10" fill="<?= $o['colors'][2] ?? '#ccc' ?>"/>
                </svg>
              </div>
              <div class="desc">
                <p><strong>Alamat:</strong> <?= htmlspecialchars($o['alamat']) ?></p>
                <p><strong>Kartu:</strong> <?= htmlspecialchars($o['kartu']) ?></p>
                <p class="status">Status: <span class="badge status-<?= $o['status'] ?>"><?= $o['status'] ?></span></p>
                <div class="actions">
                  <button class="advance" data-id="<?= $o['id'] ?>">Advance</button>
                  <button class="cancel" data-id="<?= $o['id'] ?>">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>
</div>

</body>
</html>
