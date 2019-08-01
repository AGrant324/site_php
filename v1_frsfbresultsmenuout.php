<<<<<<< HEAD
<?php # frsresultsboardout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
FBHeader();
// This routine does not require login
// Back_Navigator();

$inseason = "Current";
if(isset($_REQUEST['Season'])) { $insection = $_REQUEST['Season']; }
if ( $inseason == "Current" ) { $inseason == $GLOBALS{'currperiodid'}; }
$insection = "All";
if(isset($_REQUEST['Section'])) { $insection = $_REQUEST['Section']; }

Frs_FBRESULTSMENU_Output($inseason, $insection);

// Back_Navigator();
FBFooter();
=======
<?php # frsresultsboardout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
FBHeader();
// This routine does not require login
// Back_Navigator();

$inseason = "Current";
if(isset($_REQUEST['Season'])) { $insection = $_REQUEST['Season']; }
if ( $inseason == "Current" ) { $inseason == $GLOBALS{'currperiodid'}; }
$insection = "All";
if(isset($_REQUEST['Section'])) { $insection = $_REQUEST['Section']; }

Frs_FBRESULTSMENU_Output($inseason, $insection);

// Back_Navigator();
FBFooter();
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
