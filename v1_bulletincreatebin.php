<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_BULLETINCREATEC_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inbulletin_periodid = $_REQUEST['bulletin_periodid'];
$inbulletin_target = $_REQUEST['bulletin_target'];
$fixedbulletinboard = $_REQUEST['FixedBulletinBoard'];

Webpage_BULLETINCREATEC_Output("R",$inbulletin_target,"",$inbulletin_periodid,$fixedbulletinboard);

Back_Navigator();
PageFooter("Default","Final");




