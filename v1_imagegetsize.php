<<<<<<< HEAD
<?php # getimagesize.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

# print "getimagesize called";

$imagefile = $_REQUEST["ImageFile"];
// The following avoids mod security issues because of ../../ etc
$imagefile = expandSymbolicPath($imagefile);
$imagefilebits = explode('/', $imagefile);
if ((file_exists($imagefile))&&(strlen(strstr($imagefilebits[sizeof($imagefilebits)-1],"."))>0)) {
 list($width, $height) = getimagesize($imagefile);
 $error = "0";
 $message = "Image Found";
} else {
 $width = 0; $height= 0;
 $error = "1";
 $message = "Image Not Found";
} 
print "$error|$message|$width|$height";

=======
<?php # getimagesize.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

# print "getimagesize called";

$imagefile = $_REQUEST["ImageFile"];
// The following avoids mod security issues because of ../../ etc
$imagefile = expandSymbolicPath($imagefile);
$imagefilebits = explode('/', $imagefile);
if ((file_exists($imagefile))&&(strlen(strstr($imagefilebits[sizeof($imagefilebits)-1],"."))>0)) {
 list($width, $height) = getimagesize($imagefile);
 $error = "0";
 $message = "Image Found";
} else {
 $width = 0; $height= 0;
 $error = "1";
 $message = "Image Not Found";
} 
print "$error|$message|$width|$height";

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>