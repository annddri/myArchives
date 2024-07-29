<?php
require 'func.php';

session_start();

if (isset($_POST["regist"])) {
    $username = strtolower(stripslashes($_POST["username"]));
    $pw = mysqli_real_escape_string($connect, $_POST["pw"]);
    $pwConfirm = mysqli_real_escape_string($connect, $_POST["pwConfirm"]);

    $result = mysqli_query($connect, "SELECT username FROM pengguna WHERE username = '$username' ");
    if (mysqli_fetch_assoc($result)) {
        $error1 = [];
    } else if ($pw !== $pwConfirm) {
        $error2 = [];
    }

    $pw = password_hash($pw, PASSWORD_DEFAULT);

    mysqli_query($connect, "INSERT INTO pengguna VALUES('', '$username', '$pw')");

    $_SESSION["regist"] = true;
    $_SESSION["firstPage"] = true;

    header("Location: web01.php");
}

if (isset($_SESSION["regist"])) {
    header("Location: web01.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>regist</title>

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
    <link rel="stylesheet" href="css/cssregist.css">
</head>
<body>
    
<div class="card" style="width: 25rem;">
    <div class="card-body">
        <h2 class="reg-title">Sign Up</h2> <br>

    <?php if (isset($error1)) : ?>
        <p style="color: red; font-style: italic;">Username sudah digunakan, pilih username lain</p>
    <?php endif; ?>
    <?php if (isset($error2)) : ?>
        <p style="color: red; font-style: italic;">Konfirmasi password tidak sesuai</p>
    <?php endif; ?>

            <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="pw" class="form-label">Password</label>
                    <input type="password" name="pw" id="pw" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="pwConfirm" class="form-label">Confirm password</label>
                    <input type="password" name="pwConfirm" id="pwConfirm" required class="form-control">   
                </div>
                <div class="mb-3">
                    <button type="submit" name="regist" class="btn btn-primary">Sign Up</button>
                </div>
                <div class="login">
                    <p>You have an account?<a href="log.php">Sign In</a></p>
                </div>
            </form>
    </div>
</div>

</body>
</html>