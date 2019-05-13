<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_siteroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Back_Navigator();

$inaccount_id = $_REQUEST['account_id'];

Site_Account_Delete_Output($inaccount_id);

Back_Navigator();
PageFooter("Default","Final");

?>

