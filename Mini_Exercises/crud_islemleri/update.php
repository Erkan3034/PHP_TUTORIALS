<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = 'Önce giriş yapmalısınız.'; 
    go('http://localhost/PHP_NOTES/Mini_Exercises/crud_islemleri/login.php', 0); // Redirect to login page
    exit;
}

$host = 'localhost';
$user = 'root';
$password = 'Erkan1205/*-+';
$database = 'university';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Bağlantı Hatası: " . $conn->connect_error);
}

$id = trim($_GET['id'] ?? ''); // ID'yi alıyoruz ve boşsa hata veriyoruz

// ID'nin sadece sayısal olup olmadığını kontrol edelim
if (!ctype_digit($id)) {
    die("Geçersiz öğrenci numarası.");
}

// Prepared statement ile öğrenciyi çek
$stmt = $conn->prepare("SELECT studentName, studentSurname, studentDateOfBirth, studentTelNo, studentMail, studentGender, studentFaculty, studentDepartment FROM student WHERE studentNo = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    die("Öğrenci bulunamadı.");
}

$student = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['studentName'];
    $surname = $_POST['studentSurname'];
    $dob = $_POST['studentDateOfBirth'];
    $tel = $_POST['studentTelNo'];
    $mail = $_POST['studentMail'];
    $gender = $_POST['studentGender'];
    $faculty = $_POST['studentFaculty'];
    $department = $_POST['studentDepartment'];

    // Güncelleme sorgusunu hazırlayıp parametreleri bağla
    $update = $conn->prepare("UPDATE student SET
        studentName = ?,
        studentSurname = ?,
        studentDateOfBirth = ?,
        studentTelNo = ?,
        studentMail = ?,
        studentGender = ?,
        studentFaculty = ?,
        studentDepartment = ?
        WHERE studentNo = ?"); //studetNo'ya göre WHERE ile güncelliyoruz

    $update->bind_param("ssssssssi", $name, $surname, $dob, $tel, $mail, $gender, $faculty, $department, $id);

if ($update->execute()) {
    $success = true;
} else {
    echo "Hata: " . $update->error;
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
    
<?php if (!empty($success)) : ?>
    <div class="alert alert-success mt-3" role="alert">
        Kayıt başarıyla güncellendi! Ana sayfaya yönlendiriliyorsunuz...
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "index.php";
        }, 2000);
    </script>
<?php endif; ?>

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
