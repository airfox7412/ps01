<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

$conn = ew_Connect();
if (@$_POST["a_edit"]<>'') {
	$wo_position=$_POST["wo_position"];	
	$wo_width=$_POST["wo_width"];	
	$wo_height=$_POST["wo_height"];
	$wo_rota=$_POST["wo_rota"];
	$wo_count=$_POST["wo_count"];
	$sSql="UPDATE img_para SET img_position=".$wo_position.",img_width=".$wo_width.",img_height=".$wo_height.",img_rota=".$wo_rota.",img_count=".$wo_count." WHERE pid=1";
	$conn->Execute($sSql);
}
else{
	$sSql="SELECT * FROM img_para WHERE pid=1";
	if ($rs = $conn->Execute($sSql)) {
		$rs->MoveFirst();
		if(!$rs->Eof()){
			$wo_position=trim($rs->Fields('img_position'));
			$wo_width=trim($rs->Fields('img_width'));
			$wo_height=trim($rs->Fields('img_height'));
			$wo_rota=$rs->Fields('img_rota');
			$wo_count=$rs->Fields('img_count');
		}
	}
}
?>
<?php include "header.php" ?>
<div valign="top">
<script language="JavaScript" type="text/javascript">
function showimg(img,p){
var url='showimg.php?img='+img+'&bp='+p;
var wop=document.getElementById('wo_position').value;
var wow=document.getElementById('wo_width').value;
var woh=document.getElementById('wo_height').value;
var para="width="+ wow +",height="+ woh +",top=0,left="+ wop +",toolbar=no,menubar=no,";
para=para+"scrollbars=yes,resizable=yes,location=no,status=no";
window.open(url,'showimage',para);
}
</script>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<form name="fredit" id="fredit" action="parament_m.php" method="post">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewTable">
	<tr>
		<td class="ewTableHeader" width="100" lang="right">介面位置</td>
		<td><input type="text" name="wo_position" id="wo_position" value="<?php echo $wo_position; ?>"></td>
	</tr>
	<tr>
		<td class="ewTableHeader" lang="right">寬度</td>
		<td><input type="text" name="wo_width" id="wo_width" value="<?php echo $wo_width; ?>"></td>
	</tr>
	<tr>
		<td class="ewTableHeader" lang="right">高度</td>
		<td><input type="text" name="wo_height" id="wo_height" value="<?php echo $wo_height; ?>"></td>
	</tr>
	<tr>
		<td class="ewTableHeader" lang="right">旋轉</td>
		<td><input type="text" name="wo_rota" id="wo_rota" value="<?php echo $wo_rota; ?>">(0,1)</td>
	</tr>
	<tr>
		<td class="ewTableHeader" lang="right">影像筆數</td>
		<td><input type="text" name="wo_count" id="wo_count" value="<?php echo $wo_count; ?>"></td>
	</tr>
</table>
<input type="submit" name="btnAction" id="btnAction" value="   確定   "><input type="button" name="btn1" id="btn1" value="   測試   " onclick="showimg('images/glass.png','TEST Images');"">
</form>
</div>
</td>
</tr>
</table>
</div>
<?php
if ($rs)
	$rs->Close();
?>
<?php include "footer.php" ?>