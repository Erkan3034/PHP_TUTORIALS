<?php
$servername = "localhost";
$username = "root";
$password = "Erkan1205/*-+";
$database="university";

//create connection
$conn = new mysqli($servername, $username, $password, $database);

//check connection
if($conn->connect_error){
    die("Connection failed to database: " . $conn->connect_error);
}
else{
    //echo "Connected to database successfully";
}

ini_set('session.cookie_httponly', 1);

ini_set('session.use_only_cookies',1); //session ID url'de taşınmasın


//sadece https üzerinden gönderilsin(eğer SSL sertifiksaı varsa çalışır)
//ini_set('session.cookie_secure',1);