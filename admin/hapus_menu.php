<?php
session_start();
require '../config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID menu tidak ditemukan.";
    exit;
}

$id = (int)$_GET['id'];

$result = mysqli_query($db, "SELECT * FROM menu WHERE id_menu = $id");
$menu = mysqli_fetch_assoc($result);

if (!$menu) {
    echo "Menu tidak ditemukan.";
    exit;
}

if ($menu['gambar']) {
    $path = '../uploads/' . $menu['gambar'];
    if (file_exists($path)) {
        unlink($path); 
    }
}

$delete = mysqli_query($db, "DELETE FROM menu WHERE id_menu = $id");

if ($delete) {
    header("Location: ../dashboard.php");
    exit;
} else {
    echo "Gagal menghapus menu.";
}
?>
