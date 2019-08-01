<<<<<<< HEAD
<?php # personAMin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();

$insectiongroup = $_REQUEST['SectionGroup'];
$reporthtml = '<h3>'.$insectiongroup." Group".'</h3>';
$reporthtml = $reporthtml.'<table border="0">';


$headerhtml = YTR();
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("First Name   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Surname   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Age   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Medical   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("EmergencyTel   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Photo   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Trans   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Parent First Name   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Parent Surname   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Paid   ","Navy");
$headerhtml = $headerhtml.Y_TR();

$pagecountmax = 25;
$pagecount = 999;
$medicaldetailsa = Array();
foreach ( Get_Array('person') as $person_id) {
	Get_Data( 'person', $person_id );
	if ( MatchLists ($GLOBALS{'person_sectiongroup'}, $insectiongroup) ) {		
		$pagecount++;
		if ($pagecount > $pagecountmax) {
			if ($pagecount != 1000) {
				$reporthtml = $reporthtml.'</table>';				 
				$reporthtml = $reporthtml."<pagebreak />";
				$reporthtml = $reporthtml.'<h3>'.$insectiongroup." Group".'</h3>';
				$reporthtml = $reporthtml.'<table border="0">';
			}
			$pagecount = 0;
			$reporthtml = $reporthtml.$headerhtml;			
		}
		$reporthtml = $reporthtml.YTR();
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_fname'});
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_sname'});
		$reporthtml = $reporthtml.YTDTXT(Age($GLOBALS{'person_dob'},19));
		if ($GLOBALS{'person_medicaldetails'} != "") {
			$reporthtml = $reporthtml.YTDTXT("See Notes");
			array_push($medicaldetailsa,$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_medicaldetails'});
		} else {
			$reporthtml = $reporthtml.YTDTXT("");
		}		
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_emergencytel'});
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_photographyconsent'});
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_transportconsent'});
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_parentfname'});
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_parentsname'});
		$paidstatus = "";
		if ($GLOBALS{'person_paidperiodid'} == $GLOBALS{'currperiodid'}) { $paidstatus = "Yes"; }
		$reporthtml = $reporthtml.YTDTXT($paidstatus);
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


=======
<?php # personAMin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();

$insectiongroup = $_REQUEST['SectionGroup'];
$reporthtml = '<h3>'.$insectiongroup." Group".'</h3>';
$reporthtml = $reporthtml.'<table border="0">';


$headerhtml = YTR();
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("First Name   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Surname   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Age   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Medical   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("EmergencyTel   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Photo   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Trans   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Parent First Name   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Parent Surname   ","Navy");
$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Paid   ","Navy");
$headerhtml = $headerhtml.Y_TR();

$pagecountmax = 25;
$pagecount = 999;
$medicaldetailsa = Array();
foreach ( Get_Array('person') as $person_id) {
	Get_Data( 'person', $person_id );
	if ( MatchLists ($GLOBALS{'person_sectiongroup'}, $insectiongroup) ) {		
		$pagecount++;
		if ($pagecount > $pagecountmax) {
			if ($pagecount != 1000) {
				$reporthtml = $reporthtml.'</table>';				 
				$reporthtml = $reporthtml."<pagebreak />";
				$reporthtml = $reporthtml.'<h3>'.$insectiongroup." Group".'</h3>';
				$reporthtml = $reporthtml.'<table border="0">';
			}
			$pagecount = 0;
			$reporthtml = $reporthtml.$headerhtml;			
		}
		$reporthtml = $reporthtml.YTR();
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_fname'});
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_sname'});
		$reporthtml = $reporthtml.YTDTXT(Age($GLOBALS{'person_dob'},19));
		if ($GLOBALS{'person_medicaldetails'} != "") {
			$reporthtml = $reporthtml.YTDTXT("See Notes");
			array_push($medicaldetailsa,$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_medicaldetails'});
		} else {
			$reporthtml = $reporthtml.YTDTXT("");
		}		
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_emergencytel'});
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_photographyconsent'});
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_transportconsent'});
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_parentfname'});
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'person_parentsname'});
		$paidstatus = "";
		if ($GLOBALS{'person_paidperiodid'} == $GLOBALS{'currperiodid'}) { $paidstatus = "Yes"; }
		$reporthtml = $reporthtml.YTDTXT($paidstatus);
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


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>