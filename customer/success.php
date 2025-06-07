<?php
session_start();
require '../config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../index.php");
    exit;
}

// Ambil data transaksi terakhir dari session
$transaksi_data = $_SESSION['transaksi_success'] ?? null;
if (!$transaksi_data) {
    header("Location: cart.php");
    exit;
}

// Hapus data transaksi dari session setelah ditampilkan
unset($_SESSION['transaksi_success']);
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
    .print-hidden {
        @media print {
            display: none !important;
        }
    }
    @media print {
        body { background: white !important; }
        .gradient-bg { background: #667eea !important; }
    }
</style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="gradient-bg text-white py-8 print-hidden">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold">
                    <i class="bi bi-check-circle-fill text-green-300"></i> Transaksi Berhasil
                </h1>
                <div class="flex gap-3">
                    <button onclick="window.print()" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center gap-2">
                        <i class="bi bi-printer"></i> Print Struk
                    </button>
                    <a href="../dashboard.php" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center gap-2">
                        <i class="bi bi-house-door"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Success Message -->
        <div class="bg-green-50 border border-green-200 rounded-xl p-8 mb-8 text-center success-animation">
            <i class="bi bi-check-circle-fill text-6xl text-green-500 mb-4"></i>
            <h2 class="text-3xl font-bold text-green-800 mb-2">Pembayaran Berhasil!</h2>
            <p class="text-green-600 text-lg">Terima kasih atas pembelian Anda di CoffeeRight</p>
        </div>

        <!-- Receipt -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-2xl mx-auto">
            <!-- Receipt Header -->
            <div class="gradient-bg text-white p-6 text-center">
                <h3 class="text-2xl font-bold mb-2">
                    <i class="bi bi-cup-hot"></i> CoffeeRight
                </h3>
                <p class="text-purple-100">Struk Pembayaran</p>
                <div class="text-sm text-purple-100 mt-2">
                    Tanggal: <?= date('d/m/Y H:i:s', strtotime($transaksi_data['tanggal'])) ?>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="p-6 border-b border-gray-200">
                <h4 class="font-bold text-gray-800 mb-3">
                    <i class="bi bi-person mr-2"></i>Informasi Customer
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="text-sm text-gray-500">Nama Customer</div>
                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($transaksi_data['nama_customer']) ?></div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Alamat</div>
                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($transaksi_data['alamat_customer']) ?></div>
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="p-6">
                <h4 class="font-bold text-gray-800 mb-4">
                    <i class="bi bi-list-check mr-2"></i>Detail Pesanan
                </h4>
                
                <div class="space-y-3">
                    <?php foreach ($transaksi_data['items'] as $item): ?>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <div>
                            <div class="font-semibold text-gray-800"><?= htmlspecialchars($item['nama']) ?></div>
                            <div class="text-sm text-gray-500">
                                <?= $item['jumlah'] ?> × Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                            </div>
                        </div>
                        <div class="font-semibold text-gray-800">
                            Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Payment Summary -->
                <div class="mt-6 pt-4 border-t-2 border-gray-200">
                    <div class="space-y-2">
                        <div class="flex justify-between text-lg">
                            <span class="font-semibold text-gray-700">Total Belanja</span>
                            <span class="font-semibold text-gray-800">Rp <?= number_format($transaksi_data['total_bayar'], 0, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between text-lg">
                            <span class="font-semibold text-gray-700">Bayar</span>
                            <span class="font-semibold text-gray-800">Rp <?= number_format($transaksi_data['bayar'], 0, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between text-xl border-t pt-2">
                            <span class="font-bold text-gray-800">Kembalian</span>
                            <span class="font-bold text-green-600">Rp <?= number_format($transaksi_data['kembalian'], 0, ',', '.') ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 p-6 text-center">
                <p class="text-gray-600 mb-2">Terima kasih telah berbelanja di CoffeeRight!</p>
                <p class="text-sm text-gray-500">Semoga hari Anda menyenangkan ☕</p>
                <div class="mt-4 text-xs text-gray-400">
                    ID Transaksi: #<?= str_pad($transaksi_data['id'], 6, '0', STR_PAD_LEFT) ?>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center mt-8 print-hidden">
            <div class="flex gap-4 justify-center">
                <a href="cart.php" 
                   class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 inline-flex items-center gap-2">
                    <i class="bi bi-cart-plus"></i> Belanja Lagi
                </a>
                <a href="../dashboard.php" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 inline-flex items-center gap-2">
                    <i class="bi bi-house-door"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <script>
        // Auto-focus untuk kemudahan navigasi
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll ke atas halaman
            window.scrollTo(0, 0);
            
            // Hapus keranjang dari localStorage jika ada
            if (typeof(Storage) !== "undefined") {
                localStorage.removeItem('cart');
            }
        });

        // Shortcut keyboard untuk print
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'p') {
                e.preventDefault();
                window.print();
            }
        });
    </script>
</body>
</html>
