<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_grlroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Grl_LeagueOfficialResults2_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$ingrlmatch_id = $_REQUEST["grlmatch_id"]; 

$parma = Array("L-Premier");
Grl_LeagueOfficialResults2_Output($parma,$ingrlmatch_id);

Back_Navigator();
PopUpFooter();
