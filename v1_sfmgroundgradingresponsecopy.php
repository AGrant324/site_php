<<<<<<< HEAD
<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmfacility_id = $_REQUEST['sfmfacility_id'];
$inaccredscheme_id = $_REQUEST['accredscheme_id'];
$infromaccredscheme_id = $_REQUEST['fromaccredscheme_id'];

// XPTXT("Ground Grading Response Copy - ".$insfmclub_id." - From ".$infromaccredscheme_id." To ".$inaccredscheme_id);

if ( $infromaccredscheme_id != "NoCopy" ) {
    $accredcriteriaa = Get_Array('accredcriteria',$infromaccredscheme_id,$insfmfacility_id);
    foreach ($accredcriteriaa as $accredcriteria_id) {
        Get_Data('accredcriteria',$infromaccredscheme_id,$insfmfacility_id,$accredcriteria_id);    
        $taccredcriteria_evidencetext = $GLOBALS{'accredcriteria_evidencetext'};
        $taccredcriteria_dataradioresult = $GLOBALS{'accredcriteria_dataradioresult'};
        $taccredcriteria_datacheckboxresult = $GLOBALS{'accredcriteria_datacheckboxresult'};
        $taccredcriteria_datatextresult = $GLOBALS{'accredcriteria_datatextresult'};
        $taccredcriteria_datacondition = $GLOBALS{'accredcriteria_datacondition'};
        $taccredcriteria_evidenceassetcodes = $GLOBALS{'accredcriteria_evidenceassetcodes'};
        $taccredcriteria_owner = $GLOBALS{'accredcriteria_owner'};
        $taccredcriteria_reviewcomments = $GLOBALS{'accredcriteria_reviewcomments'};
        $taccredcriteria_evidenceimagelist = $GLOBALS{'accredcriteria_evidenceimagelist'};
        $taccredcriteria_selfassessment = $GLOBALS{'accredcriteria_selfassessment'};
        $taccredcriteria_selfassessmentcondition = $GLOBALS{'accredcriteria_selfassessmentcondition'};
        $taccredcriteria_selfassessmentconditioncomments = $GLOBALS{'accredcriteria_selfassessmentconditioncomments'};

        Check_Data('accredcriteria',$inaccredscheme_id,$insfmfacility_id,$accredcriteria_id);
        if ($GLOBALS{'IOWARNING'} == "0") { 
            $GLOBALS{'accredcriteria_evidencetext'} = $taccredcriteria_evidencetext;
            $GLOBALS{'accredcriteria_dataradioresult'} = $taccredcriteria_dataradioresult;
            $GLOBALS{'accredcriteria_datacheckboxresult'} = $taccredcriteria_datacheckboxresult;
            $GLOBALS{'accredcriteria_datatextresult'} = $taccredcriteria_datatextresult;
            $GLOBALS{'accredcriteria_datacondition'} = $taccredcriteria_datacondition;
            $GLOBALS{'accredcriteria_evidenceassetcodes'} = $taccredcriteria_evidenceassetcodes;
            $GLOBALS{'accredcriteria_owner'} = $taccredcriteria_owner;
            $GLOBALS{'accredcriteria_reviewcomments'} = $taccredcriteria_reviewcomments;
            $GLOBALS{'accredcriteria_evidenceimagelist'} = $taccredcriteria_evidenceimagelist;
            $GLOBALS{'accredcriteria_selfassessment'} = $taccredcriteria_selfassessment;
            $GLOBALS{'accredcriteria_selfassessmentcondition'} = $taccredcriteria_selfassessmentcondition;
            $GLOBALS{'accredcriteria_selfassessmentconditioncomments'} = $taccredcriteria_selfassessmentconditioncomments;
            Write_Data('accredcriteria',$inaccredscheme_id,$insfmfacility_id,$accredcriteria_id);
            // XPTXTCOLOR($accredcriteria_id." ".$GLOBALS{'accredcriteria_type'}." ".$GLOBALS{'accredcriteria_evidencetext'}." - Copied","orange");
        }
    }
    Get_Data("accredscheme",$infromaccredscheme_id);
    $fromaccredscheme_name = $GLOBALS{'accredscheme_name'};
    Get_Data("accredscheme",$inaccredscheme_id);
    $toaccredscheme_name = $GLOBALS{'accredscheme_name'};    
    XPTXTCOLOR("The ground grading responses from ".$fromaccredscheme_name." have now been carried forward to ".$toaccredscheme_name,"green");
} else {
    XPTXTCOLOR("No previous responses have been carried forward into this New Self Assessment" ,"green"); 
}  
    
// Check_Data('sfmclub', $insfmclub_id);
SFM_SFMGROUNDGRADING_Output($insfmclub_id,$insfmfacility_id,$inaccredscheme_id);

