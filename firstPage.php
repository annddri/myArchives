<?php

require "func.php";

session_start();

if (isset($_POST["sign"])) {
    $_SESSION["firstPage"] = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- font google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">

    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cssFirstPage.css">
</head>
<body>
<nav class="navbar">
    <p><i class="bi bi-exclamation-lg"></i>Anda akan langsung diarahkan ke halaman utama apabila telah melakukan sign in sebelumnya.</p>
</nav>

<div class="isi">
    <h1 class="judul">Selamat Datang di <span>Ourchives</span></h1>
    <p class="note">simpan ingatanmu saat ini untuk dikenang di masa depan</p>
        <form action="" method="post">
            <a href="log.php" name="sign"><button type="submit" class="btn btn-primary">Sign In</button></a>
            <a href="regist.php" name="sign"><button type="submit" class="btn btn-primary">Sign Up</button></a>
        </form>
</div>

</body>
</html>