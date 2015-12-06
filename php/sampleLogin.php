<?php

$error =''; 
$dbName = "srik@gmail.com";
$customerName = "Divya";  
$dbPass = "pass"; 



if(isset($_POST['submit'])){ 
  if(empty($_POST['email'])||empty($_POST['pwd'])){ 
	$error = "Email address or password is empty."; 
	echo "<h2>$error</h2>"; 
  } 
  else{  
	$email = $_POST['email']; 
	$pwd = $_POST['pwd']; 

	if($email == $dbName){ 
	  if($pwd == $dbPass){ 
		session_start(); 
		$_SESSION['CurrentUser']= $customerName;
		header("Location:../index.php");   
		exit;
	  } 	
	}
  } //else 
} //if isset
 

?>