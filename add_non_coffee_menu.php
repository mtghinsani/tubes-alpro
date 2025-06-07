<?php
require 'config.php';

echo "<!DOCTYPE html>";
echo "<html><head><title>Add Non Coffee Menu</title>";
echo "<style>";
echo "body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f5f5; }";
echo ".container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }";
echo ".success { color: #10b981; font-weight: bold; }";
echo ".error { color: #ef4444; font-weight: bold; }";
echo ".info { color: #3b82f6; font-weight: bold; }";
echo "pre { background: #f8f9fa; padding: 15px; border-radius: 5px; border-left: 4px solid #667eea; }";
echo "</style>";
echo "</head><body>";
echo "<div class='container'>";
echo "<h1>🍹 Menambahkan Menu Non Coffee</h1>";

echo "<pre>";
echo "Starting to add Non Coffee menu items...\n\n";

// Array of non-coffee menu items
$non_coffee_items = [
    ['nama' => 'Hot Chocolate', 'harga' => 22000, 'stok' => 15],
    ['nama' => 'Matcha Latte', 'harga' => 28000, 'stok' => 12],
    ['nama' => 'Vanilla Milkshake', 'harga' => 25000, 'stok' => 10],
    ['nama' => 'Strawberry Smoothie', 'harga' => 24000, 'stok' => 8],
    ['nama' => 'Fresh Orange Juice', 'harga' => 18000, 'stok' => 20],
    ['nama' => 'Lemon Iced Tea', 'harga' => 16000, 'stok' => 18],
    ['nama' => 'Coconut Water', 'harga' => 15000, 'stok' => 25],
    ['nama' => 'Mineral Water', 'harga' => 8000, 'stok' => 50]
];

$success_count = 0;
$error_count = 0;

foreach ($non_coffee_items as $item) {
    // Check if item already exists
    $check_query = "SELECT id_menu FROM menu WHERE nama = '" . mysqli_real_escape_string($db, $item['nama']) . "'";
    $check_result = mysqli_query($db, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "<span class='info'>ℹ️  '{$item['nama']}' sudah ada dalam database</span>\n";
        continue;
    }
    
    // Insert new item
    $insert_query = "INSERT INTO menu (nama, category, harga, gambar, stok) VALUES (
        '" . mysqli_real_escape_string($db, $item['nama']) . "',
        'non-coffee',
        {$item['harga']},
        '',
        {$item['stok']}
    )";
    
    if (mysqli_query($db, $insert_query)) {
        echo "<span class='success'>✅ '{$item['nama']}' berhasil ditambahkan</span>\n";
        $success_count++;
    } else {
        echo "<span class='error'>❌ Gagal menambahkan '{$item['nama']}': " . mysqli_error($db) . "</span>\n";
        $error_count++;
    }
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "<span class='success'>✅ Berhasil menambahkan: {$success_count} item</span>\n";
if ($error_count > 0) {
    echo "<span class='error'>❌ Gagal menambahkan: {$error_count} item</span>\n";
}
echo "\n🎉 Proses selesai! Kategori 'Non Coffee' telah ditambahkan ke sistem.\n";
echo "</pre>";

echo "<div style='margin-top: 20px; padding: 15px; background: #e0f2fe; border-radius: 5px; border-left: 4px solid #0288d1;'>";
echo "<h3>📋 Langkah Selanjutnya:</h3>";
echo "<ul>";
echo "<li>Kembali ke <a href='dashboard.php' style='color: #0288d1; text-decoration: none;'>Dashboard</a> untuk melihat menu baru</li>";
echo "<li>Filter berdasarkan kategori 'Non Coffee' akan otomatis muncul</li>";
echo "<li>Admin dapat menambah menu non-coffee lainnya melalui form 'Tambah Menu'</li>";
echo "</ul>";
echo "</div>";

echo "</div></body></html>";
?>
