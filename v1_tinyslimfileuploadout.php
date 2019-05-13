 <?php # tinyslimfileuploadout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

Get_Common_Parameters();
GlobalRoutine();
// $GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
$GLOBALS{'SITECSSOPTIONAL'} = "slim";
$GLOBALS{'SITEJSOPTIONAL'} = "slimjquerymin,tinyslimimagepopup";
PopUpHeader();

$uploadto = $_REQUEST["TinyMCEUploadTo"];
$uploadid = $_REQUEST["TinyMCEUploadId"];
$uploadwidth = $_REQUEST["TinyMCEUploadWidth"];
$uploadheight = $_REQUEST["TinyMCEUploadHeight"];
$uploadfixedsize = $_REQUEST["TinyMCEUploadFixedSize"];
$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_media";

if ($uploadto == "TemplateElement") { $fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_style"; }
if ($uploadto == "FRS") { $fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_frs"; }

// XH3("Upload - $uploadto");
// XBR();

XFORMUPLOAD("tinyslimfileuploadin.php","FileUpload");
XINSTDHID();
XINHID("TinyMCEUploadTo",$uploadto);
XINHID("TinyMCEUploadId",$uploadid);
XINHID("TinyMCEUploadWidth",$uploadwidth);
XINHID("TinyMCEUploadHeight",$uploadheight);
XINHID("TinyMCEUploadFixedSize",$uploadfixedsize);

print '<div class="slim"'."\n";
// print '	data-ratio="4:3"'."\n";
// print '	data-size="480,360">'."\n";
print '  data-max-file-size="20">'."\n";
print '	<input type="file" class="slim" id="myTinyImageCropper" name="slim[]"/>'."\n";
print '	</div>'."\n";

XBR();
XINSUBMIT("Upload!");
X_FORM();
XBR();
$max_upload = (int)(ini_get('upload_max_filesize'));
$max_post = (int)(ini_get('post_max_size'));
$memory_limit = (int)(ini_get('memory_limit'));
$upload_mb = min($max_upload, $max_post, $memory_limit);
// if ($upload_mb > 0) {XPTXT("Please note that the maximum file size on this server is ".$upload_mb."MB");}

PopUpFooter();
?>