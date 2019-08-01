<<<<<<< HEAD
<?php # frsresultsboardout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_FRSSELECTIONSUMMARY_CSSJS( );
PageHeader("Default","Final");
Back_Navigator();

$inseason = $GLOBALS{'currperiodid'};
if(isset($_REQUEST['Season'])) { $inseason = $_REQUEST['Season']; }
if(isset($_REQUEST['Section'])) { $insection = $_REQUEST['Section']; }
$inselectiondateYYYY = $_REQUEST['SelectionDate_YYYYpart'];
$inselectiondateMM = $_REQUEST['SelectionDate_MMpart'];
$inselectiondateDD = $_REQUEST['SelectionDate_DDpart'];
$inselectiondate = $inselectiondateYYYY."-".$inselectiondateMM."-".$inselectiondateDD;

Frs_FRSSELECTIONSUMMARY_Output( $inseason, $insection, $inselectiondate );

Back_Navigator();
PageFooter("Default","Final");

=======
<?php # frsresultsboardout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_FRSSELECTIONSUMMARY_CSSJS( );
PageHeader("Default","Final");
Back_Navigator();

$inseason = $GLOBALS{'currperiodid'};
if(isset($_REQUEST['Season'])) { $inseason = $_REQUEST['Season']; }
if(isset($_REQUEST['Section'])) { $insection = $_REQUEST['Section']; }
$inselectiondateYYYY = $_REQUEST['SelectionDate_YYYYpart'];
$inselectiondateMM = $_REQUEST['SelectionDate_MMpart'];
$inselectiondateDD = $_REQUEST['SelectionDate_DDpart'];
$inselectiondate = $inselectiondateYYYY."-".$inselectiondateMM."-".$inselectiondateDD;

Frs_FRSSELECTIONSUMMARY_Output( $inseason, $insection, $inselectiondate );

Back_Navigator();
PageFooter("Default","Final");

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
