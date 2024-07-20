<?php
require 'func.php';

session_start();

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $results = mysqli_query($connect, "SELECT username FROM pengguna WHERE id = $id");
    $hasil = mysqli_fetch_assoc($results);

    if ($key === hash('sha256', $hasil['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_POST["login"])) {
    $usernameLog = $_POST["username"];
    $passwordLog = $_POST["password"];

    $results = mysqli_query($connect, "SELECT * FROM pengguna WHERE username = '$usernameLog' ");

    $errors = [];

    if ($hasil = mysqli_fetch_assoc($results)) {
        if (password_verify($passwordLog, $hasil["password"])){
            $_SESSION["login"] = true;

            if (isset ($_POST['remember'])) {
                setcookie('id', $hasil['id'], time() + 60);
                setcookie('key', hash('sha256', $hasil['username']), time() + 60);
            }

            header("Location: web01.php");
        } else {
            $hasil = $errors;
        }
    }
}

if (isset($_SESSION["login"]) || isset($_SESSION["regist"])) {
    header("Location: web01.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

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
    <link rel="stylesheet" href="css/csslogin.css">
</head>
<body>

<form action="" method="post">
<div class="card" style="width: 22rem;">
    <div class="card-body">
        <h2 class="login-title">Ourchives</h2> <br>

    <?php if (isset($errors)) : ?>
        <p style="color: red; font-style: italic;">username / password salah</p>
    <?php endif; ?>

        <div class="mb-2">
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
            <i class="person-icon bi bi-person-fill"></i>
        </div>
        <div class="mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required  aria-describedby="pwNote"> <br>
            <i class='lock-icon bx bxs-lock-alt'></i>
        </div>
        <div class="mb-3 form-check">
            <label for="remember"><input type="checkbox" class="form-check-input" id="remember" name="remember">Remember me</label>
            <a href="">Forgot password?</a>
        </div>
        <button type="submit" class="btn btn-primary" name="login">Sign In</button>
        <div class="regist">
            <p>Don't have an account?<a href="regist.php">Sign Up</a></p>
        </div>
    </div>
</div>
</form>

</body>
</html>