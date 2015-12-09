<?php
session_start();

require 'php/connection.php';
if(!isset($_SESSION['CurrentUser'])){
header('Location:index.php');
} 
$inputOrderID = $_GET['orderID'];
$customerID = $_SESSION['CustomerID'];
//$_SESSION['CurrentUser'];
$id = array();
$orderID = array();
$orderTime = array();
$itemCost = array();
$firstName = array();
$city = array();
$shippingType = array();

$productID = array();
$name = array();
$price = array();
$category = array();
$tagSpecific = array();

$street = array();
$state = array();
$zip = array();
$country = array();

$latitude = array();
$longitude = array();


	//$sql = "select orderInfo.orderID, orderInfo.orderTime, orderInfo.itemCost, customer.firstName, customer.city from customer join orderInfo on orderInfo.customerID = customer.id where orderInfo.customerID = '" . $customerID ."'";
	$sql = "select orderInfo.orderID, orderInfo.orderTime, orderInfo.itemCost, customer.firstName, customer.city, orderInfo.shippingType, customer.street, customer.sta, customer.zip, customer.country from customer join orderInfo on orderInfo.customerID = customer.id where orderInfo.customerID = '" . $customerID ."' and orderInfo.orderID = '". $inputOrderID ."'";
	$stmt = db2_prepare($conn, $sql);	
	$sql2 = "select orderedItems.orderID, orderedItems.productID, product.name, product.price, product.category, product.tagSpecific from orderedItems join orderInfo on orderInfo.orderID = orderedItems.orderID join product on orderedItems.productID = product.productID where orderInfo.orderID = '" .$inputOrderID."'";
	$sql3 = "select warehouse.latitude, warehouse.longitude from warehouse join orderedItems on orderedItems.productID = warehouse.productID where orderID = '". $inputOrderID ."'";

	//echo $inputOrderID;
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
			array_push($shippingType, $row[5]);
			array_push($street, $row[6]);
			array_push($state, $row[7]);
			array_push($zip, $row[8]);
			array_push($country, $row[9]);
		}	
		
		$stmt = db2_prepare($conn, $sql2);	
		if ($stmt) {
			$result = db2_execute($stmt);
			while ($row = db2_fetch_array($stmt)) {			
				array_push($productID, $row[1]);	
				array_push($name, $row[2]);	
				array_push($price, $row[3]);	
				array_push($category, $row[4]);	
				array_push($tagSpecific, $row[5]);	
				
		}	}

		$stmt = db2_prepare($conn, $sql3);	
		if ($stmt) {
		$result = db2_execute($stmt);
			while ($row = db2_fetch_array($stmt)) {	
				array_push($latitude, $row[0]);
				array_push($longitude, $row[1]);
				//array_push($latitude, $row[0]);	
				//array_push($longitude, $row[1]);		
		}
		}
		//print_r($shippingType);
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
​ ​

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Order Info</title>
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
        <h2>Order Info</h2>
        <hr>
        <br>
    </div>
    <!-- Page Content -->
	
	<div id="orderInfoTable" class="container"></div>
	<center><h2>Items Purchased</h2></center>
	<hr>
    <div id="productTable" class="container">
    </div>
    ​
    <hr>
    
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
	<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
    <script type="text/javascript">

    $(document).ready(function() {
	/*$orderID = array();
$orderTime = array();
$itemCost = array();
$firstName = array();
$city = array();*/
       
        var productIDs =  <?php echo json_encode($productID); ?>;//[1000000001, 1000000002, 1000000009, 1000000010];
        var prices =  <?php echo json_encode($price); ?>;//[19.99, 249.99, 219.99, 19.99];
        var names =  <?php echo json_encode($name); ?>;//["Volcom Frickin Chino Pants", "Michael Kors 1224 Suit", "Tommy Hilfiger Black Classic-Fit Tuxedo Suit", "John Ashford Long-Sleeve Herringbone Flannel Shirt"];
        var categories =  <?php echo json_encode($category); ?>;//["Pants", "Suit", "Suit", "Shirt"];
        var tagSpecifics =  <?php echo json_encode($tagSpecific); ?>;//["Men's", "Men's", "Men's", "Men's"];
        //var description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur";
        var orderIDs = <?php echo json_encode($orderID); ?>;
		var orderTimes = <?php echo json_encode($orderTime); ?>;
		var itemCosts = <?php echo json_encode($itemCost); ?>;
		var firstNames = <?php echo json_encode($firstName); ?>;
		var cities = <?php echo json_encode($city); ?>;
		var shippingTypes = <?php echo json_encode($shippingType); ?>;
		
		var latitudes = <?php echo json_encode($latitude); ?>;
		var longitudes = <?php echo json_encode($longitude); ?>;
		
		var streets = <?php echo json_encode($street); ?>;
		var states = <?php echo json_encode($state); ?>;
		var zips = <?php echo json_encode($zip); ?>;
		var countries = <?php echo json_encode($country); ?>;
		 console.log(productIDs);
		// lmao i don't even care if this is a trillion parameters at this point
		createOrderInfoTable(orderIDs, orderTimes, itemCosts, firstNames, cities, shippingTypes, latitudes, longitudes, streets, states, zips, countries);
		createProductTable(productIDs, prices, names, categories, tagSpecifics); 
		
		var addr = streets[0] + ", " + cities[0] + ", " + states[0] + " " + zips[0] + " " +countries[0];
		var lat = parseFloat(latitudes[0]);
		var lon = parseFloat(longitudes[0]);		
		var point = new google.maps.Point(lat, lon);
		
		getPackageLoc(point, "", shippingTypes[0], orderTimes[0], shippingTypes[0]);
    });

	function createOrderInfoTable(orderIDs, orderTimes, itemCosts, firstNames, cities, shippingTypes, latitudes, longitudes, streets, states, zips, countries){
		var lat = parseFloat(latitudes[0]);
		var lon = parseFloat(longitudes[0]);
		var addr = streets[0] + ", " + cities[0] + ", " + states[0] + " " + zips[0] + " " +countries[0];		
		
		var point = new google.maps.Point(lat, lon, orderTimes[0], shippingTypes[0]);
		
		// CHANGE BACK getLocation(addr, point, orderTimes[0], shippingTypes[0]);
		getLocation(addr, point, orderTimes[0], shippingTypes[0]);
		//var location = getPackageLoc(point, "", orderTimes[0], shippingTypes[0]);
		//
		
		var totalTemp = parseFloat(itemCosts[0]);
		totalTemp = Math.round(totalTemp * 100) / 100;
	
		var html = '<div class = "' + 
		orderIDs[0] + '"><table class="table"><thead><tr><th colspan="2" style="width:30%;">Order #'
		+ orderIDs[0]
		+ '</th><th style="40%;">Tracking Info</th><th>Total</th></tr></thead><tbody><tr><td></div></td><td><br><br></td><td><table class="table"><tr><td>Date Ordered:</td><td>'
		+ orderTimes[0]
		+'</td></tr><tr><td>Shipping Speed:</td><td>' 
		+ shippingTypes[0] + " Day Shipping"+ '</td></tr><tr><td>Status:</td><td>' 
		+ getOrderStatus(orderTimes[0], shippingTypes[0]) + '</td></tr><td>Destination:</td><td>'
		+ cities[0] + '</td></tr><td>Current Location:</td><td><p id = "loc">'
		+ "" + '</p></td></tr><td>ETA:</td><td>'
		+ getDaysLeft(orderTimes[0], shippingTypes[0]) +'</table></td><td>'
		+ '$' + parseFloat(Math.round(totalTemp * 100) / 100).toFixed(2) + '<br><div class="caption"><p></div></td></tr></tbody></table><br></div>';
		$('#orderInfoTable').html(html);
		//var location = getPackageLoc(point, point2, orderTimes[0], shippingTypes[0]);
		/*
		var tempPoint3 = new google.maps.Point(37.774929, -122.419416); // somewhere in San Francisco
		console.log(getPackageLoc(tempPoint, tempPoint3, "November 30, 2015 12:40:00", 5));*/
	}
	
    function createProductTable(productIDs, prices, names, categories, tagSpecifics) {
        var html = ""; // we append all our html stuff into here  
        for (i = 0; i < productIDs.length; i++) {    
        html += '<div class = "' + 
		productIDs[i] + '"><table class="table"><thead><tr><th colspan="2" style="width:30%;"><center>'
		+ names[i]
		+ '</center></th><th style="40%;">Details</th><th>Price</th></tr></thead><tbody><tr><td><div class="thumbnail"><img class="img-responsive" src="'
		+ 'clothing_pics/'+ productIDs[i]+'.jpg' + '"alt=""style="width:330px; height=150px;"></div></td><td> </td><td><table class="table"><tr><td>Product ID:</td><td>'
		+ productIDs[i] + '</td></tr><tr><td>Category:</td><td>' 
		+ categories[i] + '</td></tr><td>Tag:</td><td>'
		+ tagSpecifics[i] + '</table></td><td>'
		+ '$' + prices[i] + '<br><div class="caption"><p></div></td></tr></tbody></table><br></div>';  
        }
        $('#productTable').html(html);
       
    }

    function calculateTotals(element) {
        //FOR REMOVE CART ---> subtract from COST here... 
        tax = cost * .07;

        var shippingCost = 0;
        var sNum = element.value;
        if (sNum == 1) {
            shippingCost = 5.95;
            oldShippingCost = 5.95;
        } else if (sNum == 2) {
            shippingCost = 6.95;
            oldShippingCost = 6.95;
        }else if(sNum == 3){ 
	    shippingCost = 0; 
	    oldShippingCost = 0; 
	}
	
        // add the cost of shipping by grabbing the value the user chose
        $('#shipping').html('$' + parseFloat(shippingCost));
        $('#cartTax').html('$' + parseFloat(Math.round((shippingCost + tax) * 100) / 100).toFixed(2));
        $('#cartTotal').html('$' + parseFloat(Math.round((cost + tax + shippingCost) * 100) / 100).toFixed(2));
    }

	
	/**
 * Gets the latitude/longitude from an address
 * @param {String} formattedAddress (e.g. "1 Washington Sq, San Jose, CA 95192")
 * @return {google.maps.Point} the point (e.g. {x: 37.3351424, y: -121.88127580000003})
 */
