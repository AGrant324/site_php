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
$incourseattendee_fname = $_REQUEST['courseattendee_fname'];
$incourseattendee_sname = $_REQUEST['courseattendee_sname'];
$ddpart = $_REQUEST['courseattendee_dob_DDpart'];
$mmpart = $_REQUEST['courseattendee_dob_MMpart'];
$yyyypart = $_REQUEST['courseattendee_dob_YYYYpart'];
$incourseattendee_dob = $yyyypart."-".$mmpart."-".$ddpart;
$incourseattendee_email = $_REQUEST['courseattendee_email'];
$incourseattendee_gender = $_REQUEST['courseattendee_gender'];
$incourseattendee_emergencytel = $_REQUEST['courseattendee_emergencytel'];
$incourseattendee_personid = $_REQUEST['courseattendee_personid'];
$incourseattendee_addr1 = $_REQUEST['courseattendee_addr1'];
$incourseattendee_addr2 = $_REQUEST['courseattendee_addr2'];
$incourseattendee_addr3 = $_REQUEST['courseattendee_addr3'];
$incourseattendee_addr4 = $_REQUEST['courseattendee_addr4'];
$incourseattendee_postcode = $_REQUEST['courseattendee_postcode'];
$incourseattendee_parentfname = $_REQUEST['courseattendee_parentfname'];
$incourseattendee_parentsname = $_REQUEST['courseattendee_parentsname'];
$incourseattendee_alttel = $_REQUEST['courseattendee_alttel'];
$incourseattendee_medicaldetails = $_REQUEST['courseattendee_medicaldetails'];
$incourseattendee_school = $_REQUEST['courseattendee_school'];
$incourseattendee_experience = $_REQUEST['courseattendee_experience'];
$incourseattendee_photographyconsent = $_REQUEST['courseattendee_photographyconsent'];

$GLOBALS{'courseattendee_fname'} = $incourseattendee_fname;
$GLOBALS{'courseattendee_sname'} = $incourseattendee_sname;
$GLOBALS{'courseattendee_email'} = $incourseattendee_email;
$GLOBALS{'courseattendee_gender'} = $incourseattendee_gender;
$GLOBALS{'courseattendee_emergencytel'} = $incourseattendee_emergencytel;
$GLOBALS{'courseattendee_dob'} = $incourseattendee_dob;
$GLOBALS{'courseattendee_personid'} = $incourseattendee_personid;
$GLOBALS{'courseattendee_addr1'} = $incourseattendee_addr1;
$GLOBALS{'courseattendee_addr2'} = $incourseattendee_addr2;
$GLOBALS{'courseattendee_addr3'} = $incourseattendee_addr3;
$GLOBALS{'courseattendee_addr4'} = $incourseattendee_addr4;
$GLOBALS{'courseattendee_postcode'} = $incourseattendee_postcode;
$GLOBALS{'courseattendee_parentfname'} = $incourseattendee_parentfname;
$GLOBALS{'courseattendee_parentsname'} = $incourseattendee_parentsname;
$GLOBALS{'courseattendee_alttel'} = $incourseattendee_alttel;
$GLOBALS{'courseattendee_medicaldetails'} = $incourseattendee_medicaldetails;
$GLOBALS{'courseattendee_school'} = $incourseattendee_school;
$GLOBALS{'courseattendee_experience'} = $incourseattendee_experience;
$GLOBALS{'courseattendee_photographyconsent'} = $incourseattendee_photographyconsent;

Write_Data("courseattendee",$incourseattendee_id);

Get_Data('course',$incourse_id);
$GLOBALS{'course_attendeelist'} = CommaList_Add($GLOBALS{'course_attendeelist'}, $incourseattendee_id);
UpdateCourseAttendeeStatus($incourseattendee_id,"","","","");
Write_Data('course',$incourse_id);

