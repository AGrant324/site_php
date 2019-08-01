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

	$inevent_id = $_REQUEST['event_id'];
	
	Get_Data('event',$inevent_id);
	$reporthtml = '<h3>'.$GLOBALS{'event_title'}.'</h3>';
	$reporthtml = $reporthtml.'<table border="0">';
	
	$headerhtml = YTR();
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Name   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Email   ","Navy");
	if ($GLOBALS{'event_personorteam'} == "Team") {
		$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("TeamName   ","Navy");
	} else {
		$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Tickets   ","Navy");
	}	
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Payment   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Received   ","Navy");	
	if ($GLOBALS{'event_personorteam'} == "Team") {
		$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Team_Members   ","Navy");
	} else {
		$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Names   ","Navy");
	}
	$headerhtml = $headerhtml.Y_TR();
	$pagecountmax = 25;
	$pagecount = 999;

	
	$eventattendeestatusa = AttendeeStatus2Array($GLOBALS{'event_attendeestatuslist'});
	// $event_attendeeref,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
	foreach ($eventattendeestatusa as $eventattendeestatuselement) {
		$attbits = explode('~',$eventattendeestatuselement);
		$event_attendeeref = $attbits[0];
		$parm1 = $attbits[1];
		$parm2 = $attbits[2];
		$paymenttype = $attbits[3];
		$paymentdue = $attbits[4];
		$paymentreceived = $attbits[5];
		$paymentcomments = $attbits[6];	
	
		$pagecount++;
		if ($pagecount > $pagecountmax) {
			if ($pagecount != 1000) {
				$reporthtml = $reporthtml.'</table>';				 
				$reporthtml = $reporthtml."<pagebreak />";
				$reporthtml = $reporthtml.'<h3>'.$GLOBALS{'event_title'}.'</h3>';
				$reporthtml = $reporthtml.'<table border="0">';
			}
			$pagecount = 0;
			$reporthtml = $reporthtml.$headerhtml;			
		}
		$reporthtml = $reporthtml.YTR().YTDTXT("");YTDTXT("");YTDTXT("");YTDTXT("");YTDTXT("");YTDTXT("").Y_TR();
		$reporthtml = $reporthtml.YTR();
		if ( strlen(strstr($event_attendeeref,'|'))>0 ) {
			$abits = explode('|',$event_attendeeref);
			$thisfname = $abits[0];
			$thissname = $abits[1];
			$thisemail = $abits[2];
		} else {
			Get_Data('person',$event_attendeeref);
			$thisfname = $GLOBALS{'person_fname'};
			$thissname = $GLOBALS{'person_sname'};
			$thisemail = $GLOBALS{'person_email1'};
			if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email3'};}
			if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email2'};}		
		}		
		$reporthtml = $reporthtml.YTDTXT($thisfname." ".$thissname);
		$reporthtml = $reporthtml.YTDTXT($thisemail);
		if ($GLOBALS{'event_personorteam'} == "Team") {
			$reporthtml = $reporthtml.YTDTXT($parm1);
		} else {
			$reporthtml = $reporthtml.YTDTXT($parm1);
		}
		$reporthtml = $reporthtml.YTDTXT($paymenttype);				
		$reporthtml = $reporthtml.YTDTXT( $GLOBALS{'countrycurrencysymbol'}.number_format(floatval($paymentreceived), 2, '.', '') );
		$narr = explode("\n", $parm2);
		if (empty($narr)) {
			$reporthtml = $reporthtml.YTDTXT("");
		} else {
			if (count($narr) == 1) { $reporthtml = $reporthtml.YTDTXT($parm2).Y_TR(); }
			else {
				$reporthtml = $reporthtml.YTDTXT($narr[0]).Y_TR();
				for ($ni = 1; $ni < count($narr); $ni++) { 
					$reporthtml = $reporthtml.YTR().YTDTXT("").YTDTXT("").YTDTXT("").YTDTXT("").YTDTXT("").YTDTXT($narr[$ni]).Y_TR();
				}
			}
		}
	}
	$reporthtml = $reporthtml.Y_TABLE();
	

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