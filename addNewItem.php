<?php
	$success = '';
	$error =  '';
	if (isset($_POST['submit'])) {
		// Define $username and $password
		$description = $_POST['description'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		
		
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$conn= mysqli_connect("localhost", "root", "", "sht");
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		// To protect MySQL injection for Security purpose
		$description = stripslashes($description);
		$quantity = stripslashes($quantity);
		$price = stripslashes($price);
		
		$description = mysqli_real_escape_string($conn, $description);
		$quantity = mysqli_real_escape_string($conn, $quantity);
		$price = mysqli_real_escape_string($conn, $price);
		
		
		if ( is_numeric($price) ) {
			$query = "SELECT * FROM Kho WHERE description = '$description'";
			$valid = mysqli_query($conn, $query);
			
			if (!$valid) {
				$error = "Could not connect to the database!";
			}
			
			if (mysqli_num_rows($valid) == 0 ) {
				$sql = "INSERT INTO Kho (description, quantity, price)
				VALUES ('$description', '$quantity', '$price');";
				$res = mysqli_query($conn, $sql);
				
				if (!$res) {
					$error = "Error adding....";
				}
				
				if (mysqli_affected_rows($conn) == 1) {
					$success =  "Sản phẩm mới đã được thêm vào kho thành công. Chuyển hướng...";
					header("refresh:5; url=inventory.php");
					
					} else {
					$error =  ("Không thể thêm sản phẩm mới do lỗi hệ thống!");
				}
				
				} else {
				$error = "Sản phẩm đã có trong hệ thống!";
			}
			
			} else {
			$error = "Giá phải là kiểu số!";
		}
		
		mysqli_close($conn);
	}
?>