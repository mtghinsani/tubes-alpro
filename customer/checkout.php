<?php
session_start();
require '../config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../index.php");
    exit;
}

$keranjang = $_SESSION['keranjang'] ?? [];

if (empty($keranjang)) {
    // Kalau keranjang kosong, balikin ke dashboard
    header("Location: ../dashboard.php");
    exit;
}

// Ambil data dari POST
$bayar = isset($_POST['bayar']) ? (int)str_replace(['.', ','], '', $_POST['bayar']) : 0;
$nama_customer = isset($_POST['nama_customer']) ? trim($_POST['nama_customer']) : '';
$alamat_customer = isset($_POST['alamat_customer']) ? trim($_POST['alamat_customer']) : '';

// Validasi input
if ($bayar <= 0) {
    $_SESSION['error'] = "Input pembayaran harus lebih dari 0.";
    header("Location: checkout_page.php");
    exit;
}

if (empty($nama_customer)) {
    $_SESSION['error'] = "Nama customer harus diisi.";
    header("Location: checkout_page.php");
    exit;
}

if (empty($alamat_customer)) {
    $_SESSION['error'] = "Alamat customer harus diisi.";
    header("Location: checkout_page.php");
    exit;
}

// Hitung total bayar dari keranjang
$totalBayar = 0;
foreach ($keranjang as $item) {
    $totalBayar += $item['harga'] * $item['jumlah'];
}

// Cek cukup bayar
if ($bayar < $totalBayar) {
    $_SESSION['error'] = "Pembayaran tidak cukup, total bayar Rp " . number_format($totalBayar,0,',','.');
    header("Location: checkout_page.php");
    exit;
}

$kembalian = $bayar - $totalBayar;
$username = $_SESSION['username'];
$waktu = date('Y-m-d H:i:s');

// Mulai transaksi database
mysqli_autocommit($db, false);

try {

    // Insert ke tabel transaksi (menggunakan struktur tabel yang sudah ada)
    $nama_customer_escaped = mysqli_real_escape_string($db, $nama_customer);
    $alamat_customer_escaped = mysqli_real_escape_string($db, $alamat_customer);
    $username_escaped = mysqli_real_escape_string($db, $username);

    $query = "INSERT INTO transaksi (username, total, bayar, kembalian, waktu) VALUES ('$username_escaped', $totalBayar, $bayar, $kembalian, '$waktu')";
    $result = mysqli_query($db, $query);

    if (!$result) {
        throw new Exception("Gagal menyimpan transaksi: " . mysqli_error($db));
    }

    $id_transaksi = mysqli_insert_id($db);

    // Insert detail transaksi + update stok
    foreach ($keranjang as $item) {
        $subtotal = $item['harga'] * $item['jumlah'];
        $id_menu = (int)$item['id_menu'];
        $jumlah = (int)$item['jumlah'];
        $harga = (int)$item['harga'];
        $nama_menu_escaped = mysqli_real_escape_string($db, $item['nama']);

        // Insert detail transaksi
        $queryDetail = "INSERT INTO transaksi_detail (id_transaksi, id_menu, jumlah, subtotal) VALUES ($id_transaksi, $id_menu, $jumlah, $subtotal)";
        $resultDetail = mysqli_query($db, $queryDetail);

        if (!$resultDetail) {
            throw new Exception("Gagal menyimpan detail transaksi: " . mysqli_error($db));
        }

        // Update stok - cek dulu stok tersedia
        $checkStok = "SELECT stok FROM menu WHERE id_menu = $id_menu";
        $resultCheck = mysqli_query($db, $checkStok);
        $menuData = mysqli_fetch_assoc($resultCheck);

        if (!$menuData || $menuData['stok'] < $jumlah) {
            throw new Exception("Stok menu '{$item['nama']}' tidak cukup. Stok tersedia: " . ($menuData['stok'] ?? 0));
        }

        // Update stok
        $updateStok = "UPDATE menu SET stok = stok - $jumlah WHERE id_menu = $id_menu";
        $resultUpdate = mysqli_query($db, $updateStok);

        if (!$resultUpdate) {
            throw new Exception("Gagal update stok menu: " . mysqli_error($db));
        }
    }

    // Simpan log aktivitas (jika tabel ada)
    try {
        $log = "Melakukan transaksi dengan total Rp " . number_format($totalBayar, 0, ',', '.');
        $log_escaped = mysqli_real_escape_string($db, $log);
        $queryLog = "INSERT INTO log_activity (username, aktivitas) VALUES ('$username_escaped', '$log_escaped')";
        mysqli_query($db, $queryLog);
    } catch (Exception $e) {
        // Log activity gagal tidak masalah, lanjut saja
    }

    // Commit transaksi
    mysqli_commit($db);

    // Simpan data transaksi untuk success.php
    $_SESSION['transaksi_success'] = [
        'id' => $id_transaksi,
        'total_bayar' => $totalBayar,
        'bayar' => $bayar,
        'kembalian' => $kembalian,
        'tanggal' => $waktu,
        'nama_customer' => $nama_customer,
        'alamat_customer' => $alamat_customer,
        'items' => $keranjang
    ];

    // Bersihkan keranjang
    unset($_SESSION['keranjang']);

    // Redirect ke halaman success
    header("Location: success.php");
    exit;

} catch (Exception $e) {
    mysqli_rollback($db);
    $_SESSION['error'] = "Transaksi gagal: " . $e->getMessage();
    header("Location: checkout_page.php");
    exit;
}

// Restore autocommit
mysqli_autocommit($db, true);
?>
