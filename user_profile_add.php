<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg0.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "userfn6.php" ?>
<?php
$conn = ew_Connect();
if (@$_POST["a_add"]=="A") {
	$UserID=trim($_POST["UserID"]);
	$PassWord=trim($_POST["PassWord"]);
	$Level=trim($_POST["Level"]);
	$DepartNo=trim($_POST["DepartNo"]);
	$UserName=trim($_POST["UserName"]);
	$Status=trim($_POST["Status"]);
	$sSql="INSERT INTO user_profile (UserID,PassWord,UserName,Level,DepartNo,Status) ";
	$sSql.="VALUES('".$UserID."','".md5($PassWord)."','".$UserName."',".$Level.",".$DepartNo.",'".$Status."')";
	$conn->Execute($sSql);
	$conn->Close();
	//echo $sSql;
	// Go to URL if specified
	ob_end_clean();
	header("Location: user_profile_list.php");
}
?>
<?php include "header.php" ?>
<script type="text/javascript" language="JavaScript">
<!--
function padLeft(str,lenght){
	if(str.length >= lenght)
		return str;
	else
		return padLeft("0" +str,lenght);
}

$(document).ready(function(){
	$("#DepartNo").change(function(){
		var	hno=$("#DepartNo").val();
			hno=($("#UserName").val()).substr(0,1)+padLeft(hno,2); 
			$("#UserID").val(hno);
			$("#PassWord").val(hno);
		});
		
	$("#UserName").change(function(){
		var	hno=($("#UserName").val()).substr(0,1);
		var lv;
			if(hno=='D') lv=1;
			else if(hno=='T') lv=2;
			else if(hno=='W') lv=3;
			$("#Level").val(lv);
			
			hno=hno+padLeft($("#DepartNo").val(),2); 
			$("#UserID").val(hno);
			$("#PassWord").val(hno);
		});
	})
//-->
</script>
<a href="user_profile_list.php">Go Back</a>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel" valign="Center">
<form name="fradd" id="fradd" action="user_profile_add.php" method="post">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="Level" id="Level" value="">
<table cellspacing="0" class="ewTable">	
	<tr>
		<td class="ewTableHeader">醫院名稱</td>
		<td>
			<select name="DepartNo" id="DepartNo" onchange="ChangeHospital();">
			<?php
	    $sql="SELECT * FROM hospital ORDER BY sn";
	    if ($rs = $conn->Execute($sql)) {
        $rs->MoveFirst();
        while (!$rs->EOF){
            $sn=$rs->fields('sn');
            $cname=$rs->fields('cname');
			?>
				<option value="<?php echo $sn; ?>"><?php echo $cname; ?></option>
			<?php
						$rs->MoveNext();
					}
				$rs->Close();
				}
			?>
		</select>	
		</td>
	</tr>
	<tr>
		<td class="ewTableHeader">帳號名稱</td>
		<td>
			<select name="UserName" id="UserName">
				<option value="Worker">Worker</option>
				<option value="Technician">Technician</option>
				<option value="Doctor">Doctor</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="ewTableHeader">登入帳號</td>
		<td><input type="text" name="UserID" id="UserID" value="w00"></td>
	</tr>
	<tr>
		<td class="ewTableHeader">登入密碼</td>
		<td><input type="text" name="PassWord" id="PassWord" value="w00"></td>
	</tr>
	<tr>
		<td class="ewTableHeader">開啟帳號</td>
		<td>			
			<select name="Status" id="Status">
				<option value="Y">Y</option>
				<option value="N">N</option>
			</select>
		</td>
	</tr>
</table>
<input type="submit" name="btnAction" id="btnAction" value="   新增   ">
</form>
</div>
</td>
</tr>
</table>
<?php include "footer.php" ?>