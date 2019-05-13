<?php # frsteamresultin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$inreport_id = $_REQUEST['report_id'];
Report_SETUPREPORTDELETECONFIRM_Output($inreport_id);
Back_Navigator();
PageFooter("Default","Final");


