<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$ineventid = $_REQUEST['event_id'];
Booking_EVENTPAYMENTADMIN_Output ($ineventid);

XBR();XBR();
$link = YPGMLINK("bookingeventattendeeadminout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$ineventid);
XLINKTXT($link,"add/remove attendees for this event");
XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","EVENTADMINLIST");
XLINKTXT($link,"show my event list");

Back_Navigator();
PageFooter("Default","Final");

