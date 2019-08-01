<?php # personMMin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_Mass_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$massupdateselect = $_REQUEST['MassUpdateSelect'];
$section = $_REQUEST['Section'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


if ($section == "") {
 print "<h5>No section selected - please retry";
} else {
 $marker = 0;
 Person_Mass_Output();
}

Back_Navigator();
PageFooter("Default","Final");

?>
