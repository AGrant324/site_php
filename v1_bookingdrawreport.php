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

	$indraw_id = $_REQUEST['draw_id'];
	
	Get_Data('draw',$indraw_id);
	$reporthtml = '<h3>'.$GLOBALS{'draw_title'}.'</h3>';
	$reporthtml = $reporthtml.'<table border="0">';
		
	$headerhtml = YTR();
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Txn Id   ","Navy");	
	// $headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Id   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Name   ","Navy");	
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Email   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Date   ","Navy");	
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Payment   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Received   ","Navy");	
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Qty   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("Start   ","Navy");
	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("End   ","Navy");	
	$headerhtml = $headerhtml.Y_TR();
	$pagecountmax = 25;
	$pagecount = 999;

	$drawtxna = Get_Array('drawtxn',$indraw_id);
	foreach ($drawtxna as $drawtxn_id) {
		Get_Data('drawtxn',$indraw_id, $drawtxn_id);
		$pagecount++;
		if ($pagecount > $pagecountmax) {
			if ($pagecount != 1000) {
				$reporthtml = $reporthtml.'</table>';				 
				$reporthtml = $reporthtml."<pagebreak />";
				$reporthtml = $reporthtml.'<h3>'.$GLOBALS{'draw_title'}.'</h3>';
				$reporthtml = $reporthtml.'<table border="0">';
			}
			$pagecount = 0;
			$reporthtml = $reporthtml.$headerhtml;			
		}
		$reporthtml = $reporthtml.YTR();
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'drawtxn_id'});
		// $reporthtml = $reporthtml.YTDTXT($GLOBALS{'drawtxn_personid'});	
		Check_Data('person',$GLOBALS{'drawtxn_personid'});
		$thisfname = "Unknown";
		$thissname = "Unknown";
		$thisemail = "";
		if ($GLOBALS{'IOWARNING'} == "0" ) {
			$thisfname = $GLOBALS{'person_fname'};
			$thissname = $GLOBALS{'person_sname'};
			$thisemail = $GLOBALS{'person_email1'};
			if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email3'}; }
			if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email2'}; }			
		}		
		$reporthtml = $reporthtml.YTDTXT($thisfname." ".$thissname);
		$reporthtml = $reporthtml.YTDTXT($thisemail);
		
		$reporthtml = $reporthtml.YTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'drawtxn_paymentduedate'}));
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'drawtxn_paymentdueamount'});		
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'drawtxn_paymentamount'});		
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'drawtxn_quantity'});		
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'drawtxn_startrange'});
		$reporthtml = $reporthtml.YTDTXT($GLOBALS{'drawtxn_endrange'});	
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