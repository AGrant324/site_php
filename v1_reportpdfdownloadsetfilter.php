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

$inreportexport = $_REQUEST['reportexport'];
$inreportexport_id = $_REQUEST['reportexport_id'];
Get_Data($inreportexport,$inreportexport_id);

$reporttype = "Report";
if ( $inreportexport == "export" ) { $reporttype = "Export"; }
XH2($reporttype." - ".$inreportexport_id." - ".$GLOBALS{$inreportexport.'_title'});

Report_REPORTPDFDOWNLOADSETFILTER_Output( $inreportexport, $inreportexport_id );

Back_Navigator();
PageFooter("Default","Final");




