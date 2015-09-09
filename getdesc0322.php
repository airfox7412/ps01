<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
$act = $_POST["act"];
if($act=='Q'){
	$sid = $_POST["sid"];
	$scode = $_POST["scode"];
	$memo = $_POST["ExamMemo"];
	$token1 = explode (";", $scode);	
	$count = count($token1);
	$conn = ew_Connect();
	$rdesc="";

	for($i=0; $i<$count-1 ; $i++){
		//$sSql ="SELECT ReportCode,replace(ReportDesc,'____',' ".$token1[$i+1]."') as RD FROM report_code_desc ";
		$sSql ="SELECT ReportCode,ReportDesc FROM report_code_desc ";
		$sSql.="WHERE reportCode='".$token1[$i]."'";
		//echo $sSql."<br>";
		//¯f¾úÂ²½X´«
		if ($rs = $conn->Execute($sSql)) {
			//$rdesc.="<br>".$rs->fields('RD');
			$rdesc.="\n".$rs->fields('ReportDesc');
			$rdesc=str_replace("_____"," ".$token1[$i+1],$rdesc);
			$rdesc=str_replace("____"," ".$token1[$i+1],$rdesc);
			$rdesc=str_replace("___"," ".$token1[$i+1],$rdesc);
			}
		$rs->Close();	
	}	//for
	//echo $memo."<br>";
	//echo $rdesc;
	$all_memo=urlencode($memo."\n".$rdesc);
	$url_rdesc=urlencode($rdesc);
	if ($rs) $rs->Close();
}
$url="DetailView_Edit.php?sid=".$sid."&memo=".$all_memo."&rdesc=".$url_rdesc."&act=G";
//echo $url;
echo "<script>window.location.href='".$url."';</script>";
//header("Location:".$url);
?>