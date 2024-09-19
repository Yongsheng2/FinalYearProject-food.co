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
	<title>Admin dashboard - Food.Co Restaurant</title>

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
				<li class="active">
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
			<li>Dashboard</li>
		</ul>
	</div>
</section>

<section class="is-hero-bar">
	<div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
		<h1 class="title">Dashboard</h1>
	</div>
</section>

<section class="section main-section">
	<?php
	$sql="SELECT * from useracc";
	$result = mysqli_query($conn,$sql);
	$row=mysqli_num_rows($result);
	echo"
    <div class='grid gap-6 grid-cols-1 md:grid-cols-3 mb-6'>
		<div class='card'>
			<div class='card-content'>
				<div class='flex items-center justify-between'>
					<div class='widget-label'>
						<h3>Total Users</h3>
						<h1>$row</h1>
					</div>
					<span class='icon widget-icon text-green-500'><i class='mdi mdi-account-multiple mdi-48px'></i></span>
				</div>
			</div>
		</div>";
		$sql2="SELECT SUM(totalprice) from orders";
		$result2 = mysqli_query($conn,$sql2);
		$row2=mysqli_fetch_row($result2);
		
		echo"
		<div class='card'>
			<div class='card-content'>
				<div class='flex items-center justify-between'>
					<div class='widget-label'>
						<h3>Sales</h3>
						<h1>RM "; echo number_format($row2[0],2);echo"</h1>
					</div>
					<span class='icon widget-icon text-blue-500'><i class='mdi mdi-cart-outline mdi-48px'></i></span>
				</div>
			</div>
		</div>";
		$sql3="SELECT DISTINCT orderid from orders";
		$result3 = mysqli_query($conn,$sql3);
		$row3=mysqli_num_rows($result3);
		echo"
		<div class='card'>
			<div class='card-content'>
				<div class='flex items-center justify-between'>
					<div class='widget-label'>
						<h3>Total Orders</h3>
						<h1>$row3</h1>
					</div>
					<span class='icon widget-icon text-red-500'><i class='mdi mdi-square-edit-outline mdi-48px'></i></span>
				</div>
			</div>
		</div>
    </div>
	";
	?>

    <div class="card has-table">
		<header class="card-header"><!--the latest 4/5 new user will show here-->
			<p class="card-header-title"><span class="icon"><i class="mdi mdi-account-multiple"></i></span>New Users</p>
			<a href="index.php" class="card-header-icon"><span class="icon"><i class="mdi mdi-reload"></i></span></a>
		</header>
		<div class="card-content">
			<?php
			$sql4="SELECT * from useracc ORDER BY id DESC LIMIT 5";
			$result4 = mysqli_query($conn,$sql4);
			$row4=mysqli_num_rows($result4);
			echo"
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Contact</th>
					</tr>
				</thead>
				<tbody>";
				
				while($row4=mysqli_fetch_row($result4)){
					echo"
					<tr>
						<td data-label='Name'>$row4[1]</td>
						<td data-label='Email'>$row4[2]</td>
						<td data-label='Contact'>$row4[6]</small></td>
					</tr>
					";
				}
			
				echo"
				</tbody>
			</table>
			";
			?>
		</div>
    </div>
	<br>
    <div class="card has-table">
		<header class="card-header"><!--the latest 4/5 new order will show here-->
			<p class="card-header-title"><span class="icon"><i class="mdi mdi-account-multiple"></i></span>New Orders</p>
			<a href="index.php" class="card-header-icon"><span class="icon"><i class="mdi mdi-reload"></i></span></a>
		</header>
		<?php
		$sql5="SELECT * from orders ORDER BY id DESC LIMIT 5";
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
						<th>Product name</th>
						<th>Quantity</th>
						<th>Order date</th>
						<th>Total Price</th>
					</tr>
				</thead>
				<tbody>";
				while($row5=mysqli_fetch_row($result5)){

					$sql6="SELECT name from menu where productid='$row5[3]'";
					$result6 = mysqli_query($conn,$sql6);
					$row6=mysqli_fetch_row($result6);
			
				echo"
					<tr>";
					echo"
						<td data-label='Order id'>$row5[1]</td>
						<td data-label='Username'>$row5[2]</td>
						<td data-label='Product name'>$row6[0]</td>
						<td data-label='Quantity'>$row5[4]</td>
						<td data-label='Order date'>$row5[5]</td>
						<td data-label='Total price'>RM $row5[6]</td>
					";
					echo"
					</tr>";}
				}else{
					echo"
					<h1>There are no order available.</h1>
					";}
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
