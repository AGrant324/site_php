<?php # webpageeventupdateout.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Get_Person_Authority();
Back_Navigator();
$inexport_id = $_REQUEST['export_id'];$inaction = $_REQUEST['action'];
Report_SETUPEXPORTCOMPOSER_Output($inexport_id,$inaction);
Back_Navigator();
PageFooter("Default","Final");
