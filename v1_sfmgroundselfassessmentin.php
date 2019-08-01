<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
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
    
    XPTXTCOLOR("Updates applied","green");    
    SFM_SFMCLUBUPDATEGROUND_Output($sfmclub_id,$sfmfacility_id);
}


Back_Navigator();
PageFooter("Default","Final");

?>

