<<<<<<< HEAD
<?php # frsteamresultin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
Get_Common_Parameters();
GlobalRoutine();Report_SETUPREPORTLIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$inreport_id = $_REQUEST['report_id'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();
Delete_Data("report",$inreport_id);
XPTXT("Report - ".$inreport_id." deleted");
Report_SETUPREPORTLIST_Output();
Back_Navigator();
PageFooter("Default","Final");


=======
<?php # frsteamresultin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
Get_Common_Parameters();
GlobalRoutine();Report_SETUPREPORTLIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$inreport_id = $_REQUEST['report_id'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();
Delete_Data("report",$inreport_id);
XPTXT("Report - ".$inreport_id." deleted");
Report_SETUPREPORTLIST_Output();
Back_Navigator();
PageFooter("Default","Final");


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
