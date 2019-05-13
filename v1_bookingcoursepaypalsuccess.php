 n<?php # bookingcoursepaypalsuccess.php

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

$incourse_id = $_REQUEST['course_id'];
$incourseattendee_id = $_REQUEST['courseattendee_id'];
$incourse_selectedcharge = $_REQUEST['course_selectedcharge'];

Get_Data('course',$incourse_id);
$GLOBALS{'course_attendeepaidlist'} = CommaList_Add($GLOBALS{'course_attendeepaidlist'}, $incourseattendee_id);
// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
UpdateCourseAttendeeStatus($incourseattendee_id,"","",$incourse_selectedcharge,"");
Write_Data('course',$incourse_id);

Get_Data('courseattendee',$incourseattendee_id);

Get_Data('person',$GLOBALS{'course_contact'});
$emailto = $GLOBALS{'courseattendee_email'};

XPTXT('Thank you, We have received a course payment of '.$GLOBALS{'countrycurrencysymbol'}.number_format($incourse_selectedcharge, 2, '.', '').' for '.$GLOBALS{'courseattendee_fname'}.' '.$GLOBALS{'courseattendee_sname'}.'.');

XH2($GLOBALS{'course_title'});
Check_Data("person",$GLOBALS{'course_contact'});
if ($GLOBALS{'IOWARNING'} == "0" ) {
	$showmobiletel = ""; $showemail = "";
	if ($GLOBALS{'person_mobiletel'} != "" ) {
		$showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};
	}
	if ($GLOBALS{'person_email1'} != "" ) {
		$showemail = "Email: ".$GLOBALS{'person_email1'};
	}
	XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
} else {
	XTXT("Contact - ".$GLOBALS{'course_contact'});
}
XBR();
if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
	XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
} else {
	XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_dateend'}));
}
XBR();
XTXT("Time - ".$GLOBALS{'course_timestart'}." to ".$GLOBALS{'course_timeend'});
XBR();
XTXT("Venue - ".$GLOBALS{'course_venue'});
XBR();
$paymentcomments = "";
$attendeestatuslistelement = GetCourseAttendeeStatus($incourseattendee_id);
if ($attendeestatuslistelement != "") {
	$attbits = explode('~',$attendeestatuslistelement);
	// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
	if ($attbits[4] != "") { $paymentcomments = $attbits[4];  XTXT("Sessions Booked - ".$paymentcomments); }
}
XH5("A confirmatory email has been sent.");

// email already sent by paypal
/*
$emailfrom = $GLOBALS{'person_email1'};
$emailfooter1 = $GLOBALS{'domain_longname'};
$emailfooter2 = "";
$emailsubject = 'Your '.$GLOBALS{'course_title'}.' booking.';
$mainmessage = 'This email is to confirm we have received the course payment for .'.$GLOBALS{'courseattendee_fname'}.' '.$GLOBALS{'courseattendee_sname'}."<br><br>";

$mainmessage = $mainmessage.'<b>Course</b> - '.$GLOBALS{'course_title'}."<br><br>";
if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
	$mainmessage = $mainmessage.'<b>Date</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})."<br><br>";	
} else {
	$mainmessage = $mainmessage.'<b>Dates</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_dateend'})."<br><br>";	
}
$mainmessage = $mainmessage.'<b>Time</b> - '.$GLOBALS{'course_timestart'}." to ".$GLOBALS{'course_timeend'}."<br><br>";
$mainmessage = $mainmessage.'<b>Payment</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($incourse_selectedcharge, 2, '.', '')."<br><br>";
$mainmessage = $mainmessage.'<b>Venue</b> - '.$GLOBALS{'course_venue'}."<br><br>";
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
