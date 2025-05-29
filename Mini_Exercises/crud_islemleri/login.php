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

$error = '';

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
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
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
        <div class="login-container shadow-lg">
            <h2 class="text-center mb-4">Öğrenci Yönetim Sistemi</h2>
            <h4 class="text-center mb-4">Giriş Yap</h4>
            
            <?php if ($error): ?> <!--check if there is an error-->
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div> <!--display the error-->
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Şifre</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" name="login" class="btn btn-primary">Giriş Yap</button>
                </div>

                <div class="text-center mt-3">
                    <p class="mb-0">Hesabınız yok mu? <a href="register.php">Kayıt Ol</a></p>
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