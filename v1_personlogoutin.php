<?php # personloginout.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
Get_Common_Parameters();GlobalRoutine();
PageHeader("Default","Final");
Check_Data("person",$GLOBALS{'LOGIN_person_id'});
if ($GLOBALS{'IOWARNING'} == "0") {
	$GLOBALS{'person_session'} = "";
	$GLOBALS{'LOGIN_session_id'} = "";
	Write_Data("person",$GLOBALS{'LOGIN_person_id'});
	XH3("Thank You, You have now logged out successfully.");
} else {
	XH3("Already Logged Out.");
}
$GLOBALS{'LOGIN_session_id'} = "";
$GLOBALS{'LOGIN_person_id'} = "";
PageFooter("Default","Final");
?>