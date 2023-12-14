<?php
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "db_ekost";

// Ambil data yang dikirim dari frontend
$data = json_decode(file_get_contents("php://input"), true);

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Masukkan data ke dalam tabel tb_location
$sql = "INSERT INTO tb_location (id_pemilik, name, long_location, lat_location, harga_perbulan, harga_per3bulan, harga_per6bulan, harga_pertahun, fasilitas, alamat_lengkap) 
        VALUES (
            '{$data['id_pemilik']}',
            '{$data['name']}', 
            {$data['lat_location']}, 
            {$data['long_location']},
            '{$data['hargaPerbulan']}',
            '{$data['hargaPer3Bulan']}',
            '{$data['hargaPer6Bulan']}',
            '{$data['hargaPertahun']}',
            '{$data['fasilitas']}',
            '{$data['alamatLengkap']}'
        )";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success", "message" => "Lokasi berhasil ditambahkan."));
} else {
    echo json_encode(array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error));
}

// Tutup koneksi
$conn->close();
?>
