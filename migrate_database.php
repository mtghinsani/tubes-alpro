<?php
require 'config.php';

echo "Starting database migration...\n";

// Add category column to menu table
$add_column_query = "ALTER TABLE `menu` ADD COLUMN `category` VARCHAR(50) DEFAULT NULL AFTER `nama`";
if (mysqli_query($db, $add_column_query)) {
    echo "✓ Category column added successfully\n";
} else {
    if (strpos(mysqli_error($db), 'Duplicate column name') !== false) {
        echo "✓ Category column already exists\n";
    } else {
        echo "✗ Error adding category column: " . mysqli_error($db) . "\n";
    }
}

// Update existing menu items with categories
$updates = [
    "UPDATE `menu` SET `category` = 'coffee' WHERE `nama` LIKE '%americano%' OR `nama` LIKE '%coffee%' OR `nama` LIKE '%kopi%'",
    "UPDATE `menu` SET `category` = 'coffee' WHERE `nama` LIKE '%kapal api%'"
];

foreach ($updates as $update_query) {
    if (mysqli_query($db, $update_query)) {
        echo "✓ Updated existing menu items\n";
    } else {
        echo "✗ Error updating menu items: " . mysqli_error($db) . "\n";
    }
}

// Insert sample menu items with categories (only if they don't exist)
$sample_menus = [
    ['Cappuccino', 'coffee', 25000, 15],
    ['Latte', 'coffee', 28000, 12],
    ['Espresso', 'coffee', 18000, 20],
    ['Green Tea', 'tea', 15000, 25],
    ['Earl Grey', 'tea', 16000, 18],
    ['Jasmine Tea', 'tea', 14000, 22],
    ['Chocolate Croissant', 'snacks', 12000, 10],
    ['Blueberry Muffin', 'snacks', 15000, 8],
    ['Sandwich Club', 'snacks', 35000, 6],
    ['Tiramisu', 'desserts', 32000, 5],
    ['Cheesecake', 'desserts', 28000, 7],
    ['Chocolate Cake', 'desserts', 25000, 9]
];

foreach ($sample_menus as $menu) {
    $check_query = "SELECT COUNT(*) as count FROM `menu` WHERE `nama` = '{$menu[0]}'";
    $result = mysqli_query($db, $check_query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row['count'] == 0) {
        $insert_query = "INSERT INTO `menu` (`nama`, `category`, `harga`, `gambar`, `stok`) VALUES ('{$menu[0]}', '{$menu[1]}', {$menu[2]}, '', {$menu[3]})";
        if (mysqli_query($db, $insert_query)) {
            echo "✓ Added sample menu: {$menu[0]}\n";
        } else {
            echo "✗ Error adding {$menu[0]}: " . mysqli_error($db) . "\n";
        }
    } else {
        echo "- Sample menu {$menu[0]} already exists\n";
    }
}

echo "\nDatabase migration completed!\n";
echo "You can now access the enhanced dashboard with categories, search, and sorting features.\n";
?>
