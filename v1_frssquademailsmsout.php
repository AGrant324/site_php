<<<<<<< HEAD
<?php # frsteamselectionout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITEJSOPTIONAL'} = "confirmaction";
PopUpHeader();
Check_Session_Validity();
Back_Navigator();

$inteamcode = $_REQUEST['team_code'];

Frs_FRSSQUADEMAILSMS_Output($GLOBALS{'currperiodid'},$inteamcode);

Back_Navigator();
PopUpFooter();
=======
<?php # frsteamselectionout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITEJSOPTIONAL'} = "confirmaction";
PopUpHeader();
Check_Session_Validity();
Back_Navigator();

$inteamcode = $_REQUEST['team_code'];

Frs_FRSSQUADEMAILSMS_Output($GLOBALS{'currperiodid'},$inteamcode);

Back_Navigator();
PopUpFooter();
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
