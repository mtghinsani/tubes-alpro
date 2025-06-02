<?php
require 'config.php';

echo "<h2>Database Test Results</h2>";


echo "<h3>1. Testing Category Column</h3>";
$test_query = "DESCRIBE menu";
$result = mysqli_query($db, $test_query);

if ($result) {
    echo "<p>✓ Menu table structure:</p>";
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['Field']}</td>";
        echo "<td>{$row['Type']}</td>";
        echo "<td>{$row['Null']}</td>";
        echo "<td>{$row['Key']}</td>";
        echo "<td>{$row['Default']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>✗ Error checking table structure: " . mysqli_error($db) . "</p>";
}

// Test 2: Check menu items with categories
echo "<h3>2. Testing Menu Items with Categories</h3>";
$menu_query = "SELECT id_menu, nama, category, harga, stok FROM menu ORDER BY category, nama";
$menu_result = mysqli_query($db, $menu_query);

if ($menu_result) {
    echo "<p>✓ Menu items found: " . mysqli_num_rows($menu_result) . "</p>";
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th></tr>";
    while ($menu = mysqli_fetch_assoc($menu_result)) {
        echo "<tr>";
        echo "<td>{$menu['id_menu']}</td>";
        echo "<td>{$menu['nama']}</td>";
        echo "<td>" . ($menu['category'] ?: 'No Category') . "</td>";
        echo "<td>Rp " . number_format($menu['harga'], 0, ',', '.') . "</td>";
        echo "<td>{$menu['stok']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>✗ Error fetching menu items: " . mysqli_error($db) . "</p>";
}

// Test 3: Check categories
echo "<h3>3. Testing Categories</h3>";
$cat_query = "SELECT DISTINCT category FROM menu WHERE category IS NOT NULL AND category != '' ORDER BY category";
$cat_result = mysqli_query($db, $cat_query);

if ($cat_result) {
    echo "<p>✓ Available categories:</p>";
    echo "<ul>";
    while ($cat = mysqli_fetch_assoc($cat_result)) {
        echo "<li>" . ucfirst($cat['category']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>✗ Error fetching categories: " . mysqli_error($db) . "</p>";
}

// Test 4: Test search functionality
echo "<h3>4. Testing Search Functionality</h3>";
$search_term = "coffee";
$search_query = "SELECT nama, category FROM menu WHERE nama LIKE '%$search_term%' OR category LIKE '%$search_term%'";
$search_result = mysqli_query($db, $search_query);

if ($search_result) {
    echo "<p>✓ Search results for '$search_term': " . mysqli_num_rows($search_result) . " items found</p>";
    if (mysqli_num_rows($search_result) > 0) {
        echo "<ul>";
        while ($item = mysqli_fetch_assoc($search_result)) {
            echo "<li>{$item['nama']} ({$item['category']})</li>";
        }
        echo "</ul>";
    }
} else {
    echo "<p>✗ Error in search query: " . mysqli_error($db) . "</p>";
}

echo "<h3>✅ Database Test Complete</h3>";
echo "<p><a href='dashboard.php'>Go to Dashboard</a></p>";
?>
