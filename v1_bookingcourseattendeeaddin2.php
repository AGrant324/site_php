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

XPTXT($GLOBALS{'courseattendee_fname'}." ".$GLOBALS{'courseattendee_fname'}." added to course");

Booking_COURSEATTENDEEADMIN_Output($incourse_id);
XBR();XBR();
$link = YPGMLINK("bookingcoursepaymentadminout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$incourse_id);
XLINKTXT($link,"review payment status for this course");
XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","COURSEADMINLIST");
XLINKTXT($link,"show my course list");

Back_Navigator();
PageFooter("Default","Final");








