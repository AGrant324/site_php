<<<<<<< HEAD
<?php # ioroutines.php

function Get_Directory_Array ($tdirectory) {
$tdh  = opendir($tdirectory);
$tdirfiles = array();
while (false !== ($tfilename = readdir($tdh))) {
	if ($tfilename != "." && $tfilename != "..") {
		array_push($tdirfiles, $tfilename);
		# XPTXT($tfilename);
	}
}
return $tdirfiles;
}

function Check_Folder ($folder) {
    $GLOBALS{'IOWARNING'} = "0";
    $path = realpath($folder);
    // If it exist, check if it's a directory
    if($path !== false AND is_dir($path)) { } else { $GLOBALS{'IOWARNING'} = "1"; }
}

function Delete_File ($filename) {
# XBR();XTXT("Delete_File Called - $filename");XBR();
$GLOBALS{'IOWARNING'} = "0";		
if (file_exists($filename)) { unlink($filename); } 
else {$GLOBALS{'IOWARNING'} = "1"; }
}

function Delete_Directory_AllLevels($dir,$trace) {
    if(!$dh = @opendir($dir)) { return; }
    while (false !== ($obj = readdir($dh))) {
        if($obj == '.' || $obj == '..') { continue; }
        if (!@unlink($dir . '/' . $obj)) { Delete_Directory_AllLevels($dir.'/'.$obj,$trace); }
        else { if ($trace == "ShowTrace") { print $dir . '/' . $obj."   Deleted<br>"; } }
    }
    closedir($dh);
    @rmdir($dir);
    if ($trace == "ShowTrace") { print $dir."   Deleted<br>"; }
    return;
}

function Check_File ($filename) {
# XBR();XTXT("Check_File Called - $filename");XBR();	
$GLOBALS{'IOWARNING'} = "0";
$fp = @fopen($filename, "r") or SilentWarningRoutine(); 	
}

function Get_File_Array ($filename) {
# XBR();XTXT("Get_File_Array Called - $filename");XBR();
$GLOBALS{'IOERRORcode'} = "Get_File_Array"; $GLOBALS{'IOERRORmessage'} = $filename." Not Found";
$fp = @fopen($filename, "r") or ErrorRoutine(); 	
$fdata = fread($fp, filesize($filename));
while(!feof($fp)){$fdata .= fgets($fp, 1024);} 
fclose($fp);
# test for unix or windows file
$nstr = "\n"; $rstr = "\r";
$npos = strpos($fdata, $nstr); if ($npos == false) { $npos = 999; }
$rpos = strpos($fdata, $rstr); if ($rpos == false) { $rpos = 999; }
# XH2($filename."| N and R |".$npos."|".$rpos."|");
$servertype = "unknown";
if (($npos == 999)&&($rpos == 999)) {$fvalues = array($fdata); $servertype = "SINGLE RECORD";} # Single record
else {
 if ($rpos == $npos-1 ) { $fvalues = explode("\r\n", $fdata); $servertype = "WINDOWS";} # WINDOWS
 else {
  if ($rpos < 200) { $fvalues = explode("\r", $fdata);	$servertype = "MAC";} # MAC
  if ($npos < 200) { $fvalues = explode("\n", $fdata); $servertype = "UNIX";} # UNIX	
 }
}
return $fvalues;
}

function Open_File_Write ($filename) {
$fp = fopen($filename, "w") or ErrorRoutine();  	
return $fp;
}

function Write_File ($filehandle, $filedata) {
fwrite($filehandle, $filedata);	
}

function Close_File_Write ($fp) {
fclose($fp);
}

function Upload_File ($uploadname,$fpath,$filename,$aft,$fmaxsize,$aureqd,$tempprefix,$prefix,$maxwidth)  {
	# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix $maxwidth - returns string - Error(1/0)|Message|filename|filesize|width|height
	// XH5("Upload_File - called - $uploadname|$fpath|$filename|$aft|$fmaxsize|$aureqd|$tempprefix|$prefix|$maxwidth");

	ini_set('upload-max-filesize', '64M');

	$errorcode = "0"; $message = ""; $autaken = ""; $filesize=""; $width=""; $height="";
	
	if ($_FILES[$uploadname]["name"] == "") {
		$errorcode = "1";
		$message = "No file uploaded";		
	} else {
		if ($filename == "") { $filename = $_FILES[$uploadname]["name"];}
		$filesize = $_FILES[$uploadname]["size"];
		$mbits = explode(".", $filename);
		$filetype = end($mbits);
		
		XH5("Filename ".$filename." - Filetype ".$filetype);
		$filefirstname = str_replace(".".$filetype, "", $filename);
		$GLOBALS{'IOWARNING'} = "0";
		if ($filesize <= $fmaxsize) {
			if ((strlen(strstr($aft,$filetype))>0)||($aft == "all")) {
				if ($_FILES[$uploadname]["error"] > 0) {
					$errorcode = "1";
					$message = "Return Code:".$_FILES[$uploadname]["error"];
				} else {
					$extramessage = "";
					if ( FileIsImage($filetype) == true ) {
						list($width, $height) = getimagesize($_FILES[$uploadname]["tmp_name"]);
						if (($maxwidth != "" )&&($width > $maxwidth)) {
							$extramessage = ". Image width reduced to ".$maxwidth." px";
						}
					}
					
					if (file_exists($fpath."/".$filename)) { $GLOBALS{'IOWARNING'} = "1"; }			
					if ($GLOBALS{'IOWARNING'} == "1") {
						if ($aureqd == "") {
							move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
							if ( FileIsImage($filetype) == true ) {
								ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
							}
							chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
							$message = "Successfully updated file - ".$maxwidth." ".$_FILES[$uploadname]["name"].$extramessage;
							$autaken = "updated";
						}
						if ($aureqd == "update") {
							move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
							if ( FileIsImage($filetype) == true ) {
								ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
							}
							chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
							$message = "Successfully updated file - ".$_FILES[$uploadname]["name"].$extramessage;
							$autaken = "updated";
						}
						if ($aureqd == "add") {
							$errorcode = "1";
							$message = "ERROR: File already exists - ".$_FILES[$uploadname]["name"];
						}
					}
					if ($GLOBALS{'IOWARNING'} == "0") {
						if ($aureqd == "") {
							move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
							if ( FileIsImage($filetype) == true ) {
								ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
							}
							chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
							$message = "Successfully added file - ".$_FILES[$uploadname]["name"].$extramessage;
							$autaken = "added";
						}
						if ($aureqd == "update") {
							$errorcode = "1";
							$message = "ERROR: File does not already exist - ".$_FILES[$uploadname]["name"];
						}
						if ($aureqd == "add") {
							# print "from - ".$_FILES[$uploadname]["tmp_name"]." to ".$fpath."/".$prefix.$filename."<br>/n";
							move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
							if ( FileIsImage($filetype) == true ) {
								ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
							}
							chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
							$message = "Successfully added file - ".$_FILES[$uploadname]["name"].$extramessage;
							$autaken = "added";
						}
					}
				}
			} else {
				$errorcode = "1";
				$message = "Invalid file type - ".$filetype."- should be ".$aft;
			}
		} else {
			$errorcode = "1";
			$message = "File too large - greater than ".$fmaxsize."KB";
		}
	}
	# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
	# Note that filename returned is without the tempprefix
	# print $fpath."  -  ".$message;
	return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
}

function Upload_DropZoneFile ($uploadname,$fpath,$filename,$aft,$fmaxsize,$aureqd,$tempprefix,$prefix,$maxwidth)  {
	# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix $maxwidth - returns string - Error(1/0)|Message|filename|filesize|width|height
	// XH5("Upload_File - called - $uploadname|$fpath|$filename|$aft|$fmaxsize|$aureqd|$tempprefix|$prefix|$maxwidth");
	ini_set('upload-max-filesize', '64M');
	
	$errorcode = "0"; $message = ""; $autaken = ""; $filesize=""; $width=""; $height="";
	if ($filename == "") {$filename = $_FILES[$uploadname]["name"];}
	$filesize = $_FILES[$uploadname]["size"];
	$mbits = explode(".", $filename);
	$filetype = end($mbits);
	
	$filefirstname = str_replace(".".$filetype, "", $filename);
	$GLOBALS{'IOWARNING'} = "0";
	if ($filesize <= $fmaxsize) {
		if ((strlen(strstr($aft,$filetype))>0)||($aft == "all")) {
			if ($_FILES[$uploadname]["error"] > 0) {
				$errorcode = "1";
				$message = "Return Code:".$_FILES[$uploadname]["error"];
			} else {
				$extramessage = "";
				if ( FileIsImage($filetype) == true ) {
					list($width, $height) = getimagesize($_FILES[$uploadname]["tmp_name"]);
					if (($maxwidth != "" )&&($width > $maxwidth)) {
						$extramessage = ". Image width reduced to ".$maxwidth." px";
					}
				}
	
				if (file_exists($fpath."/".$filename)) {
					$GLOBALS{'IOWARNING'} = "1";
				}
				if ($GLOBALS{'IOWARNING'} == "1") {
					if ($aureqd == "") {
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
						if ( FileIsImage($filetype) == true ) {
							ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
						}
						chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
						$message = "Successfully updated file - ".$maxwidth." ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "updated";
					}
					if ($aureqd == "update") {
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
						if ( FileIsImage($filetype) == true ) {
							ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
						}
						chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
						$message = "Successfully updated file - ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "updated";
					}
					if ($aureqd == "add") {
						$errorcode = "1";
						$message = "ERROR: File already exists - ".$_FILES[$uploadname]["name"];
					}
				}
				if ($GLOBALS{'IOWARNING'} == "0") {
					if ($aureqd == "") {
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
						if ( FileIsImage($filetype) == true ) {
							ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
						}
						chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
						$message = "Successfully added file - ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "added";
					}
					if ($aureqd == "update") {
						$errorcode = "1";
						$message = "ERROR: File does not already exist - ".$_FILES[$uploadname]["name"];
					}
					if ($aureqd == "add") {
						# print "from - ".$_FILES[$uploadname]["tmp_name"]." to ".$fpath."/".$prefix.$filename."<br>/n";
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
					if ( FileIsImage($filetype) == true ) {
						ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
					}
					chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
					$message = "Successfully added file - ".$_FILES[$uploadname]["name"].$extramessage;
					$autaken = "added";
					}
				}
			}
		} else {
			$errorcode = "1";
			$message = "Invalid file type - ".$filetype."- should be ".$aft;
		}
	} else {
		$errorcode = "1";
		$message = "File too large - greater than ".$fmaxsize."KB";
	}
	# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
	# Note that filename returned is without the tempprefix
	# print $fpath."  -  ".$message;
	return "$errorcode|$message|$tempprefix$prefix$filename|$autaken|$filesize|$width|$height|";
}


function Upload_SlimImageCrop ($uploadname,$eichanged,$fpath,$filename,$aft,$fmaxsize,$aureqd,$tempprefix,$prefix,$filesuffix,$reqdwidth,$reqdheight)  {
// uploadname = Input Field Name
// eichanged = Existing Image Changed
// fpath = Output File Path
// filename = If File Name is to be forced
// aft = Allowed File Types
// fmaxsize = Max File Size Allowed
// aureqd = Add/Update Controls
// tempprefix = Temp Output File Prefix
// prefix = Output File Prefix
// filesuffix = Output File Suffix
// reqdwidth = Output Reqd Width
// reqdheight = Output Reqd Height

// returns string - Error(1/0)|Message|filename|filesize|width|height
// XH5("Upload_SlimImageCrop - called - $uploadname|$eichanged|$fpath|$filename|$aft|$fmaxsize|$aureqd|$tempprefix|$prefix|$filesuffix|$reqdwidth|$reqdheight");

$errorcode = "0"; $message = ""; $autaken = ""; $filesize=""; $width=""; $height="";

try { $images = Slim::getImages();
}
catch (Exception $e) {
	XH2('ERROR.Unknown Error'); return "1|Unknown Error||||";
}

if ($images === false) {
	XH2('ERROR.No data posted'); return "1|No data posted||||";
}

// Should always be one image (when posting async), so we'll use the first on in the array (if available)
$image = array_shift($images);

if (!isset($image)) {
	return "1|No image uploaded (try decreasing image size to less than 1M)||||";
}


// ====== firtly get the parameters returned by slim (actual image file is returned outside of slim) 
$inimagename = $image['input']['name'];
if ( strlen(strstr($inname,$tempprefix.$prefix))>0 ) {
	// dont add double prefix
	$inimagename = str_replace($tempprefix.$prefix,"",$inname);
}
$inimagesize = $image['input']['size'];
$inimagewidth = $image['input']['width'];
$inimageheight = $image['input']['height'];
$actionrotation = $image['actions']['rotation'];
$actioncropx = $image['actions']['crop']['x'];
$actioncropy = $image['actions']['crop']['y'];
$actioncropwidth = $image['actions']['crop']['width'];
$actioncropheight = $image['actions']['crop']['height'];
$actioncroptype = $image['actions']['crop']['type'];
$actionsize = $image['actions']['size'];

/*
XH2('Slim Parameters.');
XTXT("inimagename - ".$inimagename);
XBR();XTXT("inimagesize - ".$inimagesize);
XBR();XTXT("inimagewidth - ".$inimagewidth);
XBR();XTXT("inimageheight - ".$inimageheight);
XBR();XTXT("actionrotation - ".$actionrotation);
XBR();XTXT("actioncropx - ".$actioncropx);
XBR();XTXT("actioncropy - ".$actioncropy);
XBR();XTXT("actioncropwidth - ".$actioncropwidth);
XBR();XTXT("actioncropheight - ".$actioncropheight);
XBR();XTXT("actioncroptype - ".$actioncroptype);
XBR();XTXT("actionsize - ".$actionsize);
*/

// ====== now get the actual input image as a file upload outside of slim 
if ($eichanged == "1") {
	if ($filename == "") { $filename = $_FILES[$uploadname]["name"]; }
	$filesize = $_FILES[$uploadname]["size"];
	$mbits = explode(".", $filename);
	$filetype = end($mbits);
	$filefirstname = str_replace(".".$filetype, "", $filename);
	// remove all blanks and commas in image firstname
	$filefirstname = str_replace(" " , "", $filefirstname);
	$filefirstname = str_replace("," , "", $filefirstname);	
	$outname = $tempprefix.$prefix.$filefirstname.$filesuffix.".".$filetype;
	$GLOBALS{'IOWARNING'} = "0";
	if ($filesize <= $fmaxsize) {
		if ((strlen(strstr($aft,$filetype))>0)||($aft == "all")) {
			if ($_FILES[$uploadname]["error"] > 0) {
				$errorcode = "1";
				$message = "Return Code:".$_FILES[$uploadname]["error"];
			} else {
				list($width, $height) = getimagesize($_FILES[$uploadname]["tmp_name"]);
				if (file_exists($fpath."/".$filename)) {
					$GLOBALS{'IOWARNING'} = "1";
				}
				$extramessage = "";
				if (($reqdwidth != "flex" )&&($width > $reqdwidth)) {
					$extramessage = ". Image width reduced to ".$reqdwidth." px";
				}
				if ($GLOBALS{'IOWARNING'} == "1") {
					if ($aureqd == "") {
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$outname);
						CropAndResizeImage( $fpath."/".$outname, $actioncropx, $actioncropy, $actioncropwidth, $actioncropheight, $reqdwidth, $reqdheight);
						chmod($fpath."/".$outname, 0644);
						$message = "Successfully updated file - ".$reqdwidth." ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "updated";
					}
					if ($aureqd == "update") {
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$outname);
						CropAndResizeImage( $fpath."/".$outname, $actioncropx, $actioncropy, $actioncropwidth, $actioncropheight, $reqdwidth, $reqdheight);
						chmod($fpath."/".$outname, 0644);
						$message = "Successfully updated file - ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "updated";
					}
					if ($aureqd == "add") {
						$errorcode = "1";
						$message = "ERROR: File already exists - ".$_FILES[$uploadname]["name"];
					}
				}
				if ($GLOBALS{'IOWARNING'} == "0") {
					if ($aureqd == "") {
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$outname);
						CropAndResizeImage( $fpath."/".$outname, $actioncropx, $actioncropy, $actioncropwidth, $actioncropheight, $reqdwidth, $reqdheight);
						chmod($fpath."/".$outname, 0644);
						$message = "Successfully added file - ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "added";
					}
					if ($aureqd == "update") {
						$errorcode = "1";
						$message = "ERROR: File does not already exist - ".$_FILES[$uploadname]["name"];
					}
					if ($aureqd == "add") {
						# print "from - ".$_FILES[$uploadname]["tmp_name"]." to ".$fpath."/".$prefix.$filename."<br>/n";
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$outname);
						CropAndResizeImage( $fpath."/".$outname, $actioncropx, $actioncropy, $actioncropwidth, $actioncropheight, $reqdwidth, $reqdheight);
						chmod($fpath."/".$outname, 0644);
						$message = "Successfully added file - ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "added";
					}
				}
			}
		} else {
			$errorcode = "1";
			$message = "Invalid file type - ".$filetype."- should be ".$aft;
		}
	} else {
		$errorcode = "1";
		$message = "File too large - greater than ".$fmaxsize."KB";
	}
} else {
	$existingimagename = $_REQUEST["ExistingImageName"];
	if ($existingimagename == "") {
		$errorcode = "1";
		$message = "No changes made";
	} else {
		CropAndResizeImage( $fpath."/".$existingimagename, $actioncropx, $actioncropy, $actioncropwidth, $actioncropheight, $reqdwidth, $reqdheight);
		$outname = $existingimagename;
		$message = "Successfully updated existing image - ".$existingimagename;
		$autaken = "updated";	
	}
}


// Return string - Error(1/0)|Message|outfilename|added/updated|filesize|width|height
return "$errorcode|$message|$outname|$autaken|$filesize|$width|$height|";
}


