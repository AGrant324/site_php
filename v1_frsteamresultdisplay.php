<?php # frsteamresults.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
if ( $GLOBALS{'LOGIN_frame_id'} == "F") { 
    FBHeader();
} 
else {
    Frs_FRSTEAMRESULTDISPLAY_CSSJS();
    PageHeader("Default","Final"); 
}
// This routine does not require login
Back_Navigator();

$inseason = $_REQUEST['Season'];
if ( $inseason == "Current" ) {
	$inseason = $GLOBALS{'currperiodid'};
}
$infrsid = $_REQUEST['frs_id'];
$team_code = substr($infrsid, 0, 2);

if ( $GLOBALS{'LOGIN_frame_id'} == "F") { Frs_FBSTYLE_Output(); } 
else { Frs_WEBSTYLE_Output(); }

Frs_FRSTEAMRESULTDISPLAY_Output($inseason,$team_code, $infrsid);

Back_Navigator();
if ( $GLOBALS{'LOGIN_frame_id'} == "F") { FBFooter(); } 
else { PageFooter("Default","Final"); }
 