Back_Navigator();
PageFooter("Default","Final");
?>

=======
<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$inaccredscheme_id = $_REQUEST['accredscheme_id'];
$infromaccredscheme_id = $_REQUEST['fromaccredscheme_id'];

// XPTXT("Ground Grading Response Copy - ".$insfmclub_id." - From ".$infromaccredscheme_id." To ".$inaccredscheme_id);

if ( $infromaccredscheme_id != "NoCopy" ) {
    $accredcriteriaa = Get_Array('accredcriteria',$infromaccredscheme_id,$insfmclub_id);
    foreach ($accredcriteriaa as $accredcriteria_id) {
        Get_Data('accredcriteria',$infromaccredscheme_id,$insfmclub_id,$accredcriteria_id);    
        $taccredcriteria_evidencetext = $GLOBALS{'accredcriteria_evidencetext'};
        $taccredcriteria_dataradioresult = $GLOBALS{'accredcriteria_dataradioresult'};
        $taccredcriteria_datacheckboxresult = $GLOBALS{'accredcriteria_datacheckboxresult'};
        $taccredcriteria_datatextresult = $GLOBALS{'accredcriteria_datatextresult'};
        $taccredcriteria_datacondition = $GLOBALS{'accredcriteria_datacondition'};
        $taccredcriteria_evidenceassetcodes = $GLOBALS{'accredcriteria_evidenceassetcodes'};
        $taccredcriteria_owner = $GLOBALS{'accredcriteria_owner'};
        $taccredcriteria_reviewcomments = $GLOBALS{'accredcriteria_reviewcomments'};
        $taccredcriteria_evidenceimagelist = $GLOBALS{'accredcriteria_evidenceimagelist'};
        $taccredcriteria_selfassessment = $GLOBALS{'accredcriteria_selfassessment'};
        $taccredcriteria_selfassessmentcondition = $GLOBALS{'accredcriteria_selfassessmentcondition'};
        $taccredcriteria_selfassessmentconditioncomments = $GLOBALS{'accredcriteria_selfassessmentconditioncomments'};

        Check_Data('accredcriteria',$inaccredscheme_id,$insfmclub_id,$accredcriteria_id);
        if ($GLOBALS{'IOWARNING'} == "0") { 
            $GLOBALS{'accredcriteria_evidencetext'} = $taccredcriteria_evidencetext;
            $GLOBALS{'accredcriteria_dataradioresult'} = $taccredcriteria_dataradioresult;
            $GLOBALS{'accredcriteria_datacheckboxresult'} = $taccredcriteria_datacheckboxresult;
            $GLOBALS{'accredcriteria_datatextresult'} = $taccredcriteria_datatextresult;
            $GLOBALS{'accredcriteria_datacondition'} = $taccredcriteria_datacondition;
            $GLOBALS{'accredcriteria_evidenceassetcodes'} = $taccredcriteria_evidenceassetcodes;
            $GLOBALS{'accredcriteria_owner'} = $taccredcriteria_owner;
            $GLOBALS{'accredcriteria_reviewcomments'} = $taccredcriteria_reviewcomments;
            $GLOBALS{'accredcriteria_evidenceimagelist'} = $taccredcriteria_evidenceimagelist;
            $GLOBALS{'accredcriteria_selfassessment'} = $taccredcriteria_selfassessment;
            $GLOBALS{'accredcriteria_selfassessmentcondition'} = $taccredcriteria_selfassessmentcondition;
            $GLOBALS{'accredcriteria_selfassessmentconditioncomments'} = $taccredcriteria_selfassessmentconditioncomments;
            Write_Data('accredcriteria',$inaccredscheme_id,$insfmclub_id,$accredcriteria_id);
            // XPTXTCOLOR($accredcriteria_id." ".$GLOBALS{'accredcriteria_type'}." ".$GLOBALS{'accredcriteria_evidencetext'}." - Copied","orange");
        }
    }
    Get_Data("accredscheme",$infromaccredscheme_id);
    $fromaccredscheme_name = $GLOBALS{'accredscheme_name'};
    Get_Data("accredscheme",$inaccredscheme_id);
    $toaccredscheme_name = $GLOBALS{'accredscheme_name'};    
    XPTXTCOLOR("The ground grading responses from ".$fromaccredscheme_name." have now been carried forward to ".$toaccredscheme_name,"green");
} else {
    XPTXTCOLOR("No previous responses have been carried forward into this New Self Assessment" ,"green"); 
}  
    
Check_Data('sfmclub', $insfmclub_id);
SFM_SFMGROUNDGRADING_Output($insfmclub_id,$GLOBALS{'sfmclub_groundidlist'},$inaccredscheme_id);

Back_Navigator();
PageFooter("Default","Final");
?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
