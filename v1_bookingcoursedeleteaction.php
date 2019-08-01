<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$incourse_id = $_REQUEST['course_id'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

Delete_Data("course",$incourse_id);
XPTXT("Course - ".$incourse_id." deleted");
Webpage_PluginTriggerChanged_Output("course");

Booking_COURSEUPDATELIST_Output();

Back_Navigator();
PageFooter("Default","Final");


