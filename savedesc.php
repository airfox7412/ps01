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
		//$rdesc=str_replace("&"," and ",$Allmemo);	
		//$Allmemo=rawurldecode($Allmemo); //從 URL 專用格式字串還原成普通字串。
		$Allmemo=iconv("UTF-8","BIG5",$Allmemo);
		$sSql1 = "SELECT * FROM exam_data WHERE StudyID='".$sid."'";
		$sSql.=$sSql1."->\r\n";
		
		$rs = $conn->Execute($sSql1);
		$rs->MoveFirst();
		if (!$rs->EOF){
			$sSql2="UPDATE exam_data SET Memo1='".$Allmemo."', examdate='".$exdate."', examtime='".$extime."' where StudyID='".$sid."'";
		}
		else{
			$sSql2="INSERT INTO exam_data (StudyID,Memo1,examdate,examtime) VALUES('".$sid."','".$Allmemo."','".$exdate."','".$extime."')";
		}	
	  $sSql.=$sSql2."->\r\n";	
		$conn->Execute($sSql2);
	
		$sSql3 = "UPDATE patient_detail SET Status='Y' WHERE StudyID='".$sid."'";
		$sSql.=$sSql3."->\r\n";
		$conn->Execute($sSql3);
		
		$sSql1 = "SELECT * FROM exam_data WHERE StudyID='".$sid."'";
		$sSql.=$sSql1."->\r\n";	
		$rs = $conn->Execute($sSql1);
		$rs->MoveFirst();
		if (!$rs->EOF){
			$Allmemo=$rs->fields('memo1');
		}
	}
	else{
		$sSql1 = "SELECT * FROM exam_data WHERE StudyID='".$sid."'";
		$rs = $conn->Execute($sSql1);
		$rs->MoveFirst();
		if (!$rs->EOF)
			$sSql2="UPDATE exam_data SET Memo1='".Trim($Allmemo)."', examdate='".$exdate."', examtime='".$extime."' where StudyID='".$sid."'";
		else
			$sSql2="INSERT INTO exam_data (StudyID,Memo1,examdate,examtime) VALUES('".$sid."','".Trim($Allmemo)."','".$exdate."','".$extime."')";
		$conn->Execute($sSql2);
		$sSql3 = "UPDATE patient_detail SET Status='N' WHERE StudyID='".$sid."'";
		$conn->Execute($sSql3);
	}			
	echo $Allmemo;
?>