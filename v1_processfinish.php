<?php # personloginout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_processroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_Login_Select_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$processtemplate_id = $_REQUEST['processtemplate_id'];

Process_ReSequence($processtemplate_id);
Get_Person_Authority();
Person_Login_Select_Output();

Back_Navigator();
PageFooter("Default","Final");

?>