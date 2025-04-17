<?php

//!====================================================================================================================

/*
------------Temel Dizi Fonksiyonları-----------

🐘count($array): Dizideki eleman sayısını döndürür.

🐘array_push($array, $value): Dizinin sonuna eleman ekler.

🐘array_pop($array): Dizinin son elemanını çıkarır ve döndürür.

🐘array_unshift($array, $value): Dizinin başına eleman ekler.

🐘array_shift($array): Dizinin ilk elemanını çıkarır ve döndürür.



--------------2. Dizi Filtreleme ve Dönüştürme--------------

🐘array_filter($array, $callback): Belirtilen koşula uyan elemanları içeren yeni bir dizi döndürür.

🐘array_map($callback, $array): Her elemanı belirli bir fonksiyona göre işler ve yeni bir dizi döndürür.

🐘array_reduce($array, $callback, $initial): Diziyi belirli bir işleme tabi tutarak tek bir değer döndürür.


-------------------3. Dizi Sıralama-------------------

🐘sort($array): Diziyi küçükten büyüğe sıralar.

🐘rsort($array): Diziyi büyükten küçüğe sıralar.

🐘asort($array): Diziyi değerlerine göre sıralar ve indeksleri korur.

ksort($array): Diziyi anahtarlarına göre sıralar.

🐘shuffle($array): Diziyi rastgele sıralar.



-------------------4. Anahtar & Değer İşlemleri-------------------

🐘array_keys($array): Dizinin anahtarlarını döndürür.

🐘array_values($array): Dizinin değerlerini döndürür.

🐘array_key_exists($key, $array): Belirtilen anahtarın dizide olup olmadığını kontrol eder.

🐘in_array($value, $array): Belirtilen değerin dizide olup olmadığını kontrol eder.


-----------------------5. Dizi Birleştirme & Bölme-----------------------

🐘array_merge($array1, $array2): İki veya daha fazla diziyi birleştirir.

🐘array_combine($keys, $values): İki ayrı diziyi birleştirerek anahtar-değer çiftlerinden oluşan bir dizi oluşturur.

🐘array_slice($array, $start, $length): Belirtilen aralıktaki elemanları alır.

🐘array_splice($array, $start, $length, $replacement): Belirtilen aralıktaki elemanları değiştirir.


------------------------6. Dizi Fark & Kesişim İşlemleri-----------------

🐘array_diff($array1, $array2): İlk dizide olup ikinci dizide olmayan elemanları döndürür.

🐘array_intersect($array1, $array2): Her iki dizide ortak olan elemanları döndürür. */




//!====================================================================================================================

$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

$dizge = implode(' - ', $arr); //verilen dizi elemanlarını istenilen sembolle birleştirir ve bir dize döndürür


print_r($dizge);
echo "<hr>";
$newArr = explode(' - ', $dizge); //İmplode ile yapılan işemi geri alır ve dizi döndürür.

echo "<pre>";
print_r($newArr);

echo "<hr>";

echo count($newArr); //dizinin eleman sayısını döndürür

echo "<hr>";

echo is_array($newArr) ? "Bu bir dizidir.." : "Bu bir dizi değildir.."; //dizinin elemanının dizi olup olmadığını kontrol eder

echo "<hr>";

$sayilar = range(1, 20); //belirtilen aralıktaki sayıları içeren bir dizi oluşturur
//! shuffle() fonksiyonu dizinin elemanlarını karıştırır

shuffle($sayilar);  //örneğin sayısal loto için kullanılabilir.

print_r($sayilar);

echo "<hr>";


//! array_combine() fonksiyonu iki ayrı diziyi birleştirerek anahtar-değer çiftlerinden oluşan bir dizi oluşturur.

//pythondaki zip() fonksiyonuna benzer.

$meyveler = ['elma', 'armut', 'muz', 'çilek'];
$harfler = ['a', 'b', 'c', 'd'];

$combine_array = array_combine($meyveler, $harfler);

print_r($combine_array);

echo "<hr>";


