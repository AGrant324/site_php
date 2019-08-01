<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmfacility_id = $_REQUEST['sfmfacility_id'];
$insfmfloodlightvisit_id = $_REQUEST['sfmfloodlightvisit_id'];
$inspecificationchanged = $_REQUEST['SpecificationChanged'];
$invisitaction = $_REQUEST['VisitAction']; // New, Update, ReTest
$insubmitaction = $_REQUEST['SubmitAction'];
$screenheight = $_REQUEST['ScreenHeight'];
$screenwidth = $_REQUEST['ScreenWidth'];

if ($insubmitaction == "Finish") {
    SFM_SFMLLTAPPLAUNCHER_CSSJS ();
    PageHeader("Default","Final");
    Check_Session_Validity();
    Back_Navigator();
} else {
    // SubmitAction is Save
}

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Check_Data('sfmclub', $insfmclub_id);
Check_Data('sfmfacility', $GLOBALS{'sfmclub_sfmfacilityidlist'});
$newvisit = "0";
if ( $insfmfloodlightvisit_id == "New" ) {
    $newvisit = "1";  
    Initialise_Data('sfmfloodlightvisit');
    $thissfmfloodlightvisit_id = $GLOBALS{'currenttimestamp'};
    Write_Data('sfmfloodlightvisit', $insfmfacility_id, $thissfmfloodlightvisit_id);    
} else {
    $thissfmfloodlightvisit_id = $insfmfloodlightvisit_id;
    Get_Data('sfmfloodlightvisit', $insfmfacility_id, $thissfmfloodlightvisit_id);
}

