<<<<<<< HEAD
<?php # imagecrop.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

Get_Common_Parameters();
GlobalRoutine();
# Get_Data("person",$GLOBALS{'LOGIN_person_id'});
# Check_Session_Validity();

$cropscaling = $_GET['CropScaling'];
$incropleft = $_GET['CropLeft'];
$incroptop = $_GET['CropTop'];
$incropheight=$_GET['CropHeight'];
$incropwidth=$_GET['CropWidth'];
$reqdimageheight=$_GET['ReqdImageHeight'];
$reqdimagewidth=$_GET['ReqdImageWidth'];
$imagepath = $_GET['CropImagePath'];
// The following avoids mod security issues because of ../../ etc
$imagepath = expandSymbolicPath($imagepath);
$imagename = $_GET['CropImageName'];
$imagefinalname = $_GET['CropImageFinalName'];
$imagefullname = $imagepath."/".$imagename;
$imagefinalfullname = $imagepath."/".$imagefinalname;
$action = $_GET['Action'];
$error = "0";
$message = "";

# reconstruct cropping factors against original image (not yet considering required image size)
$actcropheight = round(($incropheight/$cropscaling),0);
$actcropwidth = round(($incropwidth/$cropscaling),0);
$actcroptop = round(($incroptop/$cropscaling),0);
$actcropleft = round(($incropleft/$cropscaling),0);

if (file_exists($imagefullname)) { 
	// Get dimensions of the original image
	# list($current_width, $current_height) = getimagesize($imagefullname);
	// Resample the image
	# Set the new canvas size and cropping according to the required image size 	
	if (($reqdimageheight == "flex")&&($reqdimagewidth == "flex"))  { 	
	   $outcropheight = $actcropheight;
	   $outcropwidth = $actcropwidth;
	}
	if (($reqdimageheight != "flex")&&($reqdimagewidth == "flex"))  { 	
	   $outcropheight = $reqdimageheight;
	   $outcropwidth = round(($actcropwidth*$reqdimageheight/$actcropheight),0);
	}  
	if (($reqdimageheight == "flex")&&($reqdimagewidth != "flex"))  {
	   $outcropwidth = $reqdimagewidth;   	 	
	   $outcropheight = round(($actcropheight*$reqdimagewidth/$actcropwidth),0);
	}  
	
	$canvas = imagecreatetruecolor($outcropwidth, $outcropheight);
	$bits = explode(".",$imagename);
	$imagetype = end($bits);

	if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
	if ($imagetype == "jpeg") {$current_image = imagecreatefromjpeg($imagefullname);}
	if ($imagetype == "gif") {$current_image = imagecreatefromgif($imagefullname);}
	if ($imagetype == "png") {$current_image = imagecreatefrompng($imagefullname);}
	if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}
	if ($imagetype == "JPEG") {$current_image = imagecreatefromjpeg($imagefullname);}
	if ($imagetype == "GIF") {$current_image = imagecreatefromgif($imagefullname);}
	if ($imagetype == "PNG") {$current_image = imagecreatefrompng($imagefullname);}
  
	#  imagecopy($canvas, $current_image, 0, 0, $outcropleft, $outcroptop, $outcropwidth, $outcropheight);
	#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
	imagecopyresampled ( $canvas, $current_image, 0, 0, $actcropleft, $actcroptop, $outcropwidth, $outcropheight, $actcropwidth, $actcropheight);   

	if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
	if ($imagetype == "jpeg") {imagejpeg($canvas, $imagefullname);}
	if ($imagetype == "gif") {imagegif($canvas, $imagefullname);}
	if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
	if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
	if ($imagetype == "JPEG") {imagejpeg($canvas, $imagefullname);}
	if ($imagetype == "GIF") {imagegif($canvas, $imagefullname);}
	if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
	if ($action == "Finalise") {  # CHECK no longer used ?
		copy($imagefullname, $imagefinalfullname);
		chmod($imagefinalfullname, 0644);
		unlink($imagefullname);	
	}
} else {
	$error = "1";
	$message = "$imagefullname not found";	
}

print "$error|$message|$outcropwidth|$outcropheight|$action|$cropscaling|$imagefullname|$imagefinalfullname";
?>
=======
<?php # imagecrop.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

