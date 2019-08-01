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


XH3("Person deletion");
Check_Data("person",$deleteperson_id);
if ($GLOBALS{'IOWARNING'} == "0") {
   Delete_Data("person",$deleteperson_id);
   XH3('Confirmation: All records for "'.$deleteperson_id.'" - '.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.' have been successfully deleted.');
   $qualificationa = Get_Array('personqualification',$deleteperson_id);
   foreach ($qualificationa as $qualification_id) {
		Delete_Data('personqualification',$deleteperson_id, $qualification_id); 
		XH5("Qualification ".$qualification_id." - deleted");
   }
   $jobrolea = Get_Array('personjobrole',$deleteperson_id);
   foreach ($jobrolea as $jobrole_id) {
   		Delete_Data('personjobrole',$deleteperson_id, $jobrole_id);
   		XH5("Jobrole ".$jobrole_id." - deleted");   		
   }
} else { XPTXT("$deleteperson_id - not found."); }
XBR();
XINBUTTONCLOSEWINDOW("Close");
PopUpFooter();

?>
