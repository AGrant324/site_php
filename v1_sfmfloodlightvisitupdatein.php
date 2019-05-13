<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmfloodlightvisit_sfmgroundid = $_REQUEST['sfmfloodlightvisit_sfmgroundid'];
$insfmfloodlightvisit_id = $_REQUEST['sfmfloodlightvisit_id'];
$inspecificationchanged = $_REQUEST['SpecificationChanged'];
$invisitaction = $_REQUEST['VisitAction'];
$insubmitaction = $_REQUEST['SubmitAction'];
$incurrenttab = $_REQUEST['CurrentTab'];

if ($insubmitaction == "Save") { SFM_SFMFLOODLIGHTVISIT_CSSJS(); }
if ($insubmitaction == "FloodlightSpecification"){ SFM_SFMFLOODLIGHTSPECIFICATION_CSSJS(); }
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

if ($insubmitaction == "Save") {    
    Check_Data('sfmclub', $insfmclub_id);
    Check_Data('sfmground', $GLOBALS{'sfmclub_groundidlist'});
    $newvisit = "0";
    if ( $insfmfloodlightvisit_id == "New" ) {
        $newvisit = "1";  
        Initialise_Data('sfmfloodlightvisit');
        $thissfmfloodlightvisit_id = $GLOBALS{'currenttimestamp'};
        Write_Data('sfmfloodlightvisit', $insfmfloodlightvisit_sfmgroundid, $thissfmfloodlightvisit_id);    
    } else {
        $thissfmfloodlightvisit_id = $insfmfloodlightvisit_id;
        Get_Data('sfmfloodlightvisit', $insfmfloodlightvisit_sfmgroundid, $thissfmfloodlightvisit_id);
    }
    
    foreach ( $_REQUEST as $keystring => $v ) {
        
        $keybits = explode("_",$keystring);
        $fieldname = $keybits[0]."_".$keybits[1];    
        if ($GLOBALS{'LOGIN_person_id'} == "bbra") {
            if (($keybits[0] == "sfmfloodlightvisit")||($keybits[0] == "sfmground")) {
                // XPTXTCOLOR($keystring." => ".$v,"orange"); 
            }
        }
    
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
    $GLOBALS{'sfmground_lastfloodlightreviewdate'} = $GLOBALS{'sfmfloodlightvisit_date'};
    $GLOBALS{'sfmground_lastfloodlightreviewername'} = $GLOBALS{'sfmfloodlightvisit_reviewername'};
    $GLOBALS{'sfmground_lastfloodlightreviewdecision'} = $GLOBALS{'sfmfloodlightvisit_reviewerdecision'};
    $GLOBALS{'sfmground_floodlightluxcomments'} = $GLOBALS{'sfmfloodlightvisit_luxcomments'};
    $GLOBALS{'sfmground_floodlightconditioncomments'} = $GLOBALS{'sfmfloodlightvisit_conditioncomments'};
    
    // ====== LLT results ======================
    $GLOBALS{'sfmground_floodlightavglux'} = $GLOBALS{'sfmfloodlightvisit_avglux'};
    $GLOBALS{'sfmground_floodlightavgluxreqd'} = $GLOBALS{'sfmfloodlightvisit_avgluxreqd'};
    $GLOBALS{'sfmground_floodlightminlux'} = $GLOBALS{'sfmfloodlightvisit_minlux'};
    $GLOBALS{'sfmground_floodlightmaxlux'} = $GLOBALS{'sfmfloodlightvisit_maxlux'};
    $GLOBALS{'sfmground_floodlightminmaxlux'} = $GLOBALS{'sfmfloodlightvisit_minmaxlux'};
    $GLOBALS{'sfmground_floodlightminmaxluxreqd'} = $GLOBALS{'sfmfloodlightvisit_minmaxluxreqd'};
    $GLOBALS{'sfmground_floodlightminavglux'} = $GLOBALS{'sfmfloodlightvisit_minavglux'};
    $GLOBALS{'sfmground_floodlightlampnotworking'} = $GLOBALS{'sfmfloodlightvisit_lampnotworking'};
    
    // ====== any changes to pitch specifications ======================
    $GLOBALS{'sfmground_pitchorientation'} = $GLOBALS{'sfmfloodlightvisit_pitchorientation'};
    $GLOBALS{'sfmground_dugoutposition'} = $GLOBALS{'sfmfloodlightvisit_dugoutposition'};
    $GLOBALS{'sfmground_sfmpitchtypeid'} = $GLOBALS{'sfmfloodlightvisit_sfmpitchtypeid'};
    $GLOBALS{'sfmground_pitchlength'} = $GLOBALS{'sfmfloodlightvisit_pitchlength'};
    $GLOBALS{'sfmground_pitchwidth'} = $GLOBALS{'sfmfloodlightvisit_pitchwidth'};
    
    // ====== any changes to floodlight condition ======================
    $GLOBALS{'sfmground_floodlightgeneralconditionrag'} = $GLOBALS{'sfmfloodlightvisit_generalconditionrag'};
    $GLOBALS{'sfmground_floodlightcolumnrag'} = $GLOBALS{'sfmfloodlightvisit_columnrag'};
    $GLOBALS{'sfmground_floodlightcolumnrag'} = $GLOBALS{'sfmfloodlightvisit_columnrag'};
    $GLOBALS{'sfmground_floodlightfixturerag'} = $GLOBALS{'sfmfloodlightvisit_fixturerag'};
    $GLOBALS{'sfmground_floodlightelectricsrag'} = $GLOBALS{'sfmfloodlightvisit_electricsrag'};
    $GLOBALS{'sfmground_floodlightspillluxrag'} = $GLOBALS{'sfmfloodlightvisit_spillluxrag'};
    
    if ($inspecificationchanged == "Yes") {
        // ====== any changes to floodlight specification ======================
        $GLOBALS{'sfmground_floodlightcolumnqty'} = $GLOBALS{'sfmfloodlightvisit_columnqty'};
        $GLOBALS{'sfmground_floodlightcolumnheight'} = $GLOBALS{'sfmfloodlightvisit_columnheight'};
        $GLOBALS{'sfmground_floodlightcolumntypeid'} = $GLOBALS{'sfmfloodlightvisit_columntypeid'};
        $GLOBALS{'sfmground_floodlightfixtureqty'} = $GLOBALS{'sfmfloodlightvisit_fixtureqty'};
        $GLOBALS{'sfmground_floodlightcolumnmanufacturerid'} = $GLOBALS{'sfmfloodlightvisit_columnmanufacturerid'};
        $GLOBALS{'sfmground_floodlightcolumninstalldate'} = $GLOBALS{'sfmfloodlightvisit_columninstalldate'};
        $GLOBALS{'sfmground_floodlightfixturetypeid'} = $GLOBALS{'sfmfloodlightvisit_fixturetypeid'};
        $GLOBALS{'sfmground_floodlightfixturemanufacturerid'} = $GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'};
        $GLOBALS{'sfmground_floodlightfixtureinstalldate'} = $GLOBALS{'sfmfloodlightvisit_fixtureinstalldate'};
        $GLOBALS{'sfmground_floodlightlamptypeid'} = $GLOBALS{'sfmfloodlightvisit_lamptypeid'};
        
        // ====== further changes to floodlight specification (desktop only) ======================
        
        $GLOBALS{'sfmground_floodlightcolumnreplacementdate'} = $GLOBALS{'sfmfloodlightvisit_columnreplacementdate'};
        $GLOBALS{'sfmground_floodlightfixturereplacementdate'} = $GLOBALS{'sfmfloodlightvisit_fixturereplacementdate'};
        $GLOBALS{'sfmground_floodlightelectricsreplacementdate'} = $GLOBALS{'sfmfloodlightvisit_electricsreplacementdate'};  
        
        // ====== update specification records ======================
        Check_Data('sfmfloodlightcolumn', $GLOBALS{'sfmclub_groundidlist'}, "0");
        $GLOBALS{'sfmfloodlightcolumn_qty'} = $GLOBALS{'sfmfloodlightvisit_columnqty'};
        $GLOBALS{'sfmfloodlightcolumn_columnheight'} = $GLOBALS{'sfmfloodlightvisit_columnheight'};
        $GLOBALS{'sfmfloodlightcolumn_columntypeid'} = $GLOBALS{'sfmfloodlightvisit_columntypeid'};
        $GLOBALS{'sfmfloodlightcolumn_fixtureqty'} = $GLOBALS{'sfmfloodlightvisit_fixtureqty'};
        $GLOBALS{'sfmfloodlightcolumn_columninstalldate'} = $GLOBALS{'sfmfloodlightvisit_columninstalldate'};
        $GLOBALS{'sfmfloodlightcolumn_columnreplacementdate'} = $GLOBALS{'sfmfloodlightvisit_columnreplacementdate'}; // desktop only
        Write_Data('sfmfloodlightcolumn', $GLOBALS{'sfmclub_groundidlist'}, "0");         
             
        Check_Data('sfmfloodlightelement', $GLOBALS{'sfmclub_groundidlist'}, "0", "0");       
        $GLOBALS{'sfmfloodlightelement_fixturetypeid'} = $GLOBALS{'sfmfloodlightvisit_fixturetypeid'};
        $GLOBALS{'sfmfloodlightelement_fixturemanufacturerid'} = $GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'};
        $GLOBALS{'sfmfloodlightelement_fixtureinstalldate'} = $GLOBALS{'sfmfloodlightvisit_fixtureinstalldate'};
        $GLOBALS{'sfmfloodlightelement_fixturereplacementdate'} = $GLOBALS{'sfmfloodlightvisit_fixturereplacementdate'}; // desktop only
        $GLOBALS{'sfmfloodlightelement_lamptypeid'} = $GLOBALS{'sfmfloodlightvisit_lamptypeid'};
        Write_Data('sfmfloodlightelement', $GLOBALS{'sfmclub_groundidlist'}, "0", "0");
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
        
    Write_Data('sfmground', $insfmfloodlightvisit_sfmgroundid);
    Write_Data('sfmfloodlightvisit', $insfmfloodlightvisit_sfmgroundid, $thissfmfloodlightvisit_id);
    // XPTXT($insfmfloodlightvisit_sfmgroundid." ".$thissfmfloodlightvisit_id);
    
    XPTXTCOLOR("Updates applied","green");
    
    SFM_SFMFLOODLIGHTVISIT_Output($insfmclub_id,$insfmfloodlightvisit_sfmgroundid,$thissfmfloodlightvisit_id,$incurrenttab);
}

if ($insubmitaction == "FloodlightSpecification"){
    Check_Data('sfmclub', $insfmclub_id);
    SFM_SFMFLOODLIGHTSPECIFICATION_Output($insfmclub_id,$GLOBALS{'sfmclub_groundidlist'});
}

Back_Navigator();PageFooter("Default","Final");
?>

