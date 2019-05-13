<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Dmws_DMWSDATEFIX_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Dmws_DMWSDATEFIX_Output("Real");

Back_Navigator();
PageFooter("Default","Final");
?>

