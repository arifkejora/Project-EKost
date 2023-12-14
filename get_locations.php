<?php
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "db_ekost";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data lokasi dari tabel tb_location
$sql = "SELECT id_location, long_location, lat_location, name FROM tb_location";
$result = $conn->query($sql);

$locations = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }
}

// Tutup koneksi
$conn->close();

// Keluarkan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($locations);
?>