function Upload_SlimFile ($uploadname,$fpath,$filename,$aft,$fmaxsize,$aureqd,$tempprefix,$prefix,$maxwidth,$filesuffix)  {
	# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix - returns string - Error(1/0)|Message|filename|filesize|width|height
	// XH5("Upload_File - called - $uploadname|$fpath|$filename|$aft|$fmaxsize|$aureqd|$tempprefix|$prefix|$maxwidth|$filesuffix");

	ini_set('upload-max-filesize', '64M');

	// based on slim async example  - uploadname defaulted to slim
try { $images = Slim::getImages();
}
catch (Exception $e) {
	return "1|Unknown Error||||";
}

if ($images === false) {
	return "1|No data posted||||";
}

// Should always be one image (when posting async), so we'll use the first on in the array (if available)
$image = array_shift($images);

if (!isset($image)) {
	return "1|No image uploaded (try decreasing image size to less than 1M)||||";
}
if (!isset($image['output']['data'])) {
	return "1|No image data||||";
}

$inname = $image['input']['name'];
if ( strlen(strstr($inname,$tempprefix.$prefix))>0 ) {
	// dont add double prefix
	$inname = str_replace($tempprefix.$prefix,"",$inname);
}

$insize = $image['input']['size'];
$inwidth = $image['input']['width'];
$inheight = $image['input']['height'];
$outwidth = $image['output']['width'];
$outheight = $image['output']['height'];
// note: If you want to save the input data, replace the 'output' string below with 'input'
$outdata = $image['output']['data'];

// If you want to prevent Slim from adding a unique id to the file name add false as the fourth parameter.
// $file = Slim::saveFile($data, $name, 'tmp/', false);
$file = Slim::saveFile($outdata, $inname, $GLOBALS{'domainwwwpath'}."/domain_temp/", false);

$errorcode = "0"; $message = ""; $autaken = "";

$mbits = explode(".", $inname);
$intype = end($mbits);
$infirstname = str_replace(".".$intype, "", $inname);
// remove all blanks and commas in image firstname
$infirstname = str_replace(" " , "", $infirstname);
$infirstname = str_replace("," , "", $infirstname);
$outname = $tempprefix.$prefix.$infirstname.$filesuffix.".".$intype;
$GLOBALS{'IOWARNING'} = "0";
if ($insize <= $fmaxsize) {
	if ((strlen(strstr($aft,$intype))>0)||($aft == "all")) {
		list($width, $height) = getimagesize($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname);
		if (file_exists($fpath."/".$outname)) {
			$GLOBALS{'IOWARNING'} = "1";
		}
		$extramessage = "";
		if (($maxwidth != "" )&&($inwidth > $maxwidth)) {
			$extramessage = ". Image width reduced to ".$maxwidth." px";
		}
		if ($GLOBALS{'IOWARNING'} == "1") {
			if ($aureqd == "") {
				if (copy($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname,$fpath."/".$outname)) {
					unlink($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname);
				}
				ConstrainImageWidth($fpath."/".$outname,$maxwidth);
				chmod($fpath."/".$outname, 0644);
				$message = "Successfully updated file - ".$fpath."/".$outname.$extramessage;
				$autaken = "updated";
			}
			if ($aureqd == "update") {
				if (copy($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname,$fpath."/".$outname)) {
					unlink($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname);
				}
				ConstrainImageWidth($fpath."/".$outname,$maxwidth);
				chmod($fpath."/".$outname, 0644);
				$message = "Successfully updated file - ".$outname.$extramessage;
				$autaken = "updated";
			}
			if ($aureqd == "add") {
				$errorcode = "1";
				$message = "ERROR: File already exists - ".$outname;
			}
		}
		if ($GLOBALS{'IOWARNING'} == "0") {
			if ($aureqd == "") {
				if (copy($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname,$fpath."/".$outname)) {
					unlink($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname);
				}
				ConstrainImageWidth($fpath."/".$outname,$maxwidth);
				chmod($fpath."/".$outname, 0644);
				$message = "Successfully added file - ".$fpath."/".$outname.$extramessage;
				$autaken = "added";
			}
			if ($aureqd == "update") {
				$errorcode = "1";
				$message = "ERROR: File does not already exist - ".$outname;
			}
			if ($aureqd == "add") {
				# print "from - ".$_FILES[$uploadname]["tmp_name"]." to ".$fpath."/".$prefix.$inname."<br>/n";
				if (copy($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname,$fpath."/".$outname)) {
				unlink($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname);
			}
			ConstrainImageWidth($fpath."/".$outname,$maxwidth);
			chmod($fpath."/".$outname, 0644);
			$message = "Successfully added file - ".$outname.$extramessage;
			$autaken = "added";
			}
		}
	} else {
		$errorcode = "1";
		$message = "Invalid file type - ".$intype."- should be ".$aft;
	}
} else {
	$errorcode = "1";
	$message = "File too large - greater than ".$fmaxsize."KB";
}

# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
# Note that filename returned is without the tempprefix
# print $fpath."  -  ".$message;
return $errorcode."|".$message."|".$outname."|".$autaken."|".$insize."|".$width."|".$height."|";
}

function FileIsImage( $filetype) {
	$imagelist = "JPG,JPEG,jpg,jpeg,GIF,gif,PNG,png";
	return FoundInCommaList($filetype,$imagelist);
}

function ConstrainImageWidth( $imagefullname, $maxwidth) {	
	if ($maxwidth != "") {
		list($width, $height) = getimagesize($imagefullname);	
		if ($width > $maxwidth) {
			$aspectratio = $width/$height;
			$outwidth = $maxwidth;
			$outheight = $maxwidth/$aspectratio;
			
			$canvas = imagecreatetruecolor($outwidth, $outheight);
			$bits = explode(".",$imagefullname);
			$imagetype = end($bits);
			if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
			if ($imagetype == "jpeg") {$current_image = imagecreatefromjpeg($imagefullname);}
			if ($imagetype == "gif") {$current_image = imagecreatefromgif($imagefullname);}
			if ($imagetype == "png") {$current_image = imagecreatefrompng($imagefullname);}
			if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}
			if ($imagetype == "JPEG") {$current_image = imagecreatefromjpeg($imagefullname);}
			if ($imagetype == "GIF") {$current_image = imagecreatefromgif($imagefullname);}
			if ($imagetype == "PNG") {$current_image = imagecreatefrompng($imagefullname);}
		  
			imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, $outwidth, $outheight, $width, $height);   
	
			if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
			if ($imagetype == "jpeg") {imagejpeg($canvas, $imagefullname);}
			if ($imagetype == "gif") {imagegif($canvas, $imagefullname);}
			if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
			if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
			if ($imagetype == "JPEG") {imagejpeg($canvas, $imagefullname);}
			if ($imagetype == "GIF") {imagegif($canvas, $imagefullname);}
			if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
	
		}
	}		
}

function CropAndResizeImage( $imagefullname, $incropleft, $incroptop, $incropwidth, $incropheight, $reqdimagewidth, $reqdimageheight) {
	// XH4($imagefullname."|".$incropleft."|".$incroptop."|".$incropwidth."|".$incropheight."|".$reqdimagewidth."|".$reqdimageheight);
	$error = "0";
	$message = "";	
	if (file_exists($imagefullname)) { 
		// Get dimensions of the original image
		# list($current_width, $current_height) = getimagesize($imagefullname);
		// Resample the image
		# Set the new canvas size and cropping according to the required image size 	
		if (($reqdimageheight == "flex")&&($reqdimagewidth == "flex"))  { 	
		   $outcropheight = $incropheight;
		   $outcropwidth = $incropwidth;
		}
		if (($reqdimageheight != "flex")&&($reqdimagewidth == "flex"))  { 	
		   $outcropheight = $reqdimageheight;
		   $outcropwidth = round(($incropwidth*$reqdimageheight/$incropheight),0);
		}  
		if (($reqdimageheight == "flex")&&($reqdimagewidth != "flex"))  {
		   $outcropwidth = $reqdimagewidth;   	 	
		   $outcropheight = round(($incropheight*$reqdimagewidth/$incropwidth),0);
		} 
		if (($reqdimageheight != "flex")&&($reqdimagewidth != "flex"))  {
			$outcropheight = $reqdimageheight;
			$outcropwidth = $reqdimagewidth;
		}
		
		
		$canvas = imagecreatetruecolor($outcropwidth, $outcropheight);
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
		
		/*
		$image_p = imagecreatetruecolor(480, 270);
		imageAlphaBlending($image_p, false);
		imageSaveAlpha($image_p, true);
		$image = imagecreatefrompng('image_with_some_transaprency.png');
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, 480, 270, 1920, 1080);
		imagepng($image_p, 'resized.png', 0);
		*/
	
		if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "jpeg") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "gif") {$current_image = imagecreatefromgif($imagefullname);}
		if ($imagetype == "png") {			
			imageAlphaBlending($canvas, false);
			imageSaveAlpha($canvas, true);
			$current_image = imagecreatefrompng($imagefullname);	
		}
		if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "JPEG") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "GIF") {$current_image = imagecreatefromgif($imagefullname);}
		if ($imagetype == "PNG") {
			imageAlphaBlending($canvas, false);
			imageSaveAlpha($canvas, true);
			$current_image = imagecreatefrompng($imagefullname);		
		}
	  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, $incropleft, $incroptop, $outcropwidth, $outcropheight, $incropwidth, $incropheight);   
	
		if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "jpeg") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "gif") {imagegif($canvas, $imagefullname);}
		if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
		if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "JPEG") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "GIF") {imagegif($canvas, $imagefullname);}
		if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
	} else {
		$error = "1";
		$message = "$imagefullname not found";	
	}
}


function IODBCONNECT ($db, $host, $user, $password) {
// XBR();XTXT("IODBCONNECT Called - $db|$host|$user|$password");XBR();
$mysqli   = mysqli_connect($host, $user, $password, $db);
if (mysqli_connect_errno($mysqli)) {
    echo '<p class="error">Apologies - The database is not available at this time - please try again later.</p>';
}
// print "IODBCONNECT completed<br>\n";	
$GLOBALS{'IOSQL'} = $mysqli;
}

function IODBDISCONNECT () {
# XBR();XTXT("IODBDISCONNECT Called");XBR();	
mysqli_close($GLOBALS{'IOSQL'});
}

function IOSETUP () {
# print "IOSETUP Called<br>\n";	 
$tfields = array();
$tablearray = array();
$q = 'SHOW TABLES';
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
if (mysqli_num_rows($r) > 0) { 
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
  array_push($tablearray, $row[0]); 
  // XPTXT($row[0]);
 }
}
$tablestring = "|";
foreach ($tablearray as $tablearrayelement) {
	$tstring = $tablestring.$tablearrayelement."|";
	$colarray = array();
	$keycount = 0;	
	$q = 'SHOW COLUMNS FROM '.$tablearrayelement;
	 
	$r = mysqli_query($GLOBALS{'IOSQL'},$q);
	if (mysqli_num_rows($r) > 0) { 
	  while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
	   array_push($colarray, $row[0]);
	   if ($row[3] == "PRI") {$keycount++;}	
	  }
	} 
	$tstring = ""; $sep = "";
	foreach ($colarray as $colarrayelement) { $tstring = $tstring.$sep.$colarrayelement; $sep = "|"; } 
	array_push($tfields, $tablearrayelement); 
	$GLOBALS{$tablearrayelement."^FIELDS"}=$tstring; 
	$GLOBALS{$tablearrayelement."^KEYS"}=$keycount;
	// XBR();XTXT($tablearrayelement);XBR(); 
}

$GLOBALS{"TABLES"}=$tablestring;
}

function IOSQLCMD ($query) {
$GLOBALS{'IOERRORcode'} = "IOSQL"; $GLOBALS{'IOERRORmessage'} = "$query";
$r = mysqli_query($GLOBALS{'IOSQL'},$query);
}
# --------------------------------------------------------------

function  Get_Array () {
# datatype keys - returns array
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used
// print "Get_Array - $parmsmax - $parms[0] | $parms[1] | $parms[2] | $tablename <br>\n"; 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1 = "SELECT * FROM ".$tablename; 
if ($rootkey != "") {$qk1 = $qk1." WHERE ".$tfields[0]."='".$rootkey."'"; $kindex = $parmsmax+1;} 
else {$kindex = $parmsmax;}
$qk2 = ""; $qk3 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
$q = $qk1.$qk2.$qk3;
// XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO001"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
$tarray = array();
if (mysqli_num_rows($r) > 0) { 
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { array_push($tarray, $row[$kindex]); }
}
// print "Get_Array returns"; print_r($tarray); print "<BR>\n";
return $tarray;
}


function  Get_NKey_Array () {
# datatype keys - returns array with keys separated by |	VERY BASIC - NEEDS REWRITING ONLY WORKS FOR DOMAIN RELATED TABLES
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used
// print "Get_Array - $parmsmax - $parms[0] | $parms[1] | $parms[2] | $tablename <br>\n"; 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$keys =  intval($GLOBALS{$tablename."^KEYS"});
$qk1 = "SELECT * FROM ".$tablename; 
if ($rootkey != "") {$qk1 = $qk1." WHERE ".$tfields[0]."='".$rootkey."'"; $kindex = $parmsmax+1;} 
else {$kindex = $parmsmax;}
$qk2 = ""; $qk3 = ""; 
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
$q = $qk1.$qk2.$qk3;
# XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO001"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
$tarray = array();
if (mysqli_num_rows($r) > 0) { 
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
 	$kstring = ""; $ksep = "";
 	for( $ik = 0; $ik<$keys-1; $ik++ ) { 
 		$kstring = $kstring.$ksep.$row[$kindex+$ik];
 		$ksep = "|";
 	}
 	array_push($tarray, $kstring);
 }
}
// print "Get_Array returns<br>\n"; 
// for( $i = 0; $i<20; $i++ ) { print $tarray[$i]."<BR>\n"; }
// print_r($tarray); print "<BR>\n";
return $tarray;
}

function  Get_2Key_Array () {
# datatype keys - returns array with keys separated by |	VERY BASIC - NEEDS REWRITING
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used
// print "Get_Array - $parmsmax - $parms[0] | $parms[1] | $parms[2] | $tablename <br>\n"; 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1 = "SELECT * FROM ".$tablename; 
if ($rootkey != "") {$qk1 = $qk1." WHERE ".$tfields[0]."='".$rootkey."'"; $kindex = $parmsmax+1;} 
else {$kindex = $parmsmax;}
$qk2 = ""; $qk3 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
$q = $qk1.$qk2.$qk3;
# XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO001"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
$tarray = array();
if (mysqli_num_rows($r) > 0) { 
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { array_push($tarray, $row[$kindex]."|".$row[$kindex+1]); }
}
# print "Get_Array returns"; print_r($tarray); print "<BR>\n";
return $tarray;
}

function Get_Array_Mergedkey ($tablename, $mergedkeyA, $mergedkeyB) {
# datatype mergedkey0 mergedkey1 - returns array
# limited to merge 2 keys only = no rootkey logic or site logic
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$mergedkeyindexA = array_search($mergedkeyA, $tfields);
$mergedkeyindexB = array_search($mergedkeyB, $tfields);
$rootkey = $GLOBALS{'LOGIN_domain_id'};
$q = "SELECT * FROM ".$tablename." WHERE ".$tfields[0]."='".$rootkey."'";;
# XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO001"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
$tarray = array();
if (mysqli_num_rows($r) > 0) {
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
  array_push($tarray, $row[$mergedkeyindexA]."+".$row[$mergedkeyindexB]);
  # print $row[$mergedkeyindexA]."+".$row[$mergedkeyindexB];
 }
}
# print "Get_Array_Mergedkey returns"; print_r($tarray); print "<BR>\n";
return $tarray;
}

# datatype keys returns fields
function  Check_Data () {
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used 
// print "Check_Data - $parmsmax - $parms[0] | $parms[1] | $parms[2] | $parms[3] | $tablename <br>\n"; 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1= "SELECT * FROM ".$tablename." WHERE ".$tfields[0]."='".$rootkey."'"; 
$qk2 = ""; $qk3 = ""; $qk4 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
if ($parmsmax > 2) {$qk4 = " AND ".$tfields[3]."='".$parms[3]."'";}
$q = $qk1.$qk2.$qk3.$qk4;
// XBR();XTXT($q);XBR();
$GLOBALS{'IOWARNING'} = "0";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
if (mysqli_num_rows($r) > 0) { 
 $row = mysqli_fetch_array($r, MYSQL_ASSOC);
 foreach ($tfields as $tfieldelement) {
  $GLOBALS[$tfieldelement] = $row[$tfieldelement];	 
 }
}
else {SilentWarningRoutine();}
}

# datatype keys returns fields
function  Get_Data () {
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used 
# print "Get_Data - $parmsmax - $parms[0] | $parms[1] | $parms[2] | $parms[3] | $tablename <br>\n"; 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1= "SELECT * FROM ".$tablename." WHERE ".$tfields[0]."='".$rootkey."'"; # forces domainid to be used
$qk2 = ""; $qk3 = ""; $qk4 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
if ($parmsmax > 2) {$qk4 = " AND ".$tfields[3]."='".$parms[3]."'";}
$q = $qk1.$qk2.$qk3.$qk4;
// XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO004"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
if (mysqli_num_rows($r) > 0) { 
 $row = mysqli_fetch_array($r, MYSQL_ASSOC);
 foreach ($tfields as $tfieldelement) {
  $GLOBALS[$tfieldelement] = $row[$tfieldelement];
 }
}
else {ErrorRoutine();}
}

# datatype
function Write_Data () {
$parms = func_get_arg(0);
for($i=0;$i<func_num_args();$i++){
	$ts=func_get_arg($i);
	if ( $ts == "" ) {
	    $keystring = "";
	    for($j=0;$j<$i;$j++){
	        $keystring = $keystring." ".func_get_arg($j);
	    }
	    $keystring = $keystring." NULL";
	    XPTXTCOLOR("<b>ERROR: Null Write Key - (".$keystring." )</b>","red"); 
	    return;	
	}
}
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used 
// print "Write_Data - |$parms[0]|$parms[1]|$parms[2]|<br>\n";	
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$GLOBALS{$tfields[0]} = $rootkey; # forces domainid to be used
if (($GLOBALS{$tablename."^KEYS"} > 1)&&($parms[1] != "")) {$GLOBALS{$tfields[1]} = $parms[1];}
if (($GLOBALS{$tablename."^KEYS"} > 2)&&($parms[2] != "")) {$GLOBALS{$tfields[2]} = $parms[2];}
if (($GLOBALS{$tablename."^KEYS"} > 3)&&($parms[3] != "")) {$GLOBALS{$tfields[3]} = $parms[3];}
$setstring = ""; $sep = "";
foreach ($tfields as $tfieldelement) {
 $tfieldvalue = '"'.mysqli_real_escape_string($GLOBALS{'IOSQL'},$GLOBALS{$tfieldelement}).'"'; # escapes special characters	
 $setstring = $setstring.$sep.$tfieldelement."=".$tfieldvalue;  $sep = ",";
}
# older mySQL level dosent support ON DUPLICATE UPDATE
if ($GLOBALS{'site_server'} == "DSQL") { $q = "INSERT INTO ".$tablename." SET ".$setstring;} 
else { $q = "INSERT INTO ".$tablename." SET ".$setstring." ON DUPLICATE KEY UPDATE ".$setstring; }
// XBR();XTXT($q);XBR();
$GLOBALS{'IOWARNING'} = "0";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
# $tnum = mysqli_affected_rows($GLOBALS{'IOSQL'}); print "affected rows - $tnum<br>\n";
$noupdate = "1";
# XBR();XTXT("Rows ".mysqli_affected_rows($GLOBALS{'IOSQL'}));XBR();
if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 0) {$noupdate = "0";} 
if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 1) {$noupdate = "0";}
if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 2) {$noupdate = "0";}
if ($noupdate == "1") {SilentWarningRoutine();}
if ($GLOBALS{'IOWARNING'} == "1") {
 $qk1= "UPDATE ".$tablename." SET ".$setstring." WHERE ".$tfields[0]."='".$rootkey."'"; # forces domainid to be used
 $qk2 = ""; $qk3 = ""; $qk4 = "";
 if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
 if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
 if ($parmsmax > 2) {$qk4 = " AND ".$tfields[3]."='".$parms[3]."'";}
 $q = $qk1.$qk2.$qk3.$qk4;	
// XBR();XTXT($q);XBR();
 $GLOBALS{'IOERRORcode'} = "IO006"; $GLOBALS{'IOERRORmessage'} = "$q";
 $r = mysqli_query($GLOBALS{'IOSQL'},$q);
 # $tnum = mysqli_affected_rows($GLOBALS{'IOSQL'}); print "affected rows - $tnum<br>\n";
 $noupdate = "1";
 if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 1) {$noupdate = "0";}
 if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 2) {$noupdate = "0";}
# if ($noupdate == "1") {ErrorRoutine();}
}
}

# datatype keys
function Delete_Data () {
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1 = "DELETE FROM ".$tablename." WHERE ".$tfields[0]."='".$rootkey."'";
$qk2 = ""; $qk3 = ""; $qk4 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
if ($parmsmax > 2) {$qk4 = " AND ".$tfields[3]."='".$parms[3]."'";}
$q = $qk1.$qk2.$qk3.$qk4;
# XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO008"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
# $tnum = mysqli_affected_rows($GLOBALS{'IOSQL'}); print "affected rows - $tnum<br>\n";
if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 1) { } else { SilentWarningRoutine(); }
}

function  DeleteAll_Data  () {
# datatype keys	
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used
# print "DeleteAll_Data - $parmsmax - $parms[0] | $parms[1] | $parms[2] | $tablename <br>\n"; 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1 = "DELETE FROM ".$tablename; 
if ($rootkey != "") {$qk1 = $qk1." WHERE ".$tfields[0]."='".$rootkey."'"; $kindex = $parmsmax+1;} 
else {$kindex = $parmsmax;}
$qk2 = ""; $qk3 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
$q = $qk1.$qk2.$qk3;
# XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO009a"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
# $tnum = mysqli_affected_rows($GLOBALS{'IOSQL'}); print "affected rows - $tnum<br>\n";
if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 1) { } else { SilentWarningRoutine(); }
# print "DeleteAll_Data - finish<BR>\n";
}

