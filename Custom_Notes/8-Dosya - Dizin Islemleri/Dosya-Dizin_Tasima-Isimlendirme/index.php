<?php
/**
 * PHP Dosya ve Dizin Taşıma/Yeniden Adlandırma Örnekleri
 */

// 1. Dosya Taşıma (rename fonksiyonu ile)
$kaynakDosya = 'orjinal_dosya.txt';
$hedefDosya = 'tasinan_dosya.txt';

// Önce kaynak dosyayı oluşturalım
file_put_contents($kaynakDosya, 'Bu dosya taşınacak.');

if (rename($kaynakDosya, $hedefDosya)) {
    echo "'$kaynakDosya' dosyası '$hedefDosya' olarak taşındı.<br>";
} else {
    echo "Dosya taşınamadı.<br>";
}
echo "<hr>";
// 2. Dizin Taşıma (rename fonksiyonu ile)
$kaynakDizin = 'orjinal_klasor';
$hedefDizin = 'tasinan_klasor';

// Önce kaynak dizini oluşturalım
if (!file_exists($kaynakDizin)) {
    mkdir($kaynakDizin);
}

if (rename($kaynakDizin, $hedefDizin)) {
    echo "'$kaynakDizin' dizini '$hedefDizin' olarak taşındı.<br>";
} else {
    echo "Dizin taşınamadı.<br>";
}
echo "<hr>";
// 3. Dosya Kopyalama ve Sonra Silme (Taşıma efekti)
$kopyalanacakDosya = 'kopya_dosya.txt';
$yeniKonum = 'yeni_konum/kopya_dosya.txt';

// Dosyayı oluştur
file_put_contents($kopyalanacakDosya, 'Bu dosya kopyalanacak ve silinecek.');

// Hedef dizini oluştur
if (!file_exists('yeni_konum')) {
    mkdir('yeni_konum', 0755, true);
}

if (copy($kopyalanacakDosya, $yeniKonum)) {
    unlink($kopyalanacakDosya); // Orijinal dosyayı sil
    echo "'$kopyalanacakDosya' dosyası '$yeniKonum' konumuna taşındı (kopyala+sil yöntemiyle).<br>";
} else {
    echo "Dosya kopyalanamadı.<br>";
}
echo "<hr>";
// 4. Dizin İçeriğini Taşıma (Özyinelemeli fonksiyon)
function dizinTasi($kaynak, $hedef) {
    if (is_dir($kaynak)) {
        if (!file_exists($hedef)) {
            mkdir($hedef, 0755, true);
        }
        
        $dosyalar = scandir($kaynak);
        
        foreach ($dosyalar as $dosya) {
            if ($dosya != "." && $dosya != "..") {
                dizinTasi(
                    $kaynak.DIRECTORY_SEPARATOR.$dosya,
                    $hedef.DIRECTORY_SEPARATOR.$dosya
                );
            }
        }
        
        // Tüm dosyalar taşındıktan sonra kaynak dizini sil
        rmdir($kaynak);
    } elseif (file_exists($kaynak)) {
        rename($kaynak, $hedef);
    }
}

$kaynakDizin2 = 'kaynak_dizin';
$hedefDizin2 = 'hedef_dizin';

// Kaynak dizini ve dosyaları oluştur
if (!file_exists($kaynakDizin2)) {
    mkdir($kaynakDizin2);
    file_put_contents($kaynakDizin2.'/dosya1.txt', 'Dizin taşıma örneği');
    mkdir($kaynakDizin2.'/alt_dizin');
}

dizinTasi($kaynakDizin2, $hedefDizin2);
echo "'$kaynakDizin2' dizini '$hedefDizin2' olarak taşındı.<br>";
echo "<hr>";
// 5. Dosya Uzantısını Değiştirme
$resimDosyasi = 'foto.jpg';
$yeniUzanti = 'foto.png';

// Dosyayı oluştur
file_put_contents($resimDosyasi, 'JPEG dosya içeriği');

if (rename($resimDosyasi, $yeniUzanti)) {
    echo "'$resimDosyasi' dosyası '$yeniUzanti' olarak yeniden adlandırıldı.<br>";
} else {
    echo "Dosya uzantısı değiştirilemedi.<br>";
}
echo "<hr>";
// 6. Büyük-Küçük Harf Duyarlı Yeniden Adlandırma (Linux/Unix sistemlerde)
$kucukHarf = 'kucukdosya.txt';
$buyukHarf = 'BUYUKDOSYA.txt';

// Dosyayı oluştur
file_put_contents($kucukHarf, 'Büyük/küçük harf testi');

if (rename($kucukHarf, $buyukHarf)) {
    echo "'$kucukHarf' dosyası '$buyukHarf' olarak yeniden adlandırıldı.<br>";
} else {
    echo "Büyük/küçük harf değişikliği yapılamadı.<br>";
}

echo "<hr>";

// 7. Özel Karakterler İçeren Dosya Adları
$ozelKarakterli = 'özel_karakterli_dosya_ğüşıç.txt';
$yeniAd = 'yeni_adi_olan_dosya.txt';

// Dosyayı oluştur
file_put_contents($ozelKarakterli, 'Türkçe karakter testi');

if (rename($ozelKarakterli, $yeniAd)) {
    echo "'$ozelKarakterli' dosyası '$yeniAd' olarak yeniden adlandırıldı.<br>";
} else {
    echo "Özel karakterli dosya adı değiştirilemedi.<br>";
}

echo "<hr>";

// 8. Dosya Adındaki Boşlukları Değiştirme
$boslukluAd = 'dosya adında boşluk var.txt';
$bosluksuzAd = 'dosya_adinda_bosluk_yok.txt';

// Dosyayı oluştur
file_put_contents($boslukluAd, 'Boşluk testi');

if (rename($boslukluAd, $bosluksuzAd)) {
    echo "'$boslukluAd' dosyası '$bosluksuzAd' olarak yeniden adlandırıldı.<br>";
} else {
    echo "Boşluklu dosya adı değiştirilemedi.<br>";
}

// Temizlik
if (file_exists($hedefDosya)) unlink($hedefDosya);
if (file_exists($hedefDizin)) rmdir($hedefDizin);
if (file_exists($yeniKonum)) unlink($yeniKonum);
if (file_exists('yeni_konum')) rmdir('yeni_konum');
if (file_exists($hedefDizin2)) dizinTasi($hedefDizin2, 'silinecek'); rmdir('silinecek');
if (file_exists($yeniUzanti)) unlink($yeniUzanti);
if (file_exists($buyukHarf)) unlink($buyukHarf);
if (file_exists($yeniAd)) unlink($yeniAd);
if (file_exists($bosluksuzAd)) unlink($bosluksuzAd);
?>