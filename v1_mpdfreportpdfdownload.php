<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_pdfroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();

$inmpdfreport_id = $_REQUEST['mpdfreport_id'];
$inkeyvaluelist = $_REQUEST['keyvaluelist'];
$inselectionlogic = $_REQUEST['mpdfreport_selectionlogic'];

Get_Data('mpdfreport',$inmpdfreport_id);

if ($GLOBALS{'mpdfreport_maxexecutiontime'} > 0) {
	ini_set('max_execution_time', $GLOBALS{'mpdfreport_maxexecutiontime'});
}

if ( $GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
	if ( $inkeyvaluelist == "TESTKEYS") { $thiskeyvaluelist = $GLOBALS{'mpdfreport_listtestkeyvalues'}; } 
	else { $thiskeyvaluelist = $inkeyvaluelist; }		
	$GLOBALS{'MPDFREPORTKEYVALUELIST'} = $thiskeyvaluelist;
	$GLOBALS{'MPDFREPORTFILTER'} = "";
	$GLOBALS{'MPDFREPORTMODE'} = "pdf";
} else {
    $thisselectionlogic = "";
    if ( $inselectionlogic != "" ) {
        $seltestina = explodeAND($inselectionlogic);
        $seltestouta = Array();
        foreach ( $seltestina as $seltestin) {
            $selbits = explodeCOMP($seltestin);
            if (isset($_REQUEST[$selbits[0]])) {
                $selbits[2] = $_REQUEST[$selbits[0]];
            }
            array_push($seltestouta, $selbits[0].$selbits[1].$selbits[2]);
        }
        $thisselectionlogic = rebuildAND($seltestouta);
    }
    $GLOBALS{'MPDFREPORTKEYVALUELIST'} = "";
    $GLOBALS{'MPDFREPORTFILTER'} = $thisselectionlogic;
    $GLOBALS{'MPDFREPORTMODE'} = "pdf";
}

if ($GLOBALS{'mpdfreport_pagelayout'} == "" ) { $GLOBALS{'mpdfreport_pagelayout'} = "A4"; }
if ( $GLOBALS{'mpdfreport_pagelayout'} == "A4" ) { $pagewidth = "210mm"; $pageheight = "297mm";  }
if ( $GLOBALS{'mpdfreport_pagelayout'} == "A4-L" ) { $pagewidth = "297mm"; $pageheight = "210mm"; }
if ( $GLOBALS{'mpdfreport_pagelayout'} == "A3" ) { $pagewidth = "297mm"; $pageheight = "420mm";  }
if ( $GLOBALS{'mpdfreport_pagelayout'} == "A3-L" ) { $pagewidth = "420mm"; $pageheight = "297mm"; }
if ($GLOBALS{'mpdfreport_fontsize'} == "" ) { $GLOBALS{'mpdfreport_fontsize'} = "10"; }

$stylestring = '<style>'."\n";
$stylestring = $stylestring.'* { margin: 0; padding: 0; font-family: Arial; font-size: '.$GLOBALS{'mpdfreport_fontsize'}.'pt; color: black; }'."\n";
$stylestring = $stylestring.'body { width: 100%; font-family: Arial; font-size: '.$GLOBALS{'mpdfreport_fontsize'}.'pt; color: black; margin: 0; padding: 0; }'."\n";
$stylestring = $stylestring.'p { margin: 0; padding: 0; }'."\n";
$stylestring = $stylestring.'.page { height: '.$pageheight.'; width: '.$pagewidth.'; }'."\n";
$stylestring = $stylestring.'table { width:100%; }'."\n";
$stylestring = $stylestring.'table td { padding: 1mm; }'."\n";
// $stylestring = $stylestring.'table.heading { height: 50mm; }'."\n";
$stylestring = $stylestring.'h1 { font-size: '.($GLOBALS{'mpdfreport_fontsize'}*2).'pt; color: orange; font-weight: normal; }'."\n";
$stylestring = $stylestring.'h2 { font-size: '.($GLOBALS{'mpdfreport_fontsize'}*1.5).'pt; color: navy; font-weight: normal; }'."\n";
$stylestring = $stylestring.'h3 { font-size: '.($GLOBALS{'mpdfreport_fontsize'}*1.25).'pt; color: navy; font-weight: normal; }'."\n";
$stylestring = $stylestring.'h4 { font-size: '.($GLOBALS{'mpdfreport_fontsize'}).'pt; color: navy; font-weight: normal; }'."\n";
$stylestring = $stylestring.'h5 { font-size: '.($GLOBALS{'mpdfreport_fontsize'}*0.8).'pt; color: navy; font-weight: normal; }'."\n";
$stylestring = $stylestring.'hr { color: red; background: #ccc; }'."\n";
$stylestring = $stylestring.'</style>'."\n";

$GLOBALS{'pdfr'} = $stylestring;
$GLOBALS{'pdfcsvha'} = Array();
$GLOBALS{'pdfcsva'} = Array();

include $GLOBALS{'domainfilepath'}."/mpdfreports/".$inmpdfreport_id.".php";

if ( $GLOBALS{'mpdfreport_pagemargins'} == "" ) { $GLOBALS{'mpdfreport_pagemargins'} = "15,15,15,15"; }
$margina = explode(",",$GLOBALS{'mpdfreport_pagemargins'});

$mpdf = new mPDF(
'',    // mode - default ''
$GLOBALS{'mpdfreport_pagelayout'},  // format - A4, for example, default ''
$GLOBALS{'mpdfreport_fontsize'},    // font size - default 0
'Helvetica',    // font family
$margina[0],    // margin_left
$margina[1],    // margin right
$margina[2],    // margin top
$margina[3],    // margin bottom
15,    // margin header
9);    // margin footer
// 'L');  // L - landscape, P - portrait
// $mpdf->showImageErrors = true;
// $mpdf->shrink_tables_to_fit = 1; // prevents resizing
$mpdf->WriteHTML($GLOBALS{'pdfr'});
$mpdf->Output();

?>