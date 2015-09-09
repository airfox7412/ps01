<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg50.php" ?>
<?php include "ewmysql50.php" ?>
<?php include "phpfn50.php" ?>
<?php include "CustomView1_info.php" ?>
<?php include "userfn50.php" ?>
<?php include "user_profile_info.php" ?>
<?php
$pno = @$_GET["pno"];
$pdate = @$_GET["pdate"];
if (@$_GET["rdesc"]<>""){
	$rdesc=$_GET["rdesc"];
}
$conn = ew_Connect();
$ColorArray=array("#ffff00","#77ff77","#00ffff","#77ffff","#ffff00","#ffff00","#77ff77","#00ffff","#77ffff","#ffff00");
?>
<html>
<head>
	<title>病歷明細</title>
	<meta http-equiv="Content-Type" content="text/html; charset=BIG5" />
	<link href="pacs.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="Scripts/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="Scripts/jquery-ui-1.7.2.js"></script>
	<script type="text/javascript" src="Scripts/thickbox.js"></script>
    <script type="text/javascript" src="Scripts/zoomfunc.js"></script>
<script type="text/javascript">   
var num=0;   
function show(imgid){   
  num=(num==3)?0:++num;
  document.getElementById(imgid).style.filter="progid:DXImageTransform.Microsoft.BasicImage(Rotation="+num+")";
}

