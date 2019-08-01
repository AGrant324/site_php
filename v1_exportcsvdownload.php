<<<<<<< HEAD
<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

$inreportexport = $_REQUEST['reportexport'];
$inreportexport_id = $_REQUEST['reportexport_id'];

Get_Data($inreportexport,$inreportexport_id);
$exporttitle = $GLOBALS{$inreportexport.'_title'};
$exportdescription = $GLOBALS{$inreportexport.'_description'};
$exportprimetablelist = $GLOBALS{$inreportexport.'_primetable'};
$exportreferencedtablelist = $GLOBALS{$inreportexport.'_referencedtablelist'};
$exportselectionlogic = $GLOBALS{$inreportexport.'_selectionlogic'};
$exportreferencedselectionlogic = $GLOBALS{$inreportexport.'_referencedselectionlogic'};
$exportsortlogic = $GLOBALS{$inreportexport.'_sortlogic'};
$exportfieldlist = Replace_CRandLF($GLOBALS{$inreportexport.'_fieldlist'},"|");
$exportuploadable = $GLOBALS{$inreportexport.'_uploadable'};

if (strlen(strstr($exportprimetablelist,','))>0) {
    $exportprimetablea = explode(",",$exportprimetablelist);
    $exportprimetable = $exportprimetablea[0];
    $exportprimetablepair = $exportprimetablea[1];
    $exportprimetablecsv = $exportprimetablea[0]."|".$exportprimetablea[1]; 
} else {
    $exportprimetable = $exportprimetablelist;
    $exportprimetablepair = "";
    $exportprimetablecsv = $exportprimetablelist;
}

$thisselectionlogic = "";
$thismultiselectionlogic = "";
$seltestmultiouta = Array();
$ori = 1;
$orsep = "";$orsep = "";
if ( $exportselectionlogic != "" ) {
    $multisellogica = explodeOR($exportselectionlogic);
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
if ( $exportreferencedselectionlogic != "" ) {
    $multisellogica = explodeOR($exportreferencedselectionlogic);
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


$downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/datadownload_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".csv";
$GLOBALS{'IOFDOWNLOAD'} = Open_File_Write ($downloadfilename);
if ($exportuploadable == "Yes") {
	Download_Instructions_Creator();
}

$exportfieldlist = str_replace('||', '|', $exportfieldlist);
if ( substr($exportfieldlist, -1) == '|' ) {
	substr_replace($string ,"",-1);
}
// XPTXT("$".$exportfieldlist.'$');
$fieldsa = explode('|',$exportfieldlist);

// =======  Generate Report Array ===============
$ra = GenerateReportArray($exportprimetablelist,$exportreferencedtablelist,$thismultiselectionlogic,$thismultireferencedselectionlogic,$exportsortlogic,$exportfieldlist);
// $exportprimetablelist, $referencedtablelist, $selectionlogic, $referencedselectionlogic, $sortlogic, $fieldlist
 
// print_r($ra["rdata"]);

// =======  Format the Report ===============

if ($exportuploadable == "Yes") {
	$outputrowarray = Array();
	array_push($outputrowarray, "datakeys","Table");
	for ( $idt = 3; $idt < $GLOBALS{$exportprimetable."^KEYS"}+2; $idt++) {
		array_push($outputrowarray, "Key");
	}
	foreach ($fieldsa as $tfield) {
		if ( DF($tfield,"Type") == "field" ) {
			$fbits = explode("_",$tfield);
			if ( ($fbits[0] == $exportprimetable)||($fbits[0] == $exportprimetablepair) ) { array_push($outputrowarray,DF($tfield,"Title")); }
			else { 
				if (AssocArrayCount($ra["rtable"]) > 1 ) { array_push($outputrowarray, ""); } // Headings inclused later
				else { array_push($outputrowarray,DF($tfield,"Title")); }
			} 
		}
		if ( DF($tfield,"Type") == "programlink" ) { array_push($outputrowarray, ""); }
	}
	
	fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
	
	$outputrowarray = Array();
	array_push($outputrowarray, "dataheader",$exportprimetablecsv);	
	
	$tstring = $GLOBALS{$exportprimetable."^FIELDS"}; $tfields = explode('|', $tstring);	
	for ( $ki = 1; $ki < $GLOBALS{$exportprimetable."^KEYS"}; $ki++) {
		array_push($outputrowarray, $tfields[$ki]);
	}
	foreach ($fieldsa as $tfield) {
		// XPTXT($tfield);
		if ( DF($tfield,"Type") == "field" ) {
			$fbits = explode("_",$tfield);
			if ( ($fbits[0] == $exportprimetable)||($fbits[0] == $exportprimetablepair) ) { array_push($outputrowarray,DF($tfield,"Field")); }
			else { array_push($outputrowarray, ""); } 
		}
		if ( DF($tfield,"Type") == "programlink" ) { array_push($outputrowarray, ""); }
	}
	fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);

} else {	
	$outputrowarray = Array();
	foreach ($fieldsa as $tfield) {
		if ( DF($tfield,"Type") == "field" ) {
			$fbits = explode("_",$tfield);
			if ( $fbits[0] == $exportprimetable ) { array_push($outputrowarray,DF($tfield,"Title")); }
			else { 
				if (AssocArrayCount($ra["rtable"]) > 1 ) { array_push($outputrowarray, ""); } // Headings inclused later
				else { array_push($outputrowarray,DF($tfield,"Title")); }
			} 
		}
		if ( DF($tfield,"Type") == "programlink" ) { array_push($outputrowarray, ""); }
	}
	fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
}

foreach ($ra["pdata"] as $primeid => $valuearray) {				
	// first data line relating to this primeid
	// XTRJQDT();
	
	$outputrowarray = Array();
	if ($exportuploadable == "Yes") {
		$ida = explode('|',$primeid);
		if ($GLOBALS{$exportprimetable."^KEYS"} == "2") { Get_Data($exportprimetable,$ida[0]); }		
		if ($GLOBALS{$exportprimetable."^KEYS"} == "3") { Get_Data($exportprimetable,$ida[0],$ida[1]); }
		if ($GLOBALS{$exportprimetable."^KEYS"} == "4") { Get_Data($exportprimetable,$ida[0],$ida[1],$ida[2]); }	
		array_push($outputrowarray, "data", $exportprimetablecsv);
		$tstring = $GLOBALS{$exportprimetable."^FIELDS"}; $tfields = explode('|', $tstring);
		for ( $ki = 1; $ki < $GLOBALS{$exportprimetable."^KEYS"}; $ki++) {
		    array_push($outputrowarray, utf8_decode(CleanField($GLOBALS{$tfields[$ki]})));	
		}
	}
	foreach ($ra["pdata"][$primeid] as $field) { 
		// XTDTXT($field); 
	    array_push($outputrowarray,utf8_decode(CleanField($field)));	
	}
	$reflineusedalready = "0";
	if (AssocArrayCount($ra["rtable"]) == 1 ) { // show first referenced data on prime data line
		$reftable = AssocArrayFirstValue($ra["rtable"]); // only one				
		// XPTXT(AssocArrayCount($ra["rtable"])." | ".$reftable." | ".$primeid." | ".AssocArrayCount($ra["rdata"][$reftable][$primeid]));				
		if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
			$firstreferencedid = AssocArrayFirstKey($ra["rdata"][$reftable][$primeid]);
			if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) { // may not be selected	
				foreach ($ra["rdata"][$reftable][$primeid][$firstreferencedid] as $field) {
					// XTDTXT($field);
				    array_push($outputrowarray,utf8_decode(CleanField($field)));
				}
				$reflineusedalready = "1";
			}									
		} else {
			for( $i = 0; $i<$maxrefheadingcount; $i++ ) { 
				// XTDTXT(""); 
				array_push($outputrowarray,"");
			}	
		}
	} else { // show data on separate lines
		for( $i = 0; $i<$maxrefheadingcount; $i++ ) { 
			// XTDTXT("");
			array_push($outputrowarray,"");
		}	
	}
	foreach ($ra["programdata"][$primeid] as $field) { 
		// XTDTXT($field);
		array_push($outputrowarray,"");
	}	
	// X_TR();
	fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
	
	// subsequent data lines relating to this prime id 
	foreach ($ra["rtable"] as $reftable) {
		if (AssocArrayCount($ra["rtable"]) > 1 ) {
			// show heading row before each referenced table section provided there is data
			if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
				// XTRJQDT();
				$outputrowarray = Array();
				if ($exportuploadable == "Yes") {
					$ida = explode('|',$primeid);
					if ($GLOBALS{$exportprimetable."^KEYS"} == "2") { Get_Data($exportprimetable,$ida[0]); }		
					if ($GLOBALS{$exportprimetable."^KEYS"} == "3") { Get_Data($exportprimetable,$ida[0],$ida[1]); }
					if ($GLOBALS{$exportprimetable."^KEYS"} == "4") { Get_Data($exportprimetable,$ida[0],$ida[1],$ida[2]); }	
					array_push($outputrowarray, "", "");
					$tstring = $GLOBALS{$exportprimetable."^FIELDS"}; $tfields = explode('|', $tstring);
					for ( $ki = 1; $ki < $GLOBALS{$exportprimetable."^KEYS"}; $ki++) {
					    array_push($outputrowarray, utf8_decode(CleanField($GLOBALS{$tfields[$ki]})));						
					}		
				} 
				foreach ($ra["pdata"][$primeid] as $field) { 
					// XTDTXTCOLOR($field,"#cccccc"); 
				    // if ($exportuploadable == "Yes") { array_push($outputrowarray,utf8_decode(CleanField($field))); }
					// else { array_push($outputrowarray,""); }
				    array_push($outputrowarray,utf8_decode(CleanField($field)));
				}
				if (AssocArrayCount($ra["rtable"]) > 1 ) { // create headings on separate lines		
					foreach ($ra["rheader"][$reftable] as $hfield) { 
						// XTDTXTCOLOR("<b>".$hfield."</b>","navy"); 
						array_push($outputrowarray,utf8_decode($hfield));
					}
					for( $i = AssocArrayCount($ra["rheader"][$reftable]); $i<$maxrefheadingcount; $i++ ) { 
						// XTDTXT(""); 
						array_push($outputrowarray,"");
					}		
				}
				for( $i = 0; $i<$maxprogramheadingcount; $i++ ) { 
					// XTDTXT(""); 
					array_push($outputrowarray,"");
				}
				// X_TR();
				fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
			}
		}
		if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
			foreach($ra["rdata"][$reftable][$primeid] as $referencedid => $v2a) {
				// show referenced table data row
				if ($reflineusedalready == "1") {
					$reflineusedalready = "0";
				} else {
					// XTRJQDT();
					$outputrowarray = Array();
					if ($exportuploadable == "Yes") {
						$ida = explode('|',$primeid);
						if ($GLOBALS{$exportprimetable."^KEYS"} == "2") { Get_Data($exportprimetable,$ida[0]); }		
						if ($GLOBALS{$exportprimetable."^KEYS"} == "3") { Get_Data($exportprimetable,$ida[0],$ida[1]); }
						if ($GLOBALS{$exportprimetable."^KEYS"} == "4") { Get_Data($exportprimetable,$ida[0],$ida[1],$ida[2]); }	
						array_push($outputrowarray, "", "");
						$tstring = $GLOBALS{$exportprimetable."^FIELDS"}; $tfields = explode('|', $tstring);
						for ( $ki = 1; $ki < $GLOBALS{$exportprimetable."^KEYS"}; $ki++) {
						    array_push($outputrowarray, utf8_decode(CleanField($GLOBALS{$tfields[$ki]})));	
						}
					}
					foreach ($ra["pdata"][$primeid] as $field) { 
						// XTDTXTCOLOR($field,"#cccccc");
					    // if ($exportuploadable == "Yes") { array_push($outputrowarray,utf8_decode(CleanField($field))); }
						// else { array_push($outputrowarray,""); }
						array_push($outputrowarray,utf8_decode(CleanField($field)));
					}
					$count = 0;
					foreach ($ra["rdata"][$reftable][$primeid][$referencedid] as $field) { 
						// XTDTXT($field); $count++;
					    array_push($outputrowarray,utf8_decode(CleanField($field)));
					}
					for( $i = AssocArrayCount($ra["rdata"][$reftable][$primeid][$referencedid]); $i<$maxrefheadingcount; $i++ ) { 
						// XTDTXT("");
						array_push($outputrowarray,"");
					}
					for( $i = 0; $i<$maxprogramheadingcount; $i++ ) { 
						// XTDTXT("");
						array_push($outputrowarray,"");
					}
					// X_TR();
					fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
				}
			}
		}		
	}
}

$outputrowarray = Array();
array_push($outputrowarray, "dataend", $exportprimetablecsv);
fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);

Close_File_Write ($GLOBALS{'IOFDOWNLOAD'});

Download_File ($downloadfilename,"delete");


function CleanField($field) {
    $field = str_replace("&pound;", "", $field);
    return $field;
}

=======
<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

$inreportexport = $_REQUEST['reportexport'];
$inreportexport_id = $_REQUEST['reportexport_id'];

Get_Data($inreportexport,$inreportexport_id);
$exporttitle = $GLOBALS{$inreportexport.'_title'};
$exportdescription = $GLOBALS{$inreportexport.'_description'};
$exportprimetablelist = $GLOBALS{$inreportexport.'_primetable'};
$exportreferencedtablelist = $GLOBALS{$inreportexport.'_referencedtablelist'};
$exportselectionlogic = $GLOBALS{$inreportexport.'_selectionlogic'};
$exportreferencedselectionlogic = $GLOBALS{$inreportexport.'_referencedselectionlogic'};
$exportsortlogic = $GLOBALS{$inreportexport.'_sortlogic'};
$exportfieldlist = Replace_CRandLF($GLOBALS{$inreportexport.'_fieldlist'},"|");
$exportuploadable = $GLOBALS{$inreportexport.'_uploadable'};

if (strlen(strstr($exportprimetablelist,','))>0) {
    $exportprimetablea = explode(",",$exportprimetablelist);
    $exportprimetable = $exportprimetablea[0];
    $exportprimetablepair = $exportprimetablea[1];
    $exportprimetablecsv = $exportprimetablea[0]."|".$exportprimetablea[1]; 
} else {
    $exportprimetable = $exportprimetablelist;
    $exportprimetablepair = "";
    $exportprimetablecsv = $exportprimetablelist;
}

$thisselectionlogic = "";
$thismultiselectionlogic = "";
$seltestmultiouta = Array();
$ori = 1;
$orsep = "";$orsep = "";
if ( $exportselectionlogic != "" ) {
    $multisellogica = explodeOR($exportselectionlogic);
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
if ( $exportreferencedselectionlogic != "" ) {
    $multisellogica = explodeOR($exportreferencedselectionlogic);
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


$downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/datadownload_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".csv";
$GLOBALS{'IOFDOWNLOAD'} = Open_File_Write ($downloadfilename);
if ($exportuploadable == "Yes") {
	Download_Instructions_Creator();
}

$exportfieldlist = str_replace('||', '|', $exportfieldlist);
if ( substr($exportfieldlist, -1) == '|' ) {
	substr_replace($string ,"",-1);
}
// XPTXT("$".$exportfieldlist.'$');
$fieldsa = explode('|',$exportfieldlist);

// =======  Generate Report Array ===============
$ra = GenerateReportArray($exportprimetablelist,$exportreferencedtablelist,$thismultiselectionlogic,$thismultireferencedselectionlogic,$exportsortlogic,$exportfieldlist);
// $exportprimetablelist, $referencedtablelist, $selectionlogic, $referencedselectionlogic, $sortlogic, $fieldlist
 
// print_r($ra["rdata"]);

// =======  Format the Report ===============

if ($exportuploadable == "Yes") {
	$outputrowarray = Array();
	array_push($outputrowarray, "datakeys","Table");
	for ( $idt = 3; $idt < $GLOBALS{$exportprimetable."^KEYS"}+2; $idt++) {
		array_push($outputrowarray, "Key");
	}
	foreach ($fieldsa as $tfield) {
		if ( DF($tfield,"Type") == "field" ) {
			$fbits = explode("_",$tfield);
			if ( ($fbits[0] == $exportprimetable)||($fbits[0] == $exportprimetablepair) ) { array_push($outputrowarray,DF($tfield,"Title")); }
			else { 
				if (AssocArrayCount($ra["rtable"]) > 1 ) { array_push($outputrowarray, ""); } // Headings inclused later
				else { array_push($outputrowarray,DF($tfield,"Title")); }
			} 
		}
		if ( DF($tfield,"Type") == "programlink" ) { array_push($outputrowarray, ""); }
	}
	
	fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
	
	$outputrowarray = Array();
	array_push($outputrowarray, "dataheader",$exportprimetablecsv);	
	
	$tstring = $GLOBALS{$exportprimetable."^FIELDS"}; $tfields = explode('|', $tstring);	
	for ( $ki = 1; $ki < $GLOBALS{$exportprimetable."^KEYS"}; $ki++) {
		array_push($outputrowarray, $tfields[$ki]);
	}
	foreach ($fieldsa as $tfield) {
		// XPTXT($tfield);
		if ( DF($tfield,"Type") == "field" ) {
			$fbits = explode("_",$tfield);
			if ( ($fbits[0] == $exportprimetable)||($fbits[0] == $exportprimetablepair) ) { array_push($outputrowarray,DF($tfield,"Field")); }
			else { array_push($outputrowarray, ""); } 
		}
		if ( DF($tfield,"Type") == "programlink" ) { array_push($outputrowarray, ""); }
	}
	fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);

} else {	
	$outputrowarray = Array();
	foreach ($fieldsa as $tfield) {
		if ( DF($tfield,"Type") == "field" ) {
			$fbits = explode("_",$tfield);
			if ( $fbits[0] == $exportprimetable ) { array_push($outputrowarray,DF($tfield,"Title")); }
			else { 
				if (AssocArrayCount($ra["rtable"]) > 1 ) { array_push($outputrowarray, ""); } // Headings inclused later
				else { array_push($outputrowarray,DF($tfield,"Title")); }
			} 
		}
		if ( DF($tfield,"Type") == "programlink" ) { array_push($outputrowarray, ""); }
	}
	fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
}

foreach ($ra["pdata"] as $primeid => $valuearray) {				
	// first data line relating to this primeid
	// XTRJQDT();
	
	$outputrowarray = Array();
	if ($exportuploadable == "Yes") {
		$ida = explode('|',$primeid);
		if ($GLOBALS{$exportprimetable."^KEYS"} == "2") { Get_Data($exportprimetable,$ida[0]); }		
		if ($GLOBALS{$exportprimetable."^KEYS"} == "3") { Get_Data($exportprimetable,$ida[0],$ida[1]); }
		if ($GLOBALS{$exportprimetable."^KEYS"} == "4") { Get_Data($exportprimetable,$ida[0],$ida[1],$ida[2]); }	
		array_push($outputrowarray, "data", $exportprimetablecsv);
		$tstring = $GLOBALS{$exportprimetable."^FIELDS"}; $tfields = explode('|', $tstring);
		for ( $ki = 1; $ki < $GLOBALS{$exportprimetable."^KEYS"}; $ki++) {
		    array_push($outputrowarray, utf8_decode(CleanField($GLOBALS{$tfields[$ki]})));	
		}
	}
	foreach ($ra["pdata"][$primeid] as $field) { 
		// XTDTXT($field); 
	    array_push($outputrowarray,utf8_decode(CleanField($field)));	
	}
	$reflineusedalready = "0";
	if (AssocArrayCount($ra["rtable"]) == 1 ) { // show first referenced data on prime data line
		$reftable = AssocArrayFirstValue($ra["rtable"]); // only one				
		// XPTXT(AssocArrayCount($ra["rtable"])." | ".$reftable." | ".$primeid." | ".AssocArrayCount($ra["rdata"][$reftable][$primeid]));				
		if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
			$firstreferencedid = AssocArrayFirstKey($ra["rdata"][$reftable][$primeid]);
			if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) { // may not be selected	
				foreach ($ra["rdata"][$reftable][$primeid][$firstreferencedid] as $field) {
					// XTDTXT($field);
				    array_push($outputrowarray,utf8_decode(CleanField($field)));
				}
				$reflineusedalready = "1";
			}									
		} else {
			for( $i = 0; $i<$maxrefheadingcount; $i++ ) { 
				// XTDTXT(""); 
				array_push($outputrowarray,"");
			}	
		}
	} else { // show data on separate lines
		for( $i = 0; $i<$maxrefheadingcount; $i++ ) { 
			// XTDTXT("");
			array_push($outputrowarray,"");
		}	
	}
	foreach ($ra["programdata"][$primeid] as $field) { 
		// XTDTXT($field);
		array_push($outputrowarray,"");
	}	
	// X_TR();
	fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
	
	// subsequent data lines relating to this prime id 
	foreach ($ra["rtable"] as $reftable) {
		if (AssocArrayCount($ra["rtable"]) > 1 ) {
			// show heading row before each referenced table section provided there is data
			if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
				// XTRJQDT();
				$outputrowarray = Array();
				if ($exportuploadable == "Yes") {
					$ida = explode('|',$primeid);
					if ($GLOBALS{$exportprimetable."^KEYS"} == "2") { Get_Data($exportprimetable,$ida[0]); }		
					if ($GLOBALS{$exportprimetable."^KEYS"} == "3") { Get_Data($exportprimetable,$ida[0],$ida[1]); }
					if ($GLOBALS{$exportprimetable."^KEYS"} == "4") { Get_Data($exportprimetable,$ida[0],$ida[1],$ida[2]); }	
					array_push($outputrowarray, "", "");
					$tstring = $GLOBALS{$exportprimetable."^FIELDS"}; $tfields = explode('|', $tstring);
					for ( $ki = 1; $ki < $GLOBALS{$exportprimetable."^KEYS"}; $ki++) {
					    array_push($outputrowarray, utf8_decode(CleanField($GLOBALS{$tfields[$ki]})));						
					}		
				} 
				foreach ($ra["pdata"][$primeid] as $field) { 
					// XTDTXTCOLOR($field,"#cccccc"); 
				    // if ($exportuploadable == "Yes") { array_push($outputrowarray,utf8_decode(CleanField($field))); }
					// else { array_push($outputrowarray,""); }
				    array_push($outputrowarray,utf8_decode(CleanField($field)));
				}
				if (AssocArrayCount($ra["rtable"]) > 1 ) { // create headings on separate lines		
					foreach ($ra["rheader"][$reftable] as $hfield) { 
						// XTDTXTCOLOR("<b>".$hfield."</b>","navy"); 
						array_push($outputrowarray,utf8_decode($hfield));
					}
					for( $i = AssocArrayCount($ra["rheader"][$reftable]); $i<$maxrefheadingcount; $i++ ) { 
						// XTDTXT(""); 
						array_push($outputrowarray,"");
					}		
				}
				for( $i = 0; $i<$maxprogramheadingcount; $i++ ) { 
					// XTDTXT(""); 
					array_push($outputrowarray,"");
				}
				// X_TR();
				fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
			}
		}
		if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
			foreach($ra["rdata"][$reftable][$primeid] as $referencedid => $v2a) {
				// show referenced table data row
				if ($reflineusedalready == "1") {
					$reflineusedalready = "0";
				} else {
					// XTRJQDT();
					$outputrowarray = Array();
					if ($exportuploadable == "Yes") {
						$ida = explode('|',$primeid);
						if ($GLOBALS{$exportprimetable."^KEYS"} == "2") { Get_Data($exportprimetable,$ida[0]); }		
						if ($GLOBALS{$exportprimetable."^KEYS"} == "3") { Get_Data($exportprimetable,$ida[0],$ida[1]); }
						if ($GLOBALS{$exportprimetable."^KEYS"} == "4") { Get_Data($exportprimetable,$ida[0],$ida[1],$ida[2]); }	
						array_push($outputrowarray, "", "");
						$tstring = $GLOBALS{$exportprimetable."^FIELDS"}; $tfields = explode('|', $tstring);
						for ( $ki = 1; $ki < $GLOBALS{$exportprimetable."^KEYS"}; $ki++) {
						    array_push($outputrowarray, utf8_decode(CleanField($GLOBALS{$tfields[$ki]})));	
						}
					}
					foreach ($ra["pdata"][$primeid] as $field) { 
						// XTDTXTCOLOR($field,"#cccccc");
					    // if ($exportuploadable == "Yes") { array_push($outputrowarray,utf8_decode(CleanField($field))); }
						// else { array_push($outputrowarray,""); }
						array_push($outputrowarray,utf8_decode(CleanField($field)));
					}
					$count = 0;
					foreach ($ra["rdata"][$reftable][$primeid][$referencedid] as $field) { 
						// XTDTXT($field); $count++;
					    array_push($outputrowarray,utf8_decode(CleanField($field)));
					}
					for( $i = AssocArrayCount($ra["rdata"][$reftable][$primeid][$referencedid]); $i<$maxrefheadingcount; $i++ ) { 
						// XTDTXT("");
						array_push($outputrowarray,"");
					}
					for( $i = 0; $i<$maxprogramheadingcount; $i++ ) { 
						// XTDTXT("");
						array_push($outputrowarray,"");
					}
					// X_TR();
					fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
				}
			}
		}		
	}
}

$outputrowarray = Array();
array_push($outputrowarray, "dataend", $exportprimetablecsv);
fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);

Close_File_Write ($GLOBALS{'IOFDOWNLOAD'});

Download_File ($downloadfilename,"delete");


function CleanField($field) {
    $field = str_replace("&pound;", "", $field);
    return $field;
}

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
