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

$incourse_id = $_REQUEST['course_id'];
$incourseattendee_id = $_REQUEST['courseattendee_id'];

$this_fullcharge = $_REQUEST['this_fullcharge'];
$this_paymentoption = $_REQUEST['this_paymentoption'];
$this_fullcourseselected = $_REQUEST['this_fullcourseselected'];
$this_partchargecomments = $_REQUEST['this_partchargecomments'];
$this_partcharge = $_REQUEST['this_partcharge'];
$this_partcharge = utf8_decode($this_partcharge);  // resolves problems with pound sins

// XPTXT($this_fullcharge."|".$this_paymentoption."|".$this_fullcourseselected."|".$this_partchargecomments."|".$this_partcharge);
$this_partchargecomments = str_replace('*', "", $this_partchargecomments);
$this_partchargecomments = str_replace('~', "", $this_partchargecomments);
$this_partcharge = str_replace(':', ".", $this_partcharge);
$this_partcharge = str_replace(',', ".", $this_partcharge);
$this_partcharge = str_replace("£", "", $this_partcharge);
// XPTXT($this_fullcharge."|".$this_paymentoption."|".$this_fullcourseselected."|".$this_partchargecomments."|".$this_partcharge);

if ($this_fullcourseselected == "Yes") { $thischarge = $this_fullcharge; }
else { $thischarge = $this_partcharge; }

Get_Data('course',$incourse_id);
$GLOBALS{'course_attendeepaidlist'} = CommaList_Add($GLOBALS{'course_attendeepaidlist'}, $incourseattendee_id);
// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
UpdateCourseAttendeeStatus($incourseattendee_id,$this_paymentoption,$thischarge,"",$this_partchargecomments);
Write_Data('course',$incourse_id);

if ($this_paymentoption == "Card") {
	Booking_CoursePayPalPayment_Output ($incourse_id, $incourseattendee_id, $this_fullcourseselected, $this_partchargecomments, $thischarge);
}

if ($this_paymentoption == "Cheque") {
	Booking_CourseChequePayment_Output ($incourse_id, $incourseattendee_id, $this_fullcourseselected, $this_partchargecomments, $thischarge);
}

if ($this_paymentoption == "Cash") {
	Booking_CourseCashPayment_Output ($incourse_id, $incourseattendee_id, $this_fullcourseselected, $this_partchargecomments, $thischarge);
}

if ($this_paymentoption == "BankTransfer") {
	Booking_CourseBankTransferPayment_Output ($incourse_id, $incourseattendee_id, $this_fullcourseselected, $this_partchargecomments, $thischarge);
}

XHR();
XH4("We have reserved a place for you on the course, pending completion of ".$this_paymentoption." payment.");
Get_Data('person',$GLOBALS{'course_contact'});
$emailto = $GLOBALS{'courseattendee_email'};
XH5("A confirmatory email has been sent to ".$emailto);

$emailfrom = $GLOBALS{'person_email1'};
$emailcc = ""; $emailbcc = "";
$emailfooter1 = $GLOBALS{'domain_longname'};
$emailfooter2 = "";
$emailsubject = 'Your '.$GLOBALS{'course_title'}.' booking.';
$mainmessage = 'This email is to confirm we have reserved a place for '.$GLOBALS{'courseattendee_fname'}.' '.$GLOBALS{'courseattendee_sname'}." on this course.<br><br>";

$mainmessage = $mainmessage.'<b>Course</b> - '.$GLOBALS{'course_title'}."<br><br>";
if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
	$mainmessage = $mainmessage.'<b>Date</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})."<br><br>";
} else {
	$mainmessage = $mainmessage.'<b>Dates</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_dateend'})."<br><br>";
}
$mainmessage = $mainmessage.'<b>Time</b> - '.$GLOBALS{'course_timestart'}." to ".$GLOBALS{'course_timeend'}."<br><br>";
$mainmessage = $mainmessage.'<b>Cost</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format((float)$thischarge, 2, '.', '')."<br><br>";
$mainmessage = $mainmessage.'<b>Venue</b> - '.$GLOBALS{'course_venue'}."<br><br>";
$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
if ($GLOBALS{'courseattendee_fname'} == "Test") {
	Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
} else {
	HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
}

Back_Navigator();
PageFooter("Default","Final");


