<?php
session_start(); // Önce session'ı başlat
require_once "../system/baglanti.php";
require_once "../system/fonksiyon.php";

// Session değişkenlerini temizle
$_SESSION = array();

// Session cookie'sini sil
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Session'ı yok et
session_destroy();

// Tüm çerezleri temizle
foreach ($_COOKIE as $key => $value) {
    setcookie($key, '', time()-3600, '/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Çıkış Yap</title>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between">
            <p class="h3 text-center">Güvenli Çıkış yapıldı</p>
        </div>
        <div class="card-body">
            <div class="alert alert-success">
                Oturum başarıyla sonlandırıldı. <br> Lütfen bekleyin yönlendiriliyorsunuz.
                <?php 
                // Tam yol yerine göreceli yol kullan
                go("../index.php", 2);
                ?>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>