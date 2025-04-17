<?php

//! User-defined func.===============================
function myMessage($message)
{
    echo "" . $message . "";
}

myMessage("HELLO ERKAN...");
echo "<hr>";


//!================VİZE-FİNAL HESAPLAMA==============

function calculatePoint($vize, $final)
{
    $not = ($vize * 0.4) + ($final * 0.6);
    if ($not>50) {
        echo "Notunuz: $not. Geçtiniz...";
    }
    else {
        echo "Kaldınız.";
    }

}


calculatePoint(90, 86);
echo "<hr>";
//!===============MATEMAİKSEL iŞLEM===================

function hesapla($number){
    echo ($number > 99 && $number < 1000) ? "Sayı 3 basamaklıdır\n <br>" : "Sayı 3 basamaklı değildir\n";

    $yuzler = intval($number / 100);

    $onlar = intval(($number / 10) % 10);
    
    $birler = $number % 10;

    $numbers = array($yuzler, $onlar, $birler);

    for ($i = 0; $i < count($numbers); $i++) { //dizi uzunluğu
        echo $numbers[$i] . "\n"; 
    }
}

// Örnek kullanım
hesapla(374);

?>