Get_Common_Parameters();
GlobalRoutine();
# Get_Data("person",$GLOBALS{'LOGIN_person_id'});
# Check_Session_Validity();

$cropscaling = $_GET['CropScaling'];
$incropleft = $_GET['CropLeft'];
$incroptop = $_GET['CropTop'];
$incropheight=$_GET['CropHeight'];
$incropwidth=$_GET['CropWidth'];
$reqdimageheight=$_GET['ReqdImageHeight'];
$reqdimagewidth=$_GET['ReqdImageWidth'];
$imagepath = $_GET['CropImagePath'];
// The following avoids mod security issues because of ../../ etc
$imagepath = expandSymbolicPath($imagepath);
$imagename = $_GET['CropImageName'];
$imagefinalname = $_GET['CropImageFinalName'];
$imagefullname = $imagepath."/".$imagename;
$imagefinalfullname = $imagepath."/".$imagefinalname;
$action = $_GET['Action'];
$error = "0";
$message = "";

# reconstruct cropping factors against original image (not yet considering required image size)
$actcropheight = round(($incropheight/$cropscaling),0);
$actcropwidth = round(($incropwidth/$cropscaling),0);
$actcroptop = round(($incroptop/$cropscaling),0);
$actcropleft = round(($incropleft/$cropscaling),0);

if (file_exists($imagefullname)) { 
	// Get dimensions of the original image
	# list($current_width, $current_height) = getimagesize($imagefullname);
	// Resample the image
	# Set the new canvas size and cropping according to the required image size 	
	if (($reqdimageheight == "flex")&&($reqdimagewidth == "flex"))  { 	
	   $outcropheight = $actcropheight;
	   $outcropwidth = $actcropwidth;
	}
	if (($reqdimageheight != "flex")&&($reqdimagewidth == "flex"))  { 	
	   $outcropheight = $reqdimageheight;
	   $outcropwidth = round(($actcropwidth*$reqdimageheight/$actcropheight),0);
	}  
	if (($reqdimageheight == "flex")&&($reqdimagewidth != "flex"))  {
	   $outcropwidth = $reqdimagewidth;   	 	
	   $outcropheight = round(($actcropheight*$reqdimagewidth/$actcropwidth),0);
	}  
	
	$canvas = imagecreatetruecolor($outcropwidth, $outcropheight);
	$bits = explode(".",$imagename);
	$imagetype = end($bits);

	if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
	if ($imagetype == "jpeg") {$current_image = imagecreatefromjpeg($imagefullname);}
	if ($imagetype == "gif") {$current_image = imagecreatefromgif($imagefullname);}
	if ($imagetype == "png") {$current_image = imagecreatefrompng($imagefullname);}
	if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}
	if ($imagetype == "JPEG") {$current_image = imagecreatefromjpeg($imagefullname);}
	if ($imagetype == "GIF") {$current_image = imagecreatefromgif($imagefullname);}
	if ($imagetype == "PNG") {$current_image = imagecreatefrompng($imagefullname);}
  
	#  imagecopy($canvas, $current_image, 0, 0, $outcropleft, $outcroptop, $outcropwidth, $outcropheight);
	#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
	imagecopyresampled ( $canvas, $current_image, 0, 0, $actcropleft, $actcroptop, $outcropwidth, $outcropheight, $actcropwidth, $actcropheight);   

	if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
	if ($imagetype == "jpeg") {imagejpeg($canvas, $imagefullname);}
	if ($imagetype == "gif") {imagegif($canvas, $imagefullname);}
	if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
	if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
	if ($imagetype == "JPEG") {imagejpeg($canvas, $imagefullname);}
	if ($imagetype == "GIF") {imagegif($canvas, $imagefullname);}
	if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
	if ($action == "Finalise") {  # CHECK no longer used ?
		copy($imagefullname, $imagefinalfullname);
		chmod($imagefinalfullname, 0644);
		unlink($imagefullname);	
	}
} else {
	$error = "1";
	$message = "$imagefullname not found";	
}

print "$error|$message|$outcropwidth|$outcropheight|$action|$cropscaling|$imagefullname|$imagefinalfullname";
?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
