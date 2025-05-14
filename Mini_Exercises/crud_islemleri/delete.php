<?php
$host = 'localhost';
$user = 'root';
$password = 'Erkan1205/*-+';
$database = 'university';
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Bağlantı Hatası: " . $conn->connect_error);
}

$id = $_GET['id'];

if (is_numeric($id)) {
    // ID'nin sayısal olup olmadığını kontrol et
    $sql = "DELETE FROM student WHERE studentNo = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Silme işlemi başarılıysa ana sayfaya yönlendir 
        exit;
    } else {
        echo "Silme hatası: " . $conn->error;
    }
} else {
    echo "Geçersiz ID.";
}
?>

