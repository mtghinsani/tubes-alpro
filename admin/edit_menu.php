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
</head>
<body>
<div class="container mt-5">
    <h3>Edit Menu Kopi</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="nama" name="nama" required value="<?= htmlspecialchars($menu['nama']) ?>">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required value="<?= (int)$menu['harga'] ?>">
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" required value="<?= (int)$menu['stok'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini</label><br>
            <?php if ($menu['gambar']): ?>
                <img src="../uploads/<?= $menu['gambar'] ?>" width="120" class="mb-2"><br>
            <?php else: ?>
                <p class="text-muted">Belum ada gambar</p>
            <?php endif; ?>
            <input type="file" class="form-control" name="gambar">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
        </div>
        <button type="submit" class="btn btn-primary">Update Menu</button>
        <a href="../dashboard.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
