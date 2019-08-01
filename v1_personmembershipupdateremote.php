<?php # personmassdetails.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Get_Person_Authority();

Person_MEMBERSHIPUPDATEREMOTE_Output ();


# Back_Navigator();
PageFooter("Default","Final");

?>
