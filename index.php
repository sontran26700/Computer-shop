<?php
	require('checklogin.php'); // Includes Login Script
?>

<!DOCTYPE html>
<html>
	<head>
		<title>PC Solutions</title>
		<link rel="shortcut icon" href="../favicon.ico"> 
		
		<link rel="stylesheet" href="css/global.css">	
        <link rel="stylesheet" href="css/login.css" />
		
		<script src="js/modernizr.custom.63321.js"></script>
		
		<style>
			@import url(http://fonts.googleapis.com/css?family=Raleway:400,700);		
		</style>
	</head>
	
	<body>
		<div class="container">
			<div class="rect">
				<img src="images/logo.png" width="370" height="110">
				<form class="form-4" method="post" action="">
					<h1>Đăng Nhập / <span class="reg"><a href="register.php">Đăng Kí</a></span></h1>
					<span id="error"><?php echo $error; ?></span>
					<label for="login">Tài Khoản</label>
					<input type="text" name="username" placeholder="Tai Khoan" autofocus required>
					
					<label for="password">Mật Khẩu</label>
					<input type="password" name="password" placeholder="Mat Khau" required> 
					
					<input type="submit" name="submit" value="Đăng Nhập">
					
				</form>
				
			</div>
		</div>
	</body>
	
</html> 