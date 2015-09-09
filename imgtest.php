<?php 
$fname='/pacsimages/pacs_01/2010/2/4/4910020401290-1.jpg';
echo $fname;
$filename=imagecreatefromjpeg($fname);
$biWidth = ImageSX($filename);
$biHeight = ImageSY($filename);
echo "<br>".$biWidth.','.$biHeight;
?>
<img src="<?php echo $fname; ?>">