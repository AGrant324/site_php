<<<<<<< HEAD
<?php # frsteamselectionin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insectionname = $_REQUEST['section_name'];
$inteamcode = $_REQUEST['team_code'];
$infrsid = $_REQUEST['FrsId'];
$intest = $_REQUEST['Test']; // Preview only
$inconfirmactionstatus = $_REQUEST['ConfirmActionStatus'];
$innotifymethod = $_REQUEST['NotifyMethod'];
$inoverride = "No";
if (isset($_REQUEST['Override'])) { // permits duplicate notification
	$inoverride = $_REQUEST['Override']; 
}
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$askingperson_id = $GLOBALS{'LOGIN_person_id'};
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};

Get_Data("team",$GLOBALS{'currperiodid'},$inteamcode);
Get_Data("frs",$GLOBALS{'currperiodid'},$inteamcode, $infrsid);
$infrstimestamp = $GLOBALS{'frs_timestamp'};

$notificationtype = "Team Selection";
if ($GLOBALS{'frs_cancellation'} == "Yes" ) { 
	$notificationtype = "Cancellation";
	$inoverride = "Yes";  // just send !!
}

XH2($notificationtype." Notification (".$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}).")");
if (($inconfirmactionstatus == "No")&&($intest == "No")) {
	$intest == "Yes";
	XH1("Distribution Not Confirmed");	
}	


// ======= check whether anyone has aleady been notified =========
$alreadynotified = "0";
$alreadynotifieda = Array();
$notyetnotifieda = Array();
$playera = GetSelectionListPersonIds ('frs_playerselectedlist',"all","");
$officiala = GetSelectionListPersonIds ('frs_officialselectedlist',"all","");
$mgmta = Array();
$splitstra = List2Array($GLOBALS{'team_mgr'}); foreach ($splitstra as $tperson_id)  { array_push($mgmta, $tperson_id); }
$splitstra = List2Array($GLOBALS{'team_coach'}); foreach ($splitstra as $tperson_id)  { array_push($mgmta, $tperson_id); }
$totalsmsa = array_unique(array_merge($playera, $officiala));
$totalemaila = array_unique(array_merge($playera, $officiala, $mgmta));
$GLOBALS{'frs_selectiondraft'} = "No";
foreach ($totalemaila as $personid)  {	
	if (isset($_REQUEST['tobenotified_'.$personid])) {
		if ($_REQUEST['tobenotified_'.$personid] == "Yes") {
			if (GetSelectionList('frs_playerselectedlist',$personid,'notified') == "Y") {
				$alreadynotified = "1";
				array_push($alreadynotifieda, $personid);
			} else {
				array_push($notyetnotifieda, $personid);
			}
		}
	}
}

