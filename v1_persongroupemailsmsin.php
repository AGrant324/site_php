<<<<<<< HEAD
<?php # frsgroupemailsmsin.php

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

$insectiongroupcode = $_REQUEST['sectiongroup_code'];
$insmsmessage = $_REQUEST['SMSMessage'];
$inemailsubject = $_REQUEST['EmailSubject'];
$inemailmessage = $_REQUEST['EmailMessage'];
$intest = $_REQUEST['Test'];
$inconfirmactionstatus = $_REQUEST['ConfirmActionStatus'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$askingperson_id = $GLOBALS{'LOGIN_person_id'};
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$askingperson_mobiletel = $GLOBALS{'person_mobiletel'};

Get_Data("sectiongroup",$GLOBALS{'currperiodid'},$insectiongroupcode);
XH1("Group Communication - ".$GLOBALS{'sectiongroup_name'});

$sectiongrouplist = ""; $sep = "";
foreach ( Get_Array('person') as $person_id) {
	Get_Data( 'person', $person_id );
	if ( MatchLists ($GLOBALS{'person_sectiongroup'}, $insectiongroupcode) ) {
		$sectiongrouplist = $sectiongrouplist.$sep.$person_id; $sep = ",";
	}
}

if (($inconfirmactionstatus == "No")&&($intest == "No")) {
	$intest == "Yes";
	XH1("Distribution Not Confirmed");
}

if ($intest == "Yes") {
	XTABLE();
	XTR();XTD();
	XTXTCOLOR("Preview Mode - The following Emails/SMS messages have not yet been sent out","red");
	XBR();XBR();
	$link = YPGMLINK("persongroupemailsmsin.php").YPGMSTDPARMS();
	$link = $link.YPGMPARM("sectiongroup_code",$insectiongroupcode);
	$link = $link.YPGMPARM("SMSMessage",$insmsmessage);
	$link = $link.YPGMPARM("EmailSubject",$inemailsubject);
	$link = $link.YPGMPARM("EmailMessage",$inemailmessage);
	$link = $link.YPGMPARM("Test","No");
	$link = $link.YPGMPARM("ConfirmActionStatus","Yes");
	$groupa = explode(',',$sectiongrouplist);
	foreach ($groupa as $personid) { 
		if (isset($_REQUEST['sendto_'.$personid])) {
			$link = $link.YPGMPARM('sendto_'.$personid,$_REQUEST['sendto_'.$personid]);
		}
	}
	XLINKBUTTON($link,"I'm OK with this preview. Now send out SMS Texts and Emails.");
	XBR();XBR();
	XLINKBACKBUTTON("Cancel. Don't send out SMS Texts and Emails yet.");
	XBR();
	X_TD();X_TR();
	X_TABLE();
}
else { XH2("The following Emails/SMS messages have been sent out"); }

XHR();
XH2("SMS messages");
if ($insmsmessage != "") {
	$groupa = explode(',',$sectiongrouplist);
	if ($GLOBALS{'sectiongroup_coach'} != "") {
		$splitstra = List2Array($GLOBALS{'sectiongroup_coach'});
		foreach ($splitstra as $personid)  {
			array_unshift($groupa , $personid);
		}
	}
	if ($GLOBALS{'sectiongroup_mgr'} != "") {
		$splitstra = List2Array($GLOBALS{'sectiongroup_mgr'});
		foreach ($splitstra as $personid)  {
			array_unshift($groupa , $personid);
		}
	}
	foreach ($groupa as $personid)  {
		if (isset($_REQUEST['sendto_'.$personid])) {
			if ($_REQUEST['sendto_'.$personid] == "Yes") {
				Check_Data("person",$personid);
				if ($GLOBALS{'IOWARNING'} == "0") {
					if (ValidMobile(Chosen_Person_SMS())) {	
					    $smsto = Chosen_Person_SMS();
						$smsfrom = $askingperson_mobiletel;
						$smsmessage = $insmsmessage;
						$smsreference = $GLOBALS{'currentYYYYMMDDHHMMSS'}."-GroupBroadcast-".$insectiongroupcode."-".$personid;					
						$smsexpirydate = AddMonth($GLOBALS{'currentYYYY-MM-DD'},1);					
						if ($intest == "Yes") {SMS_Display($smsfrom,$askingperson_id,$askingperson_fname,$askingperson_sname,$smsto,$personid,$GLOBALS{'person_fname'},$GLOBALS{'person_sname'},$smsmessage,$smsreference); }
						else { SMS_Output("display",$smsfrom,$askingperson_id,$askingperson_fname,$askingperson_sname,$smsto,$personid,$GLOBALS{'person_fname'},$GLOBALS{'person_sname'},$smsmessage,$smsreference,$smsexpirydate); }
					} else {
					    XBR();XTXTCOLOR("No valid mobile found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red");XBR();
					}
				}
			}
		}
	}
} else {
	XH4("No SMS message requested");	
}

XHR();
XH2("Email messages");
if ($inemailmessage != "") {
	$groupa = explode(',',$sectiongrouplist);
	if ($GLOBALS{'sectiongroup_coach'} != "") {
		$splitstra = List2Array($GLOBALS{'sectiongroup_coach'});
		foreach ($splitstra as $personid)  {
			array_unshift($groupa , $personid);
		}
	}
	if ($GLOBALS{'sectiongroup_mgr'} != "") {
		$splitstra = List2Array($GLOBALS{'sectiongroup_mgr'});
		foreach ($splitstra as $personid)  {
			array_unshift($groupa , $personid);
		}
	}
	$emailfrom = $askingperson_email;
	$emailto = ""; 
	$esep = "";
	$emailcc = "";
	$emailbcc = "";	
	$mainmessage = $inemailmessage."<br><br>";
	$mainmessage = $mainmessage.$askingperson_fname." ".$askingperson_sname;
	$emailcontent = $mainmessage;
	$emailfooter1 = $GLOBALS{'domain_longname'};
	$emailfooter2 = "";	
	foreach ($groupa as $personid)  {	
		if (isset($_REQUEST['sendto_'.$personid])) {	
			if ($_REQUEST['sendto_'.$personid] == "Yes") {
				Check_Data("person",$personid);
				if ($GLOBALS{'IOWARNING'} == "0") {
					if (ValidEmail(Chosen_Person_Email())) {
					    $emailto = $emailto.$esep.Chosen_Person_Email();
						$esep = ",";
					} else {
						XBR();XTXTCOLOR("No valid email found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red");						
					}
				}
			}
		}			
	}
	if ($intest == "Yes") { Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$inemailsubject,$emailcontent,$emailfooter1,$emailfooter2); }	
	else { HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$inemailsubject,$emailcontent,$emailfooter1,$emailfooter2); }
} else {
	XH4("No Email message requested");
}
	
