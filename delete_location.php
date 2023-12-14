<?php

// Pastikan sesi telah dimulai di setiap file yang membutuhkannya
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id_account'])) {
    // Jika tidak login, redirect ke halaman login atau halaman lainnya
    header("Location: login.php");
    exit();
}

// Ambil id_location dari parameter GET
$id_location = $_GET['id'];

// Query ke database untuk menghapus lokasi berdasarkan id_location
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_ekost";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM tb_location WHERE id_location = $id_location AND id_pemilik = {$_SESSION['id_account']}";

if ($conn->query($sql) === TRUE) {
    // Redirect ke halaman setelah berhasil menghapus
    header("Location: index-kost.php");
    exit();
} else {
    // Gagal menghapus
    echo "Error: " . $conn->error;
}

$conn->close();
?>
