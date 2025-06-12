<?php

session_start();
require_once 'go.php';
 // go fonksiyonunu içe aktar
// Eğer kullanıcı zaten giriş yaptıysa, listeleme sayfasına yönlendir
if (isset($_SESSION['user_id'])) {
    header("Location: listeleme.php");
    exit;
}

$host = 'localhost';
$user = 'root';
$password = 'Erkan1205/*-+';
$database = 'university';

// Veritabanı bağlantısı
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Bağlantı Hatası: " . $conn->connect_error);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username'])); // Kullanıcı adını al ve XSS saldırılarına karşı koru
    $passwordInput = htmlspecialchars(trim($_POST['password'])); // Şifreyi al ve XSS saldırılarına karşı koru

    if (empty($username) || empty($passwordInput)) {
        $error = "Kullanıcı adı ve şifre boş bırakılamaz.";
    } else {
        // SQL Injection'a karşı hazırlıklı sorgu
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc(); // Kullanıcıyı al
            if (password_verify($passwordInput, $user['password'])) { // Şifreyi doğrula(veritabanındaki hash ile karşılaştır)
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                // Giriş başarılıysa, listeleme sayfasına yönlendir
                go('http://localhost/PHP_NOTES/Mini_Exercises/crud_islemleri/listeleme.php',0); // Giriş başarılıysa listeleme sayfasına yönlendir
            } else {
                $error = "Kullanıcı adı veya şifre yanlış.";
            }
        } else {
            $error = "Kullanıcı adı veya şifre yanlış.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            display: flex;
            align-items: center;
            min-height: 100vh;
        }
        .login-container {
            max-width: 450px;
            margin: auto;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .brand-logo img {
            width: 80px;
            height: 80px;
        }
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.15);
        }
        .social-btn {
            padding: 0.8rem;
            font-weight: 500;
            border-radius: 8px;
        }
        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0; right: 0;
            height: 1px;
            background: #dee2e6;
        }
        .divider span {
            background: white;
            padding: 0 1rem;
            z-index: 2;
            position: relative;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container h-50 ">
        <div class="login-container">
            <div class="text-center brand-logo mb-3">
                <img src="https://upload.wikimedia.org/wikipedia/tr/7/7b/Bart%C4%B1n_%C3%9Cniversitesi_logosu.jpg" alt="Logo">
            </div>
            <h2 class="text-center mb-3">Hoş Geldiniz</h2>
            <p class="text-center text-muted">Hesabınıza giriş yaparak devam edin</p>

            <?php if ($error): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı Adı" required>
                    <label for="username"><i class="bi bi-person me-2"></i>Kullanıcı Adı</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Şifre" required>
                    <label for="password"><i class="bi bi-lock me-2"></i>Şifre</label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Giriş Yap
                    </button>
                </div>

                <div class="divider"><span>Sosyal Medya ile Giriş</span></div>

                <div class="d-grid gap-2 mb-3">
                    <a href="#" class="btn btn-outline-danger social-btn"><i class="bi bi-google me-2"></i>Google</a>
                    <a href="#" class="btn btn-outline-dark social-btn"><i class="bi bi-twitter-x me-2"></i>Twitter</a>
                    <a href="#" class="btn btn-outline-primary social-btn"><i class="bi bi-facebook me-2"></i>Facebook</a>
                </div>

                <div class="text-center">
                    <p class="mb-0">Hesabınız yok mu? 
                        <a href="register.php" class="text-decoration-none fw-bold">Kayıt Olun</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
