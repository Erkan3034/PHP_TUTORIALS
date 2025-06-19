<?php
require_once '../system/baglanti.php';
require_once '../system/fonksiyon.php';
	
session_start();
if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
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

    <footer class="text-center">
        <p>Copyright &copy; 2025 Öğrenci Bilgi Sistemi</p>
        <a href="cikis.php" class="btn btn-danger">Çıkış Yap</a>
    </footer>
</body>
</html>