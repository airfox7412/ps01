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
	<title>²�X��J</title>
<script language="javascript">
function savedesc(){
	document.form1.act.value="S";
	document.form1.action="savedesc.php";
	document.form1.submit();
	//alert(document.form1.act.value+'-�f���w�x�s�I');
}
//�ƻs��ŶKï
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
				<font color="#0000ff">���i²�X</font><input type="text" name="scode" size="40" value="">
                <input type="button" name="btn1" value="�ƻs�f��" onClick="copyToClipBoard();">
			</td>
			<td>
				<input type="button" name="btn2" value="�x�s�f��" onClick="savedesc();">
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