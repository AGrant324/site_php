<?php # frsteamfixturesout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
FBHeader();
// This routine does not require login
Back_Navigator();

$inseason = $_REQUEST['Season'];
if ( $inseason == "Current" ) { $inseason = $GLOBALS{'currperiodid'}; }
$inteamcode = $_REQUEST['team_code'];

Frs_TEAMFIXTURES_Output($inseason, $inteamcode);

Back_Navigator();
FBFooter();
