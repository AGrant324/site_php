<?php # personLUin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMLLTAPP_CSSJS();
PopupHeader();

$screenheight = $_REQUEST['ScreenHeight'];
$screenwidth = $_REQUEST['ScreenWidth'];
$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmground_id = $_REQUEST['sfmground_id'];
$insfmfloodlightvisit_id = $_REQUEST['sfmfloodlightvisit_id'];
$visitaction = $_REQUEST['VisitAction'];

SFM_SFMLLTAPP_Output($screenheight,$screenwidth,$insfmclub_id,$insfmground_id,$insfmfloodlightvisit_id,$visitaction);

PopupFooter();

?>
