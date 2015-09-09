<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg0.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "SplitPage.php" ?>
<?php
if($_GET["uid"]!="doc")
	exit;
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php include "header0.php" ?>
<table cellspacing="0" class="ewGrid">
<tr valign="top">
    <td class="ewGridContent"><a href="hospital_add.php">新增</a></td>
</tr>    
<tr valign="top">
    <td class="ewGridContent">
    <table cellspacing="0" class="ewTable">
        <tr class="ewTableHeader">
            <td>序號</td>
            <td>中文名稱</td>
            <td>英文名稱</td>
            <td>資料庫名稱</td>
            <td style="white-space: nowrap;">&nbsp;</td>
            <!--<td style="white-space: nowrap;">&nbsp;</td>-->
        </tr>
    <?php
    $conn = ew_Connect();
    $sql="SELECT * FROM hospital";
    $rs = $conn->Execute($sql);
    $total=$rs->recordcount();
    
    if(isset($_GET['page']) and $_GET['page'] != 0 and is_numeric($_GET['page']))  //設定目前頁數
        $nowPage = $_GET['page'];
    else
        $nowPage = 1;
    $page = new SplitPage($nowPage, $total, 15, 20);  //建構出 SplitPage 物件
    $page->setViewList("hospital_list.php?", "reportcode");
    $rs->Close();
    
    $sql="SELECT * FROM hospital ";
    $sql.="LIMIT {$page->started_record}, {$page->records_per_page}";
    //echo $sql;
    if ($rs = $conn->Execute($sql)) {
		if ($nowPage!=1){$rcnt=($nowPage-1)*15+1;}
		else{$rcnt=1;}
        $rs->MoveFirst();
        while (!$rs->EOF){
            $sn=$rs->fields('sn');
            $cname=$rs->fields('cname');
            $ename=$rs->fields('ename');
            $dbname=$rs->fields('dbname');
    ?>		
        <tr>
            <td align="center"><?php echo $sn; ?></td>
            <td><?php echo $cname; ?></td>
            <td align="center"><?php echo $ename; ?></td>
            <td align="center"><?php echo $dbname; ?></td>
            <td><a href="hospital_edit.php?sn=<?php echo $sn; ?>">修改</a></td>
            <!--<td><a href="hospital_del.php?sn=<?php echo $sn; ?>">刪除</a></td>-->
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
<tr>
	<td>
	<?php
	if($rcnt!=15){
		echo "<font color=#0000ff>".$page->viewlist."</font>";
	}
	else echo "很好～都處理完了！";
	?>
    </td>
</tr>
</table>
<?php include "footer.php" ?>