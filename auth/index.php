<?php
ob_start();
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/util/DatabaseConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/templates/Login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/Login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/Login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/templates/Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/Login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/templates/Login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/templates/Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="/templates/Login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
<?php
    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['pass']);
        $queryLogin = "SELECT *  
                    FROM user 
                    WHERE username = '{$username}' AND password = '{$password}'";
        $resultLogin = $mysqli->query($queryLogin);
        $arLogin = mysqli_fetch_assoc($resultLogin);
        if($arLogin)
        {
            if ($arLogin['active'] == 0)
            {
                echo "<script>alert('Bạn không có quyền truy cập vào trang admin!'); </script>";
            }
            else
            {
                $_SESSION['userInfo'] = $arLogin;
                header("location:/admin");
            }
        }
        else
        {
            echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu!'); </script>";
        }

}
?>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('/templates/Login/images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" method="post">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="User name">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn" type="submit" name="login">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="/templates/Login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/Login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/Login/vendor/bootstrap/js/popper.js"></script>
	<script src="/templates/Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/Login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/templates/Login/vendor/daterangepicker/moment.min.js"></script>
	<script src="/templates/Login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/templates/Login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/templates/Login/js/main.js"></script>

</body>
</html>