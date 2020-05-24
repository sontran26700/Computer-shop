<?php
	require_once('session.php');
	require_once('newOrder.php');
	require_once('ordered.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PC Solutions - Order Now</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<meta charset="utf-8">
		<meta name="description" content="Lakeside Books">
		<meta name="keywords" content="books, lakeside, cork, shop, online">
		
		<link rel="shortcut icon" href="favicon.ico"> 
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/global.css">
		
		<link rel="stylesheet" href="css/menu.css" />
		<script src="js/modernizr.custom.js"></script>
		
		<style>@import url(http://fonts.googleapis.com/css?family=Raleway:400,700); 
			
			table {
            width: 100%;
			}
			
            table th {
			padding: 10px;
			background-color: #48577D;
			color: #fff;
			text-align: left;
            }
			
            table td {
			padding: 5px;
            }
			table tr {
			background-color: #d3dcf2;
            }
			
		</style>
		
	</head>
	
	<body id="top" style="font-size: 62.5%;">
		<!-- BEGIN Header -->
		<header id="header-wrapper">
			
			<div id="top-bar" class="clearfix">
				
				<div id="top-bar-inner">
					
					<!-- Search Bar by http://www.paulund.co.uk/create-a-slide-out-search-box -->
					<div class="search_form">
						<form action="customer-search.php" method="post">
							<input type="text" name="search_box" id="search_box" placeholder="Tìm kiếm khách hàng...">
						</form>
					</div>
					<!-- Search Bar by http://www.paulund.co.uk/create-a-slide-out-search-box -->
					
					
					<div class="topbar-right clearfix">
						
						<ul class="clearfix">
							<li class="login-user">
								<a title="<?php echo $login_session; ?>" href="#">
									<span class="icon"><i aria-hidden="true" class="icon-user"></i></span>
									<?php echo $login_session; ?>
								</a>
							</li>
						</ul>
						
						<div class="log-out">
							<!-- <p><a title="Sign out" href="#">Sign out</a></p> -->
							<p>
								<a href="logout.php" title="Sign out">
									<span>Đăng Xuất</span>
									<span class="icon"> 
										<i aria-hidden="true" class="icon-exit"></i>
									</span>
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			
			<div class="full-shadow"></div>
			
			
		</header>
		<!-- END Header -->
		
		
		<div class="main clearfix">
			
			<!-- START OF NAVIGATION -->
			<nav id="menu" class="nav">					
				<ul>
					<li>
						<a href="dashboard.php">
							<span class="icon">
								<i aria-hidden="true" class="icon-home"></i>
							</span>
							<span>Trang Chủ</span>
						</a>
					</li>
					<li>
						<a href="customer.php">
							<span class="icon"> 
								<i aria-hidden="true" class="icon-users"></i>
							</span>
							<span>Khách Hàng</span>
						</a>
					</li>
					<li>
						<a href="repairs.php">
							<span class="icon">
								<i aria-hidden="true" class="icon-hammer"></i>
							</span>
							<span>Sửa Chữa</span>
						</a>
					</li>
					<li class="active">
						<a href="estimates.php">
							<span class="icon">
								<i aria-hidden="true" class="icon-sigma"></i>
							</span>
							<span>Định Giá</span>
						</a>
					</li>
					<li>
						<a href="inventory.php">
							<span class="icon">
								<i aria-hidden="true" class="icon-barcode"></i>
							</span>
							<span>Quản Lí Kho</span>
						</a>
					</li>
					<li>
						<a href="account.php">
							<span class="icon">
								<i aria-hidden="true" class="icon-user"></i>
							</span>
							<span>Tài Khoản</span>
						</a>
					</li>
				</ul>
			</nav>
			<!-- END OF NAVIGATION -->
			
			
			<!--Breadcrumb -->
			<div class="bread dash">
				<div class="submenu">
					<ul>
						<li><a href="##" onClick="history.go(-2); return false;">Trở Lại</a></li>
						
					</ul>
				</div>
				<h3><a style="text-decoration: none;" href="estimates.php">Định Giá</a></h3> <span style="font-size: 1.2em; font-weight: 500">\ Đặt Ngay</span>
			</div>
			<!--Breadcrumb -->
			
			
			<div class="floats">
				<div class="full-widget">		
					<span id="msg">
						<?php 
							echo $success; 
							echo $error;
						?>
					</span>
					<form class="form-4" action="" method="post">
						
						Repair ID: <input type="text" name="rep_id" placeholder="ID sửa chữa không hợp lệ, Đang chuyển hướng...." value="<?php echo $repair; ?>" readonly>
					    
						<table>
							<tr>
								<th>Stock#</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Items Price</th>
							</tr>
							<?php
								$conn= mysqli_connect("localhost", "root", "", "sht");
								$sql="SELECT * FROM Kho WHERE stock_id IN (";
								
								foreach($_SESSION['cart'] as $id => $value) {	
									$sql .= $id .",";
								}
								
								//$sql[37] = ' ';  
								$sql=substr($sql, 0, -1) .") ORDER BY stock_id ASC";
								//$query=mysql_query($sql);
								
								$res = mysqli_query($conn, $sql);
								if (!$res) {
									printf("Nothing in the basket: %s\n", "Go back");
									exit();
								}
								
								$totalprice=0;
								while($row = mysqli_fetch_array($res)){
									$subtotal = $_SESSION['cart'][$row['stock_id']]['quantity']*$row['price'];
									$totalprice += $subtotal;
								?>
								<tr>
									<td><?php echo $row['description'] ?></td>
									<td><input type="text" name="quantity[<?php echo $row['stock_id'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['stock_id']]['quantity'] ?>" readonly /></td>
									<td><?php echo  '&euro;' .$row['price'] ?></td>
									<td><?php echo '&euro;' .$_SESSION['cart'][$row['stock_id']]['quantity']*$row['price'] ?></td>
								</tr>
								<?php
									
								}
							?>
							<tr>
								<td colspan="4"><h4>Total Price: <?php echo '&euro;'. $totalprice ?></h3></td>
							</tr>
							
						</table>
						<input type="submit" name="order" value="Confirm Order">
						
					</form>
					
				</div>
				
			</div> 
			<!-- END OF FLOATS-->
		</div>
		<!-- END OF MAIN-->
		
		<!-- SCRIPT FOR THE MENU -->
		<script src="js/menu.js"></script>
		<!-- SCRIPT FOR THE MENU -->
		
	</body>
	
</html>