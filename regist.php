<?php
require 'func.php';

// session_start();
// if (!isset($_SESSION["login"])) {
//     header("Location: log.php");
//     exit;
// }

if (isset($_POST["regist"])) {
    if(regist($_POST) > 0) {
        echo "<script>
                alert('Anda Sudah Berhasil Registrasi');
                document.location.href = 'web01.php';
            </script>";
    } else {
        mysqli_error($connect);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>regist</title>
    <style>
        label {
            display: block;
        };
    </style>
</head>
<body>
    
    <h1>REGISTRASI MAHASISWA BARU</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="pw">Password: </label>
                <input type="password" name="pw" id="pw" required>
            </li>
            <li>
                <label for="pwConfirm">Konfirmasi Password: </label>
                <input type="password" name="pwConfirm" id="pwConfirm" required>
            </li>
            <li>
                <button type="submit" name="regist">Sign Up</button>
            </li>
        </ul>
    </form>
</body>
</html>