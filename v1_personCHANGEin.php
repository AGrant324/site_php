<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_CHANGE_CSSJS();
PopUpHeader();
// PageHeader("Default","Final");
// Back_Navigator();


Check_Session_Validity();
Get_Data("person",$GLOBALS{'LOGIN_person_id'});


$changeperson_id = $_REQUEST['ActionPersonId'];
Get_Data("person",$changeperson_id);

Person_Form2Globals();
$GLOBALS{'person_lastupdate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}."-".$GLOBALS{'LOGIN_person_id'};
Write_Data("person",$changeperson_id);
Finalise_TempImages ($GLOBALS{'domainfilepath'}."/personphotos",$GLOBALS{'person_photo'});

XPTXTCOLOR("Updates Completed","green");
Person_CHANGE_Output($changeperson_id);

 
if ($GLOBALS{'LOGIN_session_id'} == "qpg".$GLOBALS{'LOGIN_person_id'}."ftn") {
 XH3("Press Update to make changes, check the results, and then close this browser window when you have finished.... Thanks");	
} else {
 XBR();XBR();	
}
XINBUTTONCLOSEWINDOW("Close");
PopUpFooter();
// PageFooter("Default","Final");

?>


