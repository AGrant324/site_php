<?php # finallocatebank1.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Fin_ALLOCATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

$fieldvalueseparator = "+";

$rangea = array();
if ($_REQUEST["RangeSubmitted"] != "no") {array_push($rangea, "submitted");}
if ($_REQUEST["RangeRaw"] != "no") {array_push($rangea, "raw");array_push($rangea, "proposed");}
if ($_REQUEST["RangeAllocated"] != "no") {array_push($rangea, "allocated");}
$rangestring = "";
$sep = "";
foreach ($rangea as $range) {
 $rangestring = $rangestring.$sep.$range;
 $sep = $fieldvalueseparator; 
} 

Fin_ALLOCATE_Output("Bank",$rangestring);
Back_Navigator();
PageFooter("Default","Final");

?>


