<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_MYAVAILABILITY_CSSJS();
$inseason = $_REQUEST["season"];
$inavailabilitypersonid = $_REQUEST["availabilitypersonid"];
$inwindow = $_REQUEST["window"];
$maxformseq = $_REQUEST["maxformseq"];
if ($inwindow == "popup") { 
    PopUpHeader();
    Check_Session_Validity();
    Back_Navigator();    
}
if ($inwindow == "full") { 
    PageHeader("Default","Final" );
    Check_Session_Validity();
    Back_Navigator();    
}
if ($inwindow == "remote") { 
    PageHeader("Default","Final" ); 
}

XINHID("season",$season);
Get_Data('person',$inavailabilitypersonid);
for ( $formseq=1; $formseq <= $maxformseq; $formseq++) {
	$frsdate = $_REQUEST[$formseq."_frsdate"];
	$dateavailable = $_REQUEST[$formseq."_dateavailable"];
	$datenotavailable = $_REQUEST[$formseq."_datenotavailable"];
	$dateavailability = "";
	if ($dateavailable == "Y") { $dateavailability = "Y"; }
	if ($datenotavailable == "Y") { $dateavailability = "N"; }
	$datecomment = $_REQUEST[$formseq."_datecomment"];
	$maxmatchseq = $_REQUEST[$formseq."_maxmatchseq"];
	/*
	XH3("===============================================");
	XH3("date ".$frsdate."|".$dateavailable."|".$datenotavailable."|".$frsdate."|".$datecomment."|".$dateavailability);
	XH3("maxmatchseq ".$maxmatchseq);
	XH3("origdateperson ".$GLOBALS{'person_dateavailability'});
	*/	
	UpdateDateAvailabilityList('person_dateavailability',$frsdate,$dateavailability,$datecomment);
	// XH3("dateperson ".$GLOBALS{'person_dateavailability'});
	for ( $matchseq=1; $matchseq <= $maxmatchseq; $matchseq++) {
		$frsid = $_REQUEST[$formseq."_".$matchseq."_frsid"];
		$matchavailable = $_REQUEST[$formseq."_".$matchseq."_matchavailable"];
		$matchnotavailable = $_REQUEST[$formseq."_".$matchseq."_matchnotavailable"];
		$matchavailability = "";
		if ($matchavailable == "Y") { $matchavailability = "Y"; }
		if ($matchnotavailable == "Y") { $matchavailability = "N"; }
		$teamcode = substr($frsid,0,2);
		// XH3("match ".$frsid."|".$matchavailable."|".$matchnotavailable."|".$matchavailability);
		Get_Data('frs', $GLOBALS{'currperiodid'}, $teamcode, $frsid);
		// XH3("origmatchfrs ".$GLOBALS{'frs_playerselectedlist'});		
		// $listfieldname,$personid,$parametername,$parametervalue
		UpdateSelectionList('frs_playerselectedlist',$inavailabilitypersonid,'availability',$matchavailability);
		// XH3("matchfrs ".$GLOBALS{'frs_playerselectedlist'});
		Write_Data('frs', $GLOBALS{'currperiodid'}, $teamcode, $frsid);
	}
}
// XH3("writedateperson ".$inavailabilitypersonid." ".$GLOBALS{'person_dateavailability'});
Write_Data('person',$inavailabilitypersonid);

XPTXTCOLOR("Availability updated","green");

XHR();
XH3("My Latest Availability Summary");

Frs_Availability_Output ($season, $inavailabilitypersonid, $inwindow);

if ($inwindow == "popup") {
    Back_Navigator();
    PopUpFooter();
}
if ($inwindow == "full") {
    Back_Navigator();
    PageFooter("Default","Final" );
}
if ($inwindow == "remote") {
    PageFooter("Default","Final" );
}
