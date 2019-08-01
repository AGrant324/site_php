<<<<<<< HEAD
<?php # personqualificationreportout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_Qualification_Report_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$reportparm = $_REQUEST['ReportParm'];
Person_Qualification_Report($reportparm);

Back_Navigator();
PageFooter("Default","Final");

=======
<?php # personqualificationreportout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_Qualification_Report_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$reportparm = $_REQUEST['ReportParm'];
Person_Qualification_Report($reportparm);

Back_Navigator();
PageFooter("Default","Final");

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>