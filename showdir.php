<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php
$dir=$_GET["dir"];
$files=dirToArray($dir);
$i=1;
?>
<html>
	<head>
		<meta http-equiv="refresh" content="2">
	</head>
<body>		
檢視已上傳檔案
<table width="800" border="1" style="border-collapse:collapse;" borderColor="black">
  <tr>
  	<td width="5%" align="center">序號</td>
  	<td width="15%" align="center">來源檔案名稱</td>
  	<td width="30%" align="center">目的檔案名稱</td>
  	<td width="20%" align="center">檔案大小</td>
  	<td width="20%" align="center">上傳日期</td>
  	<td width="10%" align="center">處理狀態</td>
  </tr>
<?php
if(is_array($files)){
	foreach($files as $val){
    if($val == '.' || $val == '..')
    	continue;
    $fname=$dir."/".$val;	
    $fsize=number_format(filesize($fname), 0, '', ',');
    $ftime=fileatime($fname);
    $status=GetStatus($fname);
    $sname=GetSourceName($fname);
?>
  <tr>
  	<td align="center"><?php echo $i; ?></td>
  	<td><?php echo $sname; ?></td>
  	<td><?php echo $fname; ?></td>
  	<td><?php echo $fsize; ?></td>
  	<td><?php echo date("Y-m-d H:i:s",$ftime); ?></td>
  	<td align="center"><?php echo $status; ?></td>
  </tr>
<?php
		$i++;		
		}
	}
?>
</table>
<?php
function GetStatus($fname) {
	$conn = ew_Connect();
  $result = ""; 
  $sql="SELECT * FROM import_log ";
    $sql.="WHERE fname='".$fname."' ";
    $rs = $conn->Execute($sql);
    $rs->MoveFirst();
    if(!$rs->EOF){
    	$status=$rs->fields('status');
    	if ($status=='N'){
    		$result="<font color='#ff0000'>".$status."</font>";
    	}
    	else{
    		$result="<font color='#0000ff'>".$status."</font>";
    	}
    }
   $rs->Close();
   $conn->Close();
   return $result; 
}

function GetSourceName($fname) {
	$conn = ew_Connect();
  $result = ""; 
  $sql="SELECT * FROM import_log ";
    $sql.="WHERE fname='".$fname."' ";
    $rs = $conn->Execute($sql);
    $rs->MoveFirst();
    if(!$rs->EOF){
    	$result=$rs->fields('sname');
    }
   $rs->Close();
   $conn->Close();
   return $result; 
} 

function dirToArray($dir) {
   $result = array(); 
   $cdir = scandir($dir); 
   foreach ($cdir as $key => $value) 
   { 
      if (!in_array($value,array(".",".."))) 
      { 
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
         { 
            $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value); 
         } 
         else 
         { 
            $result[] = $value; 
         } 
      } 
   } 
   
   return $result; 
} 
?>
</body>
</html>