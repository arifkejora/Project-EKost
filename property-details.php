<?php
// property-details.php

// Include your database connection code here if not already included
// Example: include 'db_connection.php';

session_start(); // Make sure to start the session

// Retrieve the id_location from the query parameters
$id_location = $_GET['id'];

// Query to fetch details about the location based on id_location
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_ekost";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tb_location WHERE id_location = $id_location";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Data found, display location details
    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['name']; ?> Details</title>
</head>
<body>
    <h2><?php echo $row['name']; ?> Details</h2>
    <p><b>Alamat Lengkap:</b> <?php echo $row['alamat_lengkap']; ?></p>
    <p><b>Harga Per Bulan:</b> $ <?php echo $row['harga_perbulan']; ?></p>
    <p><b>Harga Per 3 Bulan:</b> $ <?php echo $row['harga_per3bulan']; ?></p>
    <p><b>Harga Per 6 Bulan:</b> $ <?php echo $row['harga_per6bulan']; ?></p>
    <p><b>Harga Per Tahun:</b> $ <?php echo $row['harga_pertahun']; ?></p>
    <p><b>Fasilitas:</b> <?php echo $row['fasilitas']; ?></p>
    <p><b>Latitude:</b> <?php echo $row['lat_location']; ?></p>
    <p><b>Longitude:</b> <?php echo $row['long_location']; ?></p>

    <!-- You can also display the image here -->
    <img src='<?php echo $row['foto']; ?>' alt='Location Image' style='width: 100%; max-height: 400px; object-fit: cover;'>

    <!-- Add more HTML content as needed -->

    <a href="index.php">Kembali Ke Menu</a>
</body>
</html>
<?php
} else {
    // Data not found
    echo "Location not found.";
}

$conn->close();
?>
