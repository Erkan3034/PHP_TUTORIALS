<?php
$servername = "localhost";
$username = "root"; // MySQL kullanıcı adı
$password = "Erkan1205/*-+"; // MySQL şifresi
$database = "university"; // Bağlanılacak veritabanı adı

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>