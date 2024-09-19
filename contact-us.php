<?php
require("database.php");
if (isset($_POST["submit"])) {
  $name=$_POST["name"];
  $email=$_POST["email"];
  $phone=$_POST["phone"];
  $message=$_POST["message"];
  date_default_timezone_set("Asia/Kuala_Lumpur");
  $timestamp = date("d-M-Y h:i:sa");
    $sql ="INSERT into contact (id, name, email, phone, message,timestamp) VALUES ('', '$name', '$email', '$phone', '$message','$timestamp')";
    $result=mysqli_query($conn,$sql);
     
    if ($result) {
     echo "<script> alert('Thank you for leaving us a message!');</script>";

    }  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contact Us - Food.Co restaurant</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
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
                    <h2>Contact Us</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"> Contact Us </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Contact Us  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <h2>GET IN TOUCH</h2>
                        <form  action="#" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" for="name" name="name" placeholder="Your Name" required data-error="Please enter your name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" placeholder="Your Email" for="email" class="form-control" name="email" required data-error="Please enter your email" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" for="phone" name="phone" placeholder="Contact Number" required data-error="Please enter your contact number" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" for="message" placeholder="Your Message" name="message" rows="4" data-error="Write your message" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="submit-button text-center">
                                        <input class="btn hvr-hover"name="submit" type="submit" value="Send Message">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
				<div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left">
                        <h2>CONTACT INFO</h2>
                        <p>If have any issue/inquiry, please don't hesitate to contact us!</p>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i><b>Address: <a href="https://goo.gl/maps/KU8mAoPUDb1e4Naz8">Jalan Ayer Keroh Lama,<br>75450 Bukit Beruang, Melaka</a></b></p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i><b>Phone: <a href="tel:+60123456789">+1-888 705 770</a></b></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i><b>Email: <a href="mailto:food.co@gmail.com">food.co@gmail.com</a></b></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

    <?php include("footer.php"); ?>

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