<?php
session_start(); 	
require 'php/connection.php';

$category = $_GET['category'];
$tagSpecific = $_GET['tagSpecific'];

$id = array();
$name = array();
$price = array();
$description = array();
$productID = array();

$sql = "SELECT product.productID, name, price, description FROM product join warehouse on warehouse.productID=product.productID where category = '" . $category . "' and tagSpecific = '" . $tagSpecific ."' and warehouse.quantity != '0'";

	$stmt = db2_prepare($conn, $sql);	

	if ($stmt) {
		$result = db2_execute($stmt);
		
		if (!$result)
		{
			echo "error";
		}
		while ($row = db2_fetch_array($stmt)) {
   			array_push($productID, $row[0]);
   			array_push($name, $row[1]);
   			array_push($price, $row[2]);
   			array_push($description, $row[3]);
		}	
		db2_close($conn);
	}
	
	else {
		echo "error";
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Ticon-Home Page</title>
    <!-- Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <p class="lead">Ticon</p>
                <div id="SideBar">
                    <div class="list-group panel">
                        <a href="#mens" class="list-group-item list-group-item-info" data-toggle="collapse" data-parent="#SideBar">Men's</a>
                        <div class="collapse" id="mens">
							<a href="results_list.php?category=Shirt&tagSpecific=Men''s" class="list-group-item">Shirts</a>
                            <a href="results_list.php?category=Pants&tagSpecific=Men''s" class="list-group-item">Pants</a>
                            <a href="results_list.php?category=Suit&tagSpecific=Men''s" class="list-group-item">Suits</a>
							<a href="results_list.php?category=Jacket&tagSpecific=Men''s" class="list-group-item">Jackets</a>							
                            <a href="results_list.php?category=Shoes&tagSpecific=Men''s" class="list-group-item">Shoes</a>
                        </div>
                        <a href="#womens" class="list-group-item list-group-item-info" data-toggle="collapse" data-parent="#SideBar">Women's</a>
                        <div class="collapse" id="womens">
                            <a href="results_list.php?category=Shoes&tagSpecific=Women''s" class="list-group-item">Shoes</a>	
							<a href="results_list.php?category=Pants&tagSpecific=Women''s" class="list-group-item">Pants</a>	
                            <a href="results_list.php?category=Dress&tagSpecific=Women''s" class="list-group-item">Dresses</a>	
							<a href="results_list.php?category=Sweater&tagSpecific=Women''s" class="list-group-item">Sweaters</a>	
							<a href="results_list.php?category=Jacket&tagSpecific=Women''s" class="list-group-item">Jackets</a>	
                        </div>
                    </div>
                </div>
            </div>
            <!--col-->
            <div class="col-md-9">
                <div class="row carousel-holder">
                    <div class="col-md-12"></div>
                </div>
                <!--row-->
                <div class="row">
                    <div id="productTable" class="container"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
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
        $(document).ready(function() {
            // do a query to retrieve whatever category the user clicked on
            // For example, if the user clicked on Mens > Pants, a query to get that info could be
            // "SELECT productID, name, price, description FROM product where category="Pants" and tagSpecific="Men's""
            var productIDs = <?php echo json_encode($productID); ?>;//[1000000010, 1000000020, 1000000030, 1000000040, 1000000050, 1000000060];
            var prices = <?php echo json_encode($price); ?>;//[19.99, 159.99, 12.99, 48.99, 89.99, 29.99];
            var names = <?php echo json_encode($name); ?>;//["John Ashford Long-Sleeve Herringbone Flannel Shirt", "London Fog Big & Tall Classic Car Coat", "St. John's Bay Long-Sleeve Solid Sueded Polo", "Levi's 514 Straight-Fit Jeans, Caraway Twill", "a.n.a Long-Sleeve Sweater Dress", "St. John's Bay Wool-Blend Pea Coat"];
            var descriptions = <?php echo json_encode($description); ?>;//["A subtle herringbone pattern adds a textural feel to this button-down shirt from John Ashford.", "Brave the outdoors in this polished overcoat from Kenneth Cole Reaction, designed with a slim fit and knit collar.", "This polo's soft color and cushiony sueded fabric gives you an easy-going style that feels instantly worn in.", "When blue denim won't do, enhance any casual look with these twill jeans from Levi's.", "Our oversized sweater dress features textural knit details and a draped cowl neckline for a soft and cozy take on a new season essential.", "The warm fleece of our Columbia zip-front jacket keeps you cozy and comfortable during all your outdoor adventures."];
            createProductTable(productIDs, prices, names, descriptions); // pass the array(s) containing all the productIDs from the cart
        });

        /**
         * Creates a box with information for an item
         * @param {Array(int)} productIDs the productIDs
         * @param {Array(double)} prices the cost of each item w/o tax
         * @param {Array(String)} names the name of each item
         * @param {Array(String)} descriptions a <255 character description of the item
         */
        function createProductTable(productIDs, prices, names, descriptions) {
            var html = "";

            for (i = 0; i < productIDs.length; i++) {
                html += '<div class="col-sm-4 col-lg-4 col-md-4" style="width:30%;"><div class="thumbnail"><img src="clothing_pics/' +
                    productIDs[i] + '.jpg" alt=""><center><h4><a href="item.php?productID=' +
                    productIDs[i] + '">' +
                    names[i] + '</a></h4><div class="caption"><h4>$' +
                    prices[i] + '</h4>' +
                    descriptions[i] + '</p></div></div></div>';
            }
            $('#productTable').html(html);
        }
    </script>
</body>

</html>