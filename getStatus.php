<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
header("Content-Type:text/html;charset=BIG5");
$_SESSION['hospital']=$_GET["m"];
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
	$conn = ew_Connect();
	$sSql ="SELECT memo1 FROM exam_data WHERE (memo1 is Null)and(studyid<>'')";
	$rtn="N";	
	if($rs=$conn->Execute($sSql)){
		$rs->MoveFirst();
		if(!$rs->EOF){
			$rtn="Y";
		}
	}	
	$rs->Close();
echo $rtn;
?>