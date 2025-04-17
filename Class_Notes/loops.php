<?php
//! ========================================== while loop===================== 
/*
$i = 1;
$toplam = 0;

while ($i < 11) {
    $toplam += $i;
    $i++;
}
echo "Sayıların Toplamı: " . $toplam;

*/
//!======================================== FOR LOOP ===================== 
$toplam = 0;
$ciftler = [];
$tekler = [];

for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 == 0) {
        $ciftler[] = $i;
        $toplam += $i;
    } else {
        $tekler[] = $i;
    }
}

echo "Çift Sayılar: " . implode(", ", $ciftler) . "<br>";
echo "Tek Sayılar: " . implode(", ", $tekler) . "<br>";
echo "Çift Sayıların Toplamı: " . $toplam;

/**
 * implode() Fonksiyonunun Temel İşlevi:
 *Bir diziyi alır.
 *Dizideki elemanları belirtilen bir ayraç (glue) kullanarak birleştirir.
 *Birleştirilmiş dizeyi döndürür. */
//!========================================
echo "<hr>";
$first = 2019;
$last = 1990;

for ($i = $first; $i >= 1990; $i--) {
    echo $i . "<br>";

}
//!=============== DO- WHILE=========================
echo "<hr>";
$a=1;
do {
    echo "Erkan <br>";
    $a++;
} while ($a <= 10);

echo "<hr>";

//!================================================
// 7 sayısını görünce dursun.

for ($y = 1; $y <101; $y++){
    echo $y ."<br>";
    if ($y== 7) {
        break;
    }
}
echo "Rakam Bulundu: " .$y;

//!================================================
echo "<hr>";

for ($y = 1; $y <101; $y++){
    echo $y ."<br>";
    if ($y% 7 == 0 && $y% 10== 0) { //hem 7 hem 10'a bölünen sayıda durdur.
        break;
    }
}
echo "Rakam Bulundu: " .$y;
//!================================================

//ÜS-TABAN
echo "<hr>";
$us = 2;
$taban =25;
echo $taban ** $us;
//!================================================
echo "<hr>";

//Üçgen çizme
for ($j=1; $j<5; $j++){ //satır sayısı
    for ($k= 1; $k<= $j; $k++){ //yıldız sayısı
        echo "❤️   ";
    }
    echo "<br>"; 
}
for ($j = 3; $j >= 1; $j--) {
    for ($k = 1; $k <= $j; $k++) {
        echo "❤️   ";
    }
    echo "<br>";
}

//!================================================

echo "<hr>";
function eskenarUcgen($yukseklik) {
    // Üçgenin yüksekliğini alır ve üçgeni çizer
    // Yükseklik kadar satır döngüsü

    for ($i = 1; $i <= $yukseklik; $i++) {
        // Boşlukları yazdır
        for ($j = $yukseklik - $i; $j > 0; $j--) { 
            echo "&nbsp;&nbsp;"; // HTML'de boşluk için &nbsp; kullanıyoruz
        }

        // Yıldızları yazdır
        for ($k = 1; $k <= (2 * $i - 1); $k++) {
            echo "*";
        }

        echo "<br>"; // Yeni satıra geç
    }
}

eskenarUcgen(10); // Üçgenin yüksekliğini burada belirleyebilirsiniz


    ?>