<<<<<<< HEAD
<?php # frsteamselectionout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
if ( $GLOBALS{'LOGIN_frame_id'} == "F") { FBHeader();} 
else { PageHeader("Default","Final"); }
// This routine does not require login
Back_Navigator();

$insectionname = $_REQUEST['section_name'];
$inteamcode = $_REQUEST['team_code'];

if ( $GLOBALS{'LOGIN_frame_id'} == "F") { Frs_FBSTYLE_Output(); } 
else { Frs_WEBSTYLE_Output(); }

$nextfrsid = "999999999";
$frs_ida = Get_Array("frs",$GLOBALS{'currperiodid'},$inteamcode);
foreach ($frs_ida as $frs_id) {
	Get_Data("frs",$GLOBALS{'currperiodid'},$inteamcode,$frs_id);
	if (($GLOBALS{'currentYYYY-MM-DD'} <= $GLOBALS{'frs_date'})&&($nextfrsid == "999999999")) {
		$nextfrsid = $GLOBALS{'frs_id'};
	}
}

if ($nextfrsid == "999999999") {
	XH4("Match Fixture not found.");	
} else {
	Frs_FRSTEAMSELECTIONDISPLAY_Output($GLOBALS{'currperiodid'},$inteamcode,$nextfrsid);
}

Back_Navigator();
if ( $GLOBALS{'LOGIN_frame_id'} == "F") { FBFooter(); } 
else { PageFooter("Default","Final"); }
=======
<?php # frsteamselectionout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
if ( $GLOBALS{'LOGIN_frame_id'} == "F") { FBHeader();} 
else { PageHeader("Default","Final"); }
// This routine does not require login
Back_Navigator();

$insectionname = $_REQUEST['section_name'];
$inteamcode = $_REQUEST['team_code'];

if ( $GLOBALS{'LOGIN_frame_id'} == "F") { Frs_FBSTYLE_Output(); } 
else { Frs_WEBSTYLE_Output(); }

$nextfrsid = "999999999";
$frs_ida = Get_Array("frs",$GLOBALS{'currperiodid'},$inteamcode);
foreach ($frs_ida as $frs_id) {
	Get_Data("frs",$GLOBALS{'currperiodid'},$inteamcode,$frs_id);
	if (($GLOBALS{'currentYYYY-MM-DD'} <= $GLOBALS{'frs_date'})&&($nextfrsid == "999999999")) {
		$nextfrsid = $GLOBALS{'frs_id'};
	}
}

if ($nextfrsid == "999999999") {
	XH4("Match Fixture not found.");	
} else {
	Frs_FRSTEAMSELECTIONDISPLAY_Output($GLOBALS{'currperiodid'},$inteamcode,$nextfrsid);
}

Back_Navigator();
if ( $GLOBALS{'LOGIN_frame_id'} == "F") { FBFooter(); } 
else { PageFooter("Default","Final"); }
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
