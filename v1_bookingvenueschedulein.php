<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Booking_VENUEWEEKSCHEDULEDISPLAY_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$invenue_code = $_REQUEST['venue_code'];
$inseason = $_REQUEST['season'];
$ddpart = $_REQUEST['requesteddate_DDpart'];
$mmpart = $_REQUEST['requesteddate_MMpart'];
$yyyypart = $_REQUEST['requesteddate_YYYYpart'];
$inrequesteddate = $yyyypart."-".$mmpart."-".$ddpart;



Booking_VENUEWEEKSCHEDULEDISPLAY_Output($invenue_code, $inseason, $inrequesteddate);

Back_Navigator();
PageFooter("Default","Final");