if (( $alreadynotified == "1" )&&($inoverride != "Yes")&&($intest != "Yes")) {
	// ======= warn about existing notifications =========
	XPTXTCOLOR("Warning - the following list contains people that already been notified.","red");
	XPTXT("Press confirm if you wish to resend these notifications.");
	XHR();
	XPTXTCOLOR("<b>Already Notified,</b>","red");	
	foreach ($alreadynotifieda as $personid)  {	
		Check_Data("person",$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			XPTXTCOLOR($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red" );
		}
	}
	XHR();
	XPTXTCOLOR("<b>New notifications</b>","green");	
	foreach ($notyetnotifieda as $personid)  {
		Check_Data("person",$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			XPTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"green" );
		}
	}	
	
	XHR();	
	XFORM("frsteamnotificationin.php","overridenotification");
	XINSTDHID();
	XINHID("section_name",$insectionname);
	XINHID("team_code",$inteamcode);
	XINHID("FrsId",$infrsid);	
	XINHID("Test",$intest);
	XINHID("ConfirmActionStatus",$inconfirmactionstatus);	
	XINHID("NotifyMethod",$innotifymethod);
	XINHID("Override","Yes");
	foreach ($totalemaila as $personid)  {
		if (isset($_REQUEST['tobenotified_'.$personid])) {
			XINHID('tobenotified_'.$personid,$_REQUEST['tobenotified_'.$personid]);
		}
	}	
	XINSUBMIT("Confirm Resend Notifications");
	X_FORM();
	XBR();XBR();
	XINBUTTONBACK("Cancel");	
} else {
	// ======= send out notifications (or simulate if test) =========	
	$tvenue_name = "";
	if ($GLOBALS{'frs_ha'} == "H") {
		Check_Data('venue',$GLOBALS{'frs_venue'});
		if ($GLOBALS{'IOWARNING'} == "0") { $tvenue_name = $GLOBALS{'venue_name'}; }
		else { $tvenue_name = $GLOBALS{'frs_venue'}; }
	} else { 
		$tvenue_name = $GLOBALS{'frs_awayvenue'};
	}
	
	$selectedlist = ""; $sep = " ";
	$selectednamelist = "";
	$nonselectednamelist = "";
	$officialnamelist = "";
	foreach ($playera as $personid)  {
		Check_Data("person",$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			if ( GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y" ) {
				$selectednamelist = $selectednamelist.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.'<br/>';
			} else {
				$nonselectednamelist = $nonselectednamelist.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.'<br/>';
			}
		}
	}
	foreach ($officiala as $personid)  {
		Check_Data("person",$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			if ( GetSelectionList('frs_officialselectedlist',$personid,'selected') == "Y" ) {
				$officialnamelist = $officialnamelist.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.'<br/>';
			}
		}
	}
	
	if ($innotifymethod == "Both") { XPTXT("You have requested both Email and SMS messages"); }
	if ($innotifymethod == "SMS") { XPTXT("You have requested SMS only messages"); }
	if ($innotifymethod == "Email") { XPTXT("You have requested Email only messages"); }

	
	// Explain what is going to happen with these notifications
	if ($intest == "Yes") { 
		XTABLE();
		XTR();XTD();
		XTXTCOLOR("Preview Mode - The following messages have not yet been sent out","red"); 
		XBR();XBR();
		$link = YPGMLINK("frsteamnotificationin.php").YPGMSTDPARMS();
		$link = $link.YPGMPARM("section_name",$insectionname);	
		$link = $link.YPGMPARM("team_code",$inteamcode);
		$link = $link.YPGMPARM("FrsId",$infrsid);	
		$link = $link.YPGMPARM("Test","No");
		$link = $link.YPGMPARM("Override","No");		
		$link = $link.YPGMPARM("ConfirmActionStatus","Yes");
		$link = $link.YPGMPARM("NotifyMethod",$innotifymethod);	
		foreach ($totalemaila as $personid)  {
			if (isset($_REQUEST['tobenotified_'.$personid])) {
				$link = $link.YPGMPARM('tobenotified_'.$personid,$_REQUEST['tobenotified_'.$personid]);
			}
		}
		XLINKBUTTON($link,"I'm OK with this preview. Now send out SMS Texts and Emails.");
		XBR();XBR();
		XLINKBACKBUTTON("Cancel. Don't send out SMS Texts and Emails yet.");
		XBR();
		X_TD();X_TR();
		X_TABLE();
		if (( $alreadynotified == "1" )&&($inoverride != "Yes")) {
			// ======= warn about existing notifications =========
			XBR();XPTXTCOLOR("Warning - the following list also contains people that already been notified.","red");
		}
	} else { 
		// ======== update database with notified people =================
		if ($infrstimestamp != "") {
			// emails and messages have not yet been sent
			XTXTCOLOR("The following messages have been sent out","green"); 			
			$GLOBALS{'frs_selectiondraft'} = "No";
			foreach ($totalemaila as $personid)  {
				if (isset($_REQUEST['tobenotified_'.$personid])) {
					if ($_REQUEST['tobenotified_'.$personid] == "Yes") {
						if (in_array($personid, $playera)) {
							UpdateSelectionList('frs_playerselectedlist',$personid,'notified',"Y");
						}
						if (in_array($personid, $officiala)) {
							UpdateSelectionList('frs_officialselectedlist',$personid,'notified',"Y");
						}
					}
				}
			}
			$GLOBALS{'frs_timestamp'} = ""; // used to prevent accidental multiple resend of emails and sms
			Write_Data("frs",$GLOBALS{'currperiodid'},$inteamcode,$infrsid);
		} else {
			XPTXTCOLOR("Warning: Potentially Duplicate Emails and SMS texts have not been sent.","red");
			// this must be a browser reload or resend - stop this to prevent multiple emails and sms texts being sent
			XPTXTCOLOR("Browser Refresh/Reload is not permitted on this page","red");			
		}
	}

	// send or display the SMS and Email messages
	if ($infrstimestamp != "") { // only if nothing has been actually sent in this notification stage
		if (($innotifymethod == "Both")||($innotifymethod == "SMS")) {
			XBR();
			// ============= SMS  =============================
			XH2("SMS messages"); 
			foreach ($totalsmsa as $personid)  {	
				if (isset($_REQUEST['tobenotified_'.$personid])) {	
					if ($_REQUEST['tobenotified_'.$personid] == "Yes") {
						if (( GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y" )||
						    ( GetSelectionList('frs_officialselectedlist',$personid,'selected') == "Y" )) {
							Check_Data("person",$personid);
							if ($GLOBALS{'IOWARNING'} == "0") {
								$smsto = Chosen_Person_SMS();
								$smsfrom = "07537438572";
								$smsalert = "";
								if ($GLOBALS{'frs_cancellation'} == "Yes" ) {
									$smsalert = "MATCH CANCELLED - ";
								}
								$smsmessage = $smsalert.$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'})." - ";
								$smsmessage = $smsmessage.$tvenue_name." ";
								$smsmessage = $smsmessage.$GLOBALS{'frs_time'}." Start ";
								if ($GLOBALS{'frs_cancellation'} != "Yes" ) {
									$smsmessage = $smsmessage.$GLOBALS{'frs_meet'};			
									if ($GLOBALS{'frs_meettotravel'} == "Yes") {
										$smsmessage = $smsmessage." - Reply Y (Meet), D (Direct) or N";
									} else {							
										$smsmessage = $smsmessage." - Reply Y or N";
									}
								}
								if (strlen($smsmessage) > 155) {
									$extra = strlen($smsmessage) - 155; 
									$lengthmeet = strlen($GLOBALS{'frs_meet'}) - $extra;
									$newmeet = substr($GLOBALS{'frs_meet'},0,$lengthmeet);
									$smsmessage = $GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'})." - ";
									$smsmessage = $smsmessage.$tvenue_name." ";
									if ($GLOBALS{'frs_cancellation'} != "Yes" ) {
										$smsmessage = $smsmessage.$GLOBALS{'frs_time'}." Start ";									
										$smsmessage = $smsmessage.$newmeet;
										if ($GLOBALS{'frs_meettotravel'} == "Yes") {
											$smsmessage = $smsmessage." - Reply Y (Meet), D (Direct) or N";
										} else {							
											$smsmessage = $smsmessage." - Reply Y or N";
										}
									}
								}
								$smsreference = $GLOBALS{'currentYYYYMMDDHHMMSS'}."-TeamSelection-".$infrsid."-".$personid;
								$smsexpirydate = AddMonth("20".$infrsid[2].$infrsid[3]."-".$infrsid[4].$infrsid[5]."-".$infrsid[6].$infrsid[7],1);
								if ($intest == "Yes") { SMS_Display($smsfrom,$askingperson_id,$askingperson_fname,$askingperson_sname,$smsto,$personid,$GLOBALS{'person_fname'},$GLOBALS{'person_sname'},$smsmessage,$smsreference); }
								else { SMS_Output("display",$smsfrom,$askingperson_id,$askingperson_fname,$askingperson_sname,$smsto,$personid,$GLOBALS{'person_fname'},$GLOBALS{'person_sname'},$smsmessage,$smsreference,$smsexpirydate); }
								if ((in_array($personid, $alreadynotifieda))&&($inoverride != "Yes")) {
									XPTXTCOLOR("Warning - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." has already been notified.","red");
								}							
							}
						}
					}
				}
			}
		}
			
		if (($innotifymethod == "Both")||($innotifymethod == "Email")) {	
			XBR();
			// ============= Email  =============================
			XH2("Email messages");
			foreach ($totalemaila as $personid)  {	
				if (isset($_REQUEST['tobenotified_'.$personid])) {	
					if ($_REQUEST['tobenotified_'.$personid] == "Yes") {
						Check_Data("person",$personid);
						if ($GLOBALS{'IOWARNING'} == "0") {			
							$toperson_email = "";
							$ccperson_email = "";
							$underage = UnderAge(18,$GLOBALS{'person_dob'});
							if ($underage) {
								if ($GLOBALS{'person_email1'} != "") {
									$toperson_email = $GLOBALS{'person_email1'};
									if ($GLOBALS{'person_email3'} != $GLOBALS{'person_email1'}) {
										$ccperson_email = $GLOBALS{'person_email3'};
									}
								} else {
									$toperson_email = $GLOBALS{'person_email3'};
								}
							} else {
								$toperson_email = $GLOBALS{'person_email1'};
							}
							$emailto = $toperson_email;
							$emailcc = $ccperson_email;
							$emailbcc = "";				
							$emailexpirydate = AddMonth("20".$infrsid[2].$infrsid[3]."-".$infrsid[4].$infrsid[5]."-".$infrsid[6].$infrsid[7],1);
							$Ylink = YPGMLINK("frsteamconfirmationemailin.php").YPGMPARM("ServiceId",$GLOBALS{'LOGIN_service_id'}).YPGMPARM("DomainId",$GLOBALS{'LOGIN_domain_id'}).YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'});
							$Ylink = $Ylink.YPGMPARM("SelectionPersonId",$personid).YPGMPARM("TeamCode",$inteamcode).YPGMPARM("FrsId",$infrsid).YPGMPARM("ConfirmationStatus","Y");
							$Ylinkinsert = YLINKIMGNEWWINDOW(MakeUrlHTTP($Ylink),MakeUrlHTTP($GLOBALS{'site_asseturl'})."/SelectionYesBase.png","Confirm","50","50","");
							$Nlink = YPGMLINK("frsteamconfirmationemailin.php").YPGMPARM("ServiceId",$GLOBALS{'LOGIN_service_id'}).YPGMPARM("DomainId",$GLOBALS{'LOGIN_domain_id'}).YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'});
							$Nlink = $Nlink.YPGMPARM("SelectionPersonId",$personid).YPGMPARM("TeamCode",$inteamcode).YPGMPARM("FrsId",$infrsid).YPGMPARM("ConfirmationStatus","N");
							$Nlinkinsert = YLINKIMGNEWWINDOW(MakeUrlHTTP($Nlink),MakeUrlHTTP($GLOBALS{'site_asseturl'})."/SelectionNoBase.png","Confirm","50","50","");
							$Mlink = YPGMLINK("frsteamconfirmationemailin.php").YPGMPARM("ServiceId",$GLOBALS{'LOGIN_service_id'}).YPGMPARM("DomainId",$GLOBALS{'LOGIN_domain_id'}).YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'});
							$Mlink = $Mlink.YPGMPARM("SelectionPersonId",$personid).YPGMPARM("TeamCode",$inteamcode).YPGMPARM("FrsId",$infrsid).YPGMPARM("ConfirmationStatus","M");
							$Mlinkinsert = YLINKIMGNEWWINDOW(MakeUrlHTTP($Mlink),MakeUrlHTTP($GLOBALS{'site_asseturl'})."/SelectionMeetBase.png","Confirm","50","50","");
							$Dlink = YPGMLINK("frsteamconfirmationemailin.php").YPGMPARM("ServiceId",$GLOBALS{'LOGIN_service_id'}).YPGMPARM("DomainId",$GLOBALS{'LOGIN_domain_id'}).YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'});
							$Dlink = $Dlink.YPGMPARM("SelectionPersonId",$personid).YPGMPARM("TeamCode",$inteamcode).YPGMPARM("FrsId",$infrsid).YPGMPARM("ConfirmationStatus","D");
							$Dlinkinsert = YLINKIMGNEWWINDOW(MakeUrlHTTP($Dlink),MakeUrlHTTP($GLOBALS{'site_asseturl'})."/SelectionDirectBase.png","Confirm","50","50","");
							$emailfrompersonid = $askingperson_id;
							$emailtopersonid = $personid;
							$emailreference = $GLOBALS{'currentYYYYMMDDHHMMSS'}."-TeamSelection-".$infrsid."-".$personid;				
							$emailfrom = $askingperson_email;
							$emailfooter1 = $GLOBALS{'domain_longname'};
							$emailfooter2 = "";

							$emailalert = "";
							if ($GLOBALS{'frs_cancellation'} == "Yes" ) {
								$emailalert = "MATCH CANCELLED - ";
							}
							$emailsubject = $emailalert.$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' - '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'});
							$mainmessage = 'Dear '.$GLOBALS{'person_fname'}."<br/><br/>";

							
							if ($GLOBALS{'frs_cancellation'} == "Yes" ) {
								$mainmessage = $mainmessage."This match has been cancelled.<br/><br/>";
								if ($GLOBALS{'frs_meet'} != "") { $mainmessage = $mainmessage.$GLOBALS{'frs_meet'}."<br/><br/>"; }
								if ($GLOBALS{'frs_meetextra'} != "") { $mainmessage = $mainmessage.$GLOBALS{'frs_meetextra'}."<br/><br/>"; }								
							} else {
								$mainmessage = $mainmessage."Here are the details for our next match<br/><br/>";		
								$mainmessage = $mainmessage."Opposition: ".$GLOBALS{'frs_oppo'}."<br/>";			
								$mainmessage = $mainmessage."Venue: ".$tvenue_name."<br/>";
								$mainmessage = $mainmessage."Start Time: ".$GLOBALS{'frs_time'}."<br/>";
								if ($GLOBALS{'frs_meet'} != "") { $mainmessage = $mainmessage."Arrangements: ".$GLOBALS{'frs_meet'}."<br/><br/>"; }
								if ($GLOBALS{'frs_meetextra'} != "") { $mainmessage = $mainmessage.$GLOBALS{'frs_meetextra'}."<br/><br/>"; }
								$mainmessage = $mainmessage."<hr>Our team for this match is:-<br/><br/>";
								$mainmessage = $mainmessage.$selectednamelist."<br/>";
								$mainmessage = $mainmessage."<hr>Umpire(s):-<br/><br/>";
								$mainmessage = $mainmessage.$officialnamelist."<br/>";
											
								if (( GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y" )||
								    ( GetSelectionList('frs_officialselectedlist',$personid,'selected') == "Y" )) {
									$mainmessage = $mainmessage."<hr>Please confirm your availability by pressing one of the buttons below<br/><br/>";				
									$mainmessage = $mainmessage."<table>";	
									if ($GLOBALS{'frs_meettotravel'} == "Yes") {
										$mainmessage = $mainmessage."<tr><td>".$Mlinkinsert."</td>"."<td><h3>Yes, I am available and will come to the meeting point.</h3></td></tr>";	
										$mainmessage = $mainmessage."<tr><td>".$Dlinkinsert."</td>"."<td><h3>Yes, I am available and will travel direct.</h3></td></tr>";			
										$mainmessage = $mainmessage."<tr><td>".$Nlinkinsert."</td>"."<td><h3>Sorry, I am not available.</h3></td></tr>";		
									} else {							
										$mainmessage = $mainmessage."<tr><td>".$Ylinkinsert."</td>"."<td><h3>Yes, I am available.</h3></td></tr>";			
										$mainmessage = $mainmessage."<tr><td>".$Nlinkinsert."</td>"."<td><h3>Sorry, I am not available.</h3></td></tr>";	
									}
									$mainmessage = $mainmessage."</table>";
								}
							}
							/*
							$featuredtype = "Event";
							$featuredid = "E00020";
							if ( $featuredtype == "Event") {
								$event_id = $featuredid;
								Get_Data("event",$featuredid);
								$link = 'http:'.YPGMLINK("webpageeventwebview.php");
								$link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);
								$mainmessage = $mainmessage.'<table border="0"><tr><td border="0">';
								$mainmessage = $mainmessage.'<table border="0"><tr>';
								if ($GLOBALS{'event_featuredimage'} != "") {
									$mainmessage = $mainmessage.'<td border="0"><br>'.'<a href="'.$link.'"><img src="http:'.$GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'}.'" width="200" /></a>';
									$mainmessage = $mainmessage.'<td border="0"> </td>';
								}
								$mainmessage = $mainmessage.'<td border="0">'.YH3($GLOBALS{'event_title'}).'<br>'.$GLOBALS{'event_excerpt'}."..".YLINKTXT($link,"Read More..");
									
								$mainmessage = $mainmessage.'</td>';
								$mainmessage = $mainmessage.'</tr></table>';
								$mainmessage = $mainmessage.'</td></tr></table>';
							}
							*/
							
			
							$emailcontent = $mainmessage."<br><br> Many Thanks,<br><br>".$askingperson_fname.' '.$askingperson_sname.'<br><br>';
							
							if ($intest == "Yes") {	Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); }			
							else { HTMLEmailRecorded_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2,$emailfrompersonid,$emailtopersonid,$emailreference,$emailexpirydate); }
							if ((in_array($personid, $alreadynotifieda))&&($inoverride != "Yes")) {
								XPTXTCOLOR("Warning - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." has already been notified.","red");
							}
						}
					}
				}
			}
		}
	}
}
	
Back_Navigator();
PageFooter("Default","Final");
=======
<?php # frsteamselectionin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insectionname = $_REQUEST['section_name'];
$inteamcode = $_REQUEST['team_code'];
$infrsid = $_REQUEST['FrsId'];
$intest = $_REQUEST['Test']; // Preview only
$inconfirmactionstatus = $_REQUEST['ConfirmActionStatus'];
$innotifymethod = $_REQUEST['NotifyMethod'];
$inoverride = "No";
if (isset($_REQUEST['Override'])) { // permits duplicate notification
	$inoverride = $_REQUEST['Override']; 
}
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$askingperson_id = $GLOBALS{'LOGIN_person_id'};
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};

Get_Data("team",$GLOBALS{'currperiodid'},$inteamcode);
Get_Data("frs",$GLOBALS{'currperiodid'},$inteamcode, $infrsid);
$infrstimestamp = $GLOBALS{'frs_timestamp'};

$notificationtype = "Team Selection";
if ($GLOBALS{'frs_cancellation'} == "Yes" ) { 
	$notificationtype = "Cancellation";
	$inoverride = "Yes";  // just send !!
}

XH2($notificationtype." Notification (".$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}).")");
if (($inconfirmactionstatus == "No")&&($intest == "No")) {
	$intest == "Yes";
	XH1("Distribution Not Confirmed");	
}	


