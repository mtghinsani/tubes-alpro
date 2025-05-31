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

// Ambil data bayar dari POST
$bayar = isset($_POST['bayar']) ? (int)str_replace(['.', ','], '', $_POST['bayar']) : 0;

if ($bayar <= 0) {
    $_SESSION['error'] = "Input pembayaran harus lebih dari 0.";
    header("Location: ../customer/cart.php");
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
    header("Location: ../customer/cart.php");
    exit;
}

$kembalian = $bayar - $totalBayar;
$username = $_SESSION['username'];
$waktu = date('Y-m-d H:i:s');

// Mulai transaksi MySQL biar aman
mysqli_begin_transaction($db);

try {
    // Insert ke tabel transaksi
    $query = "INSERT INTO transaksi (username, total, bayar, kembalian, waktu) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "siiis", $username, $totalBayar, $bayar, $kembalian, $waktu);
    mysqli_stmt_execute($stmt);
    $id_transaksi = mysqli_insert_id($db);
    mysqli_stmt_close($stmt);

    // Insert detail transaksi + update stok
    foreach ($keranjang as $item) {
        $subtotal = $item['harga'] * $item['jumlah'];
        $id_menu = $item['id_menu'];
        $jumlah = $item['jumlah'];

        // Insert detail transaksi
        $queryDetail = "INSERT INTO transaksi_detail (id_transaksi, id_menu, jumlah, subtotal) VALUES (?, ?, ?, ?)";
        $stmtDetail = mysqli_prepare($db, $queryDetail);
        mysqli_stmt_bind_param($stmtDetail, "iiii", $id_transaksi, $id_menu, $jumlah, $subtotal);
        mysqli_stmt_execute($stmtDetail);
        mysqli_stmt_close($stmtDetail);

        // Update stok
        $updateStok = "UPDATE menu SET stok = stok - ? WHERE id_menu = ? AND stok >= ?";
        $stmtStok = mysqli_prepare($db, $updateStok);
        mysqli_stmt_bind_param($stmtStok, "iii", $jumlah, $id_menu, $jumlah);
        mysqli_stmt_execute($stmtStok);

        // Cek apakah stok cukup (jumlah baris terpengaruh)
        if (mysqli_stmt_affected_rows($stmtStok) == 0) {
            throw new Exception("Stok menu dengan ID $id_menu tidak cukup.");
        }
        mysqli_stmt_close($stmtStok);
    }

    // Simpan log aktivitas
    $log = "Melakukan transaksi dengan total Rp " . number_format($totalBayar, 0, ',', '.');
    $queryLog = "INSERT INTO log_activity (username, aktivitas) VALUES (?, ?)";
    $stmtLog = mysqli_prepare($db, $queryLog);
    mysqli_stmt_bind_param($stmtLog, "ss", $username, $log);
    mysqli_stmt_execute($stmtLog);
    mysqli_stmt_close($stmtLog);

    // Commit transaksi
    mysqli_commit($db);

    // Simpan data transaksi buat sukses.php
    $_SESSION['transaksi_berhasil'] = [
        'total' => $totalBayar,
        'bayar' => $bayar,
        'kembalian' => $kembalian,
        'waktu' => $waktu
    ];

    // Bersihkan keranjang
    unset($_SESSION['keranjang']);

    // Redirect ke sukses
    header("Location: sukses.php");
    exit;

} catch (Exception $e) {
    mysqli_rollback($db);
    $_SESSION['error'] = "Transaksi gagal: " . $e->getMessage();
    header("Location: cart.php");
    exit;
}
?>
