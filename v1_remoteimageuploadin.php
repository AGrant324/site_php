 <?php # fileupload.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
// Check_Session_Validity();

$uploadtotype = $_REQUEST["UploadToType"];
$uploadtoid = $_REQUEST["UploadToId"];
$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_media";
$uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_media";
$fileprefix = $uploadtotype."_".$GLOBALS{'person_id'}."_".$uploadtoid."_";

$maxfilesize = "30000000";
$aft = "jpg,jpeg,JPG,JPEG,gif,GIF,png,PNG,bmp,BMP,wbmp,WBMP,mp4,MP4,m4v,M4V,swf,SWF,doc,DOC,docx,DOCX,pdf,PDF,xls,XLS,xlsx,XLSX";

$uploadstring = Upload_File("FileUploadName",$fileuploadpath,"",$aft,$maxfilesize,"","",$fileprefix,"");
# uploadname filepath filename allowedfiletypes maxsize add/update tempprefix prefix
# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
// XH5($uploadstring);
$ubits = explode('|', $uploadstring);

if ($ubits[0] == "0") {	
	$imagename = $ubits[2];
	$fbits = explode(".",$imagename);
	$imagetype = $fbits[1];
	$imageroot = $fbits[0];
	$imagefullname = $fileuploadpath."/".$imagename;
	 XH5($imagefullname." xxxxxx ".$imagename);
	
	$targetimagewidth = 500;
	list($orig_width, $orig_height) = getimagesize($imagefullname);
	$percent = $targetimagewidth/$orig_width;
	$new_width = $orig_width * $percent;
	$new_height = $orig_height * $percent;
	$canvas = imagecreatetruecolor($new_width, $new_height);
	
	if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
	if ($imagetype == "jpeg") {$current_image = imagecreatefromjpeg($imagefullname);}
	if ($imagetype == "gif") {$current_image = imagecreatefromgif($imagefullname);}
	if ($imagetype == "png") {$current_image = imagecreatefrompng($imagefullname);}
	if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}
	if ($imagetype == "JPEG") {$current_image = imagecreatefromjpeg($imagefullname);}
	if ($imagetype == "GIF") {$current_image = imagecreatefromgif($imagefullname);}
	if ($imagetype == "PNG") {$current_image = imagecreatefrompng($imagefullname);}
	
	#  imagecopyresampled ( dest_image, source_image, dest_x, dest_y, source_x, source_y, dest_width, dest_height, source_width, source_height);
	imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, $new_width, $new_height, $orig_width, $orig_height);   
	  
	if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
	if ($imagetype == "jpeg") {imagejpeg($canvas, $imagefullname);}
	if ($imagetype == "gif") {imagegif($canvas, $imagefullname);}
	if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
	if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
	if ($imagetype == "JPEG") {imagejpeg($canvas, $imagefullname);}
	if ($imagetype == "GIF") {imagegif($canvas, $imagefullname);}
	if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}

	print "Success - $imagefullname uploaded";

} else {
	if ($ubits[1] == "Return Code:1") {$ubits[1] = "Uploaded file too large";}	
	print "Error - File too large";
}


?>