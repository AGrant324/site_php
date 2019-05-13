<?php # personPWRin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_PWR2_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$changeperson_id = $_REQUEST['ActionPersonId'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

Check_Data("person",$changeperson_id);
if ($GLOBALS{'IOWARNING'} == "0") {
  Person_PWR2_Output($changeperson_id);
} else {
  print "<P>Warning - Personal Id $Q$changeperson_id$Q does not exist\n";
}

Back_Navigator();
PageFooter("Default","Final");


?>
