<?php
    include_once('connection.php');
	
    $firstName =$_POST['firstName'];
    $lastName =$_POST['lastName'];
	$street =$_POST['street'];
	$city =$_POST['city'];
	$state =$_POST['state'];
	$zip =$_POST['zip'];
	$country =$_POST['country'];
    $email =$_POST['email'];
	$password =$_POST['password'];
    $phone =$_POST['phone'];
	$id = 100000;
	
	$maxCustomerID = db2_execute("SELECT max(id) from customer");
	
	if($maxCustomerID == $id){
		$id += 1;
	}
	else if($maxCustomerID == null){
		$id = 100000;
	}
	
    if(db2_execute("INSERT INTO `customer` (`firstName`, `lastName`, `street`, `city`, `state`, `zip`, `country`, `email`, `password`, `phone`, `id`) VALUES ('".$firstName."', '".$lastName."', '".$street."', '".$city."', '".$state."', '".$zip."', '".$country."', '".$email."', '".$password."', '".$phone."', '".$id."')"))
    { 
    echo"successfully inserted"; 
	header(Location:"login.php"); 	
	}
    else
    echo "failed";
?>