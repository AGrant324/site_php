<<<<<<< HEAD
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();

// print_r($_REQUEST);

$indmwssu_id = $_REQUEST['dmwssu_id'];
$indmwsvisit_id = $_REQUEST['dmwsvisit_id'];
$indmwsvisit_type = $_REQUEST['dmwsvisit_type'];
$insubmitaction = $_REQUEST['SubmitAction'];
$incurrenttab = $_REQUEST['CurrentTab'];

if ( $indmwsvisit_type == "undefined" ) { $indmwsvisit_type == "Subsequent"; } // CHECK VISIT

if ($indmwssu_id == "New") {
    if ($GLOBALS{'site_clientservermode'} == "Client") { // ==== client side  ======      
        $newdmwssu_ida = Array();
        $olddmwssu_ida = Get_Array('dmwssu');
        $highestdmwssu_id = "New0";
        foreach ($olddmwssu_ida as $tdmwssu_id) {
            if (strlen(strstr($tdmwssu_id,"New"))>0) {
                if ( $tdmwssu_id > $highestdmwssu_id ) { $highestdmwssu_id = $tdmwssu_id; }
            }
        }
        $highestdmwssu_seq = str_replace("New", "", $highestdmwssu_id);
        $highestdmwssu_seq++;
        $thisdmwssu_id = "New".$highestdmwssu_seq;
    } else {
        $newdmwssu_ida = Array();
        $olddmwssu_ida = Get_Array('dmwssu');
        $highestdmwssu_id = "SU00000";
        foreach ($olddmwssu_ida as $tdmwssu_id) {
            if ( $tdmwssu_id > $highestdmwssu_id ) { $highestdmwssu_id = $tdmwssu_id; }
        }
        $highestdmwssu_seq = str_replace("SU", "", $highestdmwssu_id);
        $highestdmwssu_seq++;
        $thisdmwssu_id = "SU".substr(("00000".$highestdmwssu_seq), -5);
    }
    
} else {   
    $thisdmwssu_id = $indmwssu_id;
} 
    
$timestamp = "T".$GLOBALS{'currentYYYYMMDDHHMMSS'};
if ( $indmwsvisit_id == "New" ) { $thisdmwsvisit_id = $timestamp; }
else { $thisdmwsvisit_id = $indmwsvisit_id; }


// =====  Headers ===============
if ($insubmitaction == "Save"){
    Dmws_DMWSSUUPDATE_CSSJS();
    PageHeader("Default","Final");
    Check_Session_Validity();
    Back_Navigator();
}

if ($insubmitaction == "Close"){
    Dmws_DMWSSULIST_CSSJS();
    PageHeader("Default","Final");
    Check_Session_Validity();
    Back_Navigator();   
}

if ($insubmitaction == "SaveClose"){
    Dmws_DMWSSULIST_CSSJS();
    PageHeader("Default","Final");
    Check_Session_Validity();
    Back_Navigator();   
}

