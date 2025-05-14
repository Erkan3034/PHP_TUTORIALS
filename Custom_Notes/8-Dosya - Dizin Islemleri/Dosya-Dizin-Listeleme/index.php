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
$array2  = glob($baseDir . '/*');

echo "<pre>";
print_r($array2);
echo "</pre>";

?>