function getLocation(formattedAddress, point2, orderTime, shippingType) {
//addr, point, orderTimes[0], shippingTypes[0]
   var geocoder = new google.maps.Geocoder();
   geocoder.geocode({
      'address': formattedAddress
   }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
         var latitude = results[0].geometry.location.lat();
         var longitude = results[0].geometry.location.lng();
         var point = new google.maps.Point(latitude, longitude);
		 var orderStatus = getOrderStatus(orderTime, shippingType);
   if (orderStatus == "Preparing for shipment") {
     var geocoder = new google.maps.Geocoder();;
   var latlng = new google.maps.LatLng(point2.y, point2.x);
   console.log(point2.y + "  " + point2.x);
   
   geocoder.geocode({
      'latLng': latlng
   }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
         if (results[1]) {
            for (var i = 0; i < results[0].address_components.length; i++) {
               for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                  if (results[0].address_components[i].types[b] == "locality") {
                     city = results[0].address_components[i];
                     break;
                  }
               }
            }       
			document.getElementById("loc").innerHTML = city.long_name;
            console.log(city.long_name);
            // alert(city.long_name)
            // need to return city.long_name somehow
         }
      }
   });
  
      return "getPackageLoc - preparing for shipment";
   } else if (orderStatus == "Delivered") {
	   var geocoder = new google.maps.Geocoder();;
   var latlng = new google.maps.LatLng(point.x, point.y);
   geocoder.geocode({
      'latLng': latlng
   }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
         if (results[1]) {
            for (var i = 0; i < results[0].address_components.length; i++) {
               for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                  if (results[0].address_components[i].types[b] == "locality") {
                     city = results[0].address_components[i];
                     break;
                  }
               }
            }       
			document.getElementById("loc").innerHTML = city.long_name;
            console.log(city.long_name);
            // alert(city.long_name)
            // need to return city.long_name somehow
         }
      }
   });
  
      return "getPackageLoc - delivered";
   } else {
		document.getElementById("loc").innerHTML = "It's somewhere.";
      return "getPackageLoc - in transit";
		 
		 }

		 document.getElementById("loc").innerHTML = point;
         console.log("From getLoc() " + point);
         //alert(point);
         // need to return point somehow
      }
   });
}

