<?php
require("../database.php");
if(isset($_SESSION["user"])){
	if (isset($_POST["submit"])) {
		$username=$_SESSION["user"];
		  $fullname=$_POST["fullname"];
		  $email=$_POST["email"];
		 
			$sql ="UPDATE useracc SET fullname='$fullname', email='$email' WHERE username='$username'";
			$result=mysqli_query($conn,$sql);
			 
			if ($result) {
			 echo "<script> alert('Your profile updated successfully.');</script>";
		
			}  
		}

		if (isset($_POST["reset"])) {
			$password=$_POST["password"];
			$password2=$_POST["password2"];
			
			//check if both passwords are matched
			if($password == $password2){
				$newpassword = md5($password);
				$username=$_SESSION["user"];
				//check if username and email already in used?
				$sql2="UPDATE useracc SET password='$newpassword' where username = '$username'";
		
				$result2 = mysqli_query($conn,$sql2);
				if ($result2) {
					echo"<script> alert('Password reset successfully');window.location='profile.php';</script>";
					}
				
				}else{
					echo"<script> alert('Passwords didn\'t match.');window.location='profile.php';</script>";
				}
			}


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
	<title>Admin Profile - Food.Co Restaurant</title>

	<link rel="stylesheet" href="css/main.css?v=1628755089081">
	<link rel="shortcut icon" href="../images/food-co-icon.png" type="image/x-icon">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(function () {
			$("#toggle-pass").click(function () {
				$(this).toggleClass("mdi-eye mdi-eye-off");
				var type = $(this).hasClass("mdi-eye-off") ? "text" : "password";
				 $("#password").attr("type", type);
			});
		});
		$(function () {
			$("#toggle-pass2").click(function () {
				$(this).toggleClass("mdi-eye mdi-eye-off");
				var type = $(this).hasClass("mdi-eye-off") ? "text" : "password";
				 $("#password2").attr("type", type);
			});
		})
		;$(function () {
			$("#toggle-pass3").click(function () {
				$(this).toggleClass("mdi-eye mdi-eye-off");
				var type = $(this).hasClass("mdi-eye-off") ? "text" : "password";
				 $("#password3").attr("type", type);
			});
		});
		<!--https://www.aspsnippets.com/Articles/jQuery-Show-Hide-Password-with-EYE-Icon-in-TextBox.aspx-->
</script>
<style>
#toggle-pass,#toggle-pass2,#toggle-pass3{
    margin-left: -30px;
	margin-top:10px;
    cursor: pointer;
	color:gray;
	position:absolute;
}
</style>
</head>
<body>
<div id="app">
<?php include("header.php") ?>
<nav id="navbar-main" class="navbar is-fixed-top">
	<div class="navbar-brand">
		<a class="navbar-item mobile-aside-button">
		<span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
		</a>
	</div>
	<div class="navbar-brand is-right">
		<a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
		<span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
		</a>
	</div>
	<div class="navbar-menu" id="navbar-menu">
		<div class="navbar-end">
			<div class="navbar-item dropdown has-divider has-user-avatar">
				<a href="index.php" class="navbar-link">
				<div class="is-user-name"><span>Welcome, <?php echo" $userid";?></span></div>
				</a>
				
			</div>
		<a href="../logout.php"title="Log out" class="navbar-item desktop-icon-only">
			<span class="icon"><i class="mdi mdi-logout"></i></span>
			<span>Log out</span>
		</a>
		</div>
	</div>
</nav>

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
				<li>
					<a href="orders.php">
					<span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
					<span class="menu-item-label">Orders</span>
					</a>
				</li>
				<li class="active">
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
			<li>Profile</li>
		</ul>
	</div>
</section>

<section class="is-hero-bar">
	<div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
		<h1 class="title">Profile</h1>
	</div>
</section>

<section class="section main-section">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mb-6">
		<div class="card">
			<header class="card-header">
				<p class="card-header-title"><span class="icon"><i class="mdi mdi-account-circle"></i></span>Edit Profile</p>
			</header>
			<?php
		$username=$_SESSION["user"];
		$sql="SELECT * from useracc where username = '$username'";
		$result = mysqli_query($conn,$sql);
		$row=mysqli_fetch_row($result);
		$fullname=$row[1];
		$email=$row[2];
		echo"
		<div class='card-content'>
		<form action='#' method='POST'>
			<div class='field'>
				<label class='label'>Name</label>
				<div class='field-body'>
					<div class='field'>
						<div class='control'>
							<input type='text' autocomplete='on' name='fullname' for='fullname' value='$fullname' class='input' required>
						</div>
						<p class='help'>Required. Your name</p>
					</div>
				</div>
			</div>
			<div class='field'>
				<label class='label'>E-mail</label>
				<div class='field-body'>
					<div class='field'>
						<div class='control'>
							<input type='email' autocomplete='on' name='email' for='email' value='$email' class='input' required>
						</div>
						<p class='help'>Required. Your e-mail</p>
					</div>
				</div>
			</div>
			<hr>
			<div class='field'>
				<div class='control'>
					<input name='submit' type='submit' class='button green' value='Save'>
				</div>
			</div>
		</form>
	</div>
			";?>
		</div>
		<?php
		$username=$_SESSION["user"];
		$sql="SELECT * from useracc where username = '$username'";
		$result = mysqli_query($conn,$sql);
		$row=mysqli_fetch_row($result);
		$fullname=$row[1];
		$email=$row[2];
		echo"
		<div class='card'>
			<header class='card-header'>
				<p class='card-header-title'><span class='icon'><i class='mdi mdi-account'></i></span>Profile</p>
			</header>
			<div class='card-content'>
				<div class='field'>
					<label class='label'>Name</label>
					<div class='control'>
						<input type='text' readonly value='$fullname' class='input is-static'>
					</div>
				</div>
				<div class='field'>
					<label class='label' style='margin-top:32px;'>E-mail</label>
					<div class='control'>
						<input type='text' readonly value='$email' class='input is-static'>
					</div>
				</div>
			</div>
		</div>";
		?>
    </div>
	
    <div class="card">
		<header class="card-header">
			<p class="card-header-title"><span class="icon"><i class="mdi mdi-lock"></i></span>Change Password</p>
		</header>
		<div class="card-content">
			<form action="#" method="POST" id="reset" >
				<div class="field">
					<label class="label">New password</label>
					<div class="control">
						<input type="password" autocomplete="new-password" name="password" id="password2" class="input" required><span class="mdi mdi-eye" id="toggle-pass2"></span>
					</div>
					<p class="help">Required. New password</p>
				</div>
				<div class="field">
					<label class="label">Confirm password</label>
					<div class="control">
						<input type="password" autocomplete="new-password" name="password2" id="password3" class="input" required><span class="mdi mdi-eye" id="toggle-pass3"></span>
					</div>
					<p class="help">Required. New password one more time</p>
				</div>
				<hr>
				<div class="field">
					<div class="control">
						<input type="submit" name="reset" class="button green" value="Save">
					</div>
				</div>
			</form>
		</div>
    </div>
</section>
<?php include("footer.php") ?>

</div>

<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
</body>
</html>
