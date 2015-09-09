<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
if (@$_GET["dno"] <> "") {
	$dno=$_GET["dno"];
	$sid=$_GET["sid"];
}
$conn = ew_Connect();
$sSql="SELECT * FROM img_para WHERE pid=1";
if ($rs = $conn->Execute($sSql)) {
	$rs->MoveFirst();
	if(!$rs->Eof()){
		$wo_rota="rota(".$rs->Fields('img_rota').");";
		$wo_height=$rs->Fields('img_height');
	}
	$rs->Close();
}
	
$sSql="SELECT * FROM patient_detail ";
$sSql.="WHERE DetailNo=".$dno." AND StudyID='".$sid."' ";
$sSql.="ORDER BY DetailNo";

if ($rs = $conn->Execute($sSql)) {
	$rs->MoveFirst();
	if (!$rs->EOF){
		$DetailNo=$rs->fields('DetailNo');
		$dnop=$DetailNo-1;
		$dnon=$DetailNo+1;
    $BodyPartExamined=$rs->fields('BodyPartExamined');
    $ProtocolName=$rs->fields('ProtocolName');
    $img=trim("/pacsimages/".EW_CONN_DB."/".$rs->fields('image'));
	  $bp=$BodyPartExamined.' '.$ProtocolName;
	  $filename=$img;   
	}
	else{
	  $dnop=$dno+1;	
	}
}	
$rs->Close();
?>
?> 
<html> 
<meta http-equiv="Content-Type" content="text/html; charset=big5"> 
<title>圖片查看</title> 
<META HTTP-EQUIV="imagetoolbar" CONTENT="no"> 
<style type="text/css"> 
body { font-family: "Verdana", "Arial", "Helvetica", "sans-serif"; font-size: 12px; line-height: 180%; } 
td { font-size: 12px; line-height: 150%; } 
</style> 
<SCRIPT language=JavaScript> 
drag = 0;
move = 0; 
var ie=document.all; 
var nn6=document.getElementById&&!document.all; 
var isdrag=false; 
var y,x; 
var oDragObj; 

function moveMouse(e) { 
if (isdrag) { 
oDragObj.style.top = (nn6 ? nTY + e.clientY - y : nTY + event.clientY - y)+"px"; 
oDragObj.style.left = (nn6 ? nTX + e.clientX - x : nTX + event.clientX - x)+"px"; 
return false; 
} 
} 

function initDrag(e) { 
var oDragHandle = nn6 ? e.target : event.srcElement; 
var topElement = "HTML"; 
while (oDragHandle.tagName != topElement && oDragHandle.className != "dragAble") { 
	oDragHandle = nn6 ? oDragHandle.parentNode : oDragHandle.parentElement; 
} 
if (oDragHandle.className=="dragAble") { 
	isdrag = true; 
	oDragObj = oDragHandle; 
	nTY = parseInt(oDragObj.style.top+0); 
	y = nn6 ? e.clientY : event.clientY; 
	nTX = parseInt(oDragObj.style.left+0); 
	x = nn6 ? e.clientX : event.clientX; 
	document.onmousemove=moveMouse; 
	return false; 
	} 
} 
document.onmousedown=initDrag; 
document.onmouseup=new Function("isdrag=false"); 

function clickMove(s){ 
	if(s=="up"){ 
		dragObj.style.top = parseInt(dragObj.style.top) + 100; 
	}else if(s=="down"){ 
		dragObj.style.top = parseInt(dragObj.style.top) - 100; 
	}else if(s=="left"){ 
		dragObj.style.left = parseInt(dragObj.style.left) + 100; 
	}else if(s=="right"){ 
		dragObj.style.left = parseInt(dragObj.style.left) - 100; 
	}
} 

function smallit(){ 
	var height1=images1.height; 
	var width1=images1.width; 
	images1.height=height1/1.2; 
	images1.width=width1/1.2; 
} 

function bigit(){ 
	var height1=images1.height; 
	var width1=images1.width; 
	images1.height=height1*1.2; 
	images1.width=width1*1.2; 
} 
function realsize(){ 
	images1.height=1920; 
	//images1.width=1200; 
	block1.style.left = 0; 
	block1.style.top = 0; 

}
function rota(i){
	images1.style.filter="progid:DXImageTransform.Microsoft.BasicImage(Rotation="+i+")";
}
</SCRIPT> 
<script language="JavaScript" type="text/JavaScript"> 
<!-- 
function MM_reloadPage(init) { //reloads the window if Nav4 resized 
	if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) { 
		document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }} 
	else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload(); 
} 
MM_reloadPage(true);
//--> 
</script> 
<style type="text/css"> 
<!-- 
td, a { font-size:12px; color:#000000 } 
#Layer1 { position:absolute; z-index:100; top: 10px; } 
#Layer2 { position:absolute; z-index:1; } 
--> 
</style> 
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#000000" oncontextmenu="return false" ondragstart="return false" onselectstart ="return false" onselect="document.selection.empty()" oncopy="document.selection.empty()" onbeforecopy="return false" onmouseup="document.selection.empty()" style="overflow-y:hidden;overflow-x:hidden;">
<div id="Layer1"> 
<table border="0" cellspacing="2" cellpadding="0">
    <tr> 
        <td><a href="<?php echo 'showimg2.php?dno='.$dno.'&sid='.$sid.'&img='.$img.'&bp='.$bp; ?>"><img src="imgs/priv.jpg" width="20" height="20" style="cursor:hand" title="上張"></a></td>
        <td><a href="<?php echo 'showimg2.php?dno='.$dno.'&sid='.$sid.'&img='.$img.'&bp='.$bp; ?>"><img src="imgs/next.jpg" width="20" height="20" style="cursor:hand" title="下張"></a></td>
        <td><img src="imgs/zoom.gif" width="20" height="20" style="cursor:hand" onClick="realsize();" title="還原"></td>  
        <td><img src="imgs/up.gif" width="20" height="20" style="cursor:hand" onClick="rota(0)" title="0度"></td> 
        <td><img src="imgs/right.gif" width="20" height="20" style="cursor:hand" onClick="rota(1)" title="90度"></td>
        <td><img src="imgs/zoom_in.gif" width="20" height="20" style="cursor:hand" onClick="bigit();" title="放大"></td>
        <td><img src="imgs/zoom_out.gif" width="20" height="20" style="cursor:hand" onClick="smallit();" title="縮小"></td>
        <td><font color="#FFFF00" size="3"><?php echo $bp.'->'.$dno.'.'.$sid; ?></font></td>
    </tr> 
</table> 
</div>
<div id="block1" onmouseout="drag=0" onmouseover="dragObj=block1; drag=1;" style="z-index:10; height: 0; left: 0px; position: absolute; top: 0px; width: 0" class="dragAble">
	<img name="images1" src="<?php echo $img; ?>" border="1" onload="<?php echo $wo_rota; ?>" width="512" height="512">
</div>
</body>
</html>