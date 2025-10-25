<?php
// proses.php
session_start();

// inisialisasi array penyimpanan di session
if (!isset($_SESSION['entries'])) {
    $_SESSION['entries'] = array();
}

// fungsi validasi sisi-server (sederhana)
function valid_email($e) {
    return filter_var($e, FILTER_VALIDATE_EMAIL) !== false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

    $errors = array();

    if ($name === '') $errors['name'] = 'Nama tidak boleh kosong.';
    if ($email === '') $errors['email'] = 'Email tidak boleh kosong.';
    elseif (!valid_email($email)) $errors['email'] = 'Format email tidak valid.';
    if (strlen($comment) <= 10) $errors['comment'] = 'Komentar harus lebih dari 10 karakter.';

    if (!empty($errors)) {
        // jika ada error -> tampilkan pesan & link kembali
        ?>
        <!doctype html>
        <html>
        <head>
          <meta charset="utf-8"/>
          <meta name="viewport" content="width=device-width,initial-scale=1"/>
          <title>Kesalahan Input</title>
          <style>
            body{font-family:Arial;margin:40px;background:#f8fafc;color:#0f172a}
            .box{background:white;padding:20px;border-radius:10px;max-width:700px;margin:auto;box-shadow:0 6px 18px rgba(15,23,42,0.06)}
            .err{color:#dc2626}
            a{color:#2563eb}
          </style>
        </head>
        <body>
          <div class="box">
            <h2>Ada Kesalahan Pada Input</h2>
            <ul>
              <?php foreach($errors as $k => $v) {
                  echo "<li class='err'>{$v}</li>";
              } ?>
            </ul>
            <p><a href="index.html">&larr; Kembali ke form</a></p>
          </div>
        </body>
        </html>
        <?php
        exit;
    }

    // simpan data ke session array (PHP array)
    $entry = array(
        'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
        'email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
        'comment' => htmlspecialchars($comment, ENT_QUOTES, 'UTF-8'),
        'time' => date('Y-m-d H:i:s')
    );

    // push ke array session
    $_SESSION['entries'][] = $entry;

    // setelah simpan, tampilkan hasil input dengan rapi dan animasi jQuery bisa dipakai
    ?>
    <!doctype html>
    <html>
    <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width,initial-scale=1"/>
      <title>Data Tersimpan</title>
      <link rel="stylesheet" href="style.css">
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <style>
        .result-wrap{max-width:900px;margin:30px auto;background:#fff;padding:20px;border-radius:10px;box-shadow:0 6px 18px rgba(15,23,42,0.06)}
        .meta{color:#6b7280;font-size:0.95rem}
      </style>
    </head>
    <body>
      <div class="wrap">
        <div class="result-wrap" id="resultBox">
          <h2>Data Berhasil Disimpan</h2>
          <p class="meta">Berikut data yang Anda kirim:</p>
          <p><strong>Nama:</strong> <?php echo $entry['name']; ?></p>
          <p><strong>Email:</strong> <?php echo $entry['email']; ?></p>
          <p><strong>Komentar:</strong><br><?php echo nl2br($entry['comment']); ?></p>
          <p class="meta">Waktu simpan: <?php echo $entry['time']; ?></p>

          <hr>
          <p>Untuk melihat semua data yang pernah dikirim (session):</p>
          <ul>
            <li><a href="data.php">Lihat Semua Data</a></li>
            <li><a href="index.html">Kembali ke Form</a></li>
          </ul>
        </div>
      </div>

      <script>
        $(function(){
          // efek animasi: muncul dengan fadeIn
          $('#resultBox').hide().fadeIn(700);
        });
      </script>
    </body>
    </html>
    <?php
    exit;
} else {
    // Jika bukan POST -> redirect ke index
    header('Location: index.html');
    exit;
}
?>
