<?php
$connect = mysqli_connect("localhost", "root", "", "phpdasar");

//menampilkan tabel dari database
function query($query) {
    global $connect;

    $data = mysqli_query($connect, $query);

    $rows = [];
    while ( $row = mysqli_fetch_assoc($data) ) {
        $rows[] = $row;
    }
    return $rows;
}

//menambahkan data pada database
function add($data){
    global $connect;

    $namaSiswa = htmlspecialchars($data["namaSiswa"]);
    $nisn = htmlspecialchars($data["nisn"]);
    $asalSekolah = htmlspecialchars($data["asalSekolah"]);
    
    $gambar = upload();
    if ( !$gambar ){
        return false;
    }

    $query = "INSERT INTO maba VALUES (
    '', '$namaSiswa', '$nisn', '$asalSekolah', '$gambar')";

    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

//mengedit data
function edit($data){
    global $connect;

    $no = $data["no"];
    $namaSiswa = htmlspecialchars($data["namaSiswa"]);
    $nisn = htmlspecialchars($data["nisn"]);
    $asalSekolah = htmlspecialchars($data["asalSekolah"]);
    $oldPict = $data["oldPict"];

    if($_FILES['gambar']['error'] === 4){
        $gambar = $oldPict;
    } else {
        $gambar = upload(); 
    }

    $query = "UPDATE maba SET
        namaSiswa = '$namaSiswa',
        nisn = '$nisn',
        asalSekolah = '$asalSekolah',
        gambar = '$gambar'
        WHERE no = '$no'
        ";

    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

//upload gambar
function upload(){
    
    $nameFile = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    $error = $_FILES['gambar']['error'];
    $size = $_FILES['gambar']['size'];

    if ($error === 4){
        echo "<script>
                alert('Masukkan Gambar');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $nameFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Masukkan Gambar dengan Ekstensi .jpg, .jpeg, atau .png');
            </script>";
        return false;
    }

    if ($size > 1000000){
        echo "<script>
                alert('Ukuran File Tidak Boleh Lebih Dari 1MB');
            </script>";
        return false;
    }

    $newNameFile = uniqid();
    $newNameFile .= '.';
    $newNameFile .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $newNameFile);

    return $newNameFile;
}

//menghapus data
function del($no) {
    global $connect;
    
    mysqli_query($connect, "DELETE FROM maba WHERE no = $no");

    return mysqli_affected_rows($connect);
}

?>

