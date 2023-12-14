<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GARO ESTATE | Home page</title>
    <meta name="description" content="GARO is a real-estate template">
    <meta name="author" content="Kimarotec">
    <meta name="keyword" content="html5, css, bootstrap, property, real-estate theme , bootstrap template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/fontello.css">
    <link href="assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
    <link href="assets/fonts/icon-7-stroke/css/helper.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icheck.min_all.css">
    <link rel="stylesheet" href="assets/css/price-range.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.theme.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
        .logo {
            width: 20%;
            height: auto; /* Maintain aspect ratio */
        }

    </style>
</head>

<body>
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    <nav class="navbar navbar-default ">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img class="logo" src="assets/img/logo2.png" alt=""></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse yamm" id="navigation">
                <div class="button navbar-right">
                    <button class="navbar-btn nav-button wow bounceInRight login" onclick=" window.open('register.php')" data-wow-delay="0.45s">Login Sebagai Pemilik Kost</button>
                    <button class="navbar-btn nav-button wow fadeInRight" onclick=" window.open('login-admin.php')" data-wow-delay="0.48s">Login Sebagai Admin</button>
                </div>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <!-- End of nav bar -->

    <div id="map"></div>

<script>
        var map = L.map('map').setView([-6.2088, 106.8456], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);


        // Mengambil data marker dari server
        fetch('get_locations.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(location => {
                    var marker = L.marker([location.long_location, location.lat_location]).addTo(map)
                        .bindPopup(location.name);
                });
            })
            .catch(error => console.error('Error:', error));

        var popup;

        
        map.on('click', function(e) {
        popup = L.popup()
            .setLatLng(e.latlng)
            .setContent('<form id="addLocationForm">' +
                '<label for="locationName">Nama Kost:</label>' +
                '<input type="text" id="locationName" name="locationName" required><br>' +
                '<label for="hargaPerbulan">Harga Perbulan:</label>' +
                '<input type="text" id="hargaPerbulan" name="hargaPerbulan" required><br>' +
                '<label for="hargaPer3Bulan">Harga Per3Bulan:</label>' +
                '<input type="text" id="hargaPer3Bulan" name="hargaPer3Bulan" required><br>' +
                '<label for="hargaPer6Bulan">Harga Per6Bulan:</label>' +
                '<input type="text" id="hargaPer6Bulan" name="hargaPer6Bulan" required><br>' +
                '<label for="hargaPertahun">Harga Pertahun:</label>' +
                '<input type="text" id="hargaPertahun" name="hargaPertahun" required><br>' +
                '<label for="fasilitas">Fasilitas:</label>' +
                '<input type="text" id="fasilitas" name="fasilitas" required><br>' +
                '<label for="alamatLengkap">Alamat Lengkap:</label>' +
                '<input type="text" id="alamatLengkap" name="alamatLengkap" required><br>' +
                '<br>' +
                '<button type="button" onclick="addLocation()">Tambahkan Lokasi</button>' +
                '</form>')
            .openOn(map);
    });
        
        function addLocation() {

            var locationName = document.getElementById('locationName').value;
            var hargaPerbulan = document.getElementById('hargaPerbulan').value;
            var hargaPer3Bulan = document.getElementById('hargaPer3Bulan').value;
            var hargaPer6Bulan = document.getElementById('hargaPer6Bulan').value;
            var hargaPertahun = document.getElementById('hargaPertahun').value;
            var fasilitas = document.getElementById('fasilitas').value;
            var alamatLengkap = document.getElementById('alamatLengkap').value;

            var latlng = popup.getLatLng();

            // Mengirim data ke server untuk disimpan di database
            fetch('add_location.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: locationName,
                    lat_location: latlng.lat,
                    long_location: latlng.lng,
                    hargaPerbulan: hargaPerbulan,
                    hargaPer3Bulan: hargaPer3Bulan,
                    hargaPer6Bulan: hargaPer6Bulan,
                    hargaPertahun: hargaPertahun,
                    fasilitas: fasilitas,
                    alamatLengkap: alamatLengkap
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Menambahkan marker baru ke peta
                var marker = L.marker([latlng.lat, latlng.lng]).addTo(map)
                    .bindPopup(locationName);
                // Menutup popup setelah menambahkan
                map.closePopup();
            })
            .catch(error => console.error('Error:', error));
        }

    </script>

    </div>

    <!-- property area -->
    <div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                    <!-- /.feature title -->
                    <h2>Cari Kost Anda Disini</h2>
                    <p>Jelajahi tempat-tempat kost terbaru yang baru saja ditambahkan, dan temukan pilihan hunian yang nyaman sesuai kebutuhan Anda. Segera buat pengalaman tinggal Anda lebih berkesan di lokasi-lokasi kost terkini yang kami sediakan!</p>
                </div>
            </div>

            <?php
            // Include the database connection code
            $servername = "localhost";  // Change this to your database server name
            $username = "root";         // Change this to your database username
            $password = "";             // Change this to your database password
            $dbname = "db_ekost";       // Change this to your database name

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from tb_location table
            $sql = "SELECT * FROM tb_location";
            $result = $conn->query($sql);

            if (!$result) {
                die("Error fetching data: " . $conn->error);
            }

            if ($result->num_rows > 0) {
                // Loop through the results and generate HTML for each property item
                while ($row = $result->fetch_assoc()) {


                    echo "<div class='col-sm-6 col-md-3 p0'>
                    <div class='box-two proerty-item'>
                        <div class='item-thumb'>
                        <a href='property-details.php?id={$row['id_location']}'><img src='{$row['foto']}' alt='Location Image' style='width: 100%; height: 200px; object-fit: cover;'></a>
                        </div>
                        <div class='item-entry overflow'>
                            <h5><a href='property-details.php?id={$row['id_location']}'>{$row['name']}</a></h5>
                            <div class='dot-hr'></div>
                            <span class='pull-left'><b>Area :</b> {$row['alamat_lengkap']}</span>
                        </div>
                    </div>
            </div>";
                }
            } else {
                echo "No properties found.";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>



        <div class="footer-copy text-center">
            <div class="container">
                <div class="row">
                    <div class="pull-left">
                        <span> (C) <a href="">EKost Yogyakarta</a> , All rights reserved 2023  </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="assets/js/modernizr-2.6.2.min.js"></script>

    <script src="assets/js/jquery-1.10.2.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/bootstrap-hover-dropdown.js"></script>

    <script src="assets/js/easypiechart.min.js"></script>
    <script src="assets/js/jquery.easypiechart.min.js"></script>

    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/wow.js"></script>

    <script src="assets/js/icheck.min.js"></script>
    <script src="assets/js/price-range.js"></script>

    <script src="assets/js/main.js"></script>

</body>

</html>