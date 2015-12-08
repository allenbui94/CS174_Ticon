<?php
session_start();
require 'php/connection.php';
$shipping = $_GET['shipping'];
$_SESSION['shipSpeed'] = $shipping;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CheckOut</title>
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
    </nav>

    <!-- Page Content -->
    <div class="container">
        <h2>Enter Payment Information</h2>
        <hr>
        <form id="registerForm" method="POST">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="InputName">Name on Card</label>
                        <div class="input-group">
                            <input type="text" name="cardName" class="form-control" id="cardName" placeholder="Enter Full Name" required>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="InputName">Cardnumber</label>
                        <div class="input-group">
                            <input type="text" name="cardNumber" class="form-control" id="cardNumber" placeholder="Enter Cardnumber" required>
                        </div>
                    </div>
                </div>
            </div>
            <!--row-->
            <br>
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-4">
                        <label for="InputName">CVC</label>
                        <div class="input-group">
                            <input type="number" name="cvc" class="form-control" id="cvc" placeholder="ex 31" required>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <label for="InputName">Expiration</label>
                        <div class="input-group">
                            <input type="number" name="month" class="form-control" id="month" placeholder="MM" required>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <label for="InputName"></label>
                        <div class="input-group">
                            <input type="number" name="year" class="form-control" id="year" placeholder="YYYY" required>
                        </div>
                    </div>
                </div>
            </div>
            <!--row-->
            <br>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="submit" name="submit" id="submit" value="Pay Now" onclick="validatePayment()" class="btn btn-success pull-right">
                    </div>
                </div>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script>
	function validatePayment() {
				$(document).ready(function(){
					$("#registerForm").validate({
						debug: false,
						submitHandler: function(form) {
							$.post('php/paymentValidate.php', $("#registerForm").serialize(), function(data) {
								var opener = "orderHistory.php";
								window.open(opener, "_self");
								
							});
						}
					});
				});
			}
		
	</script>
</body>

</html>
