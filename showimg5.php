<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
	$sid=$_GET["sid"];
	$sno=$_GET["sno"];
	
  $conn = ew_Connect();
	$sSql="SELECT * FROM patient_detail WHERE StudyID='".$sid."' AND SeriesNumber='".$sno."'";
	if ($rs = $conn->Execute($sSql)) {
		$rs->MoveFirst();
		if(!$rs->Eof()){
			$img="/pacsimages/".EW_CONN_DB."/".$rs->Fields('image');
			$x_axis=$rs->Fields('x_axis');
			$y_axis=$rs->Fields('y_axis');
			$bp=$rs->Fields('BodyPartExamined').'-'.$rs->Fields('ProtocolName');
		}
	$rs->Close();
	}
	
	$sSql="SELECT * FROM img_para WHERE pid=1";
	if ($rs = $conn->Execute($sSql)) {
		$rs->MoveFirst();
		if(!$rs->Eof()){
			$wo_rota="rota(".$rs->Fields('img_rota').");";
			$wo_width=$rs->Fields('img_width');
			$wo_height=$rs->Fields('img_height');
			$line1='視窗大小：'.$wo_width.' x '.$wo_height;
			//Image dimensions
			$fname=@imageCreateFromJPEG(PACS_PATH.$img); //圖片放置的路徑及檔名
	  	$biHeight = ImageSY($fname);
	  	$biWidth = ImageSX($fname);
	  	$line2='原始尺寸：'.$biWidth.' x '.$biHeight;
	  	$bi_Width = $wo_width;
	  	$biValue = ($biWidth/$bi_Width);
	  	$line3='縮小比例：'.number_format($biValue,2);;
	  	$bi_Height = (int)($biHeight/$biValue);
	  	$line4='畫面尺寸：'.$bi_Width.' x '.$bi_Height;
	  	$message1=$line1.'  '.$line2.'  '.$line3.'  '.$line4;
	  	if(@$_GET["act"]<>''){
	  		$act=$_GET["act"];
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
			else{
				$bvalue=0;
			}
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
	$imgsize=200;
	$cellsize=10;
?>
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=big5"> 
	<title>圖片查看</title> 
	<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
  <script type="text/javascript" src="js/kinetic-v4.4.3.min.js"></script>
  <link rel="stylesheet" href="css/jquery-ui.css"> 
    <style>
      body {
        margin: 0px;
        padding: 0px;
      }
    </style> 
  </head>
  <body>
    <div id="container"></div>
    <script defer="defer">
    	<?php
      if($x_axis+$y_axis==0){
      ?>
  	  	var arrowflag=false;
  	  <?php
  		}
  		else{
  		?>	
  	  	var arrowflag=true;
  	  <?php
  		}
  		?>
	    
    	function writeMessage(message) {
        msg2.setText(message);
        layer.draw();
      }
      
      function loadImages(sources, callback) {
        var images = {};
        var loadedImages = 0;
        var numImages = 0;
        for(var src in sources) {
          numImages++;
        }
        for(var src in sources) {
          images[src] = new Image();
          images[src].onload = function() {
            if(++loadedImages >= numImages) {
              callback(images);
            }
          };
          images[src].src = sources[src];
        }
      }
      function buildStage(images) {
        var xray = new Kinetic.Image({
          image: images.xray,
          x: 0,
          y: 0,
          width: <?=$bi_Width?>,
          height: <?=$bi_Height?>,
          draggable: false
        });
        
        var dark = new Kinetic.Image({
          image: images.dark,
          x: 0,
          y: 100,
          width: <?=$imgsize?>,
          height: <?=$imgsize?>
        });
        
        var zoom = new Kinetic.Image({
          image: images.zoom,
          x: 300,
          y: 100,
          width: <?=$imgsize?>,
          height: <?=$imgsize?>
        });
        
        var light = new Kinetic.Image({
          image: images.light,
          x: 600,
          y: 100,
          width: <?=$imgsize?>,
          height: <?=$imgsize?>
        });
        

        var btnArrow = new Kinetic.Image({
          image: images.btnArrow,
          x: 900,
          y: 100,
          width: <?=$imgsize?>,
          height: <?=$imgsize?>
        });

        var arrow = new Kinetic.Image({
          image: images.arrow,
          x: <?=$x_axis?>,
          y: <?=$y_axis?>,
          
        <?php if($_SESSION['level']=='0'){ ?>
          draggable: true          
        <?php } else{ ?>
          draggable: false         
        <?php } ?> 
        });	  
        
        dark.on('mouseover', function() {
				  writeMessage('調暗');
        });
				dark.on('mouseout', function() {
          writeMessage('');
        });
        dark.on('click touchstart', function() {
        	var url='showimg5.php?sid=<?=$sid?>&sno=<?=$sno?>&act=D';
				  window.location=url;
        });
        
				zoom.on('mouseover', function() {
				  writeMessage('還原');
        });
				zoom.on('mouseout', function() {
          writeMessage('');
        });
        zoom.on('click touchstart', function() {
        	var url='showimg5.php?sid=<?=$sid?>&sno=<?=$sno?>&act=O';
				  window.location=url;
        });

				light.on('mouseover', function() {
				  writeMessage('調亮');
        });
				light.on('mouseout', function() {
          writeMessage('');
        });
        light.on('click touchstart', function() {
        	var url='showimg5.php?sid=<?=$sid?>&sno=<?=$sno?>&act=L';
				  window.location=url;
        });
        
        btnArrow.on('mouseover', function() {
				  writeMessage('增減指標');
        });
				btnArrow.on('mouseout', function() {
          writeMessage('');
        });
        btnArrow.on('click touchstart', function() {
        	if (arrowflag==true){
        		arrowflag=false;
				  	arrow.remove();
						layer.draw();
				  	writeMessage('移除標示箭頭');
					  var sid='<?=$sid?>';
					  var sno='<?=$sno?>';
					  var urlstr='savearrow.php?sid='+sid+'&sno='+sno+'&x=0&y=0';
					  $.ajax({
					    method: 'GET',
							url: urlstr,
							cache: false,
							success: function(response){
								writeMessage(response.trim());
								},
							error: function(xhr) {
								writeMessage('轉換錯誤！');
								}
							});
					}
					else{
						arrowflag=true;
				  	layer.add(arrow);
						layer.draw();
				  	writeMessage('新增標示箭頭');
					}
        });
        arrow.on('click touchstart', function() {
        	//alert('you clicked/touched me!');
				  //arrow.visible(false);
				});
				 
				arrow.on('mouseout', function() {
          writeMessage('');
        });
        
				arrow.on('dragend', function() { //取得移動後座標值
				  var point = arrow.getPosition();
				  var x_axis=Math.round(point.x);
				  var y_axis=Math.round(point.y);
				  var sid='<?=$sid?>';
				  var sno='<?=$sno?>';
				  var urlstr='savearrow.php?sid='+sid+'&sno='+sno+'&x='+x_axis+'&y='+y_axis;
				  $.ajax({
				    method: 'GET',
						url: urlstr,
						cache: false,
						success: function(response){
							writeMessage(response.trim());
							},
						error: function(xhr) {
							writeMessage('轉換錯誤！');
							}
						});
				}); 
        Bglayer.add(xray);
        stage.add(Bglayer);
        layer.add(dark);
        layer.add(zoom);
        layer.add(light);
        
<?php if($_SESSION['level']=='0'){ ?>
        layer.add(btnArrow);
        <?php
      }
        if($x_axis+$y_axis<>0){
        ?>
        	layer.add(arrow); //x=0,y=0 不秀圖
        <?php
      	}
        ?>
        layer.add(msg1);
        layer.add(msg2);    
        stage.add(layer);
      }
      var stage = new Kinetic.Stage({
        container: 'container',
        width: <?=$bi_Width?>,
        height: <?=$bi_Height?>
      });

      var Bglayer = new Kinetic.Layer();
      var layer = new Kinetic.Layer();
			var msg1 = new Kinetic.Text({
        x: 0,
        y: 0,
        fontFamily: '細明體',
        fontSize: 32,
        text: '<?=$_SESSION['level'].$message1?>',
        fill: 'yellow'
      });
			var msg2 = new Kinetic.Text({
        x: 0,
        y: 35,
        fontFamily: 'Calibri',
        fontSize: 32,
        text: '訊息資訊',
        fill: 'yellow'
      });
	        
      var sources = {
        xray: "<?=$img?>",
        arrow: "/ps01/imgs/arrow.png",
        dark: "/ps01/imgs/dark.jpg",
        zoom: "/ps01/imgs/zoom.gif",
        light: "/ps01/imgs/light.jpg",
        btnArrow: "/ps01/imgs/down.gif"
      };
       
      loadImages(sources, buildStage);

    </script>
  </body>
</html> 