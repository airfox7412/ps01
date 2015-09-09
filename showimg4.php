<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
$bvalue=0;
if (@$_GET["img"] <> "") {
	$img=$_GET["img"];
	$bp=$_GET["bp"];
	$_SESSION['img']=$img;
}	
else {
	$img=$_POST["img"];
	$bp=$_POST["bp"];
  $act=$_POST["act"];
	if ($act=='O'){
		$bvalue=0;
	}
	elseif ($act=='D'){
		$bvalue=-100;
	}
	elseif ($act=='L'){
		$bvalue=100;
		$bvalue=100;
	}
}
$filename=$img;	

$conn = ew_Connect();
$sSql="SELECT * FROM img_para WHERE pid=1";
if ($rs = $conn->Execute($sSql)) {
	$rs->MoveFirst();
	if(!$rs->Eof()){
		$wo_rota="rota(".$rs->Fields('img_rota').");";
		$wo_width=$rs->Fields('img_width');
		$wo_height=$rs->Fields('img_height');
		$line1='<br><br>視窗大小：'.$wo_width.' x '.$wo_height;
		//Image dimensions
		$fname=@imageCreateFromJPEG(PACS_PATH.$_SESSION['img']); //$_SESSION['img']原始檔案
  	$biHeight = ImageSY($fname);
  	$biWidth = ImageSX($fname);
  	$line2='<br><br>原始尺寸：'.$biWidth.' x '.$biHeight;
  	$bi_Width = $wo_width;
  	$biValue = ($biWidth/$bi_Width);
  	$line3='<br><br>縮小比例：'.number_format($biValue,2);;
  	$bi_Height = (int)($biHeight/$biValue);
  	$line4='<br><br>畫面尺寸：'.$bi_Width.' x '.$bi_Height;
  	
		//echo "<script>alert('".$act."');</script>";	
		if ($act <> "") { 	
			if ($fname && imagefilter($fname, IMG_FILTER_BRIGHTNESS, $bvalue)) {
				echo '影像轉換';
			  imagejpeg($fname, 'temp.jpg');
			} else {
			  echo '影像轉換失敗';
			}
			imagedestroy($fname);
			$img='temp.jpg';
			}
	}
	$rs->Close();
}	
?> 
<?php $imgsize=200;?>
<?php $cellsize=10;?>
<html> 
	<meta http-equiv="Content-Type" content="text/html; charset=big5"> 
	<title>圖片查看</title> 
	<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/kinetic-v4.4.3.min.js"></script>
	<link rel="stylesheet" href="css/jquery-ui.css">  
  <script language=JavaScript>
  	function detectmob() { 
			 if( navigator.userAgent.match(/Android/i)
				 || navigator.userAgent.match(/webOS/i)
				 || navigator.userAgent.match(/iPhone/i)
				 || navigator.userAgent.match(/iPad/i)
				 || navigator.userAgent.match(/iPod/i)
				 || navigator.userAgent.match(/BlackBerry/i)
				 || navigator.userAgent.match(/Windows Phone/i)
				 ){
			    return true;
			 }
			 else{
			    return false;
			 }
		}
		
		function refreshImage(act){
			document.form1.act.value=act;
			document.form1.submit();
		}
  </script> 
	<style type="text/css"> 
	<!-- 
		body { font-family: "Verdana", "Arial", "Helvetica", "sans-serif"; font-size: 24px; line-height: 180%; } 
		td, a { font-size: 32px; color:#ffff00 } 
		#image-area { position:absolute; z-index:10; top: 0px; }
		#ToolBar { position:absolute; z-index:20; top: 30px; }  
		#Message { position:absolute; z-index:30; top: <?=$bi_Height-100?>px; } 
		#container { position:absolute; z-index:100; top: 0px; } 
	--> 
	</style>
	<script defer="defer">
      var stage = new Kinetic.Stage({
        container: 'container',
        width: window.innerWidth,
        height: window.innerHeight
      });

      var layer = new Kinetic.Layer();
      var tooltip = new Kinetic.Label({
        x: 100,
        y: 300,
        opacity: 0.75,
        listening: false,
        text: {
          text: '標示',
          fontFamily: '細明體',
          fontSize: 18,
          padding: 5,
          fill: 'blue'
        },
        rect: {
          pointerDirection: 'down',
          pointerWidth: 10,
          pointerHeight: 10,
          lineJoin: 'round',
          shadowColor: 'black',
          shadowBlur: 10,
          shadowOffset: 10,
          shadowOpacity: 0.5,
          fill: 'yellow',
          draggable: true
        }
      });
      // add the shape to the layer
      layer.add(tooltip);
      // add the layer to the stage
      stage.add(layer);
  </script>  
</head> 
<body bgcolor="#202020">
<div id="image-area">
	<img id="images1" src="<?=$img?>" width="<?=$bi_Width?>">
</div> 
<!-- data-caman-hidpi="<?=$img?>" width="<?=$bi_Width?>" height="<?=$bi_Height?>"> </div>-->
<form name="form1" id="form1" action="showimg4.php" method="post">
  <input type="hidden" name="act" value="">
  <input type="hidden" name="img" value="<?=$img?>">
  <input type="hidden" name="bp" value="<?=$bp?>">
<div id="ToolBar"> 
<table border="0" cellspacing="<?=$cellsize;?>" cellpadding="<?=$cellsize;?>" width="<?=$bi_Width?>">
    <tr> 
        <td><img src="imgs/dark.jpg" width="<?php echo $imgsize; ?>" height="<?php echo $imgsize; ?>" style="cursor:hand" onClick="refreshImage('D');" title="調暗"></td> 
	      <td><img src="imgs/zoom.gif" width="<?php echo $imgsize; ?>" height="<?php echo $imgsize; ?>" style="cursor:hand" onClick="refreshImage('O');" title="還原"></td> 
	      <td><img src="imgs/light.jpg" width="<?php echo $imgsize; ?>" height="<?php echo $imgsize; ?>" style="cursor:hand" onClick="refreshImage('L');" title="調亮"></td>
        <td><?php echo $bp; ?></td>
    </tr>
</table> 
</div>
</form>
<div id="Message">
	<table cellspacing="20" cellpadding="0" width="<?=$bi_Width?>">
		<tr>
			<td><?=$line1;?></td>
			<td><?=$line2;?></td>
			<td><?=$line3;?></td>
			<td><?=$line4;?></td>
		</td>
	</table>				
</div>
<div id="container"></div>
</body>
</html>