foreach ( $_REQUEST as $keystring => $v ) {
    // if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XPTXTCOLOR($keystring." => ".$v,"orange"); }
    $keybits = explode("_",$keystring);
    $fieldname = $keybits[0]."_".$keybits[1];
    
    if ($keybits[0] == "sfmfloodlightvisit") {
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
$GLOBALS{'sfmfacility_lastfloodlightreviewdate'} = $GLOBALS{'sfmfloodlightvisit_date'};
$GLOBALS{'sfmfacility_lastfloodlightreviewername'} = $GLOBALS{'sfmfloodlightvisit_reviewername'};
$GLOBALS{'sfmfacility_lastfloodlightreviewdecision'} = $GLOBALS{'sfmfloodlightvisit_reviewerdecision'};
$GLOBALS{'sfmfacility_floodlightluxcomments'} = $GLOBALS{'sfmfloodlightvisit_luxcomments'};
$GLOBALS{'sfmfacility_floodlightconditioncomments'} = $GLOBALS{'sfmfloodlightvisit_conditioncomments'};

// ====== LLT results ======================
$GLOBALS{'sfmfacility_floodlightavglux'} = $GLOBALS{'sfmfloodlightvisit_avglux'};
$GLOBALS{'sfmfacility_floodlightavgluxreqd'} = $GLOBALS{'sfmfloodlightvisit_avgluxreqd'};
$GLOBALS{'sfmfacility_floodlightminlux'} = $GLOBALS{'sfmfloodlightvisit_minlux'};
$GLOBALS{'sfmfacility_floodlightmaxlux'} = $GLOBALS{'sfmfloodlightvisit_maxlux'};
$GLOBALS{'sfmfacility_floodlightminmaxlux'} = $GLOBALS{'sfmfloodlightvisit_minmaxlux'};
$GLOBALS{'sfmfacility_floodlightminmaxluxreqd'} = $GLOBALS{'sfmfloodlightvisit_minmaxluxreqd'};
$GLOBALS{'sfmfacility_floodlightminavglux'} = $GLOBALS{'sfmfloodlightvisit_minavglux'};
$GLOBALS{'sfmfacility_floodlightlampnotworking'} = $GLOBALS{'sfmfloodlightvisit_lampnotworking'};

// ====== any changes to pitch specifications ======================
$GLOBALS{'sfmfacility_pitchorientation'} = $GLOBALS{'sfmfloodlightvisit_pitchorientation'};
$GLOBALS{'sfmfacility_dugoutposition'} = $GLOBALS{'sfmfloodlightvisit_dugoutposition'};
$GLOBALS{'sfmfacility_sfmpitchtypeid'} = $GLOBALS{'sfmfloodlightvisit_sfmpitchtypeid'};
$GLOBALS{'sfmfacility_pitchlength'} = $GLOBALS{'sfmfloodlightvisit_pitchlength'};
$GLOBALS{'sfmfacility_pitchwidth'} = $GLOBALS{'sfmfloodlightvisit_pitchwidth'};

// ====== any changes to floodlight condition ======================
$GLOBALS{'sfmfacility_floodlightgeneralconditionrag'} = $GLOBALS{'sfmfloodlightvisit_generalconditionrag'};
$GLOBALS{'sfmfacility_floodlightcolumnrag'} = $GLOBALS{'sfmfloodlightvisit_columnrag'};
$GLOBALS{'sfmfacility_floodlightcolumnrag'} = $GLOBALS{'sfmfloodlightvisit_columnrag'};
$GLOBALS{'sfmfacility_floodlightfixturerag'} = $GLOBALS{'sfmfloodlightvisit_fixturerag'};
$GLOBALS{'sfmfacility_floodlightelectricsrag'} = $GLOBALS{'sfmfloodlightvisit_electricsrag'};
$GLOBALS{'sfmfacility_floodlightspillluxrag'} = $GLOBALS{'sfmfloodlightvisit_spillluxrag'};

if ($inspecificationchanged = "Yes") {
    // ====== any changes to floodlight specification ======================
    $GLOBALS{'sfmfacility_floodlightcolumnqty'} = $GLOBALS{'sfmfloodlightvisit_columnqty'};
    $GLOBALS{'sfmfacility_floodlightcolumnheight'} = $GLOBALS{'sfmfloodlightvisit_columnheight'};
    $GLOBALS{'sfmfacility_floodlightcolumntypeid'} = $GLOBALS{'sfmfloodlightvisit_columntypeid'};
    $GLOBALS{'sfmfacility_floodlightfixtureqty'} = $GLOBALS{'sfmfloodlightvisit_fixtureqty'};
    $GLOBALS{'sfmfacility_floodlightcolumnmanufacturerid'} = $GLOBALS{'sfmfloodlightvisit_columnmanufacturerid'};
    $GLOBALS{'sfmfacility_floodlightcolumninstalldate'} = $GLOBALS{'sfmfloodlightvisit_columninstalldate'};
    $GLOBALS{'sfmfacility_floodlightfixturetypeid'} = $GLOBALS{'sfmfloodlightvisit_fixturetypeid'};
    $GLOBALS{'sfmfacility_floodlightfixturemanufacturerid'} = $GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'};
    $GLOBALS{'sfmfacility_floodlightfixtureinstalldate'} = $GLOBALS{'sfmfloodlightvisit_fixtureinstalldate'};
    $GLOBALS{'sfmfacility_floodlightlamptypeid'} = $GLOBALS{'sfmfloodlightvisit_lamptypeid'};
    
    // ====== further changes to floodlight specification (desktop only) ======================   
    $GLOBALS{'sfmfacility_floodlightcolumnreplacementdate'} = $GLOBALS{'sfmfloodlightvisit_columnreplacementdate'};
    $GLOBALS{'sfmfacility_floodlightfixturereplacementdate'} = $GLOBALS{'sfmfloodlightvisit_fixturereplacementdate'};
    $GLOBALS{'sfmfacility_floodlightelectricsreplacementdate'} = $GLOBALS{'sfmfloodlightvisit_electricsreplacementdate'};
    
    // ====== update specification records ======================
    Check_Data('sfmfloodlightcolumn', $GLOBALS{'sfmclub_sfmfacilityidlist'}, "0");
    $GLOBALS{'sfmfloodlightcolumn_qty'} = $GLOBALS{'sfmfloodlightvisit_columnqty'};
    $GLOBALS{'sfmfloodlightcolumn_columnheight'} = $GLOBALS{'sfmfloodlightvisit_columnheight'};
    $GLOBALS{'sfmfloodlightcolumn_columntypeid'} = $GLOBALS{'sfmfloodlightvisit_columntypeid'};
    $GLOBALS{'sfmfloodlightcolumn_fixtureqty'} = $GLOBALS{'sfmfloodlightvisit_fixtureqty'};
    $GLOBALS{'sfmfloodlightcolumn_columninstalldate'} = $GLOBALS{'sfmfloodlightvisit_columninstalldate'};
    // $GLOBALS{'sfmfloodlightcolumn_columnreplacementdate'} = $GLOBALS{'sfmfloodlightvisit_columnreplacementdate'}; // desktop only
    Write_Data('sfmfloodlightcolumn', $GLOBALS{'sfmclub_sfmfacilityidlist'}, "0");
    
    Check_Data('sfmfloodlightelement', $GLOBALS{'sfmclub_sfmfacilityidlist'}, "0", "0");
    $GLOBALS{'sfmfloodlightelement_fixturetypeid'} = $GLOBALS{'sfmfloodlightvisit_fixturetypeid'};
    $GLOBALS{'sfmfloodlightelement_fixturemanufacturerid'} = $GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'};
    $GLOBALS{'sfmfloodlightelement_fixtureinstalldate'} = $GLOBALS{'sfmfloodlightvisit_fixtureinstalldate'};
    // $GLOBALS{'sfmfloodlightelement_fixturereplacementdate'} = $GLOBALS{'sfmfloodlightvisit_fixturereplacementdate'}; // desktop only
    $GLOBALS{'sfmfloodlightelement_lamptypeid'} = $GLOBALS{'sfmfloodlightvisit_lamptypeid'};
    Write_Data('sfmfloodlightelement', $GLOBALS{'sfmclub_sfmfacilityidlist'}, "0", "0");
}


	$GLOBALS{'sfmfloodlightvisit_targetpoints'} = intval($GLOBALS{'sfmfloodlightvisit_gridpointslength'} * $GLOBALS{'sfmfloodlightvisit_gridpointswidth'});
// ====== lightmeter update ======================
    Check_Data('sfmfloodlightmeter',$GLOBALS{'sfmfloodlightvisit_lightmeterserialno'});
    if ($GLOBALS{'IOWARNING'} == "1") {
        $GLOBALS{'sfmfloodlightvisit_lightmetertype'} = "";
        $GLOBALS{'sfmfloodlightvisit_lightmetercalibrationdate'} = "";
        $GLOBALS{'sfmfloodlightvisit_lightmetercompanyid'} = "";
    } else {
        $GLOBALS{'sfmfloodlightvisit_lightmetertype'} = $GLOBALS{'sfmfloodlightmeter_type'};
        $GLOBALS{'sfmfloodlightvisit_lightmetercalibrationdate'} = $GLOBALS{'sfmfloodlightmeter_calibrationdate'};
        $GLOBALS{'sfmfloodlightvisit_lightmetercompanyid'} = $GLOBALS{'sfmfloodlightmeter_companyid'};
    }
Write_Data('sfmfacility', $insfmfacility_id);
Write_Data('sfmfloodlightvisit', $insfmfacility_id, $thissfmfloodlightvisit_id);
// XPTXT($insfmfacility_id." ".$thissfmfloodlightvisit_id);

if ($insubmitaction == "Finish") {
    XPTXTCOLOR("App Updates applied","green");
    SFM_SFMLLTAPPLAUNCHER_Output($screenheight,$screenwidth,$insfmclub_id);
    Back_Navigator();PageFooter("Default","Final");
} else {
   // SubmitAction is Save
   print "Updates Successful";
}

?>

