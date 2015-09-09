<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
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
if(isset($_GET['page'])){
	$sdate1=$_SESSION['sdate1'];
	$sdate2=$_SESSION['sdate2'];
}
else{
	if (@$_GET['act']="S"){
		$act=$_GET['act'];
		$sdate1=$_POST['sdate1'];
		$sdate2=$_POST['sdate2'];
		$_SESSION['sdate1']=$sdate1;
		$_SESSION['sdate2']=$sdate2;
		$_SESSION['cmd']='';
	}
}
if($sdate1==''){
	$sdate1=date('Y/n/j', time()-24*3600);
}
if($sdate2==''){
	$sdate2=date('Y/n/j');
}
$sstr="AND idatetime >='".$sdate1." 00:00:00' AND idatetime <='".$sdate2." 23:59:59' ";
if(@$_GET['cmd']=='reset'||$_SESSION['cmd']=='reset'){
	$sdate1='';
	$sdate2='';
	$sstr='';
	$_SESSION['cmd']='reset';
}
?>
<?php include "header.php" ?>
<table cellspacing="0" class="ewGrid">
<tr valign="top">
    <td class="ewGridContent">
	<div class="ewGridMiddlePanel">
    <form name="form1" action="importlog_list.php" method="post">
    <input type="hidden" name="act" value="S">
    <table>
        <tr valign="middle">
            <td>日期範圍:</td>
            <td>
                <input name="sdate1" type="text" id="sdate1" value="<?php echo $sdate1; ?>" size="10">～
                <input name="sdate2" type="text" id="sdate2" value="<?php echo $sdate2; ?>" size="10">
            </td>
            <td><input type="submit" name="submit" value="查詢"></td>
            <td><input type="button" name="showall" value="全部" onclick="window.location='importlog_list.php?cmd=reset';"></td>
        </tr>
    </table>
    </form>
    <table cellspacing="0" class="ewTable ewTableSeparate">
        <tr class="ewTableHeader">
            <td>序</td>
            <td>來源</td>
            <td>上傳</td>
            <td>備份</td>
            <td>看診日期</td>
            <td>上傳日期</td>
            <td>轉檔日期</td>
        </tr>
    <?php
    $conn = ew_Connect();
    $sql="SELECT * FROM import_log ";
    $sql.="WHERE (1) ";
    $sql.=$sstr;
    $sql.="ORDER BY iid DESC ";
    //echo $sql."<br>";
    $rs = $conn->Execute($sql);
    $total=$rs->recordcount();
    
    if(isset($_GET['page']) and $_GET['page'] != 0 and is_numeric($_GET['page']))  //設定目前頁數
        $nowPage = $_GET['page'];
    else
        $nowPage = 1;
    $page = new SplitPage($nowPage, $total, 30, 20);  //建構出 SplitPage 物件
    $page->setViewList("importlog_list.php?", 'reportcode');
    $rs->Close();
    
    $sql="SELECT * FROM import_log ";
    $sql.="WHERE (1) ";
    $sql.=$sstr;
    $sql.="ORDER BY iid DESC ";
    $sql.="limit {$page->started_record}, {$page->records_per_page}";
    //echo $sql;
    if ($rs = $conn->Execute($sql)) {
        $rs->MoveFirst();
        while (!$rs->EOF){
            $SN=$rs->fields('iid');
            $sname=$rs->fields('sname');
            $fname=$rs->fields('fname');
            $bname=$rs->fields('bname');
            $IDate=$rs->fields('idatetime');
            $ODate=$rs->fields('odatetime');
            $SDate=$rs->fields('sdatetime');
    ?>		
        <tr>
            <td align="center"><?php echo $SN; ?></td>
            <td><?php echo $sname; ?></td>
            <td><?php echo $fname; ?></td>
            <td BGCOLOR="#00ff00"><?php echo $bname; ?></td>
            <td><font color="#0000ff"><?php echo $SDate; ?></font></td>
            <td><?php echo $IDate; ?></td>
            <td><?php echo $ODate; ?></td>
        </tr>
    <?php
            $rs->MoveNext();
        }
        $rs->Close();
    }	
    ?>						
    </table>
	<?php
        echo "<font color=#0000ff>".$page->viewlist."</font>";		
    ?>
    </div>
	</td>
</tr>
</table>
<?php include "footer.php" ?>
<script src="css/datepicker-zh-TW.js"></script>
<script>
$(function() {
    $( "#sdate1" ).datepicker({
      changeMonth: true,
      changeYear: true
    	},
    	$.datepicker.regional["zh-TW"]);
    $( "#sdate2" ).datepicker({
      changeMonth: true,
      changeYear: true
    	},
    	$.datepicker.regional["zh-TW"]);
  });
</script>