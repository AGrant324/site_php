<?php # webpageeventupdateout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_TEMPLATEELEMENTUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$intemplateelement_name = $_REQUEST['templateelement_name'];

Webpage_TEMPLATEELEMENTUPDATE_Output($intemplateelement_name);

Back_Navigator();
PageFooter("Default","Final");
