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
$inmassupdate_id = $_REQUEST['massupdate_id'];
Report_SETUPMASSUPDATEDELETECONFIRM_Output($inmassupdate_id);
Back_Navigator();
PageFooter("Default","Final");


