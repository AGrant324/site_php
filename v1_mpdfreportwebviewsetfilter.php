<<<<<<< HEAD
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_slim.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inmpdfreport_id = $_REQUEST['mpdfreport_id'];
Get_Data("mpdfreport",$inmpdfreport_id);

XH2("Custom Report - ".$inmpdfreport_id." - ".$GLOBALS{'mpdfreport_title'});

Report_MPDFREPORTWEBVIEWSETFILTER_Output( $inmpdfreport_id );

Back_Navigator();
PageFooter("Default","Final");




=======
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_slim.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inmpdfreport_id = $_REQUEST['mpdfreport_id'];
Get_Data("mpdfreport",$inmpdfreport_id);

XH2("Custom Report - ".$inmpdfreport_id." - ".$GLOBALS{'mpdfreport_title'});

Report_MPDFREPORTWEBVIEWSETFILTER_Output( $inmpdfreport_id );

Back_Navigator();
PageFooter("Default","Final");




>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
