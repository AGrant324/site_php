<?php # persontrainingout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Person_Login_Output();

Back_Navigator();
PageFooter("Default","Final");

?>