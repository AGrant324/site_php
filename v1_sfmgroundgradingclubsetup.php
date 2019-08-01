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
$inaccredscheme_id = $_REQUEST['accredscheme_id'];
$inmode = $_REQUEST['mode'];

// XH3("Ground Grading Setup - ".$insfmclub_id." ".$inaccredscheme_id);

$accredcriteriaa = Get_Array('accredcriteria',$inaccredscheme_id,$GLOBALS{'LOGIN_domain_id'});
foreach ($accredcriteriaa as $accredcriteria_id) {
    Get_Data('accredcriteria',$inaccredscheme_id,$GLOBALS{'LOGIN_domain_id'},$accredcriteria_id);  
    $taccredcriteria_ref = $GLOBALS{'accredcriteria_ref'};
    $taccredcriteria_type = $GLOBALS{'accredcriteria_type'};
    $taccredcriteria_section = $GLOBALS{'accredcriteria_section'};
    $taccredcriteria_criteria = $GLOBALS{'accredcriteria_criteria'};
    $taccredcriteria_subcriteria = $GLOBALS{'accredcriteria_subcriteria'};
    $taccredcriteria_evidencerequirement = $GLOBALS{'accredcriteria_evidencerequirement'};
    $taccredcriteria_datafieldname = $GLOBALS{'accredcriteria_datafieldname'};
    $taccredcriteria_datafieldtitle = $GLOBALS{'accredcriteria_datafieldtitle'};
    $taccredcriteria_dataquestiontype = $GLOBALS{'accredcriteria_dataquestiontype'};
    $taccredcriteria_dataradioquestions = $GLOBALS{'accredcriteria_dataradioquestions'};
    $taccredcriteria_datacheckboxquestions = $GLOBALS{'accredcriteria_datacheckboxquestions'};
    $taccredcriteria_datatextquestion = $GLOBALS{'accredcriteria_datatextquestion'};
    $taccredcriteria_datatargetreqd = $GLOBALS{'accredcriteria_datatargetreqd'};
    $taccredcriteria_help = $GLOBALS{'accredcriteria_help'};
    $taccredcriteria_templates = $GLOBALS{'accredcriteria_templates'};
    
    Check_Data('accredcriteria',$inaccredscheme_id,$insfmclub_id,$accredcriteria_id);
    if ($GLOBALS{'IOWARNING'} == "0") { 
        if ($inmode == "upgrade") {
            $GLOBALS{'accredcriteria_ref'} = $taccredcriteria_ref;
            $GLOBALS{'accredcriteria_type'} = $taccredcriteria_type;
            $GLOBALS{'accredcriteria_section'} = $taccredcriteria_section;
            $GLOBALS{'accredcriteria_criteria'} = $taccredcriteria_criteria;
            $GLOBALS{'accredcriteria_subcriteria'} = $taccredcriteria_subcriteria;
            $GLOBALS{'accredcriteria_evidencerequirement'} = $taccredcriteria_evidencerequirement;
            $GLOBALS{'accredcriteria_datafieldname'} = $taccredcriteria_datafieldname;
            $GLOBALS{'accredcriteria_datafieldtitle'} = $taccredcriteria_datafieldtitle;
            $GLOBALS{'accredcriteria_dataquestiontype'} = $taccredcriteria_dataquestiontype;
            $GLOBALS{'accredcriteria_dataradioquestions'} = $taccredcriteria_dataradioquestions;
            $GLOBALS{'accredcriteria_datacheckboxquestions'} = $taccredcriteria_datacheckboxquestions;
            $GLOBALS{'accredcriteria_datatextquestion'} = $taccredcriteria_datatextquestion;
            $GLOBALS{'accredcriteria_datatargetreqd'} = $taccredcriteria_datatargetreqd;
            $GLOBALS{'accredcriteria_help'} = $taccredcriteria_help;
            $GLOBALS{'accredcriteria_templates'} = $taccredcriteria_templates;
            Write_Data('accredcriteria',$inaccredscheme_id,$insfmclub_id,$accredcriteria_id);
            // XPTXTCOLOR($accredcriteria_id." ".$GLOBALS{'accredcriteria_type'}." - Updated","orange");
        }
    } else {
        // Note: this is now done within SFM_SFMGROUNDGRADING_Output
        Write_Data('accredcriteria',$inaccredscheme_id,$insfmclub_id,$accredcriteria_id);
        // XPTXTCOLOR($accredcriteria_id." ".$GLOBALS{'accredcriteria_type'}." - Created","orange");
    }
}

// Now Delete any redundant entries
$accredcriteriaa = Get_Array('accredcriteria',$inaccredscheme_id,$insfmclub_id);
foreach ($accredcriteriaa as $accredcriteria_id) {
    Check_Data('accredcriteria',$inaccredscheme_id,$GLOBALS{'LOGIN_domain_id'},$accredcriteria_id);
    if ($GLOBALS{'IOWARNING'} == "1") { 
        if ($inmode == "upgrade") {
            Delete_Data('accredcriteria',$inaccredscheme_id,$insfmclub_id,$accredcriteria_id);
            XPTXTCOLOR($accredcriteria_id." ".$GLOBALS{'accredcriteria_type'}." - Redundant Item Deleted","red");
        }
    }
}

if ($inmode == "create") {
    XPTXTCOLOR("The ground grading criteria for ".$inaccredscheme_id." have now been created.","green");
} else {
    XPTXTCOLOR("The ground grading criteria for ".$inaccredscheme_id." have now been updated.","green");  
}

Check_Data('sfmclub', $insfmclub_id);
SFM_SFMGROUNDGRADING_Output($insfmclub_id,$GLOBALS{'sfmclub_sfmfacilityidlist'},$inaccredscheme_id);

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
$inmode = $_REQUEST['mode'];

