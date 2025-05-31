<?php
session_start();
require '../config.php'; 

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_menu = htmlspecialchars($_POST['nama_menu']);
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
        $query = "INSERT INTO menu (nama, harga, gambar, stok) VALUES ('$nama_menu', $harga, '$gambar_name', $stok)";
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
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Menu Kopi</h2>
    <a href="../dashboard.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

    <?php if (isset($success)) : ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data" class="w-50">
        <div class="mb-3">
            <label for="nama_menu" class="form-label">Nama Menu</label>
            <input type="text" id="nama_menu" name="nama_menu" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga (Rp)</label>
            <input type="number" id="harga" name="harga" class="form-control" min="1" required />
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" id="stok" name="stok" class="form-control" min="0" required />
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Menu</label>
            <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*" required />
        </div>
        <button type="submit" class="btn btn-primary">Tambah Menu</button>
    </form>
</div>
<script src="../bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
