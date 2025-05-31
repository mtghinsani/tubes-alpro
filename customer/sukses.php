<?php
session_start();
require '../config.php';

if (!isset($_SESSION['transaksi_berhasil'])) {
    header("Location: ../dashboard.php");
    exit;
}

$transaksi = $_SESSION['transaksi_berhasil'];
unset($_SESSION['transaksi_berhasil']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Transaksi Berhasil</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <div class="alert alert-success text-center">
        <h3>Transaksi Berhasil!</h3>
        <p>Terima kasih sudah berbelanja di CoffeeShop.</p>
    </div>

    <table class="table table-bordered w-50 mx-auto">
        <tr>
            <th>Total</th>
            <td>Rp <?= number_format($transaksi['total'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Bayar</th>
            <td>Rp <?= number_format($transaksi['bayar'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Kembalian</th>
            <td>Rp <?= number_format($transaksi['kembalian'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Waktu</th>
            <td><?= htmlspecialchars($transaksi['waktu']) ?></td>
        </tr>
    </table>

    <div class="text-center mt-4">
        <a href="../dashboard.php" class="btn btn-primary">Kembali ke Dashboard</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
