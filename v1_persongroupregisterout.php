<?php # persongroupregisterout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_SECTIONGROUPREGISTER_CSSJS ();
PopUpHeader();
Check_Session_Validity();
Get_Person_Authority();

$sectiongroupcode = $_REQUEST['SectionGroup'];
$indateYYYY = $_REQUEST['FixResSelDate_YYYYpart'];
$indateMM = $_REQUEST['FixResSelDate_MMpart'];
$indateDD = $_REQUEST['FixResSelDate_DDpart'];
$indate = $indateYYYY."-".$indateMM."-".$indateDD;

Person_SECTIONGROUPREGISTERM_Output ($sectiongroupcode);

// XBR();XINBUTTONCLOSEWINDOW("Cancel");
PopUpFooter();
