<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'func.php';
$maba = query("SELECT * FROM maba");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Halaman</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <h1> Daftar Mahasiswa Baru </h1>

    <table border="1" cellpadding="10" cellspacing="0" align="center">
        <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Nama Siswa</th>
            <th>NISN</th>
            <th>Asal Sekolah</th>
        </tr>';

        $i = 1;
        foreach($maba as $baris) {
            $html .= 
            '<tr>
                <td>'. $i++ .'</td>
                <td> <img src="img/'. $baris["gambar"] .'" width="50px"></td>
                <td>'. $baris["namaSiswa"] .'</td>
                <td>'. $baris["nisn"] .'</td>
                <td>'. $baris["asalSekolah"] .'</td>
            </tr>';
        }

    
$html .= '</table>
</body>
</html>';

$mpdf->WriteHTML($html);
//output adalah tampilan saat download, INLINE dapat diganti, boleh dicari di web dari mpdf nya
$mpdf->Output('daftar-maba.pdf', \Mpdf\Output\Destination::INLINE);

?>
