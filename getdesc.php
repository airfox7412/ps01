<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
header("Content-Type:text/html;charset=BIG5");
?>
<?php include "ewcfg0.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
	$scode = $_GET["scode"];
	$token1 = explode (";", $scode);	
	$count = count($token1);
	$conn = ew_Connect();
	$rdesc="";
	$d_sSql="";
	//echo $count;
	for($i=0; $i<$count-1 ; $i++){
		$sSql ="SELECT ReportCode,ReportDesc FROM report_code_desc ";
		$sSql.="WHERE reportCode='".$token1[$i]."'";	
		if($rs=$conn->Execute($sSql)){ //病歷簡碼換
			$rdesc.=$rs->fields('ReportDesc');
			$str1=$token1[$i+1];
			if(ereg("_",$rdesc)){ //比對字串 $rdesc 中是否包含 "_" 
				$rdesc=strchg($str1,$rdesc);
			}
			else{
				if($i<$count-2){ 
					$rdesc.="\r\n";
				}	
			}
		}
		$rs->Close();		
	}	//for
  echo $rdesc;
?>