<?php
session_start();
require_once "../system/baglanti.php";
require_once "../system/fonksiyon.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            margin-bottom: 100px; /* Footer için boşluk */
        }
        .bi-pencil, .bi-trash3 {
            color: #000;
            font-size: 1.1rem;
        }
        .bi-pencil:hover, .bi-trash3:hover {
            color: #0d6efd;
        }
    </style>

    <title>Öğrenci Bilgi Sistemi</title>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-info text-white d-flex justify-content-between">
                <p class="h3">Verilerin Listelenmesi</p>
                <a href="yenikayit.php" class="btn btn-warning">
                    Yeni Öğrenci Ekle
                </a>
            </div>
            <div class="card-body">
                <?php 
                // Öğrenci listesini çek
                $sorgu = "SELECT * FROM student WHERE sil = 2"; // 2: aktif kayıtlar
                $results = $conn->query($sorgu);

                if ($results && $results->num_rows > 0) {
                ?>
                    <table class="table border table-striped table-hover">
                        <tr>
                            <th>Öğrenci No</th>
                            <th>Adı</th>
                            <th>E-Posta</th>
                            <th>Eylemler</th>
                        </tr>
                        <?php while ($row = $results->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["studentNo"]; ?></td>
                            <td><?php echo $row["studentName"]; ?></td>
                            <td><?php echo $row["studentMail"]; ?></td>
                            <td>
                                <a class="btn btn-outline-success" href="duzenle.php?studentNo=<?php echo $row["studentNo"]; ?>" style="text-decoration: none;">
                                    <i class="bi bi-pencil" style="cursor:pointer"></i>
                                </a>
                                <a class="btn btn-outline-danger" href="sil.php?studentNo=<?php echo $row["studentNo"]; ?>" 
                                   onclick="return confirm('<?php echo $row["studentNo"]; ?> nolu öğrenci kaydını silmek istediğinize emin misiniz?')"
                                   style="text-decoration: none;">
                                    <i class="bi bi-trash3 ms-2" style="cursor:pointer"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                <?php 
                } else {
                    echo '<div class="alert alert-info">Henüz kayıtlı öğrenci bulunmamaktadır.</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <footer class="footer fixed-bottom bg-dark text-light py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <p class="mb-0">&copy; 2025 Öğrenci Bilgi Sistemi</p>
                </div>
                <div class="col-md-4 text-center">
                    <p class="mb-0">Tüm hakları saklıdır.</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="cikis.php" class="btn btn-danger">
                        <i class="bi bi-box-arrow-right"></i> Çıkış Yap
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous"></script>
</body>
</html>