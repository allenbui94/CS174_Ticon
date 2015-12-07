<?php
session_start();

require 'php/connection.php';

$customerID = $_SESSION['CustomerID'];
//$_SESSION['CurrentUser'];
$id = array();
$orderID = array();
$orderTime = array();
$itemCost = array();
$firstName = array();
$city = array();

	$sql = "select orderInfo.orderID, orderInfo.orderTime, orderInfo.itemCost, customer.firstName, customer.city from customer join orderInfo on orderInfo.customerID = customer.id where orderInfo.customerID = '" . $customerID ."'";
	$stmt = db2_prepare($conn, $sql);	

	if ($stmt) {
		$result = db2_execute($stmt);
		
		if (!$result)
		{
			echo "error";
		}
		while ($row = db2_fetch_array($stmt)) {
   			array_push($orderID, $row[0]);
   			array_push($orderTime, $row[1]);
   			array_push($itemCost, $row[2]);
   			array_push($firstName, $row[3]);
   			array_push($city, $row[4]);
		}	
		/*
		print_r($name);
		print_r($price);
		print_r($description);
		print_r($category);
		print_r($tagSpecific);*/
		db2_close($conn);
	}
	
	else {
		echo "error";
	}


?>

<!DOCTYPE html>
<html lang="en">
​ 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Order History</title>
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
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="service.html">Services</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
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
        <h2>Order History</h2>
        <hr>
        <br>
    </div>
    <!-- Page Content -->
    <div id="productTable" class="container">
    </div>
    ​
    <hr>
    <div class="container">
        <div class="row">
        </div>
        <div class="row">
            
          
        </div>
        <div class="row">
            <div class="col-md-12">
              
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
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    var cost = 0;
    var oldShippingCost = 0
    var tax = 0;
    $(document).ready(function() {
	/*
	$orderID = array();
$orderTime = array();
$itemCost = array();
$firstName = array();
$city = array();
<?php echo json_encode($productID); ?>
*/
        // do a query to retrieve all the productIDs, etc from this user's cart and store them into arrays
        // Example of a cart with stuff in it after doing a query. Something like
        // "select cart.productID, product.name, product.price, product.description, product.category, product.tag specific from cart join product on product.productID=cart.productID where cart.ID = [whatever the logged in customer's ID is];"
      /*
		var productIDs = [1000000001, 1000000002, 1000000009, 1000000010];
        var prices = [19.99, 249.99, 219.99, 19.99];
        var names = ["Volcom Frickin Chino Pants", "Michael Kors 1224 Suit", "Tommy Hilfiger Black Classic-Fit Tuxedo Suit", "John Ashford Long-Sleeve Herringbone Flannel Shirt"];
        var categories = ["Pants", "Suit", "Suit", "Shirt"];
        var tagSpecifics = ["Men's", "Men's", "Men's", "Men's"];
        var description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur";
        */
		
		var orderIDs = <?php echo json_encode($orderID); ?>;
		var orderTimes = <?php echo json_encode($orderTime); ?>;
		var totals = <?php echo json_encode($itemCost); ?>; 
		var firstNames = <?php echo json_encode($firstName); ?>;
		var cities = <?php echo json_encode($city); ?>;
		
		createProductTable(orderIDs, orderTimes, totals, firstNames, cities); // pass the array(s) containing all the productIDs from the cart
    });

    function createProductTable(orderIDs, orderTimes, totals, firstNames, cities) {
	//  
		
        var html = ""; // we append all our html stuff into here
        cost = 0; // creates a productTable for every item in the cart
        for (i = 0; i < orderIDs.length; i++) {		
		var totalTemp = parseFloat(totals[i]);
		totalTemp = Math.round(totalTemp * 100) / 100;

        html += '<div class = "' + 
		orderIDs[i] + '"><table class="table"><thead><tr><th colspan="2" style="width:30%;">Order #'
		+ orderIDs[i]
		+ '</th><th style="40%;">Info</th><th>Total</th></tr></thead><tbody><tr><td></div></td><td><br><br><button class="btn btn-success" type="button" onclick="redirect('
		+ orderIDs[i] + ');">Order Details</button>  </td><td><table class="table"><tr><td>Date Ordered:</td><td>'
		+ orderTimes[i] + '</td></tr><tr><td>Ship To:</td><td>' 
		+ firstNames[i] + '</td></tr><td>City:</td><td>'
		+ cities[i] + '</table></td><td>'
		+ '$' + totalTemp.toFixed(2) + '<br><div class="caption"><p></div></td></tr></tbody></table><br></div>';
        
        }
		//<a href="#/" onclick="removeCartEntry(' 
		//+ productIDs[i] +',' + prices[i] + ');">Remove from cart</a>
        $('#productTable').html(html);
        $('#cartSubTotal').html('$' + parseFloat(Math.round(cost * 100) / 100).toFixed(2));
    }
	
	function redirect(orderID){
		window.location.href = "orderinfo.php?orderID=" + orderID;
	}
	
    </script>
</body>

</html>
