<<<<<<< HEAD
<?php
//! $_POST = bir dizi (array) olarak formdan gelen verileri tutar BU YÜZDEN VERİLERİ ALIRKEN İŞLEME ALMAK İSTEDİĞİMİZDE ARRAY FONKSİYONLARINI UYGULAYABİLİRİZ.

// $_POST['name'] = formda name adında bir input varsa onun değerini tutar
// $_POST['email'] = formda email adında bir input varsa onun değerini tutar
// $_POST['message'] = formda message adında bir input varsa onun değerini tutar
// $_POST['submit'] = formda submit adında bir input varsa onun değerini tutar


echo "<h1 style='text-align: center;'>POST İŞLEMLERİ</h1>";
echo "<h2 style='text-align: center;'>Formdan gelen veriler</h2>";


$name = $_POST['isim'];
$clearedName = trim($name); // trim() fonksiyonu boşlukları temizler. Yani baştaki ve sondaki boşlukları siler.  
echo $clearedName; // temizlenmiş ismi ekrana yazdırır.

echo "<br>";

$mail = $_POST['email'];
$clearedMail = trim($mail); // trim() fonksiyonu boşlukları temizler. 
echo $clearedMail; // temizlenmiş maili ekrana yazdırır.

echo "<br>";

$message = $_POST['mesaj'];
$clearedMessage = trim($message); // trim() fonksiyonu boşlukları temizler. 

echo $clearedMessage; // temizlenmiş mesajı ekrana yazdırır.


/*  formdan gelen veri miktarı fazla olduğu durumlarda böyle her veriyi 
    trim() ile teker teker temizlemek sağlıklı bir yaklaım değildir.
    Bu yüzzden $_POST dizisindeki eher elemanı trim() edecek bir fonksiyonu array_map() ile yazaıp
    her elemana trim() uygulmalyız.
 */



// filtre() fonksiyonu: Gelen veriyi temizler ve güvenli hale getirir
function filtre($p){
    // Eğer gelen parametre bir dizi ise, dizinin her elemanı için filtre() fonksiyonunu recursive olarak uygula
    // Değilse (yani string ise), önce trim() ile baştaki ve sondaki boşlukları temizle,
    // sonra htmlspecialchars() ile HTML özel karakterlerini dönüştür
    return is_array($p) ? array_map('filtre', $p) : htmlspecialchars(trim($p));
    
    // htmlspecialchars(): HTML karakterlerini entity'lere dönüştürür (XSS koruması)
    // Örneğin: < → &lt;, > → &gt;, " → &quot; vb.
}

// $_POST dizisindeki tüm elemanları filtre() fonksiyonundan geçir
// Sonuç olarak tüm POST verisi temizlenmiş ve güvenli hale getirilmiş olur
$clearedArray = array_map('filtre', $_POST);


// $clearedArray = array_map(function ($e) { // array_map() fonksiyonu, bir dizinin her elemanına bir fonksiyonu uygular.
//     return trim($e);
// }, $_POST); // array_map() fonksiyonuna birinci parametre olarak bir fonksiyon, ikinci parametre olarak bir dizi verilir.

echo "<hr>";
echo "<pre>";   
print_r($clearedArray); // temizlenmiş diziyi ekrana yazdırır.
=======
<?php
//! $_POST = bir dizi (array) olarak formdan gelen verileri tutar BU YÜZDEN VERİLERİ ALIRKEN İŞLEME ALMAK İSTEDİĞİMİZDE ARRAY FONKSİYONLARINI UYGULAYABİLİRİZ.

// $_POST['name'] = formda name adında bir input varsa onun değerini tutar
// $_POST['email'] = formda email adında bir input varsa onun değerini tutar
// $_POST['message'] = formda message adında bir input varsa onun değerini tutar
// $_POST['submit'] = formda submit adında bir input varsa onun değerini tutar


echo "<h1 style='text-align: center;'>POST İŞLEMLERİ</h1>";
echo "<h2 style='text-align: center;'>Formdan gelen veriler</h2>";


$name = $_POST['isim'];
$clearedName = trim($name); // trim() fonksiyonu boşlukları temizler. Yani baştaki ve sondaki boşlukları siler.  
echo $clearedName; // temizlenmiş ismi ekrana yazdırır.

echo "<br>";

$mail = $_POST['email'];
$clearedMail = trim($mail); // trim() fonksiyonu boşlukları temizler. 
echo $clearedMail; // temizlenmiş maili ekrana yazdırır.

echo "<br>";

$message = $_POST['mesaj'];
$clearedMessage = trim($message); // trim() fonksiyonu boşlukları temizler. 

echo $clearedMessage; // temizlenmiş mesajı ekrana yazdırır.


/*  formdan gelen veri miktarı fazla olduğu durumlarda böyle her veriyi 
    trim() ile teker teker temizlemek sağlıklı bir yaklaım değildir.
    Bu yüzzden $_POST dizisindeki eher elemanı trim() edecek bir fonksiyonu array_map() ile yazaıp
    her elemana trim() uygulmalyız.
 */



// filtre() fonksiyonu: Gelen veriyi temizler ve güvenli hale getirir
function filtre($p){
    // Eğer gelen parametre bir dizi ise, dizinin her elemanı için filtre() fonksiyonunu recursive olarak uygula
    // Değilse (yani string ise), önce trim() ile baştaki ve sondaki boşlukları temizle,
    // sonra htmlspecialchars() ile HTML özel karakterlerini dönüştür
    return is_array($p) ? array_map('filtre', $p) : htmlspecialchars(trim($p));
    
    // htmlspecialchars(): HTML karakterlerini entity'lere dönüştürür (XSS koruması)
    // Örneğin: < → &lt;, > → &gt;, " → &quot; vb.
}

// $_POST dizisindeki tüm elemanları filtre() fonksiyonundan geçir
// Sonuç olarak tüm POST verisi temizlenmiş ve güvenli hale getirilmiş olur
$clearedArray = array_map('filtre', $_POST);


// $clearedArray = array_map(function ($e) { // array_map() fonksiyonu, bir dizinin her elemanına bir fonksiyonu uygular.
//     return trim($e);
// }, $_POST); // array_map() fonksiyonuna birinci parametre olarak bir fonksiyon, ikinci parametre olarak bir dizi verilir.

echo "<hr>";
echo "<pre>";   
print_r($clearedArray); // temizlenmiş diziyi ekrana yazdırır.
>>>>>>> 7f892c26be6e64f015de83da8fe4dec62a81f6a8
echo "</pre>";