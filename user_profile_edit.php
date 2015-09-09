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
if (@$_POST["a_edit"] <> "") {
	$UserProfileNo=trim($_POST["UserProfileNo"]);	
	$UserName=$_POST["UserName"];
	$UserID=$_POST["UserID"];
	if ($_POST["PassWord"]=='********'){
	  $PassWord=$_POST["pw"];
	}
	else{
		$PassWord=md5($_POST["PassWord"]);
	}
	if ($UserName=='Doctor'){
		$Level=1;
	}	
	if ($UserName=='Technician'){
		$Level=2;
	}	
	if ($UserName=='Worker'){
		$Level=3;
	}
	$DepartNo=$_POST["DepartNo"];
	$Status=$_POST["Status"];
	$sSql="UPDATE user_profile SET UserID='".$UserID."',PassWord='".$PassWord."',UserName='".$UserName."',Level=".$Level.",DepartNo=".$DepartNo.",Status='".$Status."'";
	$sSql.="WHERE UserProfileNo=".$UserProfileNo;
	//echo $sSql;
	$conn->Execute($sSql);
	$conn->Close();

	// Go to URL if specified
	ob_end_clean();
	header("Location: user_profile_list.php?page=".$page);
}
else{
	$uno=$_GET["uno"];
	$sSql="SELECT * FROM user_profile WHERE UserProfileNo=".$uno;
	if ($rs = $conn->Execute($sSql)) {
		$rs->MoveFirst();
		if(!$rs->Eof()){
			$UserProfileNo=$rs->Fields('UserProfileNo');
			$UserID=$rs->Fields('UserID');
			$PassWord=$rs->Fields('PassWord');
			$UserName=$rs->Fields('UserName');
			$Level=$rs->Fields('Level');
			$DepartNo=$rs->Fields('DepartNo');
			$Status=$rs->Fields('Status');
		}
	$rs->Close();	
	}
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
<div class="ewGridMiddlePanel">
<form name="fredit" id="fredit" action="user_profile_edit.php" method="post">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="UserProfileNo" id="UserProfileNo" value="<?php echo $UserProfileNo; ?>">
<input type="hidden" name="pw" id="pw" value="<?php echo $PassWord; ?>">
<input type="hidden" name="Level" id="Level" value="">
<table cellspacing="0" class="ewTable">
	
	<tr>
		<td class="ewTableHeader">醫院名稱</td>
		<td>
			<select name="DepartNo" id="DepartNo">
	      <?php  
	      $sSql="SELECT * FROM hospital ORDER BY SN";
				if ($rs = $conn->Execute($sSql)) {
					$rs->MoveFirst();
					while(!$rs->Eof()){
						$sn=$rs->Fields('sn');
						$cname=$rs->Fields('cname');
				?>
	      	<option id="H<?php echo $sn; ?>" value="<?php echo $sn; ?>"><?php echo $sn.'.'.$cname; ?></option> 
	      <?php
	      	$rs->MoveNext();  
					}
				$rs->Close();	
				}	
				$conn->Close();
	      ?> 
    	</select>	
    	</td>
	</tr>
	<tr>
		<td class="ewTableHeader">帳號名稱</td>
		<td>
			<select name="UserName" id="UserName">
				<option id="UWorker" value="Worker">Worker</option>
				<option id="UTechnician" value="Technician">Technician</option>
				<option id="UDoctor" value="Doctor">Doctor</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="ewTableHeader">登入帳號</td>
		<td><input type="text" name="UserID" id="UserID" value="<?php echo $UserID; ?>"></td>
	</tr>
	<tr>
		<td class="ewTableHeader">登入密碼</td>
		<td><input type="text" name="PassWord" id="PassWord" value="********"></td>
	</tr>
	<tr>
		<td class="ewTableHeader">狀態</td>
		<td>
			<select name="Status">
				<option id="S_Y" value="Y">Y</option>
				<option id="S_N" value="N">N</option>
			</select>
		</td>
	</tr>
</table>
<input type="submit" name="btnAction" id="btnAction" value="   修改   ">
</form>
</div>
</td>
</tr>
</table>
<?php include "footer.php" ?>
<script language="JavaScript" type="text/javascript">
	document.getElementById("U<?php echo $UserName; ?>").selected=true;	
	document.getElementById("H<?php echo $DepartNo; ?>").selected=true;	
	document.getElementById("S_<?php echo $Status; ?>").selected=true;
	document.getElementById("UserID").focus();
</script>