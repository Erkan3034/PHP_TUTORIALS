<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) { //user is not logged in
    header("Location: login.php");
    exit;
}

$host = 'localhost';
$user = 'root';
$password = 'Erkan1205/*-+';
$database = 'university';

// MySQL sunucusuna bağlantı
$conn = new mysqli($host, $user, $password, $database);

// Bağlantı hatası varsa mesaj göster ve işlemi sonlandır
if ($conn->connect_error) {
    die('Bağlantı Hatası: ' . $conn->connect_error);
}

// Sayfalama için kaç kayıt gösterileceğini belirliyoruz
$records_per_page = 10;

// URL üzerinden gelen sayfa numarasını alıyoruz, yoksa 1 kabul ediyoruz
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// SQL LIMIT için başlangıç kaydını hesaplıyoruz
$start_from = ($page - 1) * $records_per_page;

// Arama işlemi için "search" parametresini alıyoruz
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Arama yapılmışsa SQL'e WHERE koşulu ekleniyor
$search_sql = $search ? "WHERE studentName LIKE '%$search%' OR studentSurname LIKE '%$search%'" : '';

// Öğrenci verilerini LIMIT ile sorguluyoruz
$sql = "SELECT * FROM student where sil=2 $search_sql LIMIT $start_from, $records_per_page "; // sil=2 olanları alıyoruz
$results = $conn->query($sql);

// Toplam kayıt sayısını alıp kaç sayfa olacağını hesaplıyoruz
$sql_count = "SELECT COUNT(*) FROM student $search_sql"; // Toplam kayıt sayısını alıyoruz
$count_result = $conn->query($sql_count); //
$total_records = $count_result->fetch_row()[0]; // Kaç kayıt olduğunu alıyoruz
$total_pages = ceil($total_records / $records_per_page); // Sayfa sayısını hesapla
?>


<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>Öğrenci Listesi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="shadow-lg p-5 container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="display-1 fw-bold">ÖĞRENCİ LİSTESİ</h2>
            <div>
                <span class="me-3">Hoş geldiniz, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Çıkış Yap</a>
            </div>
        </div>

        <!-- Arama Formu -->
        <form method="get" class="mb-3 text-center ">
            <label for="search" class="form-label ">Öğrenci Ara:</label>
            <!-- Arama kutusu (GET ile aynı sayfaya geri döner) -->
            <input type="text" name="search" class="form-control shadow" placeholder="İsim veya Soyisimle Ara" value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary mt-2">Ara</button>
        </form>

        <?php if ($results->num_rows > 0): ?> <!-- Eğer sonuç varsa tablo gösteriliyor -->

            <!-- Tablo Başlangıcı -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped  mx-auto">
                    <thead class="table-dark">
                        <tr>
                            <th>ÖĞRENCİ NO</th>
                            <th>İSİM</th>
                            <th>SOYİSİM</th>
                            <th>DOĞUM TARİHİ</th>
                            <th>TELEFON NO</th>
                            <th>MAIL ADRESİ</th>
                            <th>CİNSİYET</th>
                            <th>FAKÜLTE</th>
                            <th>DEPARTMAN</th>
                            <th class="text-white bg-danger border-info border-2">İŞLEMLER</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Her satır için döngü -->
                        <?php while ($row = $results->fetch_assoc()): ?>
                            <tr>
                                <!-- PHP'den gelen veriler HTML içine yazılıyor -->
                                <td><?= htmlspecialchars($row['studentNo']) ?></td>
                                <td><?= htmlspecialchars($row['studentName']) ?></td>
                                <td><?= htmlspecialchars($row['studentSurname']) ?></td>
                                <td><?= htmlspecialchars($row['studentDateOfBirth']) ?></td>
                                <td><?= htmlspecialchars($row['studentTelNo']) ?></td>
                                <td><?= htmlspecialchars($row['studentMail']) ?></td>
                                <td><?= htmlspecialchars($row['studentGender']) ?></td>
                                <td><?= htmlspecialchars($row['studentFaculty']) ?></td>
                                <td><?= htmlspecialchars($row['studentDepartment']) ?></td>
                                <td class="text-center d-inline-flex flex-column">
                                    <!-- Güncelleme ve Silme işlemleri için linkler -->
                                    <a href="update.php?id=<?= htmlspecialchars($row['studentNo'], ENT_QUOTES, 'UTF-8') ?>" class="btn mb-1 btn-sm btn-warning"><i class="bi bi-pencil-square"></i>Güncelle</a>

                                    <a href="delete.php?id=<?= $row['studentNo'] ?>" class="btn btn-sm btn-danger" onclick="return confirm(' <?= $row['studentNo']; ?> nolu öğrenci kaydını Silmek istediğinize emin misiniz?')">
                                        <i class="bi bi-trash"></i> Sil
                                    </a>
                                </td>
                            </tr>


                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <!-- Sayfalama (Pagination) -->
            <nav>
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <!-- Her sayfa linki aynı sayfaya geri döner ama GET parametresiyle sayfa numarası gelir -->
                            <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php else: ?>
            <!-- Öğrenci bulunamazsa uyarı -->
            <div class="alert alert-warning">Hiç öğrenci bulunamadı.</div>
        <?php endif; ?>

        <!-- Yeni öğrenci ekleme butonu -->
        <div class="text-center mt-4">
            <a href="create.php" class="btn btn-success btn-lg">Yeni Öğrenci Ekle</a>
        </div>
    </div>

    <!-- Bootstrap JS dosyası -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>

<?php
// Sayfa sonunda bağlantıyı kapatıyoruz
$conn->close();
?>