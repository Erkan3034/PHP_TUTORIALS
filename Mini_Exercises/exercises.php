<?php
echo "<pre>";
function myFunc($dizi, $adet) {

    // Boş elemanları temizlemek için array_filter kullanıyyorum.
    $temizlenmis = array_filter($dizi, function($eleman) {
        return !is_null($eleman) && $eleman !== "";
    });
    

    // array_map kullanarak elemanları işliyorum
    $islenmis = array_map(function($eleman) {
        return $eleman;
    }, $temizlenmis);
    



    // Diziyi yeniden indeksliyoruz (array_filter sonrası indeksler bozulabilir)
    $islenmis = array_values($islenmis);
    
    // Eğer istenen adet, dizideki eleman sayısından fazlaysa tüm diziyi döndürelim
    if ($adet >= count($islenmis)) {
        return $islenmis;
    }
    



    // Rastgele anahtarları seç
    $rastgeleAnahtarlar = array_rand($islenmis, $adet);
    
    // Eğer tek bir eleman seçilirse (array_rand farklı davranır)
    if ($adet == 1) {
        return [$islenmis[$rastgeleAnahtarlar]];
    }
    
    // Seçilen rastgele elemanları topla
    $sonuc = [];
    foreach ($rastgeleAnahtarlar as $anahtar) {
        $sonuc[] = $islenmis[$anahtar];
    }

    
    
    return $sonuc;
}

$planets = ["Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune", "", "", NULL];

print_r(myFunc($planets, 2));
print_r(myFunc($planets, 3));
print_r(myFunc($planets, 2));
print_r(myFunc($planets, 4));
print_r(myFunc($planets, 5));
?>