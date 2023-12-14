<?php
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "db_ekost";

$conn = new mysqli($servername, $username, $password, $dbname);
// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data yang dikirim dari formulir
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Masukkan data ke dalam tabel tb_account
$sql = "INSERT INTO tb_account (nama_account, email_account, password_account) VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    // Jika akun berhasil dibuat, set notifikasi untuk ditampilkan di halaman index-kost.php
    $notificationMessage = "Akun berhasil dibuat. Silakan login.";
    // Tambahkan penundaan 5 detik sebelum mengarahkan pengguna
    echo '<script>
            setTimeout(function() {
                alert("' . $notificationMessage . '");
                window.location.href = "index-kost.php";
            }, 2000);
          </script>';
} else {
    echo json_encode(array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error));
}

// Tutup koneksi
$conn->close();
?>
