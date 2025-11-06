<?php
session_start();

if (!isset($_SESSION['data'])) {
    $_SESSION['data'] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul = $_POST['judul'];
    $peminjam = $_POST['peminjam'];
    $email = $_POST['email'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $komentar = $_POST['komentar'];

    $dataBaru = [
        "judul" => htmlspecialchars($judul),
        "peminjam" => htmlspecialchars($peminjam),
        "email" => htmlspecialchars($email),
        "tgl_pinjam" => htmlspecialchars($tgl_pinjam),
        "komentar" => htmlspecialchars($komentar)
    ];

    array_push($_SESSION['data'], $dataBaru);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman & Komentar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Data Peminjaman Buku</h1>

<div class="hasil">
<?php
if (!empty($_SESSION['data'])) {
    echo "<ul>";
    foreach ($_SESSION['data'] as $index => $item) {
        echo "<li>";
        echo "<strong># Data Peminjam " . ($index+1) . "</strong><br>";
        echo "📘 <b>Judul:</b> " . $item['judul'] . "<br>";
        echo "👤 <b>Nama:</b> " . $item['peminjam'] . "<br>";
        echo "📧 <b>Email:</b> " . $item['email'] . "<br>";
        echo "📅 <b>Tanggal Pinjam:</b> " . $item['tgl_pinjam'] . "<br>";
        echo "💬 <b>Komentar:</b> " . $item['komentar'] . "<hr>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Belum ada data yang dikirim.</p>";
}
?>
</div>

<a href="index.html" style="color:white;">← Kembali ke Form</a>

</body>
</html>
