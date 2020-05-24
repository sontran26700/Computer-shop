<?php
	require_once('session.php');
	require_once('delete/inventoryDelete.php');
?>

<!DOCTYPE html>
<html ng-app="myApp" ng-app lang="en">
	<head>
		<title>PC Solutions - Estimates</title>
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
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<style type="text/css">
			ul>li, a{cursor: pointer;}
		</style>
		
		<style>@import url(http://fonts.googleapis.com/css?family=Raleway:400,700); </style>
		
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		
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
							<span>Sửa chữa</span>
						</a>
					</li>
					<li class="active">
						<a href="#">
							<span class="icon">
								<i aria-hidden="true" class="icon-sigma"></i>
							</span>
							<span>Định giá</span>
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
						<a href="#">
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
			<div class="bread">
				<div class="submenu">
					<ul>
						<li id="products" value="Choose Products" onclick="hideList()">Cập nhập Định Giá</li>
						<li id="add"><a href="chooseProducts.php">Chọn sản phẩm</a></li>
					</ul>
				</div>
				<h3>Định Giá</h3>
			</div>
			<!--Breadcrumb -->
			
			
			<div class="floats">
	
				<div class=" full-widget">
					
					<div ng-controller="inventoryCrtl">
						
						<div class="row">
							<div class="col-md-2">Hiện một trang:
								<select ng-model="entryLimit" class="form-control">
									<option>5</option>
									<option>10</option>
									<option>20</option>
									<option>50</option>
									<option>100</option>
								</select>
							</div>
							<div class="col-md-3">Lọc:
								<input type="text" ng-model="search" ng-change="filter()" placeholder="Filter" class="form-control" />
							</div>
							<div class="col-md-4">
								<p>Lọc {{ filtered.length }} của {{ totalItems}} tất cả khách hàng</p>
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-md-12" ng-show="filteredItems > 0">
								<table class="table table-striped table-bordered">
									<thead>
										<th>ID&nbsp;<a ng-click="sort_by('stock_id');"><i class="glyphicon glyphicon-sort"></i></a></th>
										<th>Mô tả&nbsp;<a ng-click="sort_by('description');"><i class="glyphicon glyphicon-sort"></i></a></th>
										<th>Số Lượng&nbsp;<a ng-click="sort_by('quantity');"><i class="glyphicon glyphicon-sort"></i></a></th>
										<th>Giá&nbsp;<a ng-click="sort_by('price');"><i class="glyphicon glyphicon-sort"></i></a></th>
									</thead>
									<tbody>
										<tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
											<td>{{data.stock_id}}</td>
											<td>{{data.description}}</td>
											<td>{{data.quantity}}</td>
											<td>&euro;{{data.price}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-12" ng-show="filteredItems == 0">
								<div class="col-md-12">
									<h4>Không tìm thấy định giá</h4>
								</div>
							</div>
							<div class="col-md-12" ng-show="filteredItems > 0">    
								<div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
								
							</div>
						</div>
					</div> 
					<!-- END OF CUSTOMERS LIST-->	
					
					
					
				</div> 
				<!-- END OF FULL WIDGET-->
				
				
			</div> 
			<!-- END OF FLOATS-->
		</div>
		<!-- END OF MAIN-->
		
		<!-- SCRIPT FOR THE MENU -->
		<script src="js/menu.js"></script>
		<!-- SCRIPT FOR THE MENU -->
		<script src="js/angular.min.customer.js"></script>
		<script src="js/ui-bootstrap-tpls-0.10.0.min.customer.js"></script>
		<script src="app/inventory.js"></script>  
		
		<script>	
			function hideList() {
				document.getElementById('list').style.display = "none";
			}
			
			$( "#products" ).click(function() {
				$( "#productDiv" ).toggle( "slow", function() {
					// Animation complete.
				});
			});
		</script>
		
	</body>
	
</html>