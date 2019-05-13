<?php # frslastweeksresultsout.php

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
$insection = "All";
if(isset($_REQUEST['Section'])) { $insection = $_REQUEST['Section']; } 

Frs_LASTWEEKSRESULTS_Output($inseason,$insection);

Back_Navigator();
if ( $GLOBALS{'LOGIN_frame_id'} == "F") { FBFooter(); } 
else { PageFooter("Default","Final"); }
