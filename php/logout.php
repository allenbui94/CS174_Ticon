<?php

session_start(); //start php session

unset($_SESSION["CurrentUser"]);
header("Location:../index.php");

?>