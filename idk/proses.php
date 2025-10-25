<?php
// proses.php
session_start();
if (!isset($_SESSION['orders'])) $_SESSION['orders'] = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// ambil & bersihkan input
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$bentuk = trim($_POST['bentuk'] ?? 'round');
$rasa = trim($_POST['rasa'] ?? 'vanilla');
$kartu = trim($_POST['kartu'] ?? '');
$komentar = trim($_POST['komentar'] ?? '');
$colorsRaw = trim($_POST['colors'] ?? ''); // format "#f44336,#ffeb3b"
$colors = array_filter(array_map('trim', explode(',', $colorsRaw)));

$errors = [];

// server-side validation
if ($nama === '') $errors[] = "Nama wajib diisi";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email tidak valid";
if (strlen($komentar) < 10) $errors[] = "Komentar minimal 10 karakter";
if (count($colors) > 3) $errors[] = "Pilihan warna maksimal 3";

if (!empty($errors)) {
    // simpan errors ke session supaya bisa ditampilkan di index (opsional)
    $_SESSION['form_errors'] = $errors;
    header('Location: index.php');
    exit;
}

// generate id sederhana
$id = time() . rand(100,999);

$order = [
  'id' => $id,
  'nama' => htmlspecialchars($nama),
  'email' => htmlspecialchars($email),
  'alamat' => htmlspecialchars($alamat),
  'bentuk' => $bentuk,
  'rasa' => $rasa,
  'kartu' => htmlspecialchars($kartu),
  'komentar' => htmlspecialchars($komentar),
  'colors' => $colors,
  'status' => 'processing',
  'created_at' => date('Y-m-d H:i:s')
];

$_SESSION['orders'][] = $order;

// redirect kembali ke halaman index agar daftar terupdate (post-redirect-get)
header('Location: index.php');
exit;
