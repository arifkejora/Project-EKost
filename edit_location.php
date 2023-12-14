<?php
// edit_location.php

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

// Query ke database untuk mengambil data lokasi berdasarkan id_location
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_ekost";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tb_location WHERE id_location = $id_location AND id_pemilik = {$_SESSION['id_account']}";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Data ditemukan, tampilkan formulir edit
    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lokasi</title>
</head>
<body>
    <h2>Edit Lokasi</h2>
    <form action="update_location.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_location" value="<?php echo $row['id_location']; ?>">
        <!-- Tambahkan input lainnya sesuai atribut yang ingin diubah -->
        Nama Lokasi: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
        Latitude: <input type="text" name="lat_location" value="<?php echo $row['lat_location']; ?>"><br>
        Longitude: <input type="text" name="long_location" value="<?php echo $row['long_location']; ?>"><br>
        Alamat Lengkap: <input type="text" name="alamat_lengkap" value="<?php echo $row['alamat_lengkap']; ?>"><br>
        Harga Per Bulan: <input type="text" name="harga_perbulan" value="<?php echo $row['harga_perbulan']; ?>"><br>
        Harga Per 3 Bulan: <input type="text" name="harga_per3bulan" value="<?php echo $row['harga_per3bulan']; ?>"><br>
        Harga Per 6 Bulan: <input type="text" name="harga_per6bulan" value="<?php echo $row['harga_per6bulan']; ?>"><br>
        Harga Per Tahun: <input type="text" name="harga_pertahun" value="<?php echo $row['harga_pertahun']; ?>"><br>
        Fasilitas: <input type="text" name="fasilitas" value="<?php echo $row['fasilitas']; ?>"><br>
        Photo Kost: <input type="file" name="photo_kost"><br>
        <!-- Tambahkan input lainnya sesuai atribut yang ingin diubah -->
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
<?php
} else {
    // Data tidak ditemukan atau tidak diizinkan untuk diubah
    echo "Data tidak ditemukan atau Anda tidak memiliki izin untuk mengedit lokasi ini.";
}

$conn->close();
?>
