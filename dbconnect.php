<?
	$mysqli = mysqli_connect("localhost","root","", "sht");
	
	if (!$mysqli) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
?>