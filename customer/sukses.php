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
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Transaksi Berhasil - CoffeeRight</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .success-animation {
        animation: bounce 1s ease-in-out;
    }
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
</style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="gradient-bg text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <div class="success-animation">
                <i class="bi bi-check-circle-fill text-6xl text-green-300 mb-4"></i>
            </div>
            <h1 class="text-4xl font-bold mb-2">Transaksi Berhasil!</h1>
            <p class="text-xl opacity-90">Terima kasih sudah berbelanja di CoffeeRight</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">

        <div class="max-w-2xl mx-auto">
            <!-- Receipt Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-green-500 text-white p-6 text-center">
                    <i class="bi bi-receipt text-3xl mb-2"></i>
                    <h3 class="text-xl font-bold">Struk Pembayaran</h3>
                </div>

                <div class="p-6">
                    <!-- Customer Info -->
                    <div class="border-b border-gray-200 pb-4 mb-4">
                        <h4 class="font-semibold text-gray-800 mb-3">
                            <i class="bi bi-person-circle mr-2"></i>Data Customer
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">Nama:</span>
                                <div class="font-semibold"><?= htmlspecialchars($transaksi['nama_customer']) ?></div>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Alamat:</span>
                                <div class="font-semibold"><?= htmlspecialchars($transaksi['alamat_customer']) ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Transaction Details -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">
                                <i class="bi bi-calculator mr-2"></i>Total Belanja
                            </span>
                            <span class="font-semibold text-lg">Rp <?= number_format($transaksi['total'], 0, ',', '.') ?></span>
                        </div>

                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">
                                <i class="bi bi-cash mr-2"></i>Jumlah Bayar
                            </span>
                            <span class="font-semibold text-lg">Rp <?= number_format($transaksi['bayar'], 0, ',', '.') ?></span>
                        </div>

                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">
                                <i class="bi bi-arrow-return-left mr-2"></i>Kembalian
                            </span>
                            <span class="font-semibold text-lg text-green-600">Rp <?= number_format($transaksi['kembalian'], 0, ',', '.') ?></span>
                        </div>

                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">
                                <i class="bi bi-clock mr-2"></i>Waktu Transaksi
                            </span>
                            <span class="font-semibold"><?= htmlspecialchars($transaksi['waktu']) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-8 space-y-4">
                <a href="../dashboard.php"
                   class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition duration-300 transform hover:scale-105 inline-flex items-center gap-3 shadow-lg">
                    <i class="bi bi-house-door"></i> Kembali ke Dashboard
                </a>

                <div>
                    <button onclick="window.print()"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 inline-flex items-center gap-2">
                        <i class="bi bi-printer"></i> Cetak Struk
                    </button>
                </div>
            </div>
        </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
