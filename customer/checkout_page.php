<?php
session_start();
require '../config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../index.php");
    exit;
}

$keranjang = $_SESSION['keranjang'] ?? [];
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

if (empty($keranjang)) {
    header("Location: cart.php");
    exit;
}

$totalBayar = 0;
foreach ($keranjang as $item) {
    $totalBayar += $item['harga'] * $item['jumlah'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Checkout - CoffeeRight</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
</style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="gradient-bg text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold">
                    <i class="bi bi-credit-card"></i> Checkout
                </h1>
                <a href="cart.php" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Keranjang
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center">
                    <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Order Summary -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="bi bi-list-check mr-2"></i>Ringkasan Pesanan
                </h3>
                
                <div class="space-y-4">
                    <?php foreach ($keranjang as $item): ?>
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <div>
                            <div class="font-semibold text-gray-800"><?= htmlspecialchars($item['nama']) ?></div>
                            <div class="text-sm text-gray-500">Qty: <?= $item['jumlah'] ?> × Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
                        </div>
                        <div class="font-semibold text-gray-800">
                            Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <div class="flex justify-between items-center py-4 border-t-2 border-purple-200">
                        <div class="text-xl font-bold text-gray-800">Total Bayar</div>
                        <div class="text-2xl font-bold text-purple-600">
                            Rp <?= number_format($totalBayar, 0, ',', '.') ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkout Form -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6">
                    <i class="bi bi-person-plus mr-2"></i>Data Customer & Pembayaran
                </h3>

                <form action="checkout.php" method="POST" class="space-y-6">
                    <!-- Customer Data -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-700 border-b border-gray-200 pb-2">
                            <i class="bi bi-person mr-2"></i>Informasi Customer
                        </h4>
                        
                        <div>
                            <label for="nama_customer" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Customer *
                            </label>
                            <input type="text" id="nama_customer" name="nama_customer" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-300"
                                   placeholder="Masukkan nama customer">
                        </div>
                        
                        <div>
                            <label for="alamat_customer" class="block text-sm font-semibold text-gray-700 mb-2">
                                Alamat Customer *
                            </label>
                            <textarea id="alamat_customer" name="alamat_customer" required rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-300"
                                      placeholder="Masukkan alamat lengkap customer"></textarea>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-700 border-b border-gray-200 pb-2">
                            <i class="bi bi-cash mr-2"></i>Pembayaran
                        </h4>
                        
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-700">Total yang harus dibayar:</span>
                                <span class="text-2xl font-bold text-purple-600">Rp <?= number_format($totalBayar, 0, ',', '.') ?></span>
                            </div>
                        </div>
                        
                        <div>
                            <label for="bayar" class="block text-sm font-semibold text-gray-700 mb-2">
                                Jumlah Pembayaran *
                            </label>
                            <input type="number" min="<?= $totalBayar ?>" id="bayar" name="bayar" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-300"
                                   placeholder="Minimal Rp <?= number_format($totalBayar, 0, ',', '.') ?>">
                            <div class="text-sm text-gray-500 mt-2">
                                <i class="bi bi-info-circle mr-1"></i>Masukkan jumlah uang yang dibayarkan customer
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-6">
                        <a href="cart.php" 
                           class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-3 px-6 rounded-lg font-semibold transition duration-300 text-center">
                            <i class="bi bi-arrow-left mr-2"></i>Kembali
                        </a>
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-3 px-6 rounded-lg font-semibold transition duration-300">
                            <i class="bi bi-check-circle mr-2"></i>Bayar Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-focus pada input nama customer
        document.getElementById('nama_customer').focus();

        // Format input pembayaran
        document.getElementById('bayar').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            if (value) {
                e.target.value = parseInt(value);
            }
        });
    </script>
</body>
</html>
