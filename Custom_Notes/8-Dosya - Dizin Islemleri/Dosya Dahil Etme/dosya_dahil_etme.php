<?php
/**
 * PHP Dosya Dahil Etme (File Inclusion) Örnekleri
 * 
 * Bu dosya, PHP'de tüm dosya dahil etme yöntemlerini tek bir dosyada gösterir:
 * - include, require
 * - include_once, require_once
 * - Güvenli dosya dahil etme teknikleri
 * - Değişken paylaşımı
 * - Çıktı yakalama
 */

echo "<h1>PHP Dosya Dahil Etme İşlemleri</h1>";

// 1. Temel Dahil Etme Yöntemleri
echo "<h2>1. Temel Dahil Etme Yöntemleri</h2>";

// header.php dosyasını oluşturalım
file_put_contents('header.php', '<?php echo "<header>Site Başlığı</header>"; ?>');

// footer.php dosyasını oluşturalım
file_put_contents('footer.php', '<?php echo "<footer>Telif Hakkı © 2023</footer>"; ?>');

// config.php dosyasını oluşturalım
file_put_contents('config.php', '<?php define("SITE_ADI", "Benim Sitem"); ?>');

// a) include örneği
echo "<h3>a) include Kullanımı</h3>";
include 'header.php'; // Dosya bulunamazsa uyarı verir, kod çalışmaya devam eder

// b) require örneği
echo "<h3>b) require Kullanımı</h3>";
require 'config.php'; // Dosya bulunamazsa fatal error verir, kod durur
echo "Site Adı: " . SITE_ADI . "<br>";

// c) include_once örneği
echo "<h3>c) include_once Kullanımı</h3>";
include_once 'header.php'; // Aynı dosyayı tekrar dahil etmez
include_once 'header.php'; // Bu satırda tekrar dahil edilmez

// d) require_once örneği
echo "<h3>d) require_once Kullanımı</h3>";
require_once 'config.php';
require_once 'config.php'; // Tekrar dahil edilmez

// 2. Değişken Paylaşımı
echo "<h2>2. Dahil Edilen Dosyalarda Değişken Paylaşımı</h2>";

// variables.php dosyasını oluşturalım
file_put_contents('variables.php', '<?php $renk = "mavi"; $sayi = 42; ?>');

// main.php
$renk = "kırmızı";
include 'variables.php';
echo "Renk: $renk, Sayı: $sayi<br>"; // Çıktı: Renk: mavi, Sayı: 42

// 3. Fonksiyon ve Sınıf Dahil Etme
echo "<h2>3. Fonksiyon ve Sınıf Dahil Etme</h2>";

// functions.php dosyasını oluşturalım
file_put_contents('functions.php', '<?php 
    function topla($a, $b) { return $a + $b; }
    class Kisi { public $ad; function __construct($ad) { $this->ad = $ad; } }
?>');

require_once 'functions.php';
echo "Toplam: " . topla(5, 3) . "<br>"; // Çıktı: Toplam: 8

$kisi = new Kisi("Ahmet");
echo "Kişi Adı: " . $kisi->ad . "<br>"; // Çıktı: Kişi Adı: Ahmet

// 4. Güvenli Dosya Dahil Etme
echo "<h2>4. Güvenli Dosya Dahil Etme</h2>";

// Güvensiz örnek (TEHLİKELİ!)
// $sayfa = $_GET['sayfa'] ?? 'anasayfa';
// include $sayfa . '.php'; // Kullanıcı girdisi doğrudan kullanılmamalı

// Güvenli yöntem
$izinliSayfalar = ['anasayfa', 'hakkimizda', 'iletisim'];
$sayfa = 'anasayfa'; // $_GET['sayfa'] ?? 'anasayfa';

if (in_array($sayfa, $izinliSayfalar) && file_exists($sayfa . '.php')) {
    include $sayfa . '.php';
} else {
    include '404.php';
}

// 5. Çıktı Yakalama (Output Buffering)
echo "<h2>5. Çıktı Yakalama ile Dahil Etme</h2>";

// template.php dosyasını oluşturalım
file_put_contents('template.php', '<div class="kutu"><?= $icerik ?></div>');

ob_start();
$icerik = "Merhaba Dünya!";
include 'template.php';
$sonuc = ob_get_clean();

echo "Yakalanan Çıktı: " . htmlspecialchars($sonuc) . "<br>";
echo "İşlenmiş Çıktı: $sonuc<br>";

// 6. Farklı Yol Yöntemleri
echo "<h2>6. Dosya Yolu Belirtme Yöntemleri</h2>";

// Göreceli yol
include 'header.php';

// __DIR__ kullanımı (PHP 5.3+)
include __DIR__ . '/header.php';

// ROOT dizininden başlayarak
include $_SERVER['DOCUMENT_ROOT'] . '/header.php';

// 7. Otomatik Yükleme (Autoloading)
echo "<h2>7. Otomatik Yükleme Örneği</h2>";

spl_autoload_register(function ($className) {
    include 'classes/' . strtolower($className) . '.php';
});

// Önce classes dizinini ve kullanici.php dosyasını oluştur
if (!file_exists('classes')) {
    mkdir('classes');
}
file_put_contents('classes/kullanici.php', '<?php class Kullanici { public function selam() { return "Merhaba!"; } } ?>');

// Sonra sınıfı kullan
$kullanici = new Kullanici();
echo $kullanici->selam() . "<br>"; // Çıktı: Merhaba!

// Temizlik - Oluşturulan dosyaları sil
unlink('header.php');
unlink('footer.php');
unlink('config.php');
unlink('variables.php');
unlink('functions.php');
unlink('template.php');
unlink('classes/kullanici.php');
rmdir('classes');

echo "<p style='color:green;'>Tüm örnekler başarıyla çalıştı!</p>";
?>


<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosya Dahil Etme</title>
    <style>
        .container  {

            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }
        li{
            color: darkslategray;
        }
    </style>
</head>

<body>
    <h1>Dosya Dahil Etme</h1>

    <div class="container">
        <li>include 'dosya.php';</li>

        <li>include_once 'dosya.php';</li>

        <li> require 'dosya.php';</li>

        <li>require_once 'dosya.php';</lş>

    </div>

    <p>✅ require ve require_once işlemlerinde dahil edilmek istenen dosya bulunamazsa program "FATAL ERROR" verir ve çalışmayı durdurur.</p>
    <p>✅ include ve include_once işlemlerinde dahil edilmek istenen dosya bulunamazsa program "WARNING" verir ve çalışmaya devam eder.</p>
    <p>✅ require_once include_once ile dahil edilen dosya sadece bir kere dahil edilebilir.</p>

</html>