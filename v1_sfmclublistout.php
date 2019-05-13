<?php # personLUin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMCLUBLIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmleague_id = $_REQUEST['sfmleague_id'];

SFM_SFMCLUBLIST_Output($insfmleague_id);

Back_Navigator();
PageFooter("Default","Final");

?>
