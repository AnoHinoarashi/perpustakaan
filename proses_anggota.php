
<?php
// Memastikan data dikirim menggunakan POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form_anggota.php");
    exit;
}

// Mengambil data dari form
$no_anggota = isset($_POST['no_anggota']) ? trim($_POST['no_anggota']) : "";
$nama_lengkap = isset($_POST['nama_lengkap']) ? trim($_POST['nama_lengkap']) : "";
$email = isset($_POST['email']) ? trim($_POST['email']) : "";
$no_hp = isset($_POST['no_hp']) ? trim($_POST['no_hp']) : "";
$jenis_anggota = isset($_POST['jenis_anggota']) ? trim($_POST['jenis_anggota']) : "";
$alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : "";

// Menyiapkan array error
$error = [];

// Validasi nomor anggota
if (empty($no_anggota)) {
    $error['no_anggota'] = "Nomor anggota wajib diisi.";
} elseif (!ctype_digit($no_anggota)) {
    $error['no_anggota'] = "Nomor anggota harus berupa angka.";
} elseif (strlen($no_anggota) > 15) {
    $error['no_anggota'] = "Maksimal 15 digit.";
}

// Validasi nama lengkap
if (empty($nama_lengkap)) {
    $error['nama_lengkap'] = "Nama lengkap wajib diisi.";
} elseif (strlen($nama_lengkap) > 100) {
    $error['nama_lengkap'] = "Maksimal 100 karakter.";
}

// Validasi email
if (empty($email)) {
    $error['email'] = "Email wajib diisi.";
} elseif (strlen($email) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email'] = "Format email tidak valid atau melebihi 100 karakter.";
}

// Validasi nomor HP
if (empty($no_hp)) {
    $error['no_hp'] = "Nomor HP wajib diisi.";
} elseif (!ctype_digit($no_hp)) {
    $error['no_hp'] = "Nomor HP harus berupa angka.";
} elseif (strlen($no_hp) < 10 || strlen($no_hp) > 13) {
    $error['no_hp'] = "Nomor HP harus 10 sampai 13 digit.";
}

// Validasi jenis anggota
if (empty($jenis_anggota)) {
    $error['jenis_anggota'] = "Jenis anggota wajib dipilih.";
} elseif (!in_array($jenis_anggota, ["Mahasiswa", "Dosen", "Tenaga Kependidikan"], true)) {
    $error['jenis_anggota'] = "Pilihan jenis anggota tidak valid.";
}

// Validasi alamat
if (empty($alamat)) {
    $error['alamat'] = "Alamat wajib diisi.";
}

// Jika validasi gagal
if (!empty($error)) {
    echo "<h3>Terjadi Kesalahan:</h3>";

    foreach ($error as $pesan) {
        echo htmlspecialchars($pesan) . "<br>";
    }

    echo "<br><a href='form_anggota.php'>Kembali ke Form</a>";
    exit;
}

// Jika validasi berhasil, hubungkan ke database
require_once "koneksi.php";

// Query untuk menyimpan data
$query = "INSERT INTO anggota
(no_anggota, nama_lengkap, email, no_hp, jenis_anggota, alamat)
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $query);

if ($stmt) {
    mysqli_stmt_bind_param(
        $stmt,
        "ssssss",
        $no_anggota,
        $nama_lengkap,
        $email,
        $no_hp,
        $jenis_anggota,
        $alamat
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "Pendaftaran berhasil! Data anggota berhasil disimpan.";
        echo "<br><a href='form_anggota.php'>Kembali ke Form</a>";
        echo "<br><a href='data.php'>Lihat Data Anggota</a>";
    } else {
        echo "Data gagal disimpan ke database.";
        echo "<br><a href='form_anggota.php'>Kembali ke Form</a>";
    }

    mysqli_stmt_close($stmt);

} else {
    echo "Query database gagal disiapkan.";
    echo "<br><a href='form_anggota.php'>Kembali ke Form</a>";
}
?>
