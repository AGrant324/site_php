<<<<<<< HEAD
<?php # frsteamselectionin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITEJSOPTIONAL'} = "confirmaction,frsnotification";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insectionname = $_REQUEST['section_name'];
$inteamcode = $_REQUEST['team_code'];
$infrsid = $_REQUEST['FrsId'];
$infrsvenue = ""; if (isset($_REQUEST['frs_venue'])) { $infrsvenue = $_REQUEST['frs_venue']; }
$infrsawayvenue = ""; if (isset($_REQUEST['frs_awayvenue'])) { $infrsawayvenue = $_REQUEST['frs_awayvenue']; }
$infrstime = StandardTime($_REQUEST['frs_time']);
$infrstimeend = StandardTime($_REQUEST['frs_timeend']);
$infrsmeet = $_REQUEST['frs_meet'];
$infrsmeettotravel = $_REQUEST['frs_meettotravel'];
$infrsmeetextra = $_REQUEST['frs_meetextra'];
$infrscancellation = $_REQUEST['frs_cancellation'];
$infrsselectiondraft = $_REQUEST['frs_selectiondraft'];

Get_Data("section",$GLOBALS{'currperiodid'},$insectionname);
Get_Data("team",$GLOBALS{'currperiodid'},$inteamcode);
Get_Data("frs",$GLOBALS{'currperiodid'},$inteamcode, $infrsid);
if ($GLOBALS{'section_sportid'} == "") { Get_Data("sport_".$GLOBALS{'domain_sportid'}); }
else { Get_Data("sport_".$GLOBALS{'section_sportid'}); }

XH2("Selection Update: (".$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}).")");

$GLOBALS{'frs_venue'} = $infrsvenue;
$GLOBALS{'frs_awayvenue'} = $infrsawayvenue;
$GLOBALS{'frs_time'} = $infrstime;
$GLOBALS{'frs_timeend'} = $infrstimeend;
$GLOBALS{'frs_meettotravel'} = $infrsmeettotravel;
$GLOBALS{'frs_meet'} = $infrsmeet;
$GLOBALS{'frs_meetextra'} = $infrsmeetextra;
$GLOBALS{'frs_cancellation'} = $infrscancellation;
$GLOBALS{'frs_selectiondraft'} = $infrsselectiondraft;
$squada = explode(',',$GLOBALS{'team_squadlist'});

$sortarray = Array();

// Add extra non squad players to player list
if (isset($_REQUEST['extranonsquadselectedlist'])) {
	if ($_REQUEST['extranonsquadselectedlist'] != "") {
		$extranonsquada = explode(',',$_REQUEST['extranonsquadselectedlist']);
		foreach ($extranonsquada as $personid)  {
			Check_Data('person',$personid);
			if ($GLOBALS{'IOWARNING'} == "0") {
				UpdateSelectionList('frs_playerselectedlist',$personid,'selected',"Y");
			}
		}
	}
}

// tidy up non selected non squad players
$nonselectedplayera = GetSelectionListPersonIds('frs_playerselectedlist',"selected","N");
foreach ($nonselectedplayera as $nonselectedplayerid)  {
	if (in_array($nonselectedplayerid, $squada)) {	}
	else {
		DeleteFromSelectionList('frs_playerselectedlist',$nonselectedplayerid);
	}
}

