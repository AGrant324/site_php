<<<<<<< HEAD
<?php # webpageeventupdateout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();

$infield_table = $_REQUEST["field_table"];

$GLOBALS{'report_pagelayout'} = "A4-L";
$GLOBALS{'report_fontsize'} = "10";
$GLOBALS{'report_linesperpage'} = "20";

if ($GLOBALS{'mpdfreport_pagelayout'} == "" ) { $GLOBALS{'mpdfreport_pagelayout'} = "A4"; }
if ( $GLOBALS{'mpdfreport_pagelayout'} == "A4" ) { $pagewidth = "210mm"; $pageheight = "297mm";  }
if ( $GLOBALS{'mpdfreport_pagelayout'} == "A4-L" ) { $pagewidth = "297mm"; $pageheight = "210mm"; }
if ( $GLOBALS{'mpdfreport_pagelayout'} == "A3" ) { $pagewidth = "297mm"; $pageheight = "420mm";  }
if ( $GLOBALS{'mpdfreport_pagelayout'} == "A3-L" ) { $pagewidth = "420mm"; $pageheight = "297mm"; }
if ($GLOBALS{'mpdfreport_fontsize'} == "" ) { $GLOBALS{'mpdfreport_fontsize'} = "10"; }

if ($GLOBALS{'report_fontsize'} == "" ) { $GLOBALS{'report_fontsize'} = "10"; }
$stylestring = '<style>'."\n";
$stylestring = $stylestring.'* { margin: 0; padding: 0; font-family: Arial; font-size: '.$GLOBALS{'report_fontsize'}.'pt; color: black; }'."\n";
$stylestring = $stylestring.'body { width: 100%; font-family: Arial; font-size: '.$GLOBALS{'report_fontsize'}.'pt; color: black; margin: 0; padding: 0; }'."\n";
$stylestring = $stylestring.'p { margin: 0; padding: 0; }'."\n";
$stylestring = $stylestring.'.page { height: '.$pageheight.'; width: '.$pagewidth.'; }'."\n";
$stylestring = $stylestring.'table { width:100%; }'."\n";
$stylestring = $stylestring.'table td { padding: 1mm; }'."\n";
// $stylestring = $stylestring.'table.heading { height: 50mm; }'."\n";
$stylestring = $stylestring.'h1 { font-size: '.($GLOBALS{'report_fontsize'}+4).'pt; color: navy; font-weight: normal; }'."\n";
$stylestring = $stylestring.'hr { color: red; background: #ccc; }'."\n";
$stylestring = $stylestring.'</style>'."\n";

$reporthtml = $stylestring;
$reporthtml = $reporthtml.'<h1>Field Properties - '.$infield_table.'</h1>';
$reporthtml = $reporthtml.'<table border="0">';

$fielda = Get_Array_Hash_SortSelect('field',$infield_table,"field_seq","","");

// Set the headers
$headerhtml = YTR()."\n";
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('Field Name','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('DB Type','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('Seq','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('Report Name','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('Mass Update Type','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('Cols','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('MaxChars / Rows','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('Selection','10%',"Navy")."\n";	
$headerhtml = $headerhtml.Y_TR()."\n";


// Output the report
$pagecountmax = $GLOBALS{'report_linesperpage'};
$pagecount = 999;
foreach ( $fielda as $field_name) {
	Get_Data('field',$infield_table,$field_name);		
	$pagecount++;
	if ($pagecount > $pagecountmax) {
		if ($pagecount != 1000) {
			$reporthtml = $reporthtml.'</table>';
			$reporthtml = $reporthtml."<pagebreak />";
			$reporthtml = $reporthtml.'<h1>Field Properties - '.$infield_table.'</h1>';			
			$reporthtml = $reporthtml.'<table border="0">';
		}
		$pagecount = 0;
		$reporthtml = $reporthtml.$headerhtml."\n";
		$colrow = true;
	}
	if ($colrow == true) {$rowcolor = "#f9f9f9"; $colrow = false;}
	else {$rowcolor = "white"; $colrow = true;}
	
	$reporthtml = $reporthtml.'<tr bgcolor="'.$rowcolor.'">';	
	$reporthtml = $reporthtml.YTDTXT($infield_table."_".$GLOBALS{'field_name'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_databasetype'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_seq'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_reportname'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_massupdatetype'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_massupdateparm1'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_massupdateparm2'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_massupdateselection'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.Y_TR()."\n";
}

$reporthtml = $reporthtml.Y_TABLE()."\n";

$mpdf = new mPDF(
'',    // mode - default ''
$GLOBALS{'report_pagelayout'},  // format - A4, for example, default ''
$GLOBALS{'report_fontsize'},    // font size - default 0
'Helvetica',    // font family
10,    // margin_left
10,    // margin right
10,    // margin top
10,    // margin bottom
20,    // margin header
9);    // margin footer
// 'L');  // L - landscape, P - portrait

$reporthtml = mb_convert_encoding($reporthtml, 'UTF-8', 'UTF-8'); // trick to avoid issue with non UTF-8 characters
$mpdf->WriteHTML($reporthtml);
$mpdf->Output();

=======
<?php # webpageeventupdateout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();

$infield_table = $_REQUEST["field_table"];

$GLOBALS{'report_pagelayout'} = "A4-L";
$GLOBALS{'report_fontsize'} = "10";
$GLOBALS{'report_linesperpage'} = "20";

if ($GLOBALS{'mpdfreport_pagelayout'} == "" ) { $GLOBALS{'mpdfreport_pagelayout'} = "A4"; }
if ( $GLOBALS{'mpdfreport_pagelayout'} == "A4" ) { $pagewidth = "210mm"; $pageheight = "297mm";  }
if ( $GLOBALS{'mpdfreport_pagelayout'} == "A4-L" ) { $pagewidth = "297mm"; $pageheight = "210mm"; }
if ( $GLOBALS{'mpdfreport_pagelayout'} == "A3" ) { $pagewidth = "297mm"; $pageheight = "420mm";  }
if ( $GLOBALS{'mpdfreport_pagelayout'} == "A3-L" ) { $pagewidth = "420mm"; $pageheight = "297mm"; }
if ($GLOBALS{'mpdfreport_fontsize'} == "" ) { $GLOBALS{'mpdfreport_fontsize'} = "10"; }

if ($GLOBALS{'report_fontsize'} == "" ) { $GLOBALS{'report_fontsize'} = "10"; }
$stylestring = '<style>'."\n";
$stylestring = $stylestring.'* { margin: 0; padding: 0; font-family: Arial; font-size: '.$GLOBALS{'report_fontsize'}.'pt; color: black; }'."\n";
$stylestring = $stylestring.'body { width: 100%; font-family: Arial; font-size: '.$GLOBALS{'report_fontsize'}.'pt; color: black; margin: 0; padding: 0; }'."\n";
$stylestring = $stylestring.'p { margin: 0; padding: 0; }'."\n";
$stylestring = $stylestring.'.page { height: '.$pageheight.'; width: '.$pagewidth.'; }'."\n";
$stylestring = $stylestring.'table { width:100%; }'."\n";
$stylestring = $stylestring.'table td { padding: 1mm; }'."\n";
// $stylestring = $stylestring.'table.heading { height: 50mm; }'."\n";
$stylestring = $stylestring.'h1 { font-size: '.($GLOBALS{'report_fontsize'}+4).'pt; color: navy; font-weight: normal; }'."\n";
$stylestring = $stylestring.'hr { color: red; background: #ccc; }'."\n";
$stylestring = $stylestring.'</style>'."\n";

$reporthtml = $stylestring;
$reporthtml = $reporthtml.'<h1>Field Properties - '.$infield_table.'</h1>';
$reporthtml = $reporthtml.'<table border="0">';

$fielda = Get_Array_Hash_SortSelect('field',$infield_table,"field_seq","","");

// Set the headers
$headerhtml = YTR()."\n";
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('Field Name','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('DB Type','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('Seq','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('Report Name','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('Mass Update Type','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('Cols','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('MaxChars / Rows','10%',"Navy")."\n";	
$headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR('Selection','10%',"Navy")."\n";	
$headerhtml = $headerhtml.Y_TR()."\n";


// Output the report
$pagecountmax = $GLOBALS{'report_linesperpage'};
$pagecount = 999;
foreach ( $fielda as $field_name) {
	Get_Data('field',$infield_table,$field_name);		
	$pagecount++;
	if ($pagecount > $pagecountmax) {
		if ($pagecount != 1000) {
			$reporthtml = $reporthtml.'</table>';
			$reporthtml = $reporthtml."<pagebreak />";
			$reporthtml = $reporthtml.'<h1>Field Properties - '.$infield_table.'</h1>';			
			$reporthtml = $reporthtml.'<table border="0">';
		}
		$pagecount = 0;
		$reporthtml = $reporthtml.$headerhtml."\n";
		$colrow = true;
	}
	if ($colrow == true) {$rowcolor = "#f9f9f9"; $colrow = false;}
	else {$rowcolor = "white"; $colrow = true;}
	
	$reporthtml = $reporthtml.'<tr bgcolor="'.$rowcolor.'">';	
	$reporthtml = $reporthtml.YTDTXT($infield_table."_".$GLOBALS{'field_name'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_databasetype'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_seq'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_reportname'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_massupdatetype'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_massupdateparm1'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_massupdateparm2'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.YTDTXT($GLOBALS{'field_massupdateselection'},'10%',"Navy")."\n";
	$reporthtml = $reporthtml.Y_TR()."\n";
}

$reporthtml = $reporthtml.Y_TABLE()."\n";

$mpdf = new mPDF(
'',    // mode - default ''
$GLOBALS{'report_pagelayout'},  // format - A4, for example, default ''
$GLOBALS{'report_fontsize'},    // font size - default 0
'Helvetica',    // font family
10,    // margin_left
10,    // margin right
10,    // margin top
10,    // margin bottom
20,    // margin header
9);    // margin footer
// 'L');  // L - landscape, P - portrait

$reporthtml = mb_convert_encoding($reporthtml, 'UTF-8', 'UTF-8'); // trick to avoid issue with non UTF-8 characters
$mpdf->WriteHTML($reporthtml);
$mpdf->Output();

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>