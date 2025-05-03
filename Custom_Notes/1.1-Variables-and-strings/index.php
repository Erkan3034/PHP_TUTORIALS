<?php
// ------------------------
// ===================SABİT DEĞİŞKENLER=================
// ------------------------

// Eski yöntem (her yerde çalışır)
define("SITE_ADI", "CoderrZone");

// Modern yöntem (PHP 5.3+)
const SITE_URL = "https://coderrzone.wasmer.app";

// ------------------------
// NORMAL DEĞİŞKENLER
// ------------------------

$isim = "Erkan";
$yas = 21;
$aktif = true;

echo "<h3>PHP Değişkenler</h3>";
echo "Hoş geldin $isim!<br>";
echo "Yaşın: $yas<br>";
echo "Aktif mi? " . ($aktif ? "Evet" : "Hayır") . "<br>";
echo "Site adı: " . SITE_ADI . "<br>";
echo "Site URL: " . SITE_URL . "<br><br>";

// ------------------------
// STRING FONKSİYONLARI
// ------------------------

echo "<h3>String Fonksiyonları</h3>";

$metin = "   Merhaba CoderrZone!   ";
echo "Orijinal metin: '$metin'<br>";

// 1. strlen() // Uzunluk
echo "Uzunluk (strlen): " . strlen($metin) . "<br>";

// 2. strtoupper() & strtolower() // Büyük/küçük harf
echo "Büyük harf (strtoupper): " . strtoupper($metin) . "<br>";
echo "Küçük harf (strtolower): " . strtolower($metin) . "<br>";

// 3. trim() // Boşlukları temizleme
$temizMetin = trim($metin);
echo "Boşluksuz metin (trim): '$temizMetin'<br>";

// 4. substr()   // Parçalama 
echo "Parça (substr 0, 8): " . substr($temizMetin, 0, 8) . "<br>";

// 5. str_replace()     // Değiştirme
// str_replace() ile "CoderrZone" kelimesini "Erkan" ile değiştirme
echo "Değiştir (CoderrZone → Erkan): " . str_replace("CoderrZone", "Erkan", $temizMetin) . "<br>";

// 6. strpos() // Konum bulma
// strpos() ile "Coderr" kelimesinin konumunu bulma
echo "Konum (strpos 'Coderr'): " . strpos($temizMetin, "Coderr") . "<br>";

// 7. explode() // Diziye ayırma 
$cumle = "PHP öğrenmek çok keyifli";
$dizi = explode(" ", $cumle);
echo "explode(): <pre>";
print_r($dizi);
echo "</pre>";

// 8. implode() // Diziyi birleştirme
echo "implode(): " . implode(" | ", $dizi) . "<br>";

?>

