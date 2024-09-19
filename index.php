<?php
	require("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Food.Co restaurant</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="images/food-co-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
<style>
.cate{
	cursor:default !important;
}
</style>
</head>

<body>
			
	<?php include("header.php"); ?>
    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            <li class="text-center">
                <img src="images/banner-04.png" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Food.Co Restaurant</strong></h1>
                            <p class="m-b-40">We aim to bring the ultimate meal delivery experience <br>and delicious food to all users with quality serve.</p>
                            <p><a class="btn hvr-hover" href="menu.php">Order Food Now</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="images/banner-05.png" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Food.Co Restaurant</strong></h1>
                            <p class="m-b-40">We aim to bring the ultimate meal delivery experience <br>and delicious food to all users with quality serve.</p>
                            <p><a class="btn hvr-hover" href="menu.php">Order Food Now</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="images/banner-06.png" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Food.Co Restaurant</strong></h1>
                            <p class="m-b-40">We aim to bring the ultimate meal delivery experience <br>and delicious food to all users with quality serve.</p>
                            <p><a class="btn hvr-hover" href="menu.php">Order Food Now</a></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">

                    <div class="title-all text-center">
                        <h1>Food Categories</h1>
                    </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    
                    <div class="shop-cat-box">
                        <img class="img-fluid" src="images/meals.png" alt="" />
                        <a class="btn hvr-hover cate">Meals</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                        <img class="img-fluid" src="images/snacks.png" alt="" />
                        <a class="btn hvr-hover cate">Snacks</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                        <img class="img-fluid" src="images/drinks.png" alt="" />
                        <a class="btn hvr-hover cate">Drinks</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Categories -->
	
	<div class="box-add-products">
		<div class="container">
			<div class="row">
			<div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Why Choose Us</h1>
                    </div>
                </div>
				<div class="col-lg-3 col-md-3 col-sm-12">
					<div class="offer-box-products">
						<img class="img-fluid" src="images/point1.png" alt="" />
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12">
					<div class="offer-box-products">
						<img class="img-fluid" src="images/point2.png" alt="" />
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12">
					<div class="offer-box-products">
						<img class="img-fluid" src="images/point3.png" alt="" />
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12">
					<div class="offer-box-products">
						<img class="img-fluid" src="images/point4.png" alt="" />
					</div>
				</div>
				
			</div>
		</div>
	</div>

    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Latest Food</h1>
                        <p>Choose the food you like</p>
                    </div>
                </div>
            </div>
<?php
echo"
  <div class='row'>
  ";
  $sql="SELECT * from menu ORDER BY id DESC LIMIT 3";
    $result = mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_row($result)) {
    $name=$row[1];
    $price=$row[2];
    $des=$row[3];
    $photo1=$row[5];
    $qty=$row[6];
    $category=$row[8];
echo"
      <div class='col-sm-6 col-md-6 col-lg-4 col-xl-4'>
     
          <div class='products-single fix'>

              <div class='box-img-hover'>

                  <div class='type-lb'>
                      <p class='new'>$category</p>
                  </div>

                  <a href='menu.php?productid=".$row[4]."'>
                  <img src='images/$photo1' class='img-fluid' alt='Image'>
              </div>

              <div class='why-text'>
           
                  <h4>$name</h4>
                  </a>
                  <h5>RM $price</h5>
              </div>

          </div>

      </div>
      ";}echo"   
</div>";

?>
           

            </div>
        </div>
    </div>
    <!-- End Products  -->

	<!--footer-->
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