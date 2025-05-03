<?php
"<pre>";
// 1. strlen() - String uzunluğunu verir
$str = "Merhaba Dünya";
echo "1. strlen(): " . strlen($str) . "\n"; // Çıktı: 14

echo "<hr>";


// 2. str_replace() - String içinde değişiklik yapar
$text = "Elma portakal armut";
$newText = str_replace("armut", "muz", $text); //armut varsa muz yap
echo "2. str_replace(): " . $newText . "\n"; // Çıktı: Elma portakal muz

echo "<hr>";


// 3. substr() - Stringin bir parçasını alır
$str = "Programlama";
echo "3. substr(): " . substr($str, 3, 5) . "\n"; // Çıktı: graml(3ten itiaren 5 tane al )

echo "<hr>";


// 4. strpos() - String içinde arama yapar (ilk pozisyon)
$str = "PHP öğreniyorum";
echo "4. strpos(): " . strpos($str, "öğ") . "\n"; // Çıktı: 4

echo "<hr>";


// 5. strtolower() - Stringi küçük harfe çevirir
$str = "PHP PROGRAMLAMA";
echo "5. strtolower(): " . strtolower($str) . "\n"; // Çıktı: php programlama

//unicode karakterler için strtolower() kullanmak yerine mb_strtolower() kullanırıx.


echo "<hr>";


// 6. strtoupper() - Stringi büyük harfe çevirir
$str = "php programlama";
echo "6. strtoupper(): " . strtoupper($str) . "\n"; // Çıktı: PHP PROGRAMLAMA

// unicode karakterler için strtoupper() kullanmak yerine mb_strtoupper() kullanırız
echo "<hr>";


// 7. trim() - Stringin başındaki ve sonundaki boşlukları siler
$str = "   PHP   ";
echo "7. trim(): |" . trim($str) . "|\n"; // Çıktı: |PHP|

echo "<hr>";


// 8. explode() - Stringi belirtilen ayraca göre diziye çevirir
$str = "elma-armut-portakal";
$arr = explode("-", $str);
echo "8. explode(): ";
print_r($arr); // Çıktı: Array ( [0] => elma [1] => armut [2] => portakal )
echo "\n";

echo "<hr>";


// 9. implode() - Diziyi stringe çevirir
$arr = ["PHP", "Java", "Python"];
$str = implode(", ", $arr);
echo "9. implode(): " . $str . "\n"; // Çıktı: PHP, Java, Python

echo "<hr>";


// 10. strrev() - Stringi ters çevirir
$str = "MERHABA ERKAN";
echo "10. strrev(): " . strrev($str) . "\n"; 

echo "<hr>";


// 11. str_repeat() - Stringi tekrarla
$str = "PHP ";
echo "11. str_repeat(): " . str_repeat($str, 5) . "\n"; // Çıktı: PHP PHP PHP 

echo "<hr>";


// 12. str_split() - Stringi karakterlere ayırır
$str = "Hello";
$arr = str_split($str);
echo "12. str_split(): ";
print_r($arr); // Çıktı: Array ( [0] => H [1] => e [2] => l [3] => l [4] => o )
echo "\n";

echo "<hr>";


// 13. str_pad() - Stringi belirtilen uzunluğa tamamlar
$str = "PHP";
echo "13. str_pad(): " . str_pad($str, 10, "*", STR_PAD_BOTH) . "\n"; // Çıktı: ***PHP****

echo "<hr>";


// 14. strcmp() - İki stringi karşılaştırır
$str1 = "elma";
$str2 = "armut";
echo "14. strcmp(): " . strcmp($str1, $str2) . "\n"; // Çıktı: pozitif bir sayı

echo "<hr>";

// 15. strcasecmp() - Büyük/küçük harf duyarsız karşılaştırma
$str1 = "PHP";
$str2 = "php";
echo "15. strcasecmp(): " . strcasecmp($str1, $str2) . "\n"; // Çıktı: 0 (eşit)

