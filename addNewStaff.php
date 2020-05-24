<?php
	$success = '';
	$error =  '';
	if (isset($_POST['submit'])) {
		// Define $Taikhoan and $Matkhau
		$Ho = $_POST['Ho'];
		$Ten = $_POST['Ten'];
		$email = $_POST['email'];
		$Huyen = $_POST['Huyen'];
		$Thanhpho = $_POST['Thanhpho'];
		$Sdt = $_POST['Sdtephone'];
		$Taikhoan=$_POST['Taikhoan'];
		$Matkhau=$_POST['Matkhau'];
		
		if ( empty($Huyen) or empty($Thanhpho) or empty($Sdt) ) 
		{
			$Huyen = "Not Set";
			$Thanhpho = "Not Set";
			$Sdt = "0830000000";
		}
		
		// Establishing Connection with Server by passing server_name, user_id and Matkhau as a parameter
		$conn= mysqli_connect("localhost", "root", "", "sht");
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		// To protect MySQL injection for Security purpose
		$Ho = stripslashes($Ho);
		$Ten = stripslashes($Ten);
		$email = stripslashes($email);
		$Huyen = stripslashes($Huyen);
		$Thanhpho = stripslashes($Thanhpho);
		$Sdt = stripslashes($Sdt);
		$Taikhoan = stripslashes($Taikhoan);
		$Matkhau = stripslashes($Matkhau);
		
		$Ho = mysqli_real_escape_string($conn, $Ho );
		$Ten = mysqli_real_escape_string($conn, $Ten);
		$email = mysqli_real_escape_string($conn, $email);
		$Huyen = mysqli_real_escape_string($conn, $Huyen);
		$Thanhpho = mysqli_real_escape_string($conn, $Thanhpho);
		$Sdt = mysqli_real_escape_string($conn, $Sdt);
		$Taikhoan = mysqli_real_escape_string($conn, $Taikhoan);
		$Matkhau = mysqli_real_escape_string($conn, $Matkhau);
		
		if (strlen($Taikhoan) <= 11) {
			if ( is_numeric($Sdt) ) {
				$query = "SELECT * FROM NhanVien WHERE Taikhoan = '$Taikhoan'";
				$valid = mysqli_query($conn, $query);
				
				if (!$valid) {
					$error = "Could not connect to the database!";
				}
				
				if (mysqli_num_rows($valid) == 0 ) {
					$sql = "INSERT INTO NhanVien (Ten, Ho, Taikhoan, Matkhau, email, Huyen, Thanhpho, Sdt)
					VALUES ('$Ten', '$Ho', '$Taikhoan', '$Matkhau', '$email', '$Huyen', '$Thanhpho', '$Sdt');";
					$res = mysqli_query($conn, $sql);
					
					if (!$res) {
						$error = "Lỗi tạo tài khoản";
					}
					
					if (mysqli_affected_rows($conn) == 1) {
						$success =  "Nhân Viên tạo thành công. Đang chuyển hướng!";
						header("refresh:5; url=index.php");
						
						} else {
						$error =  ("Không thể đăng kí do hệ thống lỗi!");
					}
					
					} else {
					$error = "Tài Khoản đã tồn tại trong hệ thống.";
				}
				
				} else {
				$error = "SDT phải là kiểu số!";
			}
			
			} else {
			$error = "Tài khoản phải ít hơn 11 kí tự!";
		}
		
		mysqli_close($conn);
	}
?>