<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$incourseid = $_REQUEST['course_id'];
Booking_COURSEPAYMENTADMIN_Output ($incourseid);

XBR();XBR();
$link = YPGMLINK("bookingcourseattendeeadminout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$incourseid);
XLINKTXT($link,"add/remove attendees for this course");
XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","COURSEADMINLIST");
XLINKTXT($link,"show my course list");

Back_Navigator();
PageFooter("Default","Final");

