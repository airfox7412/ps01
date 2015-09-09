<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
if (@$_GET["img"] <> "") {
	$img=$_GET["img"];
	$bp=$_GET["bp"];
	$filename=$img;
}
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
		$fname=@imageCreateFromJPEG(PACS_PATH.$img);
  	$biHeight = ImageSY($fname);
  	$biWidth = ImageSX($fname);
  	$line2='<br><br>原始尺寸：'.$biWidth.' x '.$biHeight;
  	$bi_Width = $wo_width;
  	$biValue = ($biWidth/$bi_Width);
  	$line3='<br><br>縮小比例：'.number_format($biValue,2);;
  	$bi_Height = (int)($biHeight/$biValue);
  	$line4='<br><br>畫面尺寸：'.$bi_Width.' x '.$bi_Height;
	}
	$rs->Close();
}
?> 
<?php $imgsize=200; ?>
<?php $cellsize=10;?>
<html> 
	<meta http-equiv="Content-Type" content="text/html; charset=big5"> 
	<title>圖片查看</title> 
	<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/caman.full.min.js"></script>
	<script type="text/javascript" src="Scripts/kinetic-v4.4.3.min.js"></script>
	<link rel="stylesheet" href="css/jquery-ui.css">
  <script language=JavaScript>		
  	function rota(i){
  		if (i==1){
  			caman.rotate(90);
  		}
  		else if (i==-1){
  			caman.rotate(-90);
  		}
  		caman.render();
  	}
  	
  	function realsize(w,h){ 
  		Caman("#images1", function () {
				this.revert(false);
  			this.brightness(0);
  			this.render();
			});
			//$("#images1").width=w;
			//$("#images1").height=h; 	
  	}
  	
		function refreshImage(bvalue){
			Caman("#images1", function () {
					this.revert(false);
					if(detectmob()){
		  			this.resize({
				    	width: 1010,
				    	height: 1354
				  		});
				  	}
  				this.brightness(bvalue);
  				this.render();
			});
		}
		
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
		
		$(function(){
			if(detectmob()){
				Caman("#images1", function () {
				this.revert(false);
  			this.resize({
		    	width: 1010,
		    	height: 1354
		  		});
  			this.render();
			});
			}
		});
  </script> 
	<style type="text/css"> 
	<!-- 
		body { font-family: "Verdana", "Arial", "Helvetica", "sans-serif"; font-size: 24px; line-height: 180%; } 
		td, a { font-size: 32px; color:#ffff00 } 
		#ToolBar { position:absolute; z-index:100; top: 50px; } 
		#image-area { position:absolute; z-index:100; top: 0px; } 
		#Message { position:absolute; z-index:100; top: <?=$bi_Height-100?>px; } 
	--> 
	</style> 
</head> 
<body bgcolor="#202020">
<div id="image-area">
	<img id="images1" src="<?=$img?>" width="<?=$bi_Width?>">
</div> 
<!-- data-caman-hidpi="<?=$img?>" width="<?=$bi_Width?>" height="<?=$bi_Height?>"> </div>-->
<div id="ToolBar"> 
<table border="0" cellspacing="<?=$cellsize;?>" cellpadding="<?=$cellsize;?>" width="<?=$bi_Width?>">
    <tr> 
        <td><img src="imgs/dark.jpg" width="<?php echo $imgsize; ?>" height="<?php echo $imgsize; ?>" style="cursor:hand" onClick="refreshImage(-50);" title="調暗"></td> 
	      <td><img src="imgs/zoom.gif" width="<?php echo $imgsize; ?>" height="<?php echo $imgsize; ?>" style="cursor:hand" onClick="realsize(<?=$bi_Width?>,<?=$bi_Height?>);" title="還原"></td> 
	      <td><img src="imgs/light.jpg" width="<?php echo $imgsize; ?>" height="<?php echo $imgsize; ?>" style="cursor:hand" onClick="refreshImage(50);" title="調亮"></td>
        <!--<td><img src="imgs/zoom_in.gif" width="<?php echo $imgsize; ?>" height="<?php echo $imgsize; ?>" style="cursor:hand" onClick="bigit();" title="放大"></td>-->
        <!--<td><img src="imgs/zoom_out.gif" width="<?php echo $imgsize; ?>" height="<?php echo $imgsize; ?>" style="cursor:hand" onClick="smallit();" title="縮小"></td>-->
        <td><?php echo $bp; ?></td>
    </tr>
</table> 
</div>
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
</body>
</html>