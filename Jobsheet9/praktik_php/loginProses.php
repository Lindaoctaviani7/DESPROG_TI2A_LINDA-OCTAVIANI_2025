<?php
    include_once "koneksi.php";

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM User WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    $cek = mysqli_num_rows($result);

    if($cek) {
        echo "Anda berhasil login, silahkan menuju " ?>
        <a href="homeAdmin.html">Halaman HOME</a>
    <?php
    }else{
        echo "Anda gagal login, silahkan "; ?>
        <a href="loginForm.html">Login Kembali</a>
    <?php
        echo mysqli_error($conn);
    }
?>