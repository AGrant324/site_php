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

Back_Navigator();
PageFooter("Default","Final");

