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
$insfmfloodlightvisit_sfmfacilityid = $_REQUEST['sfmfloodlightvisit_sfmfacilityid'];
$insfmfloodlightvisit_id = $_REQUEST['sfmfloodlightvisit_id'];

Delete_Data('sfmfloodlightvisit', $insfmfloodlightvisit_sfmfacilityid, $insfmfloodlightvisit_id);
XPTXTCOLOR($insfmfloodlightvisit_sfmfacilityid." ".$insfmfloodlightvisit_id." Deleted","green");

if ( $GLOBALS{'LOGIN_orgtype_id'} == "Club" ) { 
    SFM_SFMCLUBUPDATEFLOOD_Output($insfmclub_id,$insfmfloodlightvisit_sfmfacilityid); 
} else {    
    SFM_SFMCLUBUPDATEMULTI_Output($insfmclub_id,$insfmfloodlightvisit_sfmfacilityid,"FLOODSTATUS");
}

Back_Navigator();
PageFooter("Default","Final");

?>



