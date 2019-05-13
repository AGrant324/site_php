<?php # frsresultsboardout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_ResultsBoard_CSSJS();
PageHeader("Default","Final");
// This routine does not require login
Back_Navigator();

$inseason = $GLOBALS{'currperiodid'};
if(isset($_REQUEST['Season'])) { $insection = $_REQUEST['Season']; }
if ( $inseason == "Current" ) { $inseason = $GLOBALS{'currperiodid'}; }
$insection = "All";
if(isset($_REQUEST['Section'])) { $insection = $_REQUEST['Section']; }

Frs_RESULTSBOARD_Output($inseason, $insection);

Back_Navigator();
PageFooter("Default","Final");
