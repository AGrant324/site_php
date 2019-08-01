<?php # actionsviewout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_actionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Action_TODOVIEWLIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Action_TODOVIEWLIST_Output("");

Back_Navigator();
PageFooter("Default","Final");

?>
