<?php # personNEWMAILout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
// This routine does not require login
Back_Navigator();

Person_NEWEMAIL_Output();

Back_Navigator();
PageFooter("Default","Final");

?>