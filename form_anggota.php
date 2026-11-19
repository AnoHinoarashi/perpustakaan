<?php
session_start();

// Mengambil pesan dan data sebelumnya
$error = $_SESSION['error'] ?? [];
$old = $_SESSION['old'] ?? [];
$pesan_sukses = $_SESSION['sukses'] ?? "";

// Menghapus session setelah diambil
unset($_SESSION['error']);
unset($_SESSION['old']);
unset($_SESSION['sukses']);

// Fungsi untuk mengamankan tampilan data
function isi($nama, $old) {
    return htmlspecialchars($old[$nama] ?? "");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran Anggota</title>
</head>
<body>
    <h2>Form Pendaftaran Anggota Perpustakaan</h2>
    <?php if (!empty($pesan_sukses)) { ?>
        <p style="color: green;">
            <?php echo htmlspecialchars($pesan_sukses); ?>
        </p>
    <?php } ?>
    <form action="proses_anggota.php" method="post">
        <label>Nomor Anggota:</label><br>
        <input type="text" name="no_anggota"
        value="<?php echo isi('no_anggota', $old); ?>">
        <span style="color: red;">
            <?php echo $error['no_anggota'] ?? ""; ?>
        </span>
        <br><br>
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_lengkap"
        value="<?php echo isi('nama_lengkap', $old); ?>">
        <span style="color: red;">
            <?php echo $error['nama_lengkap'] ?? ""; ?>
        </span>
        <br><br>
        <label>Email:</label><br>
        <input type="text" name="email"
        value="<?php echo isi('email', $old); ?>">
        <span style="color: red;">
            <?php echo $error['email'] ?? ""; ?>
        </span>
        <br><br>
        <label>Nomor HP:</label><br>
        <input type="text" name="no_hp"
        value="<?php echo isi('no_hp', $old); ?>">
        <span style="color: red;">
            <?php echo $error['no_hp'] ?? ""; ?>
        </span>
        <br><br>
        <label>Jenis Anggota:</label><br>
        <select name="jenis_anggota">
            <option value="">-- Pilih Jenis Anggota --</option>
            <option value="Mahasiswa"
            <?php if (($old['jenis_anggota'] ?? "") == "Mahasiswa") echo "selected"; ?>>
                Mahasiswa
            </option>
            <option value="Dosen"
            <?php if (($old['jenis_anggota'] ?? "") == "Dosen") echo "selected"; ?>>
                Dosen
            </option>
            <option value="Tenaga Kependidikan"
            <?php if (($old['jenis_anggota'] ?? "") == "Tenaga Kependidikan") echo "selected"; ?>>
                Tenaga Kependidikan
            </option>
        </select>
        <span style="color: red;">
            <?php echo $error['jenis_anggota'] ?? ""; ?>
        </span>
        <br><br>
        <label>Alamat:</label><br>
        <textarea name="alamat" rows="4" cols="40"><?php
            echo isi('alamat', $old);
        ?></textarea>
        <span style="color: red;">
            <?php echo $error['alamat'] ?? ""; ?>
        </span>
        <br><br>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>