<<<<<<< HEAD
<?php # frsselectionconfirmationupdateout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Get_Person_Authority();

$infrsid = $_REQUEST['frs_id'];
$inpersonid = $_REQUEST['person_id'];

// Frs_FRSCONFIRMATIONUPDATE_Output($GLOBALS{'currperiodid'},$inteamcode);
XH1("This function to be added");

XBR();XINBUTTONCLOSEWINDOW("Cancel");
PageFooter("Default","Final");
=======
<?php # frsselectionconfirmationupdateout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Get_Person_Authority();

$infrsid = $_REQUEST['frs_id'];
$inpersonid = $_REQUEST['person_id'];

// Frs_FRSCONFIRMATIONUPDATE_Output($GLOBALS{'currperiodid'},$inteamcode);
XH1("This function to be added");

XBR();XINBUTTONCLOSEWINDOW("Cancel");
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