// XH3("Ground Grading Setup - ".$insfmclub_id." ".$inaccredscheme_id);

$accredcriteriaa = Get_Array('accredcriteria',$inaccredscheme_id,$GLOBALS{'LOGIN_domain_id'});
foreach ($accredcriteriaa as $accredcriteria_id) {
    Get_Data('accredcriteria',$inaccredscheme_id,$GLOBALS{'LOGIN_domain_id'},$accredcriteria_id);  
    $taccredcriteria_ref = $GLOBALS{'accredcriteria_ref'};
    $taccredcriteria_type = $GLOBALS{'accredcriteria_type'};
    $taccredcriteria_section = $GLOBALS{'accredcriteria_section'};
    $taccredcriteria_criteria = $GLOBALS{'accredcriteria_criteria'};
    $taccredcriteria_subcriteria = $GLOBALS{'accredcriteria_subcriteria'};
    $taccredcriteria_evidencerequirement = $GLOBALS{'accredcriteria_evidencerequirement'};
    $taccredcriteria_datafieldname = $GLOBALS{'accredcriteria_datafieldname'};
    $taccredcriteria_datafieldtitle = $GLOBALS{'accredcriteria_datafieldtitle'};
    $taccredcriteria_dataquestiontype = $GLOBALS{'accredcriteria_dataquestiontype'};
    $taccredcriteria_dataradioquestions = $GLOBALS{'accredcriteria_dataradioquestions'};
    $taccredcriteria_datacheckboxquestions = $GLOBALS{'accredcriteria_datacheckboxquestions'};
    $taccredcriteria_datatextquestion = $GLOBALS{'accredcriteria_datatextquestion'};
    $taccredcriteria_datatargetreqd = $GLOBALS{'accredcriteria_datatargetreqd'};
    $taccredcriteria_help = $GLOBALS{'accredcriteria_help'};
    $taccredcriteria_templates = $GLOBALS{'accredcriteria_templates'};
    
    Check_Data('accredcriteria',$inaccredscheme_id,$insfmclub_id,$accredcriteria_id);
    if ($GLOBALS{'IOWARNING'} == "0") { 
        if ($inmode == "upgrade") {
            $GLOBALS{'accredcriteria_ref'} = $taccredcriteria_ref;
            $GLOBALS{'accredcriteria_type'} = $taccredcriteria_type;
            $GLOBALS{'accredcriteria_section'} = $taccredcriteria_section;
            $GLOBALS{'accredcriteria_criteria'} = $taccredcriteria_criteria;
            $GLOBALS{'accredcriteria_subcriteria'} = $taccredcriteria_subcriteria;
            $GLOBALS{'accredcriteria_evidencerequirement'} = $taccredcriteria_evidencerequirement;
            $GLOBALS{'accredcriteria_datafieldname'} = $taccredcriteria_datafieldname;
            $GLOBALS{'accredcriteria_datafieldtitle'} = $taccredcriteria_datafieldtitle;
            $GLOBALS{'accredcriteria_dataquestiontype'} = $taccredcriteria_dataquestiontype;
            $GLOBALS{'accredcriteria_dataradioquestions'} = $taccredcriteria_dataradioquestions;
            $GLOBALS{'accredcriteria_datacheckboxquestions'} = $taccredcriteria_datacheckboxquestions;
            $GLOBALS{'accredcriteria_datatextquestion'} = $taccredcriteria_datatextquestion;
            $GLOBALS{'accredcriteria_datatargetreqd'} = $taccredcriteria_datatargetreqd;
            $GLOBALS{'accredcriteria_help'} = $taccredcriteria_help;
            $GLOBALS{'accredcriteria_templates'} = $taccredcriteria_templates;
            Write_Data('accredcriteria',$inaccredscheme_id,$insfmclub_id,$accredcriteria_id);
            // XPTXTCOLOR($accredcriteria_id." ".$GLOBALS{'accredcriteria_type'}." - Updated","orange");
        }
    } else {
        // Note: this is now done within SFM_SFMGROUNDGRADING_Output
        Write_Data('accredcriteria',$inaccredscheme_id,$insfmclub_id,$accredcriteria_id);
        // XPTXTCOLOR($accredcriteria_id." ".$GLOBALS{'accredcriteria_type'}." - Created","orange");
    }
}

// Now Delete any redundant entries
$accredcriteriaa = Get_Array('accredcriteria',$inaccredscheme_id,$insfmclub_id);
foreach ($accredcriteriaa as $accredcriteria_id) {
    Check_Data('accredcriteria',$inaccredscheme_id,$GLOBALS{'LOGIN_domain_id'},$accredcriteria_id);
    if ($GLOBALS{'IOWARNING'} == "1") { 
        if ($inmode == "upgrade") {
            Delete_Data('accredcriteria',$inaccredscheme_id,$insfmclub_id,$accredcriteria_id);
            XPTXTCOLOR($accredcriteria_id." ".$GLOBALS{'accredcriteria_type'}." - Redundant Item Deleted","red");
        }
    }
}

if ($inmode == "create") {
    XPTXTCOLOR("The ground grading criteria for ".$inaccredscheme_id." have now been created.","green");
} else {
    XPTXTCOLOR("The ground grading criteria for ".$inaccredscheme_id." have now been updated.","green");  
}

Check_Data('sfmclub', $insfmclub_id);
SFM_SFMGROUNDGRADING_Output($insfmclub_id,$GLOBALS{'sfmclub_groundidlist'},$inaccredscheme_id);

Back_Navigator();
PageFooter("Default","Final");
?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
