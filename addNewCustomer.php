<?php
	$success = '';
	$error =  '';
	if (isset($_POST['submit'])) {
		// Define $username and $password
		$Ho = $_POST['Ho'];
		$Ten = $_POST['Ten'];
		$Huyen = $_POST['Huyen'];
		$ThanhPho = $_POST['ThanhPho'];
		$Sdt = $_POST['Sdt'];
		
		
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$conn= mysqli_connect("localhost", "root", "", "sht");
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		// To protect MySQL injection for Security purpose
		$Ho = stripslashes($Ho);
		$Ten = stripslashes($Ten);
		$Huyen = stripslashes($Huyen);
		$ThanhPho = stripslashes($ThanhPho);
		$Sdt = stripslashes($Sdt);
		
		$Ho = mysqli_real_escape_string($conn, $Ho);
		$Ten = mysqli_real_escape_string($conn, $Ten);
		$Huyen = mysqli_real_escape_string($conn, $Huyen);
		$ThanhPho = mysqli_real_escape_string($conn, $ThanhPho);
		$Sdt = mysqli_real_escape_string($conn, $Sdt);
		
		
		if ( is_numeric($Sdt) ) {
			$query = "SELECT * FROM Khachhang WHERE Sdt = '$Sdt'";
			$valid = mysqli_query($conn, $query);
			
			if (!$valid) {
				$error = "Could not connect to the database!";
			}
			
			if (mysqli_num_rows($valid) == 0 ) {
				$sql = "INSERT INTO khachhang (Ho, Ten, Huyen, ThanhPho, Sdt)
				VALUES ('$Ho', '$Ten', '$Huyen', '$ThanhPho', '$Sdt');";
				$res = mysqli_query($conn, $sql);
				
				if (!$res) {
					$error = "Error registering....";
				}
				
				if (mysqli_affected_rows($conn) == 1) {
					$success =  "Customer created successfully. Redirecting.....";
					header("refresh:5; url=customer.php");
					
					} else {
					$error =  ("Could not register due to system error!");
				}
				
				} else {
				$error = "The customer already exist in the system.";
			}
			
			} else {
			$error = "Sdtephone number should numeric!";
		}
		
		mysqli_close($conn);
	}
?>