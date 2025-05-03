<?php 

//!======================== Dosya Oluşturma===========================
touch('test1.txt');
touch("dosya.txt" , time()); // yeni dosya oluşturuldu ("time() ile oluşturulma tarihini de ver)

//!======================== Dosya Silme===========================

unlink('test1.txt');


//!======================== Dosya Açma===========================
$dosya = fopen('dosya.txt','r'); // dosyayı aç.

echo fgets($dosya);  //dosya içeriğini getir.

?>