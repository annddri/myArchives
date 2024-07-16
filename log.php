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

if (isset($_SESSION["login"])) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/csslogin.css">
</head>
<body>

<form action="" method="post">
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">LOGIN</h5>

<?php if (isset($errors)) : ?>
    <p style="color: red; font-style: italic;">username / password salah</p>
<?php endif; ?>

    <div class="mb-3">
    <label for="username" style="display: block;" class="form-label">Username</label>
    <input type="text" name="username" id="username" class="form-control" required>
  </div>
  <div class="mb-3">
  <label for="password" style="display: block;" class="form-label">Password</label>
  <input type="password" name="password" id="password" class="form-control" required  aria-describedby="pwNote">
  <div id="pwNote" class="form-text">8 - 12 karakter.</div>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="remember" name="remember">
    <label class="form-check-label" for="remember">Remember Me</label>
  </div>
  <button type="submit" class="btn btn-primary" name="login">Sign In</button>
    </div>
</div>
</form>

</body>
</html>