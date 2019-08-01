<<<<<<< HEAD
<?php # personSEin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITEJSOPTIONAL'} = "confirmaction";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$todistlist = $_REQUEST['ToDistList'];
$ccdistlist = $_REQUEST['CcDistList'];
$bccdistlist = $_REQUEST['BccDistList'];
$todistlist = str_replace(" ","",$todistlist);
$ccdistlist = str_replace(" ","",$ccdistlist);
$bccdistlist = str_replace(" ","",$bccdistlist);
$totaldistlist = $todistlist.','.$ccdistlist.','.$bccdistlist;
$totaldistlist = str_replace(',,',',',$totaldistlist);
$insmsmessage = $_REQUEST['SMSMessage'];
$inemailsubject = $_REQUEST['EmailSubject'];
$inemailmessage = $_REQUEST['EmailMessage'];
$intest = $_REQUEST['Test'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$askingperson_id = $GLOBALS{'LOGIN_person_id'};
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$askingperson_mobiletel = $GLOBALS{'person_mobiletel'};

if ($intest == "Yes") { XTXTCOLOR("Test Mode - The following Emails/SMS messages have not yet been sent out","red"); }
else { XH2("The following Email/SMS messages have been sent out"); }

if ($insmsmessage != "") {
	XH2("SMS messages");
	$smsa = explode(',',$totaldistlist);
	foreach ($smsa as $personid)  {
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

XH2("Email messages");
if ($inemailmessage != "") {
	$groupa = explode(',',$sectiongrouplist);
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
	$toa = explode(',',$todistlist);
	foreach ($toa as $personid)  {	
		$GLOBALS{'IOWARNING'} = "0";
		Check_Data("person",$personid);
		// XH5("|".$personid."| -".Chosen_Person_Email());
		if ($GLOBALS{'IOWARNING'} == "0") {
			if (ValidEmail(Chosen_Person_Email())) {
			    // XH5($personid." ".Chosen_Person_Email()." OK");
			    $emailto = $emailto.$esep.Chosen_Person_Email();
				$esep = ",";
			} else {
			    // XH5($personid." ".Chosen_Person_Email()." NOK");
			    XBR();XTXTCOLOR("No valid email found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}."- |".Chosen_Person_Email()."|","red");						
			}
		}
	}
	$esep = "";
	$cca = explode(',',$ccdistlist);
	foreach ($cca as $personid)  {
		Check_Data("person",$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			if (ValidEmail(Chosen_Person_Email())) {
			    $emailcc = $emailcc.$esep.Chosen_Person_Email();
				$esep = ",";
			} else {
				XBR();XTXTCOLOR("No valid email found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red");
			}
		}
	}
	$esep = "";
	$bcca = explode(',',$bccdistlist);
	foreach ($bcca as $personid)  {
		Check_Data("person",$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			if (ValidEmail(Chosen_Person_Email())) {
			    $emailbcc = $emailbcc.$esep.Chosen_Person_Email();
				$esep = ",";
			} else {
				XBR();XTXTCOLOR("No valid email found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red");
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
<?php # personSEin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITEJSOPTIONAL'} = "confirmaction";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$todistlist = $_REQUEST['ToDistList'];
$ccdistlist = $_REQUEST['CcDistList'];
$bccdistlist = $_REQUEST['BccDistList'];
$todistlist = str_replace(" ","",$todistlist);
$ccdistlist = str_replace(" ","",$ccdistlist);
$bccdistlist = str_replace(" ","",$bccdistlist);
$totaldistlist = $todistlist.','.$ccdistlist.','.$bccdistlist;
$totaldistlist = str_replace(',,',',',$totaldistlist);
$insmsmessage = $_REQUEST['SMSMessage'];
$inemailsubject = $_REQUEST['EmailSubject'];
$inemailmessage = $_REQUEST['EmailMessage'];
$intest = $_REQUEST['Test'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$askingperson_id = $GLOBALS{'LOGIN_person_id'};
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$askingperson_mobiletel = $GLOBALS{'person_mobiletel'};

if ($intest == "Yes") { XTXTCOLOR("Test Mode - The following Emails/SMS messages have not yet been sent out","red"); }
else { XH2("The following Email/SMS messages have been sent out"); }

if ($insmsmessage != "") {
	XH2("SMS messages");
	$smsa = explode(',',$totaldistlist);
	foreach ($smsa as $personid)  {
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

XH2("Email messages");
if ($inemailmessage != "") {
	$groupa = explode(',',$sectiongrouplist);
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
	$toa = explode(',',$todistlist);
	foreach ($toa as $personid)  {	
		$GLOBALS{'IOWARNING'} = "0";
		Check_Data("person",$personid);
		// XH5("|".$personid."| -".Chosen_Person_Email());
		if ($GLOBALS{'IOWARNING'} == "0") {
			if (ValidEmail(Chosen_Person_Email())) {
			    // XH5($personid." ".Chosen_Person_Email()." OK");
			    $emailto = $emailto.$esep.Chosen_Person_Email();
				$esep = ",";
			} else {
			    // XH5($personid." ".Chosen_Person_Email()." NOK");
			    XBR();XTXTCOLOR("No valid email found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}."- |".Chosen_Person_Email()."|","red");						
			}
		}
	}
	$esep = "";
	$cca = explode(',',$ccdistlist);
	foreach ($cca as $personid)  {
		Check_Data("person",$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			if (ValidEmail(Chosen_Person_Email())) {
			    $emailcc = $emailcc.$esep.Chosen_Person_Email();
				$esep = ",";
			} else {
				XBR();XTXTCOLOR("No valid email found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red");
			}
		}
	}
	$esep = "";
	$bcca = explode(',',$bccdistlist);
	foreach ($bcca as $personid)  {
		Check_Data("person",$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			if (ValidEmail(Chosen_Person_Email())) {
			    $emailbcc = $emailbcc.$esep.Chosen_Person_Email();
				$esep = ",";
			} else {
				XBR();XTXTCOLOR("No valid email found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red");
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
?>