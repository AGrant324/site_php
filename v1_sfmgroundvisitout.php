<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMGROUNDVISIT_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmgroundvisit_sfmgroundid = $_REQUEST['sfmgroundvisit_sfmgroundid'];
$insfmgroundvisit_id = $_REQUEST['sfmgroundvisit_id'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});

SFM_SFMGROUNDVISIT_Output($insfmclub_id,$insfmgroundvisit_sfmgroundid,$insfmgroundvisit_id,"GVISIT");

Back_Navigator();PageFooter("Default","Final");
?>