// Sort out and sequence all players
$playerlista = GetSelectionListPersonIds ('frs_playerselectedlist',"all","");
$totalplayera = array_unique(array_merge($playerlista, $squada));
foreach ($totalplayera as $personid)  {	
	if (isset($_REQUEST['player_'.$personid])) {
		// get latest selection status from checkbox in form
		$selectedcode = $_REQUEST['player_'.$personid];
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			UpdateSelectionList('frs_playerselectedlist',$personid,'selected',$selectedcode);
			if (( $selectedcode == "Y" )||( in_array($personid, $squada) )) {
				if ( $selectedcode == "Y" ) { $selectedsortcode = "2"; } 
				else { $selectedsortcode = "3"; }
				if (in_array($personid, $squada)) { $squadstatus = "Squad"; } else { $squadstatus = "NonSquad"; }
				$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|".$squadstatus;
				array_push($sortarray, $record);
			}
		}
	} else {
		// get latest selection status from list (probably a new non squad selection
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$selectedcode = GetSelectionList('frs_playerselectedlist',$personid,'selected');
			if ( $selectedcode == "Y" ) { $selectedsortcode = "2"; } 
			else { $selectedsortcode = "3"; }
			if (in_array($personid, $squada)) { $squadstatus = "Squad"; } else { $squadstatus = "NonSquad"; }
			$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|".$squadstatus;
			array_push($sortarray, $record);
		}
	}
}

// Add extra officials to official list
if (isset($_REQUEST['extraofficialselectedlist'])) {
	if ($_REQUEST['extraofficialselectedlist'] != "") {
		$extraofficiala = explode(',',$_REQUEST['extraofficialselectedlist']);
		foreach ($extraofficiala as $personid)  {
			Check_Data('person',$personid);
			if ($GLOBALS{'IOWARNING'} == "0") {
				UpdateSelectionList('frs_officialselectedlist',$personid,'selected',"Y");
				// XH1($personid." Official Added");
			}
		}
	}
}

// tidy up non selected officials
$nonselectedofficiala = GetSelectionListPersonIds ('frs_officialselectedlist',"selected","N");
foreach ($nonselectedofficiala as $nonselectedofficialid)  {
	DeleteFromSelectionList('frs_officialselectedlist',$nonselectedofficialid);
	// XH1($nonselectedofficialid." Official Deleted");
}

// Sort out and sequence all officials
$officiallista = GetSelectionListPersonIds ('frs_officialselectedlist',"all","");
foreach ($officiallista as $personid)  {
	
	if (isset($_REQUEST['official_'.$personid])) {
		// get latest selection status from checkbox in form
		$selectedcode = $_REQUEST['official_'.$personid];
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			UpdateSelectionList('frs_officialselectedlist',$personid,'selected',$selectedcode);
			// XH1($personid." Official Updated");
			if ( $selectedcode == "Y" ) {
				$selectedsortcode = "0";
				$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|"."Official";
				array_push($sortarray, $record);
			}
		}
	} else {
		// get latest selection status from list (probably a new non squad selection
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$selectedcode = GetSelectionList('frs_officialselectedlist',$personid,'selected');
			$selectedsortcode = "0";
			$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|"."Official";
			array_push($sortarray, $record);
		}
	}
}

// Include sequence mamagement/coaches
if ($GLOBALS{'team_mgr'} != "") {
	$splitstra = List2Array($GLOBALS{'team_mgr'});
	foreach ($splitstra as $personid)  {	
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$selectedsortcode = "0";
			$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|"."Manager";;
			array_push($sortarray, $record);
		}
	}
}
if ($GLOBALS{'team_coach'} != "") {
	$splitstra = List2Array($GLOBALS{'team_coach'});
	foreach ($splitstra as $personid)  {	
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$selectedsortcode = "0";
			$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|"."Coach";;
			array_push($sortarray, $record);
		}
	}
}
$GLOBALS{'frs_timestamp'} = $GLOBALS{'currentYYYYMMDDHHMMSS'}; // used to prevent accidental multiple resend of emails and sms
Write_Data("frs",$GLOBALS{'currperiodid'},$inteamcode,$infrsid);

sort($sortarray);
$totalnotificationlist = "";
$selectednotificationlist = "";

if ($GLOBALS{'frs_cancellation'} == "Yes" ) {
	XH3('<span style="color:red">Match Cancelled</span>');
}

if ($GLOBALS{'frs_selectiondraft'} == "Yes") { XH3('Team Selection Summary - <span style="color:red"><b>Draft (Not yet published)</b></span>'); }
else { XH3('Team Selection Summary'); }

