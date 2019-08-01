<<<<<<< HEAD
 n<?php # bookingeventpaypalsuccess.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

XTXTCOLOR("Debit Card / Credit Card via Paypal successfully processed.","Green");
XBR();
XHR();

$inevent_id = $_REQUEST['event_id'];
$inevent_attendeeref = $_REQUEST['event_attendeeref'];
$inevent_selectedcharge = $_REQUEST['event_selectedcharge'];

Get_Data('event',$inevent_id);
// $event_attendeeref,$parm1,$parm2,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments

$inevent_attendeeref = str_replace( 'AT', '@', $inevent_attendeeref);
$inevent_attendeeref = str_replace( 'PIPE', '|', $inevent_attendeeref);
// XPTXT($inevent_attendeeref." | ".$inevent_selectedcharge);
UpdateEventAttendeeStatus($inevent_attendeeref,"","","","",$inevent_selectedcharge,"");
Write_Data('event',$inevent_id);

if ( strlen(strstr($inevent_attendeeref,'|'))>0 ) {
	$abits = explode('|',$inevent_attendeeref);
	$thisfname = $abits[0];
	$thissname = $abits[1];    		
	$thisemail = $abits[2];    		
} else {
	Get_Data('person',$inevent_attendeeref);
	$thisfname = $GLOBALS{'person_fname'};
	$thissname = $GLOBALS{'person_sname'};
	$thisemail = $GLOBALS{'person_email1'};
	if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email3'}; }
	if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email2'}; }   		
}

XPTXT('Thank you, We have received a event payment of '.$GLOBALS{'countrycurrencysymbol'}.number_format($inevent_selectedcharge, 2, '.', '').' for '.$thisfname.' '.$thissname.'.');

XH2($GLOBALS{'event_title'});
Check_Data("person",$GLOBALS{'event_contact'});
if ($GLOBALS{'IOWARNING'} == "0" ) {
	$showmobiletel = ""; $showemail = "";
	if ($GLOBALS{'person_mobiletel'} != "" ) {$showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};}
	if ($GLOBALS{'person_email1'} != "" ) {$showemail = "Email: ".$GLOBALS{'person_email1'};}
	XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
} else {
	XTXT("Contact - ".$GLOBALS{'event_contact'});
}
XBR();
XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'}));
XBR();
XTXT("Time - ".$GLOBALS{'event_time'});
XBR();
Check_Data('venue',$GLOBALS{'event_venuecode'});
XTXT("Venue - ".$GLOBALS{'venue_name'});
XBR();
$paymentcomments = "";
$attendeestatuslistelement = GetEventAttendeeStatus($inevent_attendeeref);
if ($attendeestatuslistelement != "") {
	$attbits = explode('~',$attendeestatuslistelement);
	// $event_attendeeref,$parm1,$parm2,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
	if ($attbits[6] != "") { $paymentcomments = $attbits[6];  XTXT("Comments - ".$paymentcomments); }
}
XH5("A confirmatory email has been sent.");

// email already sent by paypal
/*
$emailfrom = $GLOBALS{'person_email1'};
$emailfooter1 = $GLOBALS{'domain_longname'};
$emailfooter2 = "";
$emailsubject = 'Your '.$GLOBALS{'event_title'}.' booking.';
$mainmessage = 'This email is to confirm we have received the event payment for .'.$GLOBALS{'event_attendeefname'}.' '.$GLOBALS{'event_attendeesname'}."<br><br>";

$mainmessage = $mainmessage.'<b>Event</b> - '.$GLOBALS{'event_title'}."<br><br>";
$mainmessage = $mainmessage.'<b>Date</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'})."<br><br>";	
$mainmessage = $mainmessage.'<b>Time</b> - '.$GLOBALS{'event_time'}."<br><br>";
$mainmessage = $mainmessage.'<b>Payment</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($inevent_selectedcharge, 2, '.', '')."<br><br>";
Check_Data('venue',$GLOBALS{'event_venuecode'});
$mainmessage = $mainmessage.'<b>Venue</b> - '.$GLOBALS{'venue_name'}."<br><br>";
if ($paymentcomments != "") {
	$mainmessage = $mainmessage.'<b>Sessions</b> - '.$paymentcomments."<br><br>";
}
$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
if ($GLOBALS{'person_fname'} == "Test") {
	Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
} else {
	HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
}
*/

XBR();XINBUTTONCLOSEWINDOW("Close");

Back_Navigator();
PageFooter("Default","Final"); 

