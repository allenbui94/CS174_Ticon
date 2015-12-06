<?php

require 'connection.php'; 


session_start(); //start php session
$error =''; 
$failedLogin = 'Username or Password is invalid.';

if(isset($_POST['submit'])){ 
  if(empty($_POST['email'])||empty($_POST['pwd'])){ 
	$error = "Email address or password is empty.";
	$_SESSION['ErrorMsgEmpty']=$error; 
	header('Location:../login.php');	
  } 
  else{  

	$email = $_POST['email']; 
	$pwd = $_POST['pwd']; 


	//connect to db2
	
	try{ 
		$conn = db2_connect($database,$user,$pass);

	}catch(Exception $e){ 
		echo "Exception: ".$e->getMessage(); 
	}

	
	if($conn){ 
	   
	   $sql = "select * from customer where email = '$email' AND password ='$pwd' ";  
	   $stmt = db2_prepare($conn,$sql); 
  
	   if($stmt){ 
		$result = db2_execute($stmt); 	   

	   }
 	   else{
		$_SESSION['failedLoginMsg']=$failedLogin; 
		header('Location:../login.php');  
	   }
	   $numRows = 0;
	   $customerName="";  
	   while($row = db2_fetch_array($stmt)){
		$numRows += 1;
		 $customerName= $row[1]." ".$row[2]; 
		 /* echo $row[0]. " ".$row[1]." ".$row[2];
		 echo '<br>'; */ 
	 
	   }
	   
	   if($numRows == 1){
		//echo 'true'; 
		 $_SESSION['CurrentUser'] = $customerName;
		 $_SESSION['SuccessMsg'] = 'Welcome, '.$customerName.'. You have been successfully logged in!';
		 header('Location:../index.php');
		 exit;  
	   } 	  

	   else{ 
		$_SESSION['failedLoginMsg']=$failedLogin;
		header('Location:../login.php');  
			
	   } 


	}
      else{ 
	echo db2_conn_error()."<br>";
	echo db2_conn_errormsg()."<br>";
	echo "Connection failed.<br>";
      } 	 
	

  } //else 
} //if isset




?>