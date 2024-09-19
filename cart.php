<?php require("database.php");
   if(isset($_SESSION["user"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cart - Food.Co restaurant</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
	<?php include("header.php"); 
        if(isset($_GET["username"]) && isset($_GET["productid"]) && isset($_GET["removeFromCart"])){
            if($_GET["username"] != $_SESSION["user"]){
                echo "<script>alert('Unauthorized action!');</script>";
            }else{
                $username = $_GET["username"];
                $productid = $_GET["productid"];
                $sql3="DELETE FROM cart WHERE username = '$username' AND productid = '$productid'";
                $result3=mysqli_query($conn,$sql3);
                if ($result3) {
                    echo"<script> alert('Item removed from cart.'); window.location='cart.php'</script>";
                }
            }
        }
        $username = $_SESSION["user"];
        $sql="SELECT * from cart where username = '$username'";
        $result = mysqli_query($conn,$sql);
        $rowCount=mysqli_num_rows($result);
        $totalAmount = 0;
        if($rowCount != "0"){
    echo"

    <!-- Start All Title Box -->
    <div class='all-title-box'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-12'>
                    <h2>Cart</h2>
                    <ul class='breadcrumb'>
                        <li class='breadcrumb-item'><a href='menu.php'>Menu</a></li>
                        <li class='breadcrumb-item active'>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class='cart-box-main'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='table-main table-responsive'>
                  <table class='table'>
                  <thead>
                      <tr>
                          <th>Images</th>
                          <th>Product Name</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Total</th>
                          <th>Remove</th>
                      </tr>
                  </thead>
                  ";

                  while ($row=mysqli_fetch_row($result)) {
                        $sql2="SELECT * from menu where productid = '$row[2]'";
                        $result2 = mysqli_query($conn,$sql2);
                        $row2=mysqli_fetch_row($result2);
                        echo"
                  <tbody>
                      <tr>
                          <td class='thumbnail-img'>
                              <a href='menu.php?productid=".$row2[4]."'>
                          <img class='img-fluid' src='images/".$row2[5]."' alt='' />
                      </a>
                          </td>
                          <td class='name-pr'>
                              <a href='menu.php?productid=".$row2[4]."'>
                              ".$row2[1]."
                      </a>";
                      if($row2[6] == "0"){
                          echo"<br>Stock:<font color='#722F37'><b> Out of stock</b></font>";
                      }else{
                      echo"
                      <br>Stock: ".$row2[6]."
                      ";}
                      echo"
                          </td>
                          <td class='price-pr'>
                              <p>RM ".$row2[2]."</p>
                          </td>
                          <td class='quantity-box'><input type='number' size='4' value='".$row[3]."'class='c-input-text qty text' readonly></td>
                          <td class='total-pr'>
                              <p>RM ".number_format($row[3]*$row2[2], 2, '.', '')."</p>
                          </td>";
                          $totalAmount = $totalAmount + ($row[3]*$row2[2]);
                          echo"
                          <td class='remove-pr'>
                          <a href='cart.php?productid=".$row[2]."&username=".$username."&removeFromCart' class='shop-tooltip close float-none ' title='' data-original-title='Remove'>×</a>

                      </a>
                          </td>
                      </tr>
                    
                  </tbody>";}
                  echo"
              </table>
                        
                    </div>
                </div>
            </div>

            <div class='row my-5'>
                <div class='col-lg-8 col-sm-12'></div>
                <div class='col-lg-4 col-sm-12'>
                    <div class='order-box'>
                        <div class='d-flex gr-total'>
                            <h5>Grand Total</h5>
                            <div class='ml-auto h5'>RM ".number_format($totalAmount, 2, '.', '')."</div>
                        </div>
                        <hr> </div>
                </div>
                <div class='col-12 d-flex shopping-box'><a href='checkout.php' class='ml-auto btn hvr-hover'>Checkout</a> </div>
            </div>

        </div>
    </div>";

}else{
	echo "<div class='small-container cart-page'>
  <script> alert('There are no item(s) in the cart, continue shopping?'); window.location='menu.php'</script>
	</div>";
}


?>

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
