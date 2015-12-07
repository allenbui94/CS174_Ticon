<?php

session_start();    
require 'connection.php'; 
 

if(isset($_POST['submit'])){ 
	
    	$firstName =$_POST['firstName'];
    	$lastName =$_POST['lastName'];
	$street =$_POST['street'];
	$city =$_POST['city'];
	$state =$_POST['state'];
	$zip =$_POST['zip'];
	$country =$_POST['country'];
    	$email =$_POST['email'];
	$pwd =$_POST['pwd'];
   	$phone =$_POST['phone'];
	
	//echo $firstName." ".$lastName." ".$street." ".$city." ".$state." ".$zip." ".$country." ".$email." ".$pwd." ".$phone;
$successMsg =$firstName." ".$lastName.", you have have been registered! Please Signin!";
$id = " "; 	
$maxNumber = 0; 

   try{ 	
	$conn = db2_connect($database,$user,$pass); 

       }catch(Exception $e){ 
	   echo "Exception: ".$e->getMessage();
       } 	
	
	if($conn){ 
		$sql1 = "select count(id) from customer";	
		$stmt = db2_prepare($conn,$sql1);
		

	   if($stmt){ 
		
		$result = db2_execute($stmt); 
		while($row = db2_fetch_array($stmt)){
			$maxNumber= $row[0];
		} //---while 
 

	   }//--$stmt
	   else{ 
		
		echo "maxNumber wasn't executed"; 
		
	   } 

	   $id = strval(100000+$maxNumber+1);
	   	
	   $sql2 = "insert into customer values('$id','$firstName','$lastName','$street','$city','$state','$zip','$country','$email','$pwd','$phone')"; 
 	   $stmt2 = db2_prepare($conn,$sql2); 

	   if($stmt2){ 
		
		$result = db2_execute($stmt2);

	     if($result){ 
		$_SESSION['newUserMsg'] = $successMsg;
		header('Location:../login.php');
		exit; 
	     }	

	   }//--$stmt2
	   else{ 
		
		$_SESSION['failedRegMsg'] = 'We were unable to register you, please check to see that you have filled in all areas properly!'; 
		header('Location:../signup.php');
	   }  	

	}//--$conn

	else{ 

	  echo db2_conn_error()."<br>";
	  echo db2_conn_errormsg()."<br>";
	  echo "Connection failed.<br>";

      } //--else $conn	
} //--$isset
?>