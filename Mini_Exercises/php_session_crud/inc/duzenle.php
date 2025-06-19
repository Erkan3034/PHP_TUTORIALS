<?php
require_once '../system/baglanti.php';

// Check if session exists and user is logged in
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit;
}

// Get student ID from URL
$studentNo = isset($_GET['studentNo']) ? $_GET['studentNo'] : null;

if (!$studentNo) {
    header('Location: default.php');
    exit;
}

// Fetch student data
$stmt = $conn->prepare("SELECT * FROM student WHERE studentNo = ? AND sil = 2");
$stmt->bind_param('s', $studentNo);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    header('Location: default.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentName = $_POST['studentName'] ?? '';
    $studentSurname = $_POST['studentSurname'] ?? '';
    $studentDateOfBirth = $_POST['studentDateOfBirth'] ?? '';
    $studentTelNo = $_POST['studentTelNo'] ?? '';
    $studentMail = $_POST['studentMail'] ?? '';
    $studentGender = $_POST['studentGender'] ?? '';
    $studentFaculty = $_POST['studentFaculty'] ?? '';
    $studentDepartment = $_POST['studentDepartment'] ?? '';

    // Basic validation
    $errors = [];
    if (empty($studentName)) $errors[] = "Öğrenci adı gereklidir.";
    if (empty($studentSurname)) $errors[] = "Öğrenci soyadı gereklidir.";
    if (empty($studentMail)) $errors[] = "E-posta adresi gereklidir.";
    if (!filter_var($studentMail, FILTER_VALIDATE_EMAIL)) $errors[] = "Geçerli bir e-posta adresi giriniz.";

    if (empty($errors)) {
        try {
            $sql = "UPDATE student SET 
                    studentName = ?, 
                    studentSurname = ?, 
                    studentDateOfBirth = ?, 
                    studentTelNo = ?, 
                    studentMail = ?, 
                    studentGender = ?, 
                    studentFaculty = ?, 
                    studentDepartment = ? 
                    WHERE studentNo = ? AND sil = 2";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssssss', 
                $studentName, 
                $studentSurname, 
                $studentDateOfBirth, 
                $studentTelNo, 
                $studentMail, 
                $studentGender, 
                $studentFaculty, 
                $studentDepartment,
                $studentNo
            );
            
            if ($stmt->execute()) {
                header('Location: default.php?success=2');
                exit;
            } else {
                $errors[] = "Güncelleme yapılırken bir hata oluştu.";
            }
        } catch (Exception $e) {
            $errors[] = "Veritabanı hatası: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Öğrenci Düzenle</h3>
                        <a href="default.php" class="btn btn-secondary">Geri Dön</a>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="studentNo" class="form-label">Öğrenci Numarası</label>
                                    <input type="text" class="form-control" id="studentNo" value="<?php echo htmlspecialchars($student['studentNo']); ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="studentMail" class="form-label">E-posta*</label>
                                    <input type="email" class="form-control" id="studentMail" name="studentMail" required
                                           value="<?php echo htmlspecialchars($student['studentMail']); ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="studentName" class="form-label">Ad*</label>
                                    <input type="text" class="form-control" id="studentName" name="studentName" required
                                           value="<?php echo htmlspecialchars($student['studentName']); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="studentSurname" class="form-label">Soyad*</label>
                                    <input type="text" class="form-control" id="studentSurname" name="studentSurname" required
                                           value="<?php echo htmlspecialchars($student['studentSurname']); ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="studentDateOfBirth" class="form-label">Doğum Tarihi</label>
                                    <input type="date" class="form-control" id="studentDateOfBirth" name="studentDateOfBirth"
                                           value="<?php echo htmlspecialchars($student['studentDateOfBirth']); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="studentTelNo" class="form-label">Telefon Numarası</label>
                                    <input type="tel" class="form-control" id="studentTelNo" name="studentTelNo"
                                           value="<?php echo htmlspecialchars($student['studentTelNo']); ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="studentGender" class="form-label">Cinsiyet</label>
                                    <select class="form-select" id="studentGender" name="studentGender">
                                        <option value="">Seçiniz</option>
                                        <option value="Erkek" <?php echo ($student['studentGender'] === 'Erkek') ? 'selected' : ''; ?>>Erkek</option>
                                        <option value="Kadın" <?php echo ($student['studentGender'] === 'Kadın') ? 'selected' : ''; ?>>Kadın</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="studentFaculty" class="form-label">Fakülte</label>
                                    <input type="text" class="form-control" id="studentFaculty" name="studentFaculty"
                                           value="<?php echo htmlspecialchars($student['studentFaculty']); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="studentDepartment" class="form-label">Bölüm</label>
                                    <input type="text" class="form-control" id="studentDepartment" name="studentDepartment"
                                           value="<?php echo htmlspecialchars($student['studentDepartment']); ?>">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <a href="default.php" class="btn btn-secondary">İptal</a>
                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 