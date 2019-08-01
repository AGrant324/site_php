<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_grlroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$inleague = $_REQUEST['League'];

// XH2($inleague);

Grl_LeagueTableAPlugin_Output($GLOBALS{'currperiodid'},$inleague);