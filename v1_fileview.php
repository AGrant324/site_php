<<<<<<< HEAD
 <?php # fileview.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();
# Get_Data("person",$GLOBALS{'LOGIN_person_id'});
# Check_Session_Validity();

PopUpHeader();


// This routine allows visibility of files that are not in the www directory
$filepath = $_REQUEST["FilePath"];
$filename = $_REQUEST["FileName"];

// The following avoids mod security issues because of ../../
$filepath = expandSymbolicPath($filepath);

# XH3("fileview called - $filepath - $filename");

$displayfilesrc = "";
$filebits = explode('.',$filename);
$filetype = $filebits[1];	
$timeparts = explode(" ",microtime());
$currenttime = bcadd(($timeparts[0]*1000),bcmul($timeparts[1],1000));
$filename2 = $currenttime.".".$filetype;
$filepathto = $GLOBALS{'domainwwwpath'}."/domain_temp"; 
# XH3($filepath." - ".$filename." to ".$filepathto." - ".$filename2); 
if (($filename != "")&&($filename2 != "")&&(file_exists($filepath."/".$filename))) {
  copy($filepath."/".$filename, $filepathto."/".$filename2);
  $displayfilesrc = $GLOBALS{'domainwwwurl'}."/domain_temp/".$filename2;  
} else { 
  XH3("$filename not found ");
  $displayfilesrc = "";  
} 	


XTABLEINVISIBLE();
XTRINVISIBLE();XTD();XTXTID($nameroot."_filename","");X_TD();X_TR();
$filefilebits = explode('/', $filename);

if ((file_exists($filepath."/".$filename))&&(strlen(strstr($filefilebits[sizeof($filefilebits)-1],"."))>0)) {
 $filebits = explode('.',$filefilebits[sizeof($filefilebits)-1]);
 $filetype = $filebits[1];
 $filetypeidentified = "0";
 if (($filetype == "pdf")||($filetype == "pdf")) {
  XTRINVISIBLE();XTD();
  XOBJECTID("viewfile",$displayfilesrc,"300","","");
  X_TD();X_TR(); 
  $filetypeidentified = "1";
 }	
 if (($filetype == "jpg")||($filetype == "JPG")||
     ($filetype == "jpeg")||($filetype == "JPEG")|| 	
     ($filetype == "gif")||($filetype == "GIF")|| 	
     ($filetype == "png")||($filetype == "PNG")) {	
  list($owidth, $oheight) = getimagesize("http:".$displayfilesrc);
  $width = $thumbwidth; $height = $oheight*$thumbwidth/$owidth;
  XTRINVISIBLE();XTD();
  XIMGID($nameroot."_image",$displayfilesrc,$owidth,$oheight,"");
  X_TD();X_TR();
  $filetypeidentified = "1";    
 }
 if ($filetypeidentified == "0") {
  XTRINVISIBLE(); XTDTXT("Cannot Display File"); X_TR(); 	
 } 
} else {	
 XTRINVISIBLE();XTD();
 XIMGID($nameroot."_image",$GLOBALS{'site_asseturl'}."/nofile.gif","","","");
 X_TD();X_TR();
 XTRINVISIBLE();XTD();
 XOBJECTID($nameroot."_object","","0","0","");
 X_TD();X_TR();    
}

PopUpFooter();

=======
 <?php # fileview.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();
# Get_Data("person",$GLOBALS{'LOGIN_person_id'});
# Check_Session_Validity();

PopUpHeader();


// This routine allows visibility of files that are not in the www directory
$filepath = $_REQUEST["FilePath"];
$filename = $_REQUEST["FileName"];

// The following avoids mod security issues because of ../../
$filepath = expandSymbolicPath($filepath);

# XH3("fileview called - $filepath - $filename");

$displayfilesrc = "";
$filebits = explode('.',$filename);
$filetype = $filebits[1];	
$timeparts = explode(" ",microtime());
$currenttime = bcadd(($timeparts[0]*1000),bcmul($timeparts[1],1000));
$filename2 = $currenttime.".".$filetype;
$filepathto = $GLOBALS{'domainwwwpath'}."/domain_temp"; 
# XH3($filepath." - ".$filename." to ".$filepathto." - ".$filename2); 
if (($filename != "")&&($filename2 != "")&&(file_exists($filepath."/".$filename))) {
  copy($filepath."/".$filename, $filepathto."/".$filename2);
  $displayfilesrc = $GLOBALS{'domainwwwurl'}."/domain_temp/".$filename2;  
} else { 
  XH3("$filename not found ");
  $displayfilesrc = "";  
} 	


XTABLEINVISIBLE();
XTRINVISIBLE();XTD();XTXTID($nameroot."_filename","");X_TD();X_TR();
$filefilebits = explode('/', $filename);

if ((file_exists($filepath."/".$filename))&&(strlen(strstr($filefilebits[sizeof($filefilebits)-1],"."))>0)) {
 $filebits = explode('.',$filefilebits[sizeof($filefilebits)-1]);
 $filetype = $filebits[1];
 $filetypeidentified = "0";
 if (($filetype == "pdf")||($filetype == "pdf")) {
  XTRINVISIBLE();XTD();
  XOBJECTID("viewfile",$displayfilesrc,"300","","");
  X_TD();X_TR(); 
  $filetypeidentified = "1";
 }	
 if (($filetype == "jpg")||($filetype == "JPG")||
     ($filetype == "jpeg")||($filetype == "JPEG")|| 	
     ($filetype == "gif")||($filetype == "GIF")|| 	
     ($filetype == "png")||($filetype == "PNG")) {	
  list($owidth, $oheight) = getimagesize("http:".$displayfilesrc);
  $width = $thumbwidth; $height = $oheight*$thumbwidth/$owidth;
  XTRINVISIBLE();XTD();
  XIMGID($nameroot."_image",$displayfilesrc,$owidth,$oheight,"");
  X_TD();X_TR();
  $filetypeidentified = "1";    
 }
 if ($filetypeidentified == "0") {
  XTRINVISIBLE(); XTDTXT("Cannot Display File"); X_TR(); 	
 } 
} else {	
 XTRINVISIBLE();XTD();
 XIMGID($nameroot."_image",$GLOBALS{'site_asseturl'}."/nofile.gif","","","");
 X_TD();X_TR();
 XTRINVISIBLE();XTD();
 XOBJECTID($nameroot."_object","","0","0","");
 X_TD();X_TR();    
}

PopUpFooter();

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>