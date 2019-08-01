<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$invenue_code = $_REQUEST['venue_code'];
$inbooking_id = $_REQUEST['booking_id'];
$inbooking_title = $_REQUEST['booking_title'];
$inbooking_description = $_REQUEST['booking_description'];
$ddpart = $_REQUEST['booking_datestart_DDpart'];
$mmpart = $_REQUEST['booking_datestart_MMpart'];
$yyyypart = $_REQUEST['booking_datestart_YYYYpart'];
$inbooking_datestart = $yyyypart."-".$mmpart."-".$ddpart;
$ddpart = $_REQUEST['booking_dateend_DDpart'];
$mmpart = $_REQUEST['booking_dateend_MMpart'];
$yyyypart = $_REQUEST['booking_dateend_YYYYpart'];
$inbooking_dateend = $yyyypart."-".$mmpart."-".$ddpart;
$inbooking_weeklyrepeating = $_REQUEST['booking_weeklyrepeating'];
$inbooking_timestart = StandardTime($_REQUEST['booking_timestart']);
$inbooking_timeend = StandardTime($_REQUEST['booking_timeend']);
$inbooking_contact = $_REQUEST['booking_contact'];
$inbooking_status = $_REQUEST['booking_status'];
XH2("Course Update - ".$inbooking_id." - ".$inbooking_title);
$action = "updated";
Check_Data("booking", $invenue_code, $inbooking_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("booking"); $action = "added"; }

$GLOBALS{'booking_title'} = $inbooking_title;
$GLOBALS{'booking_description'} = $inbooking_description;
$GLOBALS{'booking_datestart'} = $inbooking_datestart;
$GLOBALS{'booking_dateend'} = $inbooking_dateend;
$GLOBALS{'booking_weeklyrepeating'} = $inbooking_weeklyrepeating;
$GLOBALS{'booking_timestart'} = $inbooking_timestart;
$GLOBALS{'booking_timeend'} = $inbooking_timeend;
$GLOBALS{'booking_contact'} = $inbooking_contact;
$GLOBALS{'booking_status'} = $inbooking_status;
if ( $GLOBALS{'booking_datestart'} !== "" ) {
	$GLOBALS{'booking_dayofweek'} = date("D", strtotime($GLOBALS{'booking_datestart'}));
}
$GLOBALS{'booking_timestamp'} = $GLOBALS{'currentYYYYMMDDHHMMSS'};

Write_Data("booking", $invenue_code, $inbooking_id);
XPTXT("Booking - ".$inbooking_id." ".$inbooking_title." ".$action);

XHR();
XBR();
Booking_BOOKINGUPDATELIST_Output ($invenue_code);
XBR();


Back_Navigator();
PageFooter("Default","Final");


