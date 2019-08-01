<?php # personAMin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();

if ( Check_UtilitySession_Validity() == true ) {

	$inteamcode = $_REQUEST['team_code'];
	
	Get_Data('team',$GLOBALS{'currperiodid'},$inteamcode);
	$squada = explode(',',$GLOBALS{'team_squadlist'});
	
	$reporthtml = '<h3>'.$GLOBALS{'team_name'}." Squad List".'</h3>';
	$reporthtml = $reporthtml.'<table border="0">';
	
	$headerhtml = YTR();
	$headerhtml = $headerhtml.YTDHTXTTOPLEFTCOLOR("First<br>Name   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTTOPLEFTCOLOR("Surname   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTTOPLEFTCOLOR("Home<br>Tel   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTTOPLEFTCOLOR("Mobile<br>Tel   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTTOPLEFTCOLOR("U18   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTTOPLEFTCOLOR("Emergency<br>Tel   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTTOPLEFTCOLOR("Parent<br>First Name   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTTOPLEFTCOLOR("Parent<br>Surname   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTTOPLEFTCOLOR("Medical   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTTOPLEFTCOLOR("Paid   ","Navy");
	$headerhtml = $headerhtml.Y_TR();
	
	sort($squada);
	
	$pagecountmax = 25;
	$pagecount = 999;
	$medicaldetailsa = Array();
	foreach ( $squada as $person_id) {
		Check_Data( 'person', $person_id );
		if ($GLOBALS{'IOWARNING'} == "0") {
			$pagecount++;
			if ($pagecount > $pagecountmax) {
				if ($pagecount != 1000) {
					$reporthtml = $reporthtml.'</table>';				 
					$reporthtml = $reporthtml."<pagebreak />";
					$reporthtml = $reporthtml.'<h3>'.$GLOBALS{'team_name'}." Squad List".'</h3>';
					$reporthtml = $reporthtml.'<table border="0">';
				}
				$pagecount = 0;
				$reporthtml = $reporthtml.$headerhtml;			
			}
			$reporthtml = $reporthtml.YTR();
			$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_fname'});
			$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_sname'});
			$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_hometel'});
			$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_mobiletel'});
			$underage = UnderAge(18,$GLOBALS{'person_dob'});
			if ($underage) { $reporthtml = $reporthtml.YTDTXT(Age($GLOBALS{'person_dob'},19));; }
			else { $reporthtml = $reporthtml.YTDTXT("");; }
			$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_emergencytel'});;
			if ($underage) { $reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_parentfname'});; }
			else { $reporthtml = $reporthtml.YTDTXT("");; }	
			if ($underage) { $reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_parentsname'});; }
			else { $reporthtml = $reporthtml.YTDTXT("");; }			
			if ($GLOBALS{'person_medicaldetails'} != "") {
			    $reporthtml = $reporthtml.YTDTXT("See Notes");;
				array_push($medicaldetailsa,$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_medicaldetails'});
			} else {
			    $reporthtml = $reporthtml.YTDTXT("");;
			}		
			$paidstatus = "";
			if ($GLOBALS{'person_paidperiodid'} == $GLOBALS{'currperiodid'}) { $paidstatus = "Yes"; }
			$reporthtml = $reporthtml.YTDTXT($paidstatus);;
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