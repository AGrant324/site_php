 <?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_slim.php');

Get_Common_Parameters();
GlobalRoutine();

$maxwidth = "";
$filesuffix = "";
$imageuploadto = $_REQUEST["TinyMCEUploadTo"];
$imageuploadid = $_REQUEST["TinyMCEUploadId"];
$imageuploadwidth = $_REQUEST["TinyMCEUploadWidth"];
$imageuploadheight = $_REQUEST["TinyMCEUploadHeight"];
$imageuploadfixedsize = $_REQUEST["TinyMCEUploadFixedSize"];
$existingimagechanged = $_REQUEST["ExistingTinyImageChanged"];

// XH3("XXXX".$imageuploadwidth." ".$imageuploadheight." ".$imageuploadfixedsize);

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

// XH3("XXXX".$reqdwidth." ".$reqdheight);
$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_media";
$fileprefix = $imageuploadto."_".$imageuploadid."_";
if ($imageuploadto == "TemplateElement") { $fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_style"; }
if ($imageuploadto == "FRS") { $fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_frs"; }

$maxfilesize = "30000000";
$aft = "jpg,jpeg,JPG,JPEG,gif,GIF,png,PNG,bmp,BMP";

// ======= Slim Uploader and Image Cropper ============
$iname = "myTinyImage"; // Input Field Name
$eichanged = $existingimagechanged; // Existing Image Changed
$ofpath = $fileuploadpath; // Output File Path
$ifilename = ""; // Input File Name
$aft = $aft; // Allowed File Types
$fmaxsize = $maxfilesize; // Max File Size Allowed
$aureqd = ""; // Add/Update Controls
$otempprefix = ""; // Temp Output File Prefix 
$oprefix = $fileprefix; // Output File Prefix
$osuffix = $filesuffix; // Output File Suffix
$oreqdwidth = $reqdwidth; // Output Reqd Width
$oreqdheight = $reqdheight; // Output Reqd Height
$uploadstring = Upload_SlimImageCrop($iname,$eichanged,$ofpath,$ifilename,$aft,$fmaxsize,$aureqd,$otempprefix,$oprefix,$osuffix,$oreqdwidth,$oreqdheight);
# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
// ====================================================

print $uploadstring;


?>