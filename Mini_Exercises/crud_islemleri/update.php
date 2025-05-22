<?php
// Veritabanı bağlantı bilgileri
$host = 'localhost';
$user = 'root';
$password = 'Erkan1205/*-+';
$database = 'university';

// Veritabanı bağlantısı kurulur
$conn = new mysqli($host, $user, $password, $database);

// Bağlantı hatası kontrol edilir
if ($conn->connect_error) {
    die("Bağlantı Hatası: " . $conn->connect_error); // Hata varsa sayfayı durdurur
}

// GET ile gelen öğrenci numarası (id) alınır, boşluklar temizlenir
$id = trim($_GET['id'] ?? '');

// Veritabanından bu öğrenci numarasına sahip kayıt çekilir
$result = $conn->query("SELECT studentName, studentSurname,studentDateOfBirth,studentTelNo,studentMail,studentGender,studentFaculty,studentDepartment  FROM student WHERE studentNo = $id");

// Eğer öğrenci bulunamazsa, sayfa hata mesajı göstererek durur
if ($result->num_rows != 1) {
    die("Öğrenci bulunamadı.");
}

// Öğrenci bilgisi bir dizi olarak alınır
$student = $result->fetch_assoc(); 

// Eğer form gönderilmişse (yani method POST ise)
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    // Formdan gelen bilgiler değişkenlere atanır
    $name = $_POST['studentName']; // Öğrenci adı alınır 
    $surname = $_POST['studentSurname'];
    $dob = $_POST['studentDateOfBirth'];
    $tel = $_POST['studentTelNo'];
    $mail = $_POST['studentMail'];
    $gender = $_POST['studentGender'];
    $faculty = $_POST['studentFaculty'];
    $department = $_POST['studentDepartment'];

    // Güncelleme SQL sorgusu
    $sql = "UPDATE student SET
        studentName = '$name',
        studentSurname = '$surname',
        studentDateOfBirth = '$dob',
        studentTelNo = '$tel',
        studentMail = '$mail',
        studentGender = '$gender',
        studentFaculty = '$faculty',
        studentDepartment = '$department'
        WHERE studentNo = $id";

    // Sorgu başarıyla çalıştıysa, ana sayfaya yönlendirme yapılır
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // yönlendirme
        exit;
    } else {
        echo "Hata: " . $conn->error; // Hata varsa göster
    }
}
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Öğrenci Güncelle</title>
    <!-- Bootstrap CSS dosyası eklenir -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container container-fluid mt-5">
    <h2 class="mb-4 text-center">Öğrenci Bilgilerini Güncelle</h2>

    <!-- Formun method'u POST. PHP'nin üstteki kısmında bu kontrol ediliyor -->
    <form method="post">
        <div class="row g-3">
         
            <!-- Bu sayede form açıldığında alanlar dolu geliyor -->
            <div class="col-md-6">
                <input name="studentName" value="<?= $student['studentName'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <input name="studentSurname" value="<?= $student['studentSurname'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <input type="date" name="studentDateOfBirth" value="<?= $student['studentDateOfBirth'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <input name="studentTelNo" value="<?= $student['studentTelNo'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <input name="studentMail" value="<?= $student['studentMail'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <!-- Cinsiyet seçimi yapılırken doğru olan seçili geliyor -->
                <select name="studentGender" class="form-control" required>
                    <option value="Erkek" <?= $student['studentGender'] == 'Erkek' ? 'selected' : '' ?>>Erkek</option>
                    <option value="Kadın" <?= $student['studentGender'] == 'Kadın' ? 'selected' : '' ?>>Kadın</option>
                </select>
            </div>
            <div class="col-md-6">
                <input name="studentFaculty" value="<?= $student['studentFaculty'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <input name="studentDepartment" value="<?= $student['studentDepartment'] ?>" class="form-control" required>
            </div>
        </div>

        <!-- Butonlar -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Güncelle</button>
            <a href="index.php" class="btn btn-secondary">İptal</a>
        </div>
    </form>
</div>
</body>
</html>
