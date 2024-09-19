<?php
require("database.php");
if(isset($_SESSION["user"])){
if (isset($_POST["submit"])) {
$username=$_SESSION["user"];
  $fullname=$_POST["fullname"];
  $email=$_POST["email"];
  $contact=$_POST["contact"];
  $address=$_POST["address"];
    $sql ="UPDATE useracc SET fullname='$fullname', email='$email' , contact='$contact', address='$address' WHERE username='$username'";
    $result=mysqli_query($conn,$sql);
     
    if ($result) {
     echo "<script> alert('Your profile updated successfully.');</script>";

    }  
}
        $username=$_SESSION["user"];
        $sql="SELECT * from useracc where username = '$username'";

		$result = mysqli_query($conn,$sql);
		$row=mysqli_fetch_row($result);
		$fullname=$row[1];
		$email=$row[2];
		$contact=$row[6];
		$address=$row[7];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Profile - Food.Co restaurant</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="images/food-co-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <?php include("header.php"); ?>

<div class="my-account-box-main">
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h2>Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"> Profile </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="order-history">
                        <h2><b>Edit your personal profile</b></h2><br>
                        <form  action="#" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" for="fullname" name="fullname" placeholder="Your Full Name" required data-error="Please enter your full name" value="<?php echo $fullname;?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" placeholder="Your Email" for="email" class="form-control" name="email" required data-error="Please enter your email" value="<?php echo $email;?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" for="contact" name="contact" placeholder="Contact Number" required data-error="Please enter your contact number" value="<?php echo $contact;?>" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" for="address" placeholder="Home Address" name="address" rows="2" data-error="Please enter your home address" value="<?php echo $address;?>"required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="submit-button text-center">
                                        <input class="btn hvr-hover"name="submit" type="submit" value="Update profile">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
					
                </div>
					<div class='col-lg-4 col-md-12'>
					<div class='account-box'>
						<div class='service-box'>
							<div class='service-icon'>
								<a href='my-account-order.php'> <i class='fa fa-gift'></i> </a>
							</div>
							<div class='service-desc'>
								<a href='my-account-order.php'><h4>Your Orders</h4></a>
								<p>Track Your Order History.</p>
							</div>
						</div>
					</div>
				</div>
				<div class='col-lg-4 col-md-12'>
					<div class='account-box'>
						<div class='service-box'>
							<div class='service-icon'>
								<a href='profile.php'> <i class='fa fa-location-arrow'></i> </a>
							</div>
							<div class='service-desc'>
								<a href='profile.php'><h4>Edit Profile</h4></a>
								<p>Edit my personal profile.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>


    <?php include("footer.php"); 
    
}else{
    header("location: ./login.php");
}
    ?>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/inewsticker.js"></script>
    <script src="js/bootsnav.js."></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>