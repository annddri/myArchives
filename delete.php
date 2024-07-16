<?php
require 'func.php';

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: log.php");
    exit;
}

$no = $_GET["no"];

if ( del($no) > 0 ) {
    echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = 'web01.php';
            </script>
        ";
} else {
    echo "
        <script>
            alert('Data Gagal Dihapus!');
            document.location.href = 'web01.php';
        </script>
    ";
}
?>