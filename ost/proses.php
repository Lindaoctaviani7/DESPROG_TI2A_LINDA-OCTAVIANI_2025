<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $peminjam = $_POST['peminjam'];
    $email = $_POST['email'];
    $tgl_pinjam = $_POST['tgl_pinjam'];

    $data_buku = [
        ["judul" => $judul, "peminjam" => $peminjam, "email" => $email, "tgl_pinjam" => $tgl_pinjam]
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman Buku</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $("table").hide().fadeIn(800);
        });
    </script>
</head>
<body>

<h1>Data Peminjaman Buku</h1>

<table border="1" cellpadding="8" cellspacing="0" align="center">
    <tr style="background-color:#007BFF; color:white;">
        <th>No</th>
        <th>Judul Buku</th>
        <th>Nama Peminjam</th>
        <th>Email</th>
        <th>Tanggal Pinjam</th>
    </tr>

    <?php
    $no = 1;
    foreach ($data_buku as $buku) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$buku['judul']}</td>
                <td>{$buku['peminjam']}</td>
                <td>{$buku['email']}</td>
                <td>{$buku['tgl_pinjam']}</td>
              </tr>";
        $no++;
    }
    ?>
</table>

<div style="text-align:center; margin-top:20px;">
    <a href="index.html">← Kembali ke Form</a>
</div>

</body>
</html>
