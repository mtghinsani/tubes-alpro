<?php
$db = mysqli_connect("localhost", "root", "", "tubes_alpro_coffeeshop");

function query($query){
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah_akun($data){
    global $db;
    $nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $role = 'customer';

    $query = "INSERT INTO user VALUES ('','$nama_lengkap','$username','$password','$role')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
?>