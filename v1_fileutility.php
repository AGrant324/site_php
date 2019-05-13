<?php # fileutility.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

Get_Common_Parameters();
GlobalRoutine();
# Get_Data("person",$GLOBALS{'LOGIN_person_id'});
# Check_Session_Validity();

$filepath = ""; if (isset($_REQUEST["FilePath"])) { $filepath = $_REQUEST["FilePath"]; }
$filepathto = ""; if (isset($_REQUEST["FilePathTo"])) { $filepathto = $_REQUEST["FilePathTo"]; }
$filename1 = ""; if (isset($_REQUEST["FileName1"])) { $filename1 = $_REQUEST["FileName1"]; }
$filename2 = ""; if (isset($_REQUEST["FileName2"])) { $filename2 = $_REQUEST["FileName2"]; }
$filename3 = ""; if (isset($_REQUEST["FileName3"])) { $filename3 = $_REQUEST["FileName3"]; }
$action = $_REQUEST['Action'];
$error = "0";
$message = "";

// The following avoids mod security issues because of ../../
$filepath = expandSymbolicPath($filepath);
$filepathto = expandSymbolicPath($filepathto);

if ($action == "CopyDelete") {
 if (($filename1 != "")&&($filename2 != "")&&(file_exists($filepath."/".$filename1))) { 	
  copy($filepath."/".$filename1, $filepathto."/".$filename2);
  $message."$filename1 copied to $filename2";
 } else { $error = "1"; $message = "$filename1 not found ";}
 if (file_exists($filepath."/".$filename1)) {    	
  unlink($filepath."/".$filename1);
  $message = $message." - $filename1 deleted ";  
 } else {  $error = "1"; $message = $message." - $filename1 not found ";}
}
if ($action == "Copy") {		
 if (($filename1 != "")&&($filename2 != "")&&(file_exists($filepath."/".$filename1))) { 
  copy($filepath."/".$filename1, $filepathto."/".$filename2);
  $message."$filename1 copied to $filename2";   
 } else { $error = "1"; $message = "$filename1 not found ";}
}
if ($action == "Delete") {
 if (($filename1 != "")&&(file_exists($filepath."/".$filename1))) { 	
  unlink($filepath."/".$filename1);
  $message = "$filename1 deleted";  
 } else {  $error = "1"; $message = "$filename1 not found ";}
}
if ($action == "Rename") {
 if (($filename1 != "")&&($filename2 != "")&&(file_exists($filepath."/".$filename1))) { 	
  rename($filepath."/".$filename1, $filepath."/".$filename2);
  $message."$filename1 renamed as $filename2";
 } else { $error = "1"; $message = "$filename1 not found ";}
}
if ($action == "RenameDelete") {
 if (($filename1 != "")&&($filename2 != "")&&(file_exists($filepath."/".$filename1))) { 	
  rename($filepath."/".$filename1, $filepath."/".$filename2);
  $message."$filename1 renamed as $filename2";
 } else { $error = "1"; $message = "$filename1 not found ";}
 if (($filename3 != "")&&(file_exists($filepath."/".$filename3))) {    	
  unlink($filepath."/".$filename3);
  $message = $message." - $filename3 deleted ";  
 } else {  $error = "1"; $message = $message." - $filename3 not found ";} 
 
 
} 
print "$error|$message|$action|$filepath|$filepathto|$filename1|$filename2|$filename3";
?>
