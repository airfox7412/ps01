<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
	$StudyID=$_GET['sid'];
	$Name=$_GET['name'];
	$Sex=$_GET['sex'];
	//$ph=$_GET['PH'];
	$nowPage=$_GET['page'];
  $conn = ew_Connect();
  $sSql = "SELECT * FROM exam_data WHERE StudyID='".$StudyID."'";
	$rs = $conn->Execute($sSql);
	$rs->MoveFirst();
	if (!$rs->EOF){
  	$memo1=$rs->fields("memo1");
  	$PatientHistory=str_replace("<br>","\r\n",$memo1);
	}
  $conn->Execute($sSql);
  $conn->Close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>報告內容檢視</title>
	<meta http-equiv="Content-Type" content="text/html; charset=big5">
	<link type="text/css" href="ps01.css" rel="stylesheet">
  
	<script type="text/javascript" src="Scripts/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="js/ZeroClipboard.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {	// JQuery Document Ready
			ZeroClipboard.setMoviePath( "js/ZeroClipboard.swf" ); 
	    var clip = null;
	    
			clip = new ZeroClipboard.Client();
			clip.setHandCursor( true );
			clip.addEventListener('mouseOver', my_mouse_over);
			clip.addEventListener('complete', my_complete);
			clip.glue('d_clip_button');
			
			function my_mouse_over(client) {
				clip.setText($("#PatientHistory").attr("value"));
			}
			
			function my_complete(client, text) {
				alert("複製到剪貼簿");
			}
		});
	</script>
	<style type="text/css">
		.my_clip_button { width:100px; text-align:center; border:1px solid black; background-color:#080; margin:3px; padding:3px; cursor:default; font-size:11pt; }
		.my_clip_button.hover { background-color:#f00; }
		.my_clip_button.active { background-color:#00f; }
	</style>
</head>
<body>
<table cellspacing="0" class="ewGrid">
<tr valign="top">
    <td class="ewGridContent">
    <form id="form1" name="form1" method="post">
    <table cellspacing="0" class="ewTable">
        <tr class="ewTableHeader">
            <td>看診號</td><td><?php echo $StudyID; ?></td>
        </tr>
        <tr class="ewTableHeader">    
            <td>姓名</td><td><?php echo $Name; ?></td>
        </tr>
        <tr class="ewTableHeader">
            <td>性別</td><td><?php echo $Sex; ?></td>
        </tr>
        <tr class="ewTableHeader">
            <td>報告</td>
            <td><div id="d_clip_button" class="my_clip_button">複製到剪貼簿</div>
            	<textarea name="PatientHistory" id="PatientHistory" cols="62" rows="15" wrap="on" style="overflow:scroll;"><?php echo $PatientHistory;?></textarea>
            </td>
        </tr>
    </table>
    </form>
	</td>
</tr>
</table>
</body>
</html>
<script type="text/javascript">
	document.getElementById("PatientHistory").focus();
</script>