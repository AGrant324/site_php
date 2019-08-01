<?php # frsnextweeksscheduleout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
if ( $GLOBALS{'LOGIN_frame_id'} == "F") { FBHeader();} 
else { PageHeader("Default","Final"); }
// This routine does not require login
Back_Navigator();

$inseason = $_REQUEST['Season'];
if ( $inseason == "Current" ) { $inseason = $GLOBALS{'currperiodid'}; }

Frs_NEXTWEEKSSCHEDULE_Output($inseason);

Back_Navigator();
if ( $GLOBALS{'LOGIN_frame_id'} == "F") { FBFooter(); } 
else { PageFooter("Default","Final"); }
