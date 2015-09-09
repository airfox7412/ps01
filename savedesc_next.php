<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
$act = $_POST["act"];
if($act=='S'){
	$sid = $_POST["sid"];
	$memo = $_POST["ExamMemo"];
	$rdesc = $_POST["rdesc"];
	$exdate = date("Y-m-d");
	$extime = date("H:i:s");
	//$Allmemo=str_replace("\r\n","<br>",$memo.$rdesc);
	//$Allmemo=$memo.$rdesc;
	$Allmemo=$memo;
	$conn = ew_Connect();
	$sSql1 = "SELECT StudyID FROM exam_data WHERE StudyID='".$sid."'";
	if ($rs = $conn->Execute($sSql1)){
		$rs->MoveFirst();
		if (!$rs->EOF){
			$sSql2 ="UPDATE exam_data set Memo1='".$Allmemo."', examdate='".$exdate."', examtime='".$extime."' where StudyID='".$sid."'";
		}
		else{
			$sSql2 ="INSERT INTO exam_data (StudyID,Memo1,examdate,examtime) VALUE('".$sid."','".$Allmemo."','".$exdate."','".$extime."')";
		}
	$conn->Execute($sSql2);
	$sSql1 = "UPDATE patient_detail SET Status='Y' WHERE StudyID='".$sid."'";
	$conn->Execute($sSql1);
	//echo $sSql2."<br>".$sSql1;	
	}	
}
$url="DetailView_Edit.php?cmd=next";
echo $url;
//header("Location:".$url);
echo "<script>window.location.href='".$url."';</script>";
?>