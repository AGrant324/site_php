<<<<<<< HEAD
<?php # frsteamresults.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Frs_FRSTEAMRESULTS_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$insectionname = $_REQUEST['section_name'];
$inteamcode = $_REQUEST['team_code'];
$infrsid = $_REQUEST['frs_id'];
Frs_FRSTEAMRESULTS_Output($GLOBALS{'currperiodid'},$insectionname,$inteamcode,$infrsid);
Back_Navigator();
PageFooter("Default","Final");
=======
<?php # frsteamresults.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Frs_FRSTEAMRESULTS_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$insectionname = $_REQUEST['section_name'];
$inteamcode = $_REQUEST['team_code'];
$infrsid = $_REQUEST['frs_id'];
Frs_FRSTEAMRESULTS_Output($GLOBALS{'currperiodid'},$insectionname,$inteamcode,$infrsid);
Back_Navigator();
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
