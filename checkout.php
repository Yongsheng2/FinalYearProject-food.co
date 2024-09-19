<?php require("database.php");
   if(isset($_SESSION["user"])){
    $userid = $_SESSION["user"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $timestamp = date("d-M-Y h:i:sa");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Checkout - Food.Co restaurant</title>
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
<?php
 $sql="SELECT * from cart where username = '$username'";
 $result = mysqli_query($conn,$sql);
 $rowCount=mysqli_num_rows($result);
 $totalAmount = 0;

     if(isset($_POST["checkout"])){
         $sql="SELECT * from cart where username = '$userid'";
         $result = mysqli_query($conn,$sql);
         $cartItemCount = mysqli_num_rows($result);
         $error = $count = 0;
       
         while($row=mysqli_fetch_row($result)){
           $sql2="SELECT * from menu where productid = '$row[2]'";
           $result2 = mysqli_query($conn,$sql2);
           $row2=mysqli_fetch_row($result2);
       
           if($row[3] > $row2[6]){
             echo "<script>alert('Item - ".$row2[1]." insufficient stock. Please remove from your cart.');</script>";
             $error = 1;
           }
         }
       
         if($error == 0){
           $newOrder = "1";
           $sql="SELECT * from cart where username = '$userid'";
           $result = mysqli_query($conn,$sql);
       
           while($row=mysqli_fetch_row($result)){
           $sql2="SELECT * from menu where productid = '$row[2]'";
           $result2 = mysqli_query($conn,$sql2);
           $row2=mysqli_fetch_row($result2);
         
           $qty = $row2[6] - $row[3];
           $productid = $row[2];
           $soldqty = $row2[7] + $row[3];
           $sql3="UPDATE menu SET qty='$qty', soldqty = '$soldqty' WHERE productid = '$productid'";
           if (mysqli_query($conn, $sql3)) {
             $sql4="DELETE FROM cart WHERE username = '$userid' AND productid = '$productid'";
             if (mysqli_query($conn,$sql4)) {
               $count++;
               
               $totalprice=$row[3]*$row2[2];
               $totalprice=number_format( $totalprice, 2, ".", "");
               if($newOrder == "1"){
                 //generate order ID
                 $sql5="SELECT * from orders ORDER BY orderid DESC";
                 $result5 = mysqli_query($conn, $sql5);
                 $row5 = mysqli_fetch_row($result5);
       
                 if($row5 == NULL){
                   $newOrder = "100001";
                 }else{
                   $newOrder = $row5[1] + 1;
                 }
                 
                 //update order table with first item details
                 
                   $sql6 ="INSERT into orders (orderid, username, productid,qty, orderdate, totalprice) VALUES ('$newOrder', '$userid','$productid', '$row[3]','$timestamp','$totalprice')";
                   $result6=mysqli_query($conn,$sql6);
                   
                 
               }else{
                 $sql7 ="INSERT into orders (orderid, username, productid,qty, orderdate, totalprice) VALUES ('$newOrder', '$userid','$productid', '$row[3]','$timestamp','$totalprice')";
                   $result7=mysqli_query($conn,$sql7);
                   
               }
       
             }
       
           }else{
             echo "<script> alert('Error, please contact admin.')</script>";
           }
         
           
         }
         if($count == $cartItemCount){ 
         echo "<script>alert('Your payment was successful! We are preparing your food!');window.location='index.php'</script>";	
         
       }
       }
       }
       $sql="SELECT * from cart where username = '$userid'";
         $result = mysqli_query($conn,$sql);
         $rowCount=mysqli_num_rows($result);
         if($rowCount == 0){	
             
         echo "
         <script> alert('There are no items to checkout, continue shopping?'); window.location='menu.php'</script>";
         //header("location: ./cart.php");
         }else{
         $sql2="SELECT * from useracc where username = '$userid'";
         $result2 = mysqli_query($conn,$sql2);
         $row2=mysqli_fetch_row($result2);?>
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="cart.php">Cart</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row new-account-login">
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Delivery address</h3>
                        </div>
                        <form action="checkout.php" method="POST" class="needs-validation">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name *</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                                    <div class="invalid-feedback"> Valid first name is required. </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name *</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                                    <div class="invalid-feedback"> Valid last name is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="Contact">Contact Number *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="contact" placeholder="" required>
                                    <div class="invalid-feedback" style="width: 100%;"> Your contact number is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email Address *</label>
                                <input type="email" class="form-control" id="email" placeholder="" required>
                                <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" id="address" placeholder="" required>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Country *</label>
                                    <select class="wide w-100" id="country">
									<option value="Choose..." data-display="Select">Choose...</option>
									<option value="Malaysia">Malaysia</option>
								</select>
                                    <div class="invalid-feedback"> Please select a valid country. </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">State *</label>
                                    <select class="wide w-100" id="state">
									<option data-display="Select">Choose...</option>
									<option>Melaka</option>
								</select>
                                    <div class="invalid-feedback"> Please provide a valid state. </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip *</label>
                                    <input type="text" class="form-control" id="zip" placeholder="" required>
                                    <div class="invalid-feedback"> Zip code required. </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <div class="title"> <span>Payment</span> </div>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                    <label class="custom-control-label" for="credit">Credit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="debit">Debit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cc-name">Name on card</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="Full name as displayed on card" required>
                                    <div class="invalid-feedback"> Name on card is required </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cc-number">Credit card number</label>
                                    <input type="text" class="form-control" id="cc-number" placeholder="xxxx-xxxx-xxxx-xxxx" required>
                                    <div class="invalid-feedback"> Credit card number is required </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" placeholder="xx/xx" required>
                                    <div class="invalid-feedback"> Expiration date required </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">CVV</label>
                                    <input type="text" class="form-control" id="cc-cvv" placeholder="xxx" required>
                                    <div class="invalid-feedback"> Security code required </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="payment-icon">
                                        <ul>
                                            <li><img class="img-fluid" src="images/payment-icon/1.png" alt=""></li>
                                            <li><img class="img-fluid" src="images/payment-icon/2.png" alt=""></li>
                                            <li><img class="img-fluid" src="images/payment-icon/5.png" alt=""></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-1"> 
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Shopping cart</h3>
                                </div>
                                <?php
                                 $totalAmount = 0;
                                 while($row=mysqli_fetch_row($result)){
                                    $sql3="SELECT * from menu where productid = '$row[2]'";
                                    $result3 = mysqli_query($conn,$sql3);
                                    $row3=mysqli_fetch_row($result3);
                                echo"
                                <div class='rounded p-2 bg-light'>
                                <div class='media mb-2 border-bottom'>
                                    <div class='media-body'> <a href='menu.php?productid=".$row3[4]."'>".$row3[1]."</a> <br>";
                                    if($row3[6] == "0"){
                                        echo"Stock:<font color='#722F37'><b> Out of stock</b></font>";
                                    }else{
                                        echo"Stock: $row3[6]";
                                    }
                                        echo"
                                        <div class='small text-muted'>Price: RM ".$row3[2]."<span class='mx-2'>|</span> Qty: ".$row[3]." <span class='mx-2'>|</span> Subtotal: RM ".number_format($row[3]*$row3[2], 2, '.', '')."</div>";
                                        $totalAmount = $totalAmount + ($row[3]*$row3[2]);
                                    
                                        echo"
                                    </div>
                                </div>
                            </div>";}
                            echo"
                        </div>
                    </div>
                    <div class='col-md-12 col-lg-12'>
                        <div class='order-box'>
                            <div class='title-left'>
                                <h3>Your order</h3>
                            </div>
                            <div class='d-flex gr-total'>
                                <h5>Grand Total</h5>
                                <div class='ml-auto h5'>RM ".number_format($totalAmount, 2, '.', '')."</div>
                            </div>
                            <hr> </div>
                    </div>
                    <div class='col-12 d-flex shopping-box'>  
                    <input type='submit' name='checkout' value='Place Order' class='ml-auto btn hvr-hover'>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</form>";
}
}else{
        header("location: ./login.php");
    }
    ?>
    <!-- End Cart -->

	<?php include("footer.php"); 

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