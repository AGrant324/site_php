<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Cor_CORSITECLASSIFY_Output("R");

Back_Navigator();
PageFooter("Default","Final");
?>

