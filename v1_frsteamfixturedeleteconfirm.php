<<<<<<< HEAD
<?php # frsteamfixturesout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Check_Session_Validity();
PageHeader("Default","Final");
Back_Navigator();

$inseason = $_REQUEST['season'];
$inteam_code = $_REQUEST['team_code'];
$infrs_id = $_REQUEST['frs_id'];

Frs_TEAMFIXTUREDELETECONFIRM_Output($inseason, $inteam_code, $infrs_id);

Back_Navigator();
PageFooter("Default","Final");
=======
<?php # frsteamfixturesout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Check_Session_Validity();
PageHeader("Default","Final");
Back_Navigator();

$inseason = $_REQUEST['season'];
$inteam_code = $_REQUEST['team_code'];
$infrs_id = $_REQUEST['frs_id'];

Frs_TEAMFIXTUREDELETECONFIRM_Output($inseason, $inteam_code, $infrs_id);

Back_Navigator();
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
