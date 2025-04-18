<?php
echo "<h2 style='text-align: center;'>Formdan gelen veriler</h2>";
echo "<pre>";

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
$clearedArray = array_map('filtre', $_GET);

print_r($_GET); // $_GET dizisini ekrana yazdırır. Bu dizi formdan gelen verileri tutar.

echo "</pre>";


?>