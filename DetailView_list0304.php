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
if(@$_GET['cmd']=='reset'){
	$sdate1=date('Y/n/j', time()-4*24*3600);
	$sdate2=date('Y/n/j');
	$status1='A';	
	$sstr="AND a.Status='".$status1."' ";
	$_SESSION['sdate1']=$sdate1;
	$_SESSION['sdate2']=$sdate2;
	$_SESSION['status1']=$status1;
	$sstr="AND a.StudyDate >='".$sdate1."' AND a.StudyDate <='".$sdate2."' ";
    if($status1=='Y' or $status1=='N'){
	  $sstr.="AND a.Status='".$status1."' ";
	}
}
else if(@$_GET['cmd']=='unps'){
	$sdate1='';
	$sdate2='';
	$status1='N';	
	$sstr="AND a.Status='".$status1."' ";
}
else{
  if(isset($_GET['page'])){
	  $sdate1=$_SESSION['sdate1'];
	  $sdate2=$_SESSION['sdate2'];
	  $status1=$_SESSION['status1'];
  }
  else{
	  if(@$_GET['act']='S'){
		  $act=$_GET["act"];
		  $sdate1=$_POST["sdate1"];
		  $sdate2=$_POST["sdate2"];
		  $status1=$_POST["status1"];
		  $_SESSION['sdate1']=$sdate1;
		  $_SESSION['sdate2']=$sdate2;
		  $_SESSION['status1']=$status1;
	  }
  }
  if($sdate1==''){
	  $sdate1=date('Y/n/j', time()-4*24*3600); //玡ぱ
	  //$sdate1=date('Y/n/1'); 
  }
  if($sdate2==''){
	  $sdate2=date('Y/n/j');
  }
  $sstr="AND a.StudyDate >='".$sdate1."' AND a.StudyDate <='".$sdate2."' ";
  if($status1=='Y' or $status1=='N'){
	  $sstr.="AND a.Status='".$status1."' ";
  }
}
?>
<?php include "header.php" ?>
<table cellspacing="0" class="ewGrid">
<tr valign="top">
    <td class="ewGridContent">
    <form name="form1" action="DetailView_list.php" method="post">
    <input type="hidden" name="act" value="S">
    <table>
        <tr valign="top">
            <td>ら戳絛瞅:</td>
            <td>
                <input name="sdate1" type="text" id="sdate1" value="<?php echo $sdate1; ?>" size="10"><img src="Images/calendar.gif" id="date_bt1" width="18" height="18">                       
                                <script>
                                    Calendar.setup({
                                        trigger: "date_bt1",
                                        inputField: "sdate1",
                                        fdow: 7,
                                        showTime: 24,
                                        dateFormat: "%Y/%o/%e",
                                        onSelect: function() { this.hide() }
                                    });
                                </script>°
                <input name="sdate2" type="text" id="sdate2" value="<?php echo $sdate2; ?>" size="10"><img src="Images/calendar.gif" id="date_bt2" width="18" height="18">                       
                                <script>
                                    Calendar.setup({
                                        trigger: "date_bt2",
                                        inputField: "sdate2",
                                        fdow: 7,
                                        showTime: 24,
                                        dateFormat: "%Y/%o/%e",
                                        onSelect: function() { this.hide() }
                                    });
                                </script>
            </td>
            <td>矪瞶篈:</td>
            <td>
                <select name="status1">
                    <option value="0" <?php if($status1=='0') echo 'selected';?>>场</option>
                    <option value="Y" <?php if($status1=='Y') echo 'selected';?>>矪瞶</option>
                    <option value="N" <?php if($status1=='N') echo 'selected';?>>ゼ矪瞶</option>
                </select>
            </td>
            <td><input type="submit" name="submit" value="琩高"></td>
            <td><input type="button" name="showall" value="场ゼ矪瞶" onclick="window.location='DetailView_list.php?cmd=unps';"></td>
        </tr>
    </table>
    </form>
    <table cellspacing="0" class="ewTable">
        <tr class="ewTableHeader">
            <td>No</td>
            <td>PatientID</td>
            <td>StudyDate</td>
            <td>PatientName</td>
            <td>PatientSex</td>
            <td>BodyPart</td>
            <td>StudyID</td>
            <td>INumber</td>
            <td>Status</td>
            <td style="white-space: nowrap;">&nbsp;</td>
        </tr>
    <?php
    $conn = ew_Connect();
    $sql="SELECT a.PatientID,a.StudyID,b.PatientID FROM patient_detail a , patient_main b ";
    $sql.="WHERE a.PatientID=b.PatientID ";
    $sql.=$sstr;
    $sql.="GROUP BY a.StudyID ";
    $sql.="ORDER BY a.StudyDate";
    //echo $sql."<br>";
    $rs = $conn->Execute($sql);
    $total=$rs->recordcount();
    
    if(isset($_GET['page']) and $_GET['page'] != 0 and is_numeric($_GET['page']))  //砞﹚ヘ玡计
        $nowPage = $_GET['page'];
    else
        $nowPage = 1;
    $page = new SplitPage($nowPage, $total, 15, 20);  //篶 SplitPage ン
    $page->setViewList("DetailView_list.php?", 'reportcode');
    $rs->Close();
    
    $sql="SELECT * FROM patient_detail a , patient_main b ";
    $sql.="WHERE a.PatientID=b.PatientID ";
    $sql.=$sstr;
    $sql.="GROUP BY a.StudyID ";
    $sql.="ORDER BY a.StudyDate ";
    $sql.="limit {$page->started_record}, {$page->records_per_page}";
    //echo $sql;
    if ($rs = $conn->Execute($sql)) {
		if ($nowPage!=1){$rcnt=($nowPage-1)*15+1;}
		else{$rcnt=1;}
        $rs->MoveFirst();
        while (!$rs->EOF){
            $DetailNo=$rs->fields('DetailNo');
            $PatientID=$rs->fields('PatientID');
            $StudyDateTime=$rs->fields('StudyDate').' '.$rs->fields('StudyTime');
            $PatientName=$rs->fields('PatientName');
            $PatientSex=$rs->fields('PatientSex');
            $BodyPart=$rs->fields('BodyPartExamined');
            $StudyID=$rs->fields('StudyID');
            $InstanceNumber=$rs->fields('InstanceNumber');
            $Status=$rs->fields('Status');
            if($Status=='Y'){
                $scolor="#0000ff";
            }
            else{
                $scolor="#ff0000";
            }
    ?>		
        <tr onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);' onMouseDown="javascript:window.location.href('DetailView_Edit.php?sid=<?php echo $StudyID; ?>&page=<?php echo $nowPage; ?>');">
            <td align="center"><?php echo $rcnt; ?></td>
            <td><?php echo $PatientID; ?></td>
            <td><?php echo $StudyDateTime; ?></td>
            <td><?php echo $PatientName; ?></td>
            <td align="center"><?php echo $PatientSex; ?></td>
            <td><?php echo $BodyPart; ?></td>
            <td><?php echo $StudyID; ?></td>
            <td align="center"><?php echo $InstanceNumber; ?></td>
            <td align="center"><font color='<?php echo $scolor; ?>'><?php echo $Status; ?></font></td>
            <td><a href="DetailView_Edit.php?sid=<?php echo $StudyID; ?>&page=<?php echo $nowPage; ?>">浪跌</a></td>
        </tr>
    <?php
			$rcnt++;
            $rs->MoveNext();
        }
        $rs->Close();
    }	
	//echo $rcnt."<br>";
	if ($rcnt<16){$rcnt=16-$rcnt;}
	else{$rcnt=($rcnt-1)/($nowPage*15)-1;}
	//echo $rcnt;
	for ($row=0;$row<$rcnt;$row++){
		echo "<tr height='25'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
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
	else echo "°常矪瞶Ч";
	?>
    </td>
</tr>
</table>
<?php include "footer.php" ?>