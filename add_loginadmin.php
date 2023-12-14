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

// Ambil data yang dikirim dari formulir login
$email = $_POST['email'];
$password = $_POST['password'];

// Periksa apakah kombinasi email dan password cocok
$sql = "SELECT * FROM tb_admin WHERE email_admin = '$email' AND password_admin = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Jika kombinasi cocok, simpan informasi ke sesi
    $row = $result->fetch_assoc();
    session_start();
    $_SESSION['id_admin'] = $row['id_admin'];
    $_SESSION['nama_admin'] = $row['nama_admin'];

    // Redirect ke halaman index-kost.php setelah login berhasil
    header("Location: admin/index.php");
} else {
    // Jika kombinasi tidak cocok, tampilkan pesan error
    echo "Email atau password salah.";
}

// Tutup koneksi
$conn->close();
?>
