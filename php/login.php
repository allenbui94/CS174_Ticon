<?php
require 'connection.php';
session_start(); //start php session
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
?>