# datatype
function Truncate_Table ($table) {
    $q = "TRUNCATE TABLE ".$table.";";
    # XBR();XTXT($q);XBR();
    $GLOBALS{'IOERRORcode'} = "IO098"; $GLOBALS{'IOERRORmessage'} = "$q";
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_affected_rows($GLOBALS{'IOSQL'}) > 1) { } else { SilentWarningRoutine(); }
    if ($r) { } else { SilentWarningRoutine(); }
}

# datatype
function Initialise_Data ($parm0) {
$tstring = $GLOBALS{$parm0."^FIELDS"}; $tfields = explode('|', $tstring);
foreach ($tfields as $tfieldelement) {
 $GLOBALS{$tfieldelement} = "";	 
}
}

function  Create_Hash  () {
# datatype keys - creates Hash
$trootmax = ""; $hfullk = ""; $hrootk = ""; $tablename = "";  # localise
$htablename = ""; $chk = array(); $ghk = array(); # localise
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; $htablename = $kbits[0];}
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0]; $htablename = $tablename;}	# forces domainid to be used
$selectflag = "0"; if (strlen(strstr($tablename,"SELECT"))>0) { $tablename = str_replace("SELECT", "", $tablename); $selectflag = "1"; }
// print "Create_Hash - |$parms[0]|$parms[1]|$parms[2]| $tablename - $htablename<br>\n";			 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1 = "SELECT * FROM ".$tablename; 
if ($rootkey != "") {$qk1 = $qk1." WHERE ".$tfields[0]."='".$rootkey."'"; $kindex = $parmsmax+1;} 
else {$kindex = $parmsmax;}
$qk2 = ""; $qk3 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
$q = $qk1.$qk2.$qk3;
// XBR();XTXT($q);XBR();
$hrootk1 = $htablename."^";$hrootk2 = ""; $hrootk3 = ""; 
if ($parmsmax > 0) {$hrootk2 = $parms[1]."^";}
if ($parmsmax > 1) {$hrootk3 = $parms[2]."^";}
$hrootk = $hrootk1.$hrootk2.$hrootk3;
$tistring = ""; $isep = "";
$GLOBALS{'IOERRORcode'} = "IO010"; $GLOBALS{'IOERRORmessage'} = "$q"; 
$row = array();
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
if (mysqli_num_rows($r) > 0) { 
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { 
  $thashstring="";   
  foreach ($row as $element) { $thashstring = $thashstring.$element."|"; }
  $GLOBALS{$hrootk.$row[$kindex]."^"} = $thashstring;
#  XBR();XTXT($hrootk.$row[$kindex]."^"."-".$GLOBALS{$hrootk.$row[$hrowk]."^"});XBR();
  $tistring = $tistring.$isep.$row[$kindex]; $isep = "|";
 }
}
$GLOBALS{$hrootk."INDEX"} = $tistring;
// XBR();XTXT("Create_Hash INDEX created - ".$hrootk."- $tistring");XBR();
}

function Get_Array_Hash () {
# datatype/rootkey - creates array	
$trootmax = ""; $hfullk = ""; $hrootk = ""; $tablename = "";  # localise
$htablename = ""; $chk = array(); $ghk = array(); # localise
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
$trootmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $tablename = $kbits[0];  $htablename = $tablename;}
else {$tablename = $parms[0]; $htablename = $tablename;}	# forces domainid to be used
$selectflag = "0"; if (strlen(strstr($tablename,"SELECT"))>0) { $tablename = str_replace("SELECT", "", $tablename); $selectflag = "1"; }
$hrootk = $htablename."^"; for ($hi = 1; $hi < $trootmax+1; $hi++) {$hrootk = $hrootk.$parms[$hi]."^";}  
$chk = array(); for ($hi = 0; $hi < 3; $hi++) {if ($hi < $trootmax+1) {array_push ($chk,$parms[$hi]);} } 
# print "Get_Array_Hash - $trootmax - $parms[0] | $parms[1] | $parms[2] | $tablename - $htablename - $hrootk<br>\n";
if (array_key_exists($hrootk."INDEX", $GLOBALS)) {} else {Create_Hash($chk);}
$tkeyarray = array();
$tstring = $GLOBALS{$hrootk."INDEX"}; 
if ($tstring != "") {$tkeyarray = explode('|', $tstring);}
# $str=$hrootk."INDEX"; print "Get_Array_Hash result - $str - $tkeyarray - $chk<br>\n"; 
return $tkeyarray;
}


function Get_Array_Hash_SortSelect () {
# datatype/rootkey sortfieldname selectfieldname selectfieldvalue - creates sorted array	
$trootmax = ""; $hfullk = ""; $hrootk = ""; $tablename = "";  # localise
$htablename = ""; $chk = array(); $ghk = array(); # localise
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
$trootmax = sizeof($parms)-4;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $tablename = $kbits[0]; $htablename = $tablename;}
else {$tablename = $parms[0]; $htablename = $tablename;}	# forces domainid to be used
# print "Get_Array_Hash_SortSelect - $trootmax - $parms[0] | $parms[1] | $parms[2] | $parms[3] | $parms[4] | $parms[5] | $tablename - $htablename<br>\n";
$tsortfieldname = $parms[$trootmax+1];
$tselectfieldname = $parms[$trootmax+2];
$tselectfieldvalue = $parms[$trootmax+3];
// print "Get_SelectArrays_Hash - $tsortfieldname - $tselectfieldname - $tselectfieldvalue<br>\n";
$ghk = array(); for ($hi = 0; $hi < 4; $hi++) {if ($hi < $trootmax+1) {array_push ($ghk,$parms[$hi]);} } 
$t1sortarray = array(); $tarrayelement=""; $tsortstring="";
foreach (Get_Array_Hash($ghk) as $tarrayelement) {	
 # print "Get_Array_Hash_SortSelect - $tarrayelement - $tarrayelement<BR>\n"; 
 $ghk[$trootmax+1] = $tarrayelement;
 Get_Data_Hash($ghk);
 if (($tselectfieldname == "")||($GLOBALS{$tselectfieldname} == $tselectfieldvalue)) {
  $tsortstring = $GLOBALS{$tsortfieldname}." |".$tarrayelement; 
  array_push($t1sortarray, $tsortstring);
 }
}
sort($t1sortarray); $t3sortarray = array();
foreach ($t1sortarray as $tsortstring) {
 $sbits = explode('|', $tsortstring);
 array_push($t3sortarray, $sbits[1]);
}
# print "Get_Array_Hash_SortSelect returns - $t3sortarray <BR>\n";
return $t3sortarray;
}

function Get_Data_Hash () {
# datatype/fullkey SELECT - returns fields
$trootmax = ""; $hfullk = ""; $hrootk = ""; $tablename = ""; # localise
$htablename = ""; $chk = array(); $ghk = array(); # localise
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
$trootmax = sizeof($parms)-2;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $tablename = $kbits[0]; $htablename = $kbits[0];}
else {$tablename = $parms[0]; $htablename = $tablename;}	# forces domainid to be used 
$selectflag = "0"; if (strlen(strstr($tablename,"SELECT"))>0) { $tablename = str_replace("SELECT", "", $tablename); $selectflag = "1"; } 
$hfullk = $htablename."^"; for ($hi = 1; $hi < $trootmax+2; $hi++) {$hfullk = $hfullk.$parms[$hi]."^";}  
$hrootk = $htablename."^"; for ($hi = 1; $hi < $trootmax+1; $hi++) {$hrootk = $hrootk.$parms[$hi]."^";}  
$chk = array(); for ($hi = 0; $hi < 3; $hi++) {if ($hi < $trootmax+1) {array_push ($chk,$parms[$hi]);} } 
# print "Get_Data_Hash 1 - $trootmax - $parms[0] | $parms[1] | $parms[2] | $parms[3] | $tablename - $htablename - $hfullk - $hrootk<br>\n";
if (array_key_exists($hrootk."INDEX", $GLOBALS)) {}  else {Create_Hash($chk);}
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$GLOBALS{'IOWARNING'} = "0";
if (array_key_exists($hfullk,$GLOBALS)) {} else {$GLOBALS{'IOWARNING'} = "1"; return;}
$tobesplit = $GLOBALS{$hfullk};
$hbits = explode('|',$tobesplit);
$fi = 0;
foreach ($tfields as $tfield) {
# print "Get_Data_Hash - $tfield - $hbits[$fi]<br>\n";
 if ($selectflag == "1") {$tstring = "SELECT".$tfield; $GLOBALS{$tstring} = $hbits[$fi];} else {$GLOBALS{$tfield} = $hbits[$fi];}
 $fi++;  	
}
}

function Get_Data_Hash_DateEffective () {
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;	
if (sizeof($parms) == 3) {
 $tdatatype = $parms[0]; 
 $tkey = $parms[1]; 
 $tdate = $parms[2];	
 $tdataa = Get_Array_Hash($tdatatype, $tkey); 
 $dateeffectivekeyfound = "";
 foreach ($tdataa as $tdatak) {
  if ($tdatak <= $tdate) {
   $dateeffectivekeyfound = $tdatak;
  }
 }
 Get_Data_Hash ($tdatatype, $tkey, $dateeffectivekeyfound);
 # print "$tdatatype, $tkey, $tdate, $dateeffectivekeyfound<br>\n";
} else {
 $tdatatype = $parms[0];
 $tdate = $parms[1];	
 $tdataa = Get_Array_Hash($tdatatype); 
 $dateeffectivekeyfound = "";
 foreach ($tdataa as $tdatak) {
  if ($tdatak <= $tdate) {
   $dateeffectivekeyfound = $tdatak;
  }
 }
 Get_Data_Hash ($tdatatype, $dateeffectivekeyfound);
 # print "$tdatatype, $tdate, $dateeffectivekeyfound<br>\n";

}
}

function Get_SelectArrays_Hash () { # CHECK Different than perl
# datatype/rootkey keyfieldname textfieldname sortfieldname selectfieldname selectfieldcondition
$trootmax = ""; $hfullk = ""; $hrootk = ""; $tablename = ""; # localise
$htablename = ""; $chk = array(); $ghk = array(); # localise
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
$trootmax = sizeof($parms)-6;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $tablename = $kbits[0]; $htablename = $kbits[0];}
else {$tablename = $parms[0]; $htablename = $tablename;}	# forces domainid to be used 
$selectflag = "0"; if (strlen(strstr($tablename,"SELECT"))>0) {$selectflag = "1"; $tablename = str_replace("SELECT", "", $tablename);} 
// print "Get_SelectArrays_Hash - $trootmax - $parms[0] | $parms[1] | $parms[2] | $parms[3] | $parms[4] | $parms[5] | $tablename - $htablename<br>\n";
$tkeyfieldname = $parms[$trootmax+1];
$ttextfieldname = $parms[$trootmax+2];
$tsortfieldname = $parms[$trootmax+3];
$tselectfieldname = $parms[$trootmax+4];
$tselectfieldvalue = $parms[$trootmax+5];
// print "fields - $tkeyfieldname $ttextfieldname $tsortfieldname<BR>\n";
$ghk = array(); for ($hi = 0; $hi < 4; $hi++) {if ($hi < $trootmax+1) {array_push ($ghk,$parms[$hi]);} } 
$tselectkeyarray = array(); $tselecttextarray = array(); 
$t1sortarray = array(); $tarrayelement = ""; $tsortstring = "";
// $ghk[0] = "SELECT".$ghk[0]; # CHECK whole SELECT LOGIC
foreach (Get_Array_Hash($ghk) as $tarrayelement) {	
 $ghk[$trootmax+1] = $tarrayelement;
 Get_Data_Hash($ghk);
// print " tarrayelement - $tarrayelement <BR>\n";
// print "ghk - ";print_r ($ghk);print "<BR>\n";
// if (($tselectfieldname == "")||($GLOBALS{"SELECT".$tselectfieldname} == $tselectfieldvalue)) {
//  $tsortstring = $GLOBALS{"SELECT".$tsortfieldname}."|".$GLOBALS{"SELECT".$tkeyfieldname}."|".$GLOBALS{"SELECT".$ttextfieldname}; 
//  array_push($t1sortarray, $tsortstring);
// }
// print " tarrayelement - $tarrayelement <BR>\n";
// print "ghk - ";print_r ($ghk);print "<BR>\n";
 if (($tselectfieldname == "")||($GLOBALS{$tselectfieldname} == $tselectfieldvalue)) {
  $tsortstring = $GLOBALS{$tsortfieldname}."|".$GLOBALS{$tkeyfieldname}."|".$GLOBALS{$ttextfieldname}; 
  array_push($t1sortarray, $tsortstring);
 } 
}
// print "t1sortarray - ";print_r ($t1sortarray);print "<BR>\n";
sort($t1sortarray);
foreach ($t1sortarray as $tsortstring) {
 $sbits = explode('|', $tsortstring);
 array_push($tselectkeyarray, $sbits[1]);   
 array_push($tselecttextarray, $sbits[2]);
}
return Arrays2Hash ($tselectkeyarray, $tselecttextarray);
// print "SELECTARRAYS $tselecttextarray $tselectkeyarray <BR>\n";
}

function Download_Instructions_Creator () {
    $Q = '"';	
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"Download file produced for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}."\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"Upload Instructions\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"Check 1:- Always include column A and any columns containing $Q Table $Q or $Q Key $Q in the $Q datakeys $Q row.\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"Check 2:- Always include the $Q dataheader $Q row\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"Check 3:- Then select only columns and rows required to be updated.\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"Notes:-,Updates can be controlled by using the following variants of $Q data $Q in column A.\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},",- $Q data $Q (default) changes existing data - or adds it if the key does not exist (better to use data-add!!).\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},",- $Q data-change $Q only changes data if the key currently exists.\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},",- $Q data-add $Q only adds data if the key does not exist.\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},",- $Q data-delete $Q only deletes data if the key currently exists.\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"______________________________________________________________________\n");
}

# datatype
function Download_Data ($tablename) {
    // print "<h1>Download_Data - $tablename</h1>\n";
    Download_Header_Creator($tablename);
    $tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
    $q = "SELECT * FROM ".$tablename." WHERE ".$tfields[0]."='".$GLOBALS{'LOGIN_domain_id'}."'";
    # XBR();XTXT($q);XBR();
    $karray = array(); $ksarray = array(); $row = array();
    $GLOBALS{'IOERRORcode'} = "IO011"; $GLOBALS{'IOERRORmessage'} = "$q";
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_num_rows($r) > 0) { 
     while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
      $kstring = $row[0];
      if ($GLOBALS{$tablename."^KEYS"} > 1) { $kstring = $kstring."|".$row[1]; }
      if ($GLOBALS{$tablename."^KEYS"} > 2) { $kstring = $kstring."|".$row[2]; }
      if ($GLOBALS{$tablename."^KEYS"} > 3) { $kstring = $kstring."|".$row[3]; } 
      array_push ($karray, $kstring); 
     }
     sort($karray);
    }
    foreach ($karray as $karrayelement) {
     $kbits = explode('|', $karrayelement);
     $qk1 = "SELECT * FROM ".$tablename." WHERE ".$tfields[0]."='".$GLOBALS{'LOGIN_domain_id'}."'";
     $qk2 = ""; $qk3 = ""; $qk4 = "";
     if ($GLOBALS{$tablename."^KEYS"} > 1) {$qk2 = " AND ".$tfields[1]."='".$kbits[1]."'";}
     if ($GLOBALS{$tablename."^KEYS"} > 2) {$qk3 = " AND ".$tfields[2]."='".$kbits[2]."'";}
     if ($GLOBALS{$tablename."^KEYS"} > 3) {$qk4 = " AND ".$tfields[3]."='".$kbits[3]."'";} 
     $q = $qk1.$qk2.$qk3.$qk4; 
     // XBR();XTXT($q);XBR();
     $row = array(); $notfirst = "1";
     // $outmessage = "data".'","'.$tablename;
     $outputrowarray = Array();
     array_push($outputrowarray, "data", utf8_decode($tablename));
     
     $GLOBALS{'IOERRORcode'} = "IO012"; $GLOBALS{'IOERRORmessage'} = "$q";
     $r = mysqli_query($GLOBALS{'IOSQL'},$q);
     if (mysqli_num_rows($r) > 0) { 
      $row = mysqli_fetch_array($r, MYSQL_ASSOC);
      foreach ($tfields as $tfieldelement) {
       if ($notfirst != "1") { 
       		// $outmessage = $outmessage.'","'.$row[$tfieldelement];
       		array_push($outputrowarray, utf8_decode($row[$tfieldelement]));
       }
       $notfirst = "0"; 
      }
     }
     else {ErrorRoutine();} 
     // print $outmessage."\n";
     // Write_File ($GLOBALS{'IOFDOWNLOAD'},CSV_Out_Filter('"'.$outmessage.'"')."\n");
     fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));
    }
    Download_Footer_Creator($tablename);
}
    
function Download_Header_Creator ($tablename) {
    # dbname
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"\n");
    
    $outputrowarray = Array();
    array_push($outputrowarray, "datakeys","Table");
    
    for ( $idt = 3; $idt < $GLOBALS{$tablename."^KEYS"}+2; $idt++) {
     array_push($outputrowarray, "Key");
    }
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
    
    $outputrowarray = Array();
    array_push($outputrowarray, "dataheader", $tablename);
    
    $tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
    $notfirst = "1";
    foreach ($tfields as $tfieldelement) {	
     if ($notfirst != "1") {
      $replacedstring = $tablename."_";
      $tfieldelement = str_replace($replacedstring, "", $tfieldelement);	 
      array_push($outputrowarray, utf8_decode($tfieldelement));
     }
     $notfirst = "0";
    }
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
}

function Download_Footer_Creator ($tablename) {
    $outputrowarray = Array();
    array_push($outputrowarray, "dataend", utf8_decode($tablename));
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
}

function CSVClean ($csvrowarray) {
    $outcsvrowarray = Array();
    foreach ($csvrowarray as $csvrowelement) {         
        if (($csvrowelement[0] == "-")||($csvrowelement[0] == "+")) { // excel gets confused with leading plus or minus
            if (is_numeric($csvrowelement)) {}
            else { $csvrowelement = substr($csvrowelement, 1); } // remove first character
        }
        $csvrowelement = str_replace(chr(92).chr(114).chr(92).chr(110),chr(13),$csvrowelement);  // replaces \r\n text e.g from sqldump
        $csvrowelement = str_replace(chr(13).chr(10),chr(13),$csvrowelement);
        // $csvrowelement = str_replace(chr(13).chr(13),chr(13),$csvrowelement);
        $csvrowelement = str_replace("Â£","£",$csvrowelement);       
        
        array_push($outcsvrowarray,$csvrowelement);
    }
    return $outcsvrowarray;
}

function Backup_Domain () {
    $backupmax = 30; // 2 weeks worth
    Check_Folder ( $GLOBALS{'domainfilepath'}."/backup" );
    if ( $GLOBALS{'IOWARNING'} == "1" ) { mkdir($GLOBALS{'domainfilepath'}."/backup", 0777); }
    
    $existingbackupfiles = scandir($GLOBALS{'domainfilepath'}."/backup"); // includes . and ..
    array_shift($existingbackupfiles);
    array_shift($existingbackupfiles);
    while ( count($existingbackupfiles)  >= $backupmax ) {
        unlink($GLOBALS{'domainfilepath'}."/backup/".$existingbackupfiles[0]);
        // XPTXT($existingbackupfiles[0]." deleted");
        array_shift($existingbackupfiles);
    }
    
    $sqlbackupfilename = $GLOBALS{'domainfilepath'}."/backup/sqldatabackup_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".csv";
    $GLOBALS{'IOFDOWNLOAD'} = Open_File_Write ($sqlbackupfilename);
    Download_Instructions_Creator();
    $derror = "0";
    
    
    $tablearray = array();
    $q = 'SHOW TABLES';
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            array_push($tablearray, $row[0]);
        }
    }
    foreach ($tablearray as $tablearrayelement) {
        Download_Data($tablearrayelement);
    }
    
    Close_File_Write ($GLOBALS{'IOFDOWNLOAD'});
}

