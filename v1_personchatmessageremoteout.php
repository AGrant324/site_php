<?php # personLINKout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_TEAMCHAT_CSSJS();
PageHeader("Default","Final");

// This routine does not require login
;
$inchatviewerpersonid = $_REQUEST['chatviewerpersonid'];
$inchatmessage_threadset = $_REQUEST['chatmessage_threadset'];
$inchatmessage_threadid = $_REQUEST['chatmessage_threadid'];

Person_TEAMCHAT_Output("remote", $inchatviewerpersonid,$inchatmessage_threadset,$inchatmessage_threadid);

PageFooter("Default","Final");

?>
