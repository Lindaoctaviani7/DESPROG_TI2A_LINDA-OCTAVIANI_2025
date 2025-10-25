<?php
// update_status.php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['orders'])) $_SESSION['orders'] = [];

$action = $_POST['action'] ?? '';
$id = $_POST['id'] ?? '';

if (!$id) {
    echo json_encode(['ok'=>false,'msg'=>'ID kosong']); exit;
}

foreach ($_SESSION['orders'] as &$o) {
    if ($o['id'] == $id) {
        if ($action === 'advance') {
            // urutan status
            $seq = ['processing','baking','delivery','done'];
            $i = array_search($o['status'],$seq);
            if ($i === false) { $o['status']='processing'; $i=0; }
            if ($i < count($seq)-1) $o['status'] = $seq[$i+1];
        } elseif ($action === 'cancel') {
            $o['status'] = 'cancelled';
        }
        echo json_encode(['ok'=>true,'status'=>$o['status']]);
        exit;
    }
}
echo json_encode(['ok'=>false,'msg'=>'Order tidak ditemukan']);
