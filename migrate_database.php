<?php
require 'config.php';

// Set content type for web output
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Migration - CoffeeRight</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { color: #28a745; }
        .error { color: #dc3545; }
        .info { color: #17a2b8; }
        .container { background: #f8f9fa; padding: 20px; border-radius: 8px; }
        h1 { color: #333; }
        pre { background: #e9ecef; padding: 10px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Database Migration for CoffeeRight</h1>
        <p>Starting database migration...</p>

<?php
echo "<pre>";
echo "Starting database migration...\n";


$add_column_query = "ALTER TABLE `menu` ADD COLUMN `category` VARCHAR(50) DEFAULT NULL AFTER `nama`";
if (mysqli_query($db, $add_column_query)) {
    echo "<span class='success'>✓ Category column added successfully</span>\n";
} else {
    if (strpos(mysqli_error($db), 'Duplicate column name') !== false) {
        echo "<span class='info'>✓ Category column already exists</span>\n";
    } else {
        echo "<span class='error'>✗ Error adding category column: " . mysqli_error($db) . "</span>\n";
    }
}


$updates = [
    "UPDATE `menu` SET `category` = 'coffee' WHERE `nama` LIKE '%americano%' OR `nama` LIKE '%coffee%' OR `nama` LIKE '%kopi%'",
    "UPDATE `menu` SET `category` = 'coffee' WHERE `nama` LIKE '%kapal api%'"
];

foreach ($updates as $update_query) {
    if (mysqli_query($db, $update_query)) {
        echo "<span class='success'>✓ Updated existing menu items</span>\n";
    } else {
        echo "<span class='error'>✗ Error updating menu items: " . mysqli_error($db) . "</span>\n";
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
            echo "<span class='success'>✓ Added sample menu: {$menu[0]}</span>\n";
        } else {
            echo "<span class='error'>✗ Error adding {$menu[0]}: " . mysqli_error($db) . "</span>\n";
        }
    } else {
        echo "<span class='info'>- Sample menu {$menu[0]} already exists</span>\n";
    }
}

echo "\nDatabase migration completed!\n";
echo "You can now access the enhanced dashboard with categories, search, and sorting features.\n";
echo "</pre>";
?>
        <div style="margin-top: 20px; padding: 15px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px;">
            <h3 style="color: #155724; margin: 0 0 10px 0;">✅ Migration Complete!</h3>
            <p style="margin: 0; color: #155724;">Your database has been successfully migrated with category support.</p>
            <p style="margin: 10px 0 0 0;">
                <a href="dashboard.php" style="background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">
                    Go to Dashboard
                </a>
                <a href="test_database.php" style="background: #17a2b8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; margin-left: 10px;">
                    Test Database
                </a>
            </p>
        </div>
    </div>
</body>
</html>
