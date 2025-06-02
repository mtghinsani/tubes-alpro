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

// Handle search, category filter, and sorting
$search = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';
$category = isset($_GET['category']) ? mysqli_real_escape_string($db, $_GET['category']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'nama_asc';

// Build query with filters
$query = "SELECT * FROM menu WHERE 1=1";

if (!empty($search)) {
    $query .= " AND nama LIKE '%$search%'";
}

if (!empty($category) && $category !== 'all') {
    $query .= " AND category = '$category'";
}

// Add sorting
switch ($sort) {
    case 'nama_asc':
        $query .= " ORDER BY nama ASC";
        break;
    case 'nama_desc':
        $query .= " ORDER BY nama DESC";
        break;
    case 'harga_asc':
        $query .= " ORDER BY harga ASC";
        break;
    case 'harga_desc':
        $query .= " ORDER BY harga DESC";
        break;
    case 'stok_asc':
        $query .= " ORDER BY stok ASC";
        break;
    case 'stok_desc':
        $query .= " ORDER BY stok DESC";
        break;
    default:
        $query .= " ORDER BY nama ASC";
}

$menus = mysqli_query($db, $query);

// Check if query was successful
if (!$menus) {
    die("Error in menu query: " . mysqli_error($db));
}

// Get categories for filter menu
$categories_query = mysqli_query($db, "SELECT DISTINCT category FROM menu WHERE category IS NOT NULL AND category != ''");
$categories = [];
if ($categories_query) {
    while ($cat = mysqli_fetch_assoc($categories_query)) {
        $categories[] = $cat['category'];
    }
} else {
    // If categories query fails, provide default categories
    $categories = ['coffee', 'tea', 'snacks', 'desserts'];
}

include 'template/navbar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Dashboard CoffeeRight</title>
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
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .filter-active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
</style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="gradient-bg text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                ☕ Menu <span class="text-yellow-300">CoffeeRight</span>
            </h1>
            <p class="text-xl md:text-2xl opacity-90">Nikmati kopi terbaik dengan cita rasa yang sempurna</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Admin Controls -->
        <?php if ($role === 'admin'): ?>
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Panel Admin</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="admin/tambah_menu.php" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center gap-2">
                        <i class="bi bi-plus-circle"></i> Tambah Menu
                    </a>
                    <a href="admin/log_activity.php" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center gap-2">
                        <i class="bi bi-activity"></i> Log Aktivitas
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Filters and Search Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex flex-col lg:flex-row gap-6 items-center">
                <!-- Search Bar -->
                <div class="flex-1 w-full">
                    <form method="GET" class="relative">
                        <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
                        <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
                        <input
                            type="text"
                            name="search"
                            value="<?= htmlspecialchars($search) ?>"
                            placeholder="Cari menu favorit Anda..."
                            class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-300"
                        >
                        <i class="bi bi-search absolute left-4 top-4 text-gray-400"></i>
                        <button type="submit" class="absolute right-2 top-2 bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg transition duration-300">
                            Cari
                        </button>
                    </form>
                </div>

                <!-- Category Filter -->
                <div class="flex flex-wrap gap-2">
                    <a href="?search=<?= urlencode($search) ?>&sort=<?= urlencode($sort) ?>"
                       class="px-4 py-2 rounded-lg font-medium transition duration-300 <?= empty($category) || $category === 'all' ? 'filter-active' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' ?>">
                        Semua
                    </a>
                    <?php foreach ($categories as $cat): ?>
                        <a href="?search=<?= urlencode($search) ?>&category=<?= urlencode($cat) ?>&sort=<?= urlencode($sort) ?>"
                           class="px-4 py-2 rounded-lg font-medium transition duration-300 <?= $category === $cat ? 'filter-active' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' ?>">
                            <?= htmlspecialchars(ucfirst($cat)) ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <!-- Sort Dropdown -->
                <div class="relative">
                    <select name="sort" onchange="updateSort(this.value)" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white">
                        <option value="nama_asc" <?= $sort === 'nama_asc' ? 'selected' : '' ?>>Nama A-Z</option>
                        <option value="nama_desc" <?= $sort === 'nama_desc' ? 'selected' : '' ?>>Nama Z-A</option>
                        <option value="harga_asc" <?= $sort === 'harga_asc' ? 'selected' : '' ?>>Harga Terendah</option>
                        <option value="harga_desc" <?= $sort === 'harga_desc' ? 'selected' : '' ?>>Harga Tertinggi</option>
                        <option value="stok_desc" <?= $sort === 'stok_desc' ? 'selected' : '' ?>>Stok Terbanyak</option>
                        <option value="stok_asc" <?= $sort === 'stok_asc' ? 'selected' : '' ?>>Stok Tersedikit</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php
        $menu_count = 0;
        while ($menu = mysqli_fetch_assoc($menus)):
            $menu_count++;
        ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover group">
                <!-- Product Image -->
                <div class="relative overflow-hidden">
                    <?php if ($menu['gambar']): ?>
                        <img src="uploads/<?= htmlspecialchars($menu['gambar']) ?>" alt="<?= htmlspecialchars($menu['nama']) ?>" class="w-full h-56 object-cover group-hover:scale-110 transition duration-500">
                    <?php else: ?>
                        <div class="w-full h-56 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <i class="bi bi-cup-hot text-6xl text-gray-400"></i>
                        </div>
                    <?php endif; ?>

                    <!-- Stock Badge -->
                    <div class="absolute top-4 right-4">
                        <?php if ((int)$menu['stok'] > 10): ?>
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Tersedia</span>
                        <?php elseif ((int)$menu['stok'] > 0): ?>
                            <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Terbatas</span>
                        <?php else: ?>
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Habis</span>
                        <?php endif; ?>
                    </div>

                    <!-- Category Badge -->
                    <?php if (!empty($menu['category'])): ?>
                        <div class="absolute top-4 left-4">
                            <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                <?= htmlspecialchars(ucfirst($menu['category'])) ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Product Info -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-purple-600 transition duration-300">
                        <?= htmlspecialchars($menu['nama']) ?>
                    </h3>

                    <div class="flex items-center justify-between mb-4">
                        <div class="text-2xl font-bold text-purple-600">
                            Rp <?= number_format($menu['harga'], 0, ',', '.') ?>
                        </div>
                        <div class="text-sm text-gray-500">
                            Stok: <span class="font-semibold"><?= (int)$menu['stok'] ?></span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-2">
                        <?php if ($role === 'customer'): ?>
                            <form action="customer/add_to_cart.php" method="POST">
                                <input type="hidden" name="id_menu" value="<?= $menu['id_menu'] ?>" />
                                <button type="submit"
                                        class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-3 px-4 rounded-lg font-semibold transition duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex items-center justify-center gap-2"
                                        <?= ((int)$menu['stok'] <= 0) ? 'disabled' : '' ?>>
                                    <i class="bi bi-cart-plus"></i>
                                    <?= ((int)$menu['stok'] <= 0) ? 'Stok Habis' : 'Tambah ke Keranjang' ?>
                                </button>
                            </form>
                        <?php elseif ($role === 'admin'): ?>
                            <div class="flex gap-2">
                                <a href="admin/edit_menu.php?id=<?= $menu['id_menu'] ?>"
                                   class="flex-1 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-white py-3 px-4 rounded-lg text-center font-semibold transition duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="admin/hapus_menu.php?id=<?= $menu['id_menu'] ?>"
                                   class="flex-1 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white py-3 px-4 rounded-lg text-center font-semibold transition duration-300 transform hover:scale-105 flex items-center justify-center gap-2"
                                   onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <!-- No Results Message -->
        <?php if ($menu_count === 0): ?>
            <div class="col-span-full text-center py-16">
                <div class="bg-white rounded-xl shadow-lg p-12">
                    <i class="bi bi-search text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-600 mb-2">Tidak ada menu ditemukan</h3>
                    <p class="text-gray-500 mb-6">Coba ubah kata kunci pencarian atau filter kategori</p>
                    <a href="dashboard.php" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                        Lihat Semua Menu
                    </a>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>

    <!-- JavaScript for Sort Functionality -->
    <script>
        function updateSort(sortValue) {
            const url = new URL(window.location);
            url.searchParams.set('sort', sortValue);
            window.location.href = url.toString();
        }

        // Real-time search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            let searchTimeout;

            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const form = this.closest('form');
                    form.submit();
                }, 500);
            });
        });

        // Smooth scroll for category filters
        document.querySelectorAll('a[href*="category"]').forEach(link => {
            link.addEventListener('click', function(e) {
                // Add loading state
                this.style.opacity = '0.7';
                this.style.pointerEvents = 'none';
            });
        });
    </script>

</body>
</html>
