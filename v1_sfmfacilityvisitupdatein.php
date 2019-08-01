<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmfacilityvisit_sfmfacilityid = $_REQUEST['sfmfacilityvisit_sfmfacilityid'];
$insfmfacilityvisit_id = $_REQUEST['sfmfacilityvisit_id'];
$insfmfacilityvisit_gradingtarget = $_REQUEST['sfmfacilityvisit_gradingtarget'];
// $invisitaction = $_REQUEST['VisitAction'];
$insubmitaction = $_REQUEST['SubmitAction'];
$incurrenttab = $_REQUEST['CurrentTab'];

// $ingroundgradingscheme = "FAGroundGradingG";

if ($insubmitaction == "Save") { SFM_SFMCLUBUPDATE_CSSJS(); }
$GLOBALS{'dashboardsectionsprovided'} = "1";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

if ($insubmitaction == "Save") {    
    Check_Data('sfmclub', $insfmclub_id);
    Check_Data('sfmfacility', $GLOBALS{'sfmclub_sfmfacilityidlist'});
    $newvisit = "0";
    if ( $insfmfacilityvisit_id == "New" ) {
        $newvisit = "1";  
        Initialise_Data('sfmfacilityvisit');
        $thissfmfacilityvisit_id = $GLOBALS{'currenttimestamp'};
        Write_Data('sfmfacilityvisit', $insfmfacilityvisit_sfmfacilityid, $thissfmfacilityvisit_id);    
    } else {
        $thissfmfacilityvisit_id = $insfmfacilityvisit_id;
        Get_Data('sfmfacilityvisit', $insfmfacilityvisit_sfmfacilityid, $thissfmfacilityvisit_id);
    }
    
    $updaterectifications = "0";
    
    foreach ( $_REQUEST as $keystring => $v ) {
        
        $keybits = explode("_",$keystring);
        $fieldname = $keybits[0]."_".$keybits[1];    
        if ($GLOBALS{'LOGIN_person_id'} == "bbra") {
            if (($keybits[0] == "sfmfacilityvisit")||($keybits[0] == "sfmfacility")||($keybits[0] == "accredcriteria")) {
                // XPTXTCOLOR($keystring." => ".$v,"orange"); 
            }
        }
    
        if ($keybits[0] == "sfmfacilityvisit") {
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
    }
    
    // ====== review details ======================
    $GLOBALS{'sfmfacility_lastgroundreviewdate'} = $GLOBALS{'sfmfacilityvisit_date'};
    $GLOBALS{'sfmfacility_lastgroundreviewername'} = $GLOBALS{'sfmfacilityvisit_reviewername'};
    $GLOBALS{'sfmfacility_lastgroundreviewerdecision'} = $GLOBALS{'sfmfacilityvisit_reviewerdecision'};
    $GLOBALS{'sfmfacility_lastgroundreviewerdecisionnotes'} = $GLOBALS{'sfmfacilityvisit_reviewerdecisionnotes'};
    // $GLOBALS{'sfmfacility_groundluxcomments'} = $GLOBALS{'sfmfacilityvisit_luxcomments'};
    $GLOBALS{'sfmfacility_groundconditioncomments'} = $GLOBALS{'sfmfacilityvisit_conditioncomments'};
    
    if ($GLOBALS{'sfmfacilityvisit_reviewerdecision'} == "Pass") {
        $GLOBALS{'sfmfacility_gradingachieved'} = $GLOBALS{'sfmfacilityvisit_gradingtarget'};
    }
    
    // ====== any changes to pitch specifications ======================
    $GLOBALS{'sfmfacility_pitchorientation'} = $GLOBALS{'sfmfacilityvisit_pitchorientation'};
    $GLOBALS{'sfmfacility_dugoutposition'} = $GLOBALS{'sfmfacilityvisit_dugoutposition'};
    $GLOBALS{'sfmfacility_sfmpitchtypeid'} = $GLOBALS{'sfmfacilityvisit_sfmpitchtypeid'};
    $GLOBALS{'sfmfacility_pitchlength'} = $GLOBALS{'sfmfacilityvisit_pitchlength'};
    $GLOBALS{'sfmfacility_pitchwidth'} = $GLOBALS{'sfmfacilityvisit_pitchwidth'};
    
    // ====== any changes to ground condition ======================
    
    $GLOBALS{'sfmfacility_generalconditionrag'} = $GLOBALS{'sfmfacilityvisit_generalconditionrag'};
    $GLOBALS{'sfmfacility_generalconditionragcomments'} = $GLOBALS{'sfmfacilityvisit_generalconditionragcomments'};
    $GLOBALS{'sfmfacility_groundrag'} = $GLOBALS{'sfmfacilityvisit_groundrag'};
    $GLOBALS{'sfmfacility_groundragcomments'} = $GLOBALS{'sfmfacilityvisit_groundragcomments'};
    $GLOBALS{'sfmfacility_spectatorrag'} = $GLOBALS{'sfmfacilityvisit_spectatorrag'};
    $GLOBALS{'sfmfacility_spectatorragcomments'} = $GLOBALS{'sfmfacilityvisit_spectatorragcomments'};
    $GLOBALS{'sfmfacility_dressingroomrag'} = $GLOBALS{'sfmfacilityvisit_dressingroomrag'};
    $GLOBALS{'sfmfacility_dressingroomragcomments'} = $GLOBALS{'sfmfacilityvisit_dressingroomragcomments'};
    $GLOBALS{'sfmfacility_medicalrag'} = $GLOBALS{'sfmfacilityvisit_medicalrag'};
    $GLOBALS{'sfmfacility_medicalragcomments'} = $GLOBALS{'sfmfacilityvisit_medicalragcomments'};
    
    /*
    $GLOBALS{'sfmfacility_floodlightgeneralconditionrag'} = $GLOBALS{'sfmfloodlightvisit_generalconditionrag'};
    $GLOBALS{'sfmfacility_floodlightcolumnrag'} = $GLOBALS{'sfmfloodlightvisit_columnrag'};
    $GLOBALS{'sfmfacility_floodlightcolumnrag'} = $GLOBALS{'sfmfloodlightvisit_columnrag'};
    $GLOBALS{'sfmfacility_floodlightfixturerag'} = $GLOBALS{'sfmfloodlightvisit_fixturerag'};
    $GLOBALS{'sfmfacility_floodlightelectricsrag'} = $GLOBALS{'sfmfloodlightvisit_electricsrag'};
    $GLOBALS{'sfmfacility_floodlightspillluxrag'} = $GLOBALS{'sfmfloodlightvisit_spillluxrag'};
    */
    
    
    
    $ingroundgradingchanged = "Yes";
    if ($ingroundgradingchanged == "Yes") { 
        
        $sfmrectificationa = Get_Array('sfmrectification',$insfmfacilityvisit_sfmfacilityid);
        foreach ($sfmrectificationa as $sfmrectification_id) {
            Get_Data('sfmrectification',$insfmfacilityvisit_sfmfacilityid,$sfmrectification_id);
            if ($GLOBALS{'sfmrectification_sourcetype'} == "Ground Grading Inspection") {
                if ($GLOBALS{'sfmrectification_sourceid'} == $insfmfacilityvisit_id) {
                    Delete_Data('sfmrectification',$insfmfacilityvisit_sfmfacilityid,$sfmrectification_id);
                    // XPTXTCOLOR($insfmfacilityvisit_sfmfacilityid." ".$sfmrectification_id." deleted","red");
                }
            }
        }
        
        // XPTXTCOLOR("KKKKK ".$insfmfacilityvisit_gradingtarget." | ".$insfmclub_id." | ".$insfmclub_id,"green");
        $accredcriteriaa = Get_Array('accredcriteria',$insfmfacilityvisit_gradingtarget,$insfmclub_id);
        sort($accredcriteriaa);

        $uniqueidsuffixn = 1; 
        foreach ($accredcriteriaa as $accredcriteria_id) {
            Get_Data("accredcriteria",$insfmfacilityvisit_gradingtarget,$insfmclub_id,$accredcriteria_id);
            // XPTXTCOLOR($accredcriteria_id,"orange");
            if ($GLOBALS{'accredcriteria_type'} == "criteria") {
                $lastcriteriaref = $GLOBALS{'accredcriteria_ref'};
                
            }
            
            if ($GLOBALS{'accredcriteria_type'} == "evidence") {
                if (($GLOBALS{'accredcriteria_inspectionresult'} == "Fail")||($GLOBALS{'accredcriteria_inspectionresult'} == "Advisory")) {
                    $GLOBALS{'sfmrectification_sourcetype'} = "Ground Grading Inspection";
                    $GLOBALS{'sfmrectification_sourceid'} = $insfmfacilityvisit_id;
                    if ( $GLOBALS{'accredcriteria_ref'} == "" ) { $GLOBALS{'accredcriteria_ref'} = $lastcriteriaref; }
                    $GLOBALS{'sfmrectification_sourceref'} = $GLOBALS{'accredcriteria_ref'};                  
                    $GLOBALS{'sfmrectification_evidencerequirement'} = $GLOBALS{'accredcriteria_evidencerequirement'};
                    $GLOBALS{'sfmrectification_inspectionresult'} = $GLOBALS{'accredcriteria_inspectionresult'};
                    $GLOBALS{'sfmrectification_inspectioncomments'} = $GLOBALS{'accredcriteria_inspectioncomments'};
                    $GLOBALS{'sfmrectification_rectificationtypeid'} = "";
                    $GLOBALS{'sfmrectification_raiseddate'} = $GLOBALS{'currentYYYY-MM-DD'};
                    $GLOBALS{'sfmrectification_duedate'} = OffsetDays ($GLOBALS{'currentYYYY-MM-DD'},90);
                    $GLOBALS{'sfmrectification_status'} = "Open";
                    $GLOBALS{'sfmrectification_fixdescription'} = "";
                    $GLOBALS{'sfmrectification_fixdate'} = "";
                    $GLOBALS{'sfmrectification_reinspectiondescription'} = "";
                    $GLOBALS{'sfmrectification_reinspectionreviewername'} = "";
                    $GLOBALS{'sfmrectification_reinspectionresult'} = "";
                    $GLOBALS{'sfmrectification_reinspectioncomments'} = "";
                    $GLOBALS{'sfmrectification_reinspectiondate'} = "";
                    // XPTXTCOLOR($accredcriteria_id,"green");
                    $uniqueidsuffixn++;
                    $uniqueidsuffix = sprintf("%03d", $uniqueidsuffixn);
                    $sfmrectification_id = "T".$GLOBALS{'currentYYYYMMDDHHMMSS'}.$uniqueidsuffix;
                    Write_Data("sfmrectification",$insfmfacilityvisit_sfmfacilityid,$sfmrectification_id);
                } 
                
            }
            // === data ======================================
            if ($GLOBALS{'accredcriteria_type'} == "data") { 
                $GLOBALS{$GLOBALS{'accredcriteria_datafieldname'}} = "";
                if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Text" ) {
                    $GLOBALS{$GLOBALS{'accredcriteria_datafieldname'}} = $GLOBALS{'accredcriteria_inspectiondatatextresult'};
                }
                if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Radio" ) {
                    $GLOBALS{$GLOBALS{'accredcriteria_datafieldname'}} = $GLOBALS{'accredcriteria_inspectiondataradioresult'};
                }
                if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Checkbox" ) {
                    $GLOBALS{$GLOBALS{'accredcriteria_datafieldname'}} = $GLOBALS{'accredcriteria_inspectiondatacheckboxresult'};         
                }  
            }
        }
    }
   
    Write_Data('sfmfacility', $GLOBALS{'sfmclub_sfmfacilityidlist'});
    Write_Data('sfmfacilityvisit', $insfmfacilityvisit_sfmfacilityid, $thissfmfacilityvisit_id);
    
    XBR();BROW();BCOLTXT("","1");BCOLTXTCOLOR("Updates applied","11","transparent","green"); B_ROW();  
    
    if ( $GLOBALS{'LOGIN_orgtype_id'} == "Club" ) { 
        SFM_SFMCLUBUPDATEGROUND_Output($insfmclub_id,$insfmfacilityvisit_sfmfacilityid);
    } else {
        SFM_SFMCLUBUPDATEMULTI_Output($insfmclub_id,$insfmfacilityvisit_sfmfacilityid,"GROUNDSTATUS");   
    }
}


Back_Navigator();
PageFooter("Default","Final");

?>

