<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_grlroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Grl_LeagueResults_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$parma = Array("L-Premier");
Grl_LeagueResults_Output($parma);

Back_Navigator();
PageFooter("Default","Final");
