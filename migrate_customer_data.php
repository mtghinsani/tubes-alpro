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
    <title>Customer Data Migration - CoffeeRight</title>
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
        <h1>🚀 Customer Data Migration for CoffeeRight</h1>
        <p>Starting customer data migration...</p>
        
<?php
echo "<pre>";
echo "Starting customer data migration...\n";

// Create customer_data table
$create_table_query = "CREATE TABLE IF NOT EXISTS `customer_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(255) NOT NULL,
  `alamat_customer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

if (mysqli_query($db, $create_table_query)) {
    echo "<span class='success'>✓ Customer data table created successfully</span>\n";
} else {
    echo "<span class='error'>✗ Error creating customer data table: " . mysqli_error($db) . "</span>\n";
}

// Add customer columns to transaksi table
$alter_queries = [
    "ALTER TABLE `transaksi` ADD COLUMN `customer_data_id` int(11) DEFAULT NULL AFTER `username`",
    "ALTER TABLE `transaksi` ADD COLUMN `nama_customer` varchar(255) DEFAULT NULL AFTER `customer_data_id`",
    "ALTER TABLE `transaksi` ADD COLUMN `alamat_customer` text DEFAULT NULL AFTER `nama_customer`",
    "ALTER TABLE `transaksi` ADD COLUMN `total_bayar` decimal(10,2) DEFAULT NULL AFTER `alamat_customer`",
    "ALTER TABLE `transaksi` ADD COLUMN `tanggal` timestamp DEFAULT CURRENT_TIMESTAMP AFTER `kembalian`"
];

foreach ($alter_queries as $alter_query) {
    if (mysqli_query($db, $alter_query)) {
        echo "<span class='success'>✓ Added customer column to transaksi table</span>\n";
    } else {
        if (strpos(mysqli_error($db), 'Duplicate column name') !== false) {
            echo "<span class='info'>✓ Customer column already exists in transaksi table</span>\n";
        } else {
            echo "<span class='error'>✗ Error adding customer column: " . mysqli_error($db) . "</span>\n";
        }
    }
}

// Create detail_transaksi table
$create_detail_table = "CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_id` (`transaksi_id`),
  KEY `id_menu` (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

if (mysqli_query($db, $create_detail_table)) {
    echo "<span class='success'>✓ Detail transaksi table created successfully</span>\n";
} else {
    echo "<span class='error'>✗ Error creating detail transaksi table: " . mysqli_error($db) . "</span>\n";
}

echo "\nCustomer data migration completed!\n";
echo "You can now use the enhanced cart and checkout with customer information.\n";
echo "</pre>";
?>
        <div style="margin-top: 20px; padding: 15px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px;">
            <h3 style="color: #155724; margin: 0 0 10px 0;">✅ Migration Complete!</h3>
            <p style="margin: 0; color: #155724;">Your database has been successfully updated with customer data support.</p>
            <p style="margin: 10px 0 0 0;">
                <a href="dashboard.php" style="background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">
                    Go to Dashboard
                </a>
                <a href="customer/cart.php" style="background: #17a2b8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; margin-left: 10px;">
                    Test Cart
                </a>
            </p>
        </div>
    </div>
</body>
</html>
