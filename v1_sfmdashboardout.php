<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_menuroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'dashboardsectionsprovided'} = "1";
PageHeader("Default","Final");
Get_Person_Authority();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

DomainDashboard_sfm ();

Back_Navigator();
PageFooter("Default","Final");
?>
