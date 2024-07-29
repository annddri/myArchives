<?php
require 'func.php';

session_start();

if (!isset($_SESSION["firstPage"])) {
    header("Location: firstPage.php");
    exit;
}


if (isset($_GET["search"])) {
    $jumlahDataPerHalaman = 2;
    $search = $_GET["search"];
    $jumlahData = count(query("SELECT * FROM maba WHERE 
                namaSiswa LIKE '%$search%' OR 
                nisn LIKE '%$search%' OR 
                asalSekolah LIKE '%$search%' OR
                gambar LIKE '%$search%'"));
    $jumlahHalaman = ceil( $jumlahData / $jumlahDataPerHalaman );
    $halamanAktif=(isset($_GET["halaman"])) ? $_GET["halaman"] : 1; 
    $awalData = $jumlahDataPerHalaman * $halamanAktif - $jumlahDataPerHalaman;
    $isi = query("SELECT * FROM maba WHERE
                namaSiswa LIKE '%$search%' OR 
                nisn LIKE '%$search%' OR 
                asalSekolah LIKE '%$search%' OR
                gambar LIKE '%$search%'
                LIMIT $awalData , $jumlahDataPerHalaman");
}
else{
    $jumlahDataPerHalaman = 2;
    $jumlahData = count(query("SELECT * FROM maba"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1; 
    $awalData = $jumlahDataPerHalaman*$halamanAktif-$jumlahDataPerHalaman;
    $isi = query("SELECT * FROM maba LIMIT $awalData,$jumlahDataPerHalaman");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web</title>
</head>
<body>
<!-- log out -->
    <button type="submit" name="logout" onclick="return confirm('Yakin Untuk Keluar Akun?');">
        <a href="logOut.php" style="text-decoration: none; color: black;">Log Out</a>
    </button> | <a href="cetak.php" target="_blank">Cetak</a>
<!-- end log out -->

    <h1>Data Mahasiswa Baru</h1>

    <a href="add.php">Tambah Data Mahasiswa</a> <BR><BR>

<!-- search -->
    <form action="" method="get">
        <input type="text" name="search" autofocus placeholder="Telusuri" autocomplete="off" required>
        
        <button type="submit">Cari!</button>
    </form> <br>
<!-- end search -->

<!-- pagination -->
<?php if ($halamanAktif > 1) : ?>
		<a href="?halaman=<?= (isset($_GET["search"])) ? ($halamanAktif - 1).'&'.'search='.$_GET["search"] : ($halamanAktif - 1); ?>" style="text-decoration: none;">&laquo;</a>
	<?php endif; ?>

	<?php for ($i = 1; $i <= $jumlahHalaman ; $i++ ) : ?>
		<?php if ($i == $halamanAktif): ?>
			<a href="?halaman=<?= (isset($_GET["search"])) ? $i.'&'.'search='.$_GET["search"] : $i; ?>"><button style="background-color: #989da1; color: black;"><?= $i; ?></button></a>	
		<?php else : ?>
			<a href="?halaman=<?= (isset($_GET["search"])) ? $i.'&'.'search='.$_GET["search"] : $i;  ?>"><button><?= $i; ?></button></a>
		<?php endif; ?>
	<?php endfor; ?>

	<?php if ($halamanAktif < $jumlahHalaman) : ?>
		<a href="?halaman=<?= (isset($_GET["search"])) ? ($halamanAktif + 1).'&'.'search='.$_GET["search"] : ($halamanAktif + 1); ?>" style="text-decoration: none;">&raquo;</a>
	<?php endif; ?>
<!-- end pagination -->

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Aksi</th>
                <th>Gambar</th>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Asal Sekolah</th>
            </tr>
        </thead>
        <tbody>
                <?php $i = 1 + $awalData; ?>
                <?php foreach( $isi as $baris ) : ?>
                <tr>
                    <td> <?= $i; ?> </td>
                    <td> 
                        <a href="edit.php?no=<?= $baris["no"]; ?>">Edit</a> | 
                        <a href="delete.php?no=<?= $baris["no"]; ?>" onclick="return confirm('Hapus Data?');">Delete</a>
                    </td>
                    <td> <img src="img/<?= $baris["gambar"]; ?>" width="50px"></td>
                    <td> <?= $baris["namaSiswa"]; ?> </td>
                    <td> <?= $baris["nisn"]; ?> </td>
                    <td> <?= $baris["asalSekolah"]; ?> </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach; ?>
        </tbody>

    </table>
</body>
</html>