// ======= check whether anyone has aleady been notified =========
$alreadynotified = "0";
$alreadynotifieda = Array();
$notyetnotifieda = Array();
$playera = GetSelectionListPersonIds ('frs_playerselectedlist',"all","");
$officiala = GetSelectionListPersonIds ('frs_officialselectedlist',"all","");
$mgmta = Array();
$splitstra = List2Array($GLOBALS{'team_mgr'}); foreach ($splitstra as $tperson_id)  { array_push($mgmta, $tperson_id); }
$splitstra = List2Array($GLOBALS{'team_coach'}); foreach ($splitstra as $tperson_id)  { array_push($mgmta, $tperson_id); }
$totalsmsa = array_unique(array_merge($playera, $officiala));
$totalemaila = array_unique(array_merge($playera, $officiala, $mgmta));
$GLOBALS{'frs_selectiondraft'} = "No";
foreach ($totalemaila as $personid)  {	
	if (isset($_REQUEST['tobenotified_'.$personid])) {
		if ($_REQUEST['tobenotified_'.$personid] == "Yes") {
			if (GetSelectionList('frs_playerselectedlist',$personid,'notified') == "Y") {
				$alreadynotified = "1";
				array_push($alreadynotifieda, $personid);
			} else {
				array_push($notyetnotifieda, $personid);
			}
		}
	}
}

