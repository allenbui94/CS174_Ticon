<?php

$database = 'SAMPLE';
$user = 'db2admin';
$password = 'password';

$conn = db2_connect($database, $user, $password);
$_SESSION["connection"] = $conn;

?>