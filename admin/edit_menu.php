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

$id = $_GET['id'];
$query = mysqli_query($db, "SELECT * FROM menu WHERE id_menu = $id");
$menu = mysqli_fetch_assoc($query);

if (!$menu) {
    echo "Menu tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $category = htmlspecialchars($_POST['category']);
    $harga = (int)$_POST['harga'];
    $stok = (int)$_POST['stok'];

    // handle up gambar baru
    if ($_FILES['gambar']['error'] === 0) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, '../uploads/' . $gambar);
    } else {
        $gambar = $menu['gambar'];
    }

    $update = mysqli_query($db, "UPDATE menu SET
        nama = '$nama',
        category = '$category',
        harga = $harga,
        stok = $stok,
        gambar = '$gambar'
        WHERE id_menu = $id");

    if ($update) {
        header("Location: ../dashboard.php");
        exit;
    } else {
        echo "Gagal update menu.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu</title>
    <link href="../bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow rounded-4">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4 text-center">Edit Menu Kopi</h3>
                    
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Menu" required value="<?= htmlspecialchars($menu['nama']) ?>">
                            <label for="nama">Nama Menu</label>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select id="category" name="category" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                <option value="coffee" <?= ($menu['category'] === 'coffee') ? 'selected' : '' ?>>Coffee</option>
                                <option value="non-coffee" <?= ($menu['category'] === 'non-coffee') ? 'selected' : '' ?>>Non Coffee</option>
                                <option value="tea" <?= ($menu['category'] === 'tea') ? 'selected' : '' ?>>Tea</option>
                                <option value="snacks" <?= ($menu['category'] === 'snacks') ? 'selected' : '' ?>>Snacks</option>
                                <option value="desserts" <?= ($menu['category'] === 'desserts') ? 'selected' : '' ?>>Desserts</option>
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" required value="<?= (int)$menu['harga'] ?>">
                            <label for="harga">Harga (Rp)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok" required value="<?= (int)$menu['stok'] ?>">
                            <label for="stok">Stok</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini</label><br>
                            <?php if ($menu['gambar']): ?>
                                <img src="../uploads/<?= $menu['gambar'] ?>" width="120" class="mb-2 rounded"><br>
                            <?php else: ?>
                                <p class="text-muted">Belum ada gambar</p>
                            <?php endif; ?>
                            <input type="file" class="form-control mt-2" name="gambar" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="../dashboard.php" class="btn btn-danger"><i class="bi bi-x"></i> Batal</a>
                            <button type="submit" class="btn btn-primary">Update Menu</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="../bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