$errorfound = "0";
// =====  Update Processing ===============
if (($insubmitaction == "Save")||($insubmitaction == "SaveClose")) {

    $olddmwsconsentwithdrawal_dmwsconsentwithdrawaltypeida = Get_Array('dmwsconsentwithdrawal',$thisdmwssu_id);
	$olddmwsreferrerupdate_ida = Get_Array('dmwsreferrerupdate',$thisdmwssu_id);
	$olddmwsaction_ida = Get_Array('dmwsaction',$thisdmwssu_id);
	$olddmwsreferral_ida = Get_Array('dmwsreferral',$thisdmwssu_id);
	$olddmwsserviceprovided_ida = Get_Array('dmwsserviceprovided',$thisdmwssu_id);
	$olddmwsattachment_ida = Get_Array('dmwsattachment',$thisdmwssu_id);
	$newdmwsconsentwithdrawal_dmwsconsentwithdrawaltypeida = Array();
	$newdmwsreferrerupdate_ida = Array();
	$newdmwsaction_ida = Array();
	$newdmwsreferral_ida = Array();
	$newdmwsserviceprovided_ida = Array();
	$newdmwsattachment_ida = Array();
	$uploadableattachmentfilenamea = Array();
	$deleteableattachmentfilenamea = Array();
	
	Check_Data('dmwssu', $thisdmwssu_id);
	if ($GLOBALS{'IOWARNING'} == "0") {
	    Get_Data('dmwssux', $thisdmwssu_id);
	} else {
        Initialise_Data('dmwssu');
        Initialise_Data('dmwssux');
        $GLOBALS{'dmwssu_id'} = $thisdmwssu_id;
        $GLOBALS{'dmwssux_id'} = $thisdmwssu_id;
	}	
	
	foreach ( $_REQUEST as $keystring => $v ) {
	    // if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XPTXTCOLOR($keystring." => ".$v,"orange"); }
	    $keybits = explode("_",$keystring);
	    $fieldname = $keybits[0]."_".$keybits[1];
		
	    if (($keybits[0] == "dmwssu")||($keybits[0] == "dmwssux")) {
			// XPTXT( $keystring." = ".$v  );
			if (sizeOf($keybits) == 2) { # normal	
			    if (is_array($_REQUEST[$keystring])) { # array 
			        // print_r($_REQUEST[$keystring]);
			        $vstring = ""; $vsep = "";
					foreach ( $_REQUEST[$keystring] as $key => $value ) {					
						$vstring = $vstring.$vsep.$key;
						$vsep = ",";
					}
					// XPTXT($keystring.' = '.$vstring);
				} else {
					$vstring = $v;
				}
				$GLOBALS{$fieldname} = $vstring;
				// XPTXT( $fieldname." = ".$vstring  );
			}
			if (sizeOf($keybits) == 3) { # Multipart field
				if ($keybits[2] == "imagename") {
					$GLOBALS{$fieldname} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{$fieldname},$v);
				}				
				if ($keybits[2] == "dd/mm/yyyy") {
				    $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
                }			
				if ($keybits[2] == "DDpart") {$ddpart = $v;} 
				if ($keybits[2] == "MMpart") {$mmpart = $v;} 			
				if ($keybits[2] == "YYYYpart") {$yyyypart = $v; $GLOBALS{$fieldname} = $yyyypart."-".$mmpart."-".$ddpart;}
				if ($keybits[2] == "CODEpart") {$codepart = $v;} 
				if ($keybits[2] == "NUMpart") {$numpart = $v; $GLOBALS{$fieldname} = $codepart." ".$numpart; }	
				// XPTXT( $fieldname." = ".$v );
			}
		}
					
		if ($keybits[0] == "dmwsvisit") {
			if ($keybits[1] == "startfield") {
			    Check_Data('dmwsvisit',$thisdmwssu_id,$thisdmwsvisit_id );
			    if ($GLOBALS{'IOWARNING'} == "1") {
			        Initialise_Data('dmwsvisit');
			        $GLOBALS{'dmwsvisit_id'} = $timestamp;
			        $GLOBALS{'dmwsvisit_type'} = $indmwsvisit_type;
			        $GLOBALS{'dmwsvisit_status'} = "Open";
			    }
			}

			if (strlen(strstr($keybits[1],'duration'))>0) {				
				$dmwstimebanda = Get_Array('dmwstimeband');				
				UpdateTimeBandList($fieldname,$keybits[2],$v);				
			} else {
				if (sizeOf($keybits) == 2) { # normal				    
				    if ($keybits[1] == "newvisittype") {
				        if ($v != ""){
				            $GLOBALS{'dmwsvisit_type'} = $v;
				        }
				    } else {
				        $GLOBALS{$fieldname} = $v;				        
				    }				    
				}
				if (sizeOf($keybits) == 3) { # Multipart field
				    if ($keybits[2] == "dd/mm/yyyy") {
				        $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
				    }	
				}
				// XPTXT( $fieldname." = ".$v );	
			}

			if ($keybits[1] == "endfield") {
				Write_Data('dmwsvisit',$thisdmwssu_id,$GLOBALS{'dmwsvisit_id'});
				// XPTXT('Write_Data - dmwsvisit '." = ".$thisdmwssu_id." = ".$GLOBALS{'dmwsvisit_id'});
			}
		}
		
		if ($keybits[0] == "dmwsconsentwithdrawal") {
		    if ($keybits[1] == "startfield") {
		        $dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid = $keybits[2];
		        Check_Data('dmwsconsentwithdrawal',$thisdmwssu_id,$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid);
		        if ($GLOBALS{'IOWARNING'} == "1") {
		            Initialise_Data('dmwsconsentwithdrawal');
		            XPTXT('Initialise_Data - dmwsconsentwithdrawal '." = ".$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid);
		            $GLOBALS{'dmwsconsentwithdrawal_dmwssuid'} = $thisdmwssu_id;
		        }
		    }
		    if (sizeOf($keybits) == 3) { # normal		        
		        if ($keybits[2] == "dmwsconsentwithdrawaltypeid") {
		            $GLOBALS{'dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid'} = $v;
		        } else {
	       	        $GLOBALS{$fieldname} = $v;		            
		        }
		    }
		    if (sizeOf($keybits) == 4) { # Multipart field
		        if ($keybits[3] == "dd/mm/yyyy") {
		            $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
		        }
		    }
		    // XPTXT( $fieldname." = ".$v );
		    
		    if ($keybits[1] == "endfield") {
		        array_push($newdmwsconsentwithdrawal_dmwsconsentwithdrawaltypeida,$GLOBALS{'dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid'});
		        Write_Data('dmwsconsentwithdrawal',$thisdmwssu_id,$GLOBALS{'dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid'});
		        // XPTXT('Write_Data - dmwsconsentwithdrawal '." = ".$GLOBALS{'dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid'});
		    }
		}
		
				
		if ($keybits[0] == "dmwsreferrerupdate") {
			if ($keybits[1] == "startfield") {
			    $dmwsreferrerupdate_ts = $keybits[2];
			    array_push($newdmwsreferrerupdate_ida,$dmwsreferrerupdate_ts);			    
			    Check_Data('dmwsreferrerupdate',$thisdmwssu_id,$dmwsreferrerupdate_ts);
			    if ($GLOBALS{'IOWARNING'} == "1") {
			        Initialise_Data('dmwsreferrerupdate');
			        // XPTXT('Initialise_Data - dmwsreferrerupdate '." = ".$dmwsreferrerupdate_ts);
			        $GLOBALS{'dmwsreferrerupdate_dmwssuid'} = $thisdmwssu_id;
			        $GLOBALS{'dmwsreferrerupdate_id'} = $dmwsreferrerupdate_ts;
			    }
			}	

			if (sizeOf($keybits) == 3) { # normal
			    $GLOBALS{$fieldname} = $v;
			}
			if (sizeOf($keybits) == 4) { # Multipart field
			    if ($keybits[3] == "dd/mm/yyyy") {
			        $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
			    }
			}
			// XPTXT( $fieldname." = ".$v );
		
			if ($keybits[1] == "endfield") {
				$GLOBALS{'dmwsreferrerupdate_dmwsvisitid'} = $thisdmwsvisit_id;
				Write_Data('dmwsreferrerupdate',$thisdmwssu_id,$dmwsreferrerupdate_ts);
				// XPTXT('Write_Data - dmwsreferrerupdate '." = ".$dmwsreferrerupdate_ts);
			}
		}		
		
		if ($keybits[0] == "dmwsaction") {
			if ($keybits[1] == "startfield") {
				$dmwsaction_ts = $keybits[2];
				array_push($newdmwsaction_ida,$dmwsaction_ts);
				Check_Data('dmwsaction',$thisdmwssu_id,$dmwsaction_ts);
				if ($GLOBALS{'IOWARNING'} == "1") {
				    Initialise_Data('dmwsaction');
				    // XPTXT('Initialise_Data - dmwsaction '." = ".$dmwsaction_ts);
				    $GLOBALS{'dmwsaction_dmwssuid'} = $thisdmwssu_id;
				    $GLOBALS{'dmwsaction_id'} = $dmwsaction_ts;
				}				
			}
			if (sizeOf($keybits) == 3) { # normal
			    $GLOBALS{$fieldname} = $v;
			}
			if (sizeOf($keybits) == 4) { # Multipart field
			    if ($keybits[3] == "dd/mm/yyyy") {
			        $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
			    }
			}
			// XPTXT( $fieldname." = ".$v );
		
			if ($keybits[1] == "endfield") {
				$GLOBALS{'dmwsaction_dmwsvisitid'} = $thisdmwsvisit_id;
			    Write_Data('dmwsaction',$thisdmwssu_id,$dmwsaction_ts);
				// XPTXT('Write_Data - dmwsaction '." = ".$dmwsaction_ts);
			}
		}
		
		if ($keybits[0] == "dmwsreferral") {
			if ($keybits[1] == "startfield") {
			    $dmwsreferral_ts = $keybits[2];
			    array_push($newdmwsreferral_ida,$dmwsreferral_ts);
			    Check_Data('dmwsreferral',$thisdmwssu_id,$dmwsreferral_ts);
			    if ($GLOBALS{'IOWARNING'} == "1") {
			        Initialise_Data('dmwsreferral');
			        // XPTXT('Initialise_Data - dmwsreferral '." = ".$dmwsreferral_ts);
			        $GLOBALS{'dmwsreferral_dmwssuid'} = $thisdmwssu_id;
			        $GLOBALS{'dmwsreferral_id'} = $dmwsreferral_ts;
			    }	
			}
		
			if (sizeOf($keybits) == 3) { # normal
			    $GLOBALS{$fieldname} = $v;
			}
			if (sizeOf($keybits) == 4) { # Multipart field
			    if ($keybits[3] == "dd/mm/yyyy") {
			        $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
			    }
			}
			// XPTXT( $fieldname." = ".$v );
		
			if ($keybits[1] == "endfield") {
				$GLOBALS{'dmwsreferral_dmwsvisitid'} = $thisdmwsvisit_id;
				Write_Data('dmwsreferral',$thisdmwssu_id,$dmwsreferral_ts);
				// XPTXT('Write_Data - dmwsreferral '." = ".$dmwsreferral_ts);
			}
		}	
		
		if ($keybits[0] == "dmwsserviceprovided") {
		    if ($keybits[1] == "startfield") {
		        $dmwsserviceprovided_ts = $keybits[2];
		        array_push($newdmwsserviceprovided_ida,$dmwsserviceprovided_ts);
		        Check_Data('dmwsserviceprovided',$thisdmwssu_id,$dmwsserviceprovided_ts);
		        if ($GLOBALS{'IOWARNING'} == "1") {
		            Initialise_Data('dmwsserviceprovided');
		            // XPTXT('Initialise_Data - dmwsserviceprovided '." = ".$dmwsserviceprovided_ts);
		            $GLOBALS{'dmwsserviceprovided_dmwssuid'} = $thisdmwssu_id;
		            $GLOBALS{'dmwsserviceprovided_id'} = $dmwsserviceprovided_ts;
		        }		
		    }
		    
		    if (sizeOf($keybits) == 3) { # normal
		        $GLOBALS{$fieldname} = $v;
		        // XPTXT( $fieldname." = ".$GLOBALS{$fieldname} );
		    }
		    if (sizeOf($keybits) == 4) { # Multipart field
		        if ($keybits[3] == "dd/mm/yyyy") {
		            $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
		        }
		    }

		    if ($keybits[1] == "endfield") {
		        $GLOBALS{'dmwsserviceprovided_dmwsvisitid'} = $thisdmwsvisit_id;
		        Write_Data('dmwsserviceprovided',$thisdmwssu_id,$dmwsserviceprovided_ts);     
		        // XPTXT('Write_Data - dmwsserviceprovided '." = ".$dmwsserviceprovided_ts);
		    }
		    
		}	
		
		if ($keybits[0] == "dmwswellbeing") {
			if ($keybits[1] == "startfield") {			    
			    Check_Data('dmwswellbeing',$thisdmwssu_id,$thisdmwsvisit_id );
			    if ($GLOBALS{'IOWARNING'} == "1") {
    				Initialise_Data('dmwswellbeing');
    				$GLOBALS{'dmwswellbeing_dmwssuid'} = $thisdmwssu_id;
			        $GLOBALS{'dmwswellbeing_dmwsvisitid'} = $thisdmwsvisit_id;
			        $GLOBALS{"dmwswellbeing_date"} = $GLOBALS{'currentYYYY-MM-DD'};	
			    }
			}
		
			$GLOBALS{$fieldname} = $v;
			if ($fieldname == 'dmwswellbeing_score'){
			    $thisdmwssuvisitida = Get_Array('dmwsvisit',$thisdmwssu_id);
			    $latestvisit_id = end($thisdmwssuvisitida);
			    Get_Data('dmwsvisit',$thisdmwssu_id,$thisdmwsvisit_id);
			    if ($GLOBALS{'dmwsvisit_type'} == "First"){
			        $GLOBALS{'dmwssu_initialwellbeingscore'} = $GLOBALS{'dmwswellbeing_score'};
			    }
			    elseif ($thisdmwsvisit_id == $latestvisit_id){
			        $GLOBALS{'dmwssu_finalwellbeingscore'} = $GLOBALS{'dmwswellbeing_score'};
			    }
			    
			}
			
			
			// XPTXT( $fieldname." = ".$v );
		
			if ($keybits[1] == "endfield") {			
				Write_Data('dmwswellbeing',$thisdmwssu_id,$GLOBALS{'dmwswellbeing_dmwsvisitid'});
				// XPTXT('Write_Data - dmwswellbeing '." = ".$thisdmwssu_id." = ".$GLOBALS{'dmwswellbeing_dmwsvisitid'});
			}
		}		
		
		if ($keybits[0] == "dmwsprogress") {
			if ($keybits[1] == "startfield") {		    
			    Check_Data('dmwsprogress',$thisdmwssu_id,$thisdmwssu_id );
			    if ($GLOBALS{'IOWARNING'} == "1") {
			        Initialise_Data('dmwsprogress');
			        $GLOBALS{'dmwsprogress_dmwssuid'} = $thisdmwssu_id;
			        $GLOBALS{'dmwsprogress_dmwsvisitid'} = $thisdmwsvisit_id;
			        $GLOBALS{"dmwsprogress_date"} = $GLOBALS{'currentYYYY-MM-DD'};	
			    }				
			}
		
			$GLOBALS{$fieldname} = $v;
			if ($fieldname == 'dmwsprogress_score'){
			    $thisdmwssuvisitida = Get_Array('dmwsvisit',$thisdmwssu_id);
			    $latestvisit_id = end($thisdmwssuvisitida);
			    Get_Data('dmwsvisit',$thisdmwssu_id,$thisdmwsvisit_id);
			    if ($GLOBALS{'dmwsvisit_type'} == "First"){
			        $GLOBALS{'dmwssu_initialprogressscore'} = $GLOBALS{'dmwsprogress_score'};
			    }
			    elseif ($thisdmwsvisit_id == $latestvisit_id){
			        $GLOBALS{'dmwssu_finalprogressscore'} = $GLOBALS{'dmwsprogress_score'};
			    }
			    
			}
			// XPTXT( $fieldname." = ".$v );
		
			if ($keybits[1] == "endfield") {
				Write_Data('dmwsprogress',$thisdmwssu_id,$GLOBALS{'dmwsprogress_dmwsvisitid'});
				// XPTXT('Write_Data - dmwsprogress '." = ".$thisdmwssu_id." = ".$GLOBALS{'dmwsprogress_dmwsvisitid'});
			}
		}		

		if ($keybits[0] == "dmwscomplexity") {
		    if ($keybits[1] == "startfield") {
		        $complexityassessmentindex = 0;
		        Check_Data('dmwscomplexity',$thisdmwssu_id,"Latest" );
		        if ($GLOBALS{'IOWARNING'} == "1") {
		            Initialise_Data('dmwscomplexity');
		            $GLOBALS{'dmwscomplexity_dmwssuid'} = $thisdmwssu_id;
		            $GLOBALS{'dmwscomplexity_dmwsvisitid'} = "Latest";
		            $GLOBALS{"dmwscomplexity_date"} = $GLOBALS{'currentYYYY-MM-DD'};
		        } else {
		            for( $ci = 1; $ci<13; $ci++ ) {
		                $GLOBALS{'dmwscomplexity_issuetype'.$ci} = "";
		                $GLOBALS{'dmwscomplexity_issueweight'.$ci} = 0;
		                $GLOBALS{'dmwscomplexity_issuescore'.$ci} = 0;     
		            }
		            $GLOBALS{'dmwscomplexity_score'} = 0;
		        }
			}
			if ($keybits[1] == "issuetype") { $complexityassessmentindex++; }			
			if (($keybits[1] == "issuetype")||($keybits[1] == "issueweight")||($keybits[1] == "issuescore")) {  
			    $fieldname = $keybits[0]."_".$keybits[1].$complexityassessmentindex;
			} else {
			    $fieldname = $keybits[0]."_".$keybits[1];
			}

			$GLOBALS{$fieldname} = $v;
			// XPTXT( $fieldname." = ".$v );

			if ($keybits[1] == "endfield") {
			    Write_Data('dmwscomplexity',$thisdmwssu_id,"Latest");
			    // XPTXT('Write_Data - dmwscomplexity '." = ".$thisdmwssu_id." = "."Latest");
			}
		}
		
		
		if ($keybits[0] == "dmwsattachment") {
		    // XPTXTCOLOR($keystring." => ".$v,"orange");
		    if ($keybits[1] == "startfield") {
		        $dmwsattachment_ts = $keybits[2];
		        array_push($newdmwsattachment_ida,$dmwsattachment_ts);
		        Check_Data('dmwsattachment',$thisdmwssu_id,$dmwsattachment_ts);
		        if ($GLOBALS{'IOWARNING'} == "1") {
		            Initialise_Data('dmwsattachment');
		            // XPTXT('Initialise_Data - dmwsattachment '." = ".$dmwsattachment_ts);
		            $GLOBALS{'dmwsattachment_dmwssuid'} = $thisdmwssu_id;
		            $GLOBALS{'dmwsattachment_id'} = $dmwsattachment_ts;
		        }
		    }
		    if (sizeOf($keybits) == 3) { # normal
		        $GLOBALS{$fieldname} = $v; 
		        if ( $keybits[1] == "filename" ) {
		           array_push($deleteableattachmentfilenamea,$GLOBALS{$fieldname}); 
		           if (strlen(strstr($GLOBALS{$fieldname},"temp_")) > 0) {
		               Finalise_TempFile ($GLOBALS{'domainfilepath'}."/assets",$GLOBALS{$fieldname});
		               $GLOBALS{$fieldname} = str_replace("temp_","",$GLOBALS{$fieldname});
		               array_push($uploadableattachmentfilenamea,$GLOBALS{$fieldname});
		           }
		           if (strlen(strstr($GLOBALS{$fieldname},"tempf_")) > 0) { 
		               Finalise_TempFile ($GLOBALS{'domainfilepath'}."/assets",$GLOBALS{$fieldname});
		               $GLOBALS{$fieldname} = str_replace("tempf_","",$GLOBALS{$fieldname}); 
		               array_push($uploadableattachmentfilenamea,$GLOBALS{$fieldname});
		           }		           
		        }
		    }
		    if (sizeOf($keybits) == 4) { # Multipart field
		        if ($keybits[3] == "dd/mm/yyyy") {
		            $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
		        }
		    }
		    // XPTXT( $fieldname." = ".$v );
		    
		    if ($keybits[1] == "endfield") {
		        Write_Data('dmwsattachment',$thisdmwssu_id,$dmwsattachment_ts);
		        // XPTXT('Write_Data - dmwsattachment '." = ".$dmwsattachment_ts);
		    }
		}
	}

	// ====== delete any redundant data ====
	
	foreach ( $olddmwsconsentwithdrawal_dmwsconsentwithdrawaltypeida as $olddmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid ) {
	    if (in_array($olddmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid,$newdmwsconsentwithdrawal_dmwsconsentwithdrawaltypeida)) { }
	    else {
	        Delete_Data('dmwsconsentwithdrawal',$thisdmwssu_id,$olddmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid);
	        XPTXT('Delete_Data - dmwsconsentwithdrawal '." = ".$olddmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid);
	    }
	}

	foreach ( $olddmwsreferrerupdate_ida as $olddmwsreferrerupdate_id ) {
	    if (in_array($olddmwsreferrerupdate_id,$newdmwsreferrerupdate_ida)) { }
		else {
			Delete_Data('dmwsreferrerupdate',$thisdmwssu_id,$olddmwsreferrerupdate_id);
			XPTXT('Delete_Data - dmwsreferrerupdate '." = ".$olddmwsreferrerupdate_id);
		}
	}
	foreach ( $olddmwsaction_ida as $olddmwsaction_id ) {
	    if (in_array($olddmwsaction_id,$newdmwsaction_ida)) { }
		else {
			Delete_Data('dmwsaction',$thisdmwssu_id,$olddmwsaction_id);
			XPTXT('Delete_Data - dmwsaction '." = ".$olddmwsaction_id);
		}
	}
	foreach ( $olddmwsreferral_ida as $olddmwsreferral_id ) {
	    if (in_array($olddmwsreferral_id,$newdmwsreferral_ida)) { }
		else {
			Delete_Data('dmwsreferral',$thisdmwssu_id,$olddmwsreferral_id);
			XPTXT('Delete_Data - dmwsreferral '." = ".$olddmwsreferral_id);
		}
	}	
	foreach ( $olddmwsserviceprovided_ida as $olddmwsserviceprovided_id ) {
	    if (in_array($olddmwsserviceprovided_id,$newdmwsserviceprovided_ida)) { }
	    else {
	        Delete_Data('dmwsserviceprovided',$thisdmwssu_id,$olddmwsserviceprovided_id);
	        XPTXT('Delete_Data - dmwsserviceprovided '." = ".$olddmwsserviceprovided_id);
	    }
	}	
	foreach ( $olddmwsattachment_ida as $olddmwsattachment_id ) {
	    if (in_array($olddmwsattachment_id,$newdmwsattachment_ida)) { }
	    else {
	        Check_Data('dmwsattachment',$thisdmwssu_id,$olddmwsattachment_id);
	        if ($GLOBALS{'IOWARNING'} == "0") {
	            Delete_Data('dmwsattachment',$thisdmwssu_id,$olddmwsattachment_id);
	            XPTXT('Delete_Data - dmwsattachment '." = ".$olddmwsattachment_id);
	            if ( $GLOBALS{'dmwsattachment_filename'} != "" ) {
	                Check_File ($GLOBALS{'domainfilepath'}."/assets/".$GLOBALS{'dmwsattachment_filename'});
                    if ( $GLOBALS{'IOWARNING'} == "0") {
                        Delete_File ($GLOBALS{'domainfilepath'}."/assets/".$GLOBALS{'dmwsattachment_filename'});
                        XPTXT('Delete_File - dmwsattachmentfile '." = ".$GLOBALS{'dmwsattachment_filename'});
                    }
	            }
	        }
	    }
	}
	
	// ====== write out any related data records ====	
	
	/*
	if ($complexityassessmentindex > 0) {
	    Check_Data('dmwscomplexity',$thisdmwssu_id,$thisdmwsvisit_id );
	    if ($GLOBALS{'IOWARNING'} == "0") {
	        $GLOBALS{'dmwscomplexity_dmwsvisitid'} = $thisdmwsvisit_id;
	    } else {  // new
	        $GLOBALS{'dmwscomplexity_dmwsvisitid'} = $timestamp;
	    }
	    Write_Data('dmwscomplexity',$thisdmwssu_id,$GLOBALS{'dmwscomplexity_dmwsvisitid'});
	    // XPTXT('Write_Data - dmwscomplexity '." = ".$thisdmwssu_id." = ".$GLOBALS{'dmwscomplexity_dmwsvisitid'});
	}
	*/
	
	$GLOBALS{'dmwssu_clientupdatetimestamp'} = $timestamp;
	Write_Data('dmwssu',$thisdmwssu_id);
	// XPTXT('Write_Data - dmwssu'." = ".$thisdmwssu_id);
	Write_Data('dmwssux',$thisdmwssu_id);
	// XPTXT('Write_Data - dmwssux'." = ".$thisdmwssu_id);
	if ($errorfound == "0") {
	    XPTXTCOLOR("Updates applied","green");
	} else {
	    XPTXTCOLOR("Warnings Found","red");
	}
	
	// upload the files to the central portal if on the client 
	if ( $GLOBALS{'site_clientservermode'} == "Client") {
	    // CHECK Redundant attachments will need to be deleted from the central server at some stage
	    foreach ( $uploadableattachmentfilenamea as $uploadableattachmentfilename ) {
	        XPTXTCOLOR($uploadableattachmentfilename." sent to DMWS Portal","green");
    	    $target_url = 'http://www.dmwsportal.org.uk/site_php/v1_clientfileupload.php';
	        // $target_url = 'http://localhost/site_php/v1_clientfileupload.php';
	        $file_name_with_full_path = realpath($GLOBALS{'domainfilepath'}."/assets/".$uploadableattachmentfilename);
    	    if (function_exists('curl_file_create')) { // php 5.5+
    	        $cFile = curl_file_create($file_name_with_full_path);
    	    } else { //
    	        $cFile = '@' . realpath($file_name_with_full_path);
    	    }

    	    $post = array (
    	        // 'ServiceId' => $GLOBALS{'LOGIN_service_id'},
    	        'ServiceId' => "dmws",
    	        // 'DomainId' => $GLOBALS{'LOGIN_domain_id'},
    	        'DomainId' => "dmwsportal",
    	        'ModeId' => $GLOBALS{'LOGIN_mode_id'},
    	        'PersonId' => $GLOBALS{'LOGIN_person_id'},
    	        'SessionId' => $GLOBALS{'LOGIN_session_id'},
    	        'file_contents' => $cFile
    	    );
    	    $ch = curl_init();
    	    curl_setopt($ch, CURLOPT_URL,$target_url);
    	    curl_setopt($ch, CURLOPT_POST,1);
    	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    	    $result=curl_exec ($ch);
    	    curl_close ($ch);
    	    XPTXT($result);
	    } 
	    foreach ( $deleteableattachmentfilenamea as $deleteableattachmentfilename ) {
	        if (file_exists($GLOBALS{'domainfilepath'}."/assets/".$deleteableattachmentfilename)) { 
	            unlink ($GLOBALS{'domainfilepath'}."/assets/".$deleteableattachmentfilename);
	            // XPTXTCOLOR($deleteableattachmentfilename." local copy deleted","green");
	        }
	    } 
	}
	

}
if ($insubmitaction == "Save"){
    Dmws_DMWSSUUPDATE_Output($thisdmwssu_id, $GLOBALS{'dmwsvisit_type'}, $thisdmwsvisit_id ,$incurrenttab);
}
if ($insubmitaction == "Close"){
    Dmws_DMWSSULIST_Output("Open");
}
if ($insubmitaction == "SaveClose"){
    Dmws_DMWSSULIST_Output("Open");
}

