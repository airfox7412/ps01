<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg0.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "userfn6.php" ?>
<?php include "SplitPage.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php
$conn = ew_Connect();
if(isset($_GET['page'])){
	$sword=$_SESSION['sword'];
}
else{	
	if(@$_POST['act']='S'){
		$act=$_POST['act'];
		$sword=$_POST['sword'];
		$_SESSION['sword']=$sword;
	}
}
$sstr="WHERE ReportCode like '%".$_SESSION['sword']."%' OR ReportDesc like '%".$_SESSION['sword']."%' ";
?>
<?php include "header.php" ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="form1" action="report_code_desc_list.php" method="post">
<input type="hidden" name="act" value="S">
<table>
	<tr>
		<td><input type="text" name="sword" value="<?php echo $sword; ?>"></td>
		<td><input type="submit" name="submit" value="�j�M"></td>
		<td><input type="button" name="showall" value="����" onclick="window.location='report_code_desc_list.php?cmd=reset';"></td>
	</tr>
</table>
</form>
<?php
$sql = "select count(*) as total from report_code_desc ";
$sql.=$sstr;
//echo $sql."<br>";
$row = $conn->Execute($sql);
$total=$row->fields('total');

if(isset($_GET['page']) and $_GET['page'] != 0 and is_numeric($_GET['page']))  //�]�w�ثe����
	$nowPage = $_GET['page'];
else
	$nowPage = 1;
$page = new SplitPage($nowPage, $total, 20, 20);  //�غc�X SplitPage ����
$page->setViewList("report_code_desc_list.php?", 'reportcode');
//�]�w�����C���,�Ѽ�1���s��������,�Ѽ�2���s����target(���Ѽƥi���]�w)
//echo "<font color=#0000ff>".$page->viewlist."</font>";

$sSql="SELECT * FROM report_code_desc ";
$sSql.=$sstr;
$sSql.="ORDER BY ReportCode ";
$sSql.=" limit {$page->started_record}, {$page->records_per_page}";
//echo $sSql;
if ($rs = $conn->Execute($sSql)) {
	$rs->MoveFirst();
?>
<div align="right">
	<input type="button" name="new" value="�s�W�N�X" onclick="window.location='report_code_desc_add.php?page=<?php echo $nowPage; ?>';">
</div>
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tr class="ewTableHeader">
		<td width="50">�N�X</td>
		<td width="400">����</td>
		<td width="70">�ϥΪ�</td>
		<td style="white-space: nowrap;">&nbsp;</td>
	</tr>
<?php
	while (!$rs->EOF){
		$ReportCodeDescNo=$rs->fields('ReportCodeDescNo');
		$ReportCode=$rs->fields('ReportCode');
		$ReportDesc=$rs->fields('ReportDesc');
		if (strlen($ReportDesc)>50){
			$ReportDesc=substr($rs->fields('ReportDesc'),0,50)."<font color=#00ff00>...<a href='#' title='".$rs->fields('ReportDesc')."'>[More]</a></font>";	
		}
		$UserID=$rs->fields('UserID');
?>		
	<tr>
        <td><?php echo $ReportCode; ?></td>
        <td><?php echo $ReportDesc; ?></td>
        <td><?php echo $UserID; ?></td>
		<td><a href="report_code_desc_edit.php?rno=<?php echo $ReportCodeDescNo; ?>&page=<?php echo $nowPage; ?>">�ק�</a></td>
    </tr>
<?php
		$rs->MoveNext();
	}
$rs->close();
?>						
</table>
<?php
	echo "<font color=#0000ff>".$page->viewlist."</font>";
}		
?>
</div>
</td>
</tr>
</table>
</body>
</html>