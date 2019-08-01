<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_siteroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Site_ACCOUNTQUICKSTART_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inaccount_id = $_REQUEST['account_id'];

if (strlen(strstr($inaccount_id,"+"))>0) {
    $abits = explode("+",$inaccount_id);
    $inaccount_id = $abits[0];    
    $currenttab = $abits[1];
} else {
    $currenttab = "CLUB";
}

Site_ACCOUNTQUICKSTART_Output($inaccount_id, $currenttab);

Back_Navigator();
PageFooter("Default","Final");

?>


