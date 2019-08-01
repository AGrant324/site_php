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

$indraw_id = $_REQUEST['draw_id'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

Delete_Data("draw",$indraw_id);
XPTXT("Raffle - ".$indraw_id." deleted");
Webpage_PluginTriggerChanged_Output("event");

Booking_DRAWUPDATELIST_Output();

Back_Navigator();
PageFooter("Default","Final");


