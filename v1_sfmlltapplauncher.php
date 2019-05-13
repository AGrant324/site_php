<?php # personLUin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMLLTAPPLAUNCHER_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$screenheight = $_REQUEST['ScreenHeight'];
$screenwidth = $_REQUEST['ScreenWidth'];
$insfmclub_id = $_REQUEST['sfmclub_id'];

SFM_SFMLLTAPPLAUNCHER_Output($screenheight,$screenwidth,$insfmclub_id);

Back_Navigator();
PageFooter("Default","Final");

?>
