<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering

@session_destroy();
if (@$_SESSION['level']=='0') {
	$url="logindoc.php";
}
else{
  $url="login.php";
}
header("Location: $url");
?>
