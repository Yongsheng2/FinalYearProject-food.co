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

 if(isset($_POST["submit"])) {
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
	//get file extension
	$ext = pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION);
	
	$newname=generate_string($permitted_chars, 6).".".$ext;
	
	//set file name
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	$target_dir = "../images/";
	$uploadOk = 1;
	
	$target_file = $target_dir .$newname;
	
	//Check file type is image or not
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	  if($check !== false) {
		$uploadOk = 1;
	  } else {
		echo "File is not an image.";
		$uploadOk = 0;
	  }
	  
	
	// Check if file already exists
	if (file_exists($target_file)) {
	  echo "Sorry, file already exists.";
	  $uploadOk = 0;
	}
	
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
	  echo "Sorry, your file is too large.";
	  $uploadOk = 0;
	}
	
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	  $uploadOk = 0;
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	
	  } else {
		echo "Sorry, there was an error uploading your file.";
	  }
	}
	

	$name = $_POST["name"];
	$des = $_POST["des"];
	$price = $_POST["price"];
	$qty = $_POST["qty"];
	$category = $_POST["category"];
	$productid = generate_string($permitted_chars, 5);
	
	$sql ="INSERT into menu (name, price, des, productid, photo1, category, qty, soldqty) VALUES (\"$name\", \"$price\", \"$des\", \"$productid\", \"$newname\",\"$category\", \"$qty\", \"0\")";
	
	$result=mysqli_query($conn,$sql);
	if ($result) {
		echo"<script> alert('New menu $name added successfully!');window.location='menu.php'</script>";
	}
	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add New Meal - Food.Co Restaurant</title>

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
textarea{
	resize:none;
}
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
	option=confirm("Do you want to discard adding a new menu?");

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
			<li>Add New</li>
		</ul>
	</div>
</section>

<section class="section main-section">

	<form method="POST" action="#" class="add" enctype="multipart/form-data">
		<div class="card">
			<div class="card-content">
				<div class="field">
				<center><label class="label2">Add New Meal</label></center>
				</div><hr><br>
				<div class="field">
					<label class="label">Image</label>
					<div class="control">
						<input type="file" name="fileToUpload" class="" required>
					</div>
				</div>

				<div class="field">
					<label class="label">Food Name</label>
					<div class="control">
						<input type="text" name="name" size="30" class="input is-static" required>
					</div>
				</div>
				
				<div class="field">
					<label class="label">Food Category</label>
					<div class="control">
						<select name="category" id="" class="input is-static">
							<option value="MEALS">MEALS</option>
							<option value="SNACKS">SNACKS</option>
							<option value="DRINKS">DRINKS</option>
						</select>
					</div>
				</div>
				
				<div class="field">
					<label class="label">Price</label>
					<div class="control">
						<input type="text" name="" title=""  class="price" value="RM " readonly disabled>
						<input type="text" name="price" pattern="\d+(\.\d{2})?" title="Example: 13.90 or 14"  class="price2" required>
					</div>
				</div>	

				<div class="field">
					<label class="label">Stock</label>
					<div class="control">
						<input type="number" name="qty" class="input is-static" max="100" min="0" value="1" required>
					</div>
				</div>	

				<div class="field">
					<label class="label">Description</label>
					<div class="control">
						<textarea cols="60" rows="4" name="des" class="input is-static" required></textarea>
					</div>
				</div><br><hr>
				<div class="field">
					<div class="control">
						<input type="submit" name="submit" class="button green" value="Save">
						<input type="button" name="" value="Back" onclick="back()" class="button blue">
					</div>
				<div>				
			</div>
		</div>
	</form>
</section>
<?php include("footer.php") ?>

</div>

<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
</body>
</html>