function Upload_Data ($fullfilename,$testorreal,$extendedtrace) {

// $records = Get_File_Array($fullfilename);		
// foreach ($records as $recordelement) {	
    
$uploadmode = "??";
if ($testorreal == "R") { $uploadmode = "REAL"; }
if ($testorreal == "T") { $uploadmode = "TEST"; }
    
$keyerror = "0";	
if (($handle = fopen($fullfilename, "r")) !== FALSE) {
	while (($uploadcsv = fgetcsv($handle, 0, ",")) !== FALSE) {	
		// $upmessage = CSV_In_Filter($recordelement);
		// print"<P>$upmessage|\n";
		# end of the tidy up
		// $uploadcsv = explode("|",$upmessage);
		# print"<P>array $uploadcsv| ".sizeof(uploadcsv)-1."\n"; 
		
		if ($uploadcsv[0] == "dataheader") {
			$keyerror = "0"; // are there enough keys
			XHR();			
			if (strlen(strstr($uploadcsv[1],'|'))>0) { // paired tables
			    $uploadtablea = explode("|",$uploadcsv[1]);
			    $uploadtable = $uploadtablea[0];
			    $uploadtablepair = $uploadtablea[1];
			} else {
			    $uploadtable = $uploadcsv[1];
			    $uploadtablepair = "";
			}
			XH2($uploadcsv[1]);			
			$uploadcsvheader = $uploadcsv;
			// check that the correct keys have been supplied - Header may either use "tablename_fieldname" or just "fieldname"
			$tstring = $GLOBALS{$uploadtable."^FIELDS"};
			$tfields = explode('|', $tstring);
			if ($GLOBALS{$uploadtable."^KEYS"} >= "2") {
				if (strlen(strstr($tfields[1],$uploadcsvheader[2]))>0) {} else { $keyerror = "1"; }
			}		
			if ($GLOBALS{$uploadtable."^KEYS"} >= "3") { 
				if (strlen(strstr($tfields[2],$uploadcsvheader[3]))>0) {} else { $keyerror = "1"; }
			}
			if ($GLOBALS{$uploadtable."^KEYS"} >= "4") { 
				if (strlen(strstr($tfields[3],$uploadcsvheader[4]))>0) {} else { $keyerror = "1"; }
			}
			if ( $keyerror == "0" ) {
				// XPTXTCOLOR("Correct keys supplied for table - ".$uploadcsv[1],"green");
			    XDIV("reportdiv_".$uploadtable,"container");
			    XTABLEJQDTID("reporttable_".$uploadtable);
				XTHEAD();
				XTRJQDT();
				if ( $extendedtrace == "Yes" ) {
    				XTDHTXT("");
    				for ($ui = 2; $ui < sizeof($uploadcsvheader); $ui++) {
    				    if ($uploadcsvheader[$ui] != "") {
    				        XTDHTXT($uploadcsvheader[$ui]);    
    				    } 
    				}
    				XTDHTXT("Action");				    				    
				} else {
				    XTDHTXT("Mode");
				    for ($ui = 0; $ui < $GLOBALS{$uploadtable."^KEYS"}-1; $ui++) {
				        XTDHTXT($uploadcsvheader[$ui]);
				    }
				    XTDHTXT("Action");					    
				}
				X_TR();
				X_THEAD();
				XTBODY();
			} else {
				XPTXTCOLOR("Incorrect keys supplied for table - ".$uploadcsv[1],"red");
			}	
		}  		

		if ($keyerror == "0") {
			if (($uploadcsv[0] == "data")||
			 	($uploadcsv[0] == "data-add")||
			 	($uploadcsv[0] == "data-change")||
			 	($uploadcsv[0] == "data-delete")) { 
			 	    
			 	$currdataa = Array();    
			 	$newdataa = Array();
			 	$errordataa = Array();
				$ghk = array();
				for ($hi = 1; $hi < $GLOBALS{$uploadtable."^KEYS"}+1; $hi++) { array_push ($ghk,$uploadcsv[$hi]); } 
				// XBR();print_r($ghk);
				$ghk[0] = $uploadtable; Initialise_Data($ghk[0]); Check_Data($ghk);
				$allfields = $GLOBALS{$uploadtable."^FIELDS"};
				if ($GLOBALS{'IOWARNING'} == "0") {$dataexists = "1";} else {$dataexists = "0";}
				if (($uploadtablepair != "" )&&($dataexists == "1")) { 
				    $ghk[0] = $uploadtablepair; Initialise_Data($ghk[0]); Check_Data($ghk);
				    $allfields = $allfields."|".$GLOBALS{$uploadtablepair."^FIELDS"};
				    if ($GLOBALS{'IOWARNING'} == "0") {$dataexists = "1";} else {$dataexists = "0";}
				}
				$fieldschanged = 0;
				
				// ======= Update the database =============
				for ($ui = 2; $ui < sizeof($uploadcsvheader); $ui++) {
				    $thisfieldval = utf8_encode($uploadcsv[$ui]);
				    if ($uploadcsvheader[$ui] != "") { // updates requested
				        if (strlen(strstr($uploadcsvheader[$ui],"_"))>0) {
				            # full field name
				            $thisfieldname = $uploadcsvheader[$ui];
				            $fbits = explode('_', $tstring);
				            $thistable = $fbits[0];				            
    					} else {
    						# part field name
    					    $thisfieldname = $uploadtable."_".$uploadcsvheader[$ui];
    					    $thistable = $uploadtable;	
    					}
    					if (strlen(strstr($allfields,$thisfieldname))>0) {
    					    array_push($currdataa, $GLOBALS{$thisfieldname});
    					    if ($thisfieldval != $GLOBALS{$thisfieldname}) { $fieldschanged++; }
    					    $oldvalue = $GLOBALS{$thisfieldname};
    					    $GLOBALS{$thisfieldname} = $thisfieldval;
    					    array_push($newdataa, $thisfieldval);
    					    array_push($errordataa, "0");	    
    					    if (array_key_exists($thistable."_massupdatelog", $GLOBALS)) {
    					        $GLOBALS{$thistable.'_massupdatelog'} = AddToMassUpdateLog($GLOBALS{$thistable.'_massupdatelog'}, $thisfieldname, $oldvalue, $thisfieldval);
    					    }
    					} else {
					        array_push($currdataa, $GLOBALS{$thisfieldname});
					        array_push($newdataa, "FIELD ERROR");
					        array_push($errordataa, "1");
    					}
				    } else { // no updates requested
		                // array_push($currdataa, "");
		                // array_push($newdataa, $thisfieldval);
		                // array_push($errordataa, "0");
				    }
				}
				
				// ======= set the trace text and write out the updated database records=============
				$uploaderrormsg = "";
				$uploadwarningmsg = "";
				$uploadactiontaken = "";
				if ($testorreal == "R") {
				    if (($fieldschanged > 0 )||($uploadcsv[0] == "data-delete")) {
				        $ghk[0] = $uploadtable;
				        if (array_key_exists($uploadtable."_lastupdatetimestamp", $GLOBALS)) {
				            $GLOBALS{$uploadtable."_lastupdatetimestamp"} = $GLOBALS{'currenttimestamp'};
				            $GLOBALS{$uploadtable."_lastupdatepersonid"} = $GLOBALS{'LOGIN_person_id'};
				            $GLOBALS{$uploadtable."_lastupdatetype"} = "Upload";
				        }
    					if ($uploadcsv[0] == "data") {
    						if ($dataexists == "1") {
    						    Write_Data($ghk);
    						    if ($uploadtablepair != "" ) { $ghk[0] = $uploadtablepair; Write_Data($ghk); }
    						    $uploadactiontaken = "data-changed successfully";
    						} else {
    						    Write_Data($ghk);
    						    if ($uploadtablepair != "" ) { $ghk[0] = $uploadtablepair; Write_Data($ghk); }
    						    $uploadactiontaken = "data-added successfully";   						    
    						}
    					}
    					if ($uploadcsv[0] == "data-add") {
    					    if ($dataexists == "1") {
    					        $uploaderrormsg = "ERROR - data already exists, ";
    					        $uploadactiontaken = "cannot be added. ";
    					    } else {
    						    Write_Data($ghk);
    						    if ($uploadtablepair != "" ) { $ghk[0] = $uploadtablepair; Write_Data($ghk); }
    						    $uploadactiontaken = "data-added successfully";
    						}
    					}
    					if ($uploadcsv[0] == "data-change") {
    						if ($dataexists == "1") {
    						    Write_Data($ghk);
    						    if ($uploadtablepair != "" ) { $ghk[0] = $uploadtablepair; Write_Data($ghk); }
    						    $uploadactiontaken = "data-changed successfully";
    						} else {
    						    $uploaderrormsg = "ERROR - data does not already exist, ";
    						    $uploadactiontaken = "cannot be changed. ";
    						}
    					}
    					if ($uploadcsv[0] == "data-delete") {
    						if ($dataexists == "1") {
    						    Delete_Data($ghk);
    						    if ($uploadtablepair != "" ) { $ghk[0] = $uploadtablepair; Delete_Data($ghk); }
    						    $uploadactiontaken = "data-deleted successfully";
    						} else {
    						    $uploaderrormsg = "ERROR - data does not already exist, ";
    						    $uploadactiontaken = "cannot be deleted. ";
    						}
    					}
				    } else {
				         if ($uploadcsv[0] == "data") {
				             $uploadwarningmsg = "No changes required. ";
				         }
				         if ($uploadcsv[0] == "data-add") {
				             $uploadwarningmsg = "No changes required. ";
				             if ($dataexists == "1") {$uploaderrormsg = "ERROR - data already exists. ";}
				         }
				         if ($uploadcsv[0] == "data-change") {
				             $uploadwarningmsg = "No changes required. ";
				             if ($dataexists == "1") {}
				             else {$uploaderrormsg = "ERROR - data does not already exist. "; }
				         }
				         if ($uploadcsv[0] == "data-delete") {
				             if ($dataexists == "1") {}
				             else {$uploaderrormsg = "ERROR - data does not already exist. ";}
				         }
				    }        
				} else {				    
				    if (($fieldschanged > 0 )||($uploadcsv[0] == "data-delete")) {
    					if ($uploadcsv[0] == "data") {
    						if ($dataexists == "1") {$uploadactiontaken = "data-change would be successful";}
    						else {$uploadactiontaken = "data-add would be successful";}
    					}
    					if ($uploadcsv[0] == "data-add") {
    						if ($dataexists == "1") {$uploaderrormsg = "ERROR - data already exists, ";$uploadactiontaken = "would not be added. ";}
    						else {$uploadactiontaken = "data-add would be successful";}
    					}
    					if ($uploadcsv[0] == "data-change") {
    						if ($dataexists == "1") {$uploadactiontaken = "data-change would be successful";}
    						else {$uploaderrormsg = "ERROR - data does not already exist, ";$uploadactiontaken = "would not be changed. ";}
    					}
    					if ($uploadcsv[0] == "data-delete") {
    						if ($dataexists == "1") {$uploadactiontaken = "data-delete would be successful";}
    						else {$uploaderrormsg = "ERROR - data does not already exist, ";$uploadactiontaken = "would not be deleted. ";}
    					}
				    } else {
				        if ($uploadcsv[0] == "data") {
				            $uploadwarningmsg = "No changes required. ";
				        }
				        if ($uploadcsv[0] == "data-add") {
				            $uploadwarningmsg = "No changes required. ";
				            if ($dataexists == "1") {$uploaderrormsg = "ERROR - data already exists. "; }
				            else {}
				        }
				        if ($uploadcsv[0] == "data-change") {
				            $uploadwarningmsg = "No changes required. ";
				            if ($dataexists == "1") {}
				            else {$uploaderrormsg = "ERROR - data does not already exist. "; }
				        }
				        if ($uploadcsv[0] == "data-delete") {
				            if ($dataexists == "1") { $uploadactiontaken = "data-delete would be successful"; }
				            else { $uploaderrormsg = "ERROR - data does not already exist. ";}
				        }
				    }   
				}
				
				// ======= write out to the trace table =============
				if ( $extendedtrace == "Yes" ) {
				    XTR();
				    XTDTXT($uploadcsv[0]);
				    for ($di = 0; $di < sizeof($newdataa); $di++) {	
				        if ($uploadcsvheader[$di+2] != "") {
				            if ($errordataa[$di] == "0") {
        				        if ($newdataa[$di] != $currdataa[$di]) { XTDTXTCOLOR($newdataa[$di],"#3679B7"); } // change
        				        else { XTDTXT($newdataa[$di]); } // no change
				            } else {
				                XTDTXTCOLOR($newdataa[$di],"red");				            
				            }
				        } else {
				            // XTDTXTCOLOR($newdataa[$di],"lightgray"); // no action required
				        }				        
				    }
				    if ( $uploaderrormsg == "" ) {
				        if ( $uploadwarningmsg == "" ) { XTDTXTCOLOR($uploaderrormsg.$uploadwarningmsg.$uploadactiontaken,"#3679B7"); }
				        else { XTDTXT($uploaderrormsg.$uploadwarningmsg.$uploadactiontaken); }
				    }
				    else { XTDTXTCOLOR($uploaderrormsg.$uploadwarningmsg.$uploadactiontaken,"red"); }				    
				    X_TR();
				    if ($dataexists == "1") {
    				    XTR();
    				    XTDTXTCOLOR("Existing","silver");
    				    for ($di = 0; $di < sizeof($currdataa); $di++) {
    				        if ($uploadcsvheader[$di+2] != "") {
    				            XTDTXTCOLOR($currdataa[$di],"silver"); // action required
    				        } else {
    				            // XTDTXTCOLOR($currdataa[$di],"lightgray"); // no action required
    				        }	
    				    }
    				    XTDTXTCOLOR("","silver");
    				    X_TR();
				    } 
				} else {
				    XTR();
				    XTDTXT($uploadcsv[0]);
				    for ($di = 0; $di < $GLOBALS{$uploadtable."^KEYS"}-1; $di++) {
				        XTDTXT($newdataa[$di]);
				    }
				    if ( $uploaderrormsg == "" ) {
				        if ( $uploadwarningmsg == "" ) { XTDTXTCOLOR($uploaderrormsg.$uploadwarningmsg.$uploadactiontaken,"#3679B7"); }
				        else { XTDTXT($uploaderrormsg.$uploadwarningmsg.$uploadactiontaken); }
				    }
				    else { XTDTXTCOLOR($uploaderrormsg.$uploadwarningmsg.$uploadactiontaken,"red"); }
				    X_TR();
				}				
			}
		}
		
		if ($uploadcsv[0] == "dataend") { 
			# XBR();XTXT("dataend - $uploadcsv[1]");XBR();
		    X_TBODY();
		    X_TABLE();
		    X_DIV("reportdiv_".$uploadtable);
		    XCLEARFLOAT();
		    if ($GLOBALS{$uploadtable."^KEYS"} >= "4") {
		        XINHID($uploadtable."_sortcol","1,2,3,0");
		        XINHID($uploadtable."_sortseq","asc,asc,asc,desc");
		    } else {
		        if ($GLOBALS{$uploadtable."^KEYS"} >= "3") {
		            XINHID($uploadtable."_sortcol","1,2,0");
		            XINHID($uploadtable."_sortseq","asc,asc,desc");
    		    } else {
    		        if ($GLOBALS{$uploadtable."^KEYS"} >= "2") {
    		            XINHID($uploadtable."_sortcol","1,0");
    		            XINHID($uploadtable."_sortseq","asc,desc");
        		    }	        
    		    } 
		    }
		} 
	}
}
}

function CSV_In_Filter ($parm0) {
# remove newline
$instring  = trim($parm0);
$instring  = str_replace('|', '', $instring); // remove pipe characters just in case
// $rne = chr(92).chr(114).chr(92).chr(110); $rnr = "\r";
// $instring = str_replace($rne, $rnr, $instring);
// $instring = preg_replace('/\x5C\x72\x5C\x6E/', "\r", $instring);
# drop all quotes except for quote pairs - replace separating commas by # - remove CR & LF	
# Commas following odd quotes are retained as commas
# Commas following even quotes are turned into #
# Odd quotes are kept except following a comma or if first
$bits = str_split($instring);
$oddevenquote = "EVEN"; $lastbit = ",";
$outstring = "";
$CR = chr(13); $LF = chr(10);
foreach ($bits as $bit) {
 $outbit = $bit;
 if ($bit == '"') {if ($oddevenquote == "0DD") {$oddevenquote = "EVEN";} else {$oddevenquote = "0DD";}}
 if (($bit == ",")&&($oddevenquote == "EVEN")) {$outbit = "|";}   
 if ($bit == '"') {if (($oddevenquote == "0DD")&&($lastbit != ",")) {} else {$outbit = "";}}
 if (($bit == $CR) || ($bit == $LF)) {$outbit = "";}
 $outstring = $outstring.$outbit;
 $lastbit = $bit;
}
return $outstring;
}

function AddToMassUpdateLog($mulog, $fieldname, $oldvalue, $newvalue) {
    // field1[oldval|newval]^field2[oldval|newval]
    $newmulog = "";
    $musep = "";
    $muloga = Array();
    if (strlen(strstr($mulog,"^")) > 0) {
        $muloga = explode("^",$mulog);
    }
    $found = "0";
    foreach ( $muloga as $mulogelement) {
        $mubits1 = explode("[",$mubit);
        $mubits2 = explode("]",$mubits1[1]);
        $mubits3 = explode("|",$mubits2[0]);
        $tfieldname = $mubits1[0];
        $toldvalue = $mubits3[0];
        $tnewvalue = $mubits3[1];
        if ( $fieldname == $tfieldname ) {
            $newmulog = $newmulog.$musep.$fieldname."[".$oldvalue."|".$newvalue."]";
            $musep = "^";
        } else {
            $newmulog = $newmulog.$musep.$tfieldname."[".$toldvalue."|".$tnewvalue."]";
            $musep = "^";
        }
    }
    if ( $found == "0" ) {
        $newmulog = $newmulog.$musep.$fieldname."[".$oldvalue."|".$newvalue."]";
        $musep = "^";
    }
    return $newmulog;
}

function Download_File ($fullPath,$action) {
	$mime = array( "gif"=>"image/gif", "jpg"=>"image/jpeg", "jpeg"=>"image/jpeg", "png"=>"image/png" , "bmp"=>"image/bmp" ,
	"doc"=>"application/msword", "rtf"=>"application/rtf", "pdf"=>"application/pdf", "zip"=>"application/zip", "csv"=>"application/csv",
	"txt"=>"text/plain" ); 
	if (file_exists($fullPath)) { 
		 $fd = fopen ($fullPath, "r");
		 $fsize = filesize($fullPath);
		 $path_parts = pathinfo($fullPath);
		 $ext = strtolower($path_parts["extension"]);
		 header("Content-type: ".$mime{$ext}); 
		 header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); 
		 header("Content-length: $fsize");
		 header("Cache-control: private"); //use this to open files directly
		 while(!feof($fd)) {
			  $buffer = fread($fd, 2048);
			  echo $buffer;
		 }
		 fclose ($fd);
		 if ($action == "delete") { unlink($fullPath); } 
	} else {
		 XH3("Sorry: Download no longer available");
	}
	exit;
}

function Download_File_Link ($parm0) {
XLINKTXT($parm0,"download");
}

=======
<?php # ioroutines.php

function Get_Directory_Array ($tdirectory) {
$tdh  = opendir($tdirectory);
$tdirfiles = array();
while (false !== ($tfilename = readdir($tdh))) {
	if ($tfilename != "." && $tfilename != "..") {
		array_push($tdirfiles, $tfilename);
		# XPTXT($tfilename);
	}
}
return $tdirfiles;
}

function Check_Folder ($folder) {
    $GLOBALS{'IOWARNING'} = "0";
    $path = realpath($folder);
    // If it exist, check if it's a directory
    if($path !== false AND is_dir($path)) { } else { $GLOBALS{'IOWARNING'} = "1"; }
}

