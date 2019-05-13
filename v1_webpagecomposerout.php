<?php # webpageeventupdateout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_WEBPAGECOMPOSER_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Get_Person_Authority();
Back_Navigator();

$inwebpage_action = $_REQUEST['webpage_action'];
$inwebpage_name = $_REQUEST['webpage_name'];

$inwebpage_name = str_replace(" ", "_", $inwebpage_name);

Webpage_WEBPAGECOMPOSER_Output($inwebpage_action, $inwebpage_name);

Back_Navigator();
PageFooter("Default","Final");
