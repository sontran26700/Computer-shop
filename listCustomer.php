<?php
	$conn = mysqli_connect("localhost","root","", "sht");
	
	if(!$conn) {
		die("Could not connect to the database" .mysqli_connect_errno()) ;
	}
	
	$query= "SELECT * FROM KhachHang ORDER BY Ten";
	
	$result = mysqli_query($conn, $query);	
	
	if (!$result) {
		$error = "Không tìm thấy khách hàng trong database!";
	}
	
	while($data = mysqli_fetch_row($result)) {
		echo("<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td></tr>");
	}
?>