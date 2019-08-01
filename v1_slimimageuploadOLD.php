 <?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_slim.php');

Get_Common_Parameters();
GlobalRoutine();

$filesuffix = "";
$imagefieldname = $_REQUEST["ImageFieldName"];
$imageuploadto = $_REQUEST[$imagefieldname."_ImageUploadTo"];
$imageuploadid = $_REQUEST[$imagefieldname."_ImageUploadId"];
$imageuploadwidth = $_REQUEST[$imagefieldname."_ImageUploadWidth"];
$imageuploadheight = $_REQUEST[$imagefieldname."_ImageUploadHeight"];
$imageuploadfixedsize = $_REQUEST[$imagefieldname."_ImageUploadFixedSize"];
$imagethumbwidth = $_REQUEST[$imagefieldname."_ImageThumbWidth"];
$existingimagechanged = $_REQUEST["ExistingImageChanged"];

if ( $imageuploadfixedsize != "" ) {
	$bits = explode("x",$imageuploadfixedsize);
	$reqdwidth = $bits[0]; 
	$reqdheight = $bits[1];
	// ../xxxxx/domain_media/Webpage_Home_126_0219_FixedSize_750x450.JPG
	$filesuffix = "_FixedSize_".$imageuploadfixedsize;
} else {
	if (($imageuploadwidth == "flex")&&($imageuploadwidth == "flex")) { $reqdwidth = "flex"; $reqdheight = "flex"; }
	if (($imageuploadwidth != "flex")&&($imageuploadheight == "flex")) { $reqdwidth = $imageuploadwidth; $reqdheight = "flex"; }
	if (($imageuploadwidth == "flex")&&($imageuploadheight != "flex")) { $reqdwidth = "flex"; $reqdheight = $imageuploadheight; }
	if (($imageuploadwidth != "flex")&&($imageuploadheight != "flex")) { $reqdwidth = $imageuploadwidth; $reqdheight = $imageuploadheight; }
}

$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_media";
$uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_media";
$fileprefix = $imageuploadto."_".$imageuploadid."_";
if ($imageuploadto == "TemplateElement") {
	$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_style";
	$uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_style";
}
if ($imageuploadto == "FRS") {
	$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_frs";
	$uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_frs";
}
if ($imageuploadto == "Advertiser") {
    $fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_advertisers";
    $uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_advertisers";
}
if ($imageuploadto == "Carousel") {
	$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_style";
	$uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_style";
}
if ($imageuploadto == "Plugin") {
    $fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_style";
    $uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_style";
}
if ($imageuploadto == "PersonPhoto") {
    $fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_temp";
    $uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_temp";
}

$maxfilesize = "30000000";
$aft = "jpg,jpeg,JPG,JPEG,gif,GIF,png,PNG,bmp,BMP";

// ======= Slim Uploader and Image Cropper ============
$iname = $imagefieldname; // Input Field Name
$eichanged = $existingimagechanged; // Existing Image Changed
$ofpath = $fileuploadpath; // Output File Path
$ifilename = ""; // Input File Name
$aft = $aft; // Allowed File Types
$fmaxsize = $maxfilesize; // Max File Size Allowed
$aureqd = ""; // Add/Update Controls
$otempprefix = "tempf_"; // Temp Output File Prefix 
$oprefix = $fileprefix; // Output File Prefix
$osuffix = $filesuffix; // Output File Suffix
$oreqdwidth = $reqdwidth; // Output Reqd Width
$oreqdheight = $reqdheight; // Output Reqd Height
$uploadstring = Upload_SlimImageCrop($iname,$eichanged,$ofpath,$ifilename,$aft,$fmaxsize,$aureqd,$otempprefix,$oprefix,$osuffix,$oreqdwidth,$oreqdheight);
# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
// ====================================================

$bits = explode('|',$uploadstring);
if (($bits[0] == "0")&&($imagethumbwidth != "")) {
	$thumbname = Imagename2Thumbname($bits[2]);
	copy($ofpath."/".$bits[2],$ofpath."/".$thumbname);
	ConstrainImageWidth( $ofpath."/".$thumbname, $imagethumbwidth);
}

print $uploadstring;


?>