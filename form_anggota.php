
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran Anggota</title>
</head>
<body>
    <h2>Form Pendaftaran Anggota Perpustakaan</h2>

    <form action="proses_anggota.php" method="post">
        <label>Nomor Anggota:</label><br>
        <input type="text" name="no_anggota">
        <br><br>

        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_lengkap">
        <br><br>

        <label>Email:</label><br>
        <input type="text" name="email">
        <br><br>

        <label>Nomor HP:</label><br>
        <input type="text" name="no_hp">
        <br><br>

        <label>Jenis Anggota:</label><br>
        <select name="jenis_anggota">
            <option value="">-- Pilih Jenis Anggota --</option>
            <option value="Mahasiswa">Mahasiswa</option>
            <option value="Dosen">Dosen</option>
            <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
        </select>
        <br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" rows="4" cols="40"></textarea>
        <br><br>

        <button type="submit">Daftar</button>
    </form>

    <br>
    <a href="data.php">data</a>
</body>
</html>
