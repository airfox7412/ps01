<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
if (@$_GET["img"] <> "") {
	$bvalue=$_GET["bv"];
	$outimg='original.jpg';
	if($bvalue==-100)
		$outimg='dark.jpg';
	elseif ($bvalue==100)
		$outimg='light.jpg';   
	$fname=@imageCreateFromJPEG(PACS_PATH.$img);	
	if ($fname && imagefilter($fname, IMG_FILTER_BRIGHTNESS, $bvalue)) {
		echo '影像轉換';
	  imagejpeg($fname, $outimg);
	} else {
	  echo '影像轉換失敗';
	}
	imagedestroy($fname);
	echo $outimg;
}	
?>