<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=big5">
	<link type="text/css" href="ps01.css" rel="stylesheet">
	<link type="text/css" href="css/jquery-ui.css" rel="stylesheet">
	<link type="text/css" href="css/uploadfile.css" rel="stylesheet">
	<link type="text/css" href="css/nyroModal.css" rel="stylesheet">
	    
	<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
	<script src="js/jquery.nyroModal.custom.min.js" type="text/javascript"></script>
  <script src="js/jquery.uploadfile.js" type="text/javascript"></script>
	<script src="js/jquery-ui.js" type="text/javascript"></script>
	
  <style>
  .ui-menu { width: 150px; }
  </style>
  
	<script type="text/javascript">
	$(function(){
		$('.nyroModal').nyroModal({
			callbacks: {
				afterShowCont: function(nm) {
					$('.resizeLink', nm.elts.cont).click(function(e) {
						e.preventDefault();
						nm.sizes.initW = Math.random()*1000+400;
						nm.sizes.initH = Math.random()*1000+400;
						nm.resize();
					});
				}
			}
		});
		
		function preloadImg(image) {
			var img = new Image();
			img.src = image;
		}

		preloadImg('imgs/ajaxLoader.gif');
		preloadImg('imgs/prev.gif');
		preloadImg('imgs/next.gif');
	});
	
	$(document).ready(function() {	// JQuery Document Ready
		
		$("#Func0Btn").click(function(){
			window.location='DicomUpload.php';
		});
		$("#Func1Btn").click(function(){
			window.location='DetailView_list.php';
		});
		$("#QuitBtn").click(function(){
			window.location='logout.php';
		});
		$("#Func2Btn").click(function(){
			window.location='importlog_list.php';
		});
		$("#Func3Btn").click(function(){
			window.location='report_code_desc_list.php';
		});
		$("#Func4Btn").click(function(){
			window.location='report_special_word_list.php';
		});
		$("#Func5Btn").click(function(){
			window.location='parament_m.php';
		});
		$("#Func6Btn").click(function(){
			window.location='user_profile_list.php';
		});
	});
	</script>
</head>
<body>
<div valign="top">
  <table cellspacing="0" class="ewContentTable">
		<tr>
			<td>
				<table align="left" background="images/liteblue.png">
					<tr>
						<td><button id="Func0Btn">0.影像上傳</button></td>
						<td><button id="Func1Btn">1.病歷資料</button></td>
						<?php if (@$_SESSION['level']=='0') { ?>
						<td><button id="Func2Btn">2.轉檔紀錄</button></td>
						<td><button id="Func3Btn">3.病歷代碼</button></td>
						<td><button id="Func4Btn">4.特殊代碼</button></td>
						<td><button id="Func5Btn">5.操作管理</button></td>
						<td><button id="Func6Btn">6.會員管理</button></td>
						<?php
						}
						?>
						<td>
							<?php
						  $self=str_replace('/ps01/','',$_SERVER['PHP_SELF']);
							if ($self=='DicomUpload.php'||$self=='DetailView_list.php')
							   echo $hname.'('.EW_CONN_DB.')'; 
							?>
						</td>
						<td>&nbsp;</td>
						<td>
							<button id="QuitBtn">Q.登出</button>
						</td>
					</tr>
				</table>
			</td>
		</tr>	
		<tr>
	    	<td>
			<!-- right column (begin) -->
<script>
	$("#Func0Btn").button();
	$("#Func1Btn").button();
	$("#Func2Btn").button();
	$("#Func3Btn").button();
	$("#Func4Btn").button();
	$("#Func5Btn").button();
	$("#Func6Btn").button();
	$("#QuitBtn").button();
</script>