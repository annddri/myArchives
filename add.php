<?php 
require 'func.php';

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: log.php");
    exit;
}

if(isset($_POST["tekan"])) {
    if (add($_POST) > 0){
        echo "
                <script>
                    alert('Data Berhasil Ditambahkan!');
                    document.location.href = 'web01.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Data Gagal Ditambahkan!');
                    document.location.href = 'web01.php';
                </script>
            ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    
<h1>Tambah Data Mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="namaSiswa">Nama Mahasiswa: </label>
                <input type="text" name="namaSiswa" id="namaSiswa" required>
            </li>
            <li>
                <label for="nisn">NISN: </label>
                <input type="text" name="nisn" id="nisn" required>
            </li>
            <li>
                <label for="asalSekolah">Asal Sekolah:</label>
                <input type="text" name="asalSekolah" id="asalSekolah" required>
            </li>
            <li>
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="tekan">Tambah Data</button>
            </li>
        </ul>
    </form>

    <a href="web01.php">Kembali ke Daftar Mahasiswa Baru</a>
</body>
</html>