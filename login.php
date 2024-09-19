<?php 
require("database.php");
if(isset($_SESSION["user"])){
    //redirect main page
    header("location: ./index.php");
}
if (isset($_POST["login"])) {
    $username=$_POST["username"];
    $password=$_POST["password"];
    $sql="SELECT * from useracc where username = '$username' and password= '".md5($password)."'";

    $result = mysqli_query($conn,$sql);
    $rows=mysqli_num_rows($result);
    //$row=mysqli_fetch_row($result);
    if ($rows==1) {
        $_SESSION["user"]=$username;
            if(isset($username)){
                $sql="SELECT * from useracc where username = '$username'";
                $result = mysqli_query($conn,$sql);
                $row=mysqli_fetch_row($result);
                if($row[5]=="Admin"){
                    header("location: ./Admin/index.php");
                }else{
                    header("location: ./index.php");
                }
            }
    }else{
        echo"<script> alert('Wrong Username and Password!');window.location='login.php' </script>";
    }	
}

if (isset($_POST["register"])) {
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $password2=$_POST["password2"];
    
    //check if both passwords are matched
    if($password == $password2){
        //check if username and email already in used?
        $sql="SELECT * from useracc where username = '$username' or email='$email'";

        $result = mysqli_query($conn,$sql);
        $rows=mysqli_num_rows($result);
        if ($rows>=1) {
            echo"<script> alert('Username or Email in used.');window.location='login.php'; </script>";
            //header("location: ./index.php");
        }else{
        $sql ="INSERT into useracc (id, email, username, password, role) VALUES ('', '$email','$username','".md5($password)."', 'User')";
        $result=mysqli_query($conn,$sql);
        if ($result) {
            echo"<script> alert('Account register successfully');window.location='login.php';</script>";
            }
        }
        }else{
            echo"<script> alert('Passwords didn\'t match.');window.location='login.php';</script>";
        }
    }
    
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login/Register - Food.Co restaurant</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="images/food-co-icon.png" type="image/x-icon">
<style>
body {
    margin: 0;
    color: #000;
    background: #f4f4f4; 
	background: url('images/bg-01.jpg') no-repeat center;
	background-size:cover;
    font: 500 16px/18px 'Dosis', sans-serif;
}

label{
    cursor:pointer;
}

.login-box {
    width: 100%;
    margin: auto;
    max-width: 650px;
    min-height: 680px;
    position: relative;
	background-color:rgb(177 193 224 / 44%);
    box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19);
}

.login-snip {
    width: 100%;
    height: 100%;
    position: absolute;
    padding: 90px 70px 50px 70px;
    //background-color:rgba(255, 255, 255 ,0.3);
}

.login-snip .login,
.login-snip .sign-up-form {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    position: absolute;
    transform: rotateY(180deg);
    backface-visibility: hidden;
    transition: all .4s linear
}

.login-snip .sign-in,
.login-snip .sign-up,
.login-space .group .check {
    display: none
}

.login-snip .tab,
.login-space .group .label,
.login-space .group .button {
    text-transform: uppercase
}

.login-snip .tab {
    font-size: 22px;
    margin-right: 15px;
    padding-bottom: 5px;
    margin: 0 15px 10px 0;
    display: inline-block;
    border-bottom: 2px solid transparent
}

.login-snip .sign-in:checked+.tab,
.login-snip .sign-up:checked+.tab {
    color: #fff;
    border-color: #1161ee;
}

.login-space {
    min-height: 345px;
    position: relative;
    perspective: 1000px;
    transform-style: preserve-3d;
}

.login-space .group {
    margin-bottom: 15px
}

.login-space .group .label,
.login-space .group .input,
.login-space .group .button {
    width: 100%;
    color: #fff;
    display: block;
}

.login-space .group .input,
.login-space .group .button {
    border: none;
    padding: 15px 20px;
    border-radius: 25px;
    background: rgba(255, 255, 255, .1);
}

.login-space .group input[data-type="password"] {
    text-security: circle;
    -webkit-text-security: circle;
}

