<?php

session_start(); 
require 'php/connection.php';
if(!isset($_SESSION['CurrentUser'])){
header('Location:index.php');
} 
$customerID = $_SESSION['CustomerID'];
$productID = array();
$price = array();
$name = array();
$category = array();
$tagSpecific = array();
$description = array();

$sql = "select product.productID, product.price, product.name, product.category, product.tagSpecific, product.description from product join cart on product.productID = cart.productID where cart.customerID = '$customerID'";
	$stmt = db2_prepare($conn, $sql);	

	if ($stmt) {
		$result = db2_execute($stmt);
		
		if (!$result)
		{
			echo "error";
		}
		while ($row = db2_fetch_array($stmt)) {
   			array_push($productID, $row[0]);
   			array_push($price, $row[1]);
   			array_push($name, $row[2]);
   			array_push($category, $row[3]);
   			array_push($tagSpecific, $row[4]);
			array_push($description, $row[4]);
		}	
		db2_close($conn);
	}
		
?>

<!DOCTYPE html>
<html lang="en">
​ ​

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shopping Cart</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <!-- Custom CSS -->
    <link href="css/shop-cart.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
​ ​

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

    <div class="container">
        <h2>Shopping Bag</h2>
        <hr>
        <br>
    </div>
    <!-- Page Content -->
    <div id="productTable" class="container">
    </div>
    ​
    <hr>
	<form id = "reisterForm"></form>
    <div class="container">
        <div class="row">
            <div class="col-md-6"><b>Subtotal:</b></div>
            <div id="cartSubTotal" class="col-md-6"></div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <select id="shippingOtions" class="form-control" style="width:60%;" onchange="calculateTotals(this);">
                    <option selected disabled>Shipping Type</option>
                    <option value="1">2 Day Express</option>
                    <option value="2">5 Day Standard</option>
                    <option value="3">Free 7 Day</option>
                </select>
                <!--dropdown-->
            </div>
            <!-- col-->
            <div id="shipping" class="col-md-6"></div>
        </div>
        <!--row-->
        <br />
        <div class="row">
            <div class="col-md-6"><b>Shipping & Tax:</b></div>
            <div id="cartTax" class="col-md-6"></div>
            <div class="col-md-6"><b>Total:</b></div>
            <div id="cartTotal" class="col-md-6"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
			<!--location.href='checkout.php';-->
                <button id = "josh" class="btn pull-right btn-success" type="button" onclick="handleClick()">Checkout</button>
            </div>
        </div>
    </div>
    <!-- /.container -->
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
    <script type="text/javascript">
    var cost = 0;
    var oldShippingCost = 0
    var tax = 0;
	var shippingSpeed;
	var size = 0;
    $(document).ready(function() {
        // do a query to retrieve all the productIDs, etc from this user's cart and store them into arrays
        // Example of a cart with stuff in it after doing a query. Something like
        // "select cart.productID, product.name, product.price, product.description, product.category, product.tag specific from cart join product on product.productID=cart.productID where cart.ID = [whatever the logged in customer's ID is];"
        var productIDs = <?php echo json_encode($productID); ?>//[1000000001, 1000000002, 1000000009, 1000000010];
        var prices = <?php echo json_encode($price); ?>//[19.99, 249.99, 219.99, 19.99];
        var names = <?php echo json_encode($name); ?>//["Volcom Frickin Chino Pants", "Michael Kors 1224 Suit", "Tommy Hilfiger Black Classic-Fit Tuxedo Suit", "John Ashford Long-Sleeve Herringbone Flannel Shirt"];
        var categories = <?php echo json_encode($category); ?>//["Pants", "Suit", "Suit", "Shirt"];
        var tagSpecifics = <?php echo json_encode($tagSpecific); ?>//["Men's", "Men's", "Men's", "Men's"];
        var description = <?php echo json_encode($description); ?>//"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur";
		size = productIDs.length;
	   createProductTable(productIDs, prices, names, categories, tagSpecifics); // pass the array(s) containing all the productIDs from the cart
    });

    function createProductTable(productIDs, prices, names, categories, tagSpecifics) {
        var html = ""; // we append all our html stuff into here
        cost = 0; // creates a productTable for every item in the cart
        for (i = 0; i < productIDs.length; i++) {    
        html += '<div class = "' + 
		productIDs[i] + '"><table class="table"><thead><tr><th colspan="2" style="width:30%;"><center>'
		+ names[i]
		+ '</center></th><th style="40%;">Details</th><th>Price</th></tr></thead><tbody><tr><td><div class="thumbnail"><img class="img-responsive" src="'
		+ 'clothing_pics/'+ productIDs[i]+'.jpg' + '"alt=""style="width:330px; height=150px;"></div></td><td> </td><td><table class="table"><tr><td>Product ID:</td><td>'
		+ productIDs[i] + '</td></tr><tr><td>Category:</td><td>' 
		+ categories[i] + '</td></tr><td>Product ID:</td><td>'
		+ tagSpecifics[i] + '</table></td><td>'
		+ '$' + parseFloat(Math.round(prices[i] * 100) / 100).toFixed(2) + '<br><div class="caption"><p><a href="#/" onclick="removeCartEntry(' 
		+ productIDs[i] +',' + prices[i] + ');">Remove from cart</a></div></td></tr></tbody></table><br></div>';
            cost = cost + parseFloat(prices[i]);
        }
        $('#productTable').html(html);
        $('#cartSubTotal').html('$' + parseFloat(Math.round(cost * 100) / 100).toFixed(2));
    }
	
	function handleClick(){
		if(size > 0){
			if(shippingSpeed != null){
				var opener = "checkout.php?shipping=" + shippingSpeed;
				window.open(opener, "_self");
			}
		}
	}

    function calculateTotals(element) {
	
        //FOR REMOVE CART ---> subtract from COST here... 
        tax = cost * .07;
		
        var shippingCost = 0;
        var sNum = element.value;
        if (sNum == 1) {
			shippingSpeed = 2;
            shippingCost = 6.95;
            oldShippingCost = 6.95;
        } else if (sNum == 2) {
		shippingSpeed = 5;
            shippingCost = 5.95;
            oldShippingCost = 5.95;
        }else if(sNum == 3){ 
		shippingSpeed = 7;
	    shippingCost = 0; 
	    oldShippingCost = 0; 
	}
        // add the cost of shipping by grabbing the value the user chose
        $('#shipping').html('$' + parseFloat(shippingCost));
        $('#cartTax').html('$' + parseFloat(Math.round((shippingCost + tax) * 100) / 100).toFixed(2));
        $('#cartTotal').html('$' + parseFloat(Math.round((cost + tax + shippingCost) * 100) / 100).toFixed(2));
    }

    function removeCartEntry(productID, price) {
        var divID = "\.";
        divID += productID;
		divID += ":first";
        $(divID).remove();
        cost -= price;
		tax = cost * .07;
        $('#cartSubTotal').html('$' + parseFloat(Math.round(cost * 100) / 100).toFixed(2));
        $('#cartTax').html('$' + parseFloat(Math.round((oldShippingCost + tax) * 100) / 100).toFixed(2));
        $('#cartTotal').html('$' + parseFloat(Math.round((cost + tax + oldShippingCost) * 100) / 100).toFixed(2));

		location.href = 'php/cartRemoval.php?productID='+productID;
				
		
        // make sure to delete the entry from the database as well
    }
	
	
    </script>
</body>

</html>
