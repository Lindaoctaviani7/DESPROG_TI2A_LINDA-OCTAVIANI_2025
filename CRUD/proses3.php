<?php
elseif ($aksi == 'ubah') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $query ="UPDATE anggota SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', no_telp = '$no_telp' WHERE id = $id";

        if (pg_query($koneksi, $query)) {
            header(header: "Location: index.php");
            exit();
        } else {
            echo "Gagal mengubah data: " . preg_last_error($koneksi);
        }
    } else {
        echo "ID tidak valid.";
    }
}