<<<<<<< HEAD
<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$inevent_id = $_REQUEST['event_id'];
$inevent_attendeeref = $_REQUEST['event_attendeeref'];
$inevent_totalcharge = $_REQUEST['event_totalcharge'];
$this_paymentoption = $_REQUEST['this_paymentoption'];

Get_Data('event',$inevent_id);
// $event_attendeeref,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
UpdateEventAttendeeStatus($inevent_attendeeref, "", "", $this_paymentoption, $inevent_totalcharge, "", "");
Write_Data('event',$inevent_id);

if ($this_paymentoption == "Card") {
	Booking_EventPayPalPayment_Output ($inevent_id, $inevent_attendeeref, $inevent_totalcharge);
}

if ($this_paymentoption == "Cheque") {
	Booking_EventChequePayment_Output ($inevent_id, $inevent_attendeeref, $inevent_totalcharge);
}

if ($this_paymentoption == "Cash") {
	Booking_EventCashPayment_Output ($inevent_id, $inevent_attendeeref, $inevent_totalcharge);
}

if ($this_paymentoption == "BankTransfer") {
	Booking_EventBankTransferPayment_Output ($inevent_id, $inevent_attendeeref, $inevent_totalcharge);
}

XHR();
XH4("We have reserved a place for you on the event, pending completion of ".$this_paymentoption." payment.");

if ( strlen(strstr($inevent_attendeeref,'|'))>0 ) {
	$abits = explode('|',$inevent_attendeeref);
	$thisemail = $abits[2];
} else {
	Get_Data('person',$inevent_attendeeref);
	$thisemail = $GLOBALS{'person_email1'};
	if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email3'};}
	if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email2'};}
}
$emailto = $thisemail;
XH5("A confirmatory email has been sent to ".$emailto);
Check_Data('person',$GLOBALS{'event_contact'});
$emailfrom = $GLOBALS{'person_email1'};
$emailcc = ""; $emailbcc = "";
$emailfooter1 = $GLOBALS{'domain_longname'};
$emailfooter2 = "";
$emailsubject = 'Your '.$GLOBALS{'event_title'}.' booking.';
$mainmessage = 'This email is to confirm we have reserved a place for '.$GLOBALS{'event_attendeefname'}.' '.$GLOBALS{'event_attendeesname'}." on this event.<br><br>";

$mainmessage = $mainmessage.'<b>Event</b> - '.$GLOBALS{'event_title'}."<br><br>";
$mainmessage = $mainmessage.'<b>Date</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'})."<br><br>";
$mainmessage = $mainmessage.'<b>Time</b> - '.$GLOBALS{'event_time'}."<br><br>";
$mainmessage = $mainmessage.'<b>Cost</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', '')."<br><br>";
Check_Data('venue',$GLOBALS{'event_venuecode'});
$mainmessage = $mainmessage.'<b>Venue</b> - '.$GLOBALS{'venue_name'}."<br><br>";
$attendeestatuslistelement = GetEventAttendeeStatus($inevent_attendeeref);
if ($attendeestatuslistelement != "") {
	$abits = explode('~',GetEventAttendeeStatus($inevent_attendeeref));
	if ($GLOBALS{'event_personorteam'} == "Team") {
		$mainmessage = $mainmessage.'<b>Team Name</b> - '.$abits[1]."<br><br>";
		$mainmessage = $mainmessage.'<b>Team Members</b> -<br>'.$abits[2]."<br><br>";
	} else {
		$mainmessage = $mainmessage.'<b>Event Places Required</b> - '.$abits[1]."<br><br>";
		$mainmessage = $mainmessage.'<b>Names (optional)</b> - '.$abits[2]."<br><br>";
	}
}
$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
if ($inevent_attendeefname == "Test") {
	Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
} else {
	HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
}

Back_Navigator();
PageFooter("Default","Final");


=======
<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$inevent_id = $_REQUEST['event_id'];
$inevent_attendeeref = $_REQUEST['event_attendeeref'];
$inevent_totalcharge = $_REQUEST['event_totalcharge'];
$this_paymentoption = $_REQUEST['this_paymentoption'];

Get_Data('event',$inevent_id);
// $event_attendeeref,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
UpdateEventAttendeeStatus($inevent_attendeeref, "", "", $this_paymentoption, $inevent_totalcharge, "", "");
Write_Data('event',$inevent_id);

if ($this_paymentoption == "Card") {
	Booking_EventPayPalPayment_Output ($inevent_id, $inevent_attendeeref, $inevent_totalcharge);
}

if ($this_paymentoption == "Cheque") {
	Booking_EventChequePayment_Output ($inevent_id, $inevent_attendeeref, $inevent_totalcharge);
}

if ($this_paymentoption == "Cash") {
	Booking_EventCashPayment_Output ($inevent_id, $inevent_attendeeref, $inevent_totalcharge);
}

if ($this_paymentoption == "BankTransfer") {
	Booking_EventBankTransferPayment_Output ($inevent_id, $inevent_attendeeref, $inevent_totalcharge);
}

XHR();
XH4("We have reserved a place for you on the event, pending completion of ".$this_paymentoption." payment.");

if ( strlen(strstr($inevent_attendeeref,'|'))>0 ) {
	$abits = explode('|',$inevent_attendeeref);
	$thisemail = $abits[2];
} else {
	Get_Data('person',$inevent_attendeeref);
	$thisemail = $GLOBALS{'person_email1'};
	if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email3'};}
	if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email2'};}
}
$emailto = $thisemail;
XH5("A confirmatory email has been sent to ".$emailto);
Check_Data('person',$GLOBALS{'event_contact'});
$emailfrom = $GLOBALS{'person_email1'};
$emailcc = ""; $emailbcc = "";
$emailfooter1 = $GLOBALS{'domain_longname'};
$emailfooter2 = "";
$emailsubject = 'Your '.$GLOBALS{'event_title'}.' booking.';
$mainmessage = 'This email is to confirm we have reserved a place for '.$GLOBALS{'event_attendeefname'}.' '.$GLOBALS{'event_attendeesname'}." on this event.<br><br>";

$mainmessage = $mainmessage.'<b>Event</b> - '.$GLOBALS{'event_title'}."<br><br>";
$mainmessage = $mainmessage.'<b>Date</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'})."<br><br>";
$mainmessage = $mainmessage.'<b>Time</b> - '.$GLOBALS{'event_time'}."<br><br>";
$mainmessage = $mainmessage.'<b>Cost</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', '')."<br><br>";
Check_Data('venue',$GLOBALS{'event_venuecode'});
$mainmessage = $mainmessage.'<b>Venue</b> - '.$GLOBALS{'venue_name'}."<br><br>";
$attendeestatuslistelement = GetEventAttendeeStatus($inevent_attendeeref);
if ($attendeestatuslistelement != "") {
	$abits = explode('~',GetEventAttendeeStatus($inevent_attendeeref));
	if ($GLOBALS{'event_personorteam'} == "Team") {
		$mainmessage = $mainmessage.'<b>Team Name</b> - '.$abits[1]."<br><br>";
		$mainmessage = $mainmessage.'<b>Team Members</b> -<br>'.$abits[2]."<br><br>";
	} else {
		$mainmessage = $mainmessage.'<b>Event Places Required</b> - '.$abits[1]."<br><br>";
		$mainmessage = $mainmessage.'<b>Names (optional)</b> - '.$abits[2]."<br><br>";
	}
}
$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
if ($inevent_attendeefname == "Test") {
	Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
} else {
	HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
}

Back_Navigator();
PageFooter("Default","Final");


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
