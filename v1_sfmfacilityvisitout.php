<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMFACILITYVISIT_CSSJS();
$GLOBALS{'dashboardsectionsprovided'} = "1";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmfacilityvisit_sfmfacilityid = $_REQUEST['sfmfacilityvisit_sfmfacilityid'];
$insfmfacilityvisit_id = $_REQUEST['sfmfacilityvisit_id'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});

SFM_SFMFACILITYVISIT_Output($insfmclub_id,$insfmfacilityvisit_sfmfacilityid,$insfmfacilityvisit_id,"GVISIT");

Back_Navigator();PageFooter("Default","Final");
?>

