<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
	$sid=$_GET["sid"];
	$sno=$_GET["sno"];
	$x=$_GET["x"];
	$y=$_GET["y"];
	
	$conn = ew_Connect();
	$sSql="UPDATE patient_detail SET x_axis=".$x.", y_axis=".$y." ";
	$sSql.="WHERE StudyID='".$sid."' AND SeriesNumber='".$sno."'";
	$conn->Execute($sSql);
	echo "座標儲存";
?> 