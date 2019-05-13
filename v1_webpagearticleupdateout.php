<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_ARTICLEUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Get_Person_Authority();
Back_Navigator();

$inarticleid = $_REQUEST['article_id'];
$inmenulist = $_REQUEST['menulist'];
Webpage_ARTICLEUPDATE_Output($inarticleid,$inmenulist);

Back_Navigator();
PageFooter("Default","Final");
