<?php # bookingcourseout.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Booking_DRAWUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Get_Person_Authority();
Back_Navigator();
$indrawid = $_REQUEST['draw_id'];
$inmenulist = $_REQUEST['menulist'];
Booking_DRAWUPDATE_Output($indrawid,$inmenulist);
Back_Navigator();
PageFooter("Default","Final");
