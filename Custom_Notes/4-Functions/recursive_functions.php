<?php
//!=======================RECURSIVE Fonksiyonlar=======================

//?Recursive fonksiyonlar, kendini çağıran fonksiyonlardır. Belirli bir koşul sağlanana kadar kendini tekrar tekrar çağırırlar.
/*
---------------Önemli Noktalar-------

""Temel Durum (Base Case):"" Özyinelemenin durmasını sağlayan koşul. Olmazsa sonsuz döngü oluşur.

""Yakınsama:"" Her çağrıda temel duruma yaklaşılmalıdır.

""Stack Overflow:"" Çok derin özyinelemeler stack taşmasına neden olabilir.

Performans: Bazı durumlarda döngüler daha verimli olabilir.

--------------Kullanım Alanları--------------
Ağaç yapılarında gezinme

Matematiksel hesaplamalar

Dosya sistemi işlemleri

Karmaşık algoritmalar (quicksort, mergesort gibi)
*/


//Örnek:

function sayi($i)
{
    echo $i . " <br>";
    if ($i < 10) {
        $i++;
        sayi($i);
    }
}
echo "Recursive Function: <br>";
sayi(1);
echo "<hr>";
//!----------------------------örnek 2

// Kategorileri tutan çok boyutlu bir dizi tanımlanıyor
// Her kategori; id, parent (üst kategori ID'si) ve name (kategori adı) bilgilerini içeriyor
$categories = [
    [
        'id' => 1,
        'parent' => 0,  // parent=0 kök kategori olduğunu gösterir
        'name' => 'Frontend'
    ],
    [
        'id' => 2,
        'parent' => 0,  // Bu da bir kök kategori
        'name' => 'Backend'
    ],
    [
        'id' => 3,
        'parent' => 2,
        'name' => 'PHP'
    ],
    [
        'id' => 4,
        'parent' => 1,
        'name' => 'VueJS'
    ],
    [
        'id' => 5,
        'parent' => 2,
        'name' => 'NodeJS'
    ],
    [
        'id' => 6,
        'parent' => 5,
        'name' => 'ExpressJS'
    ],
    [
        'id' => 7,
        'parent' => 3,
        'name' => 'Laravel'
    ]
];

/**
 * Kategorileri listeleyen fonksiyon
 * 
 * @param array $arr Kategori listesi
 * @param int $par Hangi parent ID'ye sahip kategorilerin listeleneceği (varsayılan: 0 - kök kategoriler)
 * @return string HTML formatında kategori listesi
 */


function getCategories($arr, $par = 0)
{
    $html = ""; // HTML çıktısını biriktirmek için boş string

    $html .= "<ul>";

    // Kategori dizisindeki her eleman için döngü
    foreach ($arr as $value) {

        // Sadece belirtilen parent ID'ye sahip kategorileri listele
        if ($value['parent'] == $par) {
            $html .= "<li>";
            $html .= $value['name']; // Kategori adını ekle
            $html .= getCategories($arr, $value['id']); // Alt kategorileri listelemek için fonksiyonu tekrar çağır
            //$html .="<li>" .$value['name'] . "</li>"; // Kategori adını ve HTML satır sonu ekle
            $html .= "</li>";
        }
    }

    $html .= "</ul>";
    return $html; // Oluşturulan HTML'i döndür
}

// $par parametresi 0 olarak gönderiliyor (kök kategoriler)
echo getCategories($categories);




//!=================Static Tanımı
/**
 *------static Değişkenin Özellikleri----
 *Fonksiyon Çağrıları Arasında Değerini Korur:

 *Normalde fonksiyon içindeki değişkenler, fonksiyon her çağrıldığında sıfırlanır

 *static değişkenler ise fonksiyon çağrıları arasında değerlerini korurlar

 *Sadece İlk Tanımda İnitialize Edilir:

 *$sayi = 0 ataması SADECE ilk çağrıda yapılır

 *Sonraki çağrılarda bu satır göz ardı edilir
 */
function say()
{
    static $sayi = 0;
    echo $sayi;
    $sayi++;
}

say();
echo "<br>";
say();
echo "<hr>";
