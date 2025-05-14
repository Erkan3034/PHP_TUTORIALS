<?php
// Kendi dizinin tam yolunu alma
$baseDir = require '../ayar.php'; 

echo $baseDir;

echo "<hr>";

// Kendi dizinin içindeki dosyaları listeleme
$array = scandir('..');

echo "<pre>";
print_r($array);
echo "<hr>";

// Kendi dizinin içindeki klasör/dosyaların tam yolunu  listeleme
$array2  = glob($baseDir . '/*.php');

echo "<pre>";
print_r($array2);
echo "<hr>";


// Kendi dizinin içindeki .php dosyalarını listeleme
$array3 = glob($baseDir . '/*.php');

//php dosyalarından önceki yolu kaldırarak dosyaları listeleme
$dizi = array_map(function ($item)  use ($baseDir) {
    return str_replace($baseDir, '' ,$item);
}, $array3);

echo "<pre>";
print_r($dizi);


?>