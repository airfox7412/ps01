<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
if (@$_POST["a_add"]=='U') {
  $sid=$_POST["sid"];
  $nowPage=$_POST["nowpage"];
  $AdditionalPatientHistory=trim($_POST["AdditionalPatientHistory"]);
  
  $conn = ew_Connect();
  $sSql = "SELECT * FROM exam_data WHERE StudyID='".$sid."'";
	$rs = $conn->Execute($sSql);
	$rs->MoveFirst();
	if (!$rs->EOF){
			$sSql1="UPDATE exam_data SET AdditionalPatientHistory='".$AdditionalPatientHistory."' where StudyID='".$sid."'";
		}
		else{
		  $sSql1="INSERT INTO exam_data (StudyID,AdditionalPatientHistory) VALUES('".$sid."','".$AdditionalPatientHistory."') ";
		}	
  $conn->Execute($sSql1);
  $conn->Close();
  //echo "<script>alert('".$sSql1."');</script>";
  // Go to URL if specified
  ob_end_clean();
  header("Location: DetailView_list.php?page=".$nowPage);
}
else {
  $StudyID=$_GET['sid'];
	$Name=$_GET['name'];
	$Sex=$_GET['sex'];
	$nowPage=$_GET['page'];
  $conn = ew_Connect();
  $sSql = "SELECT * FROM exam_data WHERE StudyID='".$StudyID."'";
	$rs = $conn->Execute($sSql);
	$rs->MoveFirst();
	if (!$rs->EOF){
  	$AdditionalPatientHistory=str_replace("<br>","\r\n",$rs->fields("AdditionalPatientHistory"));
	}
  $conn->Execute($sSql);
  $conn->Close();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=big5">
	<link type="text/css" href="ps01.css" rel="stylesheet">
</head>
<body>
<table cellspacing="0" class="ewGrid">
<tr valign="top">
    <td class="ewGridContent">
    <form id="form1" name="form1" method="post" action="history_add.php">
    <input type="hidden" name="a_add" id="a_add" value="U">
    <input type="hidden" name="sid" id="sid" value="<?php echo $StudyID; ?>">
    <input type="hidden" name="nowPage" id="nowPage" value="<?php echo $nowPage; ?>">
    <table cellspacing="0" class="ewTable">
        <tr class="ewTableHeader">
            <td>看診號</td><td><?php echo $StudyID; ?></td>
        </tr>
        <tr class="ewTableHeader">    
            <td>姓名</td><td><?php echo $Name; ?></td>
        </tr>
        <tr class="ewTableHeader">
            <td>性別</td><td><?php echo $Sex; ?></td>
        </tr>
        <tr class="ewTableHeader">
            <td>主述</td>
            <td>
            	<textarea name="AdditionalPatientHistory" id="AdditionalPatientHistory" cols="40" rows="10" wrap="on"><?php echo $AdditionalPatientHistory;?></textarea>
            </td>
        </tr> 
        <tr class="ewTableHeader">   
            <td colspan="2">
            <input type="submit" name="submit" value="確定" />
            <input type="button" name="button1" value="取消" onclick="javascript: window.location.href='DetailView_list.php?page=<?php echo $nowPage; ?>';"/>
            </td>
        </tr>
    </table>
    </form>
	</td>
</tr>
</table>
</body>
</html>
<script language="JavaScript" type="text/javascript">
document.getElementById("AdditionalPatientHistory").focus();
</script>