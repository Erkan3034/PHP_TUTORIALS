<?php
//Çerezleri (Cookies) Sadece HTTP Üzerinden Erişilebilir Yapmak
//Bir çerez HttpOnly olarak ayarlanırsa, bu çerez JavaScript tarafından okunamaz. Bu, XSS (Cross-Site Scripting) saldırılarına karşı önemli bir korumadır.
//Bir saldırgan, sitene zararlı bir <script> enjekte ederse, normalde şunu yapabilir:
//document.cookie
// => PHPSESSID=abc123xyz; başka_çerez=değer
ini_set('session.cookie_httponly', 1);

//ini_set('session.cookie_secure', 1);    // Sadece HTTPS üzerinden gönderilsin
// Not: session.cookie_secure sadece HTTPS (SSL sertifikası varsa) ile çalışır. HTTP'de boşuna yazma, çalışmaz.

ini_set('session.use_only_cookies', 1); // Session ID URL'de taşınmasın

session_start();
require_once 'system/baglanti.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
   
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<!-- https://htmlstream.com/preview/front-v3.2/documentation/aos.html -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold">Giriş Yap</h2>

                            <?php
                            //oturum varsa default sayfasına yönlendir
                            if(isset($_SESSION['id'])){
                                header("Location: inc/default.php");
                                exit;                            
                            }
                            
                            if(isset($_POST['login'])){
                                $username = htmlspecialchars(trim($_POST['username']));
                                $password = htmlspecialchars(trim($_POST['password']));
                                $password_hash = hash('sha256', $password);

                                $query = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
                                $query->bind_param('ss', $username, $password_hash);
                                $query->execute();
                                $result = $query->get_result();

                                if($result->num_rows > 0){
                                    $user = $result->fetch_assoc();
                                    $_SESSION['id'] = $user['id'];
                                    $_SESSION['username'] = $user['username'];
                                    $_SESSION['email'] = $user['email'];

                                    header("Location: inc/default.php");
                                    exit;
                                }
                                else{
                                    echo "<div class='alert alert-danger'>Kullanıcı adı veya şifre hatalı</div>";
                                }
                            }
                            ?>

                            <!--GİRİŞ FORMU-->
                            <div id="loginForm">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="username" class="form-label"></label>
                                        <input type="text" class="form-control" id="username" name="username" required placeholder="Kullanıcı Adı">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label"></label>
                                        <input type="password" class="form-control" id="password" name="password" required placeholder="Şifre">
                                    </div>
                                    <div class="d-grid mb-3">
                                        <button type="submit" name="login" class="btn btn-primary">Giriş Yap</button>
                                    </div>
                                </form>
                                <div class="text-center">
                                Hesabınız yok mu?<button type="button" class="btn btn-link" onclick="toggleForm()"> Kayıt olun</button>
                                </div>
                            </div>

                            <!--KAYIT İşlemleri-->
                            <?php
                            if(isset($_POST['register'])){
                                $username = htmlspecialchars(trim($_POST['username']));
                                $email = htmlspecialchars(trim($_POST['email']));
                                $password = htmlspecialchars(trim($_POST['password']));
                                $password_hash = hash('sha256', $password);
                                

                                //required fields check
                                if(!empty($username) && !empty($email) && !empty($password)){
                                    $is_there_user = $conn->prepare("SELECT username,email FROM users WHERE username = ? OR email = ?");
                                    $is_there_user->bind_param('ss', $username, $email);
                                    $is_there_user->execute();
                                    $is_there_user_result = $is_there_user->get_result();

                                    if($is_there_user_result->num_rows > 0){
                                        echo "<div class='alert alert-danger'>Kullanıcı adı veya email zaten kullanılıyor. Lütfen farklı bir kullanıcı adı veya email giriniz.</div>";
                                    }
                                    else{
                                        $insert_user = $conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
                                        $insert_user->bind_param('sss', $username, $email, $password_hash);
                                        
                                        if($insert_user->execute()){
                                            echo "<div class='alert alert-success'>Kayıt başarıyla tamamlandı. Giriş yapabilirsiniz.</div>";
                                        }
                                        else{
                                            echo "<div class='alert alert-danger'>Kayıt başarısız. Lütfen daha sonra tekrar deneyiniz.</div>";
                                        }
                                    }
                                }
                                else{
                                    echo "<div class='alert alert-danger'>Lütfen tüm alanları doldurunuz.</div>";
                                }
                            }
                            ?>

                            <!--KAYIT FORMU(basta gizli)-->
                            <div id="registerForm" style="display:none;">
                                <form method="POST">
                                    <div class="mb-3"> 
                                        <label for="reg_username" class="form-label">Kullanıcı Adı</label>
                                        <input type="text" class="form-control" id="reg_username" name="username" required placeholder="Kullanıcı Adı">
                                    </div>
                                    <div class="mb-3">
                                        <label for="reg_email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="reg_email" name="email" required placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="reg_password" class="form-label">Şifre</label>
                                        <input type="password" class="form-control" id="reg_password" name="password" required>
                                    </div>
                                    <div class="d-grid mb-3">
                                        <button type="submit" name="register" class="btn btn-primary">Kayıt Ol</button>
                                    </div>
                                </form>
                                <div class="text-center">
                                    Zaten hesabınız var mı? <button type="button" class="btn btn-link" onclick="toggleForm()">Giriş yapın</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleForm(){
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        if(loginForm.style.display === 'none'){
            loginForm.style.display = 'block';
            registerForm.style.display = 'none';
        }
        else{
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
        }
    }
</script>
</html>