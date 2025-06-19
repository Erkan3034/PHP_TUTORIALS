<?php
session_start();
require_once "../system/baglanti.php";
require_once "../system/fonksiyon.php";

// Oturum kontrolü
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}

// GET parametresini kontrol et
if (!isset($_GET['studentNo']) || !is_numeric($_GET['studentNo'])) {
    header("Location: default.php");
    exit;
}

$gelen_ogrenci_no = (int)$_GET['studentNo'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <title>Kayıt Silme</title>
</head>
<body>
    <div class="container">
        <?php
        // Öğrencinin var olduğunu kontrol et
        $kontrol_sorgu = "SELECT studentNo FROM student WHERE studentNo = ? AND sil = 2";
        $kontrol_stmt = $conn->prepare($kontrol_sorgu);
        $kontrol_stmt->bind_param('i', $gelen_ogrenci_no);
        $kontrol_stmt->execute();
        $kontrol_result = $kontrol_stmt->get_result();

        if ($kontrol_result->num_rows === 0) {
            echo '<div class="alert alert-danger mt-5" role="alert">
                Geçersiz öğrenci numarası veya kayıt zaten silinmiş!
            </div>';
            header("Refresh:2; url=default.php");
            exit;
        }

        // Silme işlemi (soft delete)
        $sil_sorgu = "UPDATE student SET sil = 1 WHERE studentNo = ? AND sil = 2";
        $stmt = $conn->prepare($sil_sorgu);
        $stmt->bind_param('i', $gelen_ogrenci_no);

        
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            echo '<div class="alert alert-success mt-5" role="alert">
                Kayıt başarıyla silindi! Ana sayfaya yönlendiriliyorsunuz...
            </div>';
            header("Refresh:2; url=default.php");
            exit;
        } else {
            echo '<div class="alert alert-danger mt-5" role="alert">
                Silme işlemi başarısız! Tekrar deneyiniz.
            </div>';
            header("Refresh:2; url=default.php");
        }
        ?>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>