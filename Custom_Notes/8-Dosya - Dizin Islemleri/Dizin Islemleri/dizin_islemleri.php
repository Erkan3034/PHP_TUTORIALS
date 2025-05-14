<?php
 
 //?PHP Dizin İşlemleri Örnekleri


//====== 1. Dizin Oluşturma (mkdir)======
$yeniDizin = 'yeni_klasor';

if (!file_exists($yeniDizin)) {
    if (mkdir($yeniDizin, 0755)) {
        echo "'$yeniDizin' dizini başarıyla oluşturuldu.<br>";
    } else {
        echo "Dizin oluşturulurken hata oluştu.<br>";
    }
} else {
    echo "'$yeniDizin' dizini zaten var.<br>";
}

//====== 2. Dizin Silme (rmdir)======
$silinecekDizin = 'silinecek_klasor';

//====== Önce dizini oluşturalım (örnek için)======
if (!file_exists($silinecekDizin)) {
    mkdir($silinecekDizin);
}

if (file_exists($silinecekDizin)) {
    if (rmdir($silinecekDizin)) {
        echo "'$silinecekDizin' dizini başarıyla silindi.<br>";
    } else {
        echo "Dizin silinirken hata oluştu (dizin boş olmalı).<br>";
    }
}

//====== 3. Dizin İçindeki Dosyaları Listeleme (scandir)======
$dizin = '.'; // Mevcut dizin

if (is_dir($dizin)) {
    echo "<br>'$dizin' dizinindeki dosyalar:<br>";
    
    $dosyalar = scandir($dizin);
    
    foreach ($dosyalar as $dosya) {
        if ($dosya != "." && $dosya != "..") {
            echo "- $dosya<br>";
        }
    }
} else {
    echo "'$dizin' bir dizin değil.<br>";
}

// ======4. Dizin mi Dosya mı Kontrolü======
$kontrolEdilecek = 'deneme.txt';

// Önce dosyayı oluşturalım (örnek için)
file_put_contents($kontrolEdilecek, 'Test içeriği');

if (is_dir($kontrolEdilecek)) {
    echo "'$kontrolEdilecek' bir dizin.<br>";
} else {
    echo "'$kontrolEdilecek' bir dosya.<br>";
}

//====== 5. Dizin İzinlerini Değiştirme (chmod)======
$izinDizini = 'izin_klasor';

if (!file_exists($izinDizini)) {
    mkdir($izinDizini);
}

if (chmod($izinDizini, 0777)) {
    echo "'$izinDizini' dizinin izinleri değiştirildi.<br>";
} else {
    echo "İzin değiştirilirken hata oluştu.<br>";
}

//====== 6. Dizin Yeniden Adlandırma (rename)======
$eskiAd = 'eski_klasor';
$yeniAd = 'yeni_klasor';

// Önce dizini oluşturalım
if (!file_exists($eskiAd)) {
    mkdir($eskiAd);
}

if (rename($eskiAd, $yeniAd)) {
    echo "'$eskiAd' dizini '$yeniAd' olarak yeniden adlandırıldı.<br>";
} else {
    echo "Yeniden adlandırma başarısız.<br>";
}

//====== 7. Dizin ve Alt Dizinleri Silme (Özyinelemeli fonksiyon)======
function dizinSil($dizin) {
    if (!file_exists($dizin)) {
        return true;
    }

    if (!is_dir($dizin)) {
        return unlink($dizin);
    }

    foreach (scandir($dizin) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!dizinSil($dizin . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }

    return rmdir($dizin);
}

$silinecekDizin = 'alt_klasorler';
mkdir($silinecekDizin, 0755, true); // İç içe dizinler oluştur
file_put_contents($silinecekDizin.'/dosya1.txt', 'Test');
mkdir($silinecekDizin.'/alt_klasor');

if (dizinSil($silinecekDizin)) {
    echo "'$silinecekDizin' dizini ve tüm içeriği başarıyla silindi.<br>";
} else {
    echo "Dizin silinirken hata oluştu.<br>";
}

//====== 8. Dizin Kopyalama (Özyinelemeli fonksiyon)======
function dizinKopyala($kaynak, $hedef) {
    if (is_dir($kaynak)) {
        if (!file_exists($hedef)) {
            mkdir($hedef, 0755, true);
        }
        
        $dosyalar = scandir($kaynak);
        
        foreach ($dosyalar as $dosya) {
            if ($dosya != "." && $dosya != "..") {
                dizinKopyala(
                    $kaynak.DIRECTORY_SEPARATOR.$dosya,
                    $hedef.DIRECTORY_SEPARATOR.$dosya
                );
            }
        }
    } elseif (file_exists($kaynak)) {
        copy($kaynak, $hedef);
    }
}

$kaynakDizin = 'kaynak_klasor';
$hedefDizin = 'hedef_klasor';

//====== Kaynak dizini ve dosyaları oluştur======
mkdir($kaynakDizin);
file_put_contents($kaynakDizin.'/ornek.txt', 'Kopyalanacak dosya');
mkdir($kaynakDizin.'/alt_klasor');

dizinKopyala($kaynakDizin, $hedefDizin);
echo "'$kaynakDizin' dizini '$hedefDizin' olarak kopyalandı.<br>";

// Temizlik
dizinSil($kaynakDizin);
dizinSil($hedefDizin);
?>