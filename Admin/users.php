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
	<title>User List - Food.Co Restaurant</title>

	<link rel="stylesheet" href="css/main.css?v=1628755089081">
	<link rel="shortcut icon" href="../images/food-co-icon.png" type="image/x-icon">
</head>
<style>
</style>
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
				<li class="active">
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
				<li>
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
			<li>User List</li>
		</ul>
	</div>
</section>

<section class="is-hero-bar">
	<div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
		<h1 class="title">User List</h1>
	</div>
</section>

<section class="section main-section">
    <div class="card has-table">
		<header class="card-header">
			<p class="card-header-title"><span class="icon"><i class="mdi mdi-account-multiple"></i></span>Users</p>
			<a href="users.php" class="card-header-icon"><span class="icon"><i class="mdi mdi-reload"></i></span></a>
		</header>
		<div class="card-content">
		<?php
			$sql2="SELECT * from useracc ";
			$result2 = mysqli_query($conn,$sql2);
			$row2=mysqli_num_rows($result2);
			echo"
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Role</th>
						<th>Contact</th>
						<th>Address</th>
					</tr>
				</thead>
				<tbody>
					<tr>";
					while($row2=mysqli_fetch_row($result2)){
						echo"
						<td data-label='Name'>$row2[1]</td>
						<td data-label='Username'>$row2[3]</td>
						<td data-label='Email'>$row2[2]</td>
						<td data-label='Role'>$row2[5]</td>
						<td data-label='Contact'>$row2[6]</td>
						<td data-label='Address'>$row2[7]</td>
					</tr>";
					}
					echo"
					
				</tbody>
			</table>";
			?>
		</div>
    </div>
</section>
<?php include("footer.php") ?>

</div>

<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
</body>
</html>