<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_slim.php');

Get_Common_Parameters();
GlobalRoutine();

// This is a test routine for "slimimageupload.php"

/*
XH2('Server Parameters');
$max_upload = (int)(ini_get('upload_max_filesize'));
XTXT("max_upload - ".$max_upload);
$max_post = (int)(ini_get('post_max_size'));
XBR();XTXT("max_post - ".$max_post);
$memory_limit = (int)(ini_get('memory_limit'));
XBR();XTXT("memory_limit - ".$memory_limit);
$upload_mb = min($max_upload, $max_post, $memory_limit);
XBR();XTXT("max_upload - ".$max_upload);
*/

$maxwidth = "";
$filesuffix = "";
$imagefieldname = $_REQUEST["ImageInputName"];
$inimageinputname = $_REQUEST["ImageInputName"];
$inimagetext = $_REQUEST[$inimageinputname];
$inimageuploadto = $_REQUEST["ImageUploadTo"];
$inimageuploadid = $_REQUEST["ImageUploadId"];
$inimageuploadwidth = $_REQUEST["ImageUploadWidth"];
$inimageuploadheight = $_REQUEST["ImageUploadHeight"];
$inimageuploadfixedsize = $_REQUEST["ImageUploadFixedSize"];

/*
XH2('Image Upload Parameters.');
XTXT("ImageInputName - ".$inimageinputname);
XBR();XTXT("ImageUploadTo - ".$inimageuploadto);
XBR();XTXT("ImageUploadId - ".$inimageuploadid);
XBR();XTXT("ImageUploadWidth - ".$inimageuploadwidth);
XBR();XTXT("ImageUploadHeight - ".$inimageuploadheight);
XBR();XTXT("ImageUploadFixedSize - ".$inimageuploadfixedsize);
XBR();
*/

/*
XTEXTAREA("InputText","25","70");
print_r($_REQUEST);
print_r($_FILES);
XBR();XBR();
X_TEXTAREA();
*/

// XH1($uploadfixedsize);
if ( $uploadfixedsize != "" ) {
	$bits = explode("x",$uploadfixedsize);
	$reqdwidth = $bits[0];
	// ../xxxxx/domain_media/Webpage_Home_126_0219_FixedSize_750x450.JPG
	$filesuffix = "_FixedSize_".$inimageuploadfixedsize;
}

$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_media";
$uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_media";
$fileprefix = $inimageuploadto."_".$inimageuploadid."_";
if ( $reqdwidth == "" ) {
	$reqdwidth = "600";
}

$maxfilesize = "30000000";
$aft = "jpg,jpeg,JPG,JPEG,gif,GIF,png,PNG,bmp,BMP";

/*
XH2('Image Processing Parameters.');
XTXT("inimageinputname - ".$inimageinputname);
XBR();XTXT("fileuploadpath - ".$fileuploadpath);
XBR();XTXT("filename - NULL");
XBR();XTXT("aft - ".$aft);
XBR();XTXT("maxfilesize - ".$maxfilesize);
XBR();XTXT("add/update - NULL");
XBR();XTXT("tempprefix - NULL");
XBR();XTXT("fileprefix - ".$fileprefix);
XBR();XTXT("filesuffix - ".$filesuffix);
XBR();XTXT("reqdwidth - ".$reqdwidth);
*/


// ======= Slim Uploader and Image Cropper ============
$iname = $inimageinputname; // Input Form Name
$ofpath = $fileuploadpath; // Output File Path
$ifilename = ""; // Input File Name
$aft = $aft; // Allowed File Types
$fmaxsize = $maxfilesize; // Max File Size Allowed
$aureqd = ""; // Add/Update Controls
$otempprefix = "tempf_"; // Temp Output File Prefix 
$oprefix = $fileprefix; // Output File Prefix
$osuffix = $filesuffix; // Output File Suffix
$oreqdwidth = $reqdwidth; // Output Reqd Width
$oreqdheight = "flex"; // Output Reqd Height
$uploadstring = Upload_SlimImageCrop($iname,$ofpath,$ifilename,$aft,$fmaxsize,$aureqd,$otempprefix,$oprefix,$osuffix,$oreqdwidth,$oreqdheight);
# uploadname $uploadname,$fpath,$filename,$aft,$fmaxsize,$aureqd,$tempprefix,$prefix,$maxwidth
# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
# print("XXXXX - ".$uploadstring." - XXXXX");
// ====================================================

print $uploadstring;


/*
$ubits = explode('|', $uploadstring);
XH2('Image Load Results.');
XBR();XTXT("ErrorCode - ".$ubits[0]);
XBR();XTXT("Message - ".$ubits[0]);
XBR();XTXT("FileName - ".$ubits[2]);
XBR();XTXT("Added/Updated - ".$ubits[3]);
XBR();XTXT("Filesize - ".$ubits[4]);
XBR();XTXT("Width - ".$ubits[5]);
XBR();XTXT("Height - ".$ubits[6]);

$testimage = "Test_T99999_123456.jpg";
if ($ubits[0] == "0") {
	XBR();
	// XPTXT($ubits[1]);
	XPTXTCOLOUR("Image successfully loaded - ".$ubits[2],"green");
	$testimage = $ubits[2];
	XIMGFLEX($GLOBALS{'domainwwwurl'}.'/domain_media/'.$testimage);
} else {
	XBR();
	if ($ubits[2] == "") {
		$ubits[1] = "Image Deleted";
	} else {
		if ($ubits[1] == "Return Code:1") {
			$ubits[1] = "Uploaded file too large";
		}
		if ($ubits[1] == "No images found") {
			$ubits[1] = "No test image found";
		}
	}
	XPTXTCOLOUR($ubits[1],"red");
}

XHR();
*/


?>


