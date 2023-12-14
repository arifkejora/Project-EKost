<?php
// update_location.php

// Pastikan sesi telah dimulai di setiap file yang membutuhkannya
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id_account'])) {
    // Jika tidak login, redirect ke halaman login atau halaman lainnya
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $id_location = $_POST['id_location'];
    $name = $_POST['name'];
    $lat_location = $_POST['lat_location'];
    $long_location = $_POST['long_location'];
    $alamat_lengkap = $_POST['alamat_lengkap'];
    $harga_perbulan = $_POST['harga_perbulan'];
    $harga_per3bulan = $_POST['harga_per3bulan'];
    $harga_per6bulan = $_POST['harga_per6bulan'];
    $harga_pertahun = $_POST['harga_pertahun'];
    $fasilitas = $_POST['fasilitas'];

    // Handle file upload
    $targetDir = "assets/fotokost/";
    $targetFile = $targetDir . basename($_FILES["photo_kost"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["photo_kost"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo_kost"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["photo_kost"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["photo_kost"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Continue with updating the location details...
    // Query ke database untuk memperbarui data lokasi
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_ekost";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Pastikan hanya pemilik lokasi yang dapat memperbarui data
    $sqlCheckOwnership = "SELECT id_location FROM tb_location WHERE id_location = $id_location AND id_pemilik = {$_SESSION['id_account']}";
    $resultCheckOwnership = $conn->query($sqlCheckOwnership);

    if ($resultCheckOwnership->num_rows > 0) {
        // Pemilik ditemukan, lanjutkan dengan pembaruan data
        $sqlUpdate = "UPDATE tb_location SET name = '$name', lat_location = '$lat_location', long_location = '$long_location', alamat_lengkap = '$alamat_lengkap', harga_perbulan = '$harga_perbulan', harga_per3bulan = '$harga_per3bulan', harga_per6bulan = '$harga_per6bulan', harga_pertahun = '$harga_pertahun', fasilitas = '$fasilitas', foto = '$targetFile' WHERE id_location = $id_location";

        if ($conn->query($sqlUpdate) === TRUE) {
            // Redirect ke halaman setelah berhasil memperbarui
            header("Location: index-kost.php");
            exit();
        } else {
            // Gagal memperbarui
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Pemilik tidak valid
        echo "Invalid ownership for the location.";
    }

    $conn->close();
} else {
    // Jika bukan metode POST, redirect ke halaman lain atau keluar dari skrip
    header("Location: index-kost.php");
    exit();
}
?>
