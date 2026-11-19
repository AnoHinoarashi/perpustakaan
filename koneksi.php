
<?php
mysqli_report(MYSQLI_REPORT_OFF);

// Parameter koneksi
$host = "localhost";
$user = "root";
$password = "";
$database = "db_perpustakaan";

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $password, $database);

// Memeriksa koneksi
//echo "Koneksi berhasil!";
if (!$koneksi) {
    die("Koneksi gagal: " . htmlspecialchars(mysqli_connect_error()));
}

// Mengatur karakter agar huruf dan simbol tersimpan dengan benar
mysqli_set_charset($koneksi, "utf8mb4");
