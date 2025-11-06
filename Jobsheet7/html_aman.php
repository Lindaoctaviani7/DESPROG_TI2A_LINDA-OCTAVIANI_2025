<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Aman dari HTML Injection</title>
</head>
<body>
    <h2>Form Input Aman</h2>
    <form method="post" action="">
        Masukkan Teks: <input type="text" name="input"><br><br>
        Masukkan Email: <input type="text" name="email"><br><br>
        <input type="submit" value="Kirim">
    </form>

    <hr>

    <?php
    //Mengecek apakah ada data yang dikirim dari form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Mengamankan input teks dari HTML Injection
        $input = $_POST['input'];
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

        echo "<b>Hasil Input Aman:</b> " . $input . "<br>";

        //Memeriksa apakah input email valid
        $email = $_POST['email'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {//lanjutkan dengan pengolahan email yang aman
            echo "<b>Email Valid:</b> " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        } else {//tangani input yang tidak valid
            echo "<b>Email tidak valid!</b>";
        }
    }
    ?>
</body>
</html>
