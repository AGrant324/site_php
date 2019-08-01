<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Booking_BOOKINGUTILITY_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$invenue_code = $_REQUEST['venue_code'];

Booking_BOOKINGUTILITY_Output($invenue_code);

Back_Navigator();
PageFooter("Default","Final");