function Delete_File ($filename) {
# XBR();XTXT("Delete_File Called - $filename");XBR();
$GLOBALS{'IOWARNING'} = "0";		
if (file_exists($filename)) { unlink($filename); } 
else {$GLOBALS{'IOWARNING'} = "1"; }
}

function Delete_Directory_AllLevels($dir,$trace) {
    if(!$dh = @opendir($dir)) { return; }
    while (false !== ($obj = readdir($dh))) {
        if($obj == '.' || $obj == '..') { continue; }
        if (!@unlink($dir . '/' . $obj)) { Delete_Directory_AllLevels($dir.'/'.$obj,$trace); }
        else { if ($trace == "ShowTrace") { print $dir . '/' . $obj."   Deleted<br>"; } }
    }
    closedir($dh);
    @rmdir($dir);
    if ($trace == "ShowTrace") { print $dir."   Deleted<br>"; }
    return;
}

function Check_File ($filename) {
# XBR();XTXT("Check_File Called - $filename");XBR();	
$GLOBALS{'IOWARNING'} = "0";
$fp = @fopen($filename, "r") or SilentWarningRoutine(); 	
}

function Get_File_Array ($filename) {
# XBR();XTXT("Get_File_Array Called - $filename");XBR();
$GLOBALS{'IOERRORcode'} = "Get_File_Array"; $GLOBALS{'IOERRORmessage'} = $filename." Not Found";
$fp = @fopen($filename, "r") or ErrorRoutine(); 	
$fdata = fread($fp, filesize($filename));
while(!feof($fp)){$fdata .= fgets($fp, 1024);} 
fclose($fp);
# test for unix or windows file
$nstr = "\n"; $rstr = "\r";
$npos = strpos($fdata, $nstr); if ($npos == false) { $npos = 999; }
$rpos = strpos($fdata, $rstr); if ($rpos == false) { $rpos = 999; }
# XH2($filename."| N and R |".$npos."|".$rpos."|");
$servertype = "unknown";
if (($npos == 999)&&($rpos == 999)) {$fvalues = array($fdata); $servertype = "SINGLE RECORD";} # Single record
else {
 if ($rpos == $npos-1 ) { $fvalues = explode("\r\n", $fdata); $servertype = "WINDOWS";} # WINDOWS
 else {
  if ($rpos < 200) { $fvalues = explode("\r", $fdata);	$servertype = "MAC";} # MAC
  if ($npos < 200) { $fvalues = explode("\n", $fdata); $servertype = "UNIX";} # UNIX	
 }
}
return $fvalues;
}

function Open_File_Write ($filename) {
$fp = fopen($filename, "w") or ErrorRoutine();  	
return $fp;
}

function Write_File ($filehandle, $filedata) {
fwrite($filehandle, $filedata);	
}

function Close_File_Write ($fp) {
fclose($fp);
}

function Upload_File ($uploadname,$fpath,$filename,$aft,$fmaxsize,$aureqd,$tempprefix,$prefix,$maxwidth)  {
	# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix $maxwidth - returns string - Error(1/0)|Message|filename|filesize|width|height
	// XH5("Upload_File - called - $uploadname|$fpath|$filename|$aft|$fmaxsize|$aureqd|$tempprefix|$prefix|$maxwidth");

	ini_set('upload-max-filesize', '64M');

	$errorcode = "0"; $message = ""; $autaken = ""; $filesize=""; $width=""; $height="";
	
	if ($_FILES[$uploadname]["name"] == "") {
		$errorcode = "1";
		$message = "No file uploaded";		
	} else {
		if ($filename == "") { $filename = $_FILES[$uploadname]["name"];}
		$filesize = $_FILES[$uploadname]["size"];
		$mbits = explode(".", $filename);
		$filetype = end($mbits);
		
		XH5("Filename ".$filename." - Filetype ".$filetype);
		$filefirstname = str_replace(".".$filetype, "", $filename);
		$GLOBALS{'IOWARNING'} = "0";
		if ($filesize <= $fmaxsize) {
			if ((strlen(strstr($aft,$filetype))>0)||($aft == "all")) {
				if ($_FILES[$uploadname]["error"] > 0) {
					$errorcode = "1";
					$message = "Return Code:".$_FILES[$uploadname]["error"];
				} else {
					$extramessage = "";
					if ( FileIsImage($filetype) == true ) {
						list($width, $height) = getimagesize($_FILES[$uploadname]["tmp_name"]);
						if (($maxwidth != "" )&&($width > $maxwidth)) {
							$extramessage = ". Image width reduced to ".$maxwidth." px";
						}
					}
					
					if (file_exists($fpath."/".$filename)) { $GLOBALS{'IOWARNING'} = "1"; }			
					if ($GLOBALS{'IOWARNING'} == "1") {
						if ($aureqd == "") {
							move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
							if ( FileIsImage($filetype) == true ) {
								ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
							}
							chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
							$message = "Successfully updated file - ".$maxwidth." ".$_FILES[$uploadname]["name"].$extramessage;
							$autaken = "updated";
						}
						if ($aureqd == "update") {
							move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
							if ( FileIsImage($filetype) == true ) {
								ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
							}
							chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
							$message = "Successfully updated file - ".$_FILES[$uploadname]["name"].$extramessage;
							$autaken = "updated";
						}
						if ($aureqd == "add") {
							$errorcode = "1";
							$message = "ERROR: File already exists - ".$_FILES[$uploadname]["name"];
						}
					}
					if ($GLOBALS{'IOWARNING'} == "0") {
						if ($aureqd == "") {
							move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
							if ( FileIsImage($filetype) == true ) {
								ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
							}
							chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
							$message = "Successfully added file - ".$_FILES[$uploadname]["name"].$extramessage;
							$autaken = "added";
						}
						if ($aureqd == "update") {
							$errorcode = "1";
							$message = "ERROR: File does not already exist - ".$_FILES[$uploadname]["name"];
						}
						if ($aureqd == "add") {
							# print "from - ".$_FILES[$uploadname]["tmp_name"]." to ".$fpath."/".$prefix.$filename."<br>/n";
							move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
							if ( FileIsImage($filetype) == true ) {
								ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
							}
							chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
							$message = "Successfully added file - ".$_FILES[$uploadname]["name"].$extramessage;
							$autaken = "added";
						}
					}
				}
			} else {
				$errorcode = "1";
				$message = "Invalid file type - ".$filetype."- should be ".$aft;
			}
		} else {
			$errorcode = "1";
			$message = "File too large - greater than ".$fmaxsize."KB";
		}
	}
	# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
	# Note that filename returned is without the tempprefix
	# print $fpath."  -  ".$message;
	return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
}

function Upload_DropZoneFile ($uploadname,$fpath,$filename,$aft,$fmaxsize,$aureqd,$tempprefix,$prefix,$maxwidth)  {
	# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix $maxwidth - returns string - Error(1/0)|Message|filename|filesize|width|height
	// XH5("Upload_File - called - $uploadname|$fpath|$filename|$aft|$fmaxsize|$aureqd|$tempprefix|$prefix|$maxwidth");
	ini_set('upload-max-filesize', '64M');
	
	$errorcode = "0"; $message = ""; $autaken = ""; $filesize=""; $width=""; $height="";
	if ($filename == "") {$filename = $_FILES[$uploadname]["name"];}
	$filesize = $_FILES[$uploadname]["size"];
	$mbits = explode(".", $filename);
	$filetype = end($mbits);
	
	$filefirstname = str_replace(".".$filetype, "", $filename);
	$GLOBALS{'IOWARNING'} = "0";
	if ($filesize <= $fmaxsize) {
		if ((strlen(strstr($aft,$filetype))>0)||($aft == "all")) {
			if ($_FILES[$uploadname]["error"] > 0) {
				$errorcode = "1";
				$message = "Return Code:".$_FILES[$uploadname]["error"];
			} else {
				$extramessage = "";
				if ( FileIsImage($filetype) == true ) {
					list($width, $height) = getimagesize($_FILES[$uploadname]["tmp_name"]);
					if (($maxwidth != "" )&&($width > $maxwidth)) {
						$extramessage = ". Image width reduced to ".$maxwidth." px";
					}
				}
	
				if (file_exists($fpath."/".$filename)) {
					$GLOBALS{'IOWARNING'} = "1";
				}
				if ($GLOBALS{'IOWARNING'} == "1") {
					if ($aureqd == "") {
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
						if ( FileIsImage($filetype) == true ) {
							ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
						}
						chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
						$message = "Successfully updated file - ".$maxwidth." ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "updated";
					}
					if ($aureqd == "update") {
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
						if ( FileIsImage($filetype) == true ) {
							ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
						}
						chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
						$message = "Successfully updated file - ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "updated";
					}
					if ($aureqd == "add") {
						$errorcode = "1";
						$message = "ERROR: File already exists - ".$_FILES[$uploadname]["name"];
					}
				}
				if ($GLOBALS{'IOWARNING'} == "0") {
					if ($aureqd == "") {
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
						if ( FileIsImage($filetype) == true ) {
							ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
						}
						chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
						$message = "Successfully added file - ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "added";
					}
					if ($aureqd == "update") {
						$errorcode = "1";
						$message = "ERROR: File does not already exist - ".$_FILES[$uploadname]["name"];
					}
					if ($aureqd == "add") {
						# print "from - ".$_FILES[$uploadname]["tmp_name"]." to ".$fpath."/".$prefix.$filename."<br>/n";
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$tempprefix.$prefix.$filename);
					if ( FileIsImage($filetype) == true ) {
						ConstrainImageWidth($fpath."/".$tempprefix.$prefix.$filename,$maxwidth);
					}
					chmod($fpath."/".$tempprefix.$prefix.$filename, 0644);
					$message = "Successfully added file - ".$_FILES[$uploadname]["name"].$extramessage;
					$autaken = "added";
					}
				}
			}
		} else {
			$errorcode = "1";
			$message = "Invalid file type - ".$filetype."- should be ".$aft;
		}
	} else {
		$errorcode = "1";
		$message = "File too large - greater than ".$fmaxsize."KB";
	}
	# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
	# Note that filename returned is without the tempprefix
	# print $fpath."  -  ".$message;
	return "$errorcode|$message|$tempprefix$prefix$filename|$autaken|$filesize|$width|$height|";
}


function Upload_SlimImageCrop ($uploadname,$eichanged,$fpath,$filename,$aft,$fmaxsize,$aureqd,$tempprefix,$prefix,$filesuffix,$reqdwidth,$reqdheight)  {
// uploadname = Input Field Name
// eichanged = Existing Image Changed
// fpath = Output File Path
// filename = If File Name is to be forced
// aft = Allowed File Types
// fmaxsize = Max File Size Allowed
// aureqd = Add/Update Controls
// tempprefix = Temp Output File Prefix
// prefix = Output File Prefix
// filesuffix = Output File Suffix
// reqdwidth = Output Reqd Width
// reqdheight = Output Reqd Height

// returns string - Error(1/0)|Message|filename|filesize|width|height
// XH5("Upload_SlimImageCrop - called - $uploadname|$eichanged|$fpath|$filename|$aft|$fmaxsize|$aureqd|$tempprefix|$prefix|$filesuffix|$reqdwidth|$reqdheight");

$errorcode = "0"; $message = ""; $autaken = ""; $filesize=""; $width=""; $height="";

try { $images = Slim::getImages();
}
catch (Exception $e) {
	XH2('ERROR.Unknown Error'); return "1|Unknown Error||||";
}

if ($images === false) {
	XH2('ERROR.No data posted'); return "1|No data posted||||";
}

// Should always be one image (when posting async), so we'll use the first on in the array (if available)
$image = array_shift($images);

if (!isset($image)) {
	return "1|No image uploaded (try decreasing image size to less than 1M)||||";
}


// ====== firtly get the parameters returned by slim (actual image file is returned outside of slim) 
$inimagename = $image['input']['name'];
if ( strlen(strstr($inname,$tempprefix.$prefix))>0 ) {
	// dont add double prefix
	$inimagename = str_replace($tempprefix.$prefix,"",$inname);
}
$inimagesize = $image['input']['size'];
$inimagewidth = $image['input']['width'];
$inimageheight = $image['input']['height'];
$actionrotation = $image['actions']['rotation'];
$actioncropx = $image['actions']['crop']['x'];
$actioncropy = $image['actions']['crop']['y'];
$actioncropwidth = $image['actions']['crop']['width'];
$actioncropheight = $image['actions']['crop']['height'];
$actioncroptype = $image['actions']['crop']['type'];
$actionsize = $image['actions']['size'];

/*
XH2('Slim Parameters.');
XTXT("inimagename - ".$inimagename);
XBR();XTXT("inimagesize - ".$inimagesize);
XBR();XTXT("inimagewidth - ".$inimagewidth);
XBR();XTXT("inimageheight - ".$inimageheight);
XBR();XTXT("actionrotation - ".$actionrotation);
XBR();XTXT("actioncropx - ".$actioncropx);
XBR();XTXT("actioncropy - ".$actioncropy);
XBR();XTXT("actioncropwidth - ".$actioncropwidth);
XBR();XTXT("actioncropheight - ".$actioncropheight);
XBR();XTXT("actioncroptype - ".$actioncroptype);
XBR();XTXT("actionsize - ".$actionsize);
*/

// ====== now get the actual input image as a file upload outside of slim 
if ($eichanged == "1") {
	if ($filename == "") { $filename = $_FILES[$uploadname]["name"]; }
	$filesize = $_FILES[$uploadname]["size"];
	$mbits = explode(".", $filename);
	$filetype = end($mbits);
	$filefirstname = str_replace(".".$filetype, "", $filename);
	// remove all blanks and commas in image firstname
	$filefirstname = str_replace(" " , "", $filefirstname);
	$filefirstname = str_replace("," , "", $filefirstname);	
	$outname = $tempprefix.$prefix.$filefirstname.$filesuffix.".".$filetype;
	$GLOBALS{'IOWARNING'} = "0";
	if ($filesize <= $fmaxsize) {
		if ((strlen(strstr($aft,$filetype))>0)||($aft == "all")) {
			if ($_FILES[$uploadname]["error"] > 0) {
				$errorcode = "1";
				$message = "Return Code:".$_FILES[$uploadname]["error"];
			} else {
				list($width, $height) = getimagesize($_FILES[$uploadname]["tmp_name"]);
				if (file_exists($fpath."/".$filename)) {
					$GLOBALS{'IOWARNING'} = "1";
				}
				$extramessage = "";
				if (($reqdwidth != "flex" )&&($width > $reqdwidth)) {
					$extramessage = ". Image width reduced to ".$reqdwidth." px";
				}
				if ($GLOBALS{'IOWARNING'} == "1") {
					if ($aureqd == "") {
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$outname);
						CropAndResizeImage( $fpath."/".$outname, $actioncropx, $actioncropy, $actioncropwidth, $actioncropheight, $reqdwidth, $reqdheight);
						chmod($fpath."/".$outname, 0644);
						$message = "Successfully updated file - ".$reqdwidth." ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "updated";
					}
					if ($aureqd == "update") {
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$outname);
						CropAndResizeImage( $fpath."/".$outname, $actioncropx, $actioncropy, $actioncropwidth, $actioncropheight, $reqdwidth, $reqdheight);
						chmod($fpath."/".$outname, 0644);
						$message = "Successfully updated file - ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "updated";
					}
					if ($aureqd == "add") {
						$errorcode = "1";
						$message = "ERROR: File already exists - ".$_FILES[$uploadname]["name"];
					}
				}
				if ($GLOBALS{'IOWARNING'} == "0") {
					if ($aureqd == "") {
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$outname);
						CropAndResizeImage( $fpath."/".$outname, $actioncropx, $actioncropy, $actioncropwidth, $actioncropheight, $reqdwidth, $reqdheight);
						chmod($fpath."/".$outname, 0644);
						$message = "Successfully added file - ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "added";
					}
					if ($aureqd == "update") {
						$errorcode = "1";
						$message = "ERROR: File does not already exist - ".$_FILES[$uploadname]["name"];
					}
					if ($aureqd == "add") {
						# print "from - ".$_FILES[$uploadname]["tmp_name"]." to ".$fpath."/".$prefix.$filename."<br>/n";
						move_uploaded_file($_FILES[$uploadname]["tmp_name"], $fpath."/".$outname);
						CropAndResizeImage( $fpath."/".$outname, $actioncropx, $actioncropy, $actioncropwidth, $actioncropheight, $reqdwidth, $reqdheight);
						chmod($fpath."/".$outname, 0644);
						$message = "Successfully added file - ".$_FILES[$uploadname]["name"].$extramessage;
						$autaken = "added";
					}
				}
			}
		} else {
			$errorcode = "1";
			$message = "Invalid file type - ".$filetype."- should be ".$aft;
		}
	} else {
		$errorcode = "1";
		$message = "File too large - greater than ".$fmaxsize."KB";
	}
} else {
	$existingimagename = $_REQUEST["ExistingImageName"];
	if ($existingimagename == "") {
		$errorcode = "1";
		$message = "No changes made";
	} else {
		CropAndResizeImage( $fpath."/".$existingimagename, $actioncropx, $actioncropy, $actioncropwidth, $actioncropheight, $reqdwidth, $reqdheight);
		$outname = $existingimagename;
		$message = "Successfully updated existing image - ".$existingimagename;
		$autaken = "updated";	
	}
}


// Return string - Error(1/0)|Message|outfilename|added/updated|filesize|width|height
return "$errorcode|$message|$outname|$autaken|$filesize|$width|$height|";
}


