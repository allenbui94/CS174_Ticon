<?php
$database = "sample";
$user = "";
$pass = "";
$conn = db2_connect($database, $user, $pass);
$productID = $_GET['productID'];

$id = array();
$name = array();
$price = array();
$description = array();
$category = array();
$tagSpecific = array();

if ($productID != "") {
echo $productID;	
$sql = "SELECT name, price, description, category, tagSpecific FROM product WHERE productID = '" . $productID . "'";

	$stmt = db2_prepare($conn, $sql);	

	if ($stmt) {
		$result = db2_execute($stmt);
		
		if (!$result)
		{
			echo "error";
		}
		while ($row = db2_fetch_array($stmt)) {
			//array_push($id, $row[0]);
   			array_push($name, $row[0]);
   			array_push($price, $row[1]);
   			array_push($description, $row[2]);
   			array_push($category, $row[3]);
   			array_push($tagSpecific, $row[4]);
		}	
		print_r($name);
		print_r($price);
		print_r($description);
		print_r($category);
		print_r($tagSpecific);
		db2_close($conn);
	}
	
	else {
		echo "error";
	}
}

?>