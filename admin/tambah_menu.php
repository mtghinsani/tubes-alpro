<?php
session_start();
require '../config.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_menu = htmlspecialchars($_POST['nama_menu']);
    $category = htmlspecialchars($_POST['category']);
    $harga = (int) $_POST['harga'];
    $stok = (int) $_POST['stok'];

    // upload gambar
    $gambar = $_FILES['gambar'];

    $gambar_name = '';
    if ($gambar['error'] === 0) {
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed_ext)) {
            $gambar_name = uniqid() . "." . $ext;
            move_uploaded_file($gambar['tmp_name'], "../uploads/" . $gambar_name);
        } else {
            $error = "Format gambar tidak didukung. Gunakan jpg, jpeg, png, atau gif.";
        }
    } else {
        $error = "Gagal upload gambar.";
    }

    if (!isset($error)) {
        $query = "INSERT INTO menu (nama, category, harga, gambar, stok) VALUES ('$nama_menu', '$category', $harga, '$gambar_name', $stok)";
        if (mysqli_query($db, $query)) {
            $success = "Menu berhasil ditambahkan!";
        } else {
            $error = "Gagal menambahkan menu: " . mysqli_error($db);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Tambah Menu - Admin</title>
    <link href="../bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet" />
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
                    <h3 class="card-title mb-4 text-center">Tambah Menu Kopi</h3>

                    <?php if (isset($success)) : ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" id="nama_menu" name="nama_menu" class="form-control" placeholder="Nama Menu" required />
                            <label for="nama_menu">Nama Menu</label>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select id="category" name="category" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                <option value="coffee">Coffee</option>
                                <option value="non-coffee">Non Coffee</option>
                                <option value="tea">Tea</option>
                                <option value="snacks">Snacks</option>
                                <option value="desserts">Desserts</option>
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" id="harga" name="harga" class="form-control" placeholder="Harga" min="1" required />
                            <label for="harga">Harga (Rp)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" id="stok" name="stok" class="form-control" placeholder="Stok" min="0" required />
                            <label for="stok">Stok</label>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Menu</label>
                            <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*" required />
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="../dashboard.php" class="btn btn-outline-secondary"><i class="bi bi-house-door"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary">Tambah Menu</button>
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