function Upload_SlimFile ($uploadname,$fpath,$filename,$aft,$fmaxsize,$aureqd,$tempprefix,$prefix,$maxwidth,$filesuffix)  {
	# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix - returns string - Error(1/0)|Message|filename|filesize|width|height
	// XH5("Upload_File - called - $uploadname|$fpath|$filename|$aft|$fmaxsize|$aureqd|$tempprefix|$prefix|$maxwidth|$filesuffix");

	ini_set('upload-max-filesize', '64M');

	// based on slim async example  - uploadname defaulted to slim
try { $images = Slim::getImages();
}
catch (Exception $e) {
	return "1|Unknown Error||||";
}

if ($images === false) {
	return "1|No data posted||||";
}

// Should always be one image (when posting async), so we'll use the first on in the array (if available)
$image = array_shift($images);

if (!isset($image)) {
	return "1|No image uploaded (try decreasing image size to less than 1M)||||";
}
if (!isset($image['output']['data'])) {
	return "1|No image data||||";
}

$inname = $image['input']['name'];
if ( strlen(strstr($inname,$tempprefix.$prefix))>0 ) {
	// dont add double prefix
	$inname = str_replace($tempprefix.$prefix,"",$inname);
}

$insize = $image['input']['size'];
$inwidth = $image['input']['width'];
$inheight = $image['input']['height'];
$outwidth = $image['output']['width'];
$outheight = $image['output']['height'];
// note: If you want to save the input data, replace the 'output' string below with 'input'
$outdata = $image['output']['data'];

// If you want to prevent Slim from adding a unique id to the file name add false as the fourth parameter.
// $file = Slim::saveFile($data, $name, 'tmp/', false);
$file = Slim::saveFile($outdata, $inname, $GLOBALS{'domainwwwpath'}."/domain_temp/", false);

$errorcode = "0"; $message = ""; $autaken = "";

$mbits = explode(".", $inname);
$intype = end($mbits);
$infirstname = str_replace(".".$intype, "", $inname);
// remove all blanks and commas in image firstname
$infirstname = str_replace(" " , "", $infirstname);
$infirstname = str_replace("," , "", $infirstname);
$outname = $tempprefix.$prefix.$infirstname.$filesuffix.".".$intype;
$GLOBALS{'IOWARNING'} = "0";
if ($insize <= $fmaxsize) {
	if ((strlen(strstr($aft,$intype))>0)||($aft == "all")) {
		list($width, $height) = getimagesize($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname);
		if (file_exists($fpath."/".$outname)) {
			$GLOBALS{'IOWARNING'} = "1";
		}
		$extramessage = "";
		if (($maxwidth != "" )&&($inwidth > $maxwidth)) {
			$extramessage = ". Image width reduced to ".$maxwidth." px";
		}
		if ($GLOBALS{'IOWARNING'} == "1") {
			if ($aureqd == "") {
				if (copy($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname,$fpath."/".$outname)) {
					unlink($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname);
				}
				ConstrainImageWidth($fpath."/".$outname,$maxwidth);
				chmod($fpath."/".$outname, 0644);
				$message = "Successfully updated file - ".$fpath."/".$outname.$extramessage;
				$autaken = "updated";
			}
			if ($aureqd == "update") {
				if (copy($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname,$fpath."/".$outname)) {
					unlink($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname);
				}
				ConstrainImageWidth($fpath."/".$outname,$maxwidth);
				chmod($fpath."/".$outname, 0644);
				$message = "Successfully updated file - ".$outname.$extramessage;
				$autaken = "updated";
			}
			if ($aureqd == "add") {
				$errorcode = "1";
				$message = "ERROR: File already exists - ".$outname;
			}
		}
		if ($GLOBALS{'IOWARNING'} == "0") {
			if ($aureqd == "") {
				if (copy($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname,$fpath."/".$outname)) {
					unlink($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname);
				}
				ConstrainImageWidth($fpath."/".$outname,$maxwidth);
				chmod($fpath."/".$outname, 0644);
				$message = "Successfully added file - ".$fpath."/".$outname.$extramessage;
				$autaken = "added";
			}
			if ($aureqd == "update") {
				$errorcode = "1";
				$message = "ERROR: File does not already exist - ".$outname;
			}
			if ($aureqd == "add") {
				# print "from - ".$_FILES[$uploadname]["tmp_name"]." to ".$fpath."/".$prefix.$inname."<br>/n";
				if (copy($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname,$fpath."/".$outname)) {
				unlink($GLOBALS{'domainwwwpath'}."/domain_temp/".$inname);
			}
			ConstrainImageWidth($fpath."/".$outname,$maxwidth);
			chmod($fpath."/".$outname, 0644);
			$message = "Successfully added file - ".$outname.$extramessage;
			$autaken = "added";
			}
		}
	} else {
		$errorcode = "1";
		$message = "Invalid file type - ".$intype."- should be ".$aft;
	}
} else {
	$errorcode = "1";
	$message = "File too large - greater than ".$fmaxsize."KB";
}

# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
# Note that filename returned is without the tempprefix
# print $fpath."  -  ".$message;
return $errorcode."|".$message."|".$outname."|".$autaken."|".$insize."|".$width."|".$height."|";
}

function FileIsImage( $filetype) {
	$imagelist = "JPG,JPEG,jpg,jpeg,GIF,gif,PNG,png";
	return FoundInCommaList($filetype,$imagelist);
}

function ConstrainImageWidth( $imagefullname, $maxwidth) {	
	if ($maxwidth != "") {
		list($width, $height) = getimagesize($imagefullname);	
		if ($width > $maxwidth) {
			$aspectratio = $width/$height;
			$outwidth = $maxwidth;
			$outheight = $maxwidth/$aspectratio;
			
			$canvas = imagecreatetruecolor($outwidth, $outheight);
			$bits = explode(".",$imagefullname);
			$imagetype = end($bits);
			if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
			if ($imagetype == "jpeg") {$current_image = imagecreatefromjpeg($imagefullname);}
			if ($imagetype == "gif") {$current_image = imagecreatefromgif($imagefullname);}
			if ($imagetype == "png") {$current_image = imagecreatefrompng($imagefullname);}
			if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}
			if ($imagetype == "JPEG") {$current_image = imagecreatefromjpeg($imagefullname);}
			if ($imagetype == "GIF") {$current_image = imagecreatefromgif($imagefullname);}
			if ($imagetype == "PNG") {$current_image = imagecreatefrompng($imagefullname);}
		  
			imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, $outwidth, $outheight, $width, $height);   
	
			if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
			if ($imagetype == "jpeg") {imagejpeg($canvas, $imagefullname);}
			if ($imagetype == "gif") {imagegif($canvas, $imagefullname);}
			if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
			if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
			if ($imagetype == "JPEG") {imagejpeg($canvas, $imagefullname);}
			if ($imagetype == "GIF") {imagegif($canvas, $imagefullname);}
			if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
	
		}
	}		
}

function CropAndResizeImage( $imagefullname, $incropleft, $incroptop, $incropwidth, $incropheight, $reqdimagewidth, $reqdimageheight) {
	// XH4($imagefullname."|".$incropleft."|".$incroptop."|".$incropwidth."|".$incropheight."|".$reqdimagewidth."|".$reqdimageheight);
	$error = "0";
	$message = "";	
	if (file_exists($imagefullname)) { 
		// Get dimensions of the original image
		# list($current_width, $current_height) = getimagesize($imagefullname);
		// Resample the image
		# Set the new canvas size and cropping according to the required image size 	
		if (($reqdimageheight == "flex")&&($reqdimagewidth == "flex"))  { 	
		   $outcropheight = $incropheight;
		   $outcropwidth = $incropwidth;
		}
		if (($reqdimageheight != "flex")&&($reqdimagewidth == "flex"))  { 	
		   $outcropheight = $reqdimageheight;
		   $outcropwidth = round(($incropwidth*$reqdimageheight/$incropheight),0);
		}  
		if (($reqdimageheight == "flex")&&($reqdimagewidth != "flex"))  {
		   $outcropwidth = $reqdimagewidth;   	 	
		   $outcropheight = round(($incropheight*$reqdimagewidth/$incropwidth),0);
		} 
		if (($reqdimageheight != "flex")&&($reqdimagewidth != "flex"))  {
			$outcropheight = $reqdimageheight;
			$outcropwidth = $reqdimagewidth;
		}
		
		
		$canvas = imagecreatetruecolor($outcropwidth, $outcropheight);
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
		
		/*
		$image_p = imagecreatetruecolor(480, 270);
		imageAlphaBlending($image_p, false);
		imageSaveAlpha($image_p, true);
		$image = imagecreatefrompng('image_with_some_transaprency.png');
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, 480, 270, 1920, 1080);
		imagepng($image_p, 'resized.png', 0);
		*/
	
		if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "jpeg") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "gif") {$current_image = imagecreatefromgif($imagefullname);}
		if ($imagetype == "png") {			
			imageAlphaBlending($canvas, false);
			imageSaveAlpha($canvas, true);
			$current_image = imagecreatefrompng($imagefullname);	
		}
		if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "JPEG") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "GIF") {$current_image = imagecreatefromgif($imagefullname);}
		if ($imagetype == "PNG") {
			imageAlphaBlending($canvas, false);
			imageSaveAlpha($canvas, true);
			$current_image = imagecreatefrompng($imagefullname);		
		}
	  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, $incropleft, $incroptop, $outcropwidth, $outcropheight, $incropwidth, $incropheight);   
	
		if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "jpeg") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "gif") {imagegif($canvas, $imagefullname);}
		if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
		if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "JPEG") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "GIF") {imagegif($canvas, $imagefullname);}
		if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
	} else {
		$error = "1";
		$message = "$imagefullname not found";	
	}
}


function IODBCONNECT ($db, $host, $user, $password) {
// XBR();XTXT("IODBCONNECT Called - $db|$host|$user|$password");XBR();
$mysqli   = mysqli_connect($host, $user, $password, $db);
if (mysqli_connect_errno($mysqli)) {
    echo '<p class="error">Apologies - The database is not available at this time - please try again later.</p>';
}
// print "IODBCONNECT completed<br>\n";	
$GLOBALS{'IOSQL'} = $mysqli;
}

function IODBDISCONNECT () {
# XBR();XTXT("IODBDISCONNECT Called");XBR();	
mysqli_close($GLOBALS{'IOSQL'});
}

function IOSETUP () {
# print "IOSETUP Called<br>\n";	 
$tfields = array();
$tablearray = array();
$q = 'SHOW TABLES';
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
if (mysqli_num_rows($r) > 0) { 
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
  array_push($tablearray, $row[0]); 
  // XPTXT($row[0]);
 }
}
$tablestring = "|";
foreach ($tablearray as $tablearrayelement) {
	$tstring = $tablestring.$tablearrayelement."|";
	$colarray = array();
	$keycount = 0;	
	$q = 'SHOW COLUMNS FROM '.$tablearrayelement;
	 
	$r = mysqli_query($GLOBALS{'IOSQL'},$q);
	if (mysqli_num_rows($r) > 0) { 
	  while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
	   array_push($colarray, $row[0]);
	   if ($row[3] == "PRI") {$keycount++;}	
	  }
	} 
	$tstring = ""; $sep = "";
	foreach ($colarray as $colarrayelement) { $tstring = $tstring.$sep.$colarrayelement; $sep = "|"; } 
	array_push($tfields, $tablearrayelement); 
	$GLOBALS{$tablearrayelement."^FIELDS"}=$tstring; 
	$GLOBALS{$tablearrayelement."^KEYS"}=$keycount;
	// XBR();XTXT($tablearrayelement);XBR(); 
}

$GLOBALS{"TABLES"}=$tablestring;
}

function IOSQLCMD ($query) {
$GLOBALS{'IOERRORcode'} = "IOSQL"; $GLOBALS{'IOERRORmessage'} = "$query";
$r = mysqli_query($GLOBALS{'IOSQL'},$query);
}
# --------------------------------------------------------------

function  Get_Array () {
# datatype keys - returns array
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used
// print "Get_Array - $parmsmax - $parms[0] | $parms[1] | $parms[2] | $tablename <br>\n"; 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1 = "SELECT * FROM ".$tablename; 
if ($rootkey != "") {$qk1 = $qk1." WHERE ".$tfields[0]."='".$rootkey."'"; $kindex = $parmsmax+1;} 
else {$kindex = $parmsmax;}
$qk2 = ""; $qk3 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
$q = $qk1.$qk2.$qk3;
// XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO001"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
$tarray = array();
if (mysqli_num_rows($r) > 0) { 
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { array_push($tarray, $row[$kindex]); }
}
// print "Get_Array returns"; print_r($tarray); print "<BR>\n";
return $tarray;
}


function  Get_NKey_Array () {
# datatype keys - returns array with keys separated by |	VERY BASIC - NEEDS REWRITING ONLY WORKS FOR DOMAIN RELATED TABLES
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used
// print "Get_Array - $parmsmax - $parms[0] | $parms[1] | $parms[2] | $tablename <br>\n"; 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$keys =  intval($GLOBALS{$tablename."^KEYS"});
$qk1 = "SELECT * FROM ".$tablename; 
if ($rootkey != "") {$qk1 = $qk1." WHERE ".$tfields[0]."='".$rootkey."'"; $kindex = $parmsmax+1;} 
else {$kindex = $parmsmax;}
$qk2 = ""; $qk3 = ""; 
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
$q = $qk1.$qk2.$qk3;
# XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO001"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
$tarray = array();
if (mysqli_num_rows($r) > 0) { 
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
 	$kstring = ""; $ksep = "";
 	for( $ik = 0; $ik<$keys-1; $ik++ ) { 
 		$kstring = $kstring.$ksep.$row[$kindex+$ik];
 		$ksep = "|";
 	}
 	array_push($tarray, $kstring);
 }
}
// print "Get_Array returns<br>\n"; 
// for( $i = 0; $i<20; $i++ ) { print $tarray[$i]."<BR>\n"; }
// print_r($tarray); print "<BR>\n";
return $tarray;
}

function  Get_2Key_Array () {
# datatype keys - returns array with keys separated by |	VERY BASIC - NEEDS REWRITING
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used
// print "Get_Array - $parmsmax - $parms[0] | $parms[1] | $parms[2] | $tablename <br>\n"; 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1 = "SELECT * FROM ".$tablename; 
if ($rootkey != "") {$qk1 = $qk1." WHERE ".$tfields[0]."='".$rootkey."'"; $kindex = $parmsmax+1;} 
else {$kindex = $parmsmax;}
$qk2 = ""; $qk3 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
$q = $qk1.$qk2.$qk3;
# XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO001"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
$tarray = array();
if (mysqli_num_rows($r) > 0) { 
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { array_push($tarray, $row[$kindex]."|".$row[$kindex+1]); }
}
# print "Get_Array returns"; print_r($tarray); print "<BR>\n";
return $tarray;
}

function Get_Array_Mergedkey ($tablename, $mergedkeyA, $mergedkeyB) {
# datatype mergedkey0 mergedkey1 - returns array
# limited to merge 2 keys only = no rootkey logic or site logic
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$mergedkeyindexA = array_search($mergedkeyA, $tfields);
$mergedkeyindexB = array_search($mergedkeyB, $tfields);
$rootkey = $GLOBALS{'LOGIN_domain_id'};
$q = "SELECT * FROM ".$tablename." WHERE ".$tfields[0]."='".$rootkey."'";;
# XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO001"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
$tarray = array();
if (mysqli_num_rows($r) > 0) {
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
  array_push($tarray, $row[$mergedkeyindexA]."+".$row[$mergedkeyindexB]);
  # print $row[$mergedkeyindexA]."+".$row[$mergedkeyindexB];
 }
}
# print "Get_Array_Mergedkey returns"; print_r($tarray); print "<BR>\n";
return $tarray;
}

# datatype keys returns fields
function  Check_Data () {
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used 
// print "Check_Data - $parmsmax - $parms[0] | $parms[1] | $parms[2] | $parms[3] | $tablename <br>\n"; 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1= "SELECT * FROM ".$tablename." WHERE ".$tfields[0]."='".$rootkey."'"; 
$qk2 = ""; $qk3 = ""; $qk4 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
if ($parmsmax > 2) {$qk4 = " AND ".$tfields[3]."='".$parms[3]."'";}
$q = $qk1.$qk2.$qk3.$qk4;
// XBR();XTXT($q);XBR();
$GLOBALS{'IOWARNING'} = "0";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
if (mysqli_num_rows($r) > 0) { 
 $row = mysqli_fetch_array($r, MYSQL_ASSOC);
 foreach ($tfields as $tfieldelement) {
  $GLOBALS[$tfieldelement] = $row[$tfieldelement];	 
 }
}
else {SilentWarningRoutine();}
}

# datatype keys returns fields
function  Get_Data () {
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used 
# print "Get_Data - $parmsmax - $parms[0] | $parms[1] | $parms[2] | $parms[3] | $tablename <br>\n"; 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1= "SELECT * FROM ".$tablename." WHERE ".$tfields[0]."='".$rootkey."'"; # forces domainid to be used
$qk2 = ""; $qk3 = ""; $qk4 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
if ($parmsmax > 2) {$qk4 = " AND ".$tfields[3]."='".$parms[3]."'";}
$q = $qk1.$qk2.$qk3.$qk4;
// XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO004"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
if (mysqli_num_rows($r) > 0) { 
 $row = mysqli_fetch_array($r, MYSQL_ASSOC);
 foreach ($tfields as $tfieldelement) {
  $GLOBALS[$tfieldelement] = $row[$tfieldelement];
 }
}
else {ErrorRoutine();}
}

# datatype
function Write_Data () {
$parms = func_get_arg(0);
for($i=0;$i<func_num_args();$i++){
	$ts=func_get_arg($i);
	if ( $ts == "" ) {
	    $keystring = "";
	    for($j=0;$j<$i;$j++){
	        $keystring = $keystring." ".func_get_arg($j);
	    }
	    $keystring = $keystring." NULL";
	    XPTXTCOLOR("<b>ERROR: Null Write Key - (".$keystring." )</b>","red"); 
	    return;	
	}
}
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used 
// print "Write_Data - |$parms[0]|$parms[1]|$parms[2]|<br>\n";	
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$GLOBALS{$tfields[0]} = $rootkey; # forces domainid to be used
if (($GLOBALS{$tablename."^KEYS"} > 1)&&($parms[1] != "")) {$GLOBALS{$tfields[1]} = $parms[1];}
if (($GLOBALS{$tablename."^KEYS"} > 2)&&($parms[2] != "")) {$GLOBALS{$tfields[2]} = $parms[2];}
if (($GLOBALS{$tablename."^KEYS"} > 3)&&($parms[3] != "")) {$GLOBALS{$tfields[3]} = $parms[3];}
$setstring = ""; $sep = "";
foreach ($tfields as $tfieldelement) {
 $tfieldvalue = '"'.mysqli_real_escape_string($GLOBALS{'IOSQL'},$GLOBALS{$tfieldelement}).'"'; # escapes special characters	
 $setstring = $setstring.$sep.$tfieldelement."=".$tfieldvalue;  $sep = ",";
}
# older mySQL level dosent support ON DUPLICATE UPDATE
if ($GLOBALS{'site_server'} == "DSQL") { $q = "INSERT INTO ".$tablename." SET ".$setstring;} 
else { $q = "INSERT INTO ".$tablename." SET ".$setstring." ON DUPLICATE KEY UPDATE ".$setstring; }
// XBR();XTXT($q);XBR();
$GLOBALS{'IOWARNING'} = "0";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
# $tnum = mysqli_affected_rows($GLOBALS{'IOSQL'}); print "affected rows - $tnum<br>\n";
$noupdate = "1";
# XBR();XTXT("Rows ".mysqli_affected_rows($GLOBALS{'IOSQL'}));XBR();
if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 0) {$noupdate = "0";} 
if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 1) {$noupdate = "0";}
if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 2) {$noupdate = "0";}
if ($noupdate == "1") {SilentWarningRoutine();}
if ($GLOBALS{'IOWARNING'} == "1") {
 $qk1= "UPDATE ".$tablename." SET ".$setstring." WHERE ".$tfields[0]."='".$rootkey."'"; # forces domainid to be used
 $qk2 = ""; $qk3 = ""; $qk4 = "";
 if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
 if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
 if ($parmsmax > 2) {$qk4 = " AND ".$tfields[3]."='".$parms[3]."'";}
 $q = $qk1.$qk2.$qk3.$qk4;	
// XBR();XTXT($q);XBR();
 $GLOBALS{'IOERRORcode'} = "IO006"; $GLOBALS{'IOERRORmessage'} = "$q";
 $r = mysqli_query($GLOBALS{'IOSQL'},$q);
 # $tnum = mysqli_affected_rows($GLOBALS{'IOSQL'}); print "affected rows - $tnum<br>\n";
 $noupdate = "1";
 if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 1) {$noupdate = "0";}
 if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 2) {$noupdate = "0";}
# if ($noupdate == "1") {ErrorRoutine();}
}
}

# datatype keys
function Delete_Data () {
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1 = "DELETE FROM ".$tablename." WHERE ".$tfields[0]."='".$rootkey."'";
$qk2 = ""; $qk3 = ""; $qk4 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
if ($parmsmax > 2) {$qk4 = " AND ".$tfields[3]."='".$parms[3]."'";}
$q = $qk1.$qk2.$qk3.$qk4;
# XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO008"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
# $tnum = mysqli_affected_rows($GLOBALS{'IOSQL'}); print "affected rows - $tnum<br>\n";
if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 1) { } else { SilentWarningRoutine(); }
}

function  DeleteAll_Data  () {
# datatype keys	
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; }
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0];}	# forces domainid to be used
# print "DeleteAll_Data - $parmsmax - $parms[0] | $parms[1] | $parms[2] | $tablename <br>\n"; 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1 = "DELETE FROM ".$tablename; 
if ($rootkey != "") {$qk1 = $qk1." WHERE ".$tfields[0]."='".$rootkey."'"; $kindex = $parmsmax+1;} 
else {$kindex = $parmsmax;}
$qk2 = ""; $qk3 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
$q = $qk1.$qk2.$qk3;
# XBR();XTXT($q);XBR();
$GLOBALS{'IOERRORcode'} = "IO009a"; $GLOBALS{'IOERRORmessage'} = "$q";
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
# $tnum = mysqli_affected_rows($GLOBALS{'IOSQL'}); print "affected rows - $tnum<br>\n";
if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 1) { } else { SilentWarningRoutine(); }
# print "DeleteAll_Data - finish<BR>\n";
}

