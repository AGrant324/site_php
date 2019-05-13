<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inevent_id = $_REQUEST['event_id'];
$inevent_attendeeref = $_REQUEST['event_attendeeref'];

Booking_EVENTATTENDEEDELETECONFIRM_Output($inevent_id, $inevent_attendeeref);

Back_Navigator();
PageFooter("Default","Final");


