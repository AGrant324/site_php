<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');

Get_Common_Parameters();
GlobalRoutine();Cor_CORSITEUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$incorsite_id = $_REQUEST['corsite_id'];
$incorsite_version = $_REQUEST['corsite_version'];
if((isset($_REQUEST['corsite_corprogramme'])&&$_REQUEST['corsite_corprogramme']!="")) {$incorsite_corprogramme = $_REQUEST["corsite_corprogramme"];} else {$incorsite_corprogramme ="";}
Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Cor_CORSITEUPDATE_Output($incorsite_id,$incorsite_version,$incorsite_corprogramme,"LOC");

Back_Navigator();PageFooter("Default","Final");
?>

