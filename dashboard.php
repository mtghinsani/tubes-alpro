<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$role = $_SESSION['role'];
$username = $_SESSION['username'];
$nama_lengkap = $_SESSION['nama_lengkap'];

if ($role !== 'admin' && $role !== 'customer') {
    session_destroy();
    header("Location: index.php");
    exit;
}

$menus = mysqli_query($db, "SELECT * FROM menu");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Dashboard CoffeeRight</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">CoffeeRight</a>
    <div class="d-flex">
      <span class="navbar-text text-white me-3">Hai, <?= htmlspecialchars($nama_lengkap) ?> (<?= htmlspecialchars($role) ?>)</span>
      <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h4>Menu Kopi</h4>
    <?php if ($role === 'admin'): ?>
        <a href="admin/tambah_menu.php" class="btn btn-success mb-3">+ Tambah Menu</a>
         <a href="admin/log_activity.php" class="btn btn-warning mb-3">
            <i class="bi bi-search"></i> Aktivitas
        </a>
    <?php endif; ?>
    <?php if ($role === 'customer'): ?>
    <div class="justify-content-end mb-3">
        <a href="customer/cart.php" class="btn btn-warning">
            <i class="bi bi-cart"></i> Lihat Keranjang
        </a>
    </div>
    <?php endif; ?>
    
    <div class="row">
        <?php while ($menu = mysqli_fetch_assoc($menus)): ?>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <?php if ($menu['gambar']): ?>
                        <img src="uploads/<?= htmlspecialchars($menu['gambar']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Menu">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($menu['nama']) ?></h5>
                        <p class="card-text">Harga: Rp <?= number_format($menu['harga'], 0, ',', '.') ?></p>
                        <p class="card-text">Stok: <?= (int)$menu['stok'] ?></p>

                        <?php if ($role === 'customer'): ?>
                            <form action="customer/add_to_cart.php" method="POST">
                                <input type="hidden" name="id_menu" value="<?= $menu['id_menu'] ?>" />
                                <button type="submit" class="btn btn-success" <?= ((int)$menu['stok'] <= 0) ? 'disabled' : '' ?>>
                                    Tambah ke Keranjang
                                </button>
                            </form>
                        <?php elseif ($role === 'admin'): ?>
                            <div class="d-flex justify-content-between">
                                <a href="admin/edit_menu.php?id=<?= $menu['id_menu'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="admin/hapus_menu.php?id=<?= $menu['id_menu'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
