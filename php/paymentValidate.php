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

//echo $shipping;

$sql = "insert into payment values('$customerID','$cardNumber','$cvc', '$expiration','$cardName','')";
$sql2 ="select cart.productID, product.price from cart join product on product.productID = cart.productID where customerID ='$customerID'";
$sql3 = "select count(orderID) from orderInfo";	

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
			$maxNumber= $row[0];
		} 
	}
	
	$orderID = strval(1000+$maxNumber+1);
	echo $orderID;
	//print_r($productID);
	
}

?>