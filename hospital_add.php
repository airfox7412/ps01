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
if (@$_POST["a_add"] <> "") {
  $sn=$_POST["sn"];
  $cname=trim($_POST["cname"]);	
  $ename=trim($_POST["ename"]);	
  $dbname=trim($_POST["dbname"]);
  
  $sSql="INSERT INTO hospital (sn,cname,ename,dbname) ";
  $sSql.="VALUES(".$sn.",'".$cname."','".$ename."','".$dbname."') ";
  echo $sSql;
  $conn->Execute($sSql);
  $conn->Close();

  // Go to URL if specified
  ob_end_clean();
  header("Location: hospital_list.php");
}
?>
<?php include "header0.php" ?>
<a href="hospital_list.php?page=1">Go Back</a>
<table cellspacing="0" class="ewGrid">
<tr valign="top">
    <td class="ewGridContent">
    <form id="form1" name="form1" method="post" action="">
    <input type="hidden" name="a_add" id="a_add" value="U">
    <input type="hidden" name="sn" id="sn" value="<?php echo $sn; ?>">
    <table cellspacing="0" class="ewTable">
        <tr class="ewTableHeader">
            <td>序號</td><td><input type="text" name="sn" id="sn" value="" size="2" /></td>
        </tr>
        <tr class="ewTableHeader">    
            <td>中文名稱</td><td><input type="text" name="cname" id="cname" value="" size="60" /></td>
        </tr>
        <tr class="ewTableHeader">
            <td>英文名稱</td><td><input type="text" name="ename" id="ename" value="" size="60" /></td>
        </tr>
        <tr class="ewTableHeader">
            <td>資料庫名稱</td><td><input type="text" name="dbname" id="dbname" value=""/></td>
        </tr> 
        <tr class="ewTableHeader">   
            <td colspan="2">
            <input type="submit" name="submit" value="確定" />
            <input type="button" name="button1" value="放棄" />
            </td>
        </tr>
    </table>
    </form>
	</td>
</tr>
</table>
<?php include "footer.php" ?>