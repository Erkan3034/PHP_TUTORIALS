<?php
// Örnek: Belirli bir sayıda satırdan oluşan bir üçgen çizmek için yazılan fonk.
function drawTriangle($rows) {
    $i = 1; // while için başlangıç değeri
    
    // Dış döngü (while) - satırları kontrol eder
    while ($i <= $rows) {
        // İç döngü (for) - sütunları kontrol eder
        for ($j = 1; $j <= $i; $j++) {
            echo "0 ";
        }
        echo "<br>"; // Satır sonu
        $i++; // while sayacını artır
    }
}

drawTriangle(15);

?>