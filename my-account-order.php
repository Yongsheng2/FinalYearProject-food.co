<?php
require ("database.php");   
if(isset($_SESSION["user"])){
    $userid = $_SESSION["user"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My Account - Food.Co restaurant</title>
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

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Order History</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Order History</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
<?php
if(isset($_SESSION["user"])){
$totalAmount = 0;
$sql="SELECT * from orders WHERE username = '$userid'";
$result = mysqli_query($conn,$sql);
$checkOrderValidlity =mysqli_num_rows($result);
echo"
<div class='my-account-box-main'>
<div class='container'>
    <div class='my-account-page'>
        <div class='row'>
            <div class='col-lg-12 col-md-12'>";
            if ($checkOrderValidlity>=1) {
            echo"
                <div class='order-history'>
                    <div class='my-acc-close'>
                    <a href='my-account.php'><i class='fas fa-times'></i></a>
                    </div>
                    <p>";
                    while($row=mysqli_fetch_row($result)){
                 $sql3="SELECT name,price from menu WHERE productid = '$row[3]'";
				$result3 = mysqli_query($conn,$sql3);
				$row3=mysqli_fetch_row($result3);
				$totalAmount = $totalAmount + $row[6];

                    echo"<h2><b>Order History</b></h2>
						<br><b>Order ID: ".$row[1]."</b><br>
                         <b>Quantity:</b> ".$row[4]."<br>
                         <b>Name:</b> ".$row3[0]."<br>
                         <b>Price:</b> RM ".$row3[1]."<br>";
                    echo" </p><hr>";}
                    echo"
                </div>";
            }else{
                echo"
                <script> alert('There are no order history, continue shopping?'); window.location='menu.php'</script>
                ";
            }
            echo"
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
</div>";}

?>
    <!-- Start My Account  -->
    
    <!-- End My Account -->

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