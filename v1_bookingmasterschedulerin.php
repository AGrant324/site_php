<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Booking_MASTERSCHEDULERDISPLAY_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$inseason = $_REQUEST['season'];
$ddpart = $_REQUEST['requesteddate_DDpart'];
$mmpart = $_REQUEST['requesteddate_MMpart'];
$yyyypart = $_REQUEST['requesteddate_YYYYpart'];
$inrequesteddate = $yyyypart."-".$mmpart."-".$ddpart;

Booking_MASTERSCHEDULERDISPLAY_Output($season, $inrequesteddate);

Back_Navigator();
PageFooter("Default","Final");


