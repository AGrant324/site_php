<?php # personAMin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_NEWREG_CSSJS();
PageHeader("Default","Final");
// This routine does not require login

Person_NEWREG_Output("REG","","","");


PageFooter("Default","Final");

?>