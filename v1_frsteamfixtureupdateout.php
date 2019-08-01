<?php # frsteamfixturesout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
GenericHandler_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inseason = $_REQUEST['season'];
$inteam_code = $_REQUEST['team_code'];
$infrs_id = $_REQUEST['frs_id'];

Frs_TEAMFIXTUREUPDATE_Output($inseason, $inteam_code, $infrs_id);


Back_Navigator();
PageFooter("Default","Final");
