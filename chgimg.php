<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
if (@$_GET["img"] <> "") {
	$img=$_GET["img"];
	$bvalue=$_GET["bv"];
  //判斷輸出檔名
	if($bvalue<0){
		$outimg='temp_d.jpg';
	}
	elseif($bvalue>0){
		$outimg='temp_l.jpg';
	}
	else{
		$outimg='temp_o.jpg';
	}
	//判斷輸出檔名   
	$fname=@imageCreateFromJPEG(PACS_PATH.$img);	
	if ($fname && imagefilter($fname, IMG_FILTER_BRIGHTNESS, $bvalue)) {
		//echo '影像轉換';
	  imagejpeg($fname, $outimg);
	  echo $outimg;
	} else {
	  //echo '影像轉換失敗';
	  echo '';
	}
	imagedestroy($fname);
}	
?>