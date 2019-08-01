<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_FRSTEAMRESULTS_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inseason = $_REQUEST['season'];
$inteam_code = $_REQUEST['team_code'];

$frs_ida = Get_Array("frs",$inseason,$inteam_code);
foreach ($frs_ida as $frs_id) {
	Get_Data("frs",$inseason,$inteam_code,$frs_id);
	if (isset($_REQUEST['frs_excludefromfixturecard|'.$frs_id])) {
		$GLOBALS{'frs_excludefromfixturecard'} = $_REQUEST['frs_excludefromfixturecard|'.$frs_id];		
		Write_Data("frs",$inseason,$inteam_code,$frs_id);
	}	
}

Frs_TEAMFIXTURECARDPAGEPRINT_Output ($inseason, $inteam_code);

Back_Navigator();
PageFooter("Default","Final");
