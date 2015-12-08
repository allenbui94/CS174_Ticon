<?php
session_start();
$database = "sample";
require 'connection.php';
$customerID = $_SESSION['CustomerID'];

if (isset($_GET['productID'])) {
	$query = "INSERT INTO cart (" + $customerID + "," + $_GET['productID'] + ")";
	$stmt = db2_prepare($conn, $query);
	$result = db2_execute($stmt);
}
?>