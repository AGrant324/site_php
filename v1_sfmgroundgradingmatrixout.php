<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMGROUNDGRADINGMATRIX_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmfacility_id = $_REQUEST['sfmfacility_id'];

SFM_SFMGROUNDGRADINGMATRIX_Output($insfmfacility_id);

Back_Navigator();
PageFooter("Default","Final");
?>

