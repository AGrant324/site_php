<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_pdfroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();
Report_MPDFREPORTLIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inmpdfreport_id = $_REQUEST['mpdfreport_id'];
Get_Data("mpdfreport",$inmpdfreport_id);

XH2("Custom PDF - ".$inmpdfreport_id." - ".$GLOBALS{'mpdfreport_title'});

Report_MPDFREPORTLIST_Output( $inmpdfreport_id );

Back_Navigator();
PageFooter("Default","Final");




