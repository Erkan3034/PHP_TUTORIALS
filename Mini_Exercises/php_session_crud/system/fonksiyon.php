<?php

/**
 * Sayfa yönlendirme fonksiyonu
 * @param string $url Yönlendirilecek URL adresi
 * @param int $saniye Yönlendirme için beklenecek süre (varsayılan: 0)
 */
function go($url, $saniye = 0){
    // Headers zaten gönderilmemiş ise PHP header fonksiyonunu kullan
    if(!headers_sent()){
        // Eğer saniye 0 ise anında yönlendir
        if($saniye == 0){
            header("Location: $url");
        }
        // Saniye belirtilmiş ise o kadar süre bekleyip yönlendir
        else{
            header("Refresh: $saniye; url=$url");
        }
        exit;
    }
    // Headers zaten gönderilmiş ise HTML meta tag ile yönlendir
    else{
        echo "<meta http-equiv='refresh' content='$saniye;url=$url'>";
        exit;
    }
}
?>