// =====  Footers ===============
Back_Navigator();
PageFooter("Default","Final");


=======
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();

// print_r($_REQUEST);

$indmwssu_id = $_REQUEST['dmwssu_id'];
$indmwsvisit_id = $_REQUEST['dmwsvisit_id'];
$indmwsvisit_type = $_REQUEST['dmwsvisit_type'];
$insubmitaction = $_REQUEST['SubmitAction'];
$incurrenttab = $_REQUEST['CurrentTab'];

if ( $indmwsvisit_type == "undefined" ) { $indmwsvisit_type == "Subsequent"; } // CHECK VISIT

if ($indmwssu_id == "New") {
    if ($GLOBALS{'site_clientservermode'} == "Client") { // ==== client side  ======      
        $newdmwssu_ida = Array();
        $olddmwssu_ida = Get_Array('dmwssu');
        $highestdmwssu_id = "New0";
        foreach ($olddmwssu_ida as $tdmwssu_id) {
            if (strlen(strstr($tdmwssu_id,"New"))>0) {
                if ( $tdmwssu_id > $highestdmwssu_id ) { $highestdmwssu_id = $tdmwssu_id; }
            }
        }
        $highestdmwssu_seq = str_replace("New", "", $highestdmwssu_id);
        $highestdmwssu_seq++;
        $thisdmwssu_id = "New".$highestdmwssu_seq;
    } else {
        $newdmwssu_ida = Array();
        $olddmwssu_ida = Get_Array('dmwssu');
        $highestdmwssu_id = "SU00000";
        foreach ($olddmwssu_ida as $tdmwssu_id) {
            if ( $tdmwssu_id > $highestdmwssu_id ) { $highestdmwssu_id = $tdmwssu_id; }
        }
        $highestdmwssu_seq = str_replace("SU", "", $highestdmwssu_id);
        $highestdmwssu_seq++;
        $thisdmwssu_id = "SU".substr(("00000".$highestdmwssu_seq), -5);
    }
    
} else {   
    $thisdmwssu_id = $indmwssu_id;
} 
    
