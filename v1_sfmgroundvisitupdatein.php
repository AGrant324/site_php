<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmgroundvisit_sfmgroundid = $_REQUEST['sfmgroundvisit_sfmgroundid'];
$insfmgroundvisit_id = $_REQUEST['sfmgroundvisit_id'];
$insfmgroundvisit_gradingtarget = $_REQUEST['sfmgroundvisit_gradingtarget'];
// $invisitaction = $_REQUEST['VisitAction'];
$insubmitaction = $_REQUEST['SubmitAction'];
$incurrenttab = $_REQUEST['CurrentTab'];

// $ingroundgradingscheme = "FAGroundGradingG";

if ($insubmitaction == "Save") { SFM_SFMCLUBUPDATE_CSSJS(); }
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

if ($insubmitaction == "Save") {    
    Check_Data('sfmclub', $insfmclub_id);
    Check_Data('sfmground', $GLOBALS{'sfmclub_groundidlist'});
    $newvisit = "0";
    if ( $insfmgroundvisit_id == "New" ) {
        $newvisit = "1";  
        Initialise_Data('sfmgroundvisit');
        $thissfmgroundvisit_id = $GLOBALS{'currenttimestamp'};
        Write_Data('sfmgroundvisit', $insfmgroundvisit_sfmgroundid, $thissfmgroundvisit_id);    
    } else {
        $thissfmgroundvisit_id = $insfmgroundvisit_id;
        Get_Data('sfmgroundvisit', $insfmgroundvisit_sfmgroundid, $thissfmgroundvisit_id);
    }
    
    $updaterectifications = "0";
    
    foreach ( $_REQUEST as $keystring => $v ) {
        
        $keybits = explode("_",$keystring);
        $fieldname = $keybits[0]."_".$keybits[1];    
        if ($GLOBALS{'LOGIN_person_id'} == "bbra") {
            if (($keybits[0] == "sfmgroundvisit")||($keybits[0] == "sfmground")||($keybits[0] == "accredcriteria")) {
                // XPTXTCOLOR($keystring." => ".$v,"orange"); 
            }
        }
    
        if ($keybits[0] == "sfmgroundvisit") {
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
    $GLOBALS{'sfmground_lastgroundreviewdate'} = $GLOBALS{'sfmgroundvisit_date'};
    $GLOBALS{'sfmground_lastgroundreviewername'} = $GLOBALS{'sfmgroundvisit_reviewername'};
    $GLOBALS{'sfmground_lastgroundreviewerdecision'} = $GLOBALS{'sfmgroundvisit_reviewerdecision'};
    $GLOBALS{'sfmground_lastgroundreviewerdecisionnotes'} = $GLOBALS{'sfmgroundvisit_reviewerdecisionnotes'};
    // $GLOBALS{'sfmground_groundluxcomments'} = $GLOBALS{'sfmgroundvisit_luxcomments'};
    $GLOBALS{'sfmground_groundconditioncomments'} = $GLOBALS{'sfmgroundvisit_conditioncomments'};
    
    if ($GLOBALS{'sfmgroundvisit_reviewerdecision'} == "Pass") {
        $GLOBALS{'sfmground_gradingachieved'} = $GLOBALS{'sfmgroundvisit_gradingtarget'};
    }
    
    // ====== any changes to pitch specifications ======================
    $GLOBALS{'sfmground_pitchorientation'} = $GLOBALS{'sfmgroundvisit_pitchorientation'};
    $GLOBALS{'sfmground_dugoutposition'} = $GLOBALS{'sfmgroundvisit_dugoutposition'};
    $GLOBALS{'sfmground_sfmpitchtypeid'} = $GLOBALS{'sfmgroundvisit_sfmpitchtypeid'};
    $GLOBALS{'sfmground_pitchlength'} = $GLOBALS{'sfmgroundvisit_pitchlength'};
    $GLOBALS{'sfmground_pitchwidth'} = $GLOBALS{'sfmgroundvisit_pitchwidth'};
    
    // ====== any changes to ground condition ======================
    $GLOBALS{'sfmground_floodlightgeneralconditionrag'} = $GLOBALS{'sfmfloodlightvisit_generalconditionrag'};
    $GLOBALS{'sfmground_floodlightcolumnrag'} = $GLOBALS{'sfmfloodlightvisit_columnrag'};
    $GLOBALS{'sfmground_floodlightcolumnrag'} = $GLOBALS{'sfmfloodlightvisit_columnrag'};
    $GLOBALS{'sfmground_floodlightfixturerag'} = $GLOBALS{'sfmfloodlightvisit_fixturerag'};
    $GLOBALS{'sfmground_floodlightelectricsrag'} = $GLOBALS{'sfmfloodlightvisit_electricsrag'};
    $GLOBALS{'sfmground_floodlightspillluxrag'} = $GLOBALS{'sfmfloodlightvisit_spillluxrag'};
    
    $ingroundgradingchanged = "Yes";
    if ($ingroundgradingchanged == "Yes") { 
        
        $sfmrectificationa = Get_Array('sfmrectification',$insfmgroundvisit_sfmgroundid);
        foreach ($sfmrectificationa as $sfmrectification_id) {
            Get_Data('sfmrectification',$insfmgroundvisit_sfmgroundid,$sfmrectification_id);
            if ($GLOBALS{'sfmrectification_sourcetype'} == "Ground Grading Inspection") {
                if ($GLOBALS{'sfmrectification_sourceid'} == $insfmgroundvisit_id) {
                    Delete_Data('sfmrectification',$insfmgroundvisit_sfmgroundid,$sfmrectification_id);
                    // XPTXTCOLOR($insfmgroundvisit_sfmgroundid." ".$sfmrectification_id." deleted","red");
                }
            }
        }
        
        // XPTXTCOLOR("KKKKK ".$insfmgroundvisit_gradingtarget." | ".$insfmclub_id." | ".$insfmclub_id,"green");
        $accredcriteriaa = Get_Array('accredcriteria',$insfmgroundvisit_gradingtarget,$insfmclub_id);
        sort($accredcriteriaa);

        $uniqueidsuffixn = 1; 
        foreach ($accredcriteriaa as $accredcriteria_id) {
            Get_Data("accredcriteria",$insfmgroundvisit_gradingtarget,$insfmclub_id,$accredcriteria_id);
            // XPTXTCOLOR($accredcriteria_id,"orange");
            if ($GLOBALS{'accredcriteria_type'} == "criteria") {
                $lastcriteriaref = $GLOBALS{'accredcriteria_ref'};
                
            }
            
            if ($GLOBALS{'accredcriteria_type'} == "evidence") {
                if (($GLOBALS{'accredcriteria_inspectionresult'} == "Fail")||($GLOBALS{'accredcriteria_inspectionresult'} == "Advisory")) {
                    $GLOBALS{'sfmrectification_sourcetype'} = "Ground Grading Inspection";
                    $GLOBALS{'sfmrectification_sourceid'} = $insfmgroundvisit_id;
                    if ( $GLOBALS{'accredcriteria_ref'} == "" ) { $GLOBALS{'accredcriteria_ref'} = $lastcriteriaref; }
                    $GLOBALS{'sfmrectification_sourceref'} = $GLOBALS{'accredcriteria_ref'};                  
                    $GLOBALS{'sfmrectification_evidencerequirement'} = $GLOBALS{'accredcriteria_evidencerequirement'};
                    $GLOBALS{'sfmrectification_inspectionresult'} = $GLOBALS{'accredcriteria_inspectionresult'};
                    $GLOBALS{'sfmrectification_inspectioncomments'} = $GLOBALS{'accredcriteria_inspectioncomments'};
                    $GLOBALS{'sfmrectification_rectificationtypeid'} = "";
                    $GLOBALS{'sfmrectification_raiseddate'} = $GLOBALS{'currentYYYY-MM-DD'};
                    $GLOBALS{'sfmrectification_duedate'} = "2020-06-06";
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
                    Write_Data("sfmrectification",$insfmgroundvisit_sfmgroundid,$sfmrectification_id);
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
   
    Write_Data('sfmground', $GLOBALS{'sfmclub_groundidlist'});
    Write_Data('sfmgroundvisit', $insfmgroundvisit_sfmgroundid, $thissfmgroundvisit_id);
    
    XPTXTCOLOR("Updates applied","green");    
    SFM_SFMCLUBUPDATE_Output($insfmclub_id,"GROUNDSTATUS");
}


Back_Navigator();
PageFooter("Default","Final");

?>

