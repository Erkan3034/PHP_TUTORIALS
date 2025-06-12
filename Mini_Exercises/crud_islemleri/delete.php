<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Sil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
</body>
</html>
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'Önce giriş yapmalısınız.'; 
    go('http://localhost/PHP_NOTES/Mini_Exercises/crud_islemleri/login.php', 0); // Redirect to login page
    exit;
}

$host = 'localhost';
$user = 'root';
$password = 'Erkan1205/*-+';
$database = 'university';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Bağlantı Hatası: " . $conn->connect_error);
}

$id = $_GET['id'];

// ID sayısal mı kontrol edelim
if (is_numeric($id)) {

    /*
    // Hazırlıklı sorgu (prepared statement)
    $stmt = $conn->prepare("DELETE FROM student WHERE studentNo = ?");
    */

    //Kayıt silme işlemini UPDATE ile yapıyoruz. 
    $sql="UPDATE student SET sil=1 WHERE studentNo = ?"; // studentNo'ya göre silme işlemi durumunu 1 yapıyoruz(biz sadece 2 olanları listelemiştik)
    $stmt = $conn->prepare($sql);

    if ($stmt) { //
        $stmt->bind_param("i", $id);  // i: integer tipi
        
        if ($stmt->execute()) {
            echo '<div class="alert alert-success mt-5 container ms-5 me-5" role="alert">
                    Kayıt başarıyla silindi! Ana sayfaya yönlendiriliyorsunuz...
                  </div>';
            header("Refresh:2; url=index.php");
            exit;
        } else {
            echo '<div class="alert alert-danger mt-5 container ms-5 me-5" role="alert">
                    Kayıt silinemedi!
                  </div>' . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Sorgu hazırlanamadı: " . $conn->error;
    }

} else {
    echo "Geçersiz ID.";
}

$conn->close();
?>


<!--
Silme - Güncelleme gibi işlemleri Benzersiz Key(Primary Key ) ile yapmalıyız. Çünkü aynı isme sahip farklı farklı kullanıcılar olabilir. Bu tür hassas işlemler benzersiz olan nesne ne ie onun üzerinden yapılmalıdır!
-->

