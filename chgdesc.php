<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php header('Content-type: text/html;charset=BIG5'); ?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
$ptype = @$_GET["ptype"];
$pno = @$_GET["pno"];

$conn = ew_Connect();
$ColorArray=array("#ffff00","#77ff77","#00ffff","#77ffff","#ffff00","#ffff00","#77ff77","#00ffff","#77ffff","#ffff00");
$sSql ="select to_days(curdate())-to_days(examdate),left(now(),4)-left(patientbirthdate,4),";
$sSql.="otherpatientids,exam_data.patientmainno,patient_main.patientmainno,patient_main.patientid,";
$sSql.="report.reportno,interpretationdiagnosisdescription,image_detail.patientid,soap,requestdoctorid,";
$sSql.="createpart,examdate,filepath,filename,patientname,patientbirthdate,patientsex from patient_main, report ,image_detail ,exam_data ,file_path ";
$sSql.="where report.reportno=image_detail.reportno ";
$sSql.="and image_detail.AccessionNumber=exam_data.accessionnumber ";
$sSql.="and image_detail.ImageDetailNo=file_path.imagedetailno ";
$sSql.="and exam_data.patientmainno=patient_main.patientmainno ";
$sSql.="and exam_data.patientmainno like '".$pno."' ";
$sSql.="group by reportno ";
$sSql.="order by examdate desc";
if ($rs = $conn->Execute($sSql)) {
    echo "<table style='width:100%; border:0px solid;'>";			
		$rs->MoveFirst();
		for($x=0;$x<$rs->recordcount();$x++){	
			$memo1=$rs->fields('interpretationdiagnosisdescription');
			$examdate1=$rs->fields('examdate');
			$all_dateduration=$rs->fields('to_days(curdate())-to_days(examdate)');
        	echo "<tr><td width='100%' style='border:2px solid; border-color:".$ColorArray[$x]."'>";
			echo "<font color='".$ColorArray[$x]."'>".$all_dateduration."¤Ñ«e---</font>";
			$spSql="SELECT * FROM report_special_word";		
			if($spRS = $conn->Execute($spSql)){
				$spRS->MoveFirst();
				$c=0;
				$CodeArray[]="";
				$findInt=0;
				while (!$spRS->EOF){
					$sp_code=$spRS->fields('ReportSpecialCode');
					$sp_grade=$spRS->fields('ReportSpecialGrade');
					$sp_word=" ".$spRS->fields('ReportSpecialWord')." ";
					if ($ptype=="1") $sp_word=trim(strtolower($sp_word));
					if (stripos($memo1,$sp_word)!=false) {
						$CodeArray[$c]=$sp_code.$sp_grade."(".trim($sp_word).") ";
						$c++;
						$findInt++;
						$memo1=str_ireplace($sp_word,"<font color='".$ColorArray[$findInt-1]."'>".$sp_word."</font>",$memo1);
						}
					//$sp_word=strtoupper(substr(trim($sp_word),0,1)).substr(trim($sp_word),1,(strlen(trim($sp_word))-1));
					$sp_word=" ".trim($sp_word)."s ";
					if (stripos($memo1,$sp_word)!=false) {
						$CodeArray[$c]=$sp_code.$sp_grade."(".trim($spRS->fields('ReportSpecialWord')).") ";
						$c++;
						$findInt++;
						$memo1=str_ireplace($sp_word,"<font color='".$ColorArray[$findInt-1]."'>".$sp_word."</font>",$memo1);
						}
					$spRS->MoveNext();
					}
				echo "<font color='#ffff00'>";
				for($c=0;$c<count($CodeArray);$c++){
					echo "<font color='".$ColorArray[$c]."'>".$CodeArray[$c]."</font>";
					$CodeArray[$c]="";
					}	
				echo "</font>";
			}
			if ($findInt!=0) echo "<br><font color='#ffffff'>&nbsp;&nbsp;".$memo1."</font>";
			echo "</td></tr>";
			$rs->MoveNext();
		}
		echo "</table>";
}
if ($rs) $rs->Close();
?>