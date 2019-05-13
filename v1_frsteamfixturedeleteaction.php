<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_FRSUPDATEMENU_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inseason = $_REQUEST['season'];
$inteam_code = $_REQUEST['team_code'];
$infrs_id = $_REQUEST['frs_id'];

Delete_Data("frs",$inseason,$inteam_code,$infrs_id);
XPTXT('Fixture - "'.$infrs_id.'" deleted');

Frs_TEAMFIXTURESUPDATE_Output($inseason, $inteam_code);

Back_Navigator();
PageFooter("Default","Final");


