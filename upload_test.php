<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
if(isset($_FILES["myfile"])) {
  $datetime = date("Y-m-d H:i:s");  
	$ret = array();
	$error =$_FILES["myfile"]["error"];
  $conn = ew_Connect();
  $output_dir="dicoms/";
  
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData()
	
	if(!is_array($_FILES["myfile"]["name"])) { //single file
 	 	$fileName = $_FILES["myfile"]["name"];
 	 	//$randName=strval(rand(10000000,99999999)).".dcm";
	  $outputfile=$output_dir.$fileName;
		move_uploaded_file($_FILES["myfile"]["tmp_name"],$outputfile);
    $ret[]= $fileName;
	}
	else { //Multiple files, file[]
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i<$fileCount; $i++){
	  	$fileName = $_FILES["myfile"]["name"][$i];
 	 	  $randName=strval(rand(10000000,99999999)).".dcm";
	  	$outputfile=$output_dir.$randName;
			move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$outputfile);
	  	$ret[]= $randName;
	  }
	}
	echo json_encode($ret);
 }
 ?>