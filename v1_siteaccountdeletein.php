<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_siteroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$deleteaccount_id = $_REQUEST['DeleteAccountId'];
PageHeader("Default","Final");
Back_Navigator();

DeleteAccountData ($deleteaccount_id);

Back_Navigator();
PageFooter("Default","Final");

?>

