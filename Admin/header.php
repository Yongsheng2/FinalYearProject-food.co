<?php
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
				<div class="is-user-name"><span>Welcome,<?php echo" $userid";?></span></div>
				</a>
			</div>
		<a href="../logout.php" title="Log out" class="navbar-item desktop-icon-only">
			<span class="icon"><i class="mdi mdi-logout"></i></span>
			<span>Log out</span>
		</a>
		</div>
	</div>
</nav>

