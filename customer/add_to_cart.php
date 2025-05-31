<?php
session_start();
require '../config.php';

// cek role customer
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../index.php");
    exit;
}

$id_menu = $_POST['id_menu'] ?? null;

if (!$id_menu) {
    header("Location: ../dashboard.php");
    exit;
}

// escape input
$id_menu = mysqli_real_escape_string($db, $id_menu);

$query = mysqli_query($db, "SELECT * FROM menu WHERE id_menu = '$id_menu'");
$menu = mysqli_fetch_assoc($query);

if (!$menu) {
    echo "Menu tidak ditemukan.";
    exit;
}

// cek stok
if ((int)$menu['stok'] <= 0) {
    echo "Stok habis!";
    exit;
}

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// cek ketersediaan barang di keranjang
$found = false;
foreach ($_SESSION['keranjang'] as &$item) {
    if ($item['id_menu'] == $id_menu) {
        $item['jumlah'] += 1;
        $found = true;
        break;
    }
}
unset($item); 

// tambah ke keranjang kalau blm ada
if (!$found) {
    $_SESSION['keranjang'][] = [
        'id_menu' => $menu['id_menu'],
        'nama' => $menu['nama'], 
        'harga' => $menu['harga'],
        'jumlah' => 1
    ];
}

// send activity ke log
$username = $_SESSION['username'];
$nama_menu = $menu['nama'];
$log = "Menambahkan '$nama_menu' ke keranjang";
$log_escaped = mysqli_real_escape_string($db, $log);
mysqli_query($db, "INSERT INTO log_activity (username, aktivitas) VALUES ('$username', '$log_escaped')");

header("Location: ../dashboard.php");
exit;
?>
