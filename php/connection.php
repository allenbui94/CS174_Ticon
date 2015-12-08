<?php
$database = "SAMPLE";
$user = "";
$pass = "";
$conn = db2_connect($database, $user, $pass);
$_SESSION["connection"] = $conn;
?>