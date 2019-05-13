<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
if ($GLOBALS{'LOGIN_loginmode_id'} == "0") { Get_Data("person_".$GLOBALS{'LOGIN_service_id'},$GLOBALS{'LOGIN_person_id'}); }
else {Get_Data("person",$GLOBALS{'LOGIN_person_id'}); }

$maxfilesize = "100000";
$continuewithupload  = "1";
# uploadname filepath filename allowdfiletypes maxsize add/update prefix
$uploadstring = Upload_File("FileUploadName",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"","text/csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
# Error(1/0)|Message|filename|filesize|width|height
# print $uploadstring;
$uploadstringa = explode("|",$uploadstring);
$uploadfilename = $uploadstringa[2];
if ($uploadstringa[0] == "1") {
	$continuewithupload  = "0";
}
if ($continuewithupload  == "1") {
 $records = Get_File_Array ($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$_FILES["FileUploadName"]["name"]);
 $datastring = "";
 foreach ($records as $recordelement) {
  if ($recordelement != "") {
   $datastring = CSV_In_Filter($recordelement);
   print $datastring."^";  	
  } 
 }
}

?>


