<?php
require_once '../system/baglanti.php';

if(!isset($_SESSION['id'])){
    header("Location: ../index.php ");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Bilgi Sistemi</title>
</head>
<body>
    <h1>Hoşgeldiniz</h1>
</body>
</html>