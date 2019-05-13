<?php # frssquademailsmsin.php

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

$inteamcode = $_REQUEST['team_code'];
$insmsmessage = $_REQUEST['SMSMessage'];
$inemailsubject = $_REQUEST['EmailSubject'];
$inemailmessage = $_REQUEST['EmailMessage'];
$inpurpose = $_REQUEST['Purpose'];

$intest = $_REQUEST['Test'];
$inconfirmactionstatus = $_REQUEST['ConfirmActionStatus'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$askingperson_id = $GLOBALS{'LOGIN_person_id'};
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$askingperson_mobiletel = $GLOBALS{'person_mobiletel'};

Get_Data("team",$GLOBALS{'currperiodid'},$inteamcode);

if ( $inpurpose == "Communication" ) { XH1("Team Communication - ".$GLOBALS{'team_name'}); } 
if ( $inpurpose == "AvailabilityReminder" ) { XH1("Availability Reminders - ".$GLOBALS{'team_name'}); } 

if (($inconfirmactionstatus == "No")&&($intest == "No")) {
	$intest == "Yes";
	XH1("Distribution Not Confirmed");
}

if ($intest == "Yes") {
	XTABLE();
	XTR();XTD();
	XTXTCOLOR("Preview Mode - The following Emails/SMS messages have not yet been sent out","red");
	XBR();XBR();
	
	XFORM("frssquademailsmsin.php","ConfirmActionForm");
	XINSTDHID();
	XINHID("team_code",$team_code);
	XINHID("SMSMessage",$insmsmessage);
	XINHID("EmailSubject",$inemailsubject);
	XINHID("EmailMessage",$inemailmessage);
	XINHID("Test","No");
	XINHID("ConfirmActionStatus","Yes");
	XINHID("Purpose",$inpurpose);
	$squada = explode(',',$GLOBALS{'team_squadlist'});
	foreach ($squada as $personid)  {
		if (isset($_REQUEST['sendto_'.$personid])) {
			XINHID('sendto_'.$personid,$_REQUEST['sendto_'.$personid]);
		}
	}
	XINSUBMIT("I'm OK with this preview. Now send out SMS Texts and Emails.");
	X_FORM();
	
	XBR();XBR();
	XLINKBACKBUTTON("Cancel. Don't send out SMS Texts and Emails yet.");
	XBR();
	X_TD();X_TR();
	X_TABLE();
}
else { XH2("The following Emails/Text messages have been sent out"); }
XHR();
XH2("Text messages");
if ($insmsmessage != "") {
	$squada = explode(',',$GLOBALS{'team_squadlist'});
	if ($GLOBALS{'team_coach'} != "") {
		$splitstra = List2Array($GLOBALS{'team_coach'});
		foreach ($splitstra as $personid)  {
			array_unshift($squada , $personid);
		}
	}
	if ($GLOBALS{'team_mgr'} != "") {
		$splitstra = List2Array($GLOBALS{'team_mgr'});
		foreach ($splitstra as $personid)  {
			array_unshift($squada , $personid);
		}
	}
	foreach ($squada as $personid)  {
		if (isset($_REQUEST['sendto_'.$personid])) {
			if ($_REQUEST['sendto_'.$personid] == "Yes") {
				Check_Data("person",$personid);
				if ($GLOBALS{'IOWARNING'} == "0") {
				    if (ValidMobile(Chosen_Person_SMS())) {					
				        $smsto = Chosen_Person_SMS();
						$smsfrom = $askingperson_mobiletel;
						$smsmessage = $insmsmessage;
						$smsreference = $GLOBALS{'currentYYYYMMDDHHMMSS'}."-SquadBroadcast-".$inteamcode."-".$personid;					
						$smsexpirydate = AddMonth($GLOBALS{'currentYYYY-MM-DD'},1);	
						if ($intest == "Yes") { SMS_Display($smsfrom,$askingperson_id,$askingperson_fname,$askingperson_sname,$smsto,$personid,$GLOBALS{'person_fname'},$GLOBALS{'person_sname'},$smsmessage,$smsreference); }			
						else {	SMS_Output("display",$smsfrom,$askingperson_id,$askingperson_fname,$askingperson_sname,$smsto,$personid,$GLOBALS{'person_fname'},$GLOBALS{'person_sname'},$smsmessage,$smsreference,$smsexpirydate); }
					} else {
					    XBR();XTXTCOLOR("No valid mobile found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red");XBR();
					}
				}
			}
		}
	}
} else {
    if ( $inpurpose == "Communication" ) { XH4("No SMS message requested"); }
}
XHR();
XH2("Email messages");
if (($inemailmessage != "")||($inemailsubject != "")) {
	$squada = explode(',',$GLOBALS{'team_squadlist'});
	if ($GLOBALS{'team_coach'} != "") {
		$splitstra = List2Array($GLOBALS{'team_coach'});
		foreach ($splitstra as $personid)  {
			array_unshift($squada , $personid);
		}
	}
	if ($GLOBALS{'team_mgr'} != "") {
		$splitstra = List2Array($GLOBALS{'team_mgr'});
		foreach ($splitstra as $personid)  {
			array_unshift($squada , $personid);
		}
	}	
	$emailfrom = $askingperson_email;
	$emailto = "";
	$personidto = "";
	$personfnameto = "";
	$esep = "";
	$emailcc = "";
	$emailbcc = "";	
	$mainmessage = $inemailmessage."<br><br>";
	$mainmessage = $mainmessage.$askingperson_fname." ".$askingperson_sname;
	$emailcontent = $mainmessage;
	$emailfooter1 = $GLOBALS{'domain_longname'};
	$emailfooter2 = "";	
	foreach ($squada as $personid)  {	
		if (isset($_REQUEST['sendto_'.$personid])) {	
			if ($_REQUEST['sendto_'.$personid] == "Yes") {
				Check_Data("person",$personid);
				if ($GLOBALS{'IOWARNING'} == "0") {
					if (ValidEmail(Chosen_Person_Email())) {					
					    $emailto = $emailto.$esep.Chosen_Person_Email();
					    $personidto = $personidto.$esep.$personid;
					    $personnameto = $personnameto.$esep.$GLOBALS{'person_fname'};
						$esep = ",";
					} else {
						XBR();XTXTCOLOR("No valid email found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red");	
					}
				}
			}
		}			
	}
	if ( $inpurpose == "Communication" ) { 
    	if ($intest == "Yes") { Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$inemailsubject,$emailcontent,$emailfooter1,$emailfooter2); }	
    	else {	HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$inemailsubject,$emailcontent,$emailfooter1,$emailfooter2); }	        
	}
	if ( $inpurpose == "AvailabilityReminder" ) {
	    
	    $pi = 0;
	    $emailtoa = List2Array($emailto);
	    $personidtoa = List2Array($personidto);
	    $personnametoa = List2Array($personnameto);
	    foreach ($emailtoa as $temailto)  {
	       $salutation = "Dear ".$personnametoa[$pi].YBR();
	       $link = YPGMLINK("frssquadavailabilityreminderemailin.php");
	       $link = $link.YPGMMINPARMS().YPGMPARM("AvailabilityPersonId",$personidtoa[$pi]);
	       $linkinsert = YBR().YLINKIMGNEWWINDOW(MakeUrlHTTP($link),MakeUrlHTTP($GLOBALS{'site_asseturl'})."/AVAILABILITYREMINDER.png","Availability Reminder","100","100","");
	       if ($intest == "Yes") { Email_Display($emailfrom,$temailto,$emailcc,$emailbcc,$inemailsubject,$salutation.$emailcontent.$linkinsert,$emailfooter1,$emailfooter2); }
	       else {	HTMLEmail_Output("display",$emailfrom,$temailto,$emailcc,$emailbcc,$inemailsubject,$salutation.$emailcontent.$linkinsert,$emailfooter1,$emailfooter2); }
	       $pi++;
	    }
	}
} else {
	XH4("No Email message requested");
}
	
Back_Navigator();
PageFooter("Default","Final");