if (( $alreadynotified == "1" )&&($inoverride != "Yes")&&($intest != "Yes")) {
	// ======= warn about existing notifications =========
	XPTXTCOLOR("Warning - the following list contains people that already been notified.","red");
	XPTXT("Press confirm if you wish to resend these notifications.");
	XHR();
	XPTXTCOLOR("<b>Already Notified,</b>","red");	
	foreach ($alreadynotifieda as $personid)  {	
		Check_Data("person",$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			XPTXTCOLOR($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red" );
		}
	}
	XHR();
	XPTXTCOLOR("<b>New notifications</b>","green");	
	foreach ($notyetnotifieda as $personid)  {
		Check_Data("person",$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			XPTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"green" );
		}
	}	
	
	XHR();	
	XFORM("frsteamnotificationin.php","overridenotification");
	XINSTDHID();
	XINHID("section_name",$insectionname);
	XINHID("team_code",$inteamcode);
	XINHID("FrsId",$infrsid);	
	XINHID("Test",$intest);
	XINHID("ConfirmActionStatus",$inconfirmactionstatus);	
	XINHID("NotifyMethod",$innotifymethod);
	XINHID("Override","Yes");
	foreach ($totalemaila as $personid)  {
		if (isset($_REQUEST['tobenotified_'.$personid])) {
			XINHID('tobenotified_'.$personid,$_REQUEST['tobenotified_'.$personid]);
		}
	}	
	XINSUBMIT("Confirm Resend Notifications");
	X_FORM();
	XBR();XBR();
	XINBUTTONBACK("Cancel");	
} else {
	// ======= send out notifications (or simulate if test) =========	
	$tvenue_name = "";
	if ($GLOBALS{'frs_ha'} == "H") {
		Check_Data('venue',$GLOBALS{'frs_venue'});
		if ($GLOBALS{'IOWARNING'} == "0") { $tvenue_name = $GLOBALS{'venue_name'}; }
		else { $tvenue_name = $GLOBALS{'frs_venue'}; }
	} else { 
		$tvenue_name = $GLOBALS{'frs_awayvenue'};
	}
	
	$selectedlist = ""; $sep = " ";
	$selectednamelist = "";
	$nonselectednamelist = "";
	$officialnamelist = "";
	foreach ($playera as $personid)  {
		Check_Data("person",$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			if ( GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y" ) {
				$selectednamelist = $selectednamelist.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.'<br/>';
			} else {
				$nonselectednamelist = $nonselectednamelist.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.'<br/>';
			}
		}
	}
	foreach ($officiala as $personid)  {
		Check_Data("person",$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			if ( GetSelectionList('frs_officialselectedlist',$personid,'selected') == "Y" ) {
				$officialnamelist = $officialnamelist.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.'<br/>';
			}
		}
	}
	
	if ($innotifymethod == "Both") { XPTXT("You have requested both Email and SMS messages"); }
	if ($innotifymethod == "SMS") { XPTXT("You have requested SMS only messages"); }
	if ($innotifymethod == "Email") { XPTXT("You have requested Email only messages"); }

	
	// Explain what is going to happen with these notifications
	if ($intest == "Yes") { 
		XTABLE();
		XTR();XTD();
		XTXTCOLOR("Preview Mode - The following messages have not yet been sent out","red"); 
		XBR();XBR();
		$link = YPGMLINK("frsteamnotificationin.php").YPGMSTDPARMS();
		$link = $link.YPGMPARM("section_name",$insectionname);	
		$link = $link.YPGMPARM("team_code",$inteamcode);
		$link = $link.YPGMPARM("FrsId",$infrsid);	
		$link = $link.YPGMPARM("Test","No");
		$link = $link.YPGMPARM("Override","No");		
		$link = $link.YPGMPARM("ConfirmActionStatus","Yes");
		$link = $link.YPGMPARM("NotifyMethod",$innotifymethod);	
		foreach ($totalemaila as $personid)  {
			if (isset($_REQUEST['tobenotified_'.$personid])) {
				$link = $link.YPGMPARM('tobenotified_'.$personid,$_REQUEST['tobenotified_'.$personid]);
			}
		}
		XLINKBUTTON($link,"I'm OK with this preview. Now send out SMS Texts and Emails.");
		XBR();XBR();
		XLINKBACKBUTTON("Cancel. Don't send out SMS Texts and Emails yet.");
		XBR();
		X_TD();X_TR();
		X_TABLE();
		if (( $alreadynotified == "1" )&&($inoverride != "Yes")) {
			// ======= warn about existing notifications =========
			XBR();XPTXTCOLOR("Warning - the following list also contains people that already been notified.","red");
		}
	} else { 
		// ======== update database with notified people =================
		if ($infrstimestamp != "") {
			// emails and messages have not yet been sent
			XTXTCOLOR("The following messages have been sent out","green"); 			
			$GLOBALS{'frs_selectiondraft'} = "No";
			foreach ($totalemaila as $personid)  {
				if (isset($_REQUEST['tobenotified_'.$personid])) {
					if ($_REQUEST['tobenotified_'.$personid] == "Yes") {
						if (in_array($personid, $playera)) {
							UpdateSelectionList('frs_playerselectedlist',$personid,'notified',"Y");
						}
						if (in_array($personid, $officiala)) {
							UpdateSelectionList('frs_officialselectedlist',$personid,'notified',"Y");
						}
					}
				}
			}
			$GLOBALS{'frs_timestamp'} = ""; // used to prevent accidental multiple resend of emails and sms
			Write_Data("frs",$GLOBALS{'currperiodid'},$inteamcode,$infrsid);
		} else {
			XPTXTCOLOR("Warning: Potentially Duplicate Emails and SMS texts have not been sent.","red");
			// this must be a browser reload or resend - stop this to prevent multiple emails and sms texts being sent
			XPTXTCOLOR("Browser Refresh/Reload is not permitted on this page","red");			
		}
	}

	// send or display the SMS and Email messages
	if ($infrstimestamp != "") { // only if nothing has been actually sent in this notification stage
		if (($innotifymethod == "Both")||($innotifymethod == "SMS")) {
			XBR();
			// ============= SMS  =============================
			XH2("SMS messages"); 
			foreach ($totalsmsa as $personid)  {	
				if (isset($_REQUEST['tobenotified_'.$personid])) {	
					if ($_REQUEST['tobenotified_'.$personid] == "Yes") {
						if (( GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y" )||
						    ( GetSelectionList('frs_officialselectedlist',$personid,'selected') == "Y" )) {
							Check_Data("person",$personid);
							if ($GLOBALS{'IOWARNING'} == "0") {
								$smsto = Chosen_Person_SMS();
								$smsfrom = "02393162462";
								$smsalert = "";
								if ($GLOBALS{'frs_cancellation'} == "Yes" ) {
									$smsalert = "MATCH CANCELLED - ";
								}
								$smsmessage = $smsalert.$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'})." - ";
								$smsmessage = $smsmessage.$tvenue_name." ";
								$smsmessage = $smsmessage.$GLOBALS{'frs_time'}." Start ";
								if ($GLOBALS{'frs_cancellation'} != "Yes" ) {
									$smsmessage = $smsmessage.$GLOBALS{'frs_meet'};			
									if ($GLOBALS{'frs_meettotravel'} == "Yes") {
										$smsmessage = $smsmessage." - Reply Y (Meet), D (Direct) or N";
									} else {							
										$smsmessage = $smsmessage." - Reply Y or N";
									}
								}
								if (strlen($smsmessage) > 155) {
									$extra = strlen($smsmessage) - 155; 
									$lengthmeet = strlen($GLOBALS{'frs_meet'}) - $extra;
									$newmeet = substr($GLOBALS{'frs_meet'},0,$lengthmeet);
									$smsmessage = $GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'})." - ";
									$smsmessage = $smsmessage.$tvenue_name." ";
									if ($GLOBALS{'frs_cancellation'} != "Yes" ) {
										$smsmessage = $smsmessage.$GLOBALS{'frs_time'}." Start ";									
										$smsmessage = $smsmessage.$newmeet;
										if ($GLOBALS{'frs_meettotravel'} == "Yes") {
											$smsmessage = $smsmessage." - Reply Y (Meet), D (Direct) or N";
										} else {							
											$smsmessage = $smsmessage." - Reply Y or N";
										}
									}
								}
								$smsreference = $GLOBALS{'currentYYYYMMDDHHMMSS'}."-TeamSelection-".$infrsid."-".$personid;
								$smsexpirydate = AddMonth("20".$infrsid[2].$infrsid[3]."-".$infrsid[4].$infrsid[5]."-".$infrsid[6].$infrsid[7],1);
								if ($intest == "Yes") { SMS_Display($smsfrom,$askingperson_id,$askingperson_fname,$askingperson_sname,$smsto,$personid,$GLOBALS{'person_fname'},$GLOBALS{'person_sname'},$smsmessage,$smsreference); }
								else { SMS_Output("display",$smsfrom,$askingperson_id,$askingperson_fname,$askingperson_sname,$smsto,$personid,$GLOBALS{'person_fname'},$GLOBALS{'person_sname'},$smsmessage,$smsreference,$smsexpirydate); }
								if ((in_array($personid, $alreadynotifieda))&&($inoverride != "Yes")) {
									XPTXTCOLOR("Warning - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." has already been notified.","red");
								}							
							}
						}
					}
				}
			}
		}
			
		if (($innotifymethod == "Both")||($innotifymethod == "Email")) {	
			XBR();
			// ============= Email  =============================
			XH2("Email messages");
			foreach ($totalemaila as $personid)  {	
				if (isset($_REQUEST['tobenotified_'.$personid])) {	
					if ($_REQUEST['tobenotified_'.$personid] == "Yes") {
						Check_Data("person",$personid);
						if ($GLOBALS{'IOWARNING'} == "0") {			
							$toperson_email = "";
							$ccperson_email = "";
							$underage = UnderAge(18,$GLOBALS{'person_dob'});
							if ($underage) {
								if ($GLOBALS{'person_email1'} != "") {
									$toperson_email = $GLOBALS{'person_email1'};
									if ($GLOBALS{'person_email3'} != $GLOBALS{'person_email1'}) {
										$ccperson_email = $GLOBALS{'person_email3'};
									}
								} else {
									$toperson_email = $GLOBALS{'person_email3'};
								}
							} else {
								$toperson_email = $GLOBALS{'person_email1'};
							}
							$emailto = $toperson_email;
							$emailcc = $ccperson_email;
							$emailbcc = "";				
							$emailexpirydate = AddMonth("20".$infrsid[2].$infrsid[3]."-".$infrsid[4].$infrsid[5]."-".$infrsid[6].$infrsid[7],1);
							$Ylink = YPGMLINK("frsteamconfirmationemailin.php").YPGMPARM("ServiceId",$GLOBALS{'LOGIN_service_id'}).YPGMPARM("DomainId",$GLOBALS{'LOGIN_domain_id'}).YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'});
							$Ylink = $Ylink.YPGMPARM("SelectionPersonId",$personid).YPGMPARM("TeamCode",$inteamcode).YPGMPARM("FrsId",$infrsid).YPGMPARM("ConfirmationStatus","Y");
							$Ylinkinsert = YLINKIMGNEWWINDOW(MakeUrlHTTP($Ylink),MakeUrlHTTP($GLOBALS{'site_asseturl'})."/SelectionYesBase.png","Confirm","50","50","");
							$Nlink = YPGMLINK("frsteamconfirmationemailin.php").YPGMPARM("ServiceId",$GLOBALS{'LOGIN_service_id'}).YPGMPARM("DomainId",$GLOBALS{'LOGIN_domain_id'}).YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'});
							$Nlink = $Nlink.YPGMPARM("SelectionPersonId",$personid).YPGMPARM("TeamCode",$inteamcode).YPGMPARM("FrsId",$infrsid).YPGMPARM("ConfirmationStatus","N");
							$Nlinkinsert = YLINKIMGNEWWINDOW(MakeUrlHTTP($Nlink),MakeUrlHTTP($GLOBALS{'site_asseturl'})."/SelectionNoBase.png","Confirm","50","50","");
							$Mlink = YPGMLINK("frsteamconfirmationemailin.php").YPGMPARM("ServiceId",$GLOBALS{'LOGIN_service_id'}).YPGMPARM("DomainId",$GLOBALS{'LOGIN_domain_id'}).YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'});
							$Mlink = $Mlink.YPGMPARM("SelectionPersonId",$personid).YPGMPARM("TeamCode",$inteamcode).YPGMPARM("FrsId",$infrsid).YPGMPARM("ConfirmationStatus","M");
							$Mlinkinsert = YLINKIMGNEWWINDOW(MakeUrlHTTP($Mlink),MakeUrlHTTP($GLOBALS{'site_asseturl'})."/SelectionMeetBase.png","Confirm","50","50","");
							$Dlink = YPGMLINK("frsteamconfirmationemailin.php").YPGMPARM("ServiceId",$GLOBALS{'LOGIN_service_id'}).YPGMPARM("DomainId",$GLOBALS{'LOGIN_domain_id'}).YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'});
							$Dlink = $Dlink.YPGMPARM("SelectionPersonId",$personid).YPGMPARM("TeamCode",$inteamcode).YPGMPARM("FrsId",$infrsid).YPGMPARM("ConfirmationStatus","D");
							$Dlinkinsert = YLINKIMGNEWWINDOW(MakeUrlHTTP($Dlink),MakeUrlHTTP($GLOBALS{'site_asseturl'})."/SelectionDirectBase.png","Confirm","50","50","");
							$emailfrompersonid = $askingperson_id;
							$emailtopersonid = $personid;
							$emailreference = $GLOBALS{'currentYYYYMMDDHHMMSS'}."-TeamSelection-".$infrsid."-".$personid;				
							$emailfrom = $askingperson_email;
							$emailfooter1 = $GLOBALS{'domain_longname'};
							$emailfooter2 = "";

							$emailalert = "";
							if ($GLOBALS{'frs_cancellation'} == "Yes" ) {
								$emailalert = "MATCH CANCELLED - ";
							}
							$emailsubject = $emailalert.$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' - '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'});
							$mainmessage = 'Dear '.$GLOBALS{'person_fname'}."<br/><br/>";

							
							if ($GLOBALS{'frs_cancellation'} == "Yes" ) {
								$mainmessage = $mainmessage."This match has been cancelled.<br/><br/>";
								if ($GLOBALS{'frs_meet'} != "") { $mainmessage = $mainmessage.$GLOBALS{'frs_meet'}."<br/><br/>"; }
								if ($GLOBALS{'frs_meetextra'} != "") { $mainmessage = $mainmessage.$GLOBALS{'frs_meetextra'}."<br/><br/>"; }								
							} else {
								$mainmessage = $mainmessage."Here are the details for our next match<br/><br/>";		
								$mainmessage = $mainmessage."Opposition: ".$GLOBALS{'frs_oppo'}."<br/>";			
								$mainmessage = $mainmessage."Venue: ".$tvenue_name."<br/>";
								$mainmessage = $mainmessage."Start Time: ".$GLOBALS{'frs_time'}."<br/>";
								if ($GLOBALS{'frs_meet'} != "") { $mainmessage = $mainmessage."Arrangements: ".$GLOBALS{'frs_meet'}."<br/><br/>"; }
								if ($GLOBALS{'frs_meetextra'} != "") { $mainmessage = $mainmessage.$GLOBALS{'frs_meetextra'}."<br/><br/>"; }
								$mainmessage = $mainmessage."<hr>Our team for this match is:-<br/><br/>";
								$mainmessage = $mainmessage.$selectednamelist."<br/>";
								$mainmessage = $mainmessage."<hr>Umpire(s):-<br/><br/>";
								$mainmessage = $mainmessage.$officialnamelist."<br/>";
											
								if (( GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y" )||
								    ( GetSelectionList('frs_officialselectedlist',$personid,'selected') == "Y" )) {
									$mainmessage = $mainmessage."<hr>Please confirm your availability by pressing one of the buttons below<br/><br/>";				
									$mainmessage = $mainmessage."<table>";	
									if ($GLOBALS{'frs_meettotravel'} == "Yes") {
										$mainmessage = $mainmessage."<tr><td>".$Mlinkinsert."</td>"."<td><h3>Yes, I am available and will come to the meeting point.</h3></td></tr>";	
										$mainmessage = $mainmessage."<tr><td>".$Dlinkinsert."</td>"."<td><h3>Yes, I am available and will travel direct.</h3></td></tr>";			
										$mainmessage = $mainmessage."<tr><td>".$Nlinkinsert."</td>"."<td><h3>Sorry, I am not available.</h3></td></tr>";		
									} else {							
										$mainmessage = $mainmessage."<tr><td>".$Ylinkinsert."</td>"."<td><h3>Yes, I am available.</h3></td></tr>";			
										$mainmessage = $mainmessage."<tr><td>".$Nlinkinsert."</td>"."<td><h3>Sorry, I am not available.</h3></td></tr>";	
									}
									$mainmessage = $mainmessage."</table>";
								}
							}
							/*
							$featuredtype = "Event";
							$featuredid = "E00020";
							if ( $featuredtype == "Event") {
								$event_id = $featuredid;
								Get_Data("event",$featuredid);
								$link = 'http:'.YPGMLINK("webpageeventwebview.php");
								$link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);
								$mainmessage = $mainmessage.'<table border="0"><tr><td border="0">';
								$mainmessage = $mainmessage.'<table border="0"><tr>';
								if ($GLOBALS{'event_featuredimage'} != "") {
									$mainmessage = $mainmessage.'<td border="0"><br>'.'<a href="'.$link.'"><img src="http:'.$GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'}.'" width="200" /></a>';
									$mainmessage = $mainmessage.'<td border="0"> </td>';
								}
								$mainmessage = $mainmessage.'<td border="0">'.YH3($GLOBALS{'event_title'}).'<br>'.$GLOBALS{'event_excerpt'}."..".YLINKTXT($link,"Read More..");
									
								$mainmessage = $mainmessage.'</td>';
								$mainmessage = $mainmessage.'</tr></table>';
								$mainmessage = $mainmessage.'</td></tr></table>';
							}
							*/
							
			
							$emailcontent = $mainmessage."<br><br> Many Thanks,<br><br>".$askingperson_fname.' '.$askingperson_sname.'<br><br>';
							
							if ($intest == "Yes") {	Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); }			
							else { HTMLEmailRecorded_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2,$emailfrompersonid,$emailtopersonid,$emailreference,$emailexpirydate); }
							if ((in_array($personid, $alreadynotifieda))&&($inoverride != "Yes")) {
								XPTXTCOLOR("Warning - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." has already been notified.","red");
							}
						}
					}
				}
			}
		}
	}
}
	
Back_Navigator();
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
