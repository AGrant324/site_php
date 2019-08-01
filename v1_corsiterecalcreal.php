<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Cor_CORSITERECALC_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$incorsite_id = $_REQUEST['corsite_id'];
$incorsite_version = $_REQUEST['corsite_version'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Cor_CORSITERECALC_Output("Real");

Back_Navigator();
PageFooter("Default","Final");
?>

