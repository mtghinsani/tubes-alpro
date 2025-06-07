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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_quantity'])) {
        $id_menu = $_POST['id_menu'];
        $jumlah_baru = max(1, (int)$_POST['jumlah']);

        foreach ($keranjang as &$item) {
            if ($item['id_menu'] == $id_menu) {
                $item['jumlah'] = $jumlah_baru;
                break;
            }
        }
        $_SESSION['keranjang'] = $keranjang;
        header("Location: cart.php");
        exit;
    }

    if (isset($_POST['hapus_item'])) {
        $id_menu = $_POST['id_menu'];
        $keranjang = array_filter($keranjang, fn($i) => $i['id_menu'] != $id_menu);
        $_SESSION['keranjang'] = $keranjang;
        header("Location: cart.php");
        exit;
    }
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
<title>Keranjang Belanja - CoffeeRight</title>
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
                    <i class="bi bi-cart3"></i> Keranjang Belanja
                </h1>
                <a href="../dashboard.php" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center gap-2">
                    <i class="bi bi-house-door"></i> Kembali ke Dashboard
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

        <?php if (empty($keranjang)): ?>
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <i class="bi bi-cart-x text-6xl text-gray-400 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">Keranjang Kosong</h3>
                <p class="text-gray-500 mb-6">Belum ada item di keranjang Anda. Yuk mulai berbelanja!</p>
                <a href="../dashboard.php" class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 inline-flex items-center gap-2">
                    <i class="bi bi-shop"></i> Mulai Belanja
                </a>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="gradient-bg text-white">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Nama Menu</th>
                                <th class="px-6 py-4 text-left font-semibold">Harga</th>
                                <th class="px-6 py-4 text-center font-semibold">Jumlah</th>
                                <th class="px-6 py-4 text-right font-semibold">Subtotal</th>
                                <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($keranjang as $item): ?>
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-800"><?= htmlspecialchars($item['nama']) ?></div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="cart.php" method="post" class="flex items-center justify-center gap-2">
                                        <input type="hidden" name="id_menu" value="<?= $item['id_menu'] ?>">
                                        <input type="number" name="jumlah" value="<?= $item['jumlah'] ?>" min="1"
                                               class="w-16 px-3 py-2 border border-gray-300 rounded-lg text-center focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                        <button type="submit" name="update_quantity"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg transition duration-300"
                                                title="Update Jumlah">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-right font-semibold text-gray-800">
                                    Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="cart.php" method="post" onsubmit="return confirm('Yakin mau hapus item ini?')">
                                        <input type="hidden" name="id_menu" value="<?= $item['id_menu'] ?>">
                                        <button type="submit" name="hapus_item"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg transition duration-300"
                                                title="Hapus Item">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="bg-gray-50">
                                <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-800">Total Bayar</td>
                                <td colspan="2" class="px-6 py-4 text-right font-bold text-2xl text-purple-600">
                                    Rp <?= number_format($totalBayar, 0, ',', '.') ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="text-center mt-8">
                <div class="flex gap-4 justify-center">
                    <a href="../dashboard.php"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 inline-flex items-center gap-2">
                        <i class="bi bi-arrow-left"></i> Lanjut Belanja
                    </a>
                    <a href="checkout_page.php"
                       class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition duration-300 transform hover:scale-105 inline-flex items-center gap-3 shadow-lg <?= $totalBayar == 0 ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' ?>">
                        <i class="bi bi-credit-card text-xl"></i> Checkout Sekarang
                    </a>
                </div>
            </div>
    <?php endif; ?>
    </div>


</body>
</html>
