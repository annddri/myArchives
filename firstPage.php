<?php

require "func.php";

if (isset($_POST["sign"])) {
    $_SESSION["firstPage"] = true;
}

// if ($_SESSION["login"] = true) {
//     $utama = [];
// }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <a href="log.php" name="sign">login</a>
        <a href="regist.php" name="sign">regist</a>


        <?php if (isset($utama)) : ?>
            <!-- <a href="web01.php" name="utama">Menuju ke Halaman Utama</a> -->
    <?php endif; ?>
        
    
    
    
    
</body>
</html>