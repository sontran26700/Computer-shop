<?php
	$connection = mysqli_connect("localhost", "root", "", "sht");
	session_start();// Starting Session
	
	// Storing Session
	$user_check = $_SESSION['login_user'];
	// SQL Query To Fetch Complete Information Of User
	$query = "SELECT * FROM NhanVien WHERE Taikhoan='$user_check'";
	$ses_sql = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($ses_sql);
	$login_session = $row['Taikhoan'];
	$login_id = $row['Nv_id'];
	
	if(!isset($login_session)){
		mysqli_close($connection); // Closing Connection
		header('Location: index.php'); // Redirecting To Home Page
	}
?>