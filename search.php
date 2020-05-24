<?php
	$error = '';
	$customer = '';
	if(isset($_POST['search_box'])) {
		
		if(preg_match("/^[A-Za-z]+/", $_POST['search_box'])){ 
			
			$name = $_POST['search_box']; 
			if (strlen($name) <= 15) {
				//adding connection
				$conn= mysqli_connect("localhost", "root", "", "sht");
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}
				
				$query = "SELECT * FROM Khachhang WHERE  Ten LIKE '%" . $name . "%' OR Ho LIKE '%" . $name  ."%' OR Huyen LIKE '%" . $name . "%' OR ThanhPho LIKE '%" . $name . "%' OR Sdt LIKE '%" . $name . "%'";
				
				$result= mysqli_query($conn, $query);
				
				if (!$result) {
					$error = "Không thể kết nối với dữ liệu!";
				}
				
				if(mysqli_num_rows($result) == 0) {
					$error = "<ul> <li>Xin lỗi,  Không tìm thấy kết quả cho: (\"" .$name ."\")</li></ul>";
				}
				//-create  while loop and loop through result set
				while($row = mysqli_fetch_array($result)){
					$ID = $row['Kh_id'];
					$Ten  =$row['Ten'];
					$Ho=$row['Ho'];
					$Huyen = $row['Huyen'];
					$ThanhPho = $row['ThanhPho'];
					$Sdt = $row ['Sdt'];
					
					//-display the result of the array
					$customer = $customer . "<ul>\n <a  href=\"search.php?id=$ID\"> <li>" .$Ho . " " . $Ten .  " "   .$Huyen . " "   .$ThanhPho . " "   .$Sdt . "</a></li>\n\n\n\n\n</ul>";
				}
				mysqli_close($conn);
				
				} else {
				$error = "<ul> <li>Xin lỗi, quá nhiều kí tự!</li></ul>";
			}	//end of string lenght check	
		} 	
	}
?>		