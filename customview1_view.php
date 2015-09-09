<?php
if (@$_GET["dno"] <> "") {
	$dno=$_GET["dno"];
	$sdate=$_GET["sdate"];
	$sid=$_GET["sid"];
}
if (@$_GET["sid"] <> "") {
	$sdate=$_GET["sdate"];
	$sid=$_GET["sid"];
}
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "customview1_info.php" ?>
<?php include "userfn6.php" ?>
<?php
$conn = ew_Connect();

$sSql="SELECT * FROM img_para WHERE pid=1";
if ($rs = $conn->Execute($sSql)) {
	$rs->MoveFirst();
	if(!$rs->Eof()){
		$wo_position=$rs->fields('img_position');
		$wo_width=$rs->fields('img_width');
		$wo_height=$rs->fields('img_height');
	}
	$rs->Close();
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>檢視即時影像</title>
	<link rel="stylesheet" type="text/css" href="ps02.css">
    <meta http-equiv="Content-Type" content="text/html; charset=BIG5" />

<script language="JavaScript" type="text/javascript">
function showimg(img,p){
var url='showimg.php?img='+img+'&bp='+p;
var para='width=<?php echo $wo_width; ?>,height=<?php echo $wo_height; ?>,top=0,left=<?php echo $wo_position; ?>,toolbar=no,menubar=no, scrollbars=yes,resizable=yes,location=no,status=no';
window.open(url,'showimage',para);
}
</script>	
</head>
<body topmargin="0" leftmargin="0" bgcolor="#000000">
<a href="customview1_list.php">Back to List</a><BR>
<?php
if ($dno<>''){
	$sSql="SELECT DetailNo,StudyID,Status FROM patient_detail WHERE DetailNo=".$dno." AND Status='N'";
	if ($rs = $conn->Execute($sSql)) {
		$rs->MoveFirst();
		if (!$rs->EOF){		
			$sid=$rs->fields('StudyID');
			$sflag=1;	
		}
		else {
			$sflag=0;
		}
		$rs->Close();
	}	
}
$sSql="SELECT * FROM patient_detail a, patient_main b ";
$sSql.="WHERE a.PatientID=b.PatientID AND a.StudyID=".$sid;
if ($rs = $conn->Execute($sSql)) {
	$rs->MoveFirst();
	if (!$rs->EOF){
		$DetailNo=$rs->fields('DetailNo');
		$StudyID=$rs->fields('StudyID');
		$PatientID=$rs->fields('PatientID');
		$PatientName=$rs->fields('PatientName');
		$PatientBirthDate=$rs->fields('PatientBirthDate');
		$PatientAge=date(Y)-left($PatientBirthDate,4);
		$PatientSex=$rs->fields('PatientSex');
		$StudyDate=$rs->fields('StudyDate');
		$StudyTime=$rs->fields('StudyTime');
		$Modality=$rs->fields('Modality');
		$BodyPartExamined=$rs->fields('BodyPartExamined');
		$ProtocolName=$rs->fields('ProtocolName');
		$InstanceNumber=$rs->fields('InstanceNumber');
		$Status=$rs->fields('Status');
		if ($Status=='Y'){
			$Status="<font color='#00ff00'>".$Status."</font>";
			}
		else{
			$Status="<font color='#ff0000'>".$Status."</font>";
			}	
	}	
?>
<table>
	<tr valign="top">
    	<td align="left">
        <table bgcolor="#111111" height="245">
            <tr>
                <td><span class="nfont">病歷號碼：</span></td>
                <td><span class="vfont"><?php echo $PatientID; ?></span></td>
            </tr>
            <tr>
                <td><span class="nfont">病歷日期：</span></td>
                <td><span class="vfont"><?php echo $StudyDate." ".$StudyTime; ?></span></td>
            </tr>
            <tr>
                <td><span class="nfont">病患姓名：</span></td>
                <td><span class="vfont"><?php echo $PatientName; ?></span></td>
            </tr>
            <tr>
                <td><span class="nfont">病患姓別：</span></td>
                <td><span class="vfont"><?php echo $PatientSex; ?></span></td>
            </tr>
            <tr>
                <td><span class="nfont">病患年齡：</span></td>
                <td><span class="vfont"><?php echo $PatientAge; ?></span></td>
            </tr>
            <tr>
                <td><span class="nfont">檢查序號：</span></td>
                <td><span class="vfont"><?php echo $StudyID; ?></span></td>
            </tr>
            <tr>
                <td><span class="nfont">處理狀態：</span></td>
                <td><span class="vfont"><?php echo $Status; ?></span></td>
            </tr>
        </table>
        </td>
        <td align="left">
        	<table align="left">
            	<tr>
        	<?php
			$rs->MoveFirst();
			while (!$rs->EOF){
				$image=$rs->fields('image');
				$BodyPartExamined=$rs->fields('BodyPartExamined');
				$ProtocolName=$rs->fields('ProtocolName');
        	?>
            	<td bgcolor="#333333"><img src="/pacsimages/pacs01/<?php echo $image; ?>" width="203" height="245" border="1" onclick="javascript:showimg('<?php echo $image; ?>','<?php echo $BodyPartExamined.' '.$ProtocolName; ?>');"><br>
<span class="vfont"><?php echo $BodyPartExamined.' '.$ProtocolName; ?></span>
</td>
            <?php    
			    $rs->MoveNext();
			}
			?>
            </tr>
            </table>	
        </td>
    </tr>
    <tr>
    	<td colspan="2" width="100%">
        	<iframe width="800" height="200" scrolling="no" src="gerdesc_index.php?sid=<?php echo $sid?>"></iframe>
			<?php if($sflag=1){ ?>
							<input type='button' value='上一筆' id="btnprev" onclick="window.location.href='customview1_view.php?sdate=<?php echo $sdate; ?>&cmd=prev&dno=<?php echo $DetailNo-1; ?>'">
			<?php } ?>
			<?php if($sflag=1){ ?>
							<input type='button' value='下一筆' id="btnnext" onClick="window.location.href='customview1_view.php?sdate=<?php echo $sdate; ?>&cmd=next&dno=<?php echo $DetailNo+1; ?>'">
			<?php } ?>
        </td>
    </tr>
</table>
<?php		
		
}		
?>
</body>
</html>
<?php
function right($value, $count){
    return substr($value, ($count*-1));
}

function left($string, $count){
    return substr($string, 0, $count);
}
?>