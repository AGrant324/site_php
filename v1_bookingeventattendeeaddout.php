<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Booking_EVENTATTENDEEADD1_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inevent_id = $_REQUEST['event_id'];

Booking_EVENTATTENDEEADD_Output($inevent_id);


Back_Navigator();
PageFooter("Default","Final");