Back_Navigator();
PageFooter("Default","Final");
=======
<?php # frsgroupemailsmsin.php

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

$insectiongroupcode = $_REQUEST['sectiongroup_code'];
$insmsmessage = $_REQUEST['SMSMessage'];
$inemailsubject = $_REQUEST['EmailSubject'];
$inemailmessage = $_REQUEST['EmailMessage'];
$intest = $_REQUEST['Test'];
$inconfirmactionstatus = $_REQUEST['ConfirmActionStatus'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$askingperson_id = $GLOBALS{'LOGIN_person_id'};
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$askingperson_mobiletel = $GLOBALS{'person_mobiletel'};

Get_Data("sectiongroup",$GLOBALS{'currperiodid'},$insectiongroupcode);
XH1("Group Communication - ".$GLOBALS{'sectiongroup_name'});

$sectiongrouplist = ""; $sep = "";
foreach ( Get_Array('person') as $person_id) {
	Get_Data( 'person', $person_id );
	if ( MatchLists ($GLOBALS{'person_sectiongroup'}, $insectiongroupcode) ) {
		$sectiongrouplist = $sectiongrouplist.$sep.$person_id; $sep = ",";
	}
}

if (($inconfirmactionstatus == "No")&&($intest == "No")) {
	$intest == "Yes";
	XH1("Distribution Not Confirmed");
}

if ($intest == "Yes") {
	XTABLE();
	XTR();XTD();
	XTXTCOLOR("Preview Mode - The following Emails/SMS messages have not yet been sent out","red");
	XBR();XBR();
	$link = YPGMLINK("persongroupemailsmsin.php").YPGMSTDPARMS();
	$link = $link.YPGMPARM("sectiongroup_code",$insectiongroupcode);
	$link = $link.YPGMPARM("SMSMessage",$insmsmessage);
	$link = $link.YPGMPARM("EmailSubject",$inemailsubject);
	$link = $link.YPGMPARM("EmailMessage",$inemailmessage);
	$link = $link.YPGMPARM("Test","No");
	$link = $link.YPGMPARM("ConfirmActionStatus","Yes");
	$groupa = explode(',',$sectiongrouplist);
	foreach ($groupa as $personid) { 
		if (isset($_REQUEST['sendto_'.$personid])) {
			$link = $link.YPGMPARM('sendto_'.$personid,$_REQUEST['sendto_'.$personid]);
		}
	}
	XLINKBUTTON($link,"I'm OK with this preview. Now send out SMS Texts and Emails.");
	XBR();XBR();
	XLINKBACKBUTTON("Cancel. Don't send out SMS Texts and Emails yet.");
	XBR();
	X_TD();X_TR();
	X_TABLE();
}
else { XH2("The following Emails/SMS messages have been sent out"); }

XHR();
XH2("SMS messages");
if ($insmsmessage != "") {
	$groupa = explode(',',$sectiongrouplist);
	if ($GLOBALS{'sectiongroup_coach'} != "") {
		$splitstra = List2Array($GLOBALS{'sectiongroup_coach'});
		foreach ($splitstra as $personid)  {
			array_unshift($groupa , $personid);
		}
	}
	if ($GLOBALS{'sectiongroup_mgr'} != "") {
		$splitstra = List2Array($GLOBALS{'sectiongroup_mgr'});
		foreach ($splitstra as $personid)  {
			array_unshift($groupa , $personid);
		}
	}
	foreach ($groupa as $personid)  {
		if (isset($_REQUEST['sendto_'.$personid])) {
			if ($_REQUEST['sendto_'.$personid] == "Yes") {
				Check_Data("person",$personid);
				if ($GLOBALS{'IOWARNING'} == "0") {
					if (ValidMobile(Chosen_Person_SMS())) {	
					    $smsto = Chosen_Person_SMS();
						$smsfrom = $askingperson_mobiletel;
						$smsmessage = $insmsmessage;
						$smsreference = $GLOBALS{'currentYYYYMMDDHHMMSS'}."-GroupBroadcast-".$insectiongroupcode."-".$personid;					
						$smsexpirydate = AddMonth($GLOBALS{'currentYYYY-MM-DD'},1);					
						if ($intest == "Yes") {SMS_Display($smsfrom,$askingperson_id,$askingperson_fname,$askingperson_sname,$smsto,$personid,$GLOBALS{'person_fname'},$GLOBALS{'person_sname'},$smsmessage,$smsreference); }
						else { SMS_Output("display",$smsfrom,$askingperson_id,$askingperson_fname,$askingperson_sname,$smsto,$personid,$GLOBALS{'person_fname'},$GLOBALS{'person_sname'},$smsmessage,$smsreference,$smsexpirydate); }
					} else {
					    XBR();XTXTCOLOR("No valid mobile found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red");XBR();
					}
				}
			}
		}
	}
} else {
	XH4("No SMS message requested");	
}

XHR();
XH2("Email messages");
if ($inemailmessage != "") {
	$groupa = explode(',',$sectiongrouplist);
	if ($GLOBALS{'sectiongroup_coach'} != "") {
		$splitstra = List2Array($GLOBALS{'sectiongroup_coach'});
		foreach ($splitstra as $personid)  {
			array_unshift($groupa , $personid);
		}
	}
	if ($GLOBALS{'sectiongroup_mgr'} != "") {
		$splitstra = List2Array($GLOBALS{'sectiongroup_mgr'});
		foreach ($splitstra as $personid)  {
			array_unshift($groupa , $personid);
		}
	}
	$emailfrom = $askingperson_email;
	$emailto = ""; 
	$esep = "";
	$emailcc = "";
	$emailbcc = "";	
	$mainmessage = $inemailmessage."<br><br>";
	$mainmessage = $mainmessage.$askingperson_fname." ".$askingperson_sname;
	$emailcontent = $mainmessage;
	$emailfooter1 = $GLOBALS{'domain_longname'};
	$emailfooter2 = "";	
	foreach ($groupa as $personid)  {	
		if (isset($_REQUEST['sendto_'.$personid])) {	
			if ($_REQUEST['sendto_'.$personid] == "Yes") {
				Check_Data("person",$personid);
				if ($GLOBALS{'IOWARNING'} == "0") {
					if (ValidEmail(Chosen_Person_Email())) {
					    $emailto = $emailto.$esep.Chosen_Person_Email();
						$esep = ",";
					} else {
						XBR();XTXTCOLOR("No valid email found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red");						
					}
				}
			}
		}			
	}
	if ($intest == "Yes") { Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$inemailsubject,$emailcontent,$emailfooter1,$emailfooter2); }	
	else { HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$inemailsubject,$emailcontent,$emailfooter1,$emailfooter2); }
} else {
	XH4("No Email message requested");
}
	
Back_Navigator();
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
