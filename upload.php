<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
if(isset($_FILES["myfile"])) {
	$_SESSION['dbname']=EW_CONN_DB;
	$dbname="uploads/".$_SESSION['dbname'];
	if(!is_dir($dbname)){
		if (!mkdir($dbname, 0777)){
			echo "目錄建立失敗<br>";
		}
	}
  $datetime = date("Y-m-d H:i:s");  
	$ret = array();
	$error =$_FILES["myfile"]["error"];
  $conn = ew_Connect();
  $output_dir="uploads/".$_SESSION['dbname']."/";
  
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData()
	
	if(!is_array($_FILES["myfile"]["name"])) { //single file
 	 	$fileName = $_FILES["myfile"]["name"];
 	 	$randName=strval(rand(10000000,99999999)).".dcm";
	  $outputfile=$output_dir.$randName;
		move_uploaded_file($_FILES["myfile"]["tmp_name"],$outputfile);
    $ret[]= $randName;
    
    $sSql="INSERT INTO import_log (sname,fname,idatetime,status) VALUES('".$fileName."','".$outputfile."','".$datetime."','N')";
	  $conn->Execute($sSql);
	}
	else { //Multiple files, file[]
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i<$fileCount; $i++){
	  	$fileName = $_FILES["myfile"]["name"][$i];
 	 	  $randName=strval(rand(10000000,99999999)).".dcm";
	  	$outputfile=$output_dir.$randName;
			move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$outputfile);
	  	$ret[]= $randName;
    
	    $sSql="INSERT INTO import_log (sname,fname,idatetime,status) VALUES('".$fileName."','".$outputfile."','".$datetime."','N')";
		  $conn->Execute($sSql);
	  }
	}
	$conn->Close();
	echo json_encode($ret);
 }
 ?>