XFORM("frsteamnotificationin.php","ConfirmActionForm");
XINSTDHID();
XINHID("section_name",$insectionname);
XINHID("team_code",$inteamcode);
XINHID("FrsId",$infrsid); 

XINHID("ConfirmActionText","This will generate any requested SMS and EMails. Do you wish to continue"); 
XINHID("ConfirmActionStatus","No");

XTABLE();
XTR();XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Email");XTDHTXT("Mobile");XTDHTXT("");XTDHTXT("Position");XTDHTXT("ShirtNo");XTDHTXT("Planned");
XTDHTXT("Available");XTDHTXT("Selected");XTDHTXT("Notify");XTDHTXT("Prev<br>Notify");XTDHTXT("Confirmed");XTDHTXT("Travel");X_TR();
# id, name, value, checked, text
$optionstext = YINCHECKBOXID('tick_all','tick_all',"","","All").YBR().YINCHECKBOXID('tick_selected','tick_selected',"","","Selected").YBR().YINCHECKBOXID('tick_none','tick_none',"","","Clear").YBR();
XTR();XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");
XTDTXT("");XTDTXT("");XTDTXT($optionstext);XTDTXT("");XTDTXT("");XTDTXT("");X_TR();
$lastcode = "9";
foreach ($sortarray as $record)  {
	$bitsa = explode('|',$record);
	if (($bitsa[0] != $lastcode) && ($lastcode != "9")) { 
	    XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");
		XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
	}
	$lastcode = $bitsa[0];
	$personid = $bitsa[3];
	$totalnotificationlist = $totalnotificationlist.$personid.",";
	Get_Data('person',$personid);
	XTR();XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
	XTDTXT(Chosen_Person_Email());
	XTDTXT(Chosen_Person_SMS());
	XTDTXT($bitsa[4]);	
	XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'planned')).SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'planned')));
	XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'availability')).SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'availability')));
	$colour = "black";
	$defaultnotification = "No";
	if (($bitsa[4] == "Manager")||($bitsa[4] == "Coach")) {
		$defaultnotification = "Yes";
	}
	if (($bitsa[4] == "Official")) {
		if (GetSelectionList('frs_officialselectedlist',$personid,'selected') == "Y") { 
			$colour = "green"; 
			$defaultnotification = "Yes";
			$selectednotificationlist = $selectednotificationlist.$personid.",";
		}	
	}
	if (($bitsa[4] == "Squad")||($bitsa[4] == "NonSquad")) {
		if (GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y") { 
			$colour = "green"; 
			$defaultnotification = "Yes";
			$selectednotificationlist = $selectednotificationlist.$personid.",";
		}	
	}
	XTDTXT($GLOBALS{'person_position'});
	XTDTXT($GLOBALS{'person_shirtnumber'});
	XTD();XTXTCOLOR(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'selected')).SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'selected')),$colour);	
	XTDINCHECKBOXYESNOID('tobenotified_'.$personid,'tobenotified_'.$personid,$defaultnotification,"");
	XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'notified')).SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'notified')));
	// XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'confirmed')).SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'confirmed')));
	XTD();
	$confirmedtxt = SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'confirmed'));
	if (($confirmedtxt != "Yes" )&&($confirmedtxt != "No" )&&($confirmedtxt != "???" )) {
		XTXT("");
	} else {
		$txtcolor = "black";
		if ($confirmedtxt == "Yes" ) { $txtcolor = "green"; }
		if ($confirmedtxt == "No" ) { $txtcolor = "red"; }
		if ($confirmedtxt == "???" ) { $txtcolor = "orange"; }
		$link = YPGMLINK("notificationlogout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("NotificationType","TeamSelection").YPGMPARM("NotificationEventId",$infrsid).YPGMPARM("NotificationPersonId",$personid);
		XLINKTXTCOLORNEWWINDOW($link,$confirmedtxt,$txtcolor,"Notifications");;
	}	
	X_TD();
	$traveltxt = SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'travel')).SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'travel'));
	if ($frs_meettotravel == "Yes" ) {
		XTDTXT($traveltxt);
	} else {
		XTDTXT("");
	}	
	
	X_TR();	
}
X_TABLE();
XBR();XBR();
XINCHECKBOXCONFIRMACTION("Test","No","Preview Mode - Allows Email/SMS messages to be checked before sending");XBR();
XBR();XINRADIO ("NotifyMethod","Both","checked","Send both Email and SMS" );
XBR();XINRADIO ("NotifyMethod","Email","","Send Email Only" );
XBR();XINRADIO ("NotifyMethod","SMS","","Send SMS only" );
XPTXT('Note: SMS texts are only ever sent to "Selected" players and officials.');
XBR();XBR();
XINHID("totalnotificationlist",$totalnotificationlist);
XINHID("selectednotificationlist",$selectednotificationlist);
XINHID("timestamp",$selectednotificationlist);
if ($GLOBALS{'frs_cancellation'} == "Yes" ) {
	if ($GLOBALS{'frs_selectiondraft'} == "Yes") { XINSUBMITID("ConfirmActionSubmit","Send out Cancellation Notifications for this Match"); }
	else { XINSUBMITID("ConfirmActionSubmit","Send out Cancellation Notifications for this Match"); }
} else {
	if ($GLOBALS{'frs_selectiondraft'} == "Yes") { XINSUBMITID("ConfirmActionSubmit","Send out Notifications for this Match and Publish Selection"); }
	else { XINSUBMITID("ConfirmActionSubmit","Send out Notifications for this Match"); }
}
X_FORM();
XBR();
$link = YPGMLINK("frsteamselectionout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("section_name",$insectionname).YPGMPARM("team_code",$inteamcode).YPGMPARM("frs_id",$infrsid);
XTDLINKTXT($link,'Make further Selection changes');

Back_Navigator();
PageFooter("Default","Final");
=======
<?php # frsteamselectionin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITEJSOPTIONAL'} = "confirmaction,frsnotification";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insectionname = $_REQUEST['section_name'];
$inteamcode = $_REQUEST['team_code'];
$infrsid = $_REQUEST['FrsId'];
$infrsvenue = ""; if (isset($_REQUEST['frs_venue'])) { $infrsvenue = $_REQUEST['frs_venue']; }
$infrsawayvenue = ""; if (isset($_REQUEST['frs_awayvenue'])) { $infrsawayvenue = $_REQUEST['frs_awayvenue']; }
$infrstime = StandardTime($_REQUEST['frs_time']);
$infrstimeend = StandardTime($_REQUEST['frs_timeend']);
$infrsmeet = $_REQUEST['frs_meet'];
$infrsmeettotravel = $_REQUEST['frs_meettotravel'];
$infrsmeetextra = $_REQUEST['frs_meetextra'];
$infrscancellation = $_REQUEST['frs_cancellation'];
$infrsselectiondraft = $_REQUEST['frs_selectiondraft'];

Get_Data("section",$GLOBALS{'currperiodid'},$insectionname);
Get_Data("team",$GLOBALS{'currperiodid'},$inteamcode);
Get_Data("frs",$GLOBALS{'currperiodid'},$inteamcode, $infrsid);
if ($GLOBALS{'section_sportid'} == "") { Get_Data("sport_".$GLOBALS{'domain_sportid'}); }
else { Get_Data("sport_".$GLOBALS{'section_sportid'}); }

XH2("Selection Update: (".$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}).")");

