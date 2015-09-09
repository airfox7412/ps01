<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
$sid=$_GET["sid"];
$memo=$_GET["memo"];
$rdesc=$_GET["rdesc"];
if (@$_GET["act"]<>"G"){
	$conn = ew_Connect();
	$sSql1 = "SELECT StudyID,Memo1 FROM exam_data WHERE StudyID='".$sid."'";
	//echo $sSql1;
	if ($rs=$conn->Execute($sSql1)){
		$rs->MoveFirst();
		if (!$rs->EOF){
			$memo=$rs->fields('Memo1');
			$memo=str_replace("<br>","\n",$memo);
		}
		$rs->Close();
	}
}		
?>
<html>
<head>
	<title>簡碼輸入</title>
<script language="javascript">
function savedesc(){
	document.form1.act.value="S";
	document.form1.action="savedesc.php";
	document.form1.submit();
	//alert(document.form1.act.value+'-病歷已儲存！');
}
//複製到剪貼簿
function copyToClipBoard(){
   var clipBoardContent=''; 
   clipBoardContent+=document.form1.memo.value;
   //clipBoardContent+='\n';
   window.clipboardData.setData("Text",clipBoardContent);
  }
</script>    
</head>
<body bgcolor="#cccccc">
<form name="form1" action="getdesc.php" method="post">
	<input type="hidden" name="sid" value="<?php echo $sid ?>">
	<input type="hidden" name="act" value="Q">
	<table>
		<tr>
			<td>
				<font color="#0000ff">報告簡碼</font><input type="text" name="scode" size="40" value="">
                <input type="button" name="btn1" value="複製病歷" onClick="copyToClipBoard();">
			</td>
			<td>
				<input type="button" name="btn2" value="儲存病歷" onClick="savedesc();">
			</td>
        </tr>    
		<tr>
			<td><textarea name="memo" rows="8" cols="60"><?php echo $memo; ?></textarea></td>
			<td><textarea name="memo1" rows="8" cols="40"><?php echo $rdesc; ?></textarea></td>
		</tr>
	</table>
</form>
</body>
</html>