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

$incourse_id = $_REQUEST['course_id'];
$incourseattendee_id = $_REQUEST['courseattendee_id'];

Check_Data('course',$incourse_id);
Check_Data('courseattendee',$incourseattendee_id);

DeleteCourseAttendeeStatus ($incourseattendee_id);
Write_Data('course',$incourse_id);
XPTXT($GLOBALS{'courseattendee_fname'}." ".$GLOBALS{'courseattendee_fname'}." removed from course");

Booking_COURSEATTENDEEADMIN_Output($incourse_id);

XBR();XBR();
$link = YPGMLINK("bookingcoursepaymentadminout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$incourse_id);
XLINKTXT($link,"review payment status for this course");
XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","COURSEADMINLIST");
XLINKTXT($link,"show my course list");

Back_Navigator();
PageFooter("Default","Final");