if ($GLOBALS{'course_charge'} == 0) {
	XH2("Thank You - We have reserved a place for you on the course - There is no charge for this course");
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
	$mainmessage = $mainmessage.'<b>Cost</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($incourse_selectedcharge, 2, '.', '')."<br><br>";
	$mainmessage = $mainmessage.'<b>Venue</b> - '.$GLOBALS{'course_venue'}."<br><br>";
	$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
	if ($GLOBALS{'courseattendee_fname'} == "Test") {
		Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	} else {
		HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}	
	
} else {
	XH2("Thank you for providing us with participant details - Now proceed to payment");
	XFORM("bookingcoursein3.php","coursein3");
	XINSTDHID();
	XINHID("course_id",$incourse_id);
	XINHID("courseattendee_id",$courseattendee_id);	
	
	if ($GLOBALS{'course_partchargepermitted'} != "Yes") {
		$coursecharge = $GLOBALS{'course_charge'};
		if ( $GLOBALS{'course_prepaidcharge'} != 0 ) {
			$coursecharge = $GLOBALS{'course_prepaidcharge'};
		}
		if (( $GLOBALS{'course_earlycharge'} != 0 )&&($GLOBALS{'course_earlychargedate'} <= $GLOBALS{'currentYYYY-MM-DD'})) {
			$coursecharge = $GLOBALS{'course_earlycharge'};
		}
		XPTXT('Cost: '.$GLOBALS{'countrycurrencysymbol'}.number_format($coursecharge, 2, '.', ''));
		XINHID("this_fullcourseselected","Yes");
		XINHID("this_fullcharge",$coursecharge);
		XINHID("this_partcharge","");
		XINHID("this_partchargecomments","");
	}
	XH3("Payment Method");
	$paymentoptionsa = explode(',',$GLOBALS{'course_paymentoptionslist'});
	foreach ($paymentoptionsa as $paymentoption) {
		if ($paymentoption == "Card") { $selected = "checked"; } else { $selected = ""; }
		XINRADIO('this_paymentoption', $paymentoption, $selected, $paymentoption);XBR();
	}
	if ($GLOBALS{'course_partchargepermitted'} == "Yes") {
		XH3("Booking Options");		
		XTABLE();
		XTR();
		# name, value, selected, text
		XTDINRADIO ('this_fullcourseselected',"Yes","checked",'Full Charge');
		XTD();
		XTXT ('Payment Amount');
		$coursecharge = $GLOBALS{'course_charge'};
		if ( $GLOBALS{'course_prepaidcharge'} != 0 ) {
			$coursecharge = $GLOBALS{'course_prepaidcharge'};
		}
		if (( $GLOBALS{'course_earlycharge'} != 0 )&&($GLOBALS{'course_earlychargedate'} <= $GLOBALS{'currentYYYY-MM-DD'})) {
			$coursecharge = $GLOBALS{'course_earlycharge'};
		}
		XPTXT('Cost: '.$GLOBALS{'countrycurrencysymbol'}.number_format($coursecharge, 2, '.', ''));
		XINHID("this_fullcharge",$coursecharge);
		X_TD();
		X_TR();
		XTR();
		# name, value, selected, text
		XTDINRADIO ('this_fullcourseselected',"No","",'Reduced Charge');
		XTD();
		XPTXT($GLOBALS{'course_partchargeinstructions'});	
		XH5("Reduced Charge Instructions");
		XINTEXTAREA("this_partchargecomments","","3","100");
		XH5("Payment Amount");		
		XINTXT("this_partcharge","","7","7");
		X_TR();
		X_TABLE();
		X_TD();
		X_TR();		
		X_TABLE();			
	} 

	XBR();
	XINSUBMIT("Continue to Payment Instructions");
	XBR();
	X_FORM();
}

$personid = $GLOBALS{'course_contact'};
Check_Data('person', $personid);
if ($GLOBALS{'IOWARNING'} == "0") {
	$emailto = $GLOBALS{'person_email1'};
	$emailcc = ""; $emailbcc = "";	
	$emailfrom =  $GLOBALS{'domain_defaultemailaddress'};	
	$emailfooter1 = $GLOBALS{'domain_longname'};
	$emailfooter2 = "";
	$emailsubject = 'New booking on '.$GLOBALS{'course_title'};
	$mainmessage = $GLOBALS{'courseattendee_fname'}.' '.$GLOBALS{'courseattendee_sname'}." has booked a place on this course.<br><br>";
	$emailcontent = $mainmessage."<br><br>Do not reply to this message.<br><br>";
	if ($GLOBALS{'courseattendee_fname'} == "Test") {
		Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	} else {
		HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
	
}

Back_Navigator();
PageFooter("Default","Final");








