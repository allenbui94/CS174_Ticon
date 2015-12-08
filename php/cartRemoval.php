<?php
session_start();
require 'connection.php';
//include '../cart.php';
//echo $testvar;

$customerID = $_SESSION['CustomerID'];	
$productID = $_GET['productID'];
echo "$customerID";
echo "$productID";

$sql = "delete from cart where customerID = '$customerID' and productID = '$productID' limit 1";
$stmt = db2_prepare($conn, $sql);	
$result = db2_execute($stmt);

header("Location: ../cart.php");
?>