<?php # frsteamconfirmationemailin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_AvailabilityPopup_CSSJS();
PageHeader("Default","Final");
// This routine does not require login

$inavailabilitypersonid = $_REQUEST['AvailabilityPersonId'];

Frs_Availability_Output ($GLOBALS{'currperiodid'}, $inavailabilitypersonid, "remote");

PageFooter("Default","Final");