.login-space .group .label {
    color: #404040;
    font-size: 12px;
}

.login-space .group .button {
    background: #b0b435;
}

.login-space .group label .icon {
    width: 15px;
    height: 15px;
    border-radius: 2px;
    position: relative;
    display: inline-block;
    background: rgba(255, 255, 255, .1)
}

.login-space .group label .icon:before,
.login-space .group label .icon:after {
    content: '';
    width: 10px;
    height: 2px;
    background: #fff;
    position: absolute;
    transition: all .2s ease-in-out 0s;
}

.login-space .group label .icon:before {
    left: 3px;
    width: 5px;
    bottom: 6px;
    transform: scale(0) rotate(0);
}

.login-space .group label .icon:after {
    top: 6px;
    right: 0;
    transform: scale(0) rotate(0);
}

.login-space .group .check:checked+label {
    color: #fff;
}

.login-space .group .check:checked+label .icon {
    background: #1161ee;
}

.login-space .group .check:checked+label .icon:before {
    transform: scale(1) rotate(45deg);
}

.login-space .group .check:checked+label .icon:after {
    transform: scale(1) rotate(-45deg);
}

.login-snip .sign-in:checked+.tab+.sign-up+.tab+.login-space .login {
    transform: rotate(0);
}

.login-snip .sign-up:checked+.tab+.login-space .sign-up-form {
    transform: rotate(0);
}

input.button {
    cursor: pointer;
}

*,
:after,
:before {
    box-sizing: border-box;
}

.clearfix:after,
.clearfix:before {
    content: '';
    display: table;
}

.clearfix:after {
    clear: both;
    display: block;
}

a {
    color: inherit;
    text-decoration: none;
}

.txt:hover{color:#0000009e;}

.hr {
    height: 2px;
    margin: 30px 0 30px 0;
    background: rgba(255, 255, 255, .2)
}

.foot {
    text-align: center;
	margin-bottom:1%;
}

.foot1 {
    text-align: center;
}

.card {
    width: 550px;
    margin: auto;
    width: 50%;
    padding: 10px;
}

::placeholder {
    color: #7a7a7a;
}
</style>
</head>
<body>
<div class="row">
    <div class="col-md-6 mx-auto p-0">
        <div class="card">
            <div class="login-box">
                <div class="login-snip"><input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab"><b>Login</b></label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"><b>Register</b></label>
                    <div class="login-space">
                        
		            	<form action="#" method="POST" id="login">
                        <div class="login"><br>
                            <div class="group"> <label for="user" class="label">Username</label> 
                            <input id="user" type="text" name="username" class="input" placeholder="Enter your username"> </div>

                            <div class="group"> <label for="pass" class="label">Password</label> 
                            <input id="pass" type="password" name="password" class="input" data-type="password" placeholder="Enter your password"> </div>

                            <div class="group" style="margin-top:30px;"> 
                            <input type="submit" name="login" class="button" value="Sign In"> </div>
                            <div class="hr"></div>
							<div class="foot"><a href="index.php" class="txt">Back To Main Page</a></div>
                        </div>
                        </form>




                        <form action="#" method="POST" id="register" >
                        <div class="sign-up-form"><br>
                            <div class="group"> <label for="user" class="label">Username</label> <input id="user" name="username" type="text" class="input" placeholder="Create your Username" required> </div>
                            <div class="group"> <label for="pass" class="label">Password</label> <input id="pass" name="password" type="password" class="input" data-type="password" placeholder="Create your password" required> </div>
                            <div class="group"> <label for="pass" class="label">Repeat Password</label> <input id="pass" name="password2" type="password" class="input" data-type="password" placeholder="Repeat your password" required> </div>
                            <div class="group"> <label for="pass" class="label">Email Address</label> <input id="pass" name="email" type="email" class="input" placeholder="Enter your email address" required> </div>
                            <div class="group"> <input type="submit" name="register" class="button" value="Sign Up"> </div>
                            <div class="hr"></div>
                            <div class="foot"> <label for="tab-1" class="txt">Already Member?</label> </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>