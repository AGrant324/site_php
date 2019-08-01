<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Booking_EventBooking_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$inevent_id = $_REQUEST['event_id'];

Booking_EventBooking_Output($inevent_id,"","","");

Back_Navigator();
PageFooter("Default","Final");


