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

Booking_COURSEDELETECONFIRM_Output($incourse_id);

Back_Navigator();
PageFooter("Default","Final");


