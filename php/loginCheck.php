<?php
require 'connection.php';
session_start(); //start php session
<<<<<<< HEAD:php/loginCheck.php
$error =''; 

if(isset($_POST['submit'])){ 
  if(empty($_POST['email'])||empty($_POST['pwd'])){ 
	$error = "Email address or password is empty."; 
	echo "<h2> $error</h2>";
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
		echo "Error signing in. Username or Password is incorrect";  
	   }
	   $numRows = 0;
	   $customerName="";  
	   while($row = db2_fetch_array($stmt)){
		$numRows += 1;
		 $customerName= $row['firstName']." ".$row['lastName']; 	 
	   }
	   
	   if($numRows == 1){
		echo 'true'; 
		 $_SESSION['CurrentUser'] = $customerName;  
	   } 	  

	   else{ 
		echo 'false';	
	   } 


	}
      else{ 
	echo db2_conn_error()."<br>";
	echo db2_conn_errormsg()."<br>";
	echo "Connection failed.<br>";
      } 	 
	

  } //else 
} //if isset




=======
$error = '';
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['pwd'])) {
        $error = "Email address or password is invalid";
    } else {
        $email = $_POST['email'];
        $pwd   = $_POST['pwd'];
        //connect to db2
        try {
            $conn = db2_connect($database, $user, $pass);
        }
        catch (Exception $e) {
            echo "Exception: " . $e->getMessage();
        }
        if ($conn) {
            $sql  = "select * from customer where email = '$email' AND password ='$pwd' ";
            $stmt = db2_prepare($conn, $sql);
            if ($stmt) {
                $result = db2_execute($stmt);
            } else {
                echo "Statement didn't execute";
            }
            $numRows = 0;
            while ($row = db2_fetch_array($stmt)) {
                $numRows += 1;
            }
            if ($numRows == 1) {
                $_SESSION['userName'] = '';
            }
        }
    }
}
>>>>>>> origin/master:php/login.php
?>