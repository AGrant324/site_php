<?php # bookingcourseout.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Booking_COURSEUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Get_Person_Authority();
Back_Navigator();
$incourseid = $_REQUEST['course_id'];$inaction = $_REQUEST['action'];
$inmenulist = $_REQUEST['menulist'];
Booking_COURSEUPDATE_Output($incourseid,$inaction,$inmenulist);
Back_Navigator();
PageFooter("Default","Final");
