<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "SplitPage.php" ?>
<?php
header("Content-Type:text/html; charset=BIG5"); 

if(@$_GET['cmd']=='reset'){ //���ϥΨ즹�\��
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
else if(@$_GET['cmd']=='unps'){ //�������B�z
	$sdate1='';
	$sdate2='';
	$status1='N';	
	$sstr="AND a.Status='".$status1."' ";
}
else{	
	if(isset($_GET['page'])){ //����page
	  $sdate1=$_SESSION['sdate1'];
	  $sdate2=$_SESSION['sdate2'];
	  $status1=$_SESSION['status1'];
	  $pid=$_SESSION['pid'];
		$pname=$_SESSION['pname'];
	}
	else{
	  if(@$_GET['act']='S'){	//���U�d��
		  $act=$_GET["act"];
		  $sdate1=$_POST["sdate1"];
		  $sdate2=$_POST["sdate2"];
		  $status1=$_POST["status1"];		  
		  $pid=$_POST["pid"];
		  $pname=$_POST["pname"];
		  
		  $_SESSION['pid']=$pid;
		  $_SESSION['pname']=$pname;
		  $_SESSION['sdate1']=$sdate1;
		  $_SESSION['sdate2']=$sdate2;
		  $_SESSION['status1']=$status1;
		  
		  $order=$_GET["order"];
		  $ordertype=$_GET["ordertype"];
	  }
	}
	if($sdate1==''){
	  $sdate1=date('Y/n/j', time()-4*24*3600); //�e�|��
	  //$sdate1=date('Y/n/1'); 
	}
	if($sdate2==''){
	  $sdate2=date('Y/n/j');
	}
	$sstr="AND a.StudyDate>='".$sdate1."' AND a.StudyDate<='".$sdate2."' ";
	if($status1=='Y' or $status1=='N'){
	  $sstr.="AND a.Status='".$status1."' ";
	}
	if($pid!=''){
	  $sstr.="AND(a.PatientID='".$pid."') ";
	}
	if($pname!=''){
	  $sstr.="AND(b.PatientName LIKE '".$pname."%') ";
	}
}

	
if ($order==''){
	$order=$_SESSION['order'];
	$ordertype=$_SESSION['ordertype'];
}else{
	$_SESSION['order']=$order;
	$_SESSION['ordertype']=$ordertype;	
}
			  
if ($order==''){
	$order='StudyDate';
}	
if($ordertype==''||$ordertype=='DESC'){
	$ordertype="ASC";
}
else if($ordertype=='ASC'){
	$ordertype="DESC";
}	
?>
<?php include "header.php" ?>
	<script type="text/javascript">
		ZeroClipboard.setMoviePath( "js/ZeroClipboard.swf" );
	</script>	
<form name="form1" id="form1" action="DetailView_list.php" method="post">
<table cellspacing="0" class="ewGrid">
<tr valign="top">
    <td class="ewGridContent">
    <input type="hidden" name="act" value="S">
    <input type="hidden" name="order" value="">    
    <input type="hidden" name="ordertype" value="">
    <table>
    	<tr valign="top">
            <td colspan="6">
            	�f�����X:<input name="pid" type="text" id="pid" value="<?php echo $pid; ?>" size="10">
              �m�W:<input name="pname" type="text" id="pname" value="<?php echo $pname; ?>" size="10">
            </td>
        </tr>
        <tr valign="top">
            <td>����d��:</td>
            <td>
                <input name="sdate1" type="text" id="sdate1" value="<?php echo $sdate1; ?>" size="10">��
                <input name="sdate2" type="text" id="sdate2" value="<?php echo $sdate2; ?>" size="10">
            </td>
            <td>�B�z���A:</td>
            <td>
                <select name="status1">
                    <option value="0" <?php if($status1=='0') echo 'selected';?>>����</option>
                    <option value="Y" <?php if($status1=='Y') echo 'selected';?>>�w�B�z</option>
                    <option value="N" <?php if($status1=='N') echo 'selected';?>>���B�z</option>
                </select>
            </td>
            <td><input type="submit" name="submit" value="�d��"></td>
            <td><input type="button" name="showall" value="�������B�z" onclick="window.location='DetailView_list.php?cmd=unps';"></td>
        </tr>
    </table>
    <table cellspacing="0" class="ewTable">
        <tr class="ewTableHeader">
            <td>��</td>            
            <td>�����Ҹ�</td>
            <td>�ݶE���</td>
            <td>�m�W</td>
            <td>�ʧO</td>
            <td>����</td>
            <td>�ݶE��</td>
            <td>��</td>
            <td>�D�z</td>
            <td>���i</td>
            <td>���A</td>
            <td>�˵�</td>
        </tr>
    <?php
    $conn = ew_Connect();
    $sql="SELECT a.PatientID,a.StudyID,a.StudyDate,b.PatientID,b.PatientSex FROM patient_detail a , patient_main b ";
    $sql.="WHERE a.PatientID=b.PatientID ";
    $sql.=$sstr;
    $sql.="GROUP BY a.StudyID ";
    //$sql.="ORDER BY a.StudyDate";
    //echo $sql."<br>";
    $rs = $conn->Execute($sql);
    $total=$rs->recordcount();
    
    if(isset($_GET['page']) and $_GET['page'] != 0 and is_numeric($_GET['page']))  //�]�w�ثe����
        $nowPage = $_GET['page'];
    else
        $nowPage = 1;
    $page = new SplitPage($nowPage, $total, 20, 20);  //�غc�X SplitPage ����
    $page->setViewList("DetailView_list.php?", 'reportcode');
    $rs->Close();
    
    $sql="SELECT * FROM patient_detail a , patient_main b ";
    $sql.="WHERE a.PatientID=b.PatientID ";
    $sql.=$sstr;
    $sql.="GROUP BY a.StudyID ";
		if ($order=='PatientName'||$order=='PatientSex'){
	    	$sql.="ORDER BY b.".$order." ".$ordertype." ";
		}
		else{	
	    	$sql.="ORDER BY a.".$order." ".$ordertype." ";
		}	
    $sql.="limit {$page->started_record}, {$page->records_per_page}";
    //echo $sql;
    if ($rs = $conn->Execute($sql)) {
		if ($nowPage!=1){$rcnt=($nowPage-1)*20+1;}
		else{$rcnt=1;}
        $rs->MoveFirst();
        while (!$rs->EOF){
            $DetailNo=$rs->fields('DetailNo');
            $PatientID=$rs->fields('PatientID');
  
            //$PatientID=substr($PatientID,0,strlen($PatientID)-4).'****'; //�Ӹ�k����
            $StudyDateTime=$rs->fields('StudyDate'); //$rs->fields('StudyTime');
            $PatientName=$rs->fields('PatientName');
            
            //$PatientName=substr($PatientName,0,strlen($PatientName)-4).'����'; //�Ӹ�k����
            $PatientSex=($rs->fields('PatientSex')=="M") ? "�k" : "�k";
            $BodyPart=$rs->fields('BodyPartExamined');
            $StudyID=$rs->fields('StudyID');
            $InstanceNumber=$rs->fields('InstanceNumber');
            $Status=$rs->fields('Status');
            //if($Status=='Y'){
            //    $scolor="#0000ff";
            //}
            //else{
            //    $scolor="#ff0000";
            //}
            //--���o�f�ҥD�z exam_data
            $exam="";
						$sSql1 = "SELECT * FROM exam_data ";
						$sSql1.= "WHERE StudyID='".$StudyID."'";
						if ($rs1 = $conn->Execute($sSql1)){
							$rs1->MoveFirst();
							if(!$rs1->EOF){
									$AdditionalPatientHistory="<a href='history_add.php?sid=".$StudyID."&name=".$PatientName."&sex=".$PatientSex."&page=".$nowPage."' class='nyroModal'>";
									$AdditionalPatientHistory.="<img src='imgs/edit.png' title='".$rs1->fields('AdditionalPatientHistory')."'>";
									$AdditionalPatientHistory.="</a>";
									if ($rs1->fields('AdditionalPatientHistory')=="")
										$AdditionalPatientHistory.="<font color=#cccccc>�ť�</font>";
									else
										$AdditionalPatientHistory.=substr($rs1->fields('AdditionalPatientHistory'),0,10)."<font color=#ff0000>...</font>";
									
									$exam=$rs1->fields('memo1');
									if ($exam=="")
										$memo1="<font color=#cccccc>�ť�</font>";
									else
										$memo1=substr($rs1->fields('memo1'),0,15)."<font color=#ff0000>...</font>";
								}
							}
						$rs1->Close();
										
						if ($Status=="Y"){
							$Status = "<a href='history_view.php?sid=".$StudyID."&name=".$PatientName."&sex=".$PatientSex."&page=".$nowPage."' class='nyroModal' target='_Blank'>";
							$Status .= "<img src='imgs/true.gif' title='".$exam."'>" ;
							$Status .= "</a>";
						}
						else
      				$Status = "";
      				
						//--���o�f�ҥD�z exam_data
    ?>		
        <tr>
            <td align="center"><?php echo $rcnt; ?></td>
            <td><?php echo $PatientID; ?></td>
            <td><?php echo $StudyDateTime; ?></td>
            <td><?php echo $PatientName; ?></td>
            <td align="center"><?php echo $PatientSex; ?></td>
            <td><?php echo $BodyPart; ?></td>
            <td><?php echo $StudyID; ?></td>
            <td align="center"><?php echo $InstanceNumber; ?></td>
            <td><?php echo $AdditionalPatientHistory; ?></td>
            <td><?php echo $memo1; ?></td>
            <td align="center"><?php echo $Status; ?></td>
						<?php if (@$_SESSION['level']<>'3'){?>
            	<td><a href="DetailView_Edit.php?sid=<?php echo $StudyID; ?>&page=<?php echo $nowPage; ?>"><img src="imgs/eye.png" title="�˵�"></a></td>
            <?php } else{ ?>
            	<td><img src="imgs/eye.png" title="�L�˵��v��"></td>
            <?php } ?>	
        </tr>
    <?php
			$rcnt++;
            $rs->MoveNext();
        }
        $rs->Close();
    }	
	//echo $rcnt."<br>";
	if ($rcnt<21){$rcnt=21-$rcnt;}
	else{$rcnt=($rcnt-1)/($nowPage*20)-1;}
	//echo $rcnt;
	for ($row=0;$row<$rcnt;$row++){
		echo "<tr height='25'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	}
    ?>					
    </table>
	</td>
</tr>
<tr>
	<td>
	<?php
	if($rcnt!=20){
		echo "<font color=#0000ff>".$page->viewlist."</font>";
	}
	else echo "�ܦn�㳣�B�z���F�I";
	?>
    </td>
</tr>
</table>
</form>
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