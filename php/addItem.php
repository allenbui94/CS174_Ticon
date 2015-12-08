<?php
session_start();
require 'connection.php';
//include '../cart.php';
//echo $testvar;

$customerID = $_SESSION['CustomerID'];	
$productID = $_GET['productID'];

$sql = "insert into cart values('$customerID', '$productID')";
$stmt = db2_prepare($conn, $sql);	
$result = db2_execute($stmt);

header("Location: ../cart.php");
?>