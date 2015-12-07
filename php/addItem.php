<?php
session_start();
$database = "sample";
$user = "";
$pass = "";
$conn = db2_connect($database, $user, $pass);
$customerID = $_SESSION['CustomerID'];

if (isset($_GET['productID'])) {
	$query = "INSERT INTO cart (" + $customerID + "," + $_GET['productID'] + ")";
	$stmt = db2_prepare($conn, $query);
	$result = db2_execute($stmt);
}
?>