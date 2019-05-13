<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMFLOODLIGHTSPECIFICATION_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmground_id = $_REQUEST['sfmground_id'];
$insubmitaction = $_REQUEST['SubmitAction'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});

if ($insubmitaction == "Save") {
    Check_Data('sfmclub', $insfmclub_id);
    Check_Data('sfmground',$insfmground_id);
    Check_Data('sfmfloodlightcolumn',$insfmground_id,"0");
    if ($GLOBALS{'IOWARNING'} == "1") {  
        Initialise_Data('sfmfloodlightcolumn');
        Write_Data('sfmfloodlightcolumn',$insfmground_id,"0");
        XPTXTCOLOR("New Floodlight Specification","green");
    }
    
    foreach ( $_REQUEST as $keystring => $v ) {     
        $keybits = explode("_",$keystring);
        $fieldname = $keybits[0]."_".$keybits[1]; 

        /*
        if ($GLOBALS{'LOGIN_person_id'} == "bbra") {
            if (($keybits[0] == "sfmfloodlightcolumn")||($keybits[0] == "sfmfloodlightelement")) {
                XPTXTCOLOR($keystring." => ".$v,"orange"); 
            }
        }
        */
        
        if ($keybits[0] == "sfmfloodlightcolumn") {
            // sfmfloodlightcolumn_fieldname_colid
            // sfmfloodlightcolumn_fieldname_colid_dd/mm/yyyy
            if ($keybits[1] == "startfield") {
                $thiscolid = $keybits[2];
                if ($thiscolid == "") {$thiscolid = "0";}
                Check_Data('sfmfloodlightcolumn',$insfmground_id,$thiscolid);
                // XPTXT('READ sfmfloodlightcolumn'." ".$insfmground_id." ".$thiscolid);
            }	           
            if (sizeOf($keybits) == 3) { # normal
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
            if (sizeOf($keybits) == 4) { # Multipart field
                if ($keybits[3] == "imagename") {
                    $GLOBALS{$fieldname} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{$fieldname},$v);
                    // XPTXT("imagename ".$fieldname." ".$GLOBALS{$fieldname});
                }
                if ($keybits[3] == "dd/mm/yyyy") {
                    $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
                }
                if ($keybits[3] == "DDpart") {$ddpart = $v;}
                if ($keybits[3] == "MMpart") {$mmpart = $v;}
                if ($keybits[3] == "YYYYpart") {$yyyypart = $v; $GLOBALS{$fieldname} = $yyyypart."-".$mmpart."-".$ddpart;}
                if ($keybits[3] == "CODEpart") {$codepart = $v;}
                if ($keybits[3] == "NUMpart") {$numpart = $v; $GLOBALS{$fieldname} = $codepart." ".$numpart; }
                // XPTXT( $fieldname." = ".$v );
            }
            
            if ($keybits[1] == "endfield") {
                XPTXT('WRITE sfmfloodlightcolumn'." ".$insfmground_id." ".$thiscolid);
                Write_Data('sfmfloodlightcolumn',$insfmground_id,$thiscolid);
                if ( $thiscolid == "0") {
                    $GLOBALS{'sfmground_floodlightcolumnqty'} = $GLOBALS{'sfmfloodlightcolumn_qty'};
                    $GLOBALS{'sfmground_floodlightcolumnheight'} = $GLOBALS{'sfmfloodlightcolumn_columnheight'};
                    $GLOBALS{'sfmground_floodlightcolumntypeid'} = $GLOBALS{'sfmfloodlightcolumn_columntypeid'};
                    $GLOBALS{'sfmground_floodlightcolumnmanufacturerid'} = $GLOBALS{'sfmfloodlightcolumn_columnmanufacturerid'};
                    $GLOBALS{'sfmground_floodlightcolumninstalldate'} = $GLOBALS{'sfmfloodlightcolumn_columninstalldate'};
                    $GLOBALS{'sfmground_floodlightcolumnupgradedate'} = $GLOBALS{'sfmfloodlightcolumn_columnupgradedate'};
                    $GLOBALS{'sfmground_floodlightcolumnreplacementdate'} = $GLOBALS{'sfmfloodlightcolumn_columnreplacementdate'};
                    $GLOBALS{'sfmground_floodlightfixtureqty'} = $GLOBALS{'sfmfloodlightcolumn_fixtureqty'};
                    $GLOBALS{'sfmground_floodlightprimemanufacturerid'} = $GLOBALS{'sfmfloodlightcolumn_columnmanufacturerid'};
                    $GLOBALS{'sfmground_floodlightprimecontractorid'} = $GLOBALS{'sfmfloodlightcolumn_columncontractorid'};
                    $GLOBALS{'sfmground_floodlightinstalldate'} = $GLOBALS{'sfmfloodlightcolumn_columninstalldate'};
                    $GLOBALS{'sfmground_floodlightupgradedate'} = $GLOBALS{'sfmfloodlightcolumn_columnupgradedate'};
                    $GLOBALS{'sfmground_floodlightreplacementdate'} = $GLOBALS{'sfmfloodlightcolumn_columnreplacementdate'};              
                    Write_Data('sfmground',$insfmground_id);
                    XPTXT("Ground column data updated");
                }                
            }
        }
        
        if ($keybits[0] == "sfmfloodlightelement") {
            // sfmfloodlightelement_fieldname_colid_elementid  
            // sfmfloodlightelement_fieldname_colid_elementid_dd/mm/yyyy
            if ($keybits[1] == "startfield") {
                $thiscolid = $keybits[2];
                $thiselementid = $keybits[3];
                Check_Data("sfmfloodlightelement",$insfmground_id,$thiscolid,$thiselementid);
                // XPTXT('read sfmfloodlightelement'." ".$insfmground_id." ".$thiscolid." ".$thiselementid);
            }	
            if (sizeOf($keybits) == 4) { # normal
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
            if (sizeOf($keybits) == 5) { # Multipart field
                if ($keybits[4] == "imagename") {
                    $GLOBALS{$fieldname} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{$fieldname},$v);
                }
                if ($keybits[4] == "dd/mm/yyyy") {
                    $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
                }
                if ($keybits[4] == "DDpart") {$ddpart = $v;}
                if ($keybits[4] == "MMpart") {$mmpart = $v;}
                if ($keybits[4] == "YYYYpart") {$yyyypart = $v; $GLOBALS{$fieldname} = $yyyypart."-".$mmpart."-".$ddpart;}
                if ($keybits[4] == "CODEpart") {$codepart = $v;}
                if ($keybits[4] == "NUMpart") {$numpart = $v; $GLOBALS{$fieldname} = $codepart." ".$numpart; }
                // XPTXT( $fieldname." = ".$v );
            }
            if ($keybits[1] == "endfield") {
                Write_Data('sfmfloodlightelement',$insfmground_id,$thiscolid,$thiselementid);
                XPTXT('WRITE sfmfloodlightelement'." ".$insfmground_id." ".$thiscolid,$thiselementid);                
                if (($thiscolid == "0")&&($thiselementid == "0")) {
                    $GLOBALS{'sfmground_floodlightfixturetypeid'} = $GLOBALS{'sfmfloodlightelement_fixturetypeid'};
                    $GLOBALS{'sfmground_floodlightfixturemanufacturerid'} = $GLOBALS{'sfmfloodlightelement_fixturemanufacturerid'};
                    $GLOBALS{'sfmground_floodlightfixtureinstalldate'} = $GLOBALS{'sfmfloodlightelement_fixtureinstalldate'};
                    $GLOBALS{'sfmground_floodlightfixtureupgradedate'} = $GLOBALS{'sfmfloodlightelement_fixtureupgradedate'};
                    $GLOBALS{'sfmground_floodlightfixturereplacementdate'} = $GLOBALS{'sfmfloodlightelement_fixturereplacementdate'};
                    $GLOBALS{'sfmground_floodlightlamptypeid'} = $GLOBALS{'sfmfloodlightelement_lamptypeid'};
                    $GLOBALS{'sfmground_floodlightlampinstalldate'} = $GLOBALS{'sfmfloodlightelement_lampinstalldate'};
                    $GLOBALS{'sfmground_floodlightlampupgradedate'} = $GLOBALS{'sfmfloodlightelement_lampupgradedate'};
                    $GLOBALS{'sfmground_floodlightlampreplacementdate'} = $GLOBALS{'sfmfloodlightelement_lampreplacementdate'};
                    Write_Data('sfmground',$insfmground_id);
                    XPTXT("Ground fixture data updated");
                }    
            }
        }   
    }

    XPTXTCOLOR("Floodlight Specification updates applied","green");
    SFM_SFMFLOODLIGHTSPECIFICATION_Output($insfmclub_id,$insfmground_id);
}

if ($insubmitaction == "ReplicateSpec"){   
    SFMREPLICATESPEC($insfmground_id);
    XPTXTCOLOR("Detailed Specification Created","green");   
    SFM_SFMFLOODLIGHTSPECIFICATION_Output($insfmclub_id,$insfmground_id);
}

if ($insubmitaction == "DeReplicateSpec"){
    SFMDEREPLICATESPEC($insfmground_id);
    XPTXTCOLOR("Detailed Specification Removed","green"); 
    SFM_SFMFLOODLIGHTSPECIFICATION_Output($insfmground_id);
}

Back_Navigator();PageFooter("Default","Final");
?>