$GLOBALS{'frs_venue'} = $infrsvenue;
$GLOBALS{'frs_awayvenue'} = $infrsawayvenue;
$GLOBALS{'frs_time'} = $infrstime;
$GLOBALS{'frs_timeend'} = $infrstimeend;
$GLOBALS{'frs_meettotravel'} = $infrsmeettotravel;
$GLOBALS{'frs_meet'} = $infrsmeet;
$GLOBALS{'frs_meetextra'} = $infrsmeetextra;
$GLOBALS{'frs_cancellation'} = $infrscancellation;
$GLOBALS{'frs_selectiondraft'} = $infrsselectiondraft;
$squada = explode(',',$GLOBALS{'team_squadlist'});

$sortarray = Array();

// Add extra non squad players to player list
if (isset($_REQUEST['extranonsquadselectedlist'])) {
	if ($_REQUEST['extranonsquadselectedlist'] != "") {
		$extranonsquada = explode(',',$_REQUEST['extranonsquadselectedlist']);
		foreach ($extranonsquada as $personid)  {
			Check_Data('person',$personid);
			if ($GLOBALS{'IOWARNING'} == "0") {
				UpdateSelectionList('frs_playerselectedlist',$personid,'selected',"Y");
			}
		}
	}
}

// tidy up non selected non squad players
$nonselectedplayera = GetSelectionListPersonIds('frs_playerselectedlist',"selected","N");
foreach ($nonselectedplayera as $nonselectedplayerid)  {
	if (in_array($nonselectedplayerid, $squada)) {	}
	else {
		DeleteFromSelectionList('frs_playerselectedlist',$nonselectedplayerid);
	}
}