# datatype
function Truncate_Table ($table) {
    $q = "TRUNCATE TABLE ".$table.";";
    # XBR();XTXT($q);XBR();
    $GLOBALS{'IOERRORcode'} = "IO098"; $GLOBALS{'IOERRORmessage'} = "$q";
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_affected_rows($GLOBALS{'IOSQL'}) > 1) { } else { SilentWarningRoutine(); }
    if ($r) { } else { SilentWarningRoutine(); }
}

# datatype
function Initialise_Data ($parm0) {
$tstring = $GLOBALS{$parm0."^FIELDS"}; $tfields = explode('|', $tstring);
foreach ($tfields as $tfieldelement) {
 $GLOBALS{$tfieldelement} = "";	 
}
}

function  Create_Hash  () {
# datatype keys - creates Hash
$trootmax = ""; $hfullk = ""; $hrootk = ""; $tablename = "";  # localise
$htablename = ""; $chk = array(); $ghk = array(); # localise
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $rootkey = $kbits[1]; $tablename = $kbits[0]; $htablename = $kbits[0];}
else {$rootkey = $GLOBALS{'LOGIN_domain_id'}; $tablename = $parms[0]; $htablename = $tablename;}	# forces domainid to be used
$selectflag = "0"; if (strlen(strstr($tablename,"SELECT"))>0) { $tablename = str_replace("SELECT", "", $tablename); $selectflag = "1"; }
// print "Create_Hash - |$parms[0]|$parms[1]|$parms[2]| $tablename - $htablename<br>\n";			 
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$qk1 = "SELECT * FROM ".$tablename; 
if ($rootkey != "") {$qk1 = $qk1." WHERE ".$tfields[0]."='".$rootkey."'"; $kindex = $parmsmax+1;} 
else {$kindex = $parmsmax;}
$qk2 = ""; $qk3 = "";
if ($parmsmax > 0) {$qk2 = " AND ".$tfields[1]."='".$parms[1]."'";}
if ($parmsmax > 1) {$qk3 = " AND ".$tfields[2]."='".$parms[2]."'";}
$q = $qk1.$qk2.$qk3;
// XBR();XTXT($q);XBR();
$hrootk1 = $htablename."^";$hrootk2 = ""; $hrootk3 = ""; 
if ($parmsmax > 0) {$hrootk2 = $parms[1]."^";}
if ($parmsmax > 1) {$hrootk3 = $parms[2]."^";}
$hrootk = $hrootk1.$hrootk2.$hrootk3;
$tistring = ""; $isep = "";
$GLOBALS{'IOERRORcode'} = "IO010"; $GLOBALS{'IOERRORmessage'} = "$q"; 
$row = array();
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
if (mysqli_num_rows($r) > 0) { 
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { 
  $thashstring="";   
  foreach ($row as $element) { $thashstring = $thashstring.$element."|"; }
  $GLOBALS{$hrootk.$row[$kindex]."^"} = $thashstring;
#  XBR();XTXT($hrootk.$row[$kindex]."^"."-".$GLOBALS{$hrootk.$row[$hrowk]."^"});XBR();
  $tistring = $tistring.$isep.$row[$kindex]; $isep = "|";
 }
}
$GLOBALS{$hrootk."INDEX"} = $tistring;
// XBR();XTXT("Create_Hash INDEX created - ".$hrootk."- $tistring");XBR();
}

function Get_Array_Hash () {
# datatype/rootkey - creates array	
$trootmax = ""; $hfullk = ""; $hrootk = ""; $tablename = "";  # localise
$htablename = ""; $chk = array(); $ghk = array(); # localise
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
$trootmax = sizeof($parms)-1;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $tablename = $kbits[0];  $htablename = $tablename;}
else {$tablename = $parms[0]; $htablename = $tablename;}	# forces domainid to be used
$selectflag = "0"; if (strlen(strstr($tablename,"SELECT"))>0) { $tablename = str_replace("SELECT", "", $tablename); $selectflag = "1"; }
$hrootk = $htablename."^"; for ($hi = 1; $hi < $trootmax+1; $hi++) {$hrootk = $hrootk.$parms[$hi]."^";}  
$chk = array(); for ($hi = 0; $hi < 3; $hi++) {if ($hi < $trootmax+1) {array_push ($chk,$parms[$hi]);} } 
# print "Get_Array_Hash - $trootmax - $parms[0] | $parms[1] | $parms[2] | $tablename - $htablename - $hrootk<br>\n";
if (array_key_exists($hrootk."INDEX", $GLOBALS)) {} else {Create_Hash($chk);}
$tkeyarray = array();
$tstring = $GLOBALS{$hrootk."INDEX"}; 
if ($tstring != "") {$tkeyarray = explode('|', $tstring);}
# $str=$hrootk."INDEX"; print "Get_Array_Hash result - $str - $tkeyarray - $chk<br>\n"; 
return $tkeyarray;
}


function Get_Array_Hash_SortSelect () {
# datatype/rootkey sortfieldname selectfieldname selectfieldvalue - creates sorted array	
$trootmax = ""; $hfullk = ""; $hrootk = ""; $tablename = "";  # localise
$htablename = ""; $chk = array(); $ghk = array(); # localise
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
$trootmax = sizeof($parms)-4;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $tablename = $kbits[0]; $htablename = $tablename;}
else {$tablename = $parms[0]; $htablename = $tablename;}	# forces domainid to be used
# print "Get_Array_Hash_SortSelect - $trootmax - $parms[0] | $parms[1] | $parms[2] | $parms[3] | $parms[4] | $parms[5] | $tablename - $htablename<br>\n";
$tsortfieldname = $parms[$trootmax+1];
$tselectfieldname = $parms[$trootmax+2];
$tselectfieldvalue = $parms[$trootmax+3];
// print "Get_SelectArrays_Hash - $tsortfieldname - $tselectfieldname - $tselectfieldvalue<br>\n";
$ghk = array(); for ($hi = 0; $hi < 4; $hi++) {if ($hi < $trootmax+1) {array_push ($ghk,$parms[$hi]);} } 
$t1sortarray = array(); $tarrayelement=""; $tsortstring="";
foreach (Get_Array_Hash($ghk) as $tarrayelement) {	
 # print "Get_Array_Hash_SortSelect - $tarrayelement - $tarrayelement<BR>\n"; 
 $ghk[$trootmax+1] = $tarrayelement;
 Get_Data_Hash($ghk);
 if (($tselectfieldname == "")||($GLOBALS{$tselectfieldname} == $tselectfieldvalue)) {
  $tsortstring = $GLOBALS{$tsortfieldname}." |".$tarrayelement; 
  array_push($t1sortarray, $tsortstring);
 }
}
sort($t1sortarray); $t3sortarray = array();
foreach ($t1sortarray as $tsortstring) {
 $sbits = explode('|', $tsortstring);
 array_push($t3sortarray, $sbits[1]);
}
# print "Get_Array_Hash_SortSelect returns - $t3sortarray <BR>\n";
return $t3sortarray;
}

function Get_Data_Hash () {
# datatype/fullkey SELECT - returns fields
$trootmax = ""; $hfullk = ""; $hrootk = ""; $tablename = ""; # localise
$htablename = ""; $chk = array(); $ghk = array(); # localise
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
$trootmax = sizeof($parms)-2;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $tablename = $kbits[0]; $htablename = $kbits[0];}
else {$tablename = $parms[0]; $htablename = $tablename;}	# forces domainid to be used 
$selectflag = "0"; if (strlen(strstr($tablename,"SELECT"))>0) { $tablename = str_replace("SELECT", "", $tablename); $selectflag = "1"; } 
$hfullk = $htablename."^"; for ($hi = 1; $hi < $trootmax+2; $hi++) {$hfullk = $hfullk.$parms[$hi]."^";}  
$hrootk = $htablename."^"; for ($hi = 1; $hi < $trootmax+1; $hi++) {$hrootk = $hrootk.$parms[$hi]."^";}  
$chk = array(); for ($hi = 0; $hi < 3; $hi++) {if ($hi < $trootmax+1) {array_push ($chk,$parms[$hi]);} } 
# print "Get_Data_Hash 1 - $trootmax - $parms[0] | $parms[1] | $parms[2] | $parms[3] | $tablename - $htablename - $hfullk - $hrootk<br>\n";
if (array_key_exists($hrootk."INDEX", $GLOBALS)) {}  else {Create_Hash($chk);}
$tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
$GLOBALS{'IOWARNING'} = "0";
if (array_key_exists($hfullk,$GLOBALS)) {} else {$GLOBALS{'IOWARNING'} = "1"; return;}
$tobesplit = $GLOBALS{$hfullk};
$hbits = explode('|',$tobesplit);
$fi = 0;
foreach ($tfields as $tfield) {
# print "Get_Data_Hash - $tfield - $hbits[$fi]<br>\n";
 if ($selectflag == "1") {$tstring = "SELECT".$tfield; $GLOBALS{$tstring} = $hbits[$fi];} else {$GLOBALS{$tfield} = $hbits[$fi];}
 $fi++;  	
}
}

function Get_Data_Hash_DateEffective () {
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;	
if (sizeof($parms) == 3) {
 $tdatatype = $parms[0]; 
 $tkey = $parms[1]; 
 $tdate = $parms[2];	
 $tdataa = Get_Array_Hash($tdatatype, $tkey); 
 $dateeffectivekeyfound = "";
 foreach ($tdataa as $tdatak) {
  if ($tdatak <= $tdate) {
   $dateeffectivekeyfound = $tdatak;
  }
 }
 Get_Data_Hash ($tdatatype, $tkey, $dateeffectivekeyfound);
 # print "$tdatatype, $tkey, $tdate, $dateeffectivekeyfound<br>\n";
} else {
 $tdatatype = $parms[0];
 $tdate = $parms[1];	
 $tdataa = Get_Array_Hash($tdatatype); 
 $dateeffectivekeyfound = "";
 foreach ($tdataa as $tdatak) {
  if ($tdatak <= $tdate) {
   $dateeffectivekeyfound = $tdatak;
  }
 }
 Get_Data_Hash ($tdatatype, $dateeffectivekeyfound);
 # print "$tdatatype, $tdate, $dateeffectivekeyfound<br>\n";

}
}

function Get_SelectArrays_Hash () { # CHECK Different than perl
# datatype/rootkey keyfieldname textfieldname sortfieldname selectfieldname selectfieldcondition
$trootmax = ""; $hfullk = ""; $hrootk = ""; $tablename = ""; # localise
$htablename = ""; $chk = array(); $ghk = array(); # localise
$parms = func_get_arg(0);
if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}	
$parmsmax = sizeof($parms)-1;
$trootmax = sizeof($parms)-6;
if (strlen(strstr($parms[0],"_"))>0) { $kbits = explode('_', $parms[0]); $tablename = $kbits[0]; $htablename = $kbits[0];}
else {$tablename = $parms[0]; $htablename = $tablename;}	# forces domainid to be used 
$selectflag = "0"; if (strlen(strstr($tablename,"SELECT"))>0) {$selectflag = "1"; $tablename = str_replace("SELECT", "", $tablename);} 
// print "Get_SelectArrays_Hash - $trootmax - $parms[0] | $parms[1] | $parms[2] | $parms[3] | $parms[4] | $parms[5] | $tablename - $htablename<br>\n";
$tkeyfieldname = $parms[$trootmax+1];
$ttextfieldname = $parms[$trootmax+2];
$tsortfieldname = $parms[$trootmax+3];
$tselectfieldname = $parms[$trootmax+4];
$tselectfieldvalue = $parms[$trootmax+5];
// print "fields - $tkeyfieldname $ttextfieldname $tsortfieldname<BR>\n";
$ghk = array(); for ($hi = 0; $hi < 4; $hi++) {if ($hi < $trootmax+1) {array_push ($ghk,$parms[$hi]);} } 
$tselectkeyarray = array(); $tselecttextarray = array(); 
$t1sortarray = array(); $tarrayelement = ""; $tsortstring = "";
// $ghk[0] = "SELECT".$ghk[0]; # CHECK whole SELECT LOGIC
foreach (Get_Array_Hash($ghk) as $tarrayelement) {	
 $ghk[$trootmax+1] = $tarrayelement;
 Get_Data_Hash($ghk);
// print " tarrayelement - $tarrayelement <BR>\n";
// print "ghk - ";print_r ($ghk);print "<BR>\n";
// if (($tselectfieldname == "")||($GLOBALS{"SELECT".$tselectfieldname} == $tselectfieldvalue)) {
//  $tsortstring = $GLOBALS{"SELECT".$tsortfieldname}."|".$GLOBALS{"SELECT".$tkeyfieldname}."|".$GLOBALS{"SELECT".$ttextfieldname}; 
//  array_push($t1sortarray, $tsortstring);
// }
// print " tarrayelement - $tarrayelement <BR>\n";
// print "ghk - ";print_r ($ghk);print "<BR>\n";
 if (($tselectfieldname == "")||($GLOBALS{$tselectfieldname} == $tselectfieldvalue)) {
  $tsortstring = $GLOBALS{$tsortfieldname}."|".$GLOBALS{$tkeyfieldname}."|".$GLOBALS{$ttextfieldname}; 
  array_push($t1sortarray, $tsortstring);
 } 
}
// print "t1sortarray - ";print_r ($t1sortarray);print "<BR>\n";
sort($t1sortarray);
foreach ($t1sortarray as $tsortstring) {
 $sbits = explode('|', $tsortstring);
 array_push($tselectkeyarray, $sbits[1]);   
 array_push($tselecttextarray, $sbits[2]);
}
return Arrays2Hash ($tselectkeyarray, $tselecttextarray);
// print "SELECTARRAYS $tselecttextarray $tselectkeyarray <BR>\n";
}

function Download_Instructions_Creator () {
    $Q = '"';	
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"Download file produced for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}."\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"Upload Instructions\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"Check 1:- Always include column A and any columns containing $Q Table $Q or $Q Key $Q in the $Q datakeys $Q row.\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"Check 2:- Always include the $Q dataheader $Q row\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"Check 3:- Then select only columns and rows required to be updated.\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"Notes:-,Updates can be controlled by using the following variants of $Q data $Q in column A.\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},",- $Q data $Q (default) changes existing data - or adds it if the key does not exist (better to use data-add!!).\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},",- $Q data-change $Q only changes data if the key currently exists.\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},",- $Q data-add $Q only adds data if the key does not exist.\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},",- $Q data-delete $Q only deletes data if the key currently exists.\n");
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"______________________________________________________________________\n");
}

# datatype
function Download_Data ($tablename) {
    // print "<h1>Download_Data - $tablename</h1>\n";
    Download_Header_Creator($tablename);
    $tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
    $q = "SELECT * FROM ".$tablename." WHERE ".$tfields[0]."='".$GLOBALS{'LOGIN_domain_id'}."'";
    # XBR();XTXT($q);XBR();
    $karray = array(); $ksarray = array(); $row = array();
    $GLOBALS{'IOERRORcode'} = "IO011"; $GLOBALS{'IOERRORmessage'} = "$q";
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_num_rows($r) > 0) { 
     while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
      $kstring = $row[0];
      if ($GLOBALS{$tablename."^KEYS"} > 1) { $kstring = $kstring."|".$row[1]; }
      if ($GLOBALS{$tablename."^KEYS"} > 2) { $kstring = $kstring."|".$row[2]; }
      if ($GLOBALS{$tablename."^KEYS"} > 3) { $kstring = $kstring."|".$row[3]; } 
      array_push ($karray, $kstring); 
     }
     sort($karray);
    }
    foreach ($karray as $karrayelement) {
     $kbits = explode('|', $karrayelement);
     $qk1 = "SELECT * FROM ".$tablename." WHERE ".$tfields[0]."='".$GLOBALS{'LOGIN_domain_id'}."'";
     $qk2 = ""; $qk3 = ""; $qk4 = "";
     if ($GLOBALS{$tablename."^KEYS"} > 1) {$qk2 = " AND ".$tfields[1]."='".$kbits[1]."'";}
     if ($GLOBALS{$tablename."^KEYS"} > 2) {$qk3 = " AND ".$tfields[2]."='".$kbits[2]."'";}
     if ($GLOBALS{$tablename."^KEYS"} > 3) {$qk4 = " AND ".$tfields[3]."='".$kbits[3]."'";} 
     $q = $qk1.$qk2.$qk3.$qk4; 
     // XBR();XTXT($q);XBR();
     $row = array(); $notfirst = "1";
     // $outmessage = "data".'","'.$tablename;
     $outputrowarray = Array();
     array_push($outputrowarray, "data", utf8_decode($tablename));
     
     $GLOBALS{'IOERRORcode'} = "IO012"; $GLOBALS{'IOERRORmessage'} = "$q";
     $r = mysqli_query($GLOBALS{'IOSQL'},$q);
     if (mysqli_num_rows($r) > 0) { 
      $row = mysqli_fetch_array($r, MYSQL_ASSOC);
      foreach ($tfields as $tfieldelement) {
       if ($notfirst != "1") { 
       		// $outmessage = $outmessage.'","'.$row[$tfieldelement];
       		array_push($outputrowarray, utf8_decode($row[$tfieldelement]));
       }
       $notfirst = "0"; 
      }
     }
     else {ErrorRoutine();} 
     // print $outmessage."\n";
     // Write_File ($GLOBALS{'IOFDOWNLOAD'},CSV_Out_Filter('"'.$outmessage.'"')."\n");
     fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));
    }
    Download_Footer_Creator($tablename);
}
    
function Download_Header_Creator ($tablename) {
    # dbname
    Write_File ($GLOBALS{'IOFDOWNLOAD'},"\n");
    
    $outputrowarray = Array();
    array_push($outputrowarray, "datakeys","Table");
    
    for ( $idt = 3; $idt < $GLOBALS{$tablename."^KEYS"}+2; $idt++) {
     array_push($outputrowarray, "Key");
    }
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
    
    $outputrowarray = Array();
    array_push($outputrowarray, "dataheader", $tablename);
    
    $tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
    $notfirst = "1";
    foreach ($tfields as $tfieldelement) {	
     if ($notfirst != "1") {
      $replacedstring = $tablename."_";
      $tfieldelement = str_replace($replacedstring, "", $tfieldelement);	 
      array_push($outputrowarray, utf8_decode($tfieldelement));
     }
     $notfirst = "0";
    }
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
}

function Download_Footer_Creator ($tablename) {
    $outputrowarray = Array();
    array_push($outputrowarray, "dataend", utf8_decode($tablename));
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
}

function CSVClean ($csvrowarray) {
    $outcsvrowarray = Array();
    foreach ($csvrowarray as $csvrowelement) {         
        if (($csvrowelement[0] == "-")||($csvrowelement[0] == "+")) { // excel gets confused with leading plus or minus
            if (is_numeric($csvrowelement)) {}
            else { $csvrowelement = substr($csvrowelement, 1); } // remove first character
        }
        $csvrowelement = str_replace(chr(92).chr(114).chr(92).chr(110),chr(13),$csvrowelement);  // replaces \r\n text e.g from sqldump
        $csvrowelement = str_replace(chr(13).chr(10),chr(13),$csvrowelement);
        // $csvrowelement = str_replace(chr(13).chr(13),chr(13),$csvrowelement);
        $csvrowelement = str_replace("Â£","£",$csvrowelement);       
        
        array_push($outcsvrowarray,$csvrowelement);
    }
    return $outcsvrowarray;
}

