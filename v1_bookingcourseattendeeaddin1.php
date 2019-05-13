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
$incourseattendee_sname = $_REQUEST['SurName'];
$incourseattendee_fname = $_REQUEST['FirstName'];
$ddpart = $_REQUEST['DOB_DDpart'];
$mmpart = $_REQUEST['DOB_MMpart'];
$yyyypart = $_REQUEST['DOB_YYYYpart'];
$incourseattendee_dob = $yyyypart."-".$mmpart."-".$ddpart;

$originalperson_sname = $incourseattendee_sname;
$originalperson_fname = $incourseattendee_fname;
$inmatchsname = strtolower($incourseattendee_sname);
$inmatchfname = strtolower($incourseattendee_fname);

Get_Data("course",$incourse_id);

XH1("Add Attendee - ".$GLOBALS{'course_title'});
if (($incourseattendee_sname == "")||($incourseattendee_fname == "")||($incourseattendee_dob == "0000-00-00")) {
	print "<P>No First Name, Surname or Date of Birth entered. Please try again.";
	Booking_CourseAttendeeAdd_Output($incourse_id,$incourseattendee_fname, $incourseattendee_sname,$incourseattendee_dob);
} else {
	// see if this is an existing course attendee
	$foundcourseattendee_id = "";
	$courseattendeea = Get_Array('courseattendee');
	foreach ($courseattendeea as $tcourseattendee_id) {
		Get_Data("courseattendee",$tcourseattendee_id);
		$testperson_sname = strtolower($GLOBALS{'courseattendee_sname'});
		$testperson_fname = strtolower($GLOBALS{'courseattendee_fname'});
		$found = "0";
		if (($inmatchsname == $testperson_sname)&&($inmatchfname == $testperson_fname)&&($incourseattendee_dob == $GLOBALS{'courseattendee_dob'})) {
			$foundcourseattendee_id = $tcourseattendee_id;
			$courseattendee_id = $tcourseattendee_id;
		}
	}
	if ($foundcourseattendee_id != "") {
		// ======= Existing Course Attendee ===========================================================
		Get_Data("courseattendee",$foundcourseattendee_id);
		$courseattendee_email = $GLOBALS{'courseattendee_email'};
		$courseattendee_emergencytel = $GLOBALS{'courseattendee_emergencytel'};
		$courseattendee_dob = $GLOBALS{'courseattendee_dob'};
		$courseattendee_personid = $GLOBALS{'courseattendee_personid'};
		$courseattendee_addr1 = $GLOBALS{'courseattendee_addr1'};
		$courseattendee_addr2 = $GLOBALS{'courseattendee_addr2'};
		$courseattendee_addr3 = $GLOBALS{'courseattendee_addr3'};
		$courseattendee_addr4 = $GLOBALS{'courseattendee_addr4'};
		$courseattendee_postcode = $GLOBALS{'courseattendee_postcode'};
		$courseattendee_parentsname = $GLOBALS{'courseattendee_parentsname'};
		$courseattendee_parentfname = $GLOBALS{'courseattendee_parentfname'};
		$courseattendee_alttel = $GLOBALS{'courseattendee_alttel'};
		$courseattendee_medicaldetails = $GLOBALS{'courseattendee_medicaldetails'};
		$courseattendee_school = $GLOBALS{'courseattendee_school'};		
		$courseattendee_experience = $GLOBALS{'courseattendee_experience'};
		$courseattendee_photographyconsent = $GLOBALS{'courseattendee_photographyconsent'};
		XPTXT($incourseattendee_fname." has attended one of the courses before. The form has been prefilled with information from the existing records.");	
		XPTXT("Please check that the information is up to date and change as necessary.");
	} else {
		// ======= New Course Attendee =======================
		// Look up first in club records
		$foundperson_id = "";
		$persona = Get_Array('person');
		foreach ($persona as $tperson_id) {
			Get_Data("person",$tperson_id);
			$testperson_sname = strtolower($GLOBALS{'person_sname'});
			$testperson_fname = strtolower($GLOBALS{'person_fname'});
			$found = "0";
			if (($inmatchsname == $testperson_sname)&&($inmatchfname == $testperson_fname)&&($incourseattendee_dob == $GLOBALS{'person_dob'})) {
				$foundperson_id = $tperson_id;
			}
		}
		if ($foundperson_id != "") {
			// ======= Club Member =======================
			Check_Data("person",$foundperson_id);
			if (($GLOBALS{'person_email1'} == "" )||($GLOBALS{'person_email1'} == " " )) { $GLOBALS{'person_email1'} = $GLOBALS{'person_email3'}; }
			if (($GLOBALS{'person_email1'} == "" )||($GLOBALS{'person_email1'} == " " ))  { $GLOBALS{'person_email1'} = $GLOBALS{'person_email2'}; }
			$courseattendee_email = $GLOBALS{'person_email1'};
			if (($GLOBALS{'person_emergencytel'} == "" )||($GLOBALS{'person_emergencytel'} == " " ))  { $GLOBALS{'person_emergencytel'} = $GLOBALS{'person_mobiletel'}; }
			if (($GLOBALS{'person_emergencytel'} == "" )||($GLOBALS{'person_emergencytel'} == " " ))  { $GLOBALS{'person_emergencytel'} = $GLOBALS{'person_hometel'}; }
			$courseattendee_emergencytel = $GLOBALS{'person_emergencytel'};
			$courseattendee_dob = $GLOBALS{'person_dob'};
			$courseattendee_personid = $foundperson_id;
			$courseattendee_addr1 = $GLOBALS{'person_addr1'};
			$courseattendee_addr2 = $GLOBALS{'person_addr2'};
			$courseattendee_addr3 = $GLOBALS{'person_addr3'};
			$courseattendee_addr4 = $GLOBALS{'person_addr4'};
			$courseattendee_postcode = $GLOBALS{'person_postcode'};
			$courseattendee_parentsname = $GLOBALS{'person_parentsname'};
			$courseattendee_parentfname = $GLOBALS{'person_parentfname'};
			$courseattendee_alttel = $GLOBALS{'person_hometel'};
			$courseattendee_medicaldetails = $GLOBALS{'person_medicaldetails'};
			$courseattendee_school = "";
			$courseattendee_experience = $GLOBALS{'person_experience'};
			$courseattendee_photographyconsent = $GLOBALS{'person_photographyconsent'};
			XPTXT($incourseattendee_fname." ".$incourseattendee_sname." is a member of ".$GLOBALS{'domain_longname'}.". The form has been prefilled with information from the club records.");
			XPTXT("Please check that the information is up to date and change as necessary.");
		} else {
			// ======= Non Club Member =======================
			$courseattendee_email = "";
			$courseattendee_emergencytel = "";
			$courseattendee_dob = "";
			$courseattendee_personid = "";
			$courseattendee_addr1 = "";
			$courseattendee_addr2 = "";
			$courseattendee_addr3 = "";
			$courseattendee_addr4 = "";
			$courseattendee_postcode = "";
			$courseattendee_parentsname = "";
			$courseattendee_parentfname = "";
			$courseattendee_alttel = "";
			$courseattendee_medicaldetails = "";
			$courseattendee_school = "";			
			$courseattendee_experience = "";
			$courseattendee_photographyconsent = "";
			XPTXT($incourseattendee_fname." ".$incourseattendee_sname." is a new course attendee.");
			XPTXT("Please enter the following information.");		
		}
		// ======= Create New Course Attendee Id =======================
		$tempsname = str_replace("'", "", $inmatchsname."999");
		$tempsname = str_replace(" ", "", $tempsname."999");
		$tempfname = str_replace("'", "", $inmatchfname."999");
		$tempfname = str_replace(" ", "", $tempfname."999");		
		$snamebits = str_split($tempsname);
		$fnamebits = str_split($tempfname);
		$newspace = "0";
		$n = "";
		while ($newspace == "0") {
			$newcourseattendee_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
			$newcourseattendee_id = strtolower($newcourseattendee_id);
			$lookupnewcourseattendee_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
			Check_Data("courseattendee",$lookupnewcourseattendee_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				if ($n == "") {
					$n = "1";
				} else { ++$n;
				}
			} else {
				$newspace = "1";
			}
		}
		$courseattendee_id = $newcourseattendee_id;
	}

	XFORM("bookingcourseattendeeaddin2.php","courseattendeeadd2");
	XINSTDHID();
	XINHID("course_id",$incourse_id);
	XINHID("courseattendee_id",$courseattendee_id);
	XINHID("courseattendee_personid",$courseattendee_personid);	
	XINHID("courseattendee_fname",$incourseattendee_fname);
	XINHID("courseattendee_sname",$incourseattendee_sname);
	XBR();XH2("Participant");
	XTABLE();
	XTR();XTDTXT("First Name");XTDTXTBOLD($incourseattendee_fname);X_TR();
	XTR();XTDTXT("Surname");XTDTXTBOLD($incourseattendee_sname);X_TR();
	XTR();XTDTXT("Date of Birth");XTDINDATEYYYY_MM_DD_AGE("courseattendee_dob",$incourseattendee_dob);X_TR();	
	XTR();XTDTXT("Contact Email");XTDINTXT("courseattendee_email",$courseattendee_email,"50","100");X_TR();
	XTR();XTDTXT("Gender"); $xkeylist = "M,F"; $xvaluelist = "Male,Female";
	XTDINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"courseattendee_gender",$GLOBALS{'courseattendee_gender'});
	XTR();XTDTXT("Parent/Guardian First Name - if U18");XTDINTXT("courseattendee_parentfname",$courseattendee_parentfname,"50","100");X_TR();	
	XTR();XTDTXT("Parent/Guardian Surname - if U18");XTDINTXT("courseattendee_parentsname",$courseattendee_parentsname,"50","100");X_TR();		
	
	X_TABLE();
	XBR();XH2("Contact details in case of any emergency");
	XTABLE();
	XTR();XTDTXT("Emergency Tel");XTDINTXT("courseattendee_emergencytel",$courseattendee_emergencytel,"50","100");X_TR();		
	XTR();XTDTXT("Alternative Tel");XTDINTXT("courseattendee_alttel",$courseattendee_alttel,"50","100");X_TR();
	XTR();XTDTXT("Address 1");XTDINTXT("courseattendee_addr1",$courseattendee_addr1,"50","100");X_TR();
	XTR();XTDTXT("Address 2");XTDINTXT("courseattendee_addr2",$courseattendee_addr2,"50","100");X_TR();
	XTR();XTDTXT("Address 3");XTDINTXT("courseattendee_addr3",$courseattendee_addr3,"50","100");X_TR();
	XTR();XTDTXT("Address 4");XTDINTXT("courseattendee_addr4",$courseattendee_addr4,"50","100");X_TR();
	XTR();XTDTXT("Post Code");XTDINTXT("courseattendee_postcode",$courseattendee_postcode,"50","100");X_TR();
	XTR();XTDTXT("Are there any special<br>Medical Details that<br>we should be aware of.");
	XTD();XINTEXTAREA("course_medicaldetails",$GLOBALS{'course_medicaldetails'},"5","100");X_TD();
	X_TABLE();
	XBR();XH2("Other information");
	XTABLE();
	XTR();XTDTXT("School/College");XTDINTXT("courseattendee_school",$courseattendee_school,"50","100");X_TR();	
	XTR();XTDTXT("Playing Experience");XTDINTXT("courseattendee_experience",$courseattendee_experience,"50","100");X_TR();	
	XTR();XTDTXT("Photography Consent");
	XTD();XINCHECKBOXYESNO("courseattendee_photographyconsent",$courseattendee_photographyconsent,"");X_TD();X_TR();
	X_TABLE();
	XBR();XBR();
	XINSUBMIT("Add/Update Attendee");
	X_FORM();
		
}

Back_Navigator();
PageFooter("Default","Final");