// Sort out and sequence all players
$playerlista = GetSelectionListPersonIds ('frs_playerselectedlist',"all","");
$totalplayera = array_unique(array_merge($playerlista, $squada));
foreach ($totalplayera as $personid)  {	
	if (isset($_REQUEST['player_'.$personid])) {
		// get latest selection status from checkbox in form
		$selectedcode = $_REQUEST['player_'.$personid];
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			UpdateSelectionList('frs_playerselectedlist',$personid,'selected',$selectedcode);
			if (( $selectedcode == "Y" )||( in_array($personid, $squada) )) {
				if ( $selectedcode == "Y" ) { $selectedsortcode = "2"; } 
				else { $selectedsortcode = "3"; }
				if (in_array($personid, $squada)) { $squadstatus = "Squad"; } else { $squadstatus = "NonSquad"; }
				$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|".$squadstatus;
				array_push($sortarray, $record);
			}
		}
	} else {
		// get latest selection status from list (probably a new non squad selection
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$selectedcode = GetSelectionList('frs_playerselectedlist',$personid,'selected');
			if ( $selectedcode == "Y" ) { $selectedsortcode = "2"; } 
			else { $selectedsortcode = "3"; }
			if (in_array($personid, $squada)) { $squadstatus = "Squad"; } else { $squadstatus = "NonSquad"; }
			$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|".$squadstatus;
			array_push($sortarray, $record);
		}
	}
}

// Add extra officials to official list
if (isset($_REQUEST['extraofficialselectedlist'])) {
	if ($_REQUEST['extraofficialselectedlist'] != "") {
		$extraofficiala = explode(',',$_REQUEST['extraofficialselectedlist']);
		foreach ($extraofficiala as $personid)  {
			Check_Data('person',$personid);
			if ($GLOBALS{'IOWARNING'} == "0") {
				UpdateSelectionList('frs_officialselectedlist',$personid,'selected',"Y");
				// XH1($personid." Official Added");
			}
		}
	}
}

// tidy up non selected officials
$nonselectedofficiala = GetSelectionListPersonIds ('frs_officialselectedlist',"selected","N");
foreach ($nonselectedofficiala as $nonselectedofficialid)  {
	DeleteFromSelectionList('frs_officialselectedlist',$nonselectedofficialid);
	// XH1($nonselectedofficialid." Official Deleted");
}