function Backup_Domain () {
    $backupmax = 30; // 2 weeks worth
    Check_Folder ( $GLOBALS{'domainfilepath'}."/backup" );
    if ( $GLOBALS{'IOWARNING'} == "1" ) { mkdir($GLOBALS{'domainfilepath'}."/backup", 0777); }
    
    $existingbackupfiles = scandir($GLOBALS{'domainfilepath'}."/backup"); // includes . and ..
    array_shift($existingbackupfiles);
    array_shift($existingbackupfiles);
    while ( count($existingbackupfiles)  >= $backupmax ) {
        unlink($GLOBALS{'domainfilepath'}."/backup/".$existingbackupfiles[0]);
        // XPTXT($existingbackupfiles[0]." deleted");
        array_shift($existingbackupfiles);
    }
    
    $sqlbackupfilename = $GLOBALS{'domainfilepath'}."/backup/sqldatabackup_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".csv";
    $GLOBALS{'IOFDOWNLOAD'} = Open_File_Write ($sqlbackupfilename);
    Download_Instructions_Creator();
    $derror = "0";
    
    
    $tablearray = array();
    $q = 'SHOW TABLES';
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            array_push($tablearray, $row[0]);
        }
    }
    foreach ($tablearray as $tablearrayelement) {
        Download_Data($tablearrayelement);
    }
    
    Close_File_Write ($GLOBALS{'IOFDOWNLOAD'});
}

function Upload_Data ($fullfilename,$testorreal,$extendedtrace) {

// $records = Get_File_Array($fullfilename);		
// foreach ($records as $recordelement) {	
    
$uploadmode = "??";
if ($testorreal == "R") { $uploadmode = "REAL"; }
if ($testorreal == "T") { $uploadmode = "TEST"; }
    
$keyerror = "0";	
if (($handle = fopen($fullfilename, "r")) !== FALSE) {
	while (($uploadcsv = fgetcsv($handle, 0, ",")) !== FALSE) {	
		// $upmessage = CSV_In_Filter($recordelement);
		// print"<P>$upmessage|\n";
		# end of the tidy up
		// $uploadcsv = explode("|",$upmessage);
		# print"<P>array $uploadcsv| ".sizeof(uploadcsv)-1."\n"; 
		
		if ($uploadcsv[0] == "dataheader") {
			$keyerror = "0"; // are there enough keys
			XHR();			
			if (strlen(strstr($uploadcsv[1],'|'))>0) { // paired tables
			    $uploadtablea = explode("|",$uploadcsv[1]);
			    $uploadtable = $uploadtablea[0];
			    $uploadtablepair = $uploadtablea[1];
			} else {
			    $uploadtable = $uploadcsv[1];
			    $uploadtablepair = "";
			}
			XH2($uploadcsv[1]);			
			$uploadcsvheader = $uploadcsv;
			// check that the correct keys have been supplied - Header may either use "tablename_fieldname" or just "fieldname"
			$tstring = $GLOBALS{$uploadtable."^FIELDS"};
			$tfields = explode('|', $tstring);
			if ($GLOBALS{$uploadtable."^KEYS"} >= "2") {
				if (strlen(strstr($tfields[1],$uploadcsvheader[2]))>0) {} else { $keyerror = "1"; }
			}		
			if ($GLOBALS{$uploadtable."^KEYS"} >= "3") { 
				if (strlen(strstr($tfields[2],$uploadcsvheader[3]))>0) {} else { $keyerror = "1"; }
			}
			if ($GLOBALS{$uploadtable."^KEYS"} >= "4") { 
				if (strlen(strstr($tfields[3],$uploadcsvheader[4]))>0) {} else { $keyerror = "1"; }
			}
			if ( $keyerror == "0" ) {
				// XPTXTCOLOR("Correct keys supplied for table - ".$uploadcsv[1],"green");
			    XDIV("reportdiv_".$uploadtable,"container");
			    XTABLEJQDTID("reporttable_".$uploadtable);
				XTHEAD();
				XTRJQDT();
				if ( $extendedtrace == "Yes" ) {
    				XTDHTXT("");
    				for ($ui = 2; $ui < sizeof($uploadcsvheader); $ui++) {
    				    if ($uploadcsvheader[$ui] != "") {
    				        XTDHTXT($uploadcsvheader[$ui]);    
    				    } 
    				}
    				XTDHTXT("Action");				    				    
				} else {
				    XTDHTXT("Mode");
				    for ($ui = 0; $ui < $GLOBALS{$uploadtable."^KEYS"}-1; $ui++) {
				        XTDHTXT($uploadcsvheader[$ui]);
				    }
				    XTDHTXT("Action");					    
				}
				X_TR();
				X_THEAD();
				XTBODY();
			} else {
				XPTXTCOLOR("Incorrect keys supplied for table - ".$uploadcsv[1],"red");
			}	
		}  		

		if ($keyerror == "0") {
			if (($uploadcsv[0] == "data")||
			 	($uploadcsv[0] == "data-add")||
			 	($uploadcsv[0] == "data-change")||
			 	($uploadcsv[0] == "data-delete")) { 
			 	    
			 	$currdataa = Array();    
			 	$newdataa = Array();
			 	$errordataa = Array();
				$ghk = array();
				for ($hi = 1; $hi < $GLOBALS{$uploadtable."^KEYS"}+1; $hi++) { array_push ($ghk,$uploadcsv[$hi]); } 
				// XBR();print_r($ghk);
				$ghk[0] = $uploadtable; Initialise_Data($ghk[0]); Check_Data($ghk);
				$allfields = $GLOBALS{$uploadtable."^FIELDS"};
				if ($GLOBALS{'IOWARNING'} == "0") {$dataexists = "1";} else {$dataexists = "0";}
				if (($uploadtablepair != "" )&&($dataexists == "1")) { 
				    $ghk[0] = $uploadtablepair; Initialise_Data($ghk[0]); Check_Data($ghk);
				    $allfields = $allfields."|".$GLOBALS{$uploadtablepair."^FIELDS"};
				    if ($GLOBALS{'IOWARNING'} == "0") {$dataexists = "1";} else {$dataexists = "0";}
				}
				$fieldschanged = 0;
				
				// ======= Update the database =============
				for ($ui = 2; $ui < sizeof($uploadcsvheader); $ui++) {
				    $thisfieldval = utf8_encode($uploadcsv[$ui]);
				    if ($uploadcsvheader[$ui] != "") { // updates requested
				        if (strlen(strstr($uploadcsvheader[$ui],"_"))>0) {
				            # full field name
				            $thisfieldname = $uploadcsvheader[$ui];
				            $fbits = explode('_', $tstring);
				            $thistable = $fbits[0];				            
    					} else {
    						# part field name
    					    $thisfieldname = $uploadtable."_".$uploadcsvheader[$ui];
    					    $thistable = $uploadtable;	
    					}
    					if (strlen(strstr($allfields,$thisfieldname))>0) {
    					    array_push($currdataa, $GLOBALS{$thisfieldname});
    					    if ($thisfieldval != $GLOBALS{$thisfieldname}) { $fieldschanged++; }
    					    $oldvalue = $GLOBALS{$thisfieldname};
    					    $GLOBALS{$thisfieldname} = $thisfieldval;
    					    array_push($newdataa, $thisfieldval);
    					    array_push($errordataa, "0");	    
    					    if (array_key_exists($thistable."_massupdatelog", $GLOBALS)) {
    					        $GLOBALS{$thistable.'_massupdatelog'} = AddToMassUpdateLog($GLOBALS{$thistable.'_massupdatelog'}, $thisfieldname, $oldvalue, $thisfieldval);
    					    }
    					} else {
					        array_push($currdataa, $GLOBALS{$thisfieldname});
					        array_push($newdataa, "FIELD ERROR");
					        array_push($errordataa, "1");
    					}
				    } else { // no updates requested
		                // array_push($currdataa, "");
		                // array_push($newdataa, $thisfieldval);
		                // array_push($errordataa, "0");
				    }
				}
				
				// ======= set the trace text and write out the updated database records=============
				$uploaderrormsg = "";
				$uploadwarningmsg = "";
				$uploadactiontaken = "";
				if ($testorreal == "R") {
				    if (($fieldschanged > 0 )||($uploadcsv[0] == "data-delete")) {
				        $ghk[0] = $uploadtable;
				        if (array_key_exists($uploadtable."_lastupdatetimestamp", $GLOBALS)) {
				            $GLOBALS{$uploadtable."_lastupdatetimestamp"} = $GLOBALS{'currenttimestamp'};
				            $GLOBALS{$uploadtable."_lastupdatepersonid"} = $GLOBALS{'LOGIN_person_id'};
				            $GLOBALS{$uploadtable."_lastupdatetype"} = "Upload";
				        }
    					if ($uploadcsv[0] == "data") {
    						if ($dataexists == "1") {
    						    Write_Data($ghk);
    						    if ($uploadtablepair != "" ) { $ghk[0] = $uploadtablepair; Write_Data($ghk); }
    						    $uploadactiontaken = "data-changed successfully";
    						} else {
    						    Write_Data($ghk);
    						    if ($uploadtablepair != "" ) { $ghk[0] = $uploadtablepair; Write_Data($ghk); }
    						    $uploadactiontaken = "data-added successfully";   						    
    						}
    					}
    					if ($uploadcsv[0] == "data-add") {
    					    if ($dataexists == "1") {
    					        $uploaderrormsg = "ERROR - data already exists, ";
    					        $uploadactiontaken = "cannot be added. ";
    					    } else {
    						    Write_Data($ghk);
    						    if ($uploadtablepair != "" ) { $ghk[0] = $uploadtablepair; Write_Data($ghk); }
    						    $uploadactiontaken = "data-added successfully";
    						}
    					}
    					if ($uploadcsv[0] == "data-change") {
    						if ($dataexists == "1") {
    						    Write_Data($ghk);
    						    if ($uploadtablepair != "" ) { $ghk[0] = $uploadtablepair; Write_Data($ghk); }
    						    $uploadactiontaken = "data-changed successfully";
    						} else {
    						    $uploaderrormsg = "ERROR - data does not already exist, ";
    						    $uploadactiontaken = "cannot be changed. ";
    						}
    					}
    					if ($uploadcsv[0] == "data-delete") {
    						if ($dataexists == "1") {
    						    Delete_Data($ghk);
    						    if ($uploadtablepair != "" ) { $ghk[0] = $uploadtablepair; Delete_Data($ghk); }
    						    $uploadactiontaken = "data-deleted successfully";
    						} else {
    						    $uploaderrormsg = "ERROR - data does not already exist, ";
    						    $uploadactiontaken = "cannot be deleted. ";
    						}
    					}
				    } else {
				         if ($uploadcsv[0] == "data") {
				             $uploadwarningmsg = "No changes required. ";
				         }
				         if ($uploadcsv[0] == "data-add") {
				             $uploadwarningmsg = "No changes required. ";
				             if ($dataexists == "1") {$uploaderrormsg = "ERROR - data already exists. ";}
				         }
				         if ($uploadcsv[0] == "data-change") {
				             $uploadwarningmsg = "No changes required. ";
				             if ($dataexists == "1") {}
				             else {$uploaderrormsg = "ERROR - data does not already exist. "; }
				         }
				         if ($uploadcsv[0] == "data-delete") {
				             if ($dataexists == "1") {}
				             else {$uploaderrormsg = "ERROR - data does not already exist. ";}
				         }
				    }        
				} else {				    
				    if (($fieldschanged > 0 )||($uploadcsv[0] == "data-delete")) {
    					if ($uploadcsv[0] == "data") {
    						if ($dataexists == "1") {$uploadactiontaken = "data-change would be successful";}
    						else {$uploadactiontaken = "data-add would be successful";}
    					}
    					if ($uploadcsv[0] == "data-add") {
    						if ($dataexists == "1") {$uploaderrormsg = "ERROR - data already exists, ";$uploadactiontaken = "would not be added. ";}
    						else {$uploadactiontaken = "data-add would be successful";}
    					}
    					if ($uploadcsv[0] == "data-change") {
    						if ($dataexists == "1") {$uploadactiontaken = "data-change would be successful";}
    						else {$uploaderrormsg = "ERROR - data does not already exist, ";$uploadactiontaken = "would not be changed. ";}
    					}
    					if ($uploadcsv[0] == "data-delete") {
    						if ($dataexists == "1") {$uploadactiontaken = "data-delete would be successful";}
    						else {$uploaderrormsg = "ERROR - data does not already exist, ";$uploadactiontaken = "would not be deleted. ";}
    					}
				    } else {
				        if ($uploadcsv[0] == "data") {
				            $uploadwarningmsg = "No changes required. ";
				        }
				        if ($uploadcsv[0] == "data-add") {
				            $uploadwarningmsg = "No changes required. ";
				            if ($dataexists == "1") {$uploaderrormsg = "ERROR - data already exists. "; }
				            else {}
				        }
				        if ($uploadcsv[0] == "data-change") {
				            $uploadwarningmsg = "No changes required. ";
				            if ($dataexists == "1") {}
				            else {$uploaderrormsg = "ERROR - data does not already exist. "; }
				        }
				        if ($uploadcsv[0] == "data-delete") {
				            if ($dataexists == "1") { $uploadactiontaken = "data-delete would be successful"; }
				            else { $uploaderrormsg = "ERROR - data does not already exist. ";}
				        }
				    }   
				}
				
				// ======= write out to the trace table =============
				if ( $extendedtrace == "Yes" ) {
				    XTR();
				    XTDTXT($uploadcsv[0]);
				    for ($di = 0; $di < sizeof($newdataa); $di++) {	
				        if ($uploadcsvheader[$di+2] != "") {
				            if ($errordataa[$di] == "0") {
        				        if ($newdataa[$di] != $currdataa[$di]) { XTDTXTCOLOR($newdataa[$di],"#3679B7"); } // change
        				        else { XTDTXT($newdataa[$di]); } // no change
				            } else {
				                XTDTXTCOLOR($newdataa[$di],"red");				            
				            }
				        } else {
				            // XTDTXTCOLOR($newdataa[$di],"lightgray"); // no action required
				        }				        
				    }
				    if ( $uploaderrormsg == "" ) {
				        if ( $uploadwarningmsg == "" ) { XTDTXTCOLOR($uploaderrormsg.$uploadwarningmsg.$uploadactiontaken,"#3679B7"); }
				        else { XTDTXT($uploaderrormsg.$uploadwarningmsg.$uploadactiontaken); }
				    }
				    else { XTDTXTCOLOR($uploaderrormsg.$uploadwarningmsg.$uploadactiontaken,"red"); }				    
				    X_TR();
				    if ($dataexists == "1") {
    				    XTR();
    				    XTDTXTCOLOR("Existing","silver");
    				    for ($di = 0; $di < sizeof($currdataa); $di++) {
    				        if ($uploadcsvheader[$di+2] != "") {
    				            XTDTXTCOLOR($currdataa[$di],"silver"); // action required
    				        } else {
    				            // XTDTXTCOLOR($currdataa[$di],"lightgray"); // no action required
    				        }	
    				    }
    				    XTDTXTCOLOR("","silver");
    				    X_TR();
				    } 
				} else {
				    XTR();
				    XTDTXT($uploadcsv[0]);
				    for ($di = 0; $di < $GLOBALS{$uploadtable."^KEYS"}-1; $di++) {
				        XTDTXT($newdataa[$di]);
				    }
				    if ( $uploaderrormsg == "" ) {
				        if ( $uploadwarningmsg == "" ) { XTDTXTCOLOR($uploaderrormsg.$uploadwarningmsg.$uploadactiontaken,"#3679B7"); }
				        else { XTDTXT($uploaderrormsg.$uploadwarningmsg.$uploadactiontaken); }
				    }
				    else { XTDTXTCOLOR($uploaderrormsg.$uploadwarningmsg.$uploadactiontaken,"red"); }
				    X_TR();
				}				
			}
		}
		
		if ($uploadcsv[0] == "dataend") { 
			# XBR();XTXT("dataend - $uploadcsv[1]");XBR();
		    X_TBODY();
		    X_TABLE();
		    X_DIV("reportdiv_".$uploadtable);
		    XCLEARFLOAT();
		    if ($GLOBALS{$uploadtable."^KEYS"} >= "4") {
		        XINHID($uploadtable."_sortcol","1,2,3,0");
		        XINHID($uploadtable."_sortseq","asc,asc,asc,desc");
		    } else {
		        if ($GLOBALS{$uploadtable."^KEYS"} >= "3") {
		            XINHID($uploadtable."_sortcol","1,2,0");
		            XINHID($uploadtable."_sortseq","asc,asc,desc");
    		    } else {
    		        if ($GLOBALS{$uploadtable."^KEYS"} >= "2") {
    		            XINHID($uploadtable."_sortcol","1,0");
    		            XINHID($uploadtable."_sortseq","asc,desc");
        		    }	        
    		    } 
		    }
		} 
	}
}
}

function CSV_In_Filter ($parm0) {
# remove newline
$instring  = trim($parm0);
$instring  = str_replace('|', '', $instring); // remove pipe characters just in case
// $rne = chr(92).chr(114).chr(92).chr(110); $rnr = "\r";
// $instring = str_replace($rne, $rnr, $instring);
// $instring = preg_replace('/\x5C\x72\x5C\x6E/', "\r", $instring);
# drop all quotes except for quote pairs - replace separating commas by # - remove CR & LF	
# Commas following odd quotes are retained as commas
# Commas following even quotes are turned into #
# Odd quotes are kept except following a comma or if first
$bits = str_split($instring);
$oddevenquote = "EVEN"; $lastbit = ",";
$outstring = "";
$CR = chr(13); $LF = chr(10);
foreach ($bits as $bit) {
 $outbit = $bit;
 if ($bit == '"') {if ($oddevenquote == "0DD") {$oddevenquote = "EVEN";} else {$oddevenquote = "0DD";}}
 if (($bit == ",")&&($oddevenquote == "EVEN")) {$outbit = "|";}   
 if ($bit == '"') {if (($oddevenquote == "0DD")&&($lastbit != ",")) {} else {$outbit = "";}}
 if (($bit == $CR) || ($bit == $LF)) {$outbit = "";}
 $outstring = $outstring.$outbit;
 $lastbit = $bit;
}
return $outstring;
}

function AddToMassUpdateLog($mulog, $fieldname, $oldvalue, $newvalue) {
    // field1[oldval|newval]^field2[oldval|newval]
    $newmulog = "";
    $musep = "";
    $muloga = Array();
    if (strlen(strstr($mulog,"^")) > 0) {
        $muloga = explode("^",$mulog);
    }
    $found = "0";
    foreach ( $muloga as $mulogelement) {
        $mubits1 = explode("[",$mubit);
        $mubits2 = explode("]",$mubits1[1]);
        $mubits3 = explode("|",$mubits2[0]);
        $tfieldname = $mubits1[0];
        $toldvalue = $mubits3[0];
        $tnewvalue = $mubits3[1];
        if ( $fieldname == $tfieldname ) {
            $newmulog = $newmulog.$musep.$fieldname."[".$oldvalue."|".$newvalue."]";
            $musep = "^";
        } else {
            $newmulog = $newmulog.$musep.$tfieldname."[".$toldvalue."|".$tnewvalue."]";
            $musep = "^";
        }
    }
    if ( $found == "0" ) {
        $newmulog = $newmulog.$musep.$fieldname."[".$oldvalue."|".$newvalue."]";
        $musep = "^";
    }
    return $newmulog;
}

function Download_File ($fullPath,$action) {
	$mime = array( "gif"=>"image/gif", "jpg"=>"image/jpeg", "jpeg"=>"image/jpeg", "png"=>"image/png" , "bmp"=>"image/bmp" ,
	"doc"=>"application/msword", "rtf"=>"application/rtf", "pdf"=>"application/pdf", "zip"=>"application/zip", "csv"=>"application/csv",
	"txt"=>"text/plain" ); 
	if (file_exists($fullPath)) { 
		 $fd = fopen ($fullPath, "r");
		 $fsize = filesize($fullPath);
		 $path_parts = pathinfo($fullPath);
		 $ext = strtolower($path_parts["extension"]);
		 header("Content-type: ".$mime{$ext}); 
		 header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); 
		 header("Content-length: $fsize");
		 header("Cache-control: private"); //use this to open files directly
		 while(!feof($fd)) {
			  $buffer = fread($fd, 2048);
			  echo $buffer;
		 }
		 fclose ($fd);
		 if ($action == "delete") { unlink($fullPath); } 
	} else {
		 XH3("Sorry: Download no longer available");
	}
	exit;
}

function Download_File_Link ($parm0) {
XLINKTXT($parm0,"download");
}

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>