function ChangeFunc(f){
	if (f==1) {
		$("#refbt").val("完整字詞");
		document.getElementById("refbt").onclick=function(){ChangeFunc(2)};
		}
	else {
		$("#refbt").val("包含字詞");
		document.getElementById("refbt").onclick=function(){ChangeFunc(1)};	
		}
	$.ajax({
			url: "chgdesc.php?ptype="+f+"&pno="+$("#pno").attr("value"),
			cache:false,
			error:function(xhr) {
				alert('載入錯誤！');
				},
			success:function(response){
				$("#desc").html(response);
				}
			});	
}
</script>
</head>
<body bgcolor="#000000">
<?php
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
//echo "<font color=#ffffff>".$sSql."</font><br>";
if ($rs = $conn->Execute($sSql)) {
		$rs->MoveFirst();	//繪製日期線條
		echo "<table width='100%' border='0'>";
		echo "<tr align='right'>";
		echo "<td width='50'><font size='2' color='#ffffff'>".date(Y)."-".date(m)."</font></td>";
		//$flen=0;
		$oldlen=0;
		$befor_all_dateduration="";
		for($x=0;$x<$rs->recordcount();$x++){
			$all_dateduration=$rs->fields('to_days(curdate())-to_days(examdate)');						
			$sql2="";
			if($oldlen==0) {
				$oldlen=$all_dateduration;
				$olen = ($oldlen / 365)-1;	
				if ($olen>=0) $oldlen = $oldlen % $olen;
				}
			else {
				$oldlen=$all_dateduration-$oldlen;
				if ($oldlen<=100) $oldlen=100;
				}
			echo "<td width='".$oldlen."' valign='top'>";
			echo "<hr width='100%' color='".$ColorArray[$x]."'/><font color='".$ColorArray[$x]."'>".$all_dateduration."天前</font></td>";
			$oldlen=$all_dateduration;
			$rs->MoveNext();
		}
		?>
        </tr></table>
		<input type="button" id="refbt" value="包含字詞" onClick="ChangeFunc(1);">        
		<input type="hidden" id="pno" value="<?php echo $pno;?>">
		<input type="hidden" id="pdate" value="<?php echo $pdate;?>">
        <div id="desc">
        <?php
		//------------------------------------------------------------------------------------------------------			
		$rs->MoveFirst();	//秀出Special code 顯示特殊字串與內容		
        echo "<table style='width:100%; border:0px solid;'>";
		for($x=0;$x<$rs->recordcount();$x++){	
			$memo1=$rs->fields('interpretationdiagnosisdescription');
			$examdate1=$rs->fields('examdate');
			$all_dateduration=$rs->fields('to_days(curdate())-to_days(examdate)');
        	echo "<tr><td width='100%' style='border:2px solid; border-color:".$ColorArray[$x]."'>";
			echo "<font color='".$ColorArray[$x]."'>".$all_dateduration."天前---</font>";
			$spSql="SELECT * FROM report_special_word";		
			if($spRS = $conn->Execute($spSql)){
				$spRS->MoveFirst();
				$c=0;
				$CodeArray[]="";
				$findInt=0;
				while (!$spRS->EOF){
					$sp_code=$spRS->fields('ReportSpecialCode');
					$sp_grade=$spRS->fields('ReportSpecialGrade');
					$sp_word=$spRS->fields('ReportSpecialWord');
					$sp_word=" ".$sp_word." ";
					//$sp_word=strtoupper(substr(trim($sp_word),0,1)).substr(trim($sp_word),1,(strlen(trim($sp_word))-1));
					if (stripos($memo1,$sp_word)!=false) {
						$CodeArray[$c]=$sp_code.$sp_grade."(".trim($spRS->fields('ReportSpecialWord')).") ";
						$c++;
						$findInt++;
						$memo1=str_ireplace($sp_word,"<font color='".$ColorArray[$findInt-1]."'>".$sp_word."</font>",$memo1);
						}
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
		echo "</table>"
		?>
        </div>
        <table border='0'>
        <?php
		//------------------------------------------------------------------------------------------------------
		$rs->MoveFirst();
		$r=0;
		while (!$rs->EOF){
			echo "<tr bgcolor='#000000'><td colspan='8'>";
			$id = $rs->fields('otherpatientids');
			$memo=$rs->fields('interpretationdiagnosisdescription');
			$pc=$rs->fields('createpart');
			$psoap=$rs->fields('soap');
			$examdate=$rs->fields('examdate');
			$dateduration=$rs->fields('to_days(curdate())-to_days(examdate)');
			$pid = $rs->fields('patientid');
			$pname = $rs->fields('patientname');
			$pbdate=$rs->fields('left(now(),4)-left(patientbirthdate,4)');
			$psex = $rs->fields('patientsex');
			$repno=$rs->fields('reportno');
					
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
					//$sp_word=strtolower($sp_word);
					if (stripos($memo,$sp_word)!=false) {
						$CodeArray[$c]=$sp_code.$sp_grade;	//判斷有無特殊字串
						$c++;
						$findInt++;
						}
					$spRS->MoveNext();
					}
				$spcode="";
				for($c=0;$c<count($CodeArray);$c++){
					$spcode.="<font color='".$ColorArray[$c]."'>".$CodeArray[$c]."</font>";
					$CodeArray[$c]="";
					}
			}
			$sql ="SELECT image_detail.reportno,image_detail.ImageDetailNo,file_path.ImageDetailNo,";
			$sql.="file_path.filepath,file_path.filename FROM image_detail,file_path ";
			$sql.="WHERE image_detail.ImageDetailNo=file_path.ImageDetailNo  ";
			$sql.="AND image_detail.reportno=".$repno;	
			echo "<table bgcolor='#000000' border='1' bordercolor='#ffffff'>";
			echo "<tr>";
			if ($rs1 = $conn->Execute($sql)) {		
				$rs1->MoveFirst();
				while(!$rs1->EOF){
					$fname=$rs1->fields('filename');
					$fname=substr($fname, 0, strlen($fname)-3)."jpg";
					$oimgfile="../".$rs1->fields('filepath').$fname;
					$imgfile=str_replace("\\","/",$oimgfile);
					if($i==0){
	?>
			<td>
            	<img src="<?php echo $imgfile ?>" width="560" height="650" border="1" name="img<?php echo $rs1->fields('filename'); ?>" id="<?php echo $rs1->fields('filename'); ?>" onmousewheel="return zoomPic('<?php echo $rs1->fields('filename'); ?>');" onClick="window.open('file_pathshow.php?filename=<?php echo $imgfile ?>','','top=0,left=50,width=1200,height=700,scrollbars=yes');">
			</td>
	<?php
						}
					else {
	?>
			<td>
				<img src="<?php echo $imgfile ?>" width="140" height="160" border="0" onClick="window.open('file_pathshow.php?filename=<?php echo $imgfile ?>','','top=0,left=50,width=1200,height=700,scrollbars=yes');">
			</td>
	<?php
						}
					$rs1->MoveNext();
					}	// while loop
				} // if
		if ($rs1) $rs1->Close();
?>		
					</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr bgcolor=#cccccc>
		  	<td width="8%" bgcolor="#333333"><font color="#FFFFFF"><?php echo $dateduration."-"; ?></font><?php echo $spcode; ?></td>
		  	<td width="8%"><?php echo $examdate; ?></td>
				<td width="15%"><?php echo $pc; ?></td>
				<td width="20%"><textarea name="psoap" rows="6" cols="34"><?php echo $psoap; ?></textarea></td>
				<td width="20%"><textarea name="psoap" rows="6" cols="34"><?php echo trim(trim($memo,"?")); ?></textarea></td>				
		<?php
		if($i==0){
		?>
				<td width="10%"><?php echo $pid.'   # '.$id; ?></td>
				<td align="center" width="5%"><?php echo $pname; ?></td>
				<td align="center" width="3%"><?php echo $pbdate; ?></td> 
				<td align="center" width="3%"><?php echo $psex; ?></td>
		</tr>
		<tr>
				<td colspan="7">
					<table>
						<tr>
							<td>
							<iframe width="800" height="200" scrolling="no" src="gerdesc_index.php?memo=<?echo $memo?>&pno=<?echo $pno?>&repno=<? echo $repno?>&pdate=<? echo $pdate ?>&serch_data=<?echo $serch_data?>"></iframe>
							<input type='button' value='上一筆' onClick="javascript:window.location.href='imagedetail_list.php?repno=<?php echo $repno?>&pno=<?php echo $serch_data_prev;?>&pdate=<?php echo $pdate?>';">
							<input type='button' value='下一筆' onClick="javascript:window.location.href='imagedetail_list.php?&repno=<?php echo $repno?>&pno=<?php echo $serch_data_next;?>&pdate=<?php echo $pdate?>';">
							</td>
						</tr>
					</table>
				</td>
			</tr>	
		<?php
				}
		else{
		?>
				<td colspan="4"></td>
		<?php	
				}
		$i=1;		
		$rs->MoveNext();
	} // while
?>	
		</table>
		</td>
	</tr>
</table>
<?php
} //if
?>
</body>
</html>
<?php
if ($rs) $rs->Close();
?>