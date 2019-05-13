<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_pdfroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$inmpdfreport_id = $_REQUEST['mpdfreport_id'];
$inkeyvaluelist = $_REQUEST['keyvaluelist'];
$inselectionlogic = urldecode($_REQUEST['mpdfreport_filtervalue']);

Get_Data('mpdfreport',$inmpdfreport_id);

if ($GLOBALS{'mpdfreport_maxexecutiontime'} > 0) {
    ini_set('max_execution_time', $GLOBALS{'mpdfreport_maxexecutiontime'});
}

if ( $GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
    if ( $inkeyvaluelist == "TESTKEYS") { $thiskeyvaluelist = $GLOBALS{'mpdfreport_listtestkeyvalues'}; }
    else { $thiskeyvaluelist = $inkeyvaluelist; }
    $GLOBALS{'MPDFREPORTKEYVALUELIST'} = $thiskeyvaluelist;
    $GLOBALS{'MPDFREPORTFILTER'} = "";
    $GLOBALS{'MPDFREPORTMODE'} = "csv";
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
    $GLOBALS{'MPDFREPORTMODE'} = "csv";
}

$downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/datadownload_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".csv";
$GLOBALS{'IOFDOWNLOAD'} = Open_File_Write ($downloadfilename);

$GLOBALS{'pdfr'} = "";
$GLOBALS{'pdfcsvha'} = Array();
$GLOBALS{'pdfcsva'} = Array();

// print_r($GLOBALS{'pdfcsva'});

include $GLOBALS{'domainfilepath'}."/mpdfreports/".$inmpdfreport_id.".php";

fputcsv($GLOBALS{'IOFDOWNLOAD'} , $GLOBALS{'pdfcsvha'});
foreach ($GLOBALS{'pdfcsva'} as $key => $varray) {
    $rowa = Array();
    $cols = sizeof($varray);
    for ($i = 0; $i < $cols; $i++) {
        array_push($rowa,$GLOBALS{'pdfcsva'}[$key][$i]);
    }
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , $rowa);
}
Close_File_Write ($GLOBALS{'IOFDOWNLOAD'});

Download_File ($downloadfilename,"delete");



?>