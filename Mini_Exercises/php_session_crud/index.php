<?php require_once 'system/baglanti.php'; ?>

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

                            
                            ?>
                            <!--GİRİŞ FORMU-->
                            <div id="loginForm">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Kullanıcı Adı</label>
                                        <input type="text" class="form-control" id="username" name="username" required placeholder="Kullanıcı Adı">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Şifre</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="d-grid mb-3">
                                        <button type="submit" name="login" class="btn btn-primary">Giriş Yap</button>
                                    </div>
                                </form>
                            </div>


                            <!--KAYIT FORMU(basta gizli)-->
                            <div id="registerForm" style="display:none;">
                                <form method="POST">
                                    <div class="mb-3"> 
                                        <label for="username" class="form-label">Kullanıcı Adı</label>
                                        <input type="text" class="form-control" id="username" name="username" required placeholder="Kullanıcı Adı">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Şifre</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="d-grid mb-3">
                                        <button type="submit" name="register" class="btn btn-primary">Kayıt Ol</button>
                                    </div>
                                </form>
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

</html>