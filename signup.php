<!DOCTYPE html>
<html lang="en">
<?php

session_start(); 
if(isset($_SESSION['CurrentUser'])){
header('Location:index.php');
} 


?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <!-- Custom CSS -->
    <link href="css/login.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand lead2" href="index.php"> T </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="about.php">About</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav pull-right">
		
		<?php if(!isset($_SESSION['CurrentUser'])){ ?>	
                    <li>
                        <a href="login.php">Login/SignUp</a>
                    </li> <?php } ?>
		<?php if(isset($_SESSION['CurrentUser'])){?>
		    <li>
                        <a href="php/logout.php"><?php echo $_SESSION['CurrentUser']." (logout)"?></a>
                    </li>
		    <li> 
                        <a href="orderHistory.php">Order History</a> 
                    </li>
                    <li> 
                        <a href="cart.php">
                            <img src="http://findicons.com/files/icons/1700/2d/512/cart.png" alt="cartImage" style="width:20px; height=20px;">
                        </a> 
                    </li><?php } ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>    <div class="container">
        <h2>Register</h2>
	<h5 "errorMsg"><?php if(isset($_SESSION['failedRegMsg'])){echo $_SESSION['failedRegMsg']; unset($_SESSION['failedRegMsg']);}?></h5>
        <hr>
        <form id="registerForm" action="php/signupValidate.php" method="POST">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="InputName">First Name</label>
                    <div class="input-group">
                        <input type="text" name="firstName" class="form-control" id="firstName" placeholder="Enter First Name" required>
                    </div>
                    <br>
                    <label for="InputName">Enter Email</label>
                    <div class="input-group">
                         <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
                        <span class="input-group-addon"></span>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="InputName">Last Name</label>
                    <div class="input-group">
                        <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Enter Last Name" required>
                    </div>
                    <br>
                    <label for="InputPassword">Enter Password</label>
                    <div class="input-group">
                        <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Enter Password" required>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <label for="InputEmail">Enter Phone Number:</label>
                    <div class="input-group">
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number" required>
                        <span class="input-group-addon"></span>
                    </div>
                    <br>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <label for="InputStreetName">Address</label>
                    <div class="input-group">
                        <input type="text" name="street" class="form-control" id="street" placeholder="Enter Street Name and Number" required>
                        <span class="input-group-addon"></span>
                    </div>
                    <br>
                </div>
            </div>
			<div class="form-group">
                <div class="col-lg-12">
                    <label for="InputStreetName">Zip Code</label>
                    <div class="input-group">
                        <input type="text" name="zip" class="form-control" id="zip" placeholder="Enter Zip Code" required>
                    </div>
                    <br>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <label for="InputCity">City</label>
                    <div class="input-group">
                        <input type="text" name="city" class="form-control" id="city" placeholder="Enter City" required>
                        <span class="input-group-addon"></span>
                    </div>
                    <br>
                </div>
            </div>
			<div class="form-group">
                <div class="col-lg-12">
                    <label for="InputCity">State</label>
                    <div class="input-group">
                        <input type="text" name="state" class="form-control" id="state" placeholder="Enter Full State Name" required>
                        <span class="input-group-addon"></span>
                    </div>
                    <br>
                </div>
            </div>
			<div class="form-group">
                <div class="col-lg-12">
                    <label for="InputCity">Country</label>
                    <div class="input-group">
                        <input type="text" name="country" class="form-control" id="country" placeholder="Enter Country" required>
                        <span class="input-group-addon"></span>
                    </div>
                    <br>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success pull-right">
            </div>
        </form>
    </div>
    <!---container-->
    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-md-6">
                    <p>Copyright &copy; Ticon 2015</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
