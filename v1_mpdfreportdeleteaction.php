<?php # frsteamresultin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
Get_Common_Parameters();
GlobalRoutine();Report_SETUPMPDFREPORTLIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$inmpdfreport_id = $_REQUEST['mpdfreport_id'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();
Delete_Data("mpdfreport",$inmpdfreport_id);
XPTXT("Custom PDF - ".$inmpdfreport_id." deleted");
Report_SETUPMPDFREPORTLIST_Output();
Back_Navigator();
PageFooter("Default","Final");


