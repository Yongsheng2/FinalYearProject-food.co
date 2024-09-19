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

 if(isset($_POST["delete"])){
	if(isset($_POST["delete"])){
		$error = 0;
		$deleteid = $_POST["productid"];
		  $producturl_sql = "SELECT photo1 FROM menu WHERE productid='".$deleteid."'";
		  $producturl_result = mysqli_query($conn,$producturl_sql);
		  $producturl_row=mysqli_fetch_row($producturl_result);
		  unlink(realpath($_SERVER["DOCUMENT_ROOT"])."\\food.co\images\\$producturl_row[0]");
		  $deleteProduct = "DELETE from menu WHERE productid='".$deleteid."'";
		  if(mysqli_query($conn,$deleteProduct) == false){
			 $error = 1;
		  }
		if($error == 0){
			echo"<script> alert('Selected product are deleted!'); </script>";
		}elseif($error == 1){
			 echo"<script> alert('Error deleting products! Please contact admin.'); window.location='menu.php'</script>";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Menu - Food.Co Restaurant</title>

	<link rel="stylesheet" href="css/main.css?v=1628755089081">
	<link rel="shortcut icon" href="../images/food-co-icon.png" type="image/x-icon">
<style>
.menu-img{
	width:70px;
	height:70px;
}
button.button.blue.--jb-modal,button.button.red.--jb-modal {
    padding:7px;
}
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
				<li class="active">
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
			<li>Menu</li>
		</ul>
	</div>
</section>

<section class="is-hero-bar">
	<div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
		<h1 class="title">Menu</h1>
		<a href="menu_add.php">
			<button class="button green"><i class="mdi mdi-plus">&nbspAdd New</i></button>
		</a>
	</div>
</section>

<section class="section main-section">
    <div class="card has-table">
		<header class="card-header">
			<p class="card-header-title"><span class="icon"><i class="mdi mdi-account-multiple"></i></span>Menu</p>
			<a href="menu.php" class="card-header-icon"><span class="icon"><i class="mdi mdi-reload"></i></span></a>
		</header>
		<div class="card-content">
		<?php
			$sql="SELECT * from menu ORDER by category";
			$result = mysqli_query($conn,$sql);
			$row=mysqli_num_rows($result);
			echo"
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Image</th>
						<th>Price</th>
						<th>Description</th>
						<th>Quantity</th>
						<th>Sold Quantity</th>
						<th>Category</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>";
					while($row=mysqli_fetch_row($result)){
						echo"
						<td data-label='Name'>$row[1]</td>
						<td data-label='Image' class='menu-img'><img src='../images/$row[5]'></td>
						<td data-label='Price'>RM $row[2]</td>
						<td data-label='Description'>$row[3]</td>
						<td data-label='Quantity'>$row[6]</td>
						<td data-label='Sold Quantity'>$row[7]</td>
						<td data-label='Category'>$row[8]</td>
						<td class='actions-cell'>
							<div class='buttons right nowrap'>
								<a href='menu_edit.php?productid=".$row[4]."'><input class='button blue --jb-modal'  data-target='sample-modal-2' type='button' value='Edit'></a>
								<form method='POST'>
                                <input type='hidden' name='productid' value='".$row[4]."'>
								<input class='button red --jb-modal' data-target='sample-modal' type='submit' name='delete' value='Delete' onclick=\"return confirm('Are you sure you want to delete selected product?')\"/>
								</form>
								
								
							</div>
						</td>
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