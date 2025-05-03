<?php 

//!======================== Dosya Oluşturma===========================
touch('test1.txt');
touch("dosya.txt" , time()); // yeni dosya oluşturuldu ("time() ile oluşturulma tarihini de ver)

//!======================== Dosya Silme===========================

unlink('test1.txt');


//!======================== Dosya Okuma===========================
$dosya = fopen('dosya.txt','r'); // dosyayı aç

//echo fgets($dosya);  //dosya içeriğini getir(ilk satırını getirir)
echo "<hr>";

/*
while(!feof($dosya)){ // dosyanın sonuna kadar oku
    echo fgets($dosya)."<br>";
}

*/

//?======= fsize() ve fread() ile dosya okuma========

//$boyut = filesize('dosya.txt'); // dosyanın boyutunu al
//echo fread($dosya,$boyut); // dosyayı oku (ilk parametre dosya, ikinci parametre dosya boyutu)(boyut yerine istediğimiz miktarı yazabiliriz)
echo "------";


while($satir = fgets($dosya)){
    print_r(feof($dosya)); // dosyanın sonuna gelindi mi kontrol et (true/false döner)
    echo "---->";
    echo $satir."<br>";

}
echo "<hr>";


//?================================================

/*
$file = fopen('file.txt','a'); // dosyayı aç (a ile açtık çünkü dosya içeriğini silmeden ekleme yapacağız)(yoksa oluşturulacak)

fwrite($file,"Merhaba Dunya\n"); // dosyaya yaz (ilk parametre dosya, ikinci parametre yazılacak içerik)

fclose($file); // dosyayı kapat( write işlemi yapıldıktan sonra dosyayı kapatmak önemli)

$file = fopen('file.txt','r'); // dosyayı okuma modunda aç

//fputs($file,"\nMerhaba Dünya"); // dosyaya yaz (ilk parametre dosya, ikinci parametre yazılacak içerik)
$size = filesize('file.txt'); // dosyanın boyutunu al

echo fread($file,$size); // dosyayı oku
*/

echo "<hr>";

fclose($dosya); // dosyayı kapat


















?>


















<?php

/*
============Dosya Erişim Modları - Dosya Kipleri====================

r : Read işlemi. Dosyanın sadece içeriğinin okunması gerektiğini belirtir.

r+ : Dosyanın içeriğinin he okunabilmesi hem de yazılabilmesinin gerektiğini belirtir.

w : Dosyaya sadece yazma işleminin yapılabilmesinin gerektiğini belirtir. Dosyanın içeriği tamamen silinir ve baştan itibaren yazmaya başlanır. Dosya belirtilen adreste yok ise yeniden oluşturulur.

w+ : Dosyaya hem yazma işleminin yapılabilmesi hem de dosya içeriğinin okunabilmesinin gerektiğini belirtir. Dosyanın içeriği silinir ve baştan veri yazma işlemi gerçekleştirilir. Dosya belirtilen adreste yok ise yeniden oluşturulur.

a : Dosya içerisine sadece veri eklenebilmesi gerektiğini belirtir. Dosyanın içeriği silinmez, içeriğin sonuna veri eklenir. Dosya belirtilen adreste bulunmuyorsa yeniden oluşturulur.

a+ : Dosyaya hem veri eklenebilmesini hem de verinin okunabilmesinin gerektiğini belirtir. Dosyanın içeriği silinmez, içeriğin sonuna veri eklenir. Dosya belirtilen adreste yok ise yeniden oluşturulur.

x : Dosyanın oluşturulması sağlanır ve oluşturulan dosyanın içerisine veri yazmak için açılması gerektiğini belirtir. Aynı isimde bir dosya belirtilen adreste var ise fopen fonksiyonundan ‘false’ değeri döner.

x+ : Dosyanın oluşturulması sağlanır ve içerisine hem veri yazma hem de verileri okunması gerektiğini belirtir. Dosya belirtilen adreste aynı isimde zaten var ise fopen fonksiyonundan ‘false’ değeri döner ve hata oluşur.

*/

?>