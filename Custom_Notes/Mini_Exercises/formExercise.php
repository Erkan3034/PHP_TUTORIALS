<!DOCTYPE html>
<<<<<<< HEAD
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERKAN TURGUT - PHP Ödev 03</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        h1, h2 {
            color: #2c3e50;
            text-align: center;
        }
        
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 30px 0;
        }
        
        form, .result-box {
            width: 100%;
            max-width: 400px;
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #2980b9;
        }
        
        ol {
            padding-left: 20px;
        }
        
        hr {
            margin: 20px 0;
            border: 0;
            height: 1px;
            background-color: blue;
        }
        
        .error {
            color: #e74c3c;
            font-weight: bold;
        }
        
        .success {
            color: #27ae60;
            font-weight: bold;
        }
    </style>
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
    
    <div class="container">
        <form method="POST">
            <input type="tel" name="num" placeholder="Bir sayı giriniz..." required>
            <button type="submit">Kontrol Et</button>
        </form>
    </div>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo '<div class="container">'; // Sonuç kutusunu oluştur
        echo '<div class="result-box">'; 
        echo '<h2>Sonuç</h2>';
        
        if (isset($_POST['num'])) {
            $num = trim($_POST['num']); // Kullanıcıdan gelen değeri al ve boşlukları temizle
            
            if ($num === '') {
                echo '<p class="error">Boş bir değer veremezsiniz. Lütfen bir sayı girin!</p>'; // Boş değer kontrolü
            } elseif (!is_numeric($num)) { // Sayı kontrolü 
                echo '<p class="error">Lütfen geçerli bir sayı giriniz!</p>';
            } else {
                $result = checkNum($num);
                $class = strpos($result, 'bölünemez') === false ? 'success' : 'error'; // Sonuç mesajına göre sınıf belirle
                echo "<p class='$class'>$result</p>";
            }
        }
        
        echo '</div>';
        echo '</div>'; // Sonuç kutusunu kapat
    }
    
    function checkNum($num) {
        if ($num % 3 == 0) {
            return "$num sayısı 3'e tam bölünür. Bölüm: " . ($num / 3);
        } else {
            $nextNum = $num + (3 - ($num % 3));
            $prevNum = $num - ($num % 3);
            
            // Hangi sayıya daha yakın olduğunu kontrol et
            if (($num % 3) < 1.5) {
                $closest = $prevNum;
            } else {
                $closest = $nextNum;
            }
            
            return "$num sayısı 3'e tam bölünemez! En yakın bölünebilen sayı: $closest";
        }
    }
    ?>
</body>
</html>
=======
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
>>>>>>> 4c317293e58bf425a35f307add37067780b08f5b
