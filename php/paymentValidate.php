<?php
session_start();
require 'connection.php';
//include '../cart.php';
//echo $testvar;
$maxNumber = 0; 
$orderID = "";
$customerID = $_SESSION['CustomerID'];
$shipping = $_SESSION['shipSpeed'];
$cardName = $_POST['cardName'];
$cardNumber = $_POST['cardNumber'];
$cvc = $_POST['cvc'];
$month = $_POST['month'];
$year = $_POST['year'];
$expiration = $month .  "/" . $year;

$productID = array();
$productPrice = array();

$cProductID = "";

$subtotal = 0.000;
$subtotals = array();
$total = 0.00;
//echo $shipping;

$sql = "insert into payment values('$customerID','$cardNumber','$cvc', '$expiration','$cardName','')";
$sql2 ="select cart.productID, product.price from cart join product on product.productID = cart.productID where customerID ='$customerID'";
$sql3 = "select count(orderID) from orderInfo";	
//need a for loop to store all orderedItems 

$stmt = db2_prepare($conn, $sql);	

if ($stmt) {	
	$result = db2_execute($stmt);
	$stmt = db2_prepare($conn, $sql2);	
	if ($stmt) {
		$result = db2_execute($stmt);
			while ($row = db2_fetch_array($stmt)) {	
				array_push($productID, $row[0]);
				array_push($productPrice, $row[1]);	
		}
	}
	
	$stmt = db2_prepare($conn, $sql3);	
	if ($stmt) {
		$result = db2_execute($stmt);
		while($row = db2_fetch_array($stmt)){
			$maxNumber = $row[0];			
		} 
	}	
	$orderID = strval(1000+$maxNumber+1);
	
	
	for ($i = 0; $i < count($productID); $i++) {
		//echo $productID[$i];
		$sql4 = "insert into orderedItems values('$orderID','$productID[$i]')";
		$stmt = db2_prepare($conn, $sql4);
		$result = db2_execute($stmt);
	}
	
	for ($i = 0; $i < count($productID); $i++) {
		//echo $productID[$i];
		$sql5 = "update warehouse set quantity = quantity -1 where productID = '$productID[$i]'";
		$stmt = db2_prepare($conn, $sql5);
		$result = db2_execute($stmt);
	}

	$shippingCost = 0;
	if ($shipping=2){
		$shippingCost = 6.95;
	}
	else if ($shipping=5){
		$shippingCost = 5.95;
	}else{
		$shippingCost = 0;
	}
	
	for ($i = 0; $i < count($productID); $i++) {
		$sql6 = "select price from product where productID = '$productID[$i]'";
		$stmt = db2_prepare($conn, $sql6);
		$result = db2_execute($stmt);
		while($row = db2_fetch_array($stmt)){
			$subtotals = $row[0];	
			$subtotal = $subtotal + (double)$subtotals;
		}
	}
	$tax = $subtotal * 0.07;
	
	$total = $subtotal + $tax + $shippingCost;
	date_default_timezone_set('America/Los_Angeles');
	$today = date("F j, Y H:i");   
	echo $today;
	
	$sql7 = "insert into orderInfo values('$orderID','$customerID','$total','$subtotal','$shipping','$shippingCost','$tax','$today')";
	$stmt = db2_prepare($conn, $sql7);	
	$result = db2_execute($stmt);
}

?>