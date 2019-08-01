<?php # personDM2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
person_CHANGE_CSSJS();
PopUpHeader();
// PageHeader("Default","Final");
// Back_Navigator();

Check_Session_Validity();
$changeperson_id = $_REQUEST['ActionPersonId'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


Check_Data("person",$changeperson_id);
if ($GLOBALS{'IOWARNING'} == "0") {
 	person_CHANGE_Output($changeperson_id);   
} else { 
	XH2("Person Update");
	XPTXT("$changeperson_id - not found."); 
}

XBR();
XINBUTTONCLOSEWINDOW("Cancel");
PopUpFooter();
// PageFooter("Default","Final");

?>
