<<<<<<< HEAD
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();

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
$reportmaxselection = $GLOBALS{$inreportexport.'_maxselection'};
if ( $reportmaxselection == 0 ) { $reportmaxselection = 500; }
$reportmaxexecutiontime = $GLOBALS{$inreportexport.'_maxexecutiontime'};
if ( $reportmaxexecutiontime == 0 ) { $reportmaxexecutiontime = 30; }
ini_set('max_execution_time', $reportmaxexecutiontime);
$reportfieldlist = Replace_CRandLF($GLOBALS{$inreportexport.'_fieldlist'},"|");
$reportgraphtype = $GLOBALS{$inreportexport.'_graphtype'};
$reportgraphimage = $GLOBALS{$inreportexport.'_graphimage'};
$reportgraphhiderawdata = $GLOBALS{$inreportexport.'_graphhiderawdata'};

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

// =======  Generate Report Array ===============
$ra = GenerateReportArray($reportprimetable,$reportreferencedtablelist,$thismultiselectionlogic,$thismultireferencedselectionlogic,$reportsortlogic,$reportfieldlist);

// =======  Format Report ===============
if ( $inreportexport == "report" ) {
    if ($GLOBALS{'report_pagelayout'} == "" ) { $GLOBALS{'report_pagelayout'} = "A4"; }
    $pagelayout = $GLOBALS{'report_pagelayout'};
    if ( $GLOBALS{'report_pagelayout'} == "A4" ) { $pagewidth = "210mm"; $pageheight = "297mm";  }
    if ( $GLOBALS{'report_pagelayout'} == "A4-L" ) { $pagewidth = "297mm"; $pageheight = "210mm"; }
    if ( $GLOBALS{'report_pagelayout'} == "A3" ) { $pagewidth = "297mm"; $pageheight = "420mm";  }
    if ( $GLOBALS{'report_pagelayout'} == "A3-L" ) { $pagewidth = "420mm"; $pageheight = "297mm"; }    
    if ($GLOBALS{'report_fontsize'} == "" ) { $fontsize = "10"; } else { $fontsize = $GLOBALS{'report_fontsize'}; }
    if ($GLOBALS{'report_linesperpage'} == "" ) { $GLOBALS{'report_linesperpage'} = "20"; }
    $linesperpage = $GLOBALS{'report_linesperpage'};
} else {
    $pagelayout = "A4-L";
    $pagewidth = "297mm"; 
    $pageheight = "210mm";
    $fontsize = "10";
    $linesperpage = "20";
}

$stylestring = '<style>'."\n";
$stylestring = $stylestring.'* { margin: 0; padding: 0; font-family: Arial; font-size: '.$fontsize.'pt; color: black; }'."\n";
$stylestring = $stylestring.'body { width: 100%; font-family: Arial; font-size: '.$fontsize.'pt; color: black; margin: 0; padding: 0; }'."\n";
$stylestring = $stylestring.'p { margin: 0; padding: 0; }'."\n";
$stylestring = $stylestring.'.page { height: '.$pageheight.'; width: '.$pagewidth.'; }'."\n";
$stylestring = $stylestring.'table { width:100%; }'."\n";
$stylestring = $stylestring.'table td { padding: 1mm; }'."\n";
// $stylestring = $stylestring.'table.heading { height: 50mm; }'."\n";
$stylestring = $stylestring.'h1 { font-size: '.($fontsize+4).'pt; color: navy; font-weight: normal; }'."\n";
$stylestring = $stylestring.'hr { color: red; background: #ccc; }'."\n";
$stylestring = $stylestring.'</style>'."\n";

$reporthtml = $stylestring;
$pagecountmax = $linesperpage;
$reporthtml = $reporthtml.'<h1>'.$reporttitle.'</h1>';

if (( $reportgraphtype != "" )&&( $reportgraphimage != "" )) {
    $prefix = 'data:image/png;base64,';
    $str = $reportgraphimage;
    if (substr($str, 0, strlen($prefix)) == $prefix) {
        $str = substr($str, strlen($prefix));
    }
    $reporthtml = $reporthtml.'<img src="data:image/png;base64,' . $str . '" width="100%" />'."\n";
    $pagecount = 500; 
} else {
    $pagecount = 999; 
}

if ($reportgraphhiderawdata != "Yes") {
    // show raw data (as well as graph)

    // ===== Get maximum size of fields ============
    $fieldstrlena = Array();
    $fieldindex = 0;
    foreach ($ra["pfieldname"] as $field) { $fieldstrlena[$fieldindex] = 0; $fieldindex++; }
    foreach ($ra["rfieldname"] as $field) { $fieldstrlena[$fieldindex] = 0; $fieldindex++; }
    
    $fieldindex = 0;
    foreach ($ra["pdata"] as $primeid => $valuearray) {
    	foreach ($ra["pdata"][$primeid] as $field) {
    		if ( strlen( $field ) > $fieldstrlena[$fieldindex] ) {
    			$fieldstrlena[$fieldindex] = strlen( $field );
    		}
    		$fieldindex++;
    	}
    	foreach ($ra["rtable"] as $reftable) {
    		if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
    			foreach($ra["rdata"][$reftable][$primeid] as $referencedid => $v2a) {
    				foreach ($ra["rdata"][$reftable][$primeid][$referencedid] as $field) {
    					if ( strlen( $field ) > $fieldstrlena[$fieldindex] ) {
    						$fieldstrlena[$fieldindex] = strlen( $field );
    					}
    					$fieldindex++;
    				}
    			}
    		}
    	}
    }
    
    $fieldstrlenatot = 0;
    foreach ($fieldstrlena as $tfieldlength) {
    	$fieldstrlenatot = $fieldstrlenatot + $tfieldlength + 6;
    }
    
    // Step 2 Set the headers
    
    $headerhtml = YTR()."\n";
    $maxprimeheadingcount = 0;
    $fieldindex = 0;
    foreach ($ra["pheader"] as $hfield) { 
    	// XTDHTXT($hfield);
    	$fieldpercent = (($fieldstrlena{$fieldindex}+6)/$fieldstrlenatot)*100;
    	// XPTXT($fieldpercent);
    	// $headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR($hfield.number_format($fieldpercent,1).$fieldstrlenatot,number_format($fieldpercent,1)."%","Navy")."\n";
    	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR($hfield,"Navy")."\n";
    	// $reporthtml = $reporthtml.'<h3>'.$hfield.'</h3>';
    	$maxprimeheadingcount++;
    	$fieldindex++;
    }
    $maxrefheadingcount = 0;
    if ( AssocArrayCount($ra["rtable"]) == 1 ) { // show headings on prime heading line
    	foreach ($ra["rtable"] as $reftable) {  // Theres only 1 !!
    		foreach ($ra["rheader"][$reftable] as $hfield) { 
    			// XTDHTXT($hfield); 
    			$fieldpercent = (($fieldstrlena{$fieldindex}+6)/$fieldstrlenatot)*100;
    			// XPTXT($fieldpercent);
    			// $headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR($hfield.number_format($fieldpercent,1),number_format($fieldpercent,1)."%","Navy")."\n";
    			$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR($hfield,"Navy")."\n";			
    			$maxrefheadingcount++;
    			$fieldindex++;
    		}
    	}
    }
    if ( AssocArrayCount($ra["rtable"]) > 1 ) { // create headings on separate lines		
    	foreach ($ra["rtable"] as $reftable) {
    		$thiscount = AssocArrayCount($ra["rheader"][$reftable]);
    		if ($thiscount > $maxrefheadingcount) { $maxrefheadingcount = $thiscount; }   
    	}
    	for( $i = 0; $i<$maxrefheadingcount; $i++ ) { 
    		// XTDHTXT("");
    		$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("","Navy")."\n";
    	}		
    }
    $headerhtml = $headerhtml.Y_TR()."\n";
    
    
    $reporthtml = $reporthtml.'<table border="0">';
    $linecount = 0;
    
    foreach ($ra["pdata"] as $primeid => $valuearray) {				
    	// first data line relating to this primeid
    	// XTRJQDT();
        $linecount++;
        if ($linecount < $reportmaxselection) { // prevents report from being too big
            // ======= start a new row =====================
            $pagecount++;
            if ($pagecount >= $pagecountmax) {
                if ($pagecount != 1000) {
                    $reporthtml = $reporthtml.'</table>';
                    $reporthtml = $reporthtml."<pagebreak />";
                    $reporthtml = $reporthtml.'<h1>'.$reporttitle.'</h1>';
                    // $reporthtml = $reporthtml.YHR()."\n";
                    $reporthtml = $reporthtml.'<table border="0">';
                }
                $pagecount = 0;
                $reporthtml = $reporthtml.$headerhtml."\n";
                $colrow = true;
            }
            if ($colrow == true) {$rowcolor = "#f9f9f9"; $colrow = false;}
            else {$rowcolor = "white"; $colrow = true;}
            $reporthtml = $reporthtml.'<tr bgcolor="'.$rowcolor.'">';
            // =======================================
            
            foreach ($ra["pdata"][$primeid] as $field) {
                // XTDTXT($field);
                $reporthtml = $reporthtml.YTDTXT($field)."\n";
            }
            $reflineusedalready = "0";
            if (AssocArrayCount($ra["rtable"]) == 1 ) {
                // show first referenced data on prime data line
                $reftable = AssocArrayFirstValue($ra["rtable"]); // only one
                // XPTXT(AssocArrayCount($ra["rtable"])." | ".$reftable." | ".$primeid." | ".AssocArrayCount($ra["rdata"][$reftable][$primeid]));
                if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
                    $firstreferencedid = AssocArrayFirstKey($ra["rdata"][$reftable][$primeid]);
                    if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) { // may not be selected
                        foreach ($ra["rdata"][$reftable][$primeid][$firstreferencedid] as $field) {
                            // XTDTXT($field);
                            $reporthtml = $reporthtml.YTDTXT($field)."\n";
                        }
                        $reflineusedalready = "1";
                    }
                } else {
                    for( $i = 0; $i<$maxrefheadingcount; $i++ ) {
                        // XTDTXT("");
                        $reporthtml = $reporthtml.YTDTXT("")."\n";
                    }
                }
            } else { // show data on separate lines
                for( $i = 0; $i<$maxrefheadingcount; $i++ ) {
                    // XTDTXT("");
                    $reporthtml = $reporthtml.YTDTXT("")."\n";
                }
            }
            // X_TR();
            $reporthtml = $reporthtml.Y_TR()."\n";
            
            // subsequent data lines relating to this prime id
            foreach ($ra["rtable"] as $reftable) {
                
                if (AssocArrayCount($ra["rtable"]) > 1 ) {
                    // show heading row before each referenced table section provided there is data
                    if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
                        // XTRJQDT();
                        // ======= start a new row =====================
                        $pagecount++;
                        if ($pagecount >= $pagecountmax) {
                            if ($pagecount != 1000) {
                                $reporthtml = $reporthtml.'</table>';
                                $reporthtml = $reporthtml."<pagebreak />";
                                $reporthtml = $reporthtml.'<h1>'.$reporttitle.'</h1>';
                                // $reporthtml = $reporthtml.YHR()."\n";
                                $reporthtml = $reporthtml.'<table border="0">';
                            }
                            $pagecount = 0;
                            $reporthtml = $reporthtml.$headerhtml."\n";
                            $colrow = true;
                        }
                        if ($colrow == true) {$rowcolor = "#f9f9f9"; $colrow = false;}
                        else {$rowcolor = "white"; $colrow = true;}
                        $reporthtml = $reporthtml.'<tr bgcolor="'.$rowcolor.'">';
                        // =======================================
                        foreach ($ra["pdata"][$primeid] as $field) {
                            // XTDTXTCOLOR($field,"#cccccc");
                            $reporthtml = $reporthtml.YTDTXTCOLOR($field,"#cccccc")."\n";
                        }
                        if (AssocArrayCount($ra["rtable"]) > 1 ) {
                            // create headings on separate lines
                            foreach ($ra["rheader"][$reftable] as $hfield) {
                                // XTDTXTCOLOR("<b>".$hfield."</b>","navy");
                                $reporthtml = $reporthtml.YTDTXTCOLOR($hfield,"<b>".$hfield."</b>","navy")."\n";
                            }
                            for( $i = AssocArrayCount($ra["rheader"][$reftable]); $i<$maxrefheadingcount; $i++ ) {
                                // XTDTXT("");
                                $reporthtml = $reporthtml.YTDTXT("")."\n";
                            }
                        }
                        for( $i = 0; $i<$maxprogramheadingcount; $i++ ) {
                            // XTDTXT("");
                            $reporthtml = $reporthtml.YTDTXT("")."\n";
                        }
                        // X_TR();
                        $reporthtml = $reporthtml.Y_TR()."\n";
                    }
                }
                if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
                    foreach($ra["rdata"][$reftable][$primeid] as $referencedid => $v2a) {
                        // show referenced table data row
                        if ($reflineusedalready == "1") {
                            $reflineusedalready = "0";
                        } else {
                            // XTRJQDT();
                            // ======= start a new row =====================
                            $pagecount++;
                            if ($pagecount >= $pagecountmax) {
                                if ($pagecount != 1000) {
                                    $reporthtml = $reporthtml.'</table>';
                                    $reporthtml = $reporthtml."<pagebreak />";
                                    $reporthtml = $reporthtml.'<h1>'.$reporttitle.'</h1>';
                                    // $reporthtml = $reporthtml.YHR()."\n";
                                    $reporthtml = $reporthtml.'<table border="0">';
                                }
                                $pagecount = 0;
                                $reporthtml = $reporthtml.$headerhtml."\n";
                                $colrow = true;
                            }
                            if ($colrow == true) {$rowcolor = "#f9f9f9"; $colrow = false;}
                            else {$rowcolor = "white"; $colrow = true;}
                            $reporthtml = $reporthtml.'<tr bgcolor="'.$rowcolor.'">';
                            // =======================================
                            foreach ($ra["pdata"][$primeid] as $field) {
                                // XTDTXTCOLOR($field,"#cccccc");
                                $reporthtml = $reporthtml.YTDTXTCOLOR($field,"#cccccc")."\n";
                            }
                            $count = 0;
                            foreach ($ra["rdata"][$reftable][$primeid][$referencedid] as $field) {
                                // XTDTXT($field); $count++;
                                $reporthtml = $reporthtml.YTDTXT($field)."\n";
                            }
                            for( $i = AssocArrayCount($ra["rdata"][$reftable][$primeid][$referencedid]); $i<$maxrefheadingcount; $i++ ) {
                                // XTDTXT("");
                                $reporthtml = $reporthtml.YTDTXT("")."\n";
                            }
                            for( $i = 0; $i<$maxprogramheadingcount; $i++ ) {
                                // XTDTXT("");
                                $reporthtml = $reporthtml.YTDTXT("")."\n";
                            }
                            // X_TR();
                            $reporthtml = $reporthtml.Y_TR()."\n";
                        }
                    }
                }
            }
            foreach ($ra["programdata"][$primeid] as $field) {
                // XTDTXT($field);
                $reporthtml = $reporthtml.YTDTXT("")."\n";
            }
        }
    }
    
    if ($linecount < $reportmaxselection) {
        // ===== Totals ===============
        if (((AssocArrayFindCount($ra["ptotalreqd"],"Y") > 0 )||(AssocArrayFindCount($ra["rtotalreqd"],"Y") > 0 ))) { 
        	// XTRJQDT();
        	// ======= start a new row =====================
        	$pagecount++;
        	if ($pagecount >= $pagecountmax) {
        		if ($pagecount != 1000) {
        			$reporthtml = $reporthtml.'</table>';
        			$reporthtml = $reporthtml."<pagebreak />";
        			$reporthtml = $reporthtml.'<h1>'.$reporttitle.'</h1>';
        			// $reporthtml = $reporthtml.YHR()."\n";
        			$reporthtml = $reporthtml.'<table border="0">';
        		}
        		$pagecount = 0;
        		$reporthtml = $reporthtml.$headerhtml."\n";
        		$colrow = true;
        	}
        	if ($colrow == true) {
        		$rowcolor = "#f9f9f9"; $colrow = false;
        	}
        	else {$rowcolor = "white"; $colrow = true;
        	}
        	$reporthtml = $reporthtml.'<tr bgcolor="'.$rowcolor.'">';
        	// =======================================
        	
        	$ti = 0;
        	foreach ($ra["pfieldname"] as $tfieldname) {
        		if ( $ra["ptotalreqd"][$tfieldname] == "Y" ) { 
        			// XTDTXT($ra["ptotalformattedval"][$tfieldname]);
        			$reporthtml = $reporthtml.YTDTXT($ra["ptotalformattedval"][$tfieldname])."\n";			 
        		} 
        		else { 
        			if ($ti == 0) {
        				// XTDTXT("<b>Totals</b>");
        				$reporthtml = $reporthtml.YTDHTXTLEFTCOLOR("<b>Totals</b>","Green")."\n";
        			} else {
        				// XTDTXT("");
        				$reporthtml = $reporthtml.YTDTXT("")."\n";
        			}
        		}
        		$ti++;
        	}	
        	if (AssocArrayCount($ra["rtable"]) == 1 ) {
        		// show totals on single line
        		foreach ($ra["rtable"] as $reftable) {
        			// Theres only 1 !!
        			foreach ($ra["rfieldname"][$reftable] as $tfieldname) { 
        				if ( $ra["rtotalreqd"][$tfieldname] == "Y" ) { 
        					// XTDTXT($ra["rtotalformattedval"][$tfieldname]);
        					$reporthtml = $reporthtml.YTDTXT($ra["rtotalformattedval"][$tfieldname])."\n";
        				}				 
        				else {  
        					// XTDTXT("");
        					$reporthtml = $reporthtml.YTDTXT("")."\n";
        				}
        			}
        		}
        	}
        	
        	if (AssocArrayCount($ra["rtable"]) > 1 ) {
        		for( $i = 0; $i<$maxrefheadingcount; $i++ ) {
        			// XTDTXT(""); // CHECK - NOT CATERED FOR
        			$reporthtml = $reporthtml.YTDTXT("")."\n";
        		}
        	}
        	foreach ($ra["programheader"] as $hfield) { 
        		// XTDTXT("");
        		$reporthtml = $reporthtml.YTDTXT("")."\n";
        	}
        	//X_TR();
        	$reporthtml = $reporthtml.Y_TR()."\n";
        }
        $reporthtml = $reporthtml.Y_TABLE()."\n";
    } else {
        $reporthtml = $reporthtml.Y_TABLE()."\n";
        $reporthtml = $reporthtml.YH1("Report Truncated - Exceeded ".$reportmaxselection." entries.")."\n";
        
    }
}

// ========================================


if ( $GLOBALS{'report_pagemargins'} == "" ) { $GLOBALS{'report_pagemargins'} = "15,15,15,15"; }
$margina = explode(",",$GLOBALS{'report_pagemargins'});

$mpdf = new mPDF(
'',    // mode - default ''
$pagelayout,  // format - A4, for example, default ''
$fontsize,    // font size - default 0
'Helvetica',    // font family
$margina[0],    // margin_left
$margina[1],    // margin right
$margina[2],    // margin top
$margina[3],    // margin bottom
20,    // margin header
9);    // margin footer
// 'L');  // L - landscape, P - portrait

$reporthtml = mb_convert_encoding($reporthtml, 'UTF-8', 'UTF-8'); // trick to avoid issue with non UTF-8 characters
$mpdf->WriteHTML($reporthtml);
$mpdf->Output();


=======
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();

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
$reportmaxselection = $GLOBALS{$inreportexport.'_maxselection'};
if ( $reportmaxselection == 0 ) { $reportmaxselection = 500; }
$reportmaxexecutiontime = $GLOBALS{$inreportexport.'_maxexecutiontime'};
if ( $reportmaxexecutiontime == 0 ) { $reportmaxexecutiontime = 30; }
ini_set('max_execution_time', $reportmaxexecutiontime);
$reportfieldlist = Replace_CRandLF($GLOBALS{$inreportexport.'_fieldlist'},"|");
$reportgraphtype = $GLOBALS{$inreportexport.'_graphtype'};
$reportgraphimage = $GLOBALS{$inreportexport.'_graphimage'};
$reportgraphhiderawdata = $GLOBALS{$inreportexport.'_graphhiderawdata'};

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

// =======  Generate Report Array ===============
$ra = GenerateReportArray($reportprimetable,$reportreferencedtablelist,$thismultiselectionlogic,$thismultireferencedselectionlogic,$reportsortlogic,$reportfieldlist);

// =======  Format Report ===============
if ( $inreportexport == "report" ) {
    if ($GLOBALS{'report_pagelayout'} == "" ) { $GLOBALS{'report_pagelayout'} = "A4"; }
    $pagelayout = $GLOBALS{'report_pagelayout'};
    if ( $GLOBALS{'report_pagelayout'} == "A4" ) { $pagewidth = "210mm"; $pageheight = "297mm";  }
    if ( $GLOBALS{'report_pagelayout'} == "A4-L" ) { $pagewidth = "297mm"; $pageheight = "210mm"; }
    if ( $GLOBALS{'report_pagelayout'} == "A3" ) { $pagewidth = "297mm"; $pageheight = "420mm";  }
    if ( $GLOBALS{'report_pagelayout'} == "A3-L" ) { $pagewidth = "420mm"; $pageheight = "297mm"; }    
    if ($GLOBALS{'report_fontsize'} == "" ) { $fontsize = "10"; } else { $fontsize = $GLOBALS{'report_fontsize'}; }
    if ($GLOBALS{'report_linesperpage'} == "" ) { $GLOBALS{'report_linesperpage'} = "20"; }
    $linesperpage = $GLOBALS{'report_linesperpage'};
} else {
    $pagelayout = "A4-L";
    $pagewidth = "297mm"; 
    $pageheight = "210mm";
    $fontsize = "10";
    $linesperpage = "20";
}

$stylestring = '<style>'."\n";
$stylestring = $stylestring.'* { margin: 0; padding: 0; font-family: Arial; font-size: '.$fontsize.'pt; color: black; }'."\n";
$stylestring = $stylestring.'body { width: 100%; font-family: Arial; font-size: '.$fontsize.'pt; color: black; margin: 0; padding: 0; }'."\n";
$stylestring = $stylestring.'p { margin: 0; padding: 0; }'."\n";
$stylestring = $stylestring.'.page { height: '.$pageheight.'; width: '.$pagewidth.'; }'."\n";
$stylestring = $stylestring.'table { width:100%; }'."\n";
$stylestring = $stylestring.'table td { padding: 1mm; }'."\n";
// $stylestring = $stylestring.'table.heading { height: 50mm; }'."\n";
$stylestring = $stylestring.'h1 { font-size: '.($fontsize+4).'pt; color: navy; font-weight: normal; }'."\n";
$stylestring = $stylestring.'hr { color: red; background: #ccc; }'."\n";
$stylestring = $stylestring.'</style>'."\n";

$reporthtml = $stylestring;
$pagecountmax = $linesperpage;
$reporthtml = $reporthtml.'<h1>'.$reporttitle.'</h1>';

if (( $reportgraphtype != "" )&&( $reportgraphimage != "" )) {
    $prefix = 'data:image/png;base64,';
    $str = $reportgraphimage;
    if (substr($str, 0, strlen($prefix)) == $prefix) {
        $str = substr($str, strlen($prefix));
    }
    $reporthtml = $reporthtml.'<img src="data:image/png;base64,' . $str . '" width="100%" />'."\n";
    $pagecount = 500; 
} else {
    $pagecount = 999; 
}

if ($reportgraphhiderawdata != "Yes") {
    // show raw data (as well as graph)

    // ===== Get maximum size of fields ============
    $fieldstrlena = Array();
    $fieldindex = 0;
    foreach ($ra["pfieldname"] as $field) { $fieldstrlena[$fieldindex] = 0; $fieldindex++; }
    foreach ($ra["rfieldname"] as $field) { $fieldstrlena[$fieldindex] = 0; $fieldindex++; }
    
    $fieldindex = 0;
    foreach ($ra["pdata"] as $primeid => $valuearray) {
    	foreach ($ra["pdata"][$primeid] as $field) {
    		if ( strlen( $field ) > $fieldstrlena[$fieldindex] ) {
    			$fieldstrlena[$fieldindex] = strlen( $field );
    		}
    		$fieldindex++;
    	}
    	foreach ($ra["rtable"] as $reftable) {
    		if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
    			foreach($ra["rdata"][$reftable][$primeid] as $referencedid => $v2a) {
    				foreach ($ra["rdata"][$reftable][$primeid][$referencedid] as $field) {
    					if ( strlen( $field ) > $fieldstrlena[$fieldindex] ) {
    						$fieldstrlena[$fieldindex] = strlen( $field );
    					}
    					$fieldindex++;
    				}
    			}
    		}
    	}
    }
    
    $fieldstrlenatot = 0;
    foreach ($fieldstrlena as $tfieldlength) {
    	$fieldstrlenatot = $fieldstrlenatot + $tfieldlength + 6;
    }
    
    // Step 2 Set the headers
    
    $headerhtml = YTR()."\n";
    $maxprimeheadingcount = 0;
    $fieldindex = 0;
    foreach ($ra["pheader"] as $hfield) { 
    	// XTDHTXT($hfield);
    	$fieldpercent = (($fieldstrlena{$fieldindex}+6)/$fieldstrlenatot)*100;
    	// XPTXT($fieldpercent);
    	// $headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR($hfield.number_format($fieldpercent,1).$fieldstrlenatot,number_format($fieldpercent,1)."%","Navy")."\n";
    	$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR($hfield,"Navy")."\n";
    	// $reporthtml = $reporthtml.'<h3>'.$hfield.'</h3>';
    	$maxprimeheadingcount++;
    	$fieldindex++;
    }
    $maxrefheadingcount = 0;
    if ( AssocArrayCount($ra["rtable"]) == 1 ) { // show headings on prime heading line
    	foreach ($ra["rtable"] as $reftable) {  // Theres only 1 !!
    		foreach ($ra["rheader"][$reftable] as $hfield) { 
    			// XTDHTXT($hfield); 
    			$fieldpercent = (($fieldstrlena{$fieldindex}+6)/$fieldstrlenatot)*100;
    			// XPTXT($fieldpercent);
    			// $headerhtml = $headerhtml.YTDHTXTFIXEDLEFTCOLOR($hfield.number_format($fieldpercent,1),number_format($fieldpercent,1)."%","Navy")."\n";
    			$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR($hfield,"Navy")."\n";			
    			$maxrefheadingcount++;
    			$fieldindex++;
    		}
    	}
    }
    if ( AssocArrayCount($ra["rtable"]) > 1 ) { // create headings on separate lines		
    	foreach ($ra["rtable"] as $reftable) {
    		$thiscount = AssocArrayCount($ra["rheader"][$reftable]);
    		if ($thiscount > $maxrefheadingcount) { $maxrefheadingcount = $thiscount; }   
    	}
    	for( $i = 0; $i<$maxrefheadingcount; $i++ ) { 
    		// XTDHTXT("");
    		$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR("","Navy")."\n";
    	}		
    }
    $headerhtml = $headerhtml.Y_TR()."\n";
    
    
    $reporthtml = $reporthtml.'<table border="0">';
    $linecount = 0;
    
    foreach ($ra["pdata"] as $primeid => $valuearray) {				
    	// first data line relating to this primeid
    	// XTRJQDT();
        $linecount++;
        if ($linecount < $reportmaxselection) { // prevents report from being too big
            // ======= start a new row =====================
            $pagecount++;
            if ($pagecount > $pagecountmax) {
                if ($pagecount != 1000) {
                    $reporthtml = $reporthtml.'</table>';
                    $reporthtml = $reporthtml."<pagebreak />";
                    $reporthtml = $reporthtml.'<h1>'.$reporttitle.'</h1>';
                    // $reporthtml = $reporthtml.YHR()."\n";
                    $reporthtml = $reporthtml.'<table border="0">';
                }
                $pagecount = 0;
                $reporthtml = $reporthtml.$headerhtml."\n";
                $colrow = true;
            }
            if ($colrow == true) {$rowcolor = "#f9f9f9"; $colrow = false;}
            else {$rowcolor = "white"; $colrow = true;}
            $reporthtml = $reporthtml.'<tr bgcolor="'.$rowcolor.'">';
            // =======================================
            
            foreach ($ra["pdata"][$primeid] as $field) {
                // XTDTXT($field);
                $reporthtml = $reporthtml.YTDTXT($field)."\n";
            }
            $reflineusedalready = "0";
            if (AssocArrayCount($ra["rtable"]) == 1 ) {
                // show first referenced data on prime data line
                $reftable = AssocArrayFirstValue($ra["rtable"]); // only one
                // XPTXT(AssocArrayCount($ra["rtable"])." | ".$reftable." | ".$primeid." | ".AssocArrayCount($ra["rdata"][$reftable][$primeid]));
                if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
                    $firstreferencedid = AssocArrayFirstKey($ra["rdata"][$reftable][$primeid]);
                    if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) { // may not be selected
                        foreach ($ra["rdata"][$reftable][$primeid][$firstreferencedid] as $field) {
                            // XTDTXT($field);
                            $reporthtml = $reporthtml.YTDTXT($field)."\n";
                        }
                        $reflineusedalready = "1";
                    }
                } else {
                    for( $i = 0; $i<$maxrefheadingcount; $i++ ) {
                        // XTDTXT("");
                        $reporthtml = $reporthtml.YTDTXT("")."\n";
                    }
                }
            } else { // show data on separate lines
                for( $i = 0; $i<$maxrefheadingcount; $i++ ) {
                    // XTDTXT("");
                    $reporthtml = $reporthtml.YTDTXT("")."\n";
                }
            }
            // X_TR();
            $reporthtml = $reporthtml.Y_TR()."\n";
            
            // subsequent data lines relating to this prime id
            foreach ($ra["rtable"] as $reftable) {
                
                if (AssocArrayCount($ra["rtable"]) > 1 ) {
                    // show heading row before each referenced table section provided there is data
                    if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
                        // XTRJQDT();
                        // ======= start a new row =====================
                        $pagecount++;
                        if ($pagecount > $pagecountmax) {
                            if ($pagecount != 1000) {
                                $reporthtml = $reporthtml.'</table>';
                                $reporthtml = $reporthtml."<pagebreak />";
                                $reporthtml = $reporthtml.'<h1>'.$reporttitle.'</h1>';
                                // $reporthtml = $reporthtml.YHR()."\n";
                                $reporthtml = $reporthtml.'<table border="0">';
                            }
                            $pagecount = 0;
                            $reporthtml = $reporthtml.$headerhtml."\n";
                            $colrow = true;
                        }
                        if ($colrow == true) {$rowcolor = "#f9f9f9"; $colrow = false;}
                        else {$rowcolor = "white"; $colrow = true;}
                        $reporthtml = $reporthtml.'<tr bgcolor="'.$rowcolor.'">';
                        // =======================================
                        foreach ($ra["pdata"][$primeid] as $field) {
                            // XTDTXTCOLOR($field,"#cccccc");
                            $reporthtml = $reporthtml.YTDTXTCOLOR($field,"#cccccc")."\n";
                        }
                        if (AssocArrayCount($ra["rtable"]) > 1 ) {
                            // create headings on separate lines
                            foreach ($ra["rheader"][$reftable] as $hfield) {
                                // XTDTXTCOLOR("<b>".$hfield."</b>","navy");
                                $reporthtml = $reporthtml.YTDTXTCOLOR($hfield,"<b>".$hfield."</b>","navy")."\n";
                            }
                            for( $i = AssocArrayCount($ra["rheader"][$reftable]); $i<$maxrefheadingcount; $i++ ) {
                                // XTDTXT("");
                                $reporthtml = $reporthtml.YTDTXT("")."\n";
                            }
                        }
                        for( $i = 0; $i<$maxprogramheadingcount; $i++ ) {
                            // XTDTXT("");
                            $reporthtml = $reporthtml.YTDTXT("")."\n";
                        }
                        // X_TR();
                        $reporthtml = $reporthtml.Y_TR()."\n";
                    }
                }
                if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
                    foreach($ra["rdata"][$reftable][$primeid] as $referencedid => $v2a) {
                        // show referenced table data row
                        if ($reflineusedalready == "1") {
                            $reflineusedalready = "0";
                        } else {
                            // XTRJQDT();
                            // ======= start a new row =====================
                            $pagecount++;
                            if ($pagecount > $pagecountmax) {
                                if ($pagecount != 1000) {
                                    $reporthtml = $reporthtml.'</table>';
                                    $reporthtml = $reporthtml."<pagebreak />";
                                    $reporthtml = $reporthtml.'<h1>'.$reporttitle.'</h1>';
                                    // $reporthtml = $reporthtml.YHR()."\n";
                                    $reporthtml = $reporthtml.'<table border="0">';
                                }
                                $pagecount = 0;
                                $reporthtml = $reporthtml.$headerhtml."\n";
                                $colrow = true;
                            }
                            if ($colrow == true) {$rowcolor = "#f9f9f9"; $colrow = false;}
                            else {$rowcolor = "white"; $colrow = true;}
                            $reporthtml = $reporthtml.'<tr bgcolor="'.$rowcolor.'">';
                            // =======================================
                            foreach ($ra["pdata"][$primeid] as $field) {
                                // XTDTXTCOLOR($field,"#cccccc");
                                $reporthtml = $reporthtml.YTDTXTCOLOR($field,"#cccccc")."\n";
                            }
                            $count = 0;
                            foreach ($ra["rdata"][$reftable][$primeid][$referencedid] as $field) {
                                // XTDTXT($field); $count++;
                                $reporthtml = $reporthtml.YTDTXT($field)."\n";
                            }
                            for( $i = AssocArrayCount($ra["rdata"][$reftable][$primeid][$referencedid]); $i<$maxrefheadingcount; $i++ ) {
                                // XTDTXT("");
                                $reporthtml = $reporthtml.YTDTXT("")."\n";
                            }
                            for( $i = 0; $i<$maxprogramheadingcount; $i++ ) {
                                // XTDTXT("");
                                $reporthtml = $reporthtml.YTDTXT("")."\n";
                            }
                            // X_TR();
                            $reporthtml = $reporthtml.Y_TR()."\n";
                        }
                    }
                }
            }
            foreach ($ra["programdata"][$primeid] as $field) {
                // XTDTXT($field);
                $reporthtml = $reporthtml.YTDTXT("")."\n";
            }
        }
    }
    
    if ($linecount < $reportmaxselection) {
        // ===== Totals ===============
        if (((AssocArrayFindCount($ra["ptotalreqd"],"Y") > 0 )||(AssocArrayFindCount($ra["rtotalreqd"],"Y") > 0 ))) { 
        	// XTRJQDT();
        	// ======= start a new row =====================
        	$pagecount++;
        	if ($pagecount > $pagecountmax) {
        		if ($pagecount != 1000) {
        			$reporthtml = $reporthtml.'</table>';
        			$reporthtml = $reporthtml."<pagebreak />";
        			$reporthtml = $reporthtml.'<h1>'.$reporttitle.'</h1>';
        			// $reporthtml = $reporthtml.YHR()."\n";
        			$reporthtml = $reporthtml.'<table border="0">';
        		}
        		$pagecount = 0;
        		$reporthtml = $reporthtml.$headerhtml."\n";
        		$colrow = true;
        	}
        	if ($colrow == true) {
        		$rowcolor = "#f9f9f9"; $colrow = false;
        	}
        	else {$rowcolor = "white"; $colrow = true;
        	}
        	$reporthtml = $reporthtml.'<tr bgcolor="'.$rowcolor.'">';
        	// =======================================
        	
        	$ti = 0;
        	foreach ($ra["pfieldname"] as $tfieldname) {
        		if ( $ra["ptotalreqd"][$tfieldname] == "Y" ) { 
        			// XTDTXT($ra["ptotalformattedval"][$tfieldname]);
        			$reporthtml = $reporthtml.YTDTXT($ra["ptotalformattedval"][$tfieldname])."\n";			 
        		} 
        		else { 
        			if ($ti == 0) {
        				// XTDTXT("<b>Totals</b>");
        				$reporthtml = $reporthtml.YTDHTXTLEFTCOLOR("<b>Totals</b>","Green")."\n";
        			} else {
        				// XTDTXT("");
        				$reporthtml = $reporthtml.YTDTXT("")."\n";
        			}
        		}
        		$ti++;
        	}	
        	if (AssocArrayCount($ra["rtable"]) == 1 ) {
        		// show totals on single line
        		foreach ($ra["rtable"] as $reftable) {
        			// Theres only 1 !!
        			foreach ($ra["rfieldname"][$reftable] as $tfieldname) { 
        				if ( $ra["rtotalreqd"][$tfieldname] == "Y" ) { 
        					// XTDTXT($ra["rtotalformattedval"][$tfieldname]);
        					$reporthtml = $reporthtml.YTDTXT($ra["rtotalformattedval"][$tfieldname])."\n";
        				}				 
        				else {  
        					// XTDTXT("");
        					$reporthtml = $reporthtml.YTDTXT("")."\n";
        				}
        			}
        		}
        	}
        	
        	if (AssocArrayCount($ra["rtable"]) > 1 ) {
        		for( $i = 0; $i<$maxrefheadingcount; $i++ ) {
        			// XTDTXT(""); // CHECK - NOT CATERED FOR
        			$reporthtml = $reporthtml.YTDTXT("")."\n";
        		}
        	}
        	foreach ($ra["programheader"] as $hfield) { 
        		// XTDTXT("");
        		$reporthtml = $reporthtml.YTDTXT("")."\n";
        	}
        	//X_TR();
        	$reporthtml = $reporthtml.Y_TR()."\n";
        }
        $reporthtml = $reporthtml.Y_TABLE()."\n";
    } else {
        $reporthtml = $reporthtml.Y_TABLE()."\n";
        $reporthtml = $reporthtml.YH1("Report Truncated - Exceeded ".$reportmaxselection." entries.")."\n";
        
    }
}

// ========================================


if ( $GLOBALS{'report_pagemargins'} == "" ) { $GLOBALS{'report_pagemargins'} = "15,15,15,15"; }
$margina = explode(",",$GLOBALS{'report_pagemargins'});

$mpdf = new mPDF(
'',    // mode - default ''
$pagelayout,  // format - A4, for example, default ''
$fontsize,    // font size - default 0
'Helvetica',    // font family
$margina[0],    // margin_left
$margina[1],    // margin right
$margina[2],    // margin top
$margina[3],    // margin bottom
20,    // margin header
9);    // margin footer
// 'L');  // L - landscape, P - portrait

$reporthtml = mb_convert_encoding($reporthtml, 'UTF-8', 'UTF-8'); // trick to avoid issue with non UTF-8 characters
$mpdf->WriteHTML($reporthtml);
$mpdf->Output();


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>