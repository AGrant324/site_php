<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_slim.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,globalroutines,highcharts,exporting,jqueryhighcharttable,report,reportgraphcapture,highcharttable,jqueryconfirm";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

// print_r($_REQUEST);

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inreportexport = $_REQUEST['reportexport'];
$inreportexport_id = $_REQUEST['reportexport_id'];

Get_Data($inreportexport,$inreportexport_id);
$reporttitle = $GLOBALS{$inreportexport.'_title'};
$reportdescription = $GLOBALS{$inreportexport.'_description'};
$reportprimetable = $GLOBALS{$inreportexport.'_primetable'};
$reportreferencedtablelist = $GLOBALS{$inreportexport.'_referencedtablelist'};
$reportselectionlogic = $GLOBALS{$inreportexport.'_selectionlogic'};
$reportreferencedselectionlogic = $GLOBALS{$inreportexport.'_referencedselectionlogic'};
$reportsortlogic = $GLOBALS{$inreportexport.'_sortlogic'};
$reportfieldlist = Replace_CRandLF($GLOBALS{$inreportexport.'_fieldlist'},"|");
if ( $inreportexport == "export" ) { $GLOBALS{$inreportexport.'_uploadable'}; }
else { $reportuploadable = "No"; }

$thisselectionlogic = "";
$thismultiselectionlogic = "";
$seltestmultiouta = Array();
$ori = 1; 
$orsep = "";$orsep = "";
if ( $reportselectionlogic != "" ) {  
    $multisellogica = explodeOR($reportselectionlogic);
    foreach ($multisellogica as $multisellogic) {
        $seltestina = explodeAND($multisellogic);
    	$seltestouta = Array();
    	$fi = 0;
    	foreach ( $seltestina as $seltestin) {
    	    $fi++;
    		$selbits = explodeCOMP($seltestin);
    		// field,comp,value,format
    		if (isset($_REQUEST["PF".$ori.$fi."_".$selbits[0]])) { 	    
    		    if (is_array($_REQUEST["PF".$ori.$fi."_".$selbits[0]])) { # checkbox array
    		        $vstring = ""; $vsep = "";
    		        foreach ( $_REQUEST["PF".$ori.$fi."_".$selbits[0]] as $key => $value ) {
    		            $vstring = $vstring.$vsep.$value;
    		            $vsep = "|";
    		        }
    		        $selbits[2] = $vstring;
    		        // XPTXT($keystring.' = '.$vstring);
    		    } else {
    		        $selbits[2] = $_REQUEST["PF".$ori.$fi."_".$selbits[0]]; 
    		    }
    		}
    		array_push($seltestouta, $selbits[0].ShowFormat($selbits[3]).$selbits[1].$selbits[2]);	
    	}
    	$thisselectionlogic = rebuildAND($seltestouta);
    	array_push($seltestmultiouta, $thisselectionlogic);	
    	$ori++; $orsep = "|";
    }
    $thismultiselectionlogic = rebuildOR($seltestmultiouta); 
    // XPTXT($thismultiselectionlogic);
}

$thisreferencedselectionlogic = "";
$thismultireferencedselectionlogic = "";
$seltestmultiouta = Array();
$ori = 1;
$orsep = "";$orsep = "";
if ( $reportreferencedselectionlogic != "" ) {
    $multisellogica = explodeOR($reportreferencedselectionlogic);
    foreach ($multisellogica as $multisellogic) {
        $seltestina = explodeAND($multisellogic);
        $seltestouta = Array();
        $fi = 0;
        foreach ( $seltestina as $seltestin) {
            $fi++;
            $selbits = explodeCOMP($seltestin);
            // field,comp,value,format
            if (isset($_REQUEST["PF".$ori.$fi."_".$selbits[0]])) {
                if (is_array($_REQUEST["PF".$ori.$fi."_".$selbits[0]])) { # checkbox array
                    $vstring = ""; $vsep = "";
                    foreach ( $_REQUEST["PF".$ori.$fi."_".$selbits[0]] as $key => $value ) {
                        $vstring = $vstring.$vsep.$value;
                        $vsep = "|";
                    }
                    $selbits[2] = $vstring;
                    // XPTXT($keystring.' = '.$vstring);
                } else {
                    $selbits[2] = $_REQUEST["PF".$ori.$fi."_".$selbits[0]];
                }
            }
            array_push($seltestouta, $selbits[0].ShowFormat($selbits[3]).$selbits[1].$selbits[2]);
        }
        $thisreferencedselectionlogic = rebuildAND($seltestouta);
        array_push($seltestmultiouta, $thisreferencedselectionlogic);
        $ori++; $orsep = "|";
    }
    $thismultireferencedselectionlogic = rebuildOR($seltestmultiouta);
    // XPTXT($thismultireferencedselectionlogic);
}

$reporttype = "Report";
if ( $inreportexport == "export" ) { $reporttype = "Export"; }
XH2($reporttype." - ".$inreportexport_id." - ".$reporttitle);

Report_REPORTWEBVIEW_Output( $inreportexport, $inreportexport_id, $thismultiselectionlogic, $thismultireferencedselectionlogic);

Back_Navigator();
PageFooter("Default","Final");




