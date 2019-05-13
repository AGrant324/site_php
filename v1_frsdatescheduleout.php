<?php # frsdatescheduleout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
// This routine does not require login
Back_Navigator();

$inseason = $_REQUEST['Season'];
if ( $inseason == "Current" ) { $inseason = $GLOBALS{'currperiodid'}; } 
$indateYYYY = $_REQUEST['FixResSelDate_YYYYpart'];
$indateMM = $_REQUEST['FixResSelDate_MMpart'];
$indateDD = $_REQUEST['FixResSelDate_DDpart'];
$indate = $indateYYYY."-".$indateMM."-".$indateDD;

Frs_DATESCHEDULE_Output($inseason, $indate);

Back_Navigator();
PageFooter("Default","Final");

