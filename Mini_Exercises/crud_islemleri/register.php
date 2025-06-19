<?php
session_start();

// If user is already logged in, redirect to listeleme.php
if (isset($_SESSION['user_id'])) {
    header("Location: listeleme.php");
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

$error = '';
$success = '';


// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username'])); // Get the username from the form with htmlspecialchars to prevent XSS
    // htmlspecialchars is used to prevent XSS attacks by escaping special characters
    $password = htmlspecialchars(trim($_POST['password'])); // Get the password from the form
    $confirm_password = (htmlspecialchars(trim($_POST['confirm_password'])));  // Get the confirm password from the form

    if (empty($username) || empty($password) || empty($confirm_password)) { // Check if any field is empty
        $error = "Lütfen Tüm alanları doldurunuz."; 
    } elseif (strlen($username) < 3 || strlen($username) > 50) { 
        $error = "Kullanıcı adı 3-50 karakter arasında olmalıdır.";
    } elseif (strlen($password) < 6) {
        $error = "Şifre en az 6 karakter olmalıdır.";
    } elseif ($password !== $confirm_password) {
        $error = "Şifreler eşleşmiyor.";
    } else {


        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?"); // Prepare the SQL statement to prevent SQL injection
        $stmt->bind_param("s", $username); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) { //check if the username already exists
            $error = "Bu kullanıcı adı zaten kullanılıyor.";
        }
        
        else {
            // Hash password and insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password using password_hash function
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);
            
            if ($stmt->execute()) { //execute the statement(insert the data into the database)
                $success = "Kayıt başarılı! Şimdi giriş yapabilirsiniz.";
            } else {
                $error = "Kayıt sırasında bir hata oluştu: " . $conn->error;
            }
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
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container shadow-lg" id="registerForm">
            <h2 class="text-center mb-4">Kayıt Ol</h2>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <form method="POST" action=""> <!-- Form submission method is POST -->
                <div class="mb-3">
                    <label for="username" class="form-label">Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="username" name="username" 
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" 
                           required minlength="3" maxlength="50">
                    <div class="form-text">3-50 karakter arasında olmalıdır.</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Şifre</label>
                    <input type="password" class="form-control" id="password" name="password" required minlength="6">
                    <div class="form-text">En az 6 karakter olmalıdır.</div>
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Şifre Tekrar</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required minlength="6">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="register">Kayıt Ol</button>
                </div>

                <div class="text-center mt-3">
                    <p class="mb-0">Zaten hesabınız var mı? <a href="login.php">Giriş Yap</a></p>
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
