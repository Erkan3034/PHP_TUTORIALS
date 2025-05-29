<?php
session_start();

// If user is already logged in, redirect to listeleme.php
if (isset($_SESSION['user_id'])) { //user is logged in
    header("Location: listeleme.php"); //redirect to listeleme.php
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

$error = ''; //error

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']); //get username from form
    $password = $_POST['password']; //get password from form

    if (empty($username) || empty($password)) { //check if username or password is empty
        $error = "Kullanıcı adı ve şifre gereklidir.";
    } else {
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?"); //prepare statement to prevent sql injection
        $stmt->bind_param("s", $username); //bind parameters to the statement
        $stmt->execute(); //execute the statement
        $result = $stmt->get_result(); //get the result 

        if ($result->num_rows === 1) { //check if there is only one row
            $user = $result->fetch_assoc(); //get the user data
            // Verify password
            if (password_verify($password, $user['password'])) { //verify the password
                // Password is correct, start a new session
                session_regenerate_id(true); //regenerate the session id
                $_SESSION['user_id'] = $user['id']; //set the user id to the session
                $_SESSION['username'] = $user['username']; //set the username to the session

                // Redirect to index page
                header("Location: listeleme.php"); //redirect to listeleme.php if password is correct
                exit;
            } else {
                $error = "Geçersiz kullanıcı adı veya şifre.";
            }
        } else {
            $error = "Geçersiz kullanıcı adı veya şifre.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-container {
            max-width: 450px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            padding: 0.8rem 1rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            border-color: #86b7fe;
        }
       
        .social-btn {
            border-radius: 8px;
            padding: 0.8rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .social-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .form-floating {
            margin-bottom: 1rem;
        }
        .form-floating > .form-control {
            height: calc(3.5rem + 2px);
            padding: 1rem 0.75rem;
        }
        .form-floating > label {
            padding: 1rem 0.75rem;
        }
        .divider {
            position: relative;
            text-align: center;
            margin: 1.5rem 0;
        }
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #dee2e6;
            z-index: 1;
        }
        .divider span {
            position: relative;
            background: white;
            padding: 0 1rem;
            color: #6c757d;
            z-index: 2;
        }
        .welcome-text {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }
        .brand-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .brand-logo img {
            width: 80px;
            height: 80px;
            font-size: 2.5rem;
            color: #0d6efd;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-container shadow-lg" id="loginForm">
            <div class="brand-logo">
             <img src="https://upload.wikimedia.org/wikipedia/tr/7/7b/Bart%C4%B1n_%C3%9Cniversitesi_logosu.jpg" alt="">
            </div>
            <h2 class="text-center mb-2">Hoş Geldiniz</h2>
            <p class="text-center welcome-text">Hesabınıza giriş yaparak devam edin</p>
            
            <?php if ($error): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div><?php echo htmlspecialchars($error); ?></div>
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

                <div class="d-grid mb-4">
                    <button type="submit" name="login" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Giriş Yap
                    </button>
                </div>

                <div class="divider">
                    <span>Sosyal Medya ile Giriş Yap</span>
                </div>

                <div class="d-grid gap-2">
                    <a href="register.php" class="btn btn-outline-danger social-btn">
                        <i class="bi bi-google me-2"></i>Google ile Giriş Yap
                    </a>

                    <a href="register.php" class="btn btn-outline-dark social-btn">
                        <i class="bi bi-twitter-x me-2"></i>Twitter ile Giriş Yap
                    </a>

                    <a href="register.php" class="btn btn-outline-primary social-btn" >
                        <i class="bi bi-facebook me-2"></i>Facebook ile Giriş Yap
                    </a>
                </div>

                <div class="text-center mt-4">
                    <p class="mb-0">Hesabınız yok mu? 
                        <a href="register.php" class="text-decoration-none fw-bold">Hemen Kayıt Olun</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>