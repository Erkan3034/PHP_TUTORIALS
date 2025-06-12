<?php

function go($url,$saniye = 0) {
    if(!headers_sent()) {
        if($saniye == 0) {
            header("Location:$url");
        } else {
            header("Refresh:$saniye; URL:$url");
        }
        exit;
    } else {
         echo "<meta http-equiv='refresh' content='{$saniye};url={$url}'>";
    }
}
?>