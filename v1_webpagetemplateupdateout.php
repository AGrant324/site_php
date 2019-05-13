<?php # webpageeventupdateout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$intemplate_status = $_REQUEST['template_status'];
$intemplate_name = $_REQUEST['template_name'];

Webpage_TEMPLATEUPDATE_Output($intemplate_status,$intemplate_name);

Back_Navigator();
PageFooter("Default","Final");
