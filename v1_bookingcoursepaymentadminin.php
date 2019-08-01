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
Get_Data('course',$incourse_id);

$courseattendeestatusa = AttendeeStatus2Array($GLOBALS{'course_attendeestatuslist'});
// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
foreach ($courseattendeestatusa as $courseattendeestatuselement) {
	$attbits = explode('~',$courseattendeestatuselement);
	$courseattendeeid = $attbits[0];
	$attendeestatuslistelement = GetCourseAttendeeStatus($courseattendeeid);
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
		UpdateCourseAttendeeStatus($courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments);
		// XPTXT($incourseattendeeid." updated");
	}	
}
Write_Data('course',$incourse_id);			
Booking_COURSEPAYMENTADMIN_Output ($incourse_id);

XBR();XBR();
$link = YPGMLINK("bookingcourseattendeeadminout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$incourse_id);
XLINKTXT($link,"add/remove attendees for this course");
XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","COURSEADMINLIST");
XLINKTXT($link,"show my course list");


Back_Navigator();
PageFooter("Default","Final");
