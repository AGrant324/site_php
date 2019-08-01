<?php # bookingcourseout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Check_Session_Validity();

$inlisttype = $_REQUEST['ListType'];

if( is_array($_REQUEST['CourseCategoryList'])) {
	# one of checkboxes selected
	$selectedcoursecategorylist = Array2List($_REQUEST['CourseCategoryList']);
} else {
	$selectedcoursecategorylist  = "";
}

$inschools = $_REQUEST['Schools'];

if ( $inlisttype == "MailChimp"  ) {
	
	$outputrowarray = Array(3);
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');
	$output = fopen('php://output', 'w');
	fputcsv($output, array('First Name', 'Surname', 'Email'));
	
	if ( $selectedcoursecategorylist != "") {
		$courseattendeea = Get_Array('courseattendee');
		foreach ($courseattendeea as $courseattendee_id) {
			$foundincourse = "0";
			Get_Data('courseattendee',$courseattendee_id);
			if ($GLOBALS{'courseattendee_email'} != "") {
				$coursea = Get_Array('course');
				foreach ($coursea as $course_id) {
					if ($foundincourse == "0") {
						Get_Data('course',$course_id);					
						if (($GLOBALS{'course_coursecategoryid'} != "")&&(FoundInCommaList($GLOBALS{'course_coursecategoryid'},$selectedcoursecategorylist))) {
							if (strpos($GLOBALS{'course_attendeestatuslist'}, $courseattendee_id."~") !== false) {	
								$foundincourse = "1";
								$outputrowarray[0] = $GLOBALS{'courseattendee_fname'};
								$outputrowarray[1] = $GLOBALS{'courseattendee_sname'};
								$outputrowarray[2] = $GLOBALS{'courseattendee_email'};
								fputcsv($output, $outputrowarray);						
							}
						}
					}
				}
			}
		}
	}
	if ( $inschools == "Yes") {
		$courseschoola = Get_Array('courseschool');
		foreach ($courseschoola as $courseschool_id) {
			Get_Data('courseschool',$courseschool_id);
			for ($i = 1; $i <= 4; $i++) {
				if ( $GLOBALS{'courseschool_contact'.$i.'broadcast'} == "Yes" ) {
					$outputrowarray[0] = $GLOBALS{'courseschool_contact'.$i.'fname'};
					$outputrowarray[1] = $GLOBALS{'courseschool_contact'.$i.'sname'};
					$outputrowarray[2] = $GLOBALS{'courseschool_contact'.$i.'email'};
					fputcsv($output, $outputrowarray);
				}
			}
		}
	}
	fclose($output);
	
}

if ( $inlisttype == "EmailList"  ) {
	
	PageHeader("Default","Final");
	Check_Session_Validity();
	Back_Navigator();
	
	
	XH3("Download Email Lists");
	XPTXT("Copy and Paste list into your email.");
	
	$emaillist = ""; $sep = "";
	if ( $selectedcoursecategorylist != "") {
		$courseattendeea = Get_Array('courseattendee');
		foreach ($courseattendeea as $courseattendee_id) {
			$foundincourse = "0";
			Get_Data('courseattendee',$courseattendee_id);
			if ($GLOBALS{'courseattendee_email'} != "") {
				$coursea = Get_Array('course');
				foreach ($coursea as $course_id) {
					if ($foundincourse == "0") {
						Get_Data('course',$course_id);
						if (($GLOBALS{'course_coursecategoryid'} != "")&&(FoundInCommaList($GLOBALS{'course_coursecategoryid'},$selectedcoursecategorylist))) {
							if (strpos($GLOBALS{'course_attendeestatuslist'}, $courseattendee_id."~") !== false) {
								$foundincourse = "1";
								if (FoundInCommaList($GLOBALS{'courseattendee_email'},$emaillist)) {}
								else {
									$emaillist = $emaillist.$sep.$GLOBALS{'courseattendee_email'};
									$sep = ",";									
								}

							}
						}
					}
				}		
			}
		}
	}
	if ( $inschools == "Yes") {
		$courseschoola = Get_Array('courseschool');
		foreach ($courseschoola as $courseschool_id) {
			Get_Data('courseschool',$courseschool_id);
			for ($i = 1; $i <= 4; $i++) {
				if ( $GLOBALS{'courseschool_contact'.$i.'broadcast'} == "Yes" ) {
					$emaillist = $emaillist.$sep.$GLOBALS{'courseschool_contact'.$i.'email'};
					$sep = ",";
				}
			}
		}
	}
	
	XTEXTAREA("emaillist","10","100");
	XTXT($emaillist);
	X_TEXTAREA();
	Back_Navigator();
	PageFooter("Default","Final");
	
}

