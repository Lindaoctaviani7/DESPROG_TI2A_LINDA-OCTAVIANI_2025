<?php
//lokasi penyimpanan file yang diunggah
$targetDirectory = "documents/";

$allowedExtensions = array("jpg", "jpeg", "png", "gif");
$maxsize = 5 * 1024 * 1024;

//periksa apakah direktori penyimpanan ada, jika tidak maka buat
if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

if (isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
    $totalFiles = count($_FILES['files']['name']);

    //loop melalui semua file yang diunggah
    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['files']['name'][$i];
        $targetFile = $targetDirectory . $fileName;

        //pindahkan file yang diunggah ke direktori penyimpanan
        if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFile)) {
            echo "File " . $fileName . " berhasil diunggah.<br>";
        } else {
            echo "Gagal mengunggah file " . $fileName . ".<br>";
        }
    }
} else {
    echo "Tidak ada file yang diunggah.";
}