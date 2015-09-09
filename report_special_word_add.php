<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg0.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "userfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php
$conn = ew_Connect();
$page=$_POST["page"];
if (@$_POST["a_add"]<>"") {
	$ReportSpecialCode=trim($_POST["ReportSpecialCode"]);	
	$ReportSpecialWord=trim($_POST["ReportSpecialWord"]);	
	$UserID=trim($_POST["UserID"]);
	$sSql="INSERT INTO report_special_word (ReportSpecialCode,ReportSpecialWord,UserID) ";
	$sSql.="VALUES('".$ReportSpecialCode."','".$ReportSpecialWord."','".$UserID."')";
	$conn->Execute($sSql);
	$conn->Close();

	echo $sSql;
	// Go to URL if specified
	ob_end_clean();
	header("Location: report_special_word_list.php?page=".$page);
}
?>
<?php include "header.php" ?>
<a href="report_special_word_list.php?page=<?php echo $page; ?>">Go Back</a>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fradd" id="fradd" action="report_special_word_add.php" method="post">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="page" id="page" value="<?php echo $page; ?>">
<table cellspacing="0" class="ewTable">
	<tr>
		<td class="ewTableHeader">Code</td>
		<td><input type="text" name="ReportSpecialCode" id="ReportSpecialCode" value="<?php echo $ReportSpecialCode; ?>"></td>
	</tr>
	<tr>
		<td class="ewTableHeader">ReportDesc</td>
		<td><textarea name="ReportSpecialWord" id="ReportSpecialWord" cols="50" rows="5"><?php echo $ReportSpecialWord; ?></textarea></td>
	</tr>
	<tr>
		<td class="ewTableHeader">UserID</td>
		<td><input type="text" name="UserID" id="UserID" value="doc"></td>
	</tr>
</table>
<input type="submit" name="btnAction" id="btnAction" value="   add   ">
</form>
</div>
</td>
</tr>
</table>
<?php include "footer.php" ?>

<script language="JavaScript" type="text/javascript">
document.getElementById("ReportSpecialCode").focus();
</script>