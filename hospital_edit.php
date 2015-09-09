<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg0.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "header0.php" ?>
<?php
$conn = ew_Connect();
if (@$_POST["a_edit"] <> "") {
  $sn=$_POST["sn"];
  $cname=trim($_POST["cname"]);	
  $ename=trim($_POST["ename"]);	
  $dbname=trim($_POST["dbname"]);
  $status=trim($_POST["status"]);
  
  $sSql="UPDATE hospital SET cname='".$cname."',ename='".$ename."',dbname='".$dbname."',status=".$status." ";
  $sSql.="WHERE sn=".$sn;
  echo $sSql;
  $conn->Execute($sSql);
  $conn->Close();

  // Go to URL if specified
  ob_end_clean();
  header("Location: hospital_list.php?uid=doc&pwd=doc");
}
else{
  $sn=$_GET["sn"];
  $sSql="SELECT * FROM hospital WHERE sn=".$sn;
  //echo $sSql."<br>";
  if ($rs = $conn->Execute($sSql)) {
	  $rs->MoveFirst();
	  if(!$rs->Eof()){
		$cname=$rs->fields('cname');
		$ename=$rs->fields('ename');
		$dbname=$rs->fields('dbname');
		$status=$rs->fields('status');
	  }
  $rs->Close();	
  }
}
?>
<?php include "header0.php" ?>
<a href="hospital_list.php?page=1">Go Back</a>
<table cellspacing="0" class="ewGrid">
<tr valign="top">
    <td class="ewGridContent">
    <form id="form1" name="form1" method="post" action="">
    <input type="hidden" name="a_edit" id="a_edit" value="U">
    <input type="hidden" name="sn" id="sn" value="<?php echo $sn; ?>">
    <table cellspacing="0" class="ewTable">
        <tr class="ewTableHeader">
            <td>序號</td><td><?php echo $sn; ?></td>
        </tr>
        <tr class="ewTableHeader">    
            <td>中文名稱</td><td><input type="text" name="cname" id="cname" value="<?php echo $cname; ?>" size="60" /></td>
        </tr>
        <tr class="ewTableHeader">
            <td>英文名稱</td><td><input type="text" name="ename" id="ename" value="<?php echo $ename; ?>" size="60" /></td>
        </tr>
        <tr class="ewTableHeader">
            <td>資料庫名稱</td><td><input type="text" name="dbname" id="dbname" value="<?php echo $dbname; ?>"/></td>
        </tr> 
        <tr class="ewTableHeader">
            <td>使用</td><td><input type="text" name="status" id="status" value="<?php echo $status; ?>"/></td>
        </tr> 
        <tr class="ewTableHeader">   
            <td colspan="2">
            <input type="submit" name="submit" value="修改" />
            <input type="button" name="button1" value="放棄" />
            </td>
        </tr>
    </table>
    </form>
	</td>
</tr>
</table>
<?php include "footer.php" ?>