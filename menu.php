<?php
	require("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Menu - Food.Co restaurant</title>
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
    
<?php
if(isset($_GET["productid"]) AND isset($_GET["addCart"]) AND isset($_SESSION["user"]) !=""){
	$userid = $_SESSION["user"];
	$productid = $_GET["productid"];
	$orderQty =  $_GET["orderQty"];
	$sql="SELECT * from cart where productid = '$productid' AND username = '$userid'";
	$result = mysqli_query($conn,$sql);
	$rowCount=mysqli_num_rows($result);
	//If user already got same product in cart
	if($rowCount >= 1){
		$row=mysqli_fetch_row($result);
		$qty=$row[3] + $orderQty;
		$sql="UPDATE cart SET qty='$qty' WHERE productid = '$productid' AND username = '$userid'";
		if (mysqli_query($conn, $sql)) {
			echo "<script> alert('Item Added To Cart.'); window.location.href = 'menu.php?productid=".$productid."';</script>";
		}else{
			echo "<script> alert('Error adding into cart, please contact admin.')</script>";
		}
	}else{
		//If the user have't have same product in cart
		$sql ="INSERT into cart (id, username, productid, qty) VALUES ('', '$userid','$productid','$orderQty')";
		$result=mysqli_query($conn,$sql);
		if ($result) {
			echo "<script> alert('Item Added To Cart.'); window.location.href = 'menu.php?productid=".$productid."';</script>";
		}
	}

}elseif(isset($_GET["productid"]) AND isset($_GET["addCart"]) AND isset($_SESSION["user"]) ==""){
	echo "<script>alert('Unable to add into cart. Please login!');</script>";
}

if(isset($_GET["productid"])){
  $productid=$_GET["productid"];
  $sql="SELECT * from menu where productid= '$productid'";
  $result = mysqli_query($conn,$sql);
  $row=mysqli_fetch_row($result);
  $name=$row[1];
  $price=$row[2];
  $des=$row[3];
  $photo1=$row[5];
  $qty=$row[6];
  $category=$row[8];
echo"
<!-- Start All Title Box -->
<div class='all-title-box'>
       <div class='container'>
           <div class='row'>
               <div class='col-lg-12'>
                   <h2>Food Detail</h2>
                   <ul class='breadcrumb'>
                       <li class='breadcrumb-item'><a href='menu.php'>Menu</a></li>
                       <li class='breadcrumb-item active'>Food Detail </li>
                   </ul>
               </div>
           </div>
       </div>
   </div>
   <!-- End All Title Box -->

   <!-- Start Shop Detail  -->
   <div class='shop-detail-box-main'>
       <div class='container'>
           <div class='row'>
               <div class='col-xl-5 col-lg-5 col-md-6'>
                   <div id='carousel-example-1' class='single-product-slider carousel slide' data-ride='carousel'>
                       <div class='carousel-inner' role='listbox'>
                           <div class='carousel-item active'> <img class='d-block w-100' src='images/$photo1' alt='First slide'> </div>
                       </div>
                   </div>
               </div>
               <div class='col-xl-7 col-lg-7 col-md-6'>
                   <div class='single-product-details'>
                   <form action='#' method='GET'>
                       <h2>$name</h2>
                       <h5>RM $price</h5>";
                       if ($qty==0)
                       {
                        echo"
                        <p class='available-stock'><span><b>Item out of stock</b></span><p>";
                       }else{
                       echo"
                       <p class='available-stock'><span> More than $qty available </span><p>";}
                       echo"
                       <h4>Short Description:</h4>
                       <p>$des</p>";

                       if ($qty==0) {
					
                        echo "
                        <button class='btn hvr-hover' disabled>Out of Stock</button>
                        
                        ";
                      }elseif ($qty>=1 And isset($_SESSION["user"]) == "") {?>
                            <a href='login.php' class='btn hvr-hover'>Login Now</a>
                      <?php
                      }elseif ($qty>=1 And isset($_SESSION["user"])) {

                        
                          echo"
                          <ul>
                          <li>
                              <div class='form-group quantity-box'>
                                  <label class='control-label'>Quantity</label>
                                  <input class='form-control' value='1' min='1' max='".$qty."' name='orderQty' type='number'>
                              </div>
                          </li>
                      </ul>
                       <div class='price-box-bar'>
                           <div class='cart-and-bay-btn'>
                           <input type='hidden' name='productid' value='$productid' />
                               <button type='submit' class='btn hvr-hover' name='addCart'>Add to cart</button>
                           </div>
                       </div>
                       </form>";}
                       echo"
                   </div>
               </div>
           </div>";
           
          echo"
                                        <br><br><br>
                                        <div class='title-all text-center'>
                                        <h1><u>Featured Products</u></h1>
                                    </div>
                                  <div class='row'>
                                  ";
                                  $sql="SELECT * from menu where productid <> '$productid' ORDER BY RAND() LIMIT 3";
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
  </div>
  
  ";                            

}else{
echo"
  <!-- Start All Title Box -->
  <div class='all-title-box'>
      <div class='container'>
          <div class='row'>
              <div class='col-lg-12'>
                  <h2>Shop</h2>
                  <ul class='breadcrumb'>
                      <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
                      <li class='breadcrumb-item active'>Shop</li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
  <!-- End All Title Box -->

  <!-- Start Shop Page  -->

  <div class='shop-box-inner'>
      <div class='container'>
          <div class='row'>
             
                  <div class='right-product-box'>

                      <div class='product-categorie-box'>
                      
                          <div class='tab-content'>
                         
                              <div role='tabpanel' class='tab-pane fade show active' id='grid-view'>
                             
                                  <div class='row'>
                                  ";
                                  $sql="SELECT * from menu";
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
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>
                ";}echo"
          </div>
      </div>
  </div>
  
  ";
  
	
	?>
<?php
    include("footer.php");
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
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>