/**
 * Gets the current location of the package
 * @param {google.maps.Point} start the starting point of the package (e.g. 37.3351424, -121.8812758)
 * @param {google.maps.Point} end the destination of the package (e.g. 37.40313, -121.96973)
 * @param {String} orderDate the time the package was ordered(e.g. "October 13, 2015 11:13:00")
 * @param {String} shipSpeed the shipping speed the user chose (e.g. 2 [days])
 * @return {String} the city of which the package is currently in (e.g. "San Jose")
 */
function getPackageLoc(start, end, orderDate, shipSpeed) {

   var orderStatus = getOrderStatus(orderDate, shipSpeed);
   if (orderStatus == "Preparing for shipment") {
      getCityName(start);
      return "getPackageLoc - preparing";
   } else if (orderStatus == "Delivered") {
      getCityName(end);
      return "getPackageLoc - delivered"
   } else {
      var currentX;
      var currentY;
      var diffX = Math.abs(start.x - end.x);
      var diffY = Math.abs(start.y - end.y);
      var percentDone = (shipSpeed - getDaysLeft(orderDate, shipSpeed)) / shipSpeed; // e.g. 1 day into 5 day shipping is 20%

      diffX = diffX * percentDone;
      diffY = diffY * percentDone;
      if (start.x > end.x) {
         currentX = start.x - diffX;
      } else {
         currentX = start.x + diffX;
      }
      if (start.y > end.y) {
         currentY = start.y - diffY;
      } else {
         currentY = start.y + diffY;
      }
      var currentLoc = new google.maps.Point(currentX, currentY);

      // need to retrieve cityname from getCityName and return it
      getCityName(currentLoc);
      return "getPackageLoc - intransit"
   }
}

