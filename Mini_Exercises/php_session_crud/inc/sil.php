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

// Öğrencinin var olduğunu kontrol et
$kontrol_sorgu = "SELECT studentNo FROM student WHERE studentNo = ? AND sil = 2";
$kontrol_stmt = $conn->prepare($kontrol_sorgu);
$kontrol_stmt->bind_param('i', $gelen_ogrenci_no);
$kontrol_stmt->execute();
$kontrol_result = $kontrol_stmt->get_result();

if ($kontrol_result->num_rows === 0) {
    header("Location: default.php");
    exit;
}

// Silme işlemi (soft delete)
$sil_sorgu = "UPDATE student SET sil = 1 WHERE studentNo = ? AND sil = 2";
$stmt = $conn->prepare($sil_sorgu);
$stmt->bind_param('i', $gelen_ogrenci_no);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    header("Location: default.php?success=3");
} else {
    header("Location: default.php");
}
exit;