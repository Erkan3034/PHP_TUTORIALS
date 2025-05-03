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
echo "<hr>";


while(!feof($dosya)){ // dosyanın sonuna kadar oku
    echo fgets($dosya)."<br>";

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


//?======================== Dosya varlığını kontrol etme===========================

$control = file_exists('dosya.txt'); // dosyanın varlığını kontrol et (bool)

if($control){
    echo "Dosya var";
}else{
    echo "Dosya yok";
}


echo "<hr>";

//?======================== Dosya ve dizin kontrolü===========================
$control2 = is_file('dosya.txt'); // dosyanın dosya olup olmadığını kontrol et (bool)

echo $control2 ? "Dosyadır!": "Dosya değildir!";


echo "<hr>";

file_put_contents('dosya.txt',"\nIcerik file_put_contents() ile bu metin eklendi" , FILE_APPEND); // dosyaya içerik yaz (ilk parametre dosya adı, ikinci parametre yazılacak içerik)

echo "<hr>";
$get = file_get_contents('dosya.txt'); // dosyadan içerik oku (ilk parametre dosya adı)

print_r($get); // dosyadan okunan içeriği yazdır (print_r ile daha düzenli yazdırır)


//! ===========PHP DOSYASI HAZIRLAMA ===========

$phpDosyasi = "<?php ";
$phpDosyasi .= '$isim = "Erkan TURGUT"; ';
$phpDosyasi .= 'echo $isim;';

file_put_contents('deneme.php', $phpDosyasi);


?>


<?php

/*
is_file() : Dosyanın dosya olup olmadığını kontrol eder. Eğer dosya ise true, değilse false döner.
is_dir() : Dosyanın dizin olup olmadığını kontrol eder. Eğer dizin ise true, değilse false döner.
is_readable() : Dosyanın okunabilir olup olmadığını kontrol eder. Eğer okunabilir ise true, değilse false döner.
is_writable() : Dosyanın yazılabilir olup olmadığını kontrol eder. Eğer yazılabilir ise true, değilse false döner.
is_executable() : Dosyanın çalıştırılabilir olup olmadığını kontrol eder. Eğer çalıştırılabilir ise true, değilse false döner.
is_uploaded_file() : Dosyanın yüklenip yüklenmediğini kontrol eder. Eğer yüklenmiş ise true, değilse false döner.

file_exists() : Dosyanın var olup olmadığını kontrol eder. Eğer var ise true, değilse false döner.
feof() : Dosyanın sonuna gelinip gelinmediğini kontrol eder. Eğer sona gelinmiş ise true, değilse false döner.
fopen() : Dosyayı açar. İlk parametre dosya adı, ikinci parametre ise dosya erişim modudur. Eğer dosya açılamazsa false döner.
fclose() : Dosyayı kapatır. İlk parametre dosya adıdır.
fgets() : Dosyadan bir satır okur. İlk parametre dosya adı, ikinci parametre ise satır sayısıdır. Eğer dosya okunamazsa false döner.
fread() : Dosyadan belirtilen boyutta veri okur. İlk parametre dosya adı, ikinci parametre ise okunacak boyuttur. Eğer dosya okunamazsa false döner.
filesize() : Dosyanın boyutunu alır. İlk parametre dosya adıdır. Eğer dosya okunamazsa false döner.

touch() : Dosyayı oluşturur. İlk parametre dosya adı, ikinci parametre ise oluşturulma tarihidir. Eğer dosya oluşturulamazsa false döner.
unlink() : Dosyayı siler. İlk parametre dosya adıdır. Eğer dosya silinemezse false döner.



file_put_contents() : Dosyaya içerik yazar. İlk parametre dosya adı, ikinci parametre yazılacak içerik, üçüncü parametre ise dosya erişim modudur. Eğer dosya açılamazsa false döner.

file_get_contents() : Dosyadan içerik okur. İlk parametre dosya adıdır. Eğer dosya okunamazsa false döner.


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