<?php # frsteamconfirmationemailin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
// This routine does not require login
$inselectionpersonid = $_REQUEST['SelectionPersonId'];
$inteamcode = $_REQUEST['TeamCode'];
$infrsid = $_REQUEST['FrsId'];
$inconfirmationstatus = $_REQUEST['ConfirmationStatus'];

Get_Data("person",$inselectionpersonid);
Get_Data("team",$GLOBALS{'currperiodid'},$inteamcode);
Get_Data("frs",$GLOBALS{'currperiodid'},$inteamcode, $infrsid);

XH2($GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' - '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));

if ($GLOBALS{'frs_ha'} == "H") {
	Check_Data('venue',$GLOBALS{'frs_venue'});
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		XTXT("<b>Venue: </b>".$GLOBALS{'venue_name'});XBR();
	}
	else { 
		XTXT("<b>Venue: </b>".$GLOBALS{'frs_venue'});XBR();
	}
}
if ($GLOBALS{'frs_ha'} == "A") {
	XTXT("<b>Venue: </b>".$GLOBALS{'frs_awayvenue'});XBR();
}

XTXT("<b>Start Time: </b>".$GLOBALS{'frs_time'});XBR();
XTXT("<b>Arrangements: </b>".$GLOBALS{'frs_meet'});XBR();
if ($GLOBALS{'frs_meetextra'} != "") {
	XBR();
	XTXT("<b>Additional Information:</b>");XBR();
	XTXT($GLOBALS{'frs_meetextra'});XBR();
}

XBR();
XHR();

$playera = GetSelectionListPersonIds ('frs_playerselectedlist',"all","Y");
if (in_array($inselectionpersonid, $playera)) {
	// ===== meettotravel = no ==================
	if (($GLOBALS{'frs_meettotravel'} != "Yes")&&($inconfirmationstatus == "Y")) {
		UpdateSelectionList('frs_playerselectedlist',$inselectionpersonid,'confirmed',"Y");
		UpdateSelectionList('frs_playerselectedlist',$inselectionpersonid,'travel',"M");
	}
	if (($GLOBALS{'frs_meettotravel'} != "Yes")&&($inconfirmationstatus == "N")) {
		UpdateSelectionList('frs_playerselectedlist',$inselectionpersonid,'confirmed',"N");
		UpdateSelectionList('frs_playerselectedlist',$inselectionpersonid,'travel',"");
	}
	// ===== meettotravel = yes ==================
	if (($GLOBALS{'frs_meettotravel'} == "Yes")&&($inconfirmationstatus == "M")) {
		UpdateSelectionList('frs_playerselectedlist',$inselectionpersonid,'confirmed',"Y");
		UpdateSelectionList('frs_playerselectedlist',$inselectionpersonid,'travel',"M");
	}
	if (($GLOBALS{'frs_meettotravel'} == "Yes")&&($inconfirmationstatus == "D")) {
		UpdateSelectionList('frs_playerselectedlist',$inselectionpersonid,'confirmed',"Y");
		UpdateSelectionList('frs_playerselectedlist',$inselectionpersonid,'travel',"D");
	}
	if (($GLOBALS{'frs_meettotravel'} == "Yes")&&($inconfirmationstatus == "N")) {
		UpdateSelectionList('frs_playerselectedlist',$inselectionpersonid,'confirmed',"N");
		UpdateSelectionList('frs_playerselectedlist',$inselectionpersonid,'travel',"");
	}		
}



$officiala = GetSelectionListPersonIds ('frs_officialselectedlist',"all","Y");
if (in_array($inselectionpersonid, $officiala)) {
	// ===== meettotravel = no ==================
	if (($GLOBALS{'frs_meettotravel'} != "Yes")&&($inconfirmationstatus == "Y")) {
		UpdateSelectionList('frs_officialselectedlist',$inselectionpersonid,'confirmed',"Y");
		UpdateSelectionList('frs_officialselectedlist',$inselectionpersonid,'travel',"M");
	}
	if (($GLOBALS{'frs_meettotravel'} != "Yes")&&($inconfirmationstatus == "N")) {
		UpdateSelectionList('frs_officialselectedlist',$inselectionpersonid,'confirmed',"N");
		UpdateSelectionList('frs_officialselectedlist',$inselectionpersonid,'travel',"");
	}
	// ===== meettotravel = yes ==================
	if (($GLOBALS{'frs_meettotravel'} == "Yes")&&($inconfirmationstatus == "M")) {
		UpdateSelectionList('frs_officialselectedlist',$inselectionpersonid,'confirmed',"Y");
		UpdateSelectionList('frs_officialselectedlist',$inselectionpersonid,'travel',"M");
	}
	if (($GLOBALS{'frs_meettotravel'} == "Yes")&&($inconfirmationstatus == "D")) {
		UpdateSelectionList('frs_officialselectedlist',$inselectionpersonid,'confirmed',"Y");
		UpdateSelectionList('frs_officialselectedlist',$inselectionpersonid,'travel',"D");
	}
	if (($GLOBALS{'frs_meettotravel'} == "Yes")&&($inconfirmationstatus == "N")) {
		UpdateSelectionList('frs_officialselectedlist',$inselectionpersonid,'confirmed',"N");
		UpdateSelectionList('frs_officialselectedlist',$inselectionpersonid,'travel',"");
	}
}


