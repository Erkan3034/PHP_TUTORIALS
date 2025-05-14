<?php
echo "<h2>📌 PHP Vize Sınavı Notları ve Örnekler</h2>";

/* ========================
   🔹 1. DEĞİŞKENLER & SABİTLER
======================== */

$ad = "Erkan";
$yas = 21;
define("SITE", "coderrzone.com"); //sabit tanımlama

// const SITE = "coderrzone.com"; //sabit tanımlama (PHP 5.3 ve üstü için geçerli)
const PI = 3.14; //sabit tanımlama 

echo "<h3>Değişkenler ve Sabitler</h3>";
echo "Ad: $ad<br>";
echo "Yaş: $yas<br>";
echo "Site: " . SITE . "<br>";
echo "Pi: " . PI . "<br>";

/* ================================================================
   🔹 2. STRİNG FONKSİYONLARI
================================================================ */

echo "<h3>String Fonksiyonları</h3>";
$metin = " PHP Öğrenmek GÜZEL ";

echo "Orijinal: '$metin'<br>";
echo "trim(): '" . trim($metin) . "'<br>";
echo "strlen(): " . strlen($metin) . "<br>";
echo "strtoupper(): " . strtoupper($metin) . "<br>";
echo "strtolower(): " . strtolower($metin) . "<br>";
echo "substr(): " . substr($metin, 0, 6) . "<br>";
echo "str_replace(): " . str_replace("GÜZEL", "HARİKA", $metin) . "<br>";

/* ================================================================
   🔹 3. KOŞULLAR
=================================================================== */

echo "<h3>Koşullar</h3>";

$sayi = 15;

if ($sayi > 10) {
    echo "$sayi 10'dan büyük<br>";
} elseif ($sayi == 10) {
    echo "Sayı 10'a eşit<br>";
} else {
    echo "Sayı 10'dan küçük<br>";
}

/* ================================================================
   🔹 4. DİZİLER (Arrays)
================================================================ */

echo "<h3>Diziler</h3>";

// Dizi tanımlama
$renkler = array("kırmızı", "mavi", "yeşil");

echo "1. Renk: " . $renkler[0] . "<br>";

// Foreach ile diziyi gezmek
foreach ($renkler as $renk) {
    echo "Renk: $renk<br>";
}

// Associative array
$kisi = array("ad" => "Erkan", "yas" => 21);

echo "Ad: " . $kisi["ad"] . "<br>";
echo "Yaş: " . $kisi["yas"] . "<br>";

/* ========================
   🔹 5. DÖNGÜLER
======================== */

echo "<h3>Döngüler</h3>";

// for
for ($i = 1; $i <= 5; $i++) {
    echo "For Döngüsü: $i<br>";
}

// while
$j = 1;
while ($j <= 3) {
    echo "While Döngüsü: $j<br>";
    $j++;
}

// do-while
$k = 1;
do {
    echo "Do-While: $k<br>";
    $k++;
} while ($k <= 2);

/* ========================
   🔹 6. FONKSİYONLAR
======================== */

echo "<h3>Fonksiyonlar</h3>";

function topla($a, $b) {
    return $a + $b;
}

echo "5 + 3 = " . topla(5, 3) . "<br>";

?>
