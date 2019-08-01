<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMFLOODLIGHTVISIT_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmfloodlightvisit_sfmfacilityid = $_REQUEST['sfmfloodlightvisit_sfmfacilityid'];
$insfmfloodlightvisit_id = $_REQUEST['sfmfloodlightvisit_id'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});

SFM_SFMFLOODLIGHTVISIT_Output($insfmclub_id,$insfmfloodlightvisit_sfmfacilityid,$insfmfloodlightvisit_id,"FVISIT");

Back_Navigator();PageFooter("Default","Final");
?>

