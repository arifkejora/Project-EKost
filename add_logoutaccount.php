<?php
// Mulai atau lanjutkan sesi
session_start();

// Hapus semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman index-kost.php setelah logout
header("Location: index.php");
?>