/**
 * Gets the city with a given point
 * @param {google.maps.Point} start the point to search (e.g. 37.3351424, -121.8812758)
 * @return {String} the city of loc (e.g. "San Jose")
 */
function getCityName(loc) {

   var geocoder = new google.maps.Geocoder();;
   var latlng = new google.maps.LatLng(loc.x, loc.y);

   geocoder.geocode({
      'latLng': latlng
   }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
         if (results[1]) {
            for (var i = 0; i < results[0].address_components.length; i++) {
               for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                  if (results[0].address_components[i].types[b] == "locality") {
                     city = results[0].address_components[i];
                     break;
                  }
               }
            }
            alert("The package is currently in " + city.long_name);
            console.log(city.long_name);
            // alert(city.long_name)
            // need to return city.long_name somehow
         }
      }
   });
}

/**
 * Gets the amount of days left until package delivery
 * @param {String} orderDate the time the package was ordered(e.g. "October 13, 2015 11:13:00")
 * @param {String} shipSpeed the shipping speed the user chose (e.g. 2 [days])
 * @return {Number} the amount of days remaining
 */
function getDaysLeft(orderDate, shipSpeed) {
console.log(orderDate);
	var x = parseInt(shipSpeed)
   var deliveryDate = new Date(orderDate);
   deliveryDate.setDate(deliveryDate.getDate() + x);
   var daysRemaining = (deliveryDate - (new Date())) / (1000 * 60 * 60 * 24);
   daysRemaining = daysRemaining.toFixed(0);
  // console.log(daysRemaining);
   
   if(daysRemaining < 0){
		return "Already Delivered";
   }else if(daysRemaining < 1){
		return daysRemaining + " day";
   }
   
   return daysRemaining + " days";
}

/**
 * Gets the estimated date of delivery for a package
 * @param {String} orderDate the time the package was ordered(e.g. "October 13, 2015 11:13:00")
 * @param {String} shipSpeed the shipping speed the user chose (e.g. 2 [days])
 * @return {String} the ETA (e.g. Oct 15, 2015)
 */
function getDeliveryDate(orderDate, shipSpeed) {
   var deliveryDate = new Date(orderDate);
   deliveryDate.setDate(deliveryDate.getDate() + shipSpeed);
   var deliveryString = deliveryDate.toString();
   return deliveryString.substring(4, 10) + ", " + deliveryString.substring(11, 15);
}

/**
 * Gets the status of an order
 * @param {String} orderDate the time the package was ordered(e.g. "October 13, 2015 11:13:00")
 * @param {String} shipSpeed the shipping speed the user chose (e.g. 2 [days])
 * @return {String} status (preparing for shipment, in-transit, delivered)
 */
function getOrderStatus(orderDate, shipSpeed) {
   var orderDate = new Date(orderDate);
   var systemDate = new Date();
   var diff = systemDate - orderDate;
   diff = shipSpeed - (diff / (1000 * 60 * 60 * 24));

   if (shipSpeed - diff < 1) {
      return "Preparing for shipment"
   } else if (shipSpeed - diff < shipSpeed) {
      return "In-transit"
   } else {
      return "Delivered"
   }
}
	
    </script>
<script type="text/javascript">
</script>
</body>

</html>
