<?php
if (@$_GET["img"] <> "") {
	$img=$_GET["img"];
	//$fname="d:\\pacsimages\\pacs01\\".$img;
	//$fname = str_replace("/","\\",$fname);
	$fname="/pacsimages/pacs01/".$img;
	$psize = MyImg($fname);
	$width=$psize[0];
	$height=$psize[1];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>檢視即時影像</title>
    <meta http-equiv="Content-Type" content="text/html; charset=BIG5" />
    <script src="Scripts/jquery-1.3.2.js" type="text/javascript"></script>    
    <script type="text/javascript" src="Scripts/zoomfunc.js"></script>
<script language="javascript">   
var num=1;   
function show0(){
	document.getElementById("img1").style.zoom = "50%";
  	document.getElementById("img1").style.filter="progid:DXImageTransform.Microsoft.BasicImage(Rotation=0)";
}  
function show90(){
	document.getElementById("img1").style.zoom = "60%";
  	document.getElementById("img1").style.filter="progid:DXImageTransform.Microsoft.BasicImage(Rotation=3)";
}
function rota(){
	if (num==0){
		document.getElementById("img1").style.zoom = "60%";
		document.getElementById("img1").style.filter="progid:DXImageTransform.Microsoft.BasicImage(Rotation=3)";
		num=1;	
		}
	else{
	document.getElementById("img1").style.zoom = "50%";
		document.getElementById("img1").style.filter="progid:DXImageTransform.Microsoft.BasicImage(Rotation=0)";
		num=0;
		}	
}

function MyImg($imgf) {
  $size = GetImageSize($imgf);
  return $size;
}
    $(document).ready(function() {	// JQuery Document Ready
        window.moveTo(0,0);
		//show90();
    });
</script>
</head>
<?php
if ($width>=$height){
	$funcname="show0();";
}
else{
	$funcname="show90();";
}
?>
<body topmargin="0" leftmargin="0" bgcolor="#000000" onload="<?php echo $funcname; ?>">
<font color="#ffffff" size="4"><?php echo $width."x".$height ?></font><br />
<div id="s" style="position:absolute;left:0;top:100;">
<img src="/pacsimages/pacs01/<?php echo $img; ?>" name="s" id="img1" border="0" onmousewheel="return imgzoom(this);" onDblClick="rota();">
</div>
</body>
</html>
<?php
function MyImg($imgf) {
  $size = GetImageSize($imgf);
  return $size;
}
?>
