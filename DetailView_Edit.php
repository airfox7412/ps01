<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
if ($_GET["cmd"]=="next"){	
	$cmd=$_GET["cmd"]; 
}
if (@$_GET["sid"]!='') {
	$sdate=$_GET["sdate"];
	$sid=$_GET["sid"];
	$page=$_GET["page"];
}
if ($page==''){ $page=1; }
//echo "<font color=#ffffff>".$sid."</font>";
?>
<?php
$conn = ew_Connect();

$ColorArray=array("#77ffff","#ffff00","#77ff77","#00ffff","#77ffff","#ffff00","#77ff77","#00ffff","#77ffff","#ffff00","#77ff77","#00ffff","#77ffff");

$sSql="SELECT * FROM img_para WHERE pid=1";
if ($rs = $conn->Execute($sSql)) {
	$rs->MoveFirst();
	if(!$rs->Eof()){
		$wo_position=$rs->fields('img_position');
		$wo_width=$rs->fields('img_width');
		$wo_height=$rs->fields('img_height');
		$wo_count=$rs->fields('img_count');
	}
	$rs->Close();
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>檢視即時影像</title>
  <meta http-equiv="Content-Type" content="text/html; charset=BIG5" />
	<link rel="stylesheet" type="text/css" href="ps02.css">
	<link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.7.2.custom.css" />
  
	<script type="text/javascript" src="Scripts/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="Scripts/jquery-ui-1.7.2.js"></script>	
	<script type="text/javascript" src="Scripts/jquery.blockUI.js"></script>
	<script type="text/javascript" src="Scripts/jquery.textarea-expander.js"></script>
	<script type="text/javascript" src="js/ZeroClipboard.js"></script>

<script language="JavaScript" type="text/javascript">
function showimg(sid,sno){
  var url='showimg5.php?sid='+sid+'&sno='+sno;
  var para='width=<?php echo $wo_width; ?>,height=<?php echo $wo_height; ?>,top=0,left=<?php echo $wo_position; ?>,toolbar=no,menubar=no, scrollbars=yes,resizable=yes,location=no,status=no';
  //alert(jQuery.browser.mobile);
<?php //if($_SESSION['level']=='0'){ ?>
	if(jQuery.browser.mobile){
	//var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
	//if(isAndroid){
		window.open(url,'showimage',''); //手機版
	}else {
		window.open(url,'showimage',para); //電腦版
	}
<?php //} ?>
}

function showimg2(dno,sid){
  var url='showimg2.php?dno='+dno+'&sid='+sid;
  var para='<?php echo $wo_width; ?>,height=<?php echo $wo_height; ?>,top=0,left=<?php echo $wo_position; ?>,toolbar=no,menubar=no, scrollbars=yes,resizable=yes,location=no,status=no';
  var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
	if(isAndroid){
		window.open(url,'showimage','');
	}else {
  	window.open(url,'showimage',para);
  }
}

function ChangeFunc(f){
  if (f==1) {
	  $("#refbt").val("完整字詞");
	  document.getElementById("refbt").onclick=function(){ChangeFunc(2)};
	  }
  else {
	  $("#refbt").val("包含字詞");
	  document.getElementById("refbt").onclick=function(){ChangeFunc(1)};	
	  }
}

function copyToClipBoard(){//複製到剪貼簿
   var clipBoardContent=''; 
   clipBoardContent+=document.form2.ExamMemo.value;
   //clipBoardContent+='\n';
   window.clipboardData.setData("Text",clipBoardContent);
   var msg=clipBoardContent;
	$.blockUI({
				theme: true,
				title: '複製到剪貼簿',
				message: msg,
				css: {border:'5px solid white',background:'#0000ff',padding:'10px',color:'white'},
				timeout: 2000
				});	
}

function CopyToCB(idStr){ //複製到報告
var clipBoardContent='';
	clipBoardContent=document.getElementById(idStr).value;
	clipBoardContent=clipBoardContent.replace("&", "and");
	var memo1=$("#ExamMemo").attr("value");
	$("#ExamMemo").html(memo1+'\n'+clipBoardContent);
	$("#ExamMemo").TextAreaExpander();
	var msg=memo1+'\n'+clipBoardContent;
	$.blockUI({
				theme: true,
				title: '複製到報告',
				message: msg,
				css: {border:'5px solid white',background:'#0000ff',padding:'10px',color:'white'},
				timeout: 2000
				});	
}

function turnD(clicked_id){
	var idname=clicked_id;
	var imgname=idname.replace("Dbtn", "img");
	var img=$('#'+imgname).attr('src-org');
	var bval='Val'+idname.replace("Dbtn", '');
	var bv=parseInt($('#'+bval).val());
	if (bv>=0){
		bv=-100;
		}
	else if (bv<=-100){
		bv=-150
	}	
	$('#'+bval).val(bv);
	$.ajax({
    type:'GET',
		url:"chgimg.php?img="+img+'&bv='+bv,
		cache:false,
		success:function(response){
			$('#'+imgname).attr('src', response+'?'+new Date().getTime());
			},
		error:function(xhr) {
  				alert('轉換錯誤！');
				}
		});
}

function turnO(clicked_id){
	var idname=clicked_id;
	var imgname=idname.replace("Obtn", "img");
	var img=$('#'+imgname).attr('src-org');
	var bval='Val'+idname.replace("Obtn", '');
	var bv=0;
	$('#'+bval).val(bv);
	$.ajax({
    type:'GET',
		url:"chgimg.php?img="+img+'&bv='+bv,
		cache:false,
		success:function(response){
			$('#'+imgname).attr('src', response+'?'+new Date().getTime());
			},
		error:function(xhr) {
  				alert('轉換錯誤！');
				}
		});
}

function turnL(clicked_id){
	var idname=clicked_id;
	var imgname=idname.replace("Lbtn", "img");
	var img=$('#'+imgname).attr('src-org');
	var bval='Val'+idname.replace("Lbtn", '');
	var bv=parseInt($('#'+bval).val());
	if (bv<=0){
		bv=100;
		}
	else if (bv>=100){
		bv=150
	}	
	$('#'+bval).val(bv);
	$.ajax({
    type:'GET',
		url:"chgimg.php?img="+img+'&bv='+bv,
		cache:false,
		success:function(response){
			$('#'+imgname).attr('src', response+'?'+new Date().getTime());
			},
		error:function(xhr) {
  				alert('轉換錯誤！');
				}
		});
}
</script>
<script type="text/javascript">
	$(document).ready(function() {	// JQuery Document Ready
		
		//ZeroClipboard.setMoviePath( "js/ZeroClipboard.swf" ); 
    //var clip = null;
    
		//clip = new ZeroClipboard.Client();
		//clip.setHandCursor( true );
		//clip.addEventListener('mouseOver', my_mouse_over);
		//clip.addEventListener('complete', my_complete);
		//clip.glue('d_clip_button');
		
		function my_mouse_over(client) { // we can cheat a little here -- update the text on mouse over
			clip.setText($("#ExamMemo").attr("value"));
		}
		
		function my_complete(client, text) {
			$.blockUI({
				theme: true,
				title: '複製到剪貼簿',
				message: $("#ExamMemo").attr("value"),
				css: {border:'5px solid white',background:'#0000ff',padding:'10px',color:'white'},
				timeout: 2000
				});
		}
		
		$("#ExamMemo").TextAreaExpander();
		$("#rdesc").TextAreaExpander();
				
		$("#scode").keyup(function(e){
			if (e.keyCode == '13') {
				var memo1=$("#ExamMemo").attr("value");
				$.ajax({
          type:'POST',
					url:"getdesc.php?scode="+$("#scode").attr("value"),
					cache:false,
					success:function(response){
						response=response.replace("&","and");
						$("#ExamMemo").val(memo1+response+'\n');
						//$("#rdesc").val(response);
						$("#scode").val("");
						$("#ExamMemo").TextAreaExpander();
						//$("#rdesc").TextAreaExpander();
						},
					error:function(xhr) {
	      				alert('轉換錯誤！');
	    				}
					});
			}		
		});
    
    $("#btn0").click(function(){
			var memo1=encodeURI(encodeURI($("#AddPatient").attr("value")));		
			$.ajax({
					type: "POST",
					url:"saveadddesc.php",
					data: "sid="+$("#sid").attr("value")+"&memo="+memo1,
					complete: function(){
			    	$.blockUI({
							theme: true,
							title: '主述病歷',
							message:'儲存成功！',css:{border:'5px solid white',background:'#ff0000',padding:'10px',color:'white'},
							timeout: 1000
						});	
						},
					error: function(){
						alert("儲存錯誤！");
						}	
					});		
    });
    
    $("#btn2").click(function(){
			var memo1=encodeURI(encodeURI($("#ExamMemo").attr("value")));
			//memo1.replace("&", "＆");
    	$.blockUI({
				message:'儲存中...',css:{border:'5px solid white',background:'#ff0000',padding:'10px',color:'white'}
			});			
			$.ajax({
					type: "POST",
					url:"savedesc.php",
					data: "sid="+$("#sid").attr("value")+"&memo="+memo1,
					success:function(response){
							$("#ExamMemo").html(response);
							//$("#rdesc").html(response);
							$("#ExamMemo").TextAreaExpander();
							//$("#rdesc").TextAreaExpander();
							if(response.trim()==''){
								$("#status").html("<font color='#ff0000'>N</font>");
							}
							else{
								$("#status").html("<font color='#00ff00'>Y</font>");
							}
						},
					error: function(){
						alert("儲存錯誤！");
						}	
					});
			$.unblockUI();			
    });
    
    $("#btn3").click(function(){
			var memo1=encodeURI(encodeURI($("#ExamMemo").attr("value")));
    	$.blockUI({
				message:'儲存中...',css:{border:'5px solid white',background:'#ff0000',padding:'10px',color:'white'}
			});			
			$.ajax({
					type: "POST",
					url:"savedesc.php",
					data: "sid="+$("#sid").attr("value")+"&memo="+memo1,
					success:function(response){
						$("#ExamMemo").html(response);
						//$("#rdesc").html(response);
						$("#status").html("<font color='#00ff00'>Y</font>");
						$("#btn4").click();
						},
					error: function(){
						alert("儲存錯誤！");
						}	
					});
			$.unblockUI();
    });

    $("#btn4").click(function(){
			window.location.href="DetailView_Edit.php?cmd=next&page="+$("#page").attr("value");	
    });
		
    $('textarea').autogrow();
	});	
	</script>
	
	<style type="text/css">
		.my_clip_button { width:100px; text-align:center; border:1px solid black; background-color:#ccc; margin:3px; padding:3px; cursor:default; font-size:11pt; }
		.my_clip_button.hover { background-color:#eee; }
		.my_clip_button.active { background-color:#aaa; }
	</style>
</head>
<body topmargin="0" leftmargin="0" bgcolor="#000000">
<input type="button" value="返回瀏覽(Back to List)" id="btnnext" onClick="window.location.href='DetailView_list.php?page=<?php echo $page; ?>'"><BR>
<?php
if ($cmd=="next"){
  $sSql="SELECT DetailNo,StudyID,Status FROM patient_detail WHERE Status='N'";
  if ($rs = $conn->Execute($sSql)) {
	  $rs->MoveFirst();
	  if (!$rs->EOF){		
		  $sid=$rs->fields('StudyID');
		  $sflag=1;	
	  }
	  else {
		  $sflag=0;
		  echo "<script>";
		  echo "alert('都處理完了，將返回流覽畫面！');";
		  echo "window.location='DetailView_list.php?cmd=reset';";
		  echo "</script>";
	  }
	  $rs->Close();
  }
  echo $sdate;
}
$sSql1 = "SELECT StudyID FROM exam_data WHERE StudyID='".$sid."'"; //依StudyID查詢
if ($rs = $conn->Execute($sSql1)){
	$rs->MoveFirst();
	if($rs->EOF){
		$sSql2 ="INSERT INTO exam_data (StudyID) VALUE('".$sid."')"; //建立新的空病例資料
	}
	$conn->Execute($sSql2);
}
	
$sSql="SELECT * FROM patient_detail a, patient_main b ";
$sSql.="WHERE a.PatientID=b.PatientID AND a.StudyID='".$sid."' ";
//$sSql.="AND a.StudyID=c.StudyID ";
//$sSql.="GROUP BY a.StudyID";
//echo $sSql;
if ($rs = $conn->Execute($sSql)) {
	$rs->MoveFirst();
	if (!$rs->EOF){
		$DetailNo=$rs->fields('DetailNo');
		$StudyID=$rs->fields('StudyID');
		$PatientID=$rs->fields('PatientID');
		$PatientName=$rs->fields('PatientName');
		$PatientBirthDate=$rs->fields('PatientBirthDate');
		$PatientAge=date(Y)-left($PatientBirthDate,4);
		$PatientSex=$rs->fields('PatientSex');
		$StudyDate=$rs->fields('StudyDate');
		$datefrom=$StudyDate;
		$StudyTime=$rs->fields('StudyTime');
		$Modality=$rs->fields('Modality');
		$BodyPartExamined=$rs->fields('BodyPartExamined');
		$ProtocolName=$rs->fields('ProtocolName');
		$InstanceNumber=$rs->fields('InstanceNumber');
		$Status=$rs->fields('Status');
		//$AddPatient=$rs->fields('AdditionalPatientHistory');
		
		//--取得病歷內容 exam_data		
		$sSql3 = "SELECT * FROM exam_data ";
		$sSql3.= "WHERE StudyID='".$StudyID."'";
		if ($rs3 = $conn->Execute($sSql3)){
		$rs3->MoveFirst();
		if(!$rs3->EOF){
			$AddPatient=$rs3->fields('AdditionalPatientHistory');
			$ExamMemo=$rs3->fields('memo1');			
			$ExamMemo=str_replace("<br>","\r\n",$ExamMemo);
			$ExamMemo=str_replace("&","＆",$ExamMemo);
			$count = count(explode ("\n", $ExamMemo))+2;
			
			//測試檢視內容
			$rdesc=$rs3->fields('memo1');			
      $rdesc=str_replace(":",":<br>",$rdesc);
      $rdesc=str_replace(",",",<br>",$rdesc);
      $rdesc=str_replace(".",".<br>",$rdesc);
			$rdesc=str_replace("&"," and ",$rdesc);
			//$rdesc=str_replace("shows","shows<br>",$rdesc);
      $rdesc=str_replace("?"," ",$rdesc);
      $rdesc=str_replace("1.<br>□","<br>1.□",$rdesc);
      $rdesc=str_replace("2.<br>□","<br>2.□",$rdesc);
      $rdesc=str_replace("3.<br>□","<br>3.□",$rdesc);
			}
		}
		$rs3->Close();
		//--取得病歷內容 exam_data
		
		if ($Status=='Y'){
			$Status="<font color='#00ff00'>".$Status."</font>";
			}
		else{
			$Status="<font color='#ff0000'>".$Status."</font>";
			}	
	}
?>
<table width="115%">
	<tr valign="bottom">
  	<td align="left">
      <table bgcolor="#111111">
        <tr>
          <td width="80"><span class="nfont">病歷號碼：</span></td>
          <td align="left"><span class="vfont"><?php echo $PatientID; ?></span></td>
        </tr>
        <tr>
          <td><span class="nfont">病歷日期：</span></td>
          <td align="left"><span class="vfont"><?php echo $StudyDate; ?></span></td>
        </tr>
        <tr>
          <td></td><!-- 病歷時間 -->
          <td align="left"><span class="vfont"><?php echo $StudyTime; ?></span></td>
        </tr>
        <tr>
          <td><span class="nfont">病患姓名：</span></td>
          <td align="left"><span class="vfont"><?php echo $PatientName; ?></span></td>
        </tr>
        <tr>
          <td><span class="nfont">病患姓別：</span></td>
          <td align="left"><span class="vfont"><?php echo $PatientSex; ?></span></td>
        </tr>
        <tr>
          <td><span class="nfont">病患年齡：</span></td>
          <td align="left"><span class="vfont"><?php echo $PatientAge; ?></span></td>
        </tr>
        <tr>
          <td><span class="nfont">檢查序號：</span></td>
          <td align="left"><span class="vfont"><?php echo $StudyID; ?></span></td>
        </tr>            
        <tr>
          <td><span class="nfont">檢查種類：</span></td>
          <td align="left"><span class="vfont"><?php echo $Modality; ?></span></td>
        </tr>
        <tr>
          <td><span class="nfont">處理狀態：</span></td>
          <td align="left"><span class="vfont"><div id="status"><?php echo $Status; ?></div></span></td>
        </tr>
        <tr>
          <td align="right"><span class="nfont">主述：</span></td>
          <td align="left">
          	<textarea name="AddPatient" id="AddPatient" cols="30" rows="6" wrap="on"><?php echo $AddPatient; ?></textarea>
          </td>
        </tr>
        <tr>
          <td></td>
          <td align="left">
          	<!--<input type="button" name="btn0" id="btn0" value="儲存主述">-->
          </td>
        </tr>
      </table>
    </td>
    <td align="left">
    	<table bgcolor="#555555">
      	<tr>
	      <?php
	      $rs->MoveFirst();
	      $RowCnt = 0;
	      $BodyPart='';
	      while (!$rs->EOF){
	        $RowCnt++;
	        $image=trim("/pacsimages/".EW_CONN_DB."/".$rs->fields('image'));
	        $BodyPartExamined=$rs->fields('BodyPartExamined');
	        $ProtocolName=$rs->fields('ProtocolName');            
					$DetailNo=$rs->fields('DetailNo');
					$StudyID=$rs->fields('StudyID');
					$Sno=$rs->fields('SeriesNumber');
					$BodyPart=$BodyPart.$BodyPartExamined.',';
					if (file_exists(PACS_PATH.$image)==False){
						$image="images/nopic.jpg";
						$fname=@ImageCreateFromJPEG($image);
			  	  $biWidth = ImageSX($fname);
			  	  $biHeight = ImageSY($fname);
						$imgw=$biWidth;
						$imgh=$biHeight;
					}
					else{
						$fname=@ImageCreateFromJPEG(PACS_PATH.$image);
						$biWidth = ImageSX($fname);
						$biHeight = ImageSY($fname);
						$biValue = ($biWidth/IMG_SIZE_1);
						$bi_Height = (int)($biHeight/$biValue);
						$imgw=IMG_SIZE_1;
						$imgh=$bi_Height;
						imagedestroy($fname);
					}
			    if (($Modality=='CR')||($Modality=='MG')){
	      ?>
	          <td bgcolor="#333333" align="left">
	          	<?php echo '<span class="vfont">'.$BodyPartExamined.'</span>-<span class="nfont">'.$ProtocolName.'</span>';?>
	          	<input type="hidden" id="Val<?=$RowCnt?>" value="0" size="1" onclick="turnV(this.id)">&nbsp;
	          	<input type="button" id="Dbtn<?=$RowCnt?>" value="- " onclick="turnD(this.id)">&nbsp;
	          	<input type="button" id="Obtn<?=$RowCnt?>" value="=" onclick="turnO(this.id)">&nbsp;
	          	<input type="button" id="Lbtn<?=$RowCnt?>" value="+" onclick="turnL(this.id)"><br>
	          	<img id="img<?=$RowCnt?>" src="<?php echo $image;?>" src-org="<?php echo $image;?>" width="<?php echo $imgw;?>" border="1" onclick="showimg('<?=$StudyID?>','<?=$Sno?>');">
	          </td>
	      <?php
	        }
	        else{
	      ?>
	          <td bgcolor="#333333">
	          	<?php echo '<span class="vfont">'.$BodyPartExamined.'</span>-<span class="nfont">'.$ProtocolName.'</span>' ?>
	          	<img src="<?php echo $image;?>" width="<?php echo $imgw;?>" height="<?php echo $imgh;?>" border="1" onclick="showimg2('<?php echo $DetailNo; ?>','<?php echo $StudyID;?>');">
	          </td>
	      <?php    	
	        } 
	        if ($RowCnt % $wo_count == 0){
	          echo "</tr>";
	        }
	        $rs->MoveNext();
	      }
	      ?>
      </table>
    </td>
  </tr>
</table>
<?php
  //取得歷史病歷內容
	if(trim($ExamMemo)==''){
		$sSql0="SELECT a.`StudyID`,a.`PatientID`,a.`StudyDate`,a.`Modality`,a.`BodyPartExamined`,a.`ProtocolName`, b.`StudyID`, b.`memo1` from patient_detail as a ";
		$sSql0.="INNER JOIN exam_data as b ON a.`StudyID`=b.`StudyID` ";
		$sSql0.="WHERE a.`PatientID`='".$PatientID."' ";
		$sSql0.="GROUP BY a.`StudyID` ";
		$sSql0.="ORDER BY a.`StudyDate` Desc";
		$arr=explode(",",$BodyPart); //分割字串$BodyPart 	
		//echo '<font color=#ffff00>'.$sSql0.'</font><br>';
		//echo '<font color=#00ff00>'.$arr[0].' '.$arr[1].'</font><br>';
		if ($rs0 = $conn->Execute($sSql0)) {
			$rs0->MoveFirst();
			$rs0->MoveNext();
			while(!$rs0->EOF){
				$memo0=$rs0->fields('memo1');
				$BodyPartExamined=$rs0->fields('BodyPartExamined');
		    //echo '<font color=#ff0000>'.$BodyPartExamined.'</font><br>'; 
				if(in_array($BodyPartExamined,$arr)){ //比較包含在陣列中？
					$memo0=str_replace("&","＆",$memo0);
					$ExamMemo.=trim($memo0);
		      //echo '<font color=#00ffff>'.$ExamMemo.'</font><br>';
					break;
				}
				$rs0->MoveNext();
			}
			$rs0->Close();
		}
	}
?>	
<table width="115%">
  <tr>
    <td colspan="2">
      <!--<form id="form2" onsubmit="return False">-->
      <input type="hidden" name="sid" id="sid" value="<?php echo $StudyID;?>">
      <input type="hidden" name="page" id="page" value="<?php echo $page;?>">
      <table>
      	<tr>
        	<td width="80"><font color="#0000ff">報告簡碼：</font></td>
          <td><input type="text" name="scode" id="scode" size="30" value=""></td>
          <td align="left">	
          	<!--<div id="d_clip_button" class="my_clip_button">複製到剪貼簿</div>-->
            	<input type="button" name="btn1" value="病歷複製到剪貼簿" onClick="copyToClipBoard();">
     			</td>     			
<?php if (@$_SESSION['level']=='0'||@$_SESSION['level']=='1') { ?>
      		<td align="left">
          	<input type="button" name="btn2" id="btn2" value="儲存病歷">
          	<input type="button" name="btn3" id="btn3" value="儲存並至下一筆">
			      <?php if($sflag=1){ ?>
			      	<input type="button" name="btn4" id="btn4" value="下一筆">
            <?php } ?>
      		</td>
<?php } ?>      		
  		 	</tr> 
  		 	<tr valign="Top">
  				<td colspan="3">
  					<textarea name="ExamMemo" id="ExamMemo" cols="80" wrap="on" onChange="clip.setText(this.value)"><?php echo $ExamMemo;?></textarea>
  				</td>
<?php if (@$_SESSION['level']=='0') { ?>  				
          <td bgcolor="#555555">
          	<!--<textarea name="rdesc" id="rdesc" rows="8" cols="100" wrap="on" class="textarea_desc" readonly="readonly"><?php echo $rdesc; ?></textarea>-->
          	<?php echo '<font color="#00ffff">'.$rdesc.'</font>'; ?>
          </td> 
<?php } ?>              
        </tr>
      </table>
      <!--</form>--> 
  	</td>            
  </tr>
</table>
<?php		
}
?>
<?php
//以下為歷史病歷資料顯示
$sSql="SELECT * FROM patient_detail a, patient_main b ";
$sSql.="WHERE a.PatientID=b.PatientID "; //$sSql.="AND a.StudyID=c.StudyID ";
$sSql.="AND a.PatientID='".$PatientID."' AND a.StudyDate<'".$StudyDate."' ";
$sSql.="GROUP BY a.StudyDate ";
$sSql.="ORDER BY a.StudyDate DESC";
?>
<table style="border:opx solid;" width="100%">
	<tr>
		<td align="left" width="5%"><font size="2" color="#ffffff"><?php echo date(Y)."-".date(m)?></font></td>
		<?php
		if ($rs = $conn->Execute($sSql)) {
		  $rs->MoveFirst();	//繪製日期線條
		  $oldlen=0;
		  $all=0;	  
		  for($x=0;$x<$rs->recordcount();$x++){
			  $dateto=$rs->fields('StudyDate');
			  $all_StudyDate=abs(datediff('d', $datefrom, $dateto));
			  $all=$all+$all_StudyDate;
			  $rs->MoveNext();
		  }
		  $rs->MoveFirst();
		  for($x=0;$x<$rs->recordcount();$x++){
			  $sid=$rs->fields('StudyID');
			  $dateto=$rs->fields('StudyDate');
			  $all_StudyDate=abs(datediff('d', $datefrom, $dateto));
			  $oldlen=$all_StudyDate;
			  $oldlen=round(($oldlen/$all)*100);
			  if ($oldlen<=1){ $oldlen=5; }
			  echo "<td width='".$oldlen."%' align='left' valign='top' style='background-color:".$ColorArray[$x]."' onclick=\"JavaScript:Alert('Hi');\">";
			  echo "<font color='#000000'>".$all_StudyDate."天前</font> <font color='#0000ff'>".get_spword($sid)."</font></td>";
			  $rs->MoveNext();
		  }
		}
		?>
	</tr>
</table>
<input type="button" id="refbt" value="包含字詞" onClick="ChangeFunc(1);">        
<input type="hidden" id="pno" value="<?php echo $pno;?>">
<input type="hidden" id="pdate" value="<?php echo $pdate;?>">
<?php
//------------------------------------------------------------------------------------------------------			
$rs->MoveFirst();	//取得所有歷史病歷資料
for($x=0;$x<$rs->recordcount();$x++){	
  $StudyID=$rs->fields('StudyID');		
	$sSql4 = "SELECT * FROM exam_data ";
	$sSql4.= "WHERE StudyID='".$StudyID."'";
	if ($rs4 = $conn->Execute($sSql4)){
		$rs4->MoveFirst();
		if(!$rs4->EOF){
			$memo0=$rs4->fields('AdditionalPatientHistory');
			$memo1=$rs4->fields('memo1');
		}
	}
	$rs4->Close();
	//--取得病例內容 exam_data
	
  $memo_org=$memo1;
  $examdate1=$rs->fields('StudyDate');
  $all_StudyDate=$rs->fields('to_days(curdate())-to_days(StudyDate)');
?>	        	  
<table style="width:100%; border:2px solid; border-color: <?php echo $ColorArray[$x]?>;">
  <tr>
    <td style="border:2px solid; background-color: <?php echo $ColorArray[$x]?>;">
    <b><font style="color:#000; font-style:italic;"><?php echo $examdate1?></font></b>&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" value="複製" onClick="CopyToCB('<?php echo "m_".$StudyID?>');">
    <?php
    //取得並秀出Special code 顯示特殊字串與內容
    $conn1 = ew_Connect00(); 
    $spSql="SELECT * FROM report_special_word WHERE UserID='doc'";
    if($spRS = $conn1->Execute($spSql)){
    	  //echo $spRS->fields('ReportSpecialWord');
        $spRS->MoveFirst();
        $c=0;
        $CodeArray[]="";
        $findInt=0;
        while (!$spRS->EOF){
            $sp_code=$spRS->fields('ReportSpecialCode');
            $sp_grade=$spRS->fields('ReportSpecialGrade');
            $sp_word=$spRS->fields('ReportSpecialWord');
            $sp_word=" ".$sp_word." ";
            //echo $sp_word;
            //$sp_word=strtoupper(substr(trim($sp_word),0,1)).substr(trim($sp_word),1,(strlen(trim($sp_word))-1));
            if (stripos($memo1,$sp_word)!=false) {
                $CodeArray[$c]=$sp_code.$sp_grade."(".trim($spRS->fields('ReportSpecialWord')).") ";
                $c++;
                $findInt++;
                $memo1=str_ireplace($sp_word,"<font color='".$ColorArray[$findInt-1]."'>".$sp_word."</font>",$memo1);
                }
            $sp_word=" ".trim($sp_word)."s ";
            if (stripos($memo1,$sp_word)!=false) {
                $CodeArray[$c]=$sp_code.$sp_grade."(".trim($spRS->fields('ReportSpecialWord')).") ";
                $c++;
                $findInt++;
                $memo1=str_ireplace($sp_word,"<font color='".$ColorArray[$findInt-1]."'>".$sp_word."</font>",$memo1);
                }					
            $spRS->MoveNext();
            }
        echo "<font color='#ffffff'>";
        for($c=0;$c<count($CodeArray);$c++){
            echo "<font color='#000000'>".$CodeArray[$c]."</font>";
            $CodeArray[$c]="";
            }	
        echo "</font>";
        if (!strpos($memo1, "乳房攝影報告")){
	        $memo1=str_replace(":",":<br>",$memo1);
	        $memo1=str_replace(",",",<br>",$memo1);
	        $memo1=str_replace(".",".<br>",$memo1); 
	        $memo1=str_replace("?"," ",$memo1);
      	}
      	else{	
	        $memo0=str_replace("；","；<br>",$memo0);  
	        $memo0=str_replace("。","。<br>",$memo0);
	        $memo0=str_replace("？","？<br>",$memo0);
	        $memo0=str_replace("□","&nbsp;&nbsp;□",$memo0); 
	        $memo0=str_replace("■","&nbsp;&nbsp;■",$memo0); 
	        
	        $memo1=str_replace(":",":<br>",$memo1);
	        $memo1=str_replace(".",".<br>",$memo1);   
	        $memo1=str_replace("。","。<br>",$memo1); 
	        $memo1=str_replace("1.<br>□","<br>1.□",$memo1);
	        $memo1=str_replace("2.<br>□","<br>2.□",$memo1);
	        $memo1=str_replace("3.<br>□","<br>3.□",$memo1);
	      }
    }
    $conn1->Close();    	
?>
    </td>
	</tr>  
  <tr>
    <td>
			<?php
			$sSql="SELECT StudyID, SeriesNumber, image, Modality, BodyPartExamined, ProtocolName FROM patient_detail ";
			$sSql.="WHERE StudyID='".$StudyID."'";
			$wkrs = $conn->Execute($sSql);
			?>
	    <table style="border:0px solid; width:100%">
	      <tr bgcolor="#333333">
	      <?php
	      $RowCnt=0;
	      while (!$wkrs->EOF){
	      	$RowCnt++;
					$image=trim("/pacsimages/".EW_CONN_DB."/".$wkrs->fields('image'));
					$StudyID=$wkrs->fields('StudyID');
					$Sno=$wkrs->fields('SeriesNumber');
					$Modality=$wkrs->fields('Modality');
					$BodyPartExamined=$wkrs->fields('BodyPartExamined');
					$ProtocolName=$wkrs->fields('ProtocolName');
					if (file_exists(PACS_PATH.$image)==False){
						$image="images/nopic.jpg";					
					  $fname=@ImageCreateFromJPEG($image);
					}
					else{
						$fname=@ImageCreateFromJPEG(PACS_PATH.$image);
					}	
					$biWidth = ImageSX($fname);
					$biHeight = ImageSY($fname);
					$biValue = ($biWidth/IMG_SIZE_2);
					$bi_Height = (int)($biHeight/$biValue);
					$imgw=IMG_SIZE_2;
					$imgh=$bi_Height;
						
				  imagedestroy($fname);
					if ($Modality=='CR'){
	      ?>
	        <td style="width:100px;"><?php echo '<span class="vfont">'.$BodyPartExamined.'</span>-<span class="nfont">'.$ProtocolName.'</span>';?><br>
	        <img src="<?php echo $image;?>" width="<?php echo $imgw;?>" height="<?php echo $imgh;?>" border="1" 
	        onclick="showimg('<?=$StudyID?>','<?=$Sno?>');">
	        <!--onclick="javascript:showimg('<?php echo $image ?>','<?php echo $BodyPartExamined.$ProtocolName;?>');">-->
	        </td>
	      <?php
	      }
	      else{
	    	?>
	    	  <td style="width:100px;"><?php echo '<span class="vfont">'.$BodyPartExamined.'</span>-<span class="nfont">'.$ProtocolName.'</span>';?><br>
	        <img src="<?php echo $image;?>" width="<?php echo $imgw;?>" height="<?php echo $imgh;?>" border="1" 
	         onclick="javascript:showimg2('<?php echo $image ?>','<?php echo $BodyPartExamined.$ProtocolName;?>');">
	        </td>
	    	<?php
	      }              
	        if ($RowCnt % $wo_count == 0){
	          echo "</tr>";
	        }
	        $wkrs->MoveNext();
	      }
	      ?>
	      <td width="*"></td>
	      </tr>
	    </table>
    </td>
  </tr>
  <tr>
    <td>
    	<table width="100%">
    		<tr valign="top">
    			<td width="50%"><font color="#ffff00"><?php echo $memo0?></font></td>	
    			<td width="50%">&nbsp;&nbsp;<font color="#ffffff"><?php echo $memo1?></font></td>
        </tr>
      </table>
      <input type="hidden" id="m_<?php echo $StudyID?>" value="<?php echo $memo_org?>" />
    </td>
  </tr>
<?php
$rs->MoveNext();
}
?>
</table>
</body>
</html>
<?php
function right($value, $count){
    return substr($value, ($count*-1));
}

function left($string, $count){
    return substr($string, 0, $count);
}

function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
    /*
    $interval can be:
    yyyy - Number of full years
    q - Number of full quarters
    m - Number of full months
    y - Difference between day numbers
        (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
    d - Number of full days
    w - Number of full weekdays
    ww - Number of full weeks
    h - Number of full hours
    n - Number of full minutes
    s - Number of full seconds (default)
    */
    
    if (!$using_timestamps) {
        $datefrom = strtotime($datefrom, 0);
        $dateto = strtotime($dateto, 0);
    }
    $difference = $dateto - $datefrom; // Difference in seconds
     
    switch($interval) {
     
    case 'yyyy': // Number of full years

        $years_difference = floor($difference / 31536000);
        if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
            $years_difference--;
        }
        if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
            $years_difference++;
        }
        $datediff = $years_difference;
        break;

    case "q": // Number of full quarters

        $quarters_difference = floor($difference / 8035200);
        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
        }
        $quarters_difference--;
        $datediff = $quarters_difference;
        break;

    case "m": // Number of full months

        $months_difference = floor($difference / 2678400);
        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
        }
        $months_difference--;
        $datediff = $months_difference;
        break;

    case 'y': // Difference between day numbers

        $datediff = date("z", $dateto) - date("z", $datefrom);
        break;

    case "d": // Number of full days

        $datediff = floor($difference / 86400);
        break;

    case "w": // Number of full weekdays

        $days_difference = floor($difference / 86400);
        $weeks_difference = floor($days_difference / 7); // Complete weeks
        $first_day = date("w", $datefrom);
        $days_remainder = floor($days_difference % 7);
        $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
        if ($odd_days > 7) { // Sunday
            $days_remainder--;
        }
        if ($odd_days > 6) { // Saturday
            $days_remainder--;
        }
        $datediff = ($weeks_difference * 5) + $days_remainder;
        break;

    case "ww": // Number of full weeks

        $datediff = floor($difference / 604800);
        break;

    case "h": // Number of full hours

        $datediff = floor($difference / 3600);
        break;

    case "n": // Number of full minutes

        $datediff = floor($difference / 60);
        break;

    default: // Number of full seconds (default)

        $datediff = $difference;
        break;
    }    

    return $datediff;

}
?>
<?php
function get_spword($sid) {
	$conn = ew_Connect();
    $Sql="SELECT StudyID,memo1 FROM exam_data WHERE StudyID='".$sid."'";		
    if($RS = $conn->Execute($Sql)){
        $RS->MoveFirst();
		$memo1=$RS->fields('memo1');
	}
		
    $spSql="SELECT * FROM report_special_word";		
    if($spRS = $conn->Execute($spSql)){
        $spRS->MoveFirst();
        $c=0;
        $CodeArray[]="";
        $findInt=0;
        while (!$spRS->EOF){
            $sp_code=$spRS->fields('ReportSpecialCode');
            $sp_grade=$spRS->fields('ReportSpecialGrade');
            $sp_word=$spRS->fields('ReportSpecialWord');
            $sp_word=" ".$sp_word." ";
            if (stripos($memo1,$sp_word)!=false) {
                $CodeArray[$c]=$sp_code.$sp_grade."(".trim($spRS->fields('ReportSpecialWord')).") ";
                $c++;
                $findInt++;
                }
            $sp_word=" ".trim($sp_word)."s ";
            if (stripos($memo1,$sp_word)!=false) {
                $CodeArray[$c]=$sp_code.$sp_grade."(".trim($spRS->fields('ReportSpecialWord')).") ";
                $c++;
                $findInt++;
                }					
            $spRS->MoveNext();
            }
    }
	$memo1="";
	for($c=0;$c<count($CodeArray);$c++){
		$memo1.=$CodeArray[$c];
		$CodeArray[$c]="";
		}
	return $memo1;
}	
?>