<!DOCTYPE html>
<html lang="de en tr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ErKan TURGUT</title>
  </head>

  <body>
    <h1>ERKAN TURGUT - PHP Temel - Ödev 03</h1>
    <ol>
      <li>Kullanıcıdan sayı değeri alabileceğiniz bir form hazırlayın.</li>
      <li>Gelen sayı değerlerinin 3 ile bölümünden kalanın 0 olup olmadığını kontrol eden bir fonksiyon yazın.</li>
      <li>Kullanıcıya girilen değerin 3 bölünebilirliğini, bölünemiyorsa bölünebilen ilk değeri kullanıcıya bildirin.</li>
      <li>Boş değer gönderilirse değerin boş olmayacağını bildirin.</li>
    </ol>
    <hr>
    <form method='POST'>
      <input type='tel' name='num'/>
      <button type='submit'>Submit</button>
    </form>
</body>
</html>

<?php
  $num = $_POST['num'];

  function checkNum($num){
    $message = '';

    $num == '' ? $message = "Boş bir değer veremezsiniz. Lütfen bir sayı girin!" : (
    $num % 3 == 0 ? $message = "$num sayısının 3'e bölümünün sonucu: " . $num/3 : 
    (($num+1) % 3 == 0 ? $message = "$num sayısı 3'e bölünemez. 3'e bölünebilecek en yakın sayı: " . $num + 1 :
      $message = "$num sayısı 3'e bölünemez. 3'e bölünebilecek en yakın sayı: " . $num - 1)
    );
    
    return $message;
  }

  echo checkNum($num);
?>