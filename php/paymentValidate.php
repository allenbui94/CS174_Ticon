<?php
session_start();
require 'connection.php';

$customerID = $_SESSION['CustomerID'];
$cardName = $_POST['cardName'];
$cardNumber = $_POST['cardNumber'];
$cvc = $_POST['cvc'];
$month = $_POST['month'];
$year = $_POST['year'];
$expiration = $month .  "/" . $year;
echo $expiration;


$sql = "insert into payment values('$customerID','$cardNumber','$cvc', '$expiration','$cardName','')";
$sql2 ="";
	$stmt = db2_prepare($conn, $sql);	

	if ($stmt) {
		$result = db2_execute($stmt);
	}
	
	else {
		echo "error";
	}

?>