$timestamp = "T".$GLOBALS{'currentYYYYMMDDHHMMSS'};
if ( $indmwsvisit_id == "New" ) { $thisdmwsvisit_id = $timestamp; }
else { $thisdmwsvisit_id = $indmwsvisit_id; }


// =====  Headers ===============
if ($insubmitaction == "Save"){
    Dmws_DMWSSUUPDATE_CSSJS();
    PageHeader("Default","Final");
    Check_Session_Validity();
    Back_Navigator();
}

if ($insubmitaction == "Close"){
    Dmws_DMWSSULIST_CSSJS();
    PageHeader("Default","Final");
    Check_Session_Validity();
    Back_Navigator();   
}

if ($insubmitaction == "SaveClose"){
    Dmws_DMWSSULIST_CSSJS();
    PageHeader("Default","Final");
    Check_Session_Validity();
    Back_Navigator();   
}

$errorfound = "0";
// =====  Update Processing ===============
if (($insubmitaction == "Save")||($insubmitaction == "SaveClose")) {

    $olddmwsconsentwithdrawal_dmwsconsentwithdrawaltypeida = Get_Array('dmwsconsentwithdrawal',$thisdmwssu_id);
	$olddmwsreferrerupdate_ida = Get_Array('dmwsreferrerupdate',$thisdmwssu_id);
	$olddmwsaction_ida = Get_Array('dmwsaction',$thisdmwssu_id);
	$olddmwsreferral_ida = Get_Array('dmwsreferral',$thisdmwssu_id);
	$olddmwsserviceprovided_ida = Get_Array('dmwsserviceprovided',$thisdmwssu_id);
	$olddmwsattachment_ida = Get_Array('dmwsattachment',$thisdmwssu_id);
	$newdmwsconsentwithdrawal_dmwsconsentwithdrawaltypeida = Array();
	$newdmwsreferrerupdate_ida = Array();
	$newdmwsaction_ida = Array();
	$newdmwsreferral_ida = Array();
	$newdmwsserviceprovided_ida = Array();
	$newdmwsattachment_ida = Array();
	$uploadableattachmentfilenamea = Array();
	$deleteableattachmentfilenamea = Array();
	
	Check_Data('dmwssu', $thisdmwssu_id);
	if ($GLOBALS{'IOWARNING'} == "0") {
	    Get_Data('dmwssux', $thisdmwssu_id);
	} else {
        Initialise_Data('dmwssu');
        Initialise_Data('dmwssux');
        $GLOBALS{'dmwssu_id'} = $thisdmwssu_id;
        $GLOBALS{'dmwssux_id'} = $thisdmwssu_id;
	}	
	
	foreach ( $_REQUEST as $keystring => $v ) {
	    // if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XPTXTCOLOR($keystring." => ".$v,"orange"); }
	    $keybits = explode("_",$keystring);
	    $fieldname = $keybits[0]."_".$keybits[1];
		
	    if (($keybits[0] == "dmwssu")||($keybits[0] == "dmwssux")) {
			// XPTXT( $keystring." = ".$v  );
			if (sizeOf($keybits) == 2) { # normal	
			    if (is_array($_REQUEST[$keystring])) { # array 
			        // print_r($_REQUEST[$keystring]);
			        $vstring = ""; $vsep = "";
					foreach ( $_REQUEST[$keystring] as $key => $value ) {					
						$vstring = $vstring.$vsep.$key;
						$vsep = ",";
					}
					// XPTXT($keystring.' = '.$vstring);
				} else {
					$vstring = $v;
				}
				$GLOBALS{$fieldname} = $vstring;
				// XPTXT( $fieldname." = ".$vstring  );
			}
			if (sizeOf($keybits) == 3) { # Multipart field
				if ($keybits[2] == "imagename") {
					$GLOBALS{$fieldname} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{$fieldname},$v);
				}				
				if ($keybits[2] == "dd/mm/yyyy") {
				    $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
                }			
				if ($keybits[2] == "DDpart") {$ddpart = $v;} 
				if ($keybits[2] == "MMpart") {$mmpart = $v;} 			
				if ($keybits[2] == "YYYYpart") {$yyyypart = $v; $GLOBALS{$fieldname} = $yyyypart."-".$mmpart."-".$ddpart;}
				if ($keybits[2] == "CODEpart") {$codepart = $v;} 
				if ($keybits[2] == "NUMpart") {$numpart = $v; $GLOBALS{$fieldname} = $codepart." ".$numpart; }	
				// XPTXT( $fieldname." = ".$v );
			}
		}
					
		if ($keybits[0] == "dmwsvisit") {
			if ($keybits[1] == "startfield") {
			    Check_Data('dmwsvisit',$thisdmwssu_id,$thisdmwsvisit_id );
			    if ($GLOBALS{'IOWARNING'} == "1") {
			        Initialise_Data('dmwsvisit');
			        $GLOBALS{'dmwsvisit_id'} = $timestamp;
			        $GLOBALS{'dmwsvisit_type'} = $indmwsvisit_type;
			        $GLOBALS{'dmwsvisit_status'} = "Open";
			    }
			}

			if (strlen(strstr($keybits[1],'duration'))>0) {				
				$dmwstimebanda = Get_Array('dmwstimeband');				
				UpdateTimeBandList($fieldname,$keybits[2],$v);				
			} else {
				if (sizeOf($keybits) == 2) { # normal				    
				    if ($keybits[1] == "newvisittype") {
				        if ($v != ""){
				            $GLOBALS{'dmwsvisit_type'} = $v;
				        }
				    } else {
				        $GLOBALS{$fieldname} = $v;				        
				    }				    
				}
				if (sizeOf($keybits) == 3) { # Multipart field
				    if ($keybits[2] == "dd/mm/yyyy") {
				        $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
				    }	
				}
				// XPTXT( $fieldname." = ".$v );	
			}

			if ($keybits[1] == "endfield") {
				Write_Data('dmwsvisit',$thisdmwssu_id,$GLOBALS{'dmwsvisit_id'});
				// XPTXT('Write_Data - dmwsvisit '." = ".$thisdmwssu_id." = ".$GLOBALS{'dmwsvisit_id'});
			}
		}
		
		if ($keybits[0] == "dmwsconsentwithdrawal") {
		    if ($keybits[1] == "startfield") {
		        $dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid = $keybits[2];
		        Check_Data('dmwsconsentwithdrawal',$thisdmwssu_id,$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid);
		        if ($GLOBALS{'IOWARNING'} == "1") {
		            Initialise_Data('dmwsconsentwithdrawal');
		            XPTXT('Initialise_Data - dmwsconsentwithdrawal '." = ".$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid);
		            $GLOBALS{'dmwsconsentwithdrawal_dmwssuid'} = $thisdmwssu_id;
		        }
		    }
		    if (sizeOf($keybits) == 3) { # normal		        
		        if ($keybits[2] == "dmwsconsentwithdrawaltypeid") {
		            $GLOBALS{'dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid'} = $v;
		        } else {
	       	        $GLOBALS{$fieldname} = $v;		            
		        }
		    }
		    if (sizeOf($keybits) == 4) { # Multipart field
		        if ($keybits[3] == "dd/mm/yyyy") {
		            $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
		        }
		    }
		    // XPTXT( $fieldname." = ".$v );
		    
		    if ($keybits[1] == "endfield") {
		        array_push($newdmwsconsentwithdrawal_dmwsconsentwithdrawaltypeida,$GLOBALS{'dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid'});
		        Write_Data('dmwsconsentwithdrawal',$thisdmwssu_id,$GLOBALS{'dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid'});
		        // XPTXT('Write_Data - dmwsconsentwithdrawal '." = ".$GLOBALS{'dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid'});
		    }
		}
		
				
		if ($keybits[0] == "dmwsreferrerupdate") {
			if ($keybits[1] == "startfield") {
			    $dmwsreferrerupdate_ts = $keybits[2];
			    array_push($newdmwsreferrerupdate_ida,$dmwsreferrerupdate_ts);			    
			    Check_Data('dmwsreferrerupdate',$thisdmwssu_id,$dmwsreferrerupdate_ts);
			    if ($GLOBALS{'IOWARNING'} == "1") {
			        Initialise_Data('dmwsreferrerupdate');
			        // XPTXT('Initialise_Data - dmwsreferrerupdate '." = ".$dmwsreferrerupdate_ts);
			        $GLOBALS{'dmwsreferrerupdate_dmwssuid'} = $thisdmwssu_id;
			        $GLOBALS{'dmwsreferrerupdate_id'} = $dmwsreferrerupdate_ts;
			    }
			}	

			if (sizeOf($keybits) == 3) { # normal
			    $GLOBALS{$fieldname} = $v;
			}
			if (sizeOf($keybits) == 4) { # Multipart field
			    if ($keybits[3] == "dd/mm/yyyy") {
			        $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
			    }
			}
			// XPTXT( $fieldname." = ".$v );
		
			if ($keybits[1] == "endfield") {
				$GLOBALS{'dmwsreferrerupdate_dmwsvisitid'} = $thisdmwsvisit_id;
				Write_Data('dmwsreferrerupdate',$thisdmwssu_id,$dmwsreferrerupdate_ts);
				// XPTXT('Write_Data - dmwsreferrerupdate '." = ".$dmwsreferrerupdate_ts);
			}
		}		
		
		if ($keybits[0] == "dmwsaction") {
			if ($keybits[1] == "startfield") {
				$dmwsaction_ts = $keybits[2];
				array_push($newdmwsaction_ida,$dmwsaction_ts);
				Check_Data('dmwsaction',$thisdmwssu_id,$dmwsaction_ts);
				if ($GLOBALS{'IOWARNING'} == "1") {
				    Initialise_Data('dmwsaction');
				    // XPTXT('Initialise_Data - dmwsaction '." = ".$dmwsaction_ts);
				    $GLOBALS{'dmwsaction_dmwssuid'} = $thisdmwssu_id;
				    $GLOBALS{'dmwsaction_id'} = $dmwsaction_ts;
				}				
			}
			if (sizeOf($keybits) == 3) { # normal
			    $GLOBALS{$fieldname} = $v;
			}
			if (sizeOf($keybits) == 4) { # Multipart field
			    if ($keybits[3] == "dd/mm/yyyy") {
			        $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
			    }
			}
			// XPTXT( $fieldname." = ".$v );
		
			if ($keybits[1] == "endfield") {
				$GLOBALS{'dmwsaction_dmwsvisitid'} = $thisdmwsvisit_id;
			    Write_Data('dmwsaction',$thisdmwssu_id,$dmwsaction_ts);
				// XPTXT('Write_Data - dmwsaction '." = ".$dmwsaction_ts);
			}
		}
		
		if ($keybits[0] == "dmwsreferral") {
			if ($keybits[1] == "startfield") {
			    $dmwsreferral_ts = $keybits[2];
			    array_push($newdmwsreferral_ida,$dmwsreferral_ts);
			    Check_Data('dmwsreferral',$thisdmwssu_id,$dmwsreferral_ts);
			    if ($GLOBALS{'IOWARNING'} == "1") {
			        Initialise_Data('dmwsreferral');
			        // XPTXT('Initialise_Data - dmwsreferral '." = ".$dmwsreferral_ts);
			        $GLOBALS{'dmwsreferral_dmwssuid'} = $thisdmwssu_id;
			        $GLOBALS{'dmwsreferral_id'} = $dmwsreferral_ts;
			    }	
			}
		
			if (sizeOf($keybits) == 3) { # normal
			    $GLOBALS{$fieldname} = $v;
			}
			if (sizeOf($keybits) == 4) { # Multipart field
			    if ($keybits[3] == "dd/mm/yyyy") {
			        $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
			    }
			}
			// XPTXT( $fieldname." = ".$v );
		
			if ($keybits[1] == "endfield") {
				$GLOBALS{'dmwsreferral_dmwsvisitid'} = $thisdmwsvisit_id;
				Write_Data('dmwsreferral',$thisdmwssu_id,$dmwsreferral_ts);
				// XPTXT('Write_Data - dmwsreferral '." = ".$dmwsreferral_ts);
			}
		}	
		
		if ($keybits[0] == "dmwsserviceprovided") {
		    if ($keybits[1] == "startfield") {
		        $dmwsserviceprovided_ts = $keybits[2];
		        array_push($newdmwsserviceprovided_ida,$dmwsserviceprovided_ts);
		        Check_Data('dmwsserviceprovided',$thisdmwssu_id,$dmwsserviceprovided_ts);
		        if ($GLOBALS{'IOWARNING'} == "1") {
		            Initialise_Data('dmwsserviceprovided');
		            // XPTXT('Initialise_Data - dmwsserviceprovided '." = ".$dmwsserviceprovided_ts);
		            $GLOBALS{'dmwsserviceprovided_dmwssuid'} = $thisdmwssu_id;
		            $GLOBALS{'dmwsserviceprovided_id'} = $dmwsserviceprovided_ts;
		        }		
		    }
		    
		    if (sizeOf($keybits) == 3) { # normal
		        $GLOBALS{$fieldname} = $v;
		        // XPTXT( $fieldname." = ".$GLOBALS{$fieldname} );
		    }
		    if (sizeOf($keybits) == 4) { # Multipart field
		        if ($keybits[3] == "dd/mm/yyyy") {
		            $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
		        }
		    }

		    if ($keybits[1] == "endfield") {
		        $GLOBALS{'dmwsserviceprovided_dmwsvisitid'} = $thisdmwsvisit_id;
		        Write_Data('dmwsserviceprovided',$thisdmwssu_id,$dmwsserviceprovided_ts);     
		        // XPTXT('Write_Data - dmwsserviceprovided '." = ".$dmwsserviceprovided_ts);
		    }
		    
		}	
		
		if ($keybits[0] == "dmwswellbeing") {
			if ($keybits[1] == "startfield") {			    
			    Check_Data('dmwswellbeing',$thisdmwssu_id,$thisdmwsvisit_id );
			    if ($GLOBALS{'IOWARNING'} == "1") {
    				Initialise_Data('dmwswellbeing');
    				$GLOBALS{'dmwswellbeing_dmwssuid'} = $thisdmwssu_id;
			        $GLOBALS{'dmwswellbeing_dmwsvisitid'} = $thisdmwsvisit_id;
			        $GLOBALS{"dmwswellbeing_date"} = $GLOBALS{'currentYYYY-MM-DD'};	
			    }
			}
		
			$GLOBALS{$fieldname} = $v;
			if ($fieldname == 'dmwswellbeing_score'){
			    $thisdmwssuvisitida = Get_Array('dmwsvisit',$thisdmwssu_id);
			    $latestvisit_id = end($thisdmwssuvisitida);
			    Get_Data('dmwsvisit',$thisdmwssu_id,$thisdmwsvisit_id);
			    if ($GLOBALS{'dmwsvisit_type'} == "First"){
			        $GLOBALS{'dmwssu_initialwellbeingscore'} = $GLOBALS{'dmwswellbeing_score'};
			    }
			    elseif ($thisdmwsvisit_id == $latestvisit_id){
			        $GLOBALS{'dmwssu_finalwellbeingscore'} = $GLOBALS{'dmwswellbeing_score'};
			    }
			    
			}
			
			
			// XPTXT( $fieldname." = ".$v );
		
			if ($keybits[1] == "endfield") {			
				Write_Data('dmwswellbeing',$thisdmwssu_id,$GLOBALS{'dmwswellbeing_dmwsvisitid'});
				// XPTXT('Write_Data - dmwswellbeing '." = ".$thisdmwssu_id." = ".$GLOBALS{'dmwswellbeing_dmwsvisitid'});
			}
		}		
		
		if ($keybits[0] == "dmwsprogress") {
			if ($keybits[1] == "startfield") {		    
			    Check_Data('dmwsprogress',$thisdmwssu_id,$thisdmwssu_id );
			    if ($GLOBALS{'IOWARNING'} == "1") {
			        Initialise_Data('dmwsprogress');
			        $GLOBALS{'dmwsprogress_dmwssuid'} = $thisdmwssu_id;
			        $GLOBALS{'dmwsprogress_dmwsvisitid'} = $thisdmwsvisit_id;
			        $GLOBALS{"dmwsprogress_date"} = $GLOBALS{'currentYYYY-MM-DD'};	
			    }				
			}
		
			$GLOBALS{$fieldname} = $v;
			if ($fieldname == 'dmwsprogress_score'){
			    $thisdmwssuvisitida = Get_Array('dmwsvisit',$thisdmwssu_id);
			    $latestvisit_id = end($thisdmwssuvisitida);
			    Get_Data('dmwsvisit',$thisdmwssu_id,$thisdmwsvisit_id);
			    if ($GLOBALS{'dmwsvisit_type'} == "First"){
			        $GLOBALS{'dmwssu_initialprogressscore'} = $GLOBALS{'dmwsprogress_score'};
			    }
			    elseif ($thisdmwsvisit_id == $latestvisit_id){
			        $GLOBALS{'dmwssu_finalprogressscore'} = $GLOBALS{'dmwsprogress_score'};
			    }
			    
			}
			// XPTXT( $fieldname." = ".$v );
		
			if ($keybits[1] == "endfield") {
				Write_Data('dmwsprogress',$thisdmwssu_id,$GLOBALS{'dmwsprogress_dmwsvisitid'});
				// XPTXT('Write_Data - dmwsprogress '." = ".$thisdmwssu_id." = ".$GLOBALS{'dmwsprogress_dmwsvisitid'});
			}
		}		

		if ($keybits[0] == "dmwscomplexity") {
		    if ($keybits[1] == "startfield") {
		        $complexityassessmentindex = 0;
		        Check_Data('dmwscomplexity',$thisdmwssu_id,"Latest" );
		        if ($GLOBALS{'IOWARNING'} == "1") {
		            Initialise_Data('dmwscomplexity');
		            $GLOBALS{'dmwscomplexity_dmwssuid'} = $thisdmwssu_id;
		            $GLOBALS{'dmwscomplexity_dmwsvisitid'} = "Latest";
		            $GLOBALS{"dmwscomplexity_date"} = $GLOBALS{'currentYYYY-MM-DD'};
		        } else {
		            for( $ci = 1; $ci<13; $ci++ ) {
		                $GLOBALS{'dmwscomplexity_issuetype'.$ci} = "";
		                $GLOBALS{'dmwscomplexity_issueweight'.$ci} = 0;
		                $GLOBALS{'dmwscomplexity_issuescore'.$ci} = 0;     
		            }
		            $GLOBALS{'dmwscomplexity_score'} = 0;
		        }
			}
			if ($keybits[1] == "issuetype") { $complexityassessmentindex++; }			
			if (($keybits[1] == "issuetype")||($keybits[1] == "issueweight")||($keybits[1] == "issuescore")) {  
			    $fieldname = $keybits[0]."_".$keybits[1].$complexityassessmentindex;
			} else {
			    $fieldname = $keybits[0]."_".$keybits[1];
			}

			$GLOBALS{$fieldname} = $v;
			// XPTXT( $fieldname." = ".$v );

			if ($keybits[1] == "endfield") {
			    Write_Data('dmwscomplexity',$thisdmwssu_id,"Latest");
			    // XPTXT('Write_Data - dmwscomplexity '." = ".$thisdmwssu_id." = "."Latest");
			}
		}
		
		
		if ($keybits[0] == "dmwsattachment") {
		    // XPTXTCOLOR($keystring." => ".$v,"orange");
		    if ($keybits[1] == "startfield") {
		        $dmwsattachment_ts = $keybits[2];
		        array_push($newdmwsattachment_ida,$dmwsattachment_ts);
		        Check_Data('dmwsattachment',$thisdmwssu_id,$dmwsattachment_ts);
		        if ($GLOBALS{'IOWARNING'} == "1") {
		            Initialise_Data('dmwsattachment');
		            // XPTXT('Initialise_Data - dmwsattachment '." = ".$dmwsattachment_ts);
		            $GLOBALS{'dmwsattachment_dmwssuid'} = $thisdmwssu_id;
		            $GLOBALS{'dmwsattachment_id'} = $dmwsattachment_ts;
		        }
		    }
		    if (sizeOf($keybits) == 3) { # normal
		        $GLOBALS{$fieldname} = $v; 
		        if ( $keybits[1] == "filename" ) {
		           array_push($deleteableattachmentfilenamea,$GLOBALS{$fieldname}); 
		           if (strlen(strstr($GLOBALS{$fieldname},"temp_")) > 0) {
		               Finalise_TempFile ($GLOBALS{'domainfilepath'}."/assets",$GLOBALS{$fieldname});
		               $GLOBALS{$fieldname} = str_replace("temp_","",$GLOBALS{$fieldname});
		               array_push($uploadableattachmentfilenamea,$GLOBALS{$fieldname});
		           }
		           if (strlen(strstr($GLOBALS{$fieldname},"tempf_")) > 0) { 
		               Finalise_TempFile ($GLOBALS{'domainfilepath'}."/assets",$GLOBALS{$fieldname});
		               $GLOBALS{$fieldname} = str_replace("tempf_","",$GLOBALS{$fieldname}); 
		               array_push($uploadableattachmentfilenamea,$GLOBALS{$fieldname});
		           }		           
		        }
		    }
		    if (sizeOf($keybits) == 4) { # Multipart field
		        if ($keybits[3] == "dd/mm/yyyy") {
		            $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
		        }
		    }
		    // XPTXT( $fieldname." = ".$v );
		    
		    if ($keybits[1] == "endfield") {
		        Write_Data('dmwsattachment',$thisdmwssu_id,$dmwsattachment_ts);
		        // XPTXT('Write_Data - dmwsattachment '." = ".$dmwsattachment_ts);
		    }
		}
	}

	// ====== delete any redundant data ====
	
	foreach ( $olddmwsconsentwithdrawal_dmwsconsentwithdrawaltypeida as $olddmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid ) {
	    if (in_array($olddmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid,$newdmwsconsentwithdrawal_dmwsconsentwithdrawaltypeida)) { }
	    else {
	        Delete_Data('dmwsconsentwithdrawal',$thisdmwssu_id,$olddmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid);
	        XPTXT('Delete_Data - dmwsconsentwithdrawal '." = ".$olddmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid);
	    }
	}

	foreach ( $olddmwsreferrerupdate_ida as $olddmwsreferrerupdate_id ) {
	    if (in_array($olddmwsreferrerupdate_id,$newdmwsreferrerupdate_ida)) { }
		else {
			Delete_Data('dmwsreferrerupdate',$thisdmwssu_id,$olddmwsreferrerupdate_id);
			XPTXT('Delete_Data - dmwsreferrerupdate '." = ".$olddmwsreferrerupdate_id);
		}
	}
	foreach ( $olddmwsaction_ida as $olddmwsaction_id ) {
	    if (in_array($olddmwsaction_id,$newdmwsaction_ida)) { }
		else {
			Delete_Data('dmwsaction',$thisdmwssu_id,$olddmwsaction_id);
			XPTXT('Delete_Data - dmwsaction '." = ".$olddmwsaction_id);
		}
	}
	foreach ( $olddmwsreferral_ida as $olddmwsreferral_id ) {
	    if (in_array($olddmwsreferral_id,$newdmwsreferral_ida)) { }
		else {
			Delete_Data('dmwsreferral',$thisdmwssu_id,$olddmwsreferral_id);
			XPTXT('Delete_Data - dmwsreferral '." = ".$olddmwsreferral_id);
		}
	}	
	foreach ( $olddmwsserviceprovided_ida as $olddmwsserviceprovided_id ) {
	    if (in_array($olddmwsserviceprovided_id,$newdmwsserviceprovided_ida)) { }
	    else {
	        Delete_Data('dmwsserviceprovided',$thisdmwssu_id,$olddmwsserviceprovided_id);
	        XPTXT('Delete_Data - dmwsserviceprovided '." = ".$olddmwsserviceprovided_id);
	    }
	}	
	foreach ( $olddmwsattachment_ida as $olddmwsattachment_id ) {
	    if (in_array($olddmwsattachment_id,$newdmwsattachment_ida)) { }
	    else {
	        Check_Data('dmwsattachment',$thisdmwssu_id,$olddmwsattachment_id);
	        if ($GLOBALS{'IOWARNING'} == "0") {
	            Delete_Data('dmwsattachment',$thisdmwssu_id,$olddmwsattachment_id);
	            XPTXT('Delete_Data - dmwsattachment '." = ".$olddmwsattachment_id);
	            if ( $GLOBALS{'dmwsattachment_filename'} != "" ) {
	                Check_File ($GLOBALS{'domainfilepath'}."/assets/".$GLOBALS{'dmwsattachment_filename'});
                    if ( $GLOBALS{'IOWARNING'} == "0") {
                        Delete_File ($GLOBALS{'domainfilepath'}."/assets/".$GLOBALS{'dmwsattachment_filename'});
                        XPTXT('Delete_File - dmwsattachmentfile '." = ".$GLOBALS{'dmwsattachment_filename'});
                    }
	            }
	        }
	    }
	}
	
	// ====== write out any related data records ====	
	
	/*
	if ($complexityassessmentindex > 0) {
	    Check_Data('dmwscomplexity',$thisdmwssu_id,$thisdmwsvisit_id );
	    if ($GLOBALS{'IOWARNING'} == "0") {
	        $GLOBALS{'dmwscomplexity_dmwsvisitid'} = $thisdmwsvisit_id;
	    } else {  // new
	        $GLOBALS{'dmwscomplexity_dmwsvisitid'} = $timestamp;
	    }
	    Write_Data('dmwscomplexity',$thisdmwssu_id,$GLOBALS{'dmwscomplexity_dmwsvisitid'});
	    // XPTXT('Write_Data - dmwscomplexity '." = ".$thisdmwssu_id." = ".$GLOBALS{'dmwscomplexity_dmwsvisitid'});
	}
	*/
	
	$GLOBALS{'dmwssu_clientupdatetimestamp'} = $timestamp;
	Write_Data('dmwssu',$thisdmwssu_id);
	// XPTXT('Write_Data - dmwssu'." = ".$thisdmwssu_id);
	Write_Data('dmwssux',$thisdmwssu_id);
	// XPTXT('Write_Data - dmwssux'." = ".$thisdmwssu_id);
	if ($errorfound == "0") {
	    XPTXTCOLOR("Updates applied","green");
	} else {
	    XPTXTCOLOR("Warnings Found","red");
	}
	
	// upload the files to the central portal if on the client 
	if ( $GLOBALS{'site_clientservermode'} == "Client") {
	    // CHECK Redundant attachments will need to be deleted from the central server at some stage
	    foreach ( $uploadableattachmentfilenamea as $uploadableattachmentfilename ) {
	        XPTXTCOLOR($uploadableattachmentfilename." sent to DMWS Portal","green");
    	    $target_url = 'http://www.dmwsportal.org.uk/site_php/v1_clientfileupload.php';
	        // $target_url = 'http://localhost/site_php/v1_clientfileupload.php';
	        $file_name_with_full_path = realpath($GLOBALS{'domainfilepath'}."/assets/".$uploadableattachmentfilename);
    	    if (function_exists('curl_file_create')) { // php 5.5+
    	        $cFile = curl_file_create($file_name_with_full_path);
    	    } else { //
    	        $cFile = '@' . realpath($file_name_with_full_path);
    	    }

    	    $post = array (
    	        // 'ServiceId' => $GLOBALS{'LOGIN_service_id'},
    	        'ServiceId' => "dmws",
    	        // 'DomainId' => $GLOBALS{'LOGIN_domain_id'},
    	        'DomainId' => "dmwsportal",
    	        'ModeId' => $GLOBALS{'LOGIN_mode_id'},
    	        'PersonId' => $GLOBALS{'LOGIN_person_id'},
    	        'SessionId' => $GLOBALS{'LOGIN_session_id'},
    	        'file_contents' => $cFile
    	    );
    	    $ch = curl_init();
    	    curl_setopt($ch, CURLOPT_URL,$target_url);
    	    curl_setopt($ch, CURLOPT_POST,1);
    	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    	    $result=curl_exec ($ch);
    	    curl_close ($ch);
    	    XPTXT($result);
	    } 
	    foreach ( $deleteableattachmentfilenamea as $deleteableattachmentfilename ) {
	        if (file_exists($GLOBALS{'domainfilepath'}."/assets/".$deleteableattachmentfilename)) { 
	            unlink ($GLOBALS{'domainfilepath'}."/assets/".$deleteableattachmentfilename);
	            // XPTXTCOLOR($deleteableattachmentfilename." local copy deleted","green");
	        }
	    } 
	}
	

}
if ($insubmitaction == "Save"){
    Dmws_DMWSSUUPDATE_Output($thisdmwssu_id, $GLOBALS{'dmwsvisit_type'}, $thisdmwsvisit_id ,$incurrenttab);
}
if ($insubmitaction == "Close"){
    Dmws_DMWSSULIST_Output("Open");
}
if ($insubmitaction == "SaveClose"){
    Dmws_DMWSSULIST_Output("Open");
}

// =====  Footers ===============
Back_Navigator();
PageFooter("Default","Final");


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>