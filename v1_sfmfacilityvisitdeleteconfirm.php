<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmfacilityvisit_sfmfacilityid = $_REQUEST['sfmfacilityvisit_sfmfacilityid'];
$insfmfacilityvisit_id = $_REQUEST['sfmfacilityvisit_id'];

SFM_SFMFACILITYVISITDELETECONFIRM_Output($insfmclub_id,$insfmfacilityvisit_sfmfacilityid,$insfmfacilityvisit_id);

Back_Navigator();PageFooter("Default","Final");
?>