?>
=======
 n<?php # bookingeventpaypalsuccess.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

XTXTCOLOR("Debit Card / Credit Card via Paypal successfully processed.","Green");
XBR();
XHR();

$inevent_id = $_REQUEST['event_id'];
$inevent_attendeeref = $_REQUEST['event_attendeeref'];
$inevent_selectedcharge = $_REQUEST['event_selectedcharge'];

Get_Data('event',$inevent_id);
// $event_attendeeref,$parm1,$parm2,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments

$inevent_attendeeref = str_replace( 'AT', '@', $inevent_attendeeref);
$inevent_attendeeref = str_replace( 'PIPE', '|', $inevent_attendeeref);
// XPTXT($inevent_attendeeref." | ".$inevent_selectedcharge);
UpdateEventAttendeeStatus($inevent_attendeeref,"","","","",$inevent_selectedcharge,"");
Write_Data('event',$inevent_id);

if ( strlen(strstr($inevent_attendeeref,'|'))>0 ) {
	$abits = explode('|',$inevent_attendeeref);
	$thisfname = $abits[0];
	$thissname = $abits[1];    		
	$thisemail = $abits[2];    		
} else {
	Get_Data('person',$inevent_attendeeref);
	$thisfname = $GLOBALS{'person_fname'};
	$thissname = $GLOBALS{'person_sname'};
	$thisemail = $GLOBALS{'person_email1'};
	if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email3'}; }
	if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email2'}; }   		
}

XPTXT('Thank you, We have received a event payment of '.$GLOBALS{'countrycurrencysymbol'}.number_format($inevent_selectedcharge, 2, '.', '').' for '.$thisfname.' '.$thissname.'.');

XH2($GLOBALS{'event_title'});
Check_Data("person",$GLOBALS{'event_contact'});
if ($GLOBALS{'IOWARNING'} == "0" ) {
	$showmobiletel = ""; $showemail = "";
	if ($GLOBALS{'person_mobiletel'} != "" ) {$showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};}
	if ($GLOBALS{'person_email1'} != "" ) {$showemail = "Email: ".$GLOBALS{'person_email1'};}
	XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
} else {
	XTXT("Contact - ".$GLOBALS{'event_contact'});
}
XBR();
XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'}));
XBR();
XTXT("Time - ".$GLOBALS{'event_time'});
XBR();
Check_Data('venue',$GLOBALS{'event_venuecode'});
XTXT("Venue - ".$GLOBALS{'venue_name'});
XBR();
$paymentcomments = "";
$attendeestatuslistelement = GetEventAttendeeStatus($inevent_attendeeref);
if ($attendeestatuslistelement != "") {
	$attbits = explode('~',$attendeestatuslistelement);
	// $event_attendeeref,$parm1,$parm2,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
	if ($attbits[6] != "") { $paymentcomments = $attbits[6];  XTXT("Comments - ".$paymentcomments); }
}
XH5("A confirmatory email has been sent.");

// email already sent by paypal
/*
$emailfrom = $GLOBALS{'person_email1'};
$emailfooter1 = $GLOBALS{'domain_longname'};
$emailfooter2 = "";
$emailsubject = 'Your '.$GLOBALS{'event_title'}.' booking.';
$mainmessage = 'This email is to confirm we have received the event payment for .'.$GLOBALS{'event_attendeefname'}.' '.$GLOBALS{'event_attendeesname'}."<br><br>";

$mainmessage = $mainmessage.'<b>Event</b> - '.$GLOBALS{'event_title'}."<br><br>";
$mainmessage = $mainmessage.'<b>Date</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'})."<br><br>";	
$mainmessage = $mainmessage.'<b>Time</b> - '.$GLOBALS{'event_time'}."<br><br>";
$mainmessage = $mainmessage.'<b>Payment</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($inevent_selectedcharge, 2, '.', '')."<br><br>";
Check_Data('venue',$GLOBALS{'event_venuecode'});
$mainmessage = $mainmessage.'<b>Venue</b> - '.$GLOBALS{'venue_name'}."<br><br>";
if ($paymentcomments != "") {
	$mainmessage = $mainmessage.'<b>Sessions</b> - '.$paymentcomments."<br><br>";
}
$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
if ($GLOBALS{'person_fname'} == "Test") {
	Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
} else {
	HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
}
*/

XBR();XINBUTTONCLOSEWINDOW("Close");

Back_Navigator();
PageFooter("Default","Final"); 

?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
