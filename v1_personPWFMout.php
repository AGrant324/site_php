<?php # personloginout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_PWF_CSSJS();
PageHeader("Default","Final");
// This routine does not require login
Back_Navigator();

Person_PWF_Output();

Back_Navigator();
PageFooter("Default","Final");


?>