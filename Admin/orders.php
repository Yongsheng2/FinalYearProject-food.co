<?php
require("../database.php");
if(isset($_SESSION["user"])){
	$userid=$_SESSION["user"];
	$sql="SELECT * from useracc where username = '$userid'";
		$result = mysqli_query($conn,$sql);
		$row=mysqli_fetch_row($result);
	 if ($row[5]=="User") {
			   header("location: ../index.php");
			 }
 
 }else{
	 header("location: ../login.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Order List - Food.Co Restaurant</title>

	<link rel="stylesheet" href="css/main.css?v=1628755089081">
	<link rel="shortcut icon" href="../images/food-co-icon.png" type="image/x-icon">
<style>
</style>
</head>
<body>
<div id="app">
<?php include("header.php") ?>

<aside class="aside is-placed-left is-expanded">
	<div class="aside-tools">
		<div>
		Admin Dashboard <b class="font-black"><br>Food.Co Restaurant</b>
		</div>
	</div>
	<div class="menu is-menu-main">
		<p class="menu-label">General</p>
			<ul class="menu-list">
				<li>
					<a href="index.php">
					<span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
					<span class="menu-item-label">Dashboard</span>
					</a>
				</li>
			</ul>
			<ul class="menu-list">
				<li>
					<a href="users.php">
					<span class="icon"><i class="mdi mdi-account-circle"></i></span>
					<span class="menu-item-label">Users</span>
					</a>
				</li>						
				<li>
					<a href="menu.php">
					<span class="icon"><i class="mdi mdi-food-variant"></i></span>
					<span class="menu-item-label">Menu</span>
					</a>
				</li>
				<li class="active">
					<a href="orders.php">
					<span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
					<span class="menu-item-label">Orders</span>
					</a>
				</li>
				<li>
					<a href="profile.php">
					<span class="icon"><i class="mdi mdi-settings"></i></span>
					<span class="menu-item-label">Setting</span>
					</a>
				</li>
			</ul>
	</div>
</aside>

<section class="is-title-bar">
	<div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
		<ul>
			<li>Admin</li>
			<li>Order List</li>
		</ul>
	</div>
</section>

<section class="is-hero-bar">
	<div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
		<h1 class="title">Orders</h1>
	</div>
</section>

<section class="section main-section">
        <div class="card has-table">
		<header class="card-header"><!--the latest 4/5 new order will show here-->
			<p class="card-header-title"><span class="icon"><i class="mdi mdi-account-multiple"></i></span>Orders</p>
			<a href="orders.php" class="card-header-icon"><span class="icon"><i class="mdi mdi-reload"></i></span></a>
		</header>
		<?php
		$sql5="SELECT * from orders";
		$result5 = mysqli_query($conn,$sql5);
		$checkOrderValidlity =mysqli_num_rows($result5);
		if ($checkOrderValidlity>=1) {
		echo"
		<div class='card-content'>
			<table>
				<thead>
					<tr>
						<th>Orderid</th>
						<th>Username</th>
						<th>Delivery address</th>
						<th>Product name</th>
						<th>Quantity</th>
						<th>Order date</th>
						<th>Total price</th>
					</tr>
				</thead>
				<tbody>
				";
				while($row5=mysqli_fetch_row($result5)){

					$sql6="SELECT name from menu where productid='$row5[3]'";
					$result6 = mysqli_query($conn,$sql6);
					$row6=mysqli_fetch_row($result6);

					$sql7="SELECT address from useracc where username='$row5[2]'";
					$result7 = mysqli_query($conn,$sql7);
					$row7=mysqli_fetch_row($result7);
				echo"
					<tr>
						<td data-label='Orderid'>$row5[1]</td>
						<td data-label='Username'>$row5[2]</td>
						<td data-label='Address'>$row7[0]</td>
						<td data-label='Product name'>$row6[0]</td>
						<td data-label='Quantity'>$row5[4]</td>
						<td data-label='Order date'>$row5[5]</td>
						<td data-label='Total price'>RM $row5[6]</td>
					</tr>";}
					}else{
					echo"
					<h1>There are no order available.</h1>
					";
					}
					echo"				
				</tbody>
			</table>
		</div>
		";
		?>
    </div>
</section>
<?php include("footer.php") ?>

</div>

<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
</body>
</html>