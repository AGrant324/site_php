<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$indrawid = $_REQUEST['draw_id'];
Booking_DRAWATTENDEEADMIN_Output ($indrawid);

Back_Navigator();
PageFooter("Default","Final");