//! array_count_values() fonksiyonu dizideki değerlerin kaç kez tekrarlandığını sayar ve bir dizi döndürür.
$array = array(1, "hello", 1, "world", "hello");
print_r(array_count_values($array));
echo "<hr>";


//! array_flip() fonksiyonu dizinin anahtarlarını değerlere ve değerleri anahtarlara dönüştürür.
$array = array("oranges", "apples", "pears");
$flipped_array = array_flip($array);
print_r($flipped_array);
echo "<hr>";


//! array_key_exists() fonksiyonu belirtilen anahtarın dizide olup olmadığını kontrol eder.

$arrayEx = [
    'first' => 1,
    'second' => 2,
    'third' => 3,
];
if (array_key_exists('first', $arrayEx)) {
    echo " 'first' Anahtarı bulundu";
}

echo "<hr>";
//! array_map() fonksiyonu her elemanı belirli bir fonksiyona göre işler(geriçağırım) ve yeni bir dizi döndürür.

function cube($n)
{
    return ($n * $n * $n);
}

$a = [1, 2, 3, 4, 5];
$b = array_map('cube', $a);
print_r($b);

echo "<hr>";

//! array_merge() fonksiyonu iki veya daha fazla diziyi birleştirir.
$array1 = array("color" => "red", 2, 4);
$array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);
$result = array_merge($array1, $array2);
print_r($result);

echo "<hr>";

