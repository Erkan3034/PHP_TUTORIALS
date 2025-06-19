<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'Önce giriş yapmalısınız.'; 
    go('http://localhost/PHP_NOTES/Mini_Exercises/crud_islemleri/login.php', 0); // Redirect to login page
    exit;
}

// Veritabanı bağlantısı için bilgiler tanımlanıyor
$host = 'localhost';
$user = 'root';
$password = 'Erkan1205/*-+';
$database = 'university';

// mysqli nesnesi kullanılarak veritabanına bağlanılıyor
$conn = new mysqli($host, $user, $password, $database);

// Kullanıcıya gösterilecek mesajlar için boş bir değişken tanımlanıyor
$message = '';

// Bağlantı hatası varsa, uygulama burada durduruluyor
if ($conn->connect_error) {
    die("Bağlantı Hatası: " . $conn->connect_error);
}

// Form gönderilmişse (POST isteği geldiyse) bu blok çalışır
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan gelen veriler değişkenlere atanıyor
    $no = $_POST['studentNo'];
    $name = $_POST['studentName'];
    $surname = $_POST['studentSurname'];
    $dob = $_POST['studentDateOfBirth'];
    $tel = $_POST['studentTelNo'];
    $mail = $_POST['studentMail'];
    $gender = $_POST['studentGender'];
    $faculty = $_POST['studentFaculty'];
    $department = $_POST['studentDepartment'];

    // Öğrenci numarası veritabanında daha önce kayıtlı mı diye kontrol ediliyor
    $checkSql = "SELECT * FROM student WHERE studentNo = '$no'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        // Eğer öğrenci numarası zaten varsa kullanıcıya hata mesajı veriliyor
        $message = "<div class='alert alert-danger text-center'>Bu öğrenci numarasıyla kayıtlı bir öğrenci zaten var.</div>";
    } else {
        // Yeni öğrenci veritabanına ekleniyor
        $sql = "INSERT INTO student (studentNo, studentName, studentSurname, studentDateOfBirth, studentTelNo, studentMail, studentGender, studentFaculty, studentDepartment)
                VALUES ('$no','$name', '$surname', '$dob', '$tel', '$mail', '$gender', '$faculty', '$department')";

        if ($conn->query($sql) === TRUE) {
            // Başarılıysa kullanıcıya yeşil başarı mesajı veriliyor
            $message = "
                <div class='alert alert-success text-center'>
                    Yeni öğrenci başarıyla eklendi.
                    <br>
                    <a href='listeleme.php' class='btn btn-sm btn-warning mt-3'>Ana Sayfaya Dön</a>
                </div>";
        } else {
            // Veritabanı hatası olursa kullanıcıya detaylı hata veriliyor
            $message = "<div class='alert alert-danger text-center'>Kayıt sırasında bir hata oluştu: " . $conn->error . "</div>";
        }
    }
}
?>


<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Öğrenci Ekle</title>
    <!-- Bootstrap kütüphanesi ile şık bir görünüm sağlanıyor -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
    
    <!-- PHP'de tanımlanan $message değişkeni burada gösteriliy -->
    <?= $message ?> 

        <h2 class="mb-4 text-center">Yeni Öğrenci Ekle</h2>

        <!-- Form alanı: method POST olduğunda PHP tarafında kontrol başlıyor -->
        <form method="post">
            <div class="row g-3">
                <!-- Her input alanının name değeri, PHP'de $_POST ile erişilecek isimdir -->
                <div class="col-md-6"><input name="studentNo" class="form-control" placeholder="Öğrenci No" required></div>
                <div class="col-md-6"><input name="studentName" class="form-control" placeholder="İsim" required></div>
                <div class="col-md-6"><input name="studentSurname" class="form-control" placeholder="Soyisim" required></div>
                <div class="col-md-6"><input name="studentDateOfBirth" type="date" class="form-control" required></div>
                <div class="col-md-6"><input name="studentTelNo" class="form-control" placeholder="Telefon No" required></div>
                <div class="col-md-6"><input name="studentMail" class="form-control" placeholder="Mail" required></div>
                
                <!-- Select kutusunda da name değeri PHP tarafında kullanılmak üzere tanımlı -->
                <div class="col-md-6">
                    <select name="studentGender" class="form-control" required>
                        <option value="">Cinsiyet Seç</option>
                        <option value="Erkek">Erkek</option>
                        <option value="Kadın">Kadın</option>
                    </select>
                </div>

                <div class="col-md-6"><input name="studentFaculty" class="form-control" placeholder="Fakülte" required></div>
                <div class="col-md-6"><input name="studentDepartment" class="form-control" placeholder="Departman" required></div>
            </div>

            <!-- Butonlar: POST işlemini başlatır ve geri dönüş sağlar -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Kaydet</button>
                <a href="listeleme.php" class="btn btn-secondary">Geri Dön</a>
            </div>
        </form>
    </div>
</body>
</html>
