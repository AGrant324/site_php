<?php # personDM2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();
$deleteperson_id = $_REQUEST['ActionPersonId'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


XH2("Person Deletion");
Check_Data("person",$deleteperson_id);
if ($GLOBALS{'IOWARNING'} == "0") {
   
   XH3('Are you sure you want to delete all records for "'.$deleteperson_id.'" - '.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}); 

   XFORM("personDELETECONFIRMin.php","personDELETECONFIRM");
   XINSTDHID();
   XINHID("ActionPersonId",$deleteperson_id);
   XINSUBMIT("Confirm Deletion");   
   
} else { XPTXT("$deleteperson_id - not found."); }

XINBUTTONCLOSEWINDOW("Cancel");
PopUpFooter();

?>
