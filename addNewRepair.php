<?php
	$success = '';
	$notFound =  '';
	if (isset($_POST['submit'])) {
		
		// Define $username and $password
		$cust_id = $_POST['cust_id'];
		$staff_id = $_POST['staff_id'];
		$description = $_POST['description'];
		$device = $_POST['device'];
		$brand = $_POST['brand'];
		$model = $_POST['model'];
		$os = $_POST['os'];
		
		
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$conn= mysqli_connect("localhost", "root", "", "sht");
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		// To protect MySQL injection for Security purpose			
		$cust_id = stripslashes($cust_id);
		$staff_id = stripslashes($staff_id);
		$description = stripslashes($description);
		$device = stripslashes($device);
		$brand = stripslashes($brand);
		$model = stripslashes($model);
		$os = stripslashes($os);
		
		$cust_id = mysqli_real_escape_string($conn, $cust_id);
		$staff_id = mysqli_real_escape_string($conn, $staff_id);
		$description = mysqli_real_escape_string($conn, $description);
		$device = mysqli_real_escape_string($conn, $device);
		$brand = mysqli_real_escape_string($conn, $brand);
		$model = mysqli_real_escape_string($conn, $model);
		$os = mysqli_real_escape_string($conn, $os);
		
		
		if( is_numeric( $cust_id ) ) {
			$query = "SELECT * FROM repairs";
			$valid = mysqli_query($conn, $query);
			
			if (!$valid) {
				$notFound = "Could not connect to the database!<br><br>";
			}
			
			
			$sql = "INSERT INTO repairs (cust_id, staff_id, description, devicetype, brand, model, os)
			VALUES ('$cust_id', '$staff_id', '$description', '$device', '$brand', '$model', '$os');";
			$res = mysqli_query($conn, $sql);
			
			if (!$res) {
				$notFound = "Error adding...<br><br>";
			}
			
			if (mysqli_affected_rows($conn) == 1) {
				$success =  "Sửa chữa đã thêm thành công. Đang chuyển hướng.....<br><br>";
				$id = $cust_id;
				//header("refresh:5; url=repairs.php");
				
				} else {
				$notFound =  "Không thể thêm sửa chữa do lỗi hệ thống!<br><br>";
			}
			
			} else {
			$id = $cust_id;
			$notFound = "Khách hàng không được tìm thấy trong hệ thống. Vui lòng trở lại và nhập đúng ID khách hàng! <br><br>";
		}
		mysqli_close($conn);
	}
?>