// Sort out and sequence all officials
$officiallista = GetSelectionListPersonIds ('frs_officialselectedlist',"all","");
foreach ($officiallista as $personid)  {
	
	if (isset($_REQUEST['official_'.$personid])) {
		// get latest selection status from checkbox in form
		$selectedcode = $_REQUEST['official_'.$personid];
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			UpdateSelectionList('frs_officialselectedlist',$personid,'selected',$selectedcode);
			// XH1($personid." Official Updated");
			if ( $selectedcode == "Y" ) {
				$selectedsortcode = "0";
				$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|"."Official";
				array_push($sortarray, $record);
			}
		}
	} else {
		// get latest selection status from list (probably a new non squad selection
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$selectedcode = GetSelectionList('frs_officialselectedlist',$personid,'selected');
			$selectedsortcode = "0";
			$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|"."Official";
			array_push($sortarray, $record);
		}
	}
}

// Include sequence mamagement/coaches
if ($GLOBALS{'team_mgr'} != "") {
	$splitstra = List2Array($GLOBALS{'team_mgr'});
	foreach ($splitstra as $personid)  {	
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$selectedsortcode = "0";
			$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|"."Manager";;
			array_push($sortarray, $record);
		}
	}
}
if ($GLOBALS{'team_coach'} != "") {
	$splitstra = List2Array($GLOBALS{'team_coach'});
	foreach ($splitstra as $personid)  {	
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$selectedsortcode = "0";
			$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|"."Coach";;
			array_push($sortarray, $record);
		}
	}
}
$GLOBALS{'frs_timestamp'} = $GLOBALS{'currentYYYYMMDDHHMMSS'}; // used to prevent accidental multiple resend of emails and sms
Write_Data("frs",$GLOBALS{'currperiodid'},$inteamcode,$infrsid);

sort($sortarray);
$totalnotificationlist = "";
$selectednotificationlist = "";

if ($GLOBALS{'frs_cancellation'} == "Yes" ) {
	XH3('<span style="color:red">Match Cancelled</span>');
}

if ($GLOBALS{'frs_selectiondraft'} == "Yes") { XH3('Team Selection Summary - <span style="color:red"><b>Draft (Not yet published)</b></span>'); }
else { XH3('Team Selection Summary'); }

XFORM("frsteamnotificationin.php","ConfirmActionForm");
XINSTDHID();
XINHID("section_name",$insectionname);
XINHID("team_code",$inteamcode);
XINHID("FrsId",$infrsid); 

XINHID("ConfirmActionText","This will generate any requested SMS and EMails. Do you wish to continue"); 
XINHID("ConfirmActionStatus","No");

XTABLE();
XTR();XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Email");XTDHTXT("Mobile");XTDHTXT("");XTDHTXT("Position");XTDHTXT("ShirtNo");XTDHTXT("Planned");
XTDHTXT("Available");XTDHTXT("Selected");XTDHTXT("Notify");XTDHTXT("Prev<br>Notify");XTDHTXT("Confirmed");XTDHTXT("Travel");X_TR();
# id, name, value, checked, text
$optionstext = YINCHECKBOXID('tick_all','tick_all',"","","All").YBR().YINCHECKBOXID('tick_selected','tick_selected',"","","Selected").YBR().YINCHECKBOXID('tick_none','tick_none',"","","Clear").YBR();
XTR();XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");
XTDTXT("");XTDTXT("");XTDTXT($optionstext);XTDTXT("");XTDTXT("");XTDTXT("");X_TR();
$lastcode = "9";
foreach ($sortarray as $record)  {
	$bitsa = explode('|',$record);
	if (($bitsa[0] != $lastcode) && ($lastcode != "9")) { 
	    XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");
		XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
	}
	$lastcode = $bitsa[0];
	$personid = $bitsa[3];
	$totalnotificationlist = $totalnotificationlist.$personid.",";
	Get_Data('person',$personid);
	XTR();XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
	XTDTXT(Chosen_Person_Email());
	XTDTXT(Chosen_Person_SMS());
	XTDTXT($bitsa[4]);	
	XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'planned')).SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'planned')));
	XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'availability')).SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'availability')));
	$colour = "black";
	$defaultnotification = "No";
	if (($bitsa[4] == "Manager")||($bitsa[4] == "Coach")) {
		$defaultnotification = "Yes";
	}
	if (($bitsa[4] == "Official")) {
		if (GetSelectionList('frs_officialselectedlist',$personid,'selected') == "Y") { 
			$colour = "green"; 
			$defaultnotification = "Yes";
			$selectednotificationlist = $selectednotificationlist.$personid.",";
		}	
	}
	if (($bitsa[4] == "Squad")||($bitsa[4] == "NonSquad")) {
		if (GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y") { 
			$colour = "green"; 
			$defaultnotification = "Yes";
			$selectednotificationlist = $selectednotificationlist.$personid.",";
		}	
	}
	XTDTXT($GLOBALS{'person_position'});
	XTDTXT($GLOBALS{'person_shirtnumber'});
	XTD();XTXTCOLOR(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'selected')).SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'selected')),$colour);	
	XTDINCHECKBOXYESNOID('tobenotified_'.$personid,'tobenotified_'.$personid,$defaultnotification,"");
	XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'notified')).SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'notified')));
	// XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'confirmed')).SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'confirmed')));
	XTD();
	$confirmedtxt = SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'confirmed'));
	if (($confirmedtxt != "Yes" )&&($confirmedtxt != "No" )&&($confirmedtxt != "???" )) {
		XTXT("");
	} else {
		$txtcolor = "black";
		if ($confirmedtxt == "Yes" ) { $txtcolor = "green"; }
		if ($confirmedtxt == "No" ) { $txtcolor = "red"; }
		if ($confirmedtxt == "???" ) { $txtcolor = "orange"; }
		$link = YPGMLINK("notificationlogout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("NotificationType","TeamSelection").YPGMPARM("NotificationEventId",$infrsid).YPGMPARM("NotificationPersonId",$personid);
		XLINKTXTCOLORNEWWINDOW($link,$confirmedtxt,$txtcolor,"Notifications");;
	}	
	X_TD();
	$traveltxt = SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'travel')).SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'travel'));
	if ($frs_meettotravel == "Yes" ) {
		XTDTXT($traveltxt);
	} else {
		XTDTXT("");
	}	
	
	X_TR();	
}
X_TABLE();
XBR();XBR();
XINCHECKBOXCONFIRMACTION("Test","No","Preview Mode - Allows Email/SMS messages to be checked before sending");XBR();
XBR();XINRADIO ("NotifyMethod","Both","checked","Send both Email and SMS" );
XBR();XINRADIO ("NotifyMethod","Email","","Send Email Only" );
XBR();XINRADIO ("NotifyMethod","SMS","","Send SMS only" );
XPTXT('Note: SMS texts are only ever sent to "Selected" players and officials.');
XBR();XBR();
XINHID("totalnotificationlist",$totalnotificationlist);
XINHID("selectednotificationlist",$selectednotificationlist);
XINHID("timestamp",$selectednotificationlist);
if ($GLOBALS{'frs_cancellation'} == "Yes" ) {
	if ($GLOBALS{'frs_selectiondraft'} == "Yes") { XINSUBMITID("ConfirmActionSubmit","Send out Cancellation Notifications for this Match"); }
	else { XINSUBMITID("ConfirmActionSubmit","Send out Cancellation Notifications for this Match"); }
} else {
	if ($GLOBALS{'frs_selectiondraft'} == "Yes") { XINSUBMITID("ConfirmActionSubmit","Send out Notifications for this Match and Publish Selection"); }
	else { XINSUBMITID("ConfirmActionSubmit","Send out Notifications for this Match"); }
}
X_FORM();
XBR();
$link = YPGMLINK("frsteamselectionout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("section_name",$insectionname).YPGMPARM("team_code",$inteamcode).YPGMPARM("frs_id",$infrsid);
XTDLINKTXT($link,'Make further Selection changes');

Back_Navigator();
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
