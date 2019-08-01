<?php # frsteamselectionout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITEJSOPTIONAL'} = "confirmaction";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insectiongroupcode = $_REQUEST['sectiongroup_code'];

Person_MYGROUPEMAILSMS_Output($GLOBALS{'currperiodid'},$insectiongroupcode);

Back_Navigator();
PageFooter("Default","Final");
