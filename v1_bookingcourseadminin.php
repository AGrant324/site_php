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
XH2("Course Administration ".$GLOBALS{'course_title'});
Get_Data('course',$incourse_id);

$courseattendeestatusa = AttendeeStatus2Array($GLOBALS{'course_attendeestatuslist'});
// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
foreach ($courseattendeestatusa as $courseattendeestatuselement) {
	$attbits = explode('~',$courseattendeestatuselement);
	$courseattendeeid = $attbits[0];
	$attendeestatuslistelement = GetAttendeeStatus($courseattendeeid);
	if ($attendeestatuslistelement != "") { // record exists for this person
		if (isset($_REQUEST[$courseattendeeid."_paymentdue"])) {	
			$paymentdue = $_REQUEST[$courseattendeeid."_paymentdue"];	
		}
		if (isset($_REQUEST[$courseattendeeid."_paymentcomments"])) {
			$paymentcomments = $_REQUEST[$courseattendeeid."_paymentcomments"];
		}	
		if (isset($_REQUEST[$courseattendeeid."_paymenttype"])) {
			$paymenttype = $_REQUEST[$courseattendeeid."_paymenttype"];
		}		
		if (isset($_REQUEST[$courseattendeeid."_paymentreceived"])) {
			$paymentreceived = $_REQUEST[$courseattendeeid."_paymentreceived"];
		}	
		UpdateAttendeeStatus($courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments);
		// XPTXT($incourseattendeeid." updated");
	}	
}
Write_Data('course',$incourse_id);			
Booking_COURSEADMIN_Output ($incourse_id);


Back_Navigator();
PageFooter("Default","Final");
