<?php # personAMin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$limode = $_REQUEST['LIMode'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Person_LI_Output();

Back_Navigator();
PageFooter("Default","Final");

?>