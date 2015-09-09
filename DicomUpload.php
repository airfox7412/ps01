<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "header.php" ?>
<script type="text/javascript" language="JavaScript">
<!--
function HideContent(d) {
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
document.getElementById(d).style.display = "block";
}
function ReverseDisplay(d) {
if(document.getElementById(d).style.display == "none") { 
	document.getElementById(d).style.display = "block"; }
else { 
	document.getElementById(d).style.display = "none"; }
}

$(document).ready(function(){
	var settings = {
	    url: "upload.php",
	    dragDrop:true,
	    showStatusAfterSuccess: true,
      maxFileSize: -1,
      multiple: true,
      showDelete: false,
	    fileName: "myfile",
	    allowedTypes:"dcm",	
	    returnType:"json",
		  onSuccess:function(files,data,xhr){
	    	//alert((data));
	    },
	    deleteCallback: function(data,pd){
		    for(var i=0;i<data.length;i++){
		        $.post("delete.php",{op:"delete",name:data[i]},
		        function(resp, textStatus, jqXHR){
		            //Show Message  
		            //$("#status").append("<div>刪除檔案</div>");
		            $("#status").html("刪除檔案");      
		        });
		    }      
	    	pd.statusbar.hide(); //You choice to hide/not.
			}
	}
	var uploadObj = $("#mulitplefileuploader").uploadFile(settings);
	});

//-->
</script>
<?php
$_SESSION['dbname']=EW_CONN_DB;
$dbname="uploads/".$_SESSION['dbname'];
if(!is_dir($dbname)){
	if (!mkdir($dbname, 0777)){
		echo "目錄建立失敗<br>";
	}
}
?>
<br>
<br>
<div align="Center">
	<table>
	<tr valign="top">
		<td><a href='showdir.php?dir=<?php echo $dbname; ?>' target='_Blank'>檢視上傳檔案</a></td>
	</tr>
	<tr valign="top">
		<td><div id="mulitplefileuploader">上傳</div></td>
	</tr>
	<tr>
		<td colspan="2"><div id="status"></div></td>
	</tr>
</table>
</div>
<br>
<br>
<div align="Center">
	<img src="imgs/finger.png" border="0"><font color="#0000ff"><a href="javascript:ReverseDisplay('showhint');">顯示上傳範例</a></font><br>
</div>
<div id="showhint" style="display:none" align="center">
	<img src="imgs/upload_screen.jpg" border="0">
</div>
<?php include "footer.php" ?>