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
<title>Keranjang Belanja</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h3>Keranjang Belanja</h3>
    <div class="mb-3">
        <a href="../dashboard.php" class="btn btn-secondary">
            <i class="bi bi-house-door"></i> Kembali ke Dashboard
        </a>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (empty($keranjang)): ?>
        <div class="alert alert-info">Keranjangnya kosong wak.</div>
    <?php else: ?>
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($keranjang as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['nama']) ?></td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td>
                        <form action="cart.php" method="post" class="d-flex align-items-center">
                            <input type="hidden" name="id_menu" value="<?= $item['id_menu'] ?>">
                            <input type="number" name="jumlah" value="<?= $item['jumlah'] ?>" min="1" class="form-control me-2" style="width:80px;">
                            <button type="submit" name="update_quantity" class="btn btn-sm btn-primary" title="Update Jumlah">
                                <i class="bi bi-arrow-repeat"></i>
                            </button>
                        </form>
                    </td>
                    <td>Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></td>
                    <td>
                        <form action="cart.php" method="post" onsubmit="return confirm('Yakin mau hapus item ini?')">
                            <input type="hidden" name="id_menu" value="<?= $item['id_menu'] ?>">
                            <button type="submit" name="hapus_item" class="btn btn-sm btn-danger" title="Hapus Item">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total Bayar</td>
                    <td colspan="2" class="fw-bold">Rp <?= number_format($totalBayar, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Tombol Checkout -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkoutModal" <?= $totalBayar == 0 ? 'disabled' : '' ?>>
            Checkout
        </button>

        <!-- Modal Pembayaran -->
        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="checkout.php" method="POST" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Total bayar: <strong>Rp <?= number_format($totalBayar, 0, ',', '.') ?></strong></p>
                        <div class="mb-3">
                            <label for="bayar" class="form-label">Masukkan jumlah pembayaran</label>
                            <input type="number" min="<?= $totalBayar ?>" class="form-control" id="bayar" name="bayar" required placeholder="Minimal Rp <?= number_format($totalBayar, 0, ',', '.') ?>">
                            <div class="form-text">Masukkan uang customer (minimal total bayar)</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Bayar & Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
