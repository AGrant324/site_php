<?php # setupsqlmaintainout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$testorreal = $_REQUEST['TestorReal'];
$extendedtrace = $_REQUEST["ExtendedTrace"];

Setup_SQLMAINTAIN_Output2 ($testorreal,$extendedtrace);

Back_Navigator();
PageFooter("Default","Final");
?>