<!DOCTYPE html>
<html>
<body>
<pre>

<?php

//!  indexed array
$cars = array("Volvo", "BMW", "Toyota"); 

var_dump($cars);
echo "<hr>";

//! Access indexed array:
echo $cars[0];
echo "<hr>";

//! Change value

$cars[1] = "DODGE";
foreach ($cars as $x) {
    echo "$x <br>";
  }

echo "<hr>";


//! add a new item with array_push()
array_push($cars, "Ford");
var_dump($cars);
echo "<hr>";


//! Associative Array(iliskisel)
//?Associative arrays are arrays that use named keys that you assign to them.
$car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);
var_dump($car);

echo "<hr>";

$car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);
echo $car["model"];

echo "<hr>";

//! foreach loop n associative arrays

$car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);

foreach ($car as $x => $y) {
  echo "$x: $y <br>";
}

echo "<hr>";


//!===================array-functions======

echo count($cars);

echo "<hr>";

//--------------------------------------------------------------------

echo "<pre>";
$hayvanlar =  [
  'Ucan Hayvanlar' => ["Kartal" ,"Sahin", "Güvercin"],

   'Sürüngen Hayvanlar' => ["Yılan", "Kertenkele0", "Solucan"]
];

print_r($hayvanlar);
echo "<hr>";
echo $hayvanlar['Ucan Hayvanlar'][1];


?>

</pre>
</body>
</html>


