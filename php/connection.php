<?php
$database = "SAMPLE";
$user = "db2admin";
$pass = "admin";
$conn = db2_connect($database, $user, $pass);
$_SESSION["connection"] = $conn;
?>