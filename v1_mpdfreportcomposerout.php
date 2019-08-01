<<<<<<< HEAD
<?php # webpageeventupdateout.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Report_SETUPMPDFREPORTCOMPOSER_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Get_Person_Authority();

Back_Navigator();

$inmpdfreport_id = $_REQUEST['mpdfreport_id'];$inaction = $_REQUEST['action'];
Report_SETUPMPDFREPORTCOMPOSER_Output($inmpdfreport_id,$inaction);

Back_Navigator();
PageFooter("Default","Final");
=======
<?php # webpageeventupdateout.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();Report_SETUPMPDFREPORTCOMPOSER_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Get_Person_Authority();

Back_Navigator();

$inmpdfreport_id = $_REQUEST['mpdfreport_id'];$inaction = $_REQUEST['action'];
Report_SETUPMPDFREPORTCOMPOSER_Output($inmpdfreport_id,$inaction);

Back_Navigator();
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
