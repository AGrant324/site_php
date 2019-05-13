<?php # frsresultsboardout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_FRSSELECTIONSUMMARYMENU_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$inseason = $GLOBALS{'currperiodid'};
$insection_name = $_REQUEST['section_name'];

Frs_FRSSELECTIONSUMMARYMENU_Output( $inseason, $insection_name );

Back_Navigator();
PageFooter("Default","Final");

