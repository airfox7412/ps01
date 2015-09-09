<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
header("Content-Type:text/html;charset=BIG5");
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php	
	$sid = $_POST["sid"];
	$Allmemo = urldecode($_POST["memo"]);
	$exdate = date("Y-m-d");
	$extime = date("H:i:s");
	$sSql="";
	$conn = ew_Connect();
	if (Trim($Allmemo)!=''){
		$Allmemo=iconv("UTF-8","BIG5",$Allmemo);
		$sSql1 = "SELECT * FROM exam_data WHERE StudyID='".$sid."'";
		$rs = $conn->Execute($sSql1);
		$rs->MoveFirst();
		if (!$rs->EOF){
			$sSql2="UPDATE exam_data SET AdditionalPatientHistory='".$Allmemo."' where StudyID='".$sid."'";
		}
		else{
			$sSql2="INSERT INTO exam_data (StudyID,AdditionalPatientHistory) VALUE('".$sid."','".$Allmemo."')";
		}
		$conn->Execute($sSql2);
	}
	else{
		$sSql1 = "SELECT * FROM exam_data WHERE StudyID='".$sid."'";
		$rs = $conn->Execute($sSql1);
		$rs->MoveFirst();
		if (!$rs->EOF){
			$sSql2="UPDATE exam_data SET AdditionalPatientHistory='".Trim($Allmemo)."' where StudyID='".$sid."'";
		}
		else{
			$sSql2="INSERT INTO exam_data (StudyID,AdditionalPatientHistory) VALUE('".$sid."','".Trim($Allmemo)."')";
		}
		$conn->Execute($sSql2);
	}
	//echo '儲存成功！';
?>