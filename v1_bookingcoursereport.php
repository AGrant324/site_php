<?php # personAMin.php

ini_set('memory_limit', '1024M'); // or you could use 1G

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();

if ( Check_UtilitySession_Validity() == true ) {

	$incourse_id = $_REQUEST['course_id'];
	
	Get_Data('course',$incourse_id);
	$reporthtml = '<h3>'.$GLOBALS{'course_title'}." Attendee List".'</h3>';
	$reporthtml = $reporthtml.'<table border="0">';
	
	$headerhtml = YTR();
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("First Name   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Surname   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("DOB   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Parent First Name   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Parent Surname   ","Navy");	
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("EmergencyTel   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("AltTel   ","Navy");	
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Medical   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Paid   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Signature   ","Navy");	
	$headerhtml = $headerhtml.Y_TR();

	$pagecountmax = 25;
	$pagecount = 999;
	$medicaldetailsa = Array();	

	$courseattendeestatusa = AttendeeStatus2Array($GLOBALS{'course_attendeestatuslist'});
	// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
	foreach ($courseattendeestatusa as $courseattendeestatuselement) {
		$attbits = explode('~',$courseattendeestatuselement);
		$courseattendeeid = $attbits[0];
		$paymenttype = $attbits[1];
		$paymentdue = $attbits[2];
		$paymentreceived = $attbits[3];
		$paymentcomments = $attbits[4];
		Check_Data("courseattendee",$courseattendeeid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$pagecount++;
			if ($pagecount > $pagecountmax) {
				if ($pagecount != 1000) {
					$reporthtml = $reporthtml.'</table>';				 
					$reporthtml = $reporthtml."<pagebreak />";
					$reporthtml = $reporthtml.'<h3>'.$inteamcode." Group".'</h3>';
					$reporthtml = $reporthtml.'<table border="0">';
				}
				$pagecount = 0;
				$reporthtml = $reporthtml.$headerhtml;			
			}
			$reporthtml = $reporthtml.YTR();
			$reporthtml = $reporthtml.YTDTXT($GLOBALS{'courseattendee_fname'});
			$reporthtml = $reporthtml.YTDTXT($GLOBALS{'courseattendee_sname'});
			$underage = UnderAge(18,$GLOBALS{'courseattendee_dob'});
			if ($underage) { $reporthtml = $reporthtml.YTDTXT(Age($GLOBALS{'courseattendee_dob'},19)); }
			else { $reporthtml = $reporthtml.YTDTXT(""); }
			if ($underage) { $reporthtml = $reporthtml.YTDTXT($GLOBALS{'courseattendee_parentfname'}); }
			else { $reporthtml = $reporthtml.YTDTXT(""); }	
			if ($underage) { $reporthtml = $reporthtml.YTDTXT($GLOBALS{'courseattendee_parentsname'}); }
			else { $reporthtml = $reporthtml.YTDTXT(""); }
			$reporthtml = $reporthtml.YTDTXT($GLOBALS{'courseattendee_emergencytel'});		
			$reporthtml = $reporthtml.YTDTXT($GLOBALS{'courseattendee_alttel'});
			if ($GLOBALS{'courseattendee_medicaldetails'} != "") {
				$reporthtml = $reporthtml.YTDTXT("See Notes");
				array_push($medicaldetailsa,$GLOBALS{'courseattendee_fname'}." ".$GLOBALS{'courseattendee_sname'}."|".$GLOBALS{'courseattendee_medicaldetails'});
			} else {
				$reporthtml = $reporthtml.YTDTXT("");
			}	
			$reporthtml = $reporthtml.YTDTXT($paymentreceived);
			$reporthtml = $reporthtml.YTDTXT("_______________");
			$reporthtml = $reporthtml.Y_TR();
		}
	}
	$reporthtml = $reporthtml.Y_TABLE();
	
	if ( count($medicaldetailsa)  > 0 ) {
		$reporthtml = $reporthtml."<pagebreak />";
		$reporthtml = $reporthtml.'<h3>Medical Notes</h3><hr>';
		foreach ($medicaldetailsa as $medicaldetails) {
			$bitsa = explode('|',$medicaldetails);
			$reporthtml = $reporthtml.'<h5>'.$bitsa[0].'</h5>';
			$reporthtml = $reporthtml.$bitsa[1].'<hr>';	
		}		
	}

	$mpdf = new mPDF(
	'',    // mode - default ''
	'A4-L',  // format - A4, for example, default ''
	12,     // font size - default 0
	'Helvetica',    // font family
	10,    // margin_left
	10,    // margin right
	10,    // margin top
	10,    // margin bottom
	20,     // margin header
	9,     // margin footer
	'L');  // L - landscape, P - portrait

	$reporthtml = mb_convert_encoding($reporthtml, 'UTF-8', 'UTF-8'); // trick to avoid issue with non UTF-8 characters
	$mpdf->WriteHTML($reporthtml);
	$mpdf->Output();

} else {
	PopUpHeader();
	Check_Session_Validity(); // forces exit
}







?>