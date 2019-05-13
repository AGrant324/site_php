<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Report_SETUPREPORTCOMPOSER_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Get_Person_Authority();
Back_Navigator();

$inreport_id = $_REQUEST['report_id'];$inaction = $_REQUEST['action'];
Report_SETUPREPORTCOMPOSER_Output($inreport_id,$inaction);

Back_Navigator();
PageFooter("Default","Final");
