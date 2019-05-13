 <?php # tinyfileuploadout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "dropzone";
$GLOBALS{'SITEJSOPTIONAL'} = "dropzonemin,tinydropzonepopup";
PopUpHeader();

$uploadto = $_REQUEST["TinyMCEUploadTo"];
$uploadid = $_REQUEST["TinyMCEUploadId"];

$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_media";
if ($uploadto == "TemplateElement") { $fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_style"; }
if ($uploadto == "FRS") { $fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_frs"; }

XH3("Upload - $uploadto");
XBR();

XFORMDROPZONE("tinyfileuploadin.php","FileUpload");
// XFORMUPLOAD("tinyfileuploadin.php","FileUpload");
XINSTDHID();
XINHID("TinyMCEUploadTo",$uploadto);
XINHID("TinyMCEUploadId",$uploadid);
XINFILE("FileUploadName","10000000");

print '<div id="dropzonePreview" class="dz-default dz-message">'."\n";
print '<span>Drop files here to upload....</span>'."\n";
print '</div>'."\n";
XBR();XBR();
XINSUBMIT("Upload!");
X_FORM();


/*
print '<form id="upload-widget" method="post" action="/upload" class="dropzone">'."\n";
print '<div id="dropzonePreview" class="dz-default dz-message">'."\n";
print '<span>Drop files here to upload....</span>'."\n";
print '</div>'."\n";
print '</form>'."\n";
*/


XBR();
$max_upload = (int)(ini_get('upload_max_filesize'));
$max_post = (int)(ini_get('post_max_size'));
$memory_limit = (int)(ini_get('memory_limit'));
$upload_mb = min($max_upload, $max_post, $memory_limit);
if ($upload_mb > 0) {XPTXT("Please note that the maximum file size on this server is ".$upload_mb."MB");}

PopUpFooter();
?>