<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMCLUBUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmfacilityvisit_sfmfacilityid = $_REQUEST['sfmfacilityvisit_sfmfacilityid'];
$insfmfacilityvisit_id = $_REQUEST['sfmfacilityvisit_id'];

Delete_Data('sfmfacilityvisit', $insfmfacilityvisit_sfmfacilityid, $insfmfacilityvisit_id);
XPTXTCOLOR($insfmfacilityvisit_sfmfacilityid." ".$insfmfacilityvisit_id." Deleted","green");

if ( $GLOBALS{'LOGIN_orgtype_id'} == "Club" ) { 
    SFM_SFMCLUBUPDATEGROUND_Output($insfmclub_id,$insfmfacilityvisit_sfmfacilityid);
} else {
    SFM_SFMCLUBUPDATEMULTI_Output($insfmclub_id,$insfmfacilityvisit_sfmfacilityid,"GROUNDSTATUS");
}

Back_Navigator();
PageFooter("Default","Final");

?>