//! array_search(); fonksiyonu belirtilen değerin dizide olup olmadığını kontrol eder ve varsa anahtarını döndürür.
$array = array(0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red');

$key = array_search('green', $array); // $key = 2;
$key = array_search('red', $array);   // $key = 1;


echo $key;
echo "<hr>";


//! in_array() fonksiyonu belirtilen değerin dizide olup olmadığını kontrol eder ve boolean döndürür.
$arrA = ["elma", "Armut", "Muz"];

if (in_array("Erkan", $arrA)) {
    echo "Erkan dizide var";
} else {
    echo "Erkan dizide yok!";
}
echo "<hr>";


//! array_shift() Dizinin başlangıcından bir eleman çıkarır.

$arrB = ["istanbul", "Ankara", "izmir"];

$eleman = array_shift($arrB);

print_r($arrB); //ilk eleman çıkarıldıktan sonra kalan diziyi döndürür

echo "<hr>";


//! array_pop() Dizinin sonundan bir eleman çıkarır.
$arrC = ["Adana", "Antalya", "izmir"];
$eleman2 = array_shift($arrC);
print_r($arrC); //son eleman çıkarıldıktan sonra kalan diziyi döndürür

echo "<hr>";


//! array_slice() bir dizinin belli bir bölümünü döndürür
echo "Slice İşlemleri <hr>";
$arrD = ["a", "b", "c", "d", "e", "f"];
$eleman3 = array_slice($arrD, 1, 4); //1. indexten itiaban 4 nesne alır.
$output = array_slice($arrD, -2, 1); //sondan 2. elemandan itibaren 1 eleman alır.

$output2 = array_slice($arrD, 0, 3); // Dizinin başından başla 3 eleman al

print_r($eleman3); //slice edilen diziyi döndürür
echo "<hr>";
print_r($output); //slice edilen diziyi döndürür
echo "<hr>";
print_r($output2); //slice edilen diziyi döndürür

echo "<hr>";


//! array_sum() fonksiyonu dizinin elemanlarının toplamını döndürür.

$arrE = [1, 2, 3, 4, 5];
$eleman4 = array_sum($arrE);
echo "Elemanların toplamı " . ": " . $eleman4; //dizinin elemanlarının toplamını döndürür
echo "<hr>";


//!array_product() fonksiyonu dizinin elemanlarının çarpımını döndürür.
$arrF = [1, 2, 3, 4, 5];
$eleman5 = array_product($arrF);
echo "Elemanların çarpımı " . ": " . $eleman5; //dizinin elemanlarının çarpımını döndürür
echo "<hr>";



//! array_unique() fonksiyonu dizideki tekrar eden elemanları kaldırır ve benzersiz elemanları döndürür.
$arrG = [1, 2, 3, 4, 5, 1, 2, 3, 4, 5];
$eleman6 = array_unique($arrG);
echo "Unique edilmiş array: ";
print_r($eleman6);

echo "<hr>";


//! array_values() fonksiyonu dizinin değerlerini döndürür.

$diziDegerleri = array(
    "beden" => "S",
    "renk" => "Mavi",

);
print_r(($diziDegerleri)); //dizinin tümünü(key-value) hepsini yazar.
print_r(array_values($diziDegerleri)); //dizinin değerlerini döndürür


echo "<hr>";

//! array_push() fonksiyonu dizinin sonuna eleman ekler.
$arrH = array("a", "b", "c");
$eleman8 = array_push($arrH, 1, 2, 3);
print_r($arrH); //dizinin sonuna eleman ekler ve diziyi döndürür
echo "<hr>";


// array_push() dizinin başlangıcına bir veya daha fazla eleman ekler.

$diziPush = [
    "a",
    "b",
    "c",
];
$eleman9 = array_unshift($diziPush, 10, 20, 30); //dizinin başına eleman ekler ve diziyi döndürür
print_r($diziPush); //dizinin başına eleman ekler ve diziyi döndürür
echo "<hr>";

//! array_keys() fonksiyonu dizinin anahtarlarını döndürür.
$diziAnahtarlar = array(
    "beden" => "S",
    "renk" => "Mavi",
    "fiyat" => 100,
);
print_r(array_keys($diziAnahtarlar)); //dizinin anahtarlarını döndürür


$arrayKeys = array("blue", "red", "green", "blue", "blue");
print_r(array_keys($arrayKeys, "blue")); //verilen dizi anakhtarının dizide hani indexlerde olduğunu göserir.
echo "<hr>";


//?=====================================================================================================================

//! current() - Mevcut dizi elemanını döndürür
$arr = ['a', 'b', 'c'];
$current = current($arr); // 'a'
echo "Current: " .$current; // 'a'
echo "<hr>";

//! end() - Dizi işaretçisini son elemana götürür
 $end = end($arr);
echo "End: " .current($arr); // 'c'

echo "<hr>";

//!next() - İşaretçiyi bir sonraki elemana götürür
reset($arr);
next($arr);

echo "Next: " .current($arr); // 'b'

echo "<hr>";

//! prev() - İşaretçiyi bir önceki elemana götürür
end($arr);
prev($arr);
echo "Prev: " .current($arr); // 'b'

echo "<hr>";

//!reset() - İşaretçiyi ilk elemana götürür
end($arr);
reset($arr);
echo "reset: " .current($arr); // 'a'

echo "<hr>";

//! extract() - Diziyi değişkenlere dönüştürür
$user = ['name' => 'Ali', 'age' => 25];
extract($user);
echo "Extract: " .$name; // 'Ali', echo $age; // 25

echo "<hr>";

//!asort() - Değerlere göre sıralar (anahtarları korur)
$nums = [3 => 'c', 1 => 'a', 2 => 'b'];

asort($nums);
echo "asort(değerlere göre sıralama): <br>";
print_r($nums); // [1=>'a', 2=>'b', 3=>'c']

echo "<hr>";

//! arsort() - Değerlere göre ters sıralar
arsort($nums);
echo "arsort(değerlere göre TERS sıralama): <br>";
print_r($nums); // [3=>'c', 2=>'b', 1=>'a']

echo "<hr>";

//! ksort() - Anahtarlara göre sıralar
$nums = [3 => 'c', 1 => 'a', 2 => 'b'];
ksort($nums);
echo "ksort(Anahtarlara göre  sıralama): <br>";
print_r($nums); // [1=>'a', 2=>'b', 3=>'c']

echo "<hr>";

//! krsort() - Anahtarlara göre ters sıralar
krsort($nums);
echo "ksort(Anahtarlara göre TERS sıralama): <br>";
print_r($nums); // [3=>'c', 2=>'b', 1=>'a']
