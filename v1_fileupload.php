 <?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$fileuploadpath = $_REQUEST["FileUploadPath"];
$filereplaced = $_REQUEST["FileReplaced"];
$allowedfileuploadtypes = $_REQUEST["AllowedFileUploadTypes"];
$tempprefix = $_REQUEST["TempPrefix"];
$prefix = $_REQUEST["Prefix"];
$maxfilesize = "10000000";
$aft = "";

// The following avoids mod security issues because of ../../
$fileuploadpath = expandSymbolicPath($fileuploadpath);

/*
print "Content-type: text/html\n\n";		
print "<P>----- FILEUPLOAD DIAGNOSTIC ------<BR>";
print "$fileuploadpath|$filereplaced|$allowedfileuploadtypes|$tempprefix|$prefix|$maxfilesize";
*/

if ($allowedfileuploadtypes == "images") {$aft = "jpg,jpeg,JPG,JPEG,gif,GIF,png,PNG,bmp,BMP,wbmp,WBMP,pdf";}
if ($allowedfileuploadtypes == "all") {	$aft = "all"; }
# uploadname filepath filename allowedfiletypes maxsize add/update tempprefix prefix
$uploadstring = Upload_File("FileUploadName",$fileuploadpath,"",$aft,$maxfilesize,"",$tempprefix,$prefix,"");
# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
# Note that filename returned is without the tempprefix


$ubits = explode('|', $uploadstring);

if (($filereplaced != "")&&($filereplaced != $tempprefix.$ubits[2])) {
 if (file_exists($fileuploadpath."/".$filereplaced)) { 	
  unlink($fileuploadpath."/".$filereplaced);
 } 
}

print $uploadstring;

?>