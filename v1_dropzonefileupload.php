<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

// print_r($_POST);
// print_r($_FILES);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");

/*
$uploadstring = "ZZZ";
$poststring = "";
foreach ($_POST as $key => $value) {
    $poststring = $poststring.$key."=".$value."|";
}
$arr = array($uploadstring."|".$poststring);
print $_GET['callback']."(".json_encode($arr).");";
*/

$poststring = "";
foreach ($_POST as $key => $value) {
    $poststring = $poststring.$key."=".$value."|";
}

Get_Common_Parameters();
GlobalRoutine();

$filefieldname = $_REQUEST["FileFieldName"];
$fileuploadto = $_REQUEST[$filefieldname."_FileUploadTo"];
$fileuploadid = $_REQUEST[$filefieldname."_FileUploadId"];
$fileuploadmaxwidth = $_REQUEST[$filefieldname."_FileUploadMaxWidth"];

$fileuploadpath = $GLOBALS{'domainfilepath'}."/assets";
$poststring = $poststring."fileuploadpath=".$fileuploadpath."|";
// $fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_temp";

$aft = "all";
// if ($allowedfileuploadtypes == "images") {$aft = "jpg,jpeg,JPG,JPEG,gif,GIF,png,PNG,bmp,BMP,wbmp,WBMP,pdf";}
// if ($allowedfileuploadtypes == "all") {	$aft = "all"; }
$maxfilesize = "10000000";
$tempprefix = "tempf_";
$fileprefix = $fileuploadto."_".$fileuploadid."_";

# uploadname filepath filename allowedfiletypes maxsize add/update tempprefix prefix maxwidth
$uploadstring = Upload_DropZoneFile("FileUploadName",$fileuploadpath,"",$aft,$maxfilesize,"",$tempprefix,$fileprefix,"");
# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
# Note that filename returned is without the tempprefix

$ubits = explode('|', $uploadstring);

if (($filereplaced != "")&&($filereplaced != $tempprefix.$ubits[2])) {
 if (file_exists($fileuploadpath."/".$filereplaced)) { 	
  unlink($fileuploadpath."/".$filereplaced);
 } 
}

// print $uploadstring;

$arr = array($uploadstring."|".$poststring);
print $_GET['callback']."(".json_encode($arr).");";


?>