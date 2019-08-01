<?php # frsteamselectionin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$innotificationtype = $_REQUEST['NotificationType'];
$innotificationeventid = $_REQUEST['NotificationEventId'];
$innotificationpersonid = $_REQUEST['NotificationPersonId'];


Get_Data("person",$innotificationpersonid);
$intlmobiletel = IntlPhoneNumber(Chosen_Person_SMS());

XH1("Notification Audit Trail for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});
Get_Data("team",$GLOBALS{'currperiodid'},$innotificationeventid[0].$innotificationeventid[1]);
Get_Data("frs",$GLOBALS{'currperiodid'},$innotificationeventid[0].$innotificationeventid[1], $innotificationeventid);
XH2($GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' - '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
XBR();XBR();

if ((Chosen_Person_SMS() != "")&&(Chosen_Person_SMS() != " ")) {
	XH2("SMS messages");
	XTABLE();
	XTR();
	XTDHTXT("Timestamp");
	XTDHTXT("Send Status");
	XTDHTXT("Receipt");
	XTDHTXT("Response");
	
	X_TR();
	$smsouta = Get_Array("smsout"."_".$intlmobiletel);
	foreach ($smsouta as $smsout_outtimestamp)  {
		Get_Data("smsout"."_".$intlmobiletel,$smsout_outtimestamp);
		$matchstring = $innotificationtype."-".$innotificationeventid."-".$innotificationpersonid;
		if (strpos($GLOBALS{'smsout_reference'},$matchstring) !== false) {
			XTR();
			XTDTXT(TimestamptoDDthMMMhhmm($GLOBALS{'smsout_outtimestamp'}));
			$resbits = explode(':',$GLOBALS{'smsout_result'});
			if ($resbits[0] == "0") { XTDTXT("SMS successfully queued."); }
			else { XTDTXT("Error Code - ".$GLOBALS{'smsout_result'}); }
			XTDTXT("");
			XTDTXT("");
			X_TR();
		}
	}
	$smsreceipta = Get_Array("smsreceipt"."_".$intlmobiletel);
	foreach ($smsreceipta as $smsreceipt_intimestamp)  {
		Get_Data("smsreceipt"."_".$intlmobiletel,$smsreceipt_intimestamp);
		$matchstring = $innotificationtype."-".$innotificationeventid."-".$innotificationpersonid;
		if (strpos($GLOBALS{'smsreceipt_reference'},$matchstring) !== false) {
			XTR();
			XTDTXT(TimestamptoDDthMMMhhmm($GLOBALS{'smsreceipt_intimestamp'}));
			XTDTXT("");
			if ($GLOBALS{'smsreceipt_status'} == "0") { XTDTXT("SMS successfully received."); }
			else { XTDTXT("Error Code - ",$GLOBALS{'smsreceipt_status'}); }
			XTDTXT("");
			X_TR();
		}
	}
	
	$smsina = Get_Array("smsin"."_".$intlmobiletel);
	foreach ($smsina as $smsin_intimestamp)  {
		Get_Data("smsin"."_".$intlmobiletel,$smsin_intimestamp);
		$matchstring = $innotificationtype."-".$innotificationeventid."-".$innotificationpersonid;
		if (strpos($GLOBALS{'smsin_reference'},$matchstring) !== false) {
			XTR();
			XTDTXT(TimestamptoDDthMMMhhmm($GLOBALS{'smsin_intimestamp'}));
			XTDTXT("");
			XTDTXT("");
			XTDTXT($GLOBALS{'smsin_message'});
			X_TR();
		}
	}
	X_TABLE();
} else {
	XH2("No valid mobile telephone number for this person");
}

XH2("Emails");
XTABLE();
XTR();
XTDHTXT("Timestamp");
XTDHTXT("Send Status");
XTDHTXT("Response");
X_TR();
$emailouta = Get_Array("emailout"."_".Chosen_Person_Email());
foreach ($emailouta as $emailout_outtimestamp)  {
	Get_Data("emailout"."_".Chosen_Person_Email(),$emailout_outtimestamp);
	$matchstring = $innotificationtype."-".$innotificationeventid."-".$innotificationpersonid;
	if (strpos($GLOBALS{'emailout_reference'},$matchstring) !== false) {
		XTR();
		XTDTXT(TimestamptoDDthMMMhhmm($GLOBALS{'emailout_outtimestamp'}));
		$resbits = explode(':',$GLOBALS{'emailout_result'});
		if ($resbits[0] == "200") { XTDTXT("Email successfully queued."); }
		else { XTDTXT($GLOBALS{'emailout_result'}); }
		XTDTXT("");
		X_TR();
	}
}

$emailactiona = Get_Array("emailaction"."_".Chosen_Person_Email());
foreach ($emailactiona as $emailaction_intimestamp)  {
	Get_Data("emailaction"."_".Chosen_Person_Email(),$emailaction_intimestamp);
	$matchstring = $innotificationtype."-".$innotificationeventid."-".$innotificationpersonid;
	if (strpos($GLOBALS{'emailaction_reference'},$matchstring) !== false) {
		XTR();
		XTDTXT(TimestamptoDDthMMMhhmm($GLOBALS{'emailaction_intimestamp'}));
		XTDTXT("");
		XTDTXT($GLOBALS{'emailaction_message'});
		X_TR();
	}
}
X_TABLE();

Back_Navigator();
PageFooter("Default","Final");
