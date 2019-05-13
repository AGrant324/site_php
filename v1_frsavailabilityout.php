<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_AvailabilityPopup_CSSJS();
PopUpHeader();
Check_Session_Validity();
Back_Navigator();

$inseason = $_REQUEST["season"];
$inavailabilitypersonid = $_REQUEST["availabilitypersonid"];

Get_Data('person',$inavailabilitypersonid);

XH3("Availability Summary for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});

Frs_Availability_Output ($season, $inavailabilitypersonid, "popup");

Back_Navigator();
PopUpFooter();