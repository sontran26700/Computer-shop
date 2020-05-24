<?php
	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
	
	if (isset($_POST['submit'])) {
		
		// Define $Taikhoan and $Matkhau
		$Taikhoan=$_POST['Taikhoan'];
		$Matkhau=$_POST['Matkhau'];
		// Establishing Connection with Server by passing server_name, user_id and Matkhau as a parameter
		
		$conn = mysqli_connect("localhost", "root", "", "sht");
		// To protect MySQL injection for Security purpose
		$Taikhoan = stripslashes($Taikhoan);
		$Matkhau = stripslashes($Matkhau);
		$Taikhoan = mysqli_real_escape_string($conn, $Taikhoan);
		$Matkhau = mysqli_real_escape_string($conn, $Matkhau);
		
		// Selecting Database
		$query = "SELECT * FROM NhanVien WHERE Taikhoan = '$Taikhoan' AND Matkhau = '$Matkhau'";
		$valid = mysqli_query($conn, $query);
		
		if (!$valid) {
			$error = "Không thể kết nối đến dữ liệu!";
		}
		
		if (mysqli_num_rows($valid) == 1 ) {	
			$_SESSION['login_user'] = $Taikhoan; // Initializing Session
			header("location: dashboard.php"); // Redirecting To Other Page
			} else {
			$error = "Tài Khoản hoặc mật khẩu sai, vui lòng nhập lại!";
		}
		mysqli_close($conn); // Closing Connection
	}
?>