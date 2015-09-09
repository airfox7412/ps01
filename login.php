<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg0.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
$conn = ew_Connect();

if (@$_POST["submit"]!="") {
		$suserid = strtoupper(@$_POST["userid"]);
		$spassword = strtoupper(@$_POST["password"]);
		$smsel=@$_POST["msel"];
	  setcookie('hospital',$smsel);
		
		if (@$_POST["rememberme"]=='a'){
	  	setcookie('AutoLogin', 'autologin');
	  	setcookie('userid',$suserid);
	  	setcookie('password',$spassword);
		}
		elseif (@$_POST["rememberme"]=='u'){
	  	setcookie('AutoLogin', 'rememberuserid');
	  	setcookie('userid',$suserid);
	  	setcookie('password','');
		}
		elseif (@$_POST["rememberme"]=='n'){
	  	setcookie('AutoLogin', '');
	  	setcookie('userid','');
	  	setcookie('password','');
		}
		$sql="SELECT * FROM user_profile ";
    $sql.="WHERE userid='".$suserid."' ";
    $sql.="AND password='".md5($spassword)."' ";
    $sql.="AND Status='Y' ";
    if ($rs = $conn->Execute($sql)) {
        $rs->MoveFirst();
        $level=$rs->fields('Level');
        $dno=$rs->fields('DepartNo');
        if (!$rs->EOF) {
	  				//setcookie('level',$level);
	  				$_SESSION['level']=$level;
	  				setcookie('dno',$dno);
	  				if ($level=="0"){
	  					$_SESSION['hospital']=$smsel;
	  				}
	  				else {
	  					$_SESSION['hospital']=$dno;
	  				}
						header("Location: DetailView_list.php");
				}
				else {
					echo "<script>alert('帳號或密碼錯誤！');</script>";
				}
		}
		else {
			echo "<script>alert('登入失敗！');</script>";
		}
}
?>
<html>
<head>
	<title>登入作業</title>
	<meta http-equiv="Content-Type" content="text/html; charset=big5">
  <link href="ps01.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/ewp60.js"></script>
	<script type="text/javascript" src="js/userfn50.js"></script>
  <script type="text/javascript" src="Scripts/jquery-1.3.2.js"></script>  
<script type="text/javascript">
<!--
	function ValidateForm(fobj) {
		if (fobj.userid.value=="") {
			alert("請輸入帳號");
			fobj.userid.focus();
			return false;
		}
		if (fobj.password.value=="") {
			alert("請輸入密碼");
			fobj.password.focus();
			return false;
		}
		return true;
	}
	
	function Maintain(){
	  var uid=$("#userid").attr("value");
	  var pwd=$("#password").attr("value");
	  var url="hospital_list.php?uid="+uid+"&pwd="+pwd;
  	var para='width=640,height=480,top=0,top=100,left=200,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no';
	  window.open(url,'openform',para);
	}
		
	$(document).ready(function() {	// JQuery Document Ready
		$("#userid").change(function(){
			if ($(this).attr("value")=="doc") {
	  		$("#hname").show();
	  		$("#msel").show();
	  		$("#hedit").show();
	  		}
	  	else{
	  		$("#hname").hide();
	  		$("#msel").hide();
	  		$("#hedit").hide();
	  	}	
		});
		
		$("#msel").change(function(){	
			$.ajax({
					type: "POST",
					url:"getStatus.php?m="+$("#msel").attr("value"),
					cache:false,
					success:function(response){
							if(response.trim()=="Y"){
								$("#status").html("<font color='#FF0000'>醫院</font>");
							}
							else{
								$("#status").html("<font color='#00AA00'>醫院</font>");
							}
						},
					error: function(){
						alert("儲存錯誤！");
						}	
			});
    });
	});		
//-->
</script>
</head>
<body background="images/bg2.jpg">
<br /><br /><br /><br /><br /><br /><br />
<div align="center">
<form name="form1" action="login.php" method="post" onSubmit="return ValidateForm(this);">
<table id="table1" background="images/login.jpg" width="408" height="281">
	<tr>
    	<td clospan="3" height="80"></td>
    </tr>
    <tr>
        <td width="71">&nbsp;</td>
        <td align="right" width="46"><span class="logintext">帳號</span></td>
        <td align="left" width="275">
        	<input class="username" type="text" name="userid" id="userid" size="20" value="<?php echo @$_COOKIE['userid'] ?>">
        </td>
    </tr>
    <tr>
        <td width="71">&nbsp;</td>
        <td align="right" width="46"><span class="logintext">密碼</span></td>
        <td align="left" width="275">
        	<input class="password" type="password" name="password" id="password" size="20" value="<?php echo @$_COOKIE['password'] ?>">
        </td>
    </tr>
    <tr>
        <td width="71">&nbsp;</td>
        <td align="right" width="46"><span id="hname" class="logintext" style="display:none"><div id="status">醫院</div></span></td>
        <td align="left" width="275"><span class="logintext">
          <select name="msel" id="msel" class="ew_Select" style="display:none">
        	<?php
						$result=mysql_query("SELECT * FROM hospital WHERE status=1");
					?>
						<option value="0">選擇...</option>
					<?php
						while($row=mysql_fetch_array($result)){
					?>
          	<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
        	<?php
						}
					?>
          </select>
        </span>
        <span id="hedit" class="logintext" style="display:none"><a href="javascript: Maintain();" target="_blank">醫院維護</a></span>
        </td>
    </tr>
    <tr>
        <td width="71">&nbsp;</td>
        <td width="*" colspan="2">
            <span class="logintext">            
            <input type="radio" name="rememberme" id="rememberme" value="a" <?php if (@$_COOKIE['AutoLogin'] == "autologin") { echo "checked"; }?>>自動登入直到我有登出<br>
            <input type="radio" name="rememberme" id="rememberme" value="u" <?php if (@$_COOKIE['AutoLogin'] == "rememberuserid") { echo "checked"; }?>>儲存我的使用者名稱<br>
            <input type="radio" name="rememberme" id="rememberme" value="n" <?php if (@$_COOKIE['AutoLogin'] == "") { echo "checked"; }?>>總是問我使用者名稱及密碼
            </span>
        </td>          
    </tr>
    <tr>
      	<td colspan="3" align="center">
        	<span class="logintext"><input type="submit" name="submit" id="submit" value="  登入確認  " class="ew_Input"></span>
        </td>
    </tr>        
</table>
</form>
</div>
</body>
</html>
<script language="JavaScript" type="text/javascript">
	if (document.getElementById("userid").value=="doc") {
  		$("#hname").show();
  		$("#msel").show();
  		$("#hedit").show();
  		}
  	else{
  		$("#hname").hide();
  		$("#msel").hide();
  		$("#hedit").hide();
  	}
	document.getElementById("userid").focus();	
</script>