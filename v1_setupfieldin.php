<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
GenericHandler_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$infield_table = $_REQUEST["field_table"];

Report_SETUPTABLEFIELD_Output($infield_table);

Back_Navigator();
PageFooter("Default","Final");

?>