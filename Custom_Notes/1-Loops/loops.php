<<<<<<< HEAD
<?php
//?---- LOOPS -----

//! ====================================== FOR Loop
for ($x = 0; $x < 10; $x++) {
  echo $x . "<br>";
}
echo "<hr>";

//? ===================================================================
$dizi = [
  'Erkan',
  'Serkan',
  'Necip',
];

for ($y = 0; $y < 3; $y++) {
  echo $dizi[$y] . '<br>';
}
echo "<hr>";


//! ====================================== FOREACH Loop
$sehirler = ["Ankara", "İstanbul", "Van", "Hakkari", "Edirne", "Hatay"];
echo "Sehirler:<br> ";
foreach ($sehirler as $key1) {
  echo $key1 . "<br>";
}
echo "<hr>";

//? =================================================

$sehirler2 = [
  'EGE BÖLGESİ' => ["İstanbul", "Bursa", "Balıkesir"],
  'KARADENİZ BÖLGESİ' => ["Bartın", "Zonguldak", "Samsun"],
  'DOĞU ANADOLU BÖLGESİ' => ["Van", "Bitlis", "Hakkari"],
];

foreach ($sehirler2 as $key => $value) {
  echo '<span style="color:red;">' . $key . "</span> : ";
  
  foreach ($value as $sehir) {
    echo $sehir . ", ";
  }
  echo "<br>";
}
echo "<hr>";

//! ====================================== While loop
$i = 1;
while ($i < 7) {
  if ($i == 5)
    break; //if $i == 5break the loop.
  echo "$i";
  echo "<hr>";
  $i++;
}
/*
while ($i < 6) {
    $i++;
    if ($i == 3) continue;  // if $i == 3, don't write 3 and continue to write the other elements.
    echo $i;
    echo "<hr>";

  } 
*/


$a = 0;
while ($a < 100) {
  $a += 10;
  echo "$a <br>";
}

=======
<?php
//?---- LOOPS -----

//! ====================================== FOR Loop
for ($x = 0; $x < 10; $x++) {
  echo $x . "<br>";
}
echo "<hr>";

//? ===================================================================
$dizi = [
  'Erkan',
  'Serkan',
  'Necip',
];

for ($y = 0; $y < 3; $y++) {
  echo $dizi[$y] . '<br>';
}
echo "<hr>";


//! ====================================== FOREACH Loop
$sehirler = ["Ankara", "İstanbul", "Van", "Hakkari", "Edirne", "Hatay"];
echo "Sehirler:<br> ";
foreach ($sehirler as $key1) {
  echo $key1 . "<br>";
}
echo "<hr>";

//? =================================================

$sehirler2 = [
  'EGE BÖLGESİ' => ["İstanbul", "Bursa", "Balıkesir"],
  'KARADENİZ BÖLGESİ' => ["Bartın", "Zonguldak", "Samsun"],
  'DOĞU ANADOLU BÖLGESİ' => ["Van", "Bitlis", "Hakkari"],
];

foreach ($sehirler2 as $key => $value) {
  echo '<span style="color:red;">' . $key . "</span> : ";
  
  foreach ($value as $sehir) {
    echo $sehir . ", ";
  }
  echo "<br>";
}
echo "<hr>";

//! ====================================== While loop
$i = 1;
while ($i < 7) {
  if ($i == 5)
    break; //if $i == 5break the loop.
  echo "$i";
  echo "<hr>";
  $i++;
}
/*
while ($i < 6) {
    $i++;
    if ($i == 3) continue;  // if $i == 3, don't write 3 and continue to write the other elements.
    echo $i;
    echo "<hr>";

  } 
*/


$a = 0;
while ($a < 100) {
  $a += 10;
  echo "$a <br>";
}

>>>>>>> cbc7f9893baa939c1a26651bf141a64ce1edf6fe
?>