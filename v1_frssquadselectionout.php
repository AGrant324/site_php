<<<<<<< HEAD
<?php # frssquadslectin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Frs_FRSSQUADSELECTION_CSSJS();
PopUpHeader();

Check_Session_Validity();
Get_Person_Authority();

$inteamcode = $_REQUEST['team_code'];
Frs_FRSSQUADSELECTION_Output($GLOBALS{'currperiodid'},$inteamcode);


XBR();XINBUTTONCLOSEWINDOW("Cancel");
PopUpFooter();
=======
<?php # frssquadslectin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Frs_FRSSQUADSELECTION_CSSJS();
PopUpHeader();

Check_Session_Validity();
Get_Person_Authority();

$inteamcode = $_REQUEST['team_code'];
Frs_FRSSQUADSELECTION_Output($GLOBALS{'currperiodid'},$inteamcode);


XBR();XINBUTTONCLOSEWINDOW("Cancel");
PopUpFooter();
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