Write_Data("frs",$GLOBALS{'currperiodid'},$inteamcode,$infrsid);


XH3("Thank You ".$GLOBALS{'person_fname'});

if (($GLOBALS{'frs_ha'} == "H")&&($inconfirmationstatus == "Y")) {
	XPTXT("We have recorded that you are available for this game.");
	XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/SelectionYesBase.png");	
}
if (($GLOBALS{'frs_ha'} == "H")&&($inconfirmationstatus == "M")) {
	XPTXT("We have recorded that you are available for this game and will come to the meeting point.");
	XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/SelectionMeetBase.png");
}
if (($GLOBALS{'frs_ha'} == "H")&&($inconfirmationstatus == "D")) {
	XPTXT("We have recorded that you are available for this game and will travel direct.");
	XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/SelectionDirectBase.png");
}
if (($GLOBALS{'frs_ha'} == "H")&&($inconfirmationstatus == "N")) {
	XPTXT("We have recorded that you are not available for this game.");
	XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/SelectionNoBase.png");	
}
if (($GLOBALS{'frs_ha'} == "A")&&($inconfirmationstatus == "Y")) {
	XPTXT("We have recorded that you are available for this game.");
	XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/SelectionYesBase.png");
}
if (($GLOBALS{'frs_ha'} == "A")&&($inconfirmationstatus == "M")) {
	XPTXT("We have recorded that you are available for this game and will come to the meeting point.");
	XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/SelectionMeetBase.png");	
}
if (($GLOBALS{'frs_ha'} == "A")&&($inconfirmationstatus == "D")) {
	XPTXT("We have recorded that you are available for this game and will travel direct.");
	XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/SelectionDirectBase.png");	
}
if (($GLOBALS{'frs_ha'} == "A")&&($inconfirmationstatus == "N")) {
	XPTXT("We have recorded that you are not available for this game.");
	XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/SelectionNoBase.png");	
}

$emailsource = $GLOBALS{'person_email1'};
if ($emailsource == "") { $emailsource = $GLOBALS{'person_email3'}; }
if ($emailsource == "") { $emailsource = $GLOBALS{'person_email2'}; }
$emailouta = Get_Array("emailout_".$emailsource);
$matchedtimestamp = "";
foreach ($emailouta as $outtimestamp)  {
	// XH2($outtimestamp);
	if ($GLOBALS{'currentYYYYMMDDHHMMSS'} > $outtimestamp) { 
		Get_Data("emailout_".$emailsource,$outtimestamp);
		# timestampout-TeamSelection-frsid-personid
		$rbitsa = explode('-',$GLOBALS{'emailout_reference'});
		if (($rbitsa[1] == "TeamSelection")&&($rbitsa[2] == $infrsid)&&($rbitsa[3] == $inselectionpersonid)) { $matchedtimestamp = $outtimestamp; }
	}
}

if ($matchedtimestamp != "") {
	Get_Data("emailout_".$emailsource,$matchedtimestamp);
	$GLOBALS{'emailaction_domainid'} = $GLOBALS{'emailout_domainid'};
	$GLOBALS{'emailaction_from'} = $GLOBALS{'emailout_from'};
	$GLOBALS{'emailaction_message'} = $inconfirmationstatus;
	$GLOBALS{'emailaction_reference'} = $GLOBALS{'emailout_reference'};
	$GLOBALS{'emailaction_expirytimestamp'} = $GLOBALS{'emailout_expirytimestamp'};;	
	Write_Data("emailaction_".$emailsource,$GLOBALS{'currentYYYYMMDDHHMMSS'});		
}

PageFooter("Default","Final");



