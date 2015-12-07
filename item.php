<?php

session_start();

require 'php/connection.php';

$productID = $_GET['productID'];

$id = array();
$name = array();
$price = array();
$description = array();
$category = array();
$tagSpecific = array();

if ($productID != "") {
//echo $productID;	
$sql = "SELECT name, price, description, category, tagSpecific FROM product WHERE productID = '" . $productID . "'";

	$stmt = db2_prepare($conn, $sql);	

	if ($stmt) {
		$result = db2_execute($stmt);
		
		if (!$result)
		{
			echo "error";
		}
		while ($row = db2_fetch_array($stmt)) {
   			array_push($name, $row[0]);
   			array_push($price, $row[1]);
   			array_push($description, $row[2]);
   			array_push($category, $row[3]);
   			array_push($tagSpecific, $row[4]);
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
    <title><?=$name?> - Ticon</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">
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
                <div class="thumbnail">
                    <img id = "productPicture" src="" alt="">
                    <div class="caption-full">
                        <h3 class="pull-right" id = "priceField"></h3>
                        <h3><a href="#" id = "nameField"></a></h3>
						<br>
                        <h4 id = "descriptionField"></h4>
                        <button type="button" id="add-button" class="btn btn-lg" onClick="addToCart();" >Add to Cart</button>
                    </div>
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
	
	 <script>
		var pName = <?php echo json_encode($name); ?>;
		var pPrice = <?php echo json_encode($price); ?>;
		var pDescription = <?php echo json_encode($description); ?>;
		var pID = <?php echo json_encode($productID); ?>;
		var picSrc = "clothing_pics/" + pID + ".jpg";

		var img = document.getElementById("productPicture");
		img.src = picSrc;
		
		img.style.height = '100%';
		img.style.width = '100%';
		
		document.title = pName;
		document.getElementById("nameField").innerHTML = pName;
		document.getElementById("priceField").innerHTML = "$"+pPrice;
		document.getElementById("descriptionField").innerHTML = pDescription;
		
		function addToCart(){
			<?php
			$customerID = $_SESSION['CustomerID'];
			$sql = "insert into cart (customerID, productID) values ('" . $customerID . "','" . $productID . "')"; 
			
			$stmt = db2_prepare($conn,$sql);
			
			if($stmt){
				$result = db2_execute($stmt);
				if($result){ 
				$_SESSION['addedToCartMsg'] = 'Item added to your cart!';
			}
			else{
				$_SESSION['failedAddedToCartMsg'] = 'Item failed to add to your cart!';
			}
			?>
		}
	 </script>
</body>

</html>
