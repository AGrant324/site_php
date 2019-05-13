 <?php # tinyslimimageuploadout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "slim";
$GLOBALS{'SITEJSOPTIONAL'} = "slimjquerymin,globalroutines,tinyslimimagepopup";
PopUpHeader();

$uploadto = $_REQUEST["TinyMCEUploadTo"];
$uploadid = $_REQUEST["TinyMCEUploadId"];
$uploadwidth = $_REQUEST["TinyMCEUploadWidth"];
$uploadheight = $_REQUEST["TinyMCEUploadHeight"];
$uploadfixedsize = $_REQUEST["TinyMCEUploadFixedSize"];

$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_media";
if ($uploadto == "TemplateElement") { $fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_style"; }
if ($uploadto == "FRS") { $fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_frs"; }

XPTXT("Width=".$uploadwidth." Height=".$uploadheight);
XBR();

XFORMUPLOAD("tinyslimimageuploadin.php","tinyslimform");
XINSTDHID();
XINHID("TinyMCEUploadTo",$uploadto);
XINHID("TinyMCEUploadId",$uploadid);
XINHID("TinyMCEUploadWidth",$uploadwidth);
XINHID("TinyMCEUploadHeight",$uploadheight);
XINHID("TinyMCEUploadFixedSize",$uploadfixedsize);
XINHID("ExistingTinyImageChanged","0");
$max_upload = (int)(ini_get('upload_max_filesize'));
$max_post = (int)(ini_get('post_max_size'));
$memory_limit = (int)(ini_get('memory_limit'));
$upload_mb = min($max_upload, $max_post, $memory_limit);
XINHID("MaxUploadFileSize",$upload_mb*1000000);

print '<div class="slim">';
print '	<input type="file" class="slim" id="myTinyImageCropper" name="slim'.'[]"/>'."\n";
print '	</div>'."\n";

XBR();
XTXTID("tinyimage_imagesizemesssage","");
XBR();XBR();
XINBUTTONID("tinyimage_upload_button","Upload");
XINBUTTONIDSPINNER("tinyimage_loading_button",'Loading');
XINBUTTONID("tinyimage_cancel_button","Cancel");
X_FORM();
XBR();

PopUpFooter();
?>