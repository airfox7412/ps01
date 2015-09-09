<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg0.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "SplitPage.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php
	if(@$_GET['act']='S'){	//按下查詢
		$act=$_GET["act"];
		$uid=$_POST["userid"];
		if (!$uid==""){
	  	$sstr="WHERE UserID='".$uid."' ";
		}
	}
	else{	
		$sstr="";
	}
?>
<?php include "header.php" ?>
<form name="form1" id="form1" action="user_profile_list.php" method="post">
<table cellspacing="0" class="ewGrid">
<tr valign="top">
    <td class="ewGridContent">
    <input type="hidden" name="act" value="S">
    <table>
    	<tr valign="top">
            <td colspan="6">登入代號:<input name="userid" id="userid" type="text" value="<?php echo $uid; ?>" size="10">
            </td>
            <td><input type="submit" name="submit" value="查詢"></td>
            <td><input type="button" name="add" value="新增使用者" onclick="window.location='user_profile_add.php';"></td>
        </tr>
    </table>
    <table cellspacing="0" class="ewTable">
        <tr class="ewTableHeader">
            <td>序號</td>      
            <td>登入代號</td>
            <td>帳號名稱</td> 
            <td>醫院名稱</td>
            <td>狀態</td>
            <td>修改</td>
        </tr>
    <?php
    $conn = ew_Connect();
    $sql="SELECT * FROM user_profile ";
    $sql.=$sstr;
    $sql.="ORDER BY DepartNo";
    //echo $sql;
    if ($rs = $conn->Execute($sql)) {
        $rs->MoveFirst();
        while (!$rs->EOF){
            $uno=$rs->fields('UserProfileNo');
            $username=$rs->fields('UserName');
            $userid=$rs->fields('UserID');
            $level=$rs->fields('Level');
            $dno=$rs->fields('DepartNo');
            $Status=$rs->fields('Status');
            if($Status=='Y'){
                $scolor="#0000ff";
            }
            else{
                $scolor="#ff0000";
            }
            
						$sql1="select * from hospital WHERE sn=".$dno;
				    if ($rs1 = $conn->Execute($sql1)) {
				        $rs1->MoveFirst();
				        if (!$rs1->EOF){
									$hname=$rs1->fields('cname');
									//$rs1->MoveNext();
								}
						}
						$rs1->Close();
    ?>		
        <tr onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);' onMouseDown="javascript:window.location.href('DetailView_Edit.php?sid=<?php echo $StudyID; ?>&page=<?php echo $nowPage; ?>');">
            <td align="center"><?php echo $uno; ?></td>
            <td><?php echo $userid; ?></td>
            <td><?php echo '['.$level.'] '.$username; ?></td>
            <td><?php echo '['.$dno.'] '.$hname; ?></td>
            <td align="center"><font color='<?php echo $scolor; ?>'><?php echo $Status; ?></font></td>
            <td>
            	<?php
            	if ($userid<>'DOC'){
            	?>
            		<a href="user_profile_Edit.php?uno=<?php echo $uno; ?>">編輯</a>
            	<?php
            	}
            	?>
            </td>
        </tr>
    <?php
            $rs->MoveNext();
        }
        $rs->Close();
    }
    ?>					
    </table>
	</td>
</tr>
</table>
</form>
<?php include "footer.php" ?>