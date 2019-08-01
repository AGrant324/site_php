<?php # personloginout.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();GlobalRoutine();

$targettemplate = "Default";
Check_Data('template', "Final", "Login");
if ($GLOBALS{'IOWARNING'} == "0") { $targettemplate = "Login"; }


PageHeader($targettemplate,"Final");
Check_Data("person",$GLOBALS{'LOGIN_person_id'});

if ($GLOBALS{'IOWARNING'} == "0") {
	$GLOBALS{'person_session'} = "";
	$GLOBALS{'LOGIN_session_id'} = "";
	Write_Data("person",$GLOBALS{'LOGIN_person_id'});
	XPTXTCOLOR("Thank You, You have now logged out successfully.","green");
        
        Person_Login_Output();
        
} else {
	XH3("Already Logged Out.");
}


$GLOBALS{'LOGIN_session_id'} = "";
$GLOBALS{'LOGIN_person_id'} = "";

PageFooter($targettemplate,"Final");
?>