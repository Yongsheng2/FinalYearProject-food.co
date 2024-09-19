 <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					
                    <div class="right-phone-box">
                        <p>Call US : <a  href="tel:+60123456789"> +6012-3456789</a></p>
                    </div>
                    <div class="our-link">
                        <ul>
                        <?php
                        if(isset($_SESSION["user"])){
                            $userid = $_SESSION["user"];
                            echo"
                            <li><a href='my-account.php'><i class='fa fa-user s_color'></i> My Account</a></li>
                            <li><a href='#contact'><i class='fas fa-location-arrow'></i> Our location</a></li>
                            <li><a href='contact-us.php'><i class='fas fa-headset'></i> Contact Us</a></li>
                            ";
                        }else{
                            echo"
                            <li><a href='#contact'><i class='fas fa-location-arrow'></i> Our location</a></li>
                            <li><a href='contact-us.php'><i class='fas fa-headset'></i> Contact Us</a></li>";
                        }
                        ?>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                if(isset($_SESSION["user"])){
                    $userid = $_SESSION["user"];
                    echo"
                    <div class='login-box'>
                    <p><a href='logout.php' class='login-register'>Logout</a></p>
                    </div>";
                    
                }else{
                echo"
                <div class='login-box'>
                <p><a href='login.php' class='login-register'>Login/Register</a></p>
                </div>";}
                    ?>
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <?php
                             if(isset($_SESSION["user"])){
                                $userid = $_SESSION["user"];
                            
                                echo"
                                <ul class='offer-box'>
                                <li>
                                    <i class='fab fa-opencart'></i> Welcome, $userid.
                                </li>
                                </ul>
                                ";

                             }else{


                            echo"
                            <ul class='offer-box'>
                                <li>
                                    <i class='fab fa-opencart'></i> Get first offer, Order NOW!
                                </li>
                                <li>
                                    <i class='fab fa-opencart'></i> Follow our Social Media 'Food.Co Restaurant' get more info
                                </li>
                                <li>
                                    <i class='fab fa-opencart'></i> Get Big Deal for Every Festival
                                </li>                          
                            </ul>";}
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="index.php"><img src="images/food-co-logo.png" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <!--<li class="dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">Menu<i class="fas fa-caret-down"></i></a>
                            <ul class="dropdown-menu">
								drop down category<li><a href="shop.php">Shop</a></li>
								<li><a href="shop-detail.php">Shop Detail</a></li>
                                <li><a href="cart.php">Cart</a></li>
                                <li><a href="checkout.php">Checkout</a></li>
                                <li><a href="my-account.php">My Account</a></li>                              
                            </ul>
                        </li>-->
						<li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>

                        <?php
                             if(isset($_SESSION["user"])){
                                $userid = $_SESSION["user"];
                            
                            echo"<li class='nav-item'><a class='nav-link' href='cart.php'>Cart</a></li>";}
                        ?>
                    </ul>
                </div>
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->