echo "<hr>";


// 16. strstr() - String içinde arama yapar (ilk eşleşmeden sonrasını döndürür)
$str = "test@example.com";
echo "16. strstr(): " . strstr($str, "@") . "\n"; // Çıktı: @example.com

echo "<hr>";


// 17. stristr() - strstr()'in büyük/küçük harf duyarsız versiyonu
$str = "Hello World";
echo "17. stristr(): " . stristr($str, "world") . "\n"; // Çıktı: World

echo "<hr>";


// 18. str_shuffle() - Stringin karakterlerini rastgele karıştırır
$str = "abcdef";
echo "18. str_shuffle(): " . str_shuffle($str) . "\n"; // Çıktı: rastgele karışmış hali

echo "<hr>";


// 19. strip_tags() - HTML etiketlerini temizler
$str = "<p>Merhaba <b>Dünya</b></p>";
echo "19. strip_tags(): " . strip_tags($str) . "\n"; // Çıktı: Merhaba Dünya

echo "<hr>";

// 20. htmlspecialchars() - HTML karakterlerini özel karakterlere çevirir
$str = "<a href='test'>Test</a>";
echo "20. htmlspecialchars(): " . htmlspecialchars($str) . "\n";
// Çıktı: &lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;


echo "<hr>";


//21 . md5() - Stringi MD5 hash fonksiyonu ile şifreler
$str = "Merhaba Dünya";
echo "21. md5(): " . md5($str) . "\n"; // Çıktı: 5eb63bbbe01eeed093cb22bb8f5acdc3
// md5() fonksiyonu 32 karakter uzunluğunda bir hash döndürür.

echo "<hr>";


// Ancak md5() güvenlik açısından zayıf bir hash algoritmasıdır ve kritik veriler için kullanılmamalıdır.
// Bunun yerine daha güvenli algoritmalar (SHA-256 gibi) kullanılmalıdır.
// Örnek: sha1() fonksiyonu ile SHA-1 hash oluşturma
$str = "Merhaba Dünya";
echo "SHA-1: " . sha1($str) . "\n"; // Çıktı: 5eb63bbbe01eeed093cb22bb8f5acdc3
// SHA-1 de güvenlik açısından zayıf bir algoritmadır. SHA-256 veya daha güçlü algoritmalar tercih edilmelidir.

echo "<hr>";

// Örnek: hash() fonksiyonu ile SHA-256 hash oluşturma
$str = "Merhaba Dünya";
echo "SHA-256: " . hash('sha256', $str) . "\n"; // Çıktı: 5eb63bbbe01eeed093cb22bb8f5acdc3
// SHA-256, 64 karakter uzunluğunda bir hash döndürür ve daha güvenlidir.
// Ancak yine de kritik veriler için daha güvenli algoritmalar tercih edilmelidir.

echo "<hr>";

// Örnek: password_hash() fonksiyonu ile şifreleme
$str = "Merhaba Dünya";
echo "Password Hash: " . password_hash($str, PASSWORD_DEFAULT) . "\n"; // Çıktı: $2y$10$e0N5Z5Q5Q5Q5Q5Q5Q5Q5QO
// password_hash() fonksiyonu, şifreleme için en iyi uygulamaları kullanır ve güvenli bir hash döndürür.
// Bu hash, şifre doğrulama için kullanılabilir. 

echo "<hr>";

//Örnek: password_verify() fonksiyonu ile şifre doğrulama
$hash = password_hash($str, PASSWORD_DEFAULT);
echo "Password Verify: " . (password_verify($str, $hash) ? "Sifreniz Doğru" : "Sifreniz Yanlış") . "\n"; // Çıktı: Doğru
// password_verify() fonksiyonu, verilen şifre ile hash'i karşılaştırır ve doğruysa true döner.
// Yanlışsa false döner.
// Bu, şifre doğrulama için güvenli bir yöntemdir.
"</pre>";
?>