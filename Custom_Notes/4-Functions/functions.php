<?php
//! =========================Temel fonksiyon yapısı=========================

function isim1()
{
    return "Erkan";
}
 
$isim = isim1();
echo $isim;

//!============================================================================
echo "<hr>";
function sumNumbers1($number1, $number2)
{
    return $number1 + $number2;
}

echo sumNumbers1("12", "5");
echo "<hr>";


//!======================================== ANONİM FONKSİYONLAR=================

/**
 * Anonim fonksiyonlar normal fonksiyonlara benzer, çünkü çağrıldığında çalıştırılan kod bloğunu içerirler. 
 * Ayrıca argümanları kabul edebilir ve değerleri döndürürler. Anonim fonksiyonları değişkene atayarak kullanılır.
 * Anonim fonksiyon ile normal fonksiyon tanımı arasında iki önemli fark bulunuyor:
 * Anonim fonksiyonlar isimsizdir.
 * Anonim fonksiyonlar tanımlanırken noktalı virgül ile biter.
 * Anonim fonksiyonlarla örnek olarak şunları yapabiliriz.
 * Bir dizide birçok farklı Anonim fonksiyon saklayabiliriz.
 * Bir fonksiyona parametre olarak aktarabilirsiniz.
 */


$isimsiz_topla = function ($n1, $n2) { //İsimsiz
    return $n1 + $n2;
};

echo $isimsiz_topla(90, 90);

echo "<hr>";

/* array_map(), PHP'de dizilerle çalışmak için çok kullanışlı bir fonksiyondur. 
 * Temel amacı, bir dizinin her bir elemanına belirli bir fonksiyonu uygulamak ve sonuçları yeni bir dizi olarak döndürmektir.
 */
echo "<pre>";
$sayilar = [1, 2, 3, 4, 5];
$kareler = array_map(function ($sayi) {
    return $sayi * $sayi;
}, $sayilar);

print_r($kareler);
echo "<hr>";

//!================================================================================================
$islem = [
    'topla' => function ($a, $b) {
        return $a + $b;
    },
    'carp'  => function ($a, $b) {
        return $a * $b;
    },
    'cikar' => function ($a, $b) {
        return $a - $b;
    },
    'bol'   => function ($a, $b) {
        return $a / $b;
    }
];

echo "Function Array (division): " . $islem['bol'](24, 8);
echo "<br>";
echo "Function Array (minus): " . $islem['cikar'](45, 15);
echo "<hr>";



//! PASS BY VALUE - PASS by REFERENCE 

/*
   pass by Value (Değer ile Geçirme):
     Fonksiyona değişkenin bir kopyası gönderilir, orijinal değişken değişmez.
     Fonksiyon içinde yapılan değişiklikler, yalnızca kopyayı etkiler.

   Pass by Reference (Referans ile Geçirme):
     Fonksiyona değişkenin kendisi (referansı) gönderilir, orijinal değişken değişir.
     Fonksiyon içinde yapılan değişiklikler, doğrudan orijinal değişkeni etkiler.
*/

// pass by value
function valGeek1($num)
{
    $num += 2;
    return $num;
}

// pass by reference
function refGeek1(&$num)
{
    $num += 10;
    return $num;
}

$n = 10;

valGeek1($n);
echo "The original value is still ('Pass By Value') $n \n";
echo "<br>";
refGeek1($n);
echo "The original value changes to('Pass By Ref') $n";


//?=====================================================================================================================


?>
<<<<<<< HEAD
=======
<?php
//! =========================Temel fonksiyon yapısı=========================

function isim()
{
    return "Erkan";
}
 
$isim = isim();
echo $isim;

//!============================================================================
echo "<hr>";
function sumNumbers($number1, $number2)
{
    return $number1 + $number2;
}

echo sumNumbers("12", "5");
echo "<hr>";


//!======================================== ANONİM FONKSİYONLAR=================

/**
 * Anonim fonksiyonlar normal fonksiyonlara benzer, çünkü çağrıldığında çalıştırılan kod bloğunu içerirler. 
 * Ayrıca argümanları kabul edebilir ve değerleri döndürürler. Anonim fonksiyonları değişkene atayarak kullanılır.
 * Anonim fonksiyon ile normal fonksiyon tanımı arasında iki önemli fark bulunuyor:
 * Anonim fonksiyonlar isimsizdir.
 * Anonim fonksiyonlar tanımlanırken noktalı virgül ile biter.
 * Anonim fonksiyonlarla örnek olarak şunları yapabiliriz.
 * Bir dizide birçok farklı Anonim fonksiyon saklayabiliriz.
 * Bir fonksiyona parametre olarak aktarabilirsiniz.
 */


$isimsiz_topla = function ($n1, $n2) { //İsimsiz
    return $n1 + $n2;
};

echo $isimsiz_topla(90, 90);

echo "<hr>";

/* array_map(), PHP'de dizilerle çalışmak için çok kullanışlı bir fonksiyondur. 
 * Temel amacı, bir dizinin her bir elemanına belirli bir fonksiyonu uygulamak ve sonuçları yeni bir dizi olarak döndürmektir.
 */
echo "<pre>";
$sayilar = [1, 2, 3, 4, 5];
$kareler = array_map(function ($sayi) {
    return $sayi * $sayi;
}, $sayilar);

print_r($kareler);
echo "<hr>";

//!================================================================================================
$islem = [
    'topla' => function ($a, $b) {
        return $a + $b;
    },
    'carp'  => function ($a, $b) {
        return $a * $b;
    },
    'cikar' => function ($a, $b) {
        return $a - $b;
    },
    'bol'   => function ($a, $b) {
        return $a / $b;
    }
];

echo "Function Array (division): " . $islem['bol'](24, 8);
echo "<br>";
echo "Function Array (minus): " . $islem['cikar'](45, 15);
echo "<hr>";



//! PASS BY VALUE - PASS by REFERENCE 

/*
   pass by Value (Değer ile Geçirme):
     Fonksiyona değişkenin bir kopyası gönderilir, orijinal değişken değişmez.
     Fonksiyon içinde yapılan değişiklikler, yalnızca kopyayı etkiler.

   Pass by Reference (Referans ile Geçirme):
     Fonksiyona değişkenin kendisi (referansı) gönderilir, orijinal değişken değişir.
     Fonksiyon içinde yapılan değişiklikler, doğrudan orijinal değişkeni etkiler.
*/

// pass by value
function valGeek($num)
{
    $num += 2;
    return $num;
}

// pass by reference
function refGeek(&$num)
{
    $num += 10;
    return $num;
}

$n = 10;

valGeek($n);
echo "The original value is still ('Pass By Value') $n \n";
echo "<br>";
refGeek($n);
echo "The original value changes to('Pass By Ref') $n";


//?=====================================================================================================================


?>
>>>>>>> cbc7f9893baa939c1a26651bf141a64ce1edf6fe
