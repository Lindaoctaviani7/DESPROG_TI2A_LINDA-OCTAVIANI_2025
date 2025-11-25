<?php
include 'koneksi.php';

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
}
elseif ($aksi == 'ubah') {
} 
elseif ($aksi == 'hapus') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "DELETE FROM anggota WHERE id = $id";

        if (pg_query($koneksi, $query)) {
            header(header: "Location: index.php");
            exit();
        } else {
            echo "Gagal menghapus data: " . preg_last_error($koneksi);
        }
    } else {
        echo "ID tidak valid.";
    }
}

pg_close($koneksi);