<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$incorsite_id = $_REQUEST['corsite_id'];
$incorsite_version = $_REQUEST['corsite_version'];
$incorsite_corprogramme = $_REQUEST['corsite_corprogramme'];
$insubmitaction = $_REQUEST['SubmitAction'];
$incurrenttab = $_REQUEST['CurrentTab'];
$incorsite_lastupdatetimestamp = $_REQUEST['corsite_lastupdatetimestamp'];
$incorsite_lastupdatepersonid = $_REQUEST['corsite_lastupdatepersonid'];

// handles cases where survey info not output
$resiinputexpected = "0"; 
$comminputexpected = "0"; 
$outletcommsinputexpected = "0"; 
$surveyinputexpected = "0"; 
$sitecommsinputexpected = "0";

$errorfound = "0";

if (($insubmitaction == "SaveLock")||($insubmitaction == "SaveUnlock")) {
	Cor_CORSITEUPDATE_CSSJS();
	PageHeader("Default","Final");
	Check_Session_Validity();
	Back_Navigator();
}

if ($insubmitaction == "Close"){
	Get_Data('corsite',$incorsite_id,$incorsite_version);
	if ( $GLOBALS{'corsite_lockedpersonid'} == $GLOBALS{'LOGIN_person_id'} )  {
	    $GLOBALS{'corsite_lockedtimestamp'} = "";
    	$GLOBALS{'corsite_lockedpersonid'} = "";
    	// $GLOBALS{'corsite_massupdatelog'} = "";    	
    	Write_Data('corsite',$incorsite_id,$incorsite_version);
	}
}

if (($insubmitaction == "SaveLock")||($insubmitaction == "SaveUnlock")||($insubmitaction == "SaveClose")) {
    
    $newsite = "0";
    if ( $incorsite_id == "new" ) {
        $newsite = "1";
        $corsite_ida = Get_Array('corsite');
    	$highestcorsite_id = "SI00000";
    	foreach ($corsite_ida as $corsite_id) { 
    		if ( $corsite_id > $highestcorsite_id ) { $highestcorsite_id = $corsite_id; }
    	}
    	$highestcorsite_seq = str_replace("SI", "", $highestcorsite_id);
    	$highestcorsite_seq++;
    	$incorsite_id = "SI".substr(("00000".$highestcorsite_seq), -5);
    	$incorsite_version = "Live";
    	Initialise_Data('corsite');    	
    	$GLOBALS{"corsite_id"} = $incorsite_id;
    	$GLOBALS{"corsite_version"} = $incorsite_version;
    	$GLOBALS{"corsite_corprogramme"} = $incorsite_corprogramme;
    	$GLOBALS{'corsite_lastupdatetimestamp'} = $GLOBALS{'currenttimestamp'};
    	$GLOBALS{'corsite_lastupdatepersonid'} = $GLOBALS{'LOGIN_person_id'};
    	$GLOBALS{'corsite_lastupdatetype'} = "New Site";
    	XPTXTCOLOR("New ".$incorsite_corprogramme." site created - ".$incorsite_id." ".$incorsite_version,"green");
    	Write_Data('corsite',$incorsite_id,$incorsite_version);
    	
    } else {        
        Get_Data('corsite',$incorsite_id,$incorsite_version);        
    }
    
    if (($incorsite_lastupdatetimestamp == $GLOBALS{'corsite_lastupdatetimestamp'})||($GLOBALS{'corsite_lastupdatetype'} == "Upload")||($newsite == "1")) { 
    	$fieldtytpehash = FieldTypeHash();
    	$newcorresiidlista = Array();
    	$newcorcommidlista = Array();
    	$newcoroutletcommsidlista = Array();		
    	$newcorsurveyidlista = Array();
    	$newcorsitecommsa = Array();
    		
    	$corcomm_ida = Get_Array('corcomm');
    	$highestcorcomm_id = "CO00000";
    	foreach ($corcomm_ida as $corcomm_id) {
    		if ( $corcomm_id > $highestcorcomm_id ) {
    			$highestcorcomm_id = $corcomm_id;
    		}
    	}
    	$highestcorcomm_seq = str_replace("CO", "", $highestcorcomm_id);	
    	
    	$corresi_ida = Get_Array('corresi');
    	$highestcorresi_id = "RE00000";
    	foreach ($corresi_ida as $corresi_id) { 
    		if ( $corresi_id > $highestcorresi_id ) { $highestcorresi_id = $corresi_id; }
    	}
    	$highestcorresi_seq = str_replace("RE", "", $highestcorresi_id);
    	
    	$coroutletcomms_ida = Get_Array('coroutletcomms');
    	$highestcoroutletcomms_id = "OC00000";
    	foreach ($coroutletcomms_ida as $coroutletcomms_id) {
    		if ( $coroutletcomms_id > $highestcoroutletcomms_id ) {
    			$highestcoroutletcomms_id = $coroutletcomms_id;
    		}
    	}
    	$highestcoroutletcomms_seq = str_replace("OC", "", $highestcoroutletcomms_id);
    	
    	$corsurvey_ida = Get_Array('corsurvey');
    	$highestcorsurvey_id = "SU00000";
    	foreach ($corsurvey_ida as $corsurvey_id) { 
    		if ( $corsurvey_id > $highestcorsurvey_id ) {$highestcorsurvey_id = $corsurvey_id;} 
    	}
    	$highestcorsurvey_seq = str_replace("SU", "", $highestcorsurvey_id);
    	
    	$oldcorsitecommsa = Get_Array('corsitecomms',$incorsite_id);
    
    	$mua = Array();
    	if ($GLOBALS{'corsite_massupdatelog'} != "") {
    		// field1[oldval|newval]^field2[oldval|newval]
    		$mubits1 = explode("^",$GLOBALS{'corsite_massupdatelog'});	
    		foreach ( $mubits1 as $mubit ) {
    			$mubits2 = explode("[",$mubit);
    			$mua[$mubits2[0]] = $mubit;
    		}
    	}	
    	
    	foreach ( $_REQUEST as $keystring => $v ) {
    		$keybits = explode("_",$keystring);
    		// remove additional display characters
    		if (($keybits[0] == "corsite")||($keybits[0] == "corcomm")||($keybits[0] == "coroutletcomms")||($keybits[0] == "corresi")||($keybits[0] == "corsurvey")) {
    			$thisfield = $keybits[0].'_'.$keybits[1];
    			// XPTXT("============================ ".$keystring." ==> ".$v);
    			if (strlen(strstr($fieldtytpehash[$thisfield],"decimal"))>0) {
    				$v = str_replace(',', '', $v);
    				$v = str_replace('(', '', $v);				
    				$v = str_replace(')', '', $v);				
    			}
    			if (strlen(strstr($keystring,"percent"))>0) {
    				$v = str_replace('%', '', $v);
    				$v = str_replace('(', '', $v);
    				$v = str_replace(')', '', $v);				
    			}	
    			// XPTXT("============================ ".$keystring." ==> ".$v);	
    		}
    		
    		if ($keybits[0] == "CommDisplayed") { $comminputexpected = "1"; }
    		if ($keybits[0] == "ResiDisplayed") { $resiinputexpected = "1"; }
    		if ($keybits[0] == "SiteCommsDisplayed") { $outletcommsinputexpected = "1"; }
    		if ($keybits[0] == "SurveysDisplayed") { $surveyinputexpected = "1"; }
    		if ($keybits[0] == "SiteCommsDisplayed") { $sitecommsinputexpected = "1"; }

    		if ($keybits[0] == "corsite") {
    			$thisfield = $keybits[0].'_'.$keybits[1];	
    			$thistable = $keybits[0];
    			// XPTXT( $keystring." = ".$v  );
    			if (sizeOf($keybits) == 2) { # normal			
    				if (is_array($_REQUEST[$k])) { # array 
    					$vstring = ""; $vsep = "";
    					foreach ($_REQUEST[$k] as $value) {
    						# XPTXT($value);						
    						$vstring = $vstring.$vsep.$value;
    						$vsep = ",";
    					}
    				} else {
    					$vstring = $v;
    				}
    				$GLOBALS{$thisfield} = $vstring;
    				// XPTXT( $thisfield." = ".$vstring  );
    				if (array_key_exists($thisfield, $mua)) {
    					// field1[oldval|newval]^field2[oldval|newval]
    					$mufstring = $mua[$thisfield];		
    					$mubits2 = explode("[",$mufstring);
    					$mubits3 = explode("]",$mubits2[1]);					
    					$mubits4 = explode("|",$mubits3[0]);
    					$oldmuvalue = $mubits4[0];
    					$newmuvalue = $mubits4[1];
    					if ($GLOBALS{$thisfield} == $oldmuvalue) { // undoing massupdate
    					    if ( $GLOBALS{'corsite_lastupdatetype'} == "Upload") {
    					        XPTXTCOLOR("Warning: CSV Upload conflict - ".$thisfield." reset to ".$newmuvalue." from ".$GLOBALS{$thisfield},"red");    					        $GLOBALS{$thisfield} = $newmuvalue;
    					    }
    					    if ( $GLOBALS{'corsite_lastupdatetype'} == "MassUpdate") {
    					        XPTXTCOLOR("Warning: Mass Update conflict - ".$thisfield." reset to ".$newmuvalue." from ".$GLOBALS{$thisfield},"red");
    					    }
    					    $GLOBALS{$thisfield} = $newmuvalue;
    						// $errorfound = "1";
    					}
    				}
    			}
    			if (sizeOf($keybits) == 3) { # Multipart field
    				if ($keybits[2] == "imagename") {
    					$GLOBALS{$thisfield} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{$thisfield},$v);
    				}
    				if ($keybits[2] == "DDpart") {$ddpart = $v;} 
    				if ($keybits[2] == "MMpart") {$mmpart = $v;} 			
    				if ($keybits[2] == "YYYYpart") {$yyyypart = $v; $GLOBALS{$thisfield} = $yyyypart."-".$mmpart."-".$ddpart;}
    				if ($keybits[2] == "CODEpart") {$codepart = $v;} 
    				if ($keybits[2] == "NUMpart") {$numpart = $v; $GLOBALS{$thisfield} = $codepart." ".$numpart; }	
    				// XPTXT( $thisfield." = ".$v );
    			}
    		}
    		
    		if ($keybits[0] == "corcomm") {
    			if ($keybits[1] == "tenantname") {
    				if (strlen(strstr($keybits[2],"new"))>0) {
    					// new commercial record
    					Initialise_Data('corcomm');
    					$highestcorcomm_seq++;
    					$corcomm_id = "CO".substr(("00000".$highestcorcomm_seq), -5);
    					$newcorcommidlista[$corcomm_id] = $corcomm_id;
    					// XPTXT('Initialise_Data - corcomm '." = ".$corcomm_id);
    				} else { // existing commercial record
    					$corcomm_id = $keybits[2];
    					$newcorcommidlista[$corcomm_id] = $corcomm_id;
    					Check_Data('corcomm',$corcomm_id);
    					if ($GLOBALS{'IOWARNING'} == "0") {
    						// XPTXT('Get_Data - corcomm '." = ".$corcomm_id);
    					} else {
    						XPTXTCOLOR('Error 102 - '.$corcomm_id.' not found',"red");
    						$errorfound = "1";
    					}
    				}
    			}
    		
    			$fieldname = $keybits[0]."_".$keybits[1];
    			$GLOBALS{$fieldname} = $v;
    			// XPTXT( $corcomm_id."-".$fieldname." = ".$v );
    				
    			if ($keybits[1] == "surrendercostgdvcalc") {
    				$GLOBALS{'corcomm_corsiteid'} = $incorsite_id;
    				$GLOBALS{'corcomm_corsiteversion'} = $incorsite_version;
    				Write_Data('corcomm',$corcomm_id);
    				// XPTXT('Write_Data - corcomm '." = ".$corcomm_id);
    			}
    		}			
    		
    		if ($keybits[0] == "corresi") {
    			if ($keybits[1] == "class") {						
    				if (strlen(strstr($keybits[2],"new"))>0) { // new residence record				
    					Initialise_Data('corresi');
    					$highestcorresi_seq++;
    					$corresi_id = "RE".substr(("00000".$highestcorresi_seq), -5);
    					$newcorresiidlista[$corresi_id] = $corresi_id;
    					// XPTXT('Initialise_Data - corresi '." = ".$corresi_id);
    				} else { // existing residence record
    					$corresi_id = $keybits[2];
    					$newcorresiidlista[$corresi_id] = $corresi_id;
    					Check_Data('corresi',$corresi_id);			
    					if ($GLOBALS{'IOWARNING'} == "0") { 
    						// XPTXT('Get_Data - corresi '." = ".$corresi_id); 
    					} else { 
    						XPTXTCOLOR('Error 103 - '.$corresi_id.' not found',"red");
    						$errorfound = "1";
    					}					
    				}					
    			}
    	
    			$fieldname = $keybits[0]."_".$keybits[1];
    			$GLOBALS{$fieldname} = $v;
    			// XPTXT( $corresi_id."-".$fieldname." = ".$v );
    			
    			if ($keybits[1] == "postdiscountcalc") {
    				$GLOBALS{'corresi_corsiteid'} = $incorsite_id;
    				$GLOBALS{'corresi_corsiteversion'} = $incorsite_version;								
    				Write_Data('corresi',$corresi_id);
    				// XPTXT('Write_Data - corresi '." = ".$corresi_id);
    			}			     
    		}
    		
    		if ($keybits[0] == "coroutletcomms") {
    			if ($keybits[1] == "coroutletclassid") {
    				if (strlen(strstr($keybits[2],"new"))>0) {
    					// new outletcomms record
    					Initialise_Data('coroutletcomms');
    					$highestcoroutletcomms_seq++;
    					$coroutletcomms_id = "OC".substr(("00000".$highestcoroutletcomms_seq), -5);
    					$newcoroutletcommsidlista[$coroutletcomms_id] = $coroutletcomms_id;
    					// XPTXT('Initialise_Data - coroutletcomms '." = ".$coroutletcomms_id);
    				} else { // existing residence record
    					$coroutletcomms_id = $keybits[2];
    					$newcoroutletcommsidlista[$coroutletcomms_id] = $coroutletcomms_id;
    					Check_Data('coroutletcomms',$coroutletcomms_id);
    					if ($GLOBALS{'IOWARNING'} == "0") {
    						// XPTXT('Get_Data - corresi '." = ".$corresi_id);
    					} else {
    						XPTXTCOLOR('Error 104 - '.$coroutletcomms_id.' not found',"red");
    						$errorfound = "1";
    					}
    				}
    			}
    		
    			$fieldname = $keybits[0]."_".$keybits[1];
    			$GLOBALS{$fieldname} = $v;
    			// XPTXT( $corresi_id."-".$fieldname." = ".$v );
    				
    			if ($keybits[1] == "date") {
    				$GLOBALS{'coroutletcomms_corsiteid'} = $incorsite_id;
    				$GLOBALS{'coroutletcomms_corsiteversion'} = $incorsite_version;
    				Write_Data('coroutletcomms',$coroutletcomms_id);
    				// XPTXT('Write_Data - coroutletcomms '." = ".$coroutletcomms_id);
    			}
    		}		
    				
    		if ($keybits[0] == "corsurvey") {
    			if ($keybits[1] == "surveycategoryid") { // new survey category		
    				if (strlen(strstr($keybits[2],"new"))>0) { 	
    					$newsurveycategoryid = $v;
    					// XPTXT('New Survey Category '." = ".$newsurveycategoryid);
    				} else {
    					XPTXTCOLOR('Error 105 - '.$keybits[2].' survey category not required',"red");
    					$errorfound = "1";
    				}		
    			}		
    			if ($keybits[1] == "supplier") {						
    				if (strlen(strstr($keybits[2],"new"))>0) { // new survey record				
    					Initialise_Data('corsurvey');									
    					$GLOBALS{'corsurvey_corsurveycategoryid'} = $newsurveycategoryid;
    					$highestcorsurvey_seq++;
    					$corsurvey_id = "SU".substr(("00000".$highestcorsurvey_seq), -5);
    					$newcorsurveyidlista[$corsurvey_id] = $corsurvey_id;
    					// XPTXT('Initialise_Data - corsurvey '." = ".$corsurvey_id);
    				} else { // existing survey record
    					$corsurvey_id = $keybits[2];
    					if ( $corsurvey_id != "") {
    						$newcorsurveyidlista[$corsurvey_id] = $corsurvey_id;
    						Check_Data('corsurvey',$corsurvey_id);			
    						if ($GLOBALS{'IOWARNING'} == "0") { 
    							// XPTXT('Get_Data - corsurvey '." = ".$corsurvey_id); 
    						} else { 
    							XPTXTCOLOR('Error 106 - '.$corsurvey_id.' not found',"red");  
    							$errorfound = "1";
    						}
    					}					
    				}					
    			}
    	
    			$fieldname = $keybits[0]."_".$keybits[1];
    			$GLOBALS{$fieldname} = $v;
    			// XPTXT( $corsurvey_id."-".$fieldname." = ".$v );
    			
    			if ($keybits[1] == "costvsquotevarcalc") {
    				if ( $corsurvey_id != "") {	
    					$GLOBALS{'corsurvey_corsiteid'} = $incorsite_id;
    					$GLOBALS{'corsurvey_corsiteversion'} = $incorsite_version;									
    					Write_Data('corsurvey',$corsurvey_id);
    					// XPTXT('Write_Data - corsurvey '." = ".$corsurvey_id);
    				}
    			}			     
    		}
    
    		if ($keybits[0] == "corsitecomms") {
    			$corsitecomms_timestamp = $keybits[2];
    			if ($keybits[1] == "date") {				
    				Check_Data('corsitecomms', $incorsite_id, $corsitecomms_timestamp);
    				if ($GLOBALS{'IOWARNING'} == "0") {
    					// XPTXT('Get_Data - corsitecomms '." = ".$incorsite_id."/".$corsitecomms_timestamp);
    				} else { 
    					Initialise_Data('corsitecomms');
    				}				
    			}
    
    			$fieldname = $keybits[0]."_".$keybits[1];
    			$GLOBALS{$fieldname} = $v;
    			// XPTXT( $incorsite_id."/".$corsitecomms_timestamp."-".$fieldname." = ".$v );
    				
    			if ($keybits[1] == "message") {
    				$GLOBALS{'corsitecomms_corsiteid'} = $incorsite_id;
    				$GLOBALS{'corsitecomms_timestamp'} = $corsitecomms_timestamp;
    				$newcorsitecommsa[$corsitecomms_timestamp] = $corsitecomms_timestamp;
    				Write_Data('corsitecomms',$incorsite_id,$corsitecomms_timestamp);
    				// XPTXT('Write_Data - '.$incorsite_id."/".$corsitecomms_timestamp);
    			}				
    		}		
    	}

    	// ====== update commercial ====
    	if ( $comminputexpected == "1" ) {
        	if ( $GLOBALS{'corsite_dispcorcommidlist'} != "" ) {
        		$oldcorcommidlista = explode(",",$GLOBALS{'corsite_dispcorcommidlist'});
        		foreach ( $oldcorcommidlista as $oldcorcomm_id ) {
        			if (array_key_exists($oldcorcomm_id,$newcorcommidlista)) {
        			}
        			else {
        				Delete_Data('corcomm',$oldcorcomm_id);
        				// XPTXTCOLOR('Delete_Data - corcomm '." = ".$oldcorcomm_id,"red");
        			}
        		}
        	}
        	$GLOBALS{'corsite_dispcorcommidlist'} = Array2List($newcorcommidlista);	
        }
    	
    	// ====== update residences ====
        if ( $resiinputexpected == "1" ) {
        	if ( $GLOBALS{'corsite_dispcorresiidlist'} != "" ) {
        		$oldcorresiidlista = explode(",",$GLOBALS{'corsite_dispcorresiidlist'});
        		foreach ( $oldcorresiidlista as $oldcorresi_id ) {		
        			if (array_key_exists($oldcorresi_id,$newcorresiidlista)) { }
        			else {
        				Delete_Data('corresi',$oldcorresi_id);
        				// XPTXTCOLOR('Delete_Data - corresi '." = ".$oldcorresi_id,"red");
        			}
        		}		
            }
            $GLOBALS{'corsite_dispcorresiidlist'} = Array2List($newcorresiidlista);
    	}
    	
    	// ====== update outlet comms ====
    	if ( $outletcommsinputexpected == "1" ) {
        	if ( $GLOBALS{'corsite_proposalcoroutletcommsidlist'} != "" ) {
        		$oldcoroutletcommsidlista = explode(",",$GLOBALS{'corsite_proposalcoroutletcommsidlist'});
        		foreach ( $oldcoroutletcommsidlista as $oldcoroutletcomms_id ) {
        			if (array_key_exists($oldcoroutletcomms_id,$newcoroutletcommsidlista)) {
        			}
        			else {
        				Delete_Data('coroutletcomms',$oldcoroutletcomms_id);
        				// XPTXT('Delete_Data - coroutletcomms '." = ".$oldcoroutletcomms_id);
        			}
        		}
        	}
        	$GLOBALS{'corsite_proposalcoroutletcommsidlist'} = Array2List($newcoroutletcommsidlista);
        }
        
    	// ====== update surveys ====
    	if ( $surveyinputexpected == "1" ) {
        	if ( $GLOBALS{'corsite_plgsurveylist'} != "" ) {
        		$oldcorsurveyidlista = explode(",",$GLOBALS{'corsite_plgsurveylist'});
        		foreach ( $oldcorsurveyidlista as $oldcorsurvey_id ) {
        			if (array_key_exists($oldcorsurvey_id,$newcorsurveyidlista)) {}
        			else {
        				Delete_Data('corsurvey',$oldcorsurvey_id);
        				// XPTXTCOLOR('Delete_Data - corsurvey '." = ".$oldcorsurvey_id,"red");
        			}
        		}
        	}
        	$GLOBALS{'corsite_plgsurveylist'} = Array2List($newcorsurveyidlista);
    	}
    	
    	// ====== update comms ====
    	if ( $sitecommsinputexpected == "1" ) {
        	foreach ( $oldcorsitecommsa as $oldcorsitecomms_timestamp ) {
        		// XPTXT($oldcorsitecomms_timestamp);
        		if (array_key_exists($oldcorsitecomms_timestamp,$newcorsitecommsa)) {
        		}
        		else {
        			Delete_Data('corsitecomms',$incorsite_id,$oldcorsitecomms_timestamp);
        			// XPTXTCOLOR('Delete_Data - corcomms '." = ".$incorsite_id."/".$oldcorsitecomms_timestamp,"red");
        		}
        	}
    	}
    	
    	if (($insubmitaction == "SaveUnlock")||($insubmitaction == "SaveClose")) {
    	    $GLOBALS{'corsite_lockedtimestamp'} = "";
    	    $GLOBALS{'corsite_lockedpersonid'} = "";
    	} else {
    	    $GLOBALS{'corsite_lockedtimestamp'} = $GLOBALS{'currenttimestamp'};
    	    $GLOBALS{'corsite_lockedpersonid'} = $GLOBALS{'LOGIN_person_id'};
    	}  
    	$GLOBALS{'corsite_lastupdatetimestamp'} = $GLOBALS{'currenttimestamp'};
    	$GLOBALS{'corsite_lastupdatepersonid'} = $GLOBALS{'LOGIN_person_id'};
    	$GLOBALS{'corsite_lastupdatetype'} = "Update";
    	$GLOBALS{'corsite_massupdatelog'} = "";
    	$GLOBALS{'corsite_classificationcalc'} = $GLOBALS{'corsite_classification'}; // CHECK temp transition fix
    	// XPTXT('Write_Data - corsite'." = ".$incorsite_id." corversion = ".$incorsite_version);
    	Write_Data('corsite',$incorsite_id,$incorsite_version);
    	
    } else {
        XPTXTCOLOR("ERROR 200: This would overwrite updates done by ".$GLOBALS{'corsite_lastupdatepersonid'}." on ".TimestamptoDDMMMbHHcMM($GLOBALS{'corsite_lastupdatetimestamp'}),"red");
        $errorfound = "1";
    } 	
}

if (($insubmitaction == "SaveLock")||($insubmitaction == "SaveUnlock")) {    
    if ($errorfound == "1") { XPTXTCOLOR("No Updates Made","red"); } 
    else { XPTXTCOLOR("Updates applied","green"); }
    Cor_CORSITEUPDATE_Output($incorsite_id,$incorsite_version,$GLOBALS{"corsite_corprogramme"},$incurrenttab);
    Back_Navigator();
    PageFooter("Default","Final");    
} else {
	if ($errorfound == "1") {
	    XPTXTCOLOR("No Updates Made","red");
	    Cor_CORSITEUPDATE_Output($incorsite_id,$incorsite_version,$GLOBALS{"corsite_corprogramme"},$incurrenttab);
	    Back_Navigator();
	    PageFooter("Default","Final");   
	} else {
		echo "<script>window.close();</script>";		
	}
}

function FieldTypeHash() {
	$tfieldtytpehash = array();
	$q = 'SHOW COLUMNS FROM corsite';
	$r = mysqli_query($GLOBALS{'IOSQL'},$q);
	# Field Type Null Key Default Extra
	if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
			// XPTXT($row[0].'|'.$row[1].'|'.$row[2].'|'.$row[3].'|');
			$tfieldtytpehash[$row[0]] = $row[1];
		}
	}
	$q = 'SHOW COLUMNS FROM corcomm';
	$r = mysqli_query($GLOBALS{'IOSQL'},$q);
	# Field Type Null Key Default Extra
	if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
			// XPTXT($row[0].'|'.$row[1].'|'.$row[2].'|'.$row[3].'|');
			$tfieldtytpehash[$row[0]] = $row[1];
		}
	}	
	$q = 'SHOW COLUMNS FROM corresi';
	$r = mysqli_query($GLOBALS{'IOSQL'},$q);
	# Field Type Null Key Default Extra
	if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
			// XPTXT($row[0].'|'.$row[1].'|'.$row[2].'|'.$row[3].'|');
			$tfieldtytpehash[$row[0]] = $row[1];
		}
	}
	$q = 'SHOW COLUMNS FROM corsurvey';
	$r = mysqli_query($GLOBALS{'IOSQL'},$q);
	# Field Type Null Key Default Extra
	if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
			// XPTXT($row[0].'|'.$row[1].'|'.$row[2].'|'.$row[3].'|');
			$tfieldtytpehash[$row[0]] = $row[1];
		}
	}
	return $tfieldtytpehash;
}

?>