<?php 
require 'func.php';

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: log.php");
    exit;
}

$noEdit = $_GET["no"];

$mabaEdit = query("SELECT * FROM maba WHERE no = $noEdit")[0];

if(isset($_POST["tekan"])) {
    if (edit($_POST) > 0){
        echo "
                <script>
                    alert('Data Berhasil Diedit!');
                    document.location.href = 'web01.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Data Gagal Diedit!');
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
    <title>Edit Data Mahasiswa</title>
</head>
<body>
    
<h1>Edit Data Mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data" >
        <ul>
            <input type="hidden" name="no" value="<?= $mabaEdit["no"]; ?>">
            <input type="hidden" name="oldPict" value="<?= $mabaEdit["gambar"]; ?>">
            <li>
                <label for="namaSiswa">Nama Mahasiswa: </label>
                <input type="text" name="namaSiswa" id="namaSiswa" required value="<?= $mabaEdit["namaSiswa"]; ?>">
            </li>
            <li>
                <label for="nisn">NISN: </label>
                <input type="text" name="nisn" id="nisn" required value="<?= $mabaEdit["nisn"]; ?>">
            </li>
            <li>
                <label for="asalSekolah">Asal Sekolah:</label>
                <input type="text" name="asalSekolah" id="asalSekolah" required value="<?= $mabaEdit["asalSekolah"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar:</label> <br>
                <img src="img/<?= $mabaEdit["gambar"]; ?>" width="50px"> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="tekan" onclick="return confirm('Edit Data'); ">Edit Data</button>
            </li>
        </ul>
    </form>

    <a href="web01.php">Kembali ke Daftar Mahasiswa Baru</a>
</body>
</html>