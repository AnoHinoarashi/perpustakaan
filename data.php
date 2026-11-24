<?php
require_once 'koneksi.php';
$sql = "SELECT * FROM anggota order by id desc";
$hasil = mysqli_query($koneksi, $sql);
//echo mysqli_num_rows($hasil) . '<br>';
$jumlah = mysqli_num_rows($hasil);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
    <style>
        th {
            background-color: #82cdff;
        }
        td {
            text-align: center;
            background-color: #e6fffe;
        }
    </style>
</head>
<body>
   <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>No Anggota</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Jenis Anggota</th>
            <th>Alamat</th>
            <th>Detail</th>
        </tr>
        <?php $no = 1; while ($baris = mysqli_fetch_assoc($hasil)) { ?>
        <tr><td><?php echo $no++; ?></td>
        <td><?php echo htmlspecialchars($baris['no_anggota']); ?></td>
        <td><?php echo htmlspecialchars($baris['nama_lengkap']); ?></td>
        <td><?php echo htmlspecialchars($baris['email']); ?></td>
        <td><?php echo htmlspecialchars($baris['no_hp']); ?></td>
        <td><?php echo htmlspecialchars($baris['jenis_anggota']); ?></td>
        <td><?php echo htmlspecialchars($baris['alamat']); ?></td>
        <td><a href="detail.php?id=<?php echo (int) $baris["id"]; ?>">Detail</a>
        <form class="inline" action="hapus.php" method="post"
        onsubmit="return confirm('yakin ingin menghapus data ini?');">
        <input type="hidden" name="id" value="<?php echo (int) $baris["id"]; ?>">
        <input type="submit" value="Hapus">
        </form>
        </td>
    </tr>
        <?php } ?>
    </table><br>
    <a href="form_anggota.php">kembali ke form</a>
</body>
</html>