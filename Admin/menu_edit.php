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
	<title>Edit Meal - Food.Co Restaurant</title>

	<link rel="stylesheet" href="css/main.css?v=1628755089081">
	<link rel="shortcut icon" href="../images/food-co-icon.png" type="image/x-icon">
<style>
.card-content{
	padding:20px 120px 50px 120px;
}
.label2{
	display:block;
	font-weight:700;
	margin-bottom:0.5rem;
	font-size:30px;
}
.control a{color:blue;}
.control a:hover{color:#0000ffb8;}
.price{
	display:inline-block;
	width:8%;
	--tw-bg-opacity: 1;
    background-color:#E9ECEF;
	--tw-border-opacity: 1;
    border-color: rgba(156,163,175,var(--tw-border-opacity));
    border-radius: 0.25rem;
    border-width: 1px;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0.75rem;
    padding-right: 0.75rem;
}
.price2{
	display:inline-block;
	width:91%;
	--tw-bg-opacity: 1;
    background-color: rgba(255,255,255,var(--tw-bg-opacity));
	--tw-border-opacity: 1;
    border-color: rgba(156,163,175,var(--tw-border-opacity));
    border-radius: 0.25rem;
    border-width: 1px;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0.75rem;
    padding-right: 0.75rem;
}
.price2:focus{
	outline:none;
	border:4px solid rgba(59, 130, 246, 0.5);
}
</style>
<script>
function back()
{
	option=confirm("Do you want to discard the changes?");

	if (option==true) 
		window.location.href = "menu.php";
}
</script>
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
			<li><a href="menu.php">Menu</a></li>
			<li>Edit Meal</li>
		</ul>
	</div>
</section>

<section class="section main-section">
<?php

//Update product
if(isset($_POST["submit"])){
	$productid = $_POST["productid"];
	$name = $_POST["name"];
	$des = $_POST["des"];
	$price = $_POST["price"];
	$qty = $_POST["qty"];
	$photo1 = $_POST["photo1"];
	$category = $_POST["category"];
	//Generate random string for photo file name
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	function generate_string($input, $strength = 16) {
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}
	
	$target_dir = "../images/";
	$uploadOk = $uploadStatus = 1;
	
	//checking if photo 1 was uploaded?
	if(!file_exists($_FILES['fileToUpload']['tmp_name']) || !is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
		$uploadStatus = 0;			
	}else{
		$ext = pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION);
		$newname=generate_string($permitted_chars, 6).".".$ext;
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		
		$target_file = $target_dir .$newname;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if($check !== false) {
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
		
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 5000000) {
		  echo "Sorry, your file is too large.";
		  $uploadOk = 0;
		}
		
		//Check file type
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}
	}
	
	//Check upload status and upload the image into file
	$checkUploadStatus = 1;
	if($uploadOk == "1"){
		if($uploadStatus == "1"){
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				unlink(realpath($_SERVER["DOCUMENT_ROOT"])."\\food.co\images\\$photo1");
				$photo1 = $newname; 
			} else {
				$checkUploadStatus = 0;
				echo "<script>alert('There was an error uploading your file. Please contact admin.');</script>";
			}
		}
		
		
		
	}else{
		$checkUploadStatus = 0;
		echo "<script>alert('There was an error of your file. Unable to edit product.');</script>";
	}
	
	if($checkUploadStatus == "1"){
		$sql2="UPDATE menu SET name=\"$name\", des=\"$des\", price=\"$price\", qty=\"$qty\", category=\"$category\", photo1=\"$photo1\" WHERE productid=\"$productid\"";
		if (mysqli_query($conn,$sql2)) {
			echo"<script> alert('Product $name has been modified successfully!'); window.location.href = 'menu.php';</script>";
		}
	}

}elseif(isset($_GET["productid"])){
	$productid = $_GET["productid"];
	$sql = "SELECT * from menu WHERE productid='$productid'";
	$result = mysqli_query($conn,$sql);
	$checkResult =mysqli_num_rows($result);
	$row=mysqli_fetch_row($result);

	echo"
	<form method='POST' action='#' class='edit' enctype='multipart/form-data'>
	<input type='hidden' name='productid' value='$row[4]' />
		<div class='card'>
			<div class='card-content'>
				<div class='field'>
				<center><label class='label2'>Edit Meal</label></center>
				</div><hr><br>

				<div class='field'>
					<label class='label'>ID</label>
					<div class='control'>
						<input type='text' name='id' class='input is-static' value='$row[0]' readonly>
					</div>
				</div>
				
				<div class='field'>
					<label class='label'>Image</label>
					<div class='control'>
						<img src='../images/$row[5]' style='width:110px; height:105px; display:inline-block;' >
						<br><br><input id='fileToUpload' required name='fileToUpload'type='file' class='btn btn-primary btn-block mx-auto'/>
					</div>
				</div>

				<div class='field'>
					<label class='label'>Food Name</label>
					<div class='control'>
						<input type='text' name='name' size='30' class='input is-static' value='$row[1]' required>
					</div>
				</div>
				
				<div class='field'>
					<label class='label'>Food Category</label>
					<div class='control'>
						<select name='category' id='category' class='input is-static'>
							<option value=''>Select category</option>
							<option value='MEALS'  ";if($row[8] == 'MEALS'){ echo 'selected'; } echo ">MEALS</option>
							<option value='SNACKS'  ";if($row[8] == 'SNACKS'){ echo 'selected'; } echo ">SNACKS</option>
							<option value='DRINKS'  ";if($row[8] == 'DRINKS'){ echo 'selected'; } echo ">DRINKS</option>
						</select>
					</div>
				</div>
				
				<div class='field'>
					<label class='label'>Price</label>
					<div class='control'>
						<input type='text' class='price' value='RM' readonly disabled>
						<input type='text' name='price' pattern='\d+(\.\d{2})?' title='Example: 13.90 or 14'  class='price2' value='$row[2]'required >
					</div>
				</div>	

				<div class='field'>
					<label class='label'>Stock</label>
					<div class='control'>
						<input type='number' name='qty' class='input is-static' max='100' min='0' value='$row[6]' required>
					</div>
				</div>	

				<div class='field'>
					<label class='label'>Description</label>
					<div class='control'>
						<textarea cols='60' rows='4' name='des' class='input is-static' required>$row[3]</textarea>
					</div>
				</div><hr>
				<div class='field'>
					<div class='control'>
						<input type='submit' name='submit' class='button green' value='Save'>
						<input type='button' name='' value='Back' onclick='back()' class='button blue'>
					</div>
				<div>				
			</div>
		</div>
	</form>
	";}else{
		echo "<font color='white'>No data found!</font>";
	
}
	?>
</section>
<?php include("footer.php") ?>

</div>

<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
</body>
</html>