<<<<<<< HEAD
<?php # frssquadslectin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Get_Person_Authority();

Frs_FRSSQUADSELECT_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inteamcode = $_REQUEST['team_code'];
Frs_FRSSQUADCHOOSER_Output($GLOBALS{'currperiodid'},$inteamcode);

Back_Navigator();
PageFooter("Default","Final");
=======
<?php # frssquadslectin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Get_Person_Authority();

Frs_FRSSQUADSELECT_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inteamcode = $_REQUEST['team_code'];
Frs_FRSSQUADCHOOSER_Output($GLOBALS{'currperiodid'},$inteamcode);

Back_Navigator();
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
