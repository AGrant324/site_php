<<<<<<< HEAD
<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');
require_once('v1_libraryroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$insfmclub_id = $GLOBALS{'LOGIN_org_id'};
if((isset($_REQUEST['sfmclub_id'])&&$_REQUEST['sfmclub_id']!="")) {
    $insfmclub_id = $_REQUEST['sfmclub_id'];
}
$insfmfacility_id = "";
if((isset($_REQUEST['sfmfacility_id'])&&$_REQUEST['sfmfacility_id']!="")) {
    $insfmfacility_id = $_REQUEST['sfmfacility_id'];
}
$indatascope = $_REQUEST['DataScope'];
$insubmitaction = $_REQUEST['SubmitAction'];
$incurrenttab = $_REQUEST['CurrentTab'];

if ($insubmitaction == "Save") { SFM_SFMCLUBUPDATE_CSSJS(); }
if ($insubmitaction == "GroundGrading") { SFM_SFMGROUNDGRADING_CSSJS(); }
if ($insubmitaction == "FloodlightSpecification") { SFM_SFMFLOODLIGHTSPECIFICATION_CSSJS(); }

$GLOBALS{'dashboardsectionsprovided'} = "1";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

if ($insubmitaction == "Save") {

    Check_Data('sfmclub', $insfmclub_id);
    if ($GLOBALS{'IOWARNING'} == "1") {
        Initialise_Data('sfmclub');
        $GLOBALS{'sfmclub_id'} = $insfmclub_id;
    }
    if ( $insfmfacility_id != "") {
        Check_Data('sfmfacility', $insfmfacility_id); 
    }
    
    $clubchanged = "0";
    $facilitychanged = "0";
    
    foreach ( $_REQUEST as $keystring => $v ) {
        // if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XPTXTCOLOR($keystring." => ".$v,"orange"); }
        $keybits = explode("_",$keystring);
        $fieldname = $keybits[0]."_".$keybits[1];
        
        if ($keybits[0] == "sfmclub") {
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
            $clubchanged = "1";
        }
        
        if ($keybits[0] == "sfmclubperson") { // people with access to Club Records
            if ($keybits[1] == "startfield") {
                $sfmclubperson_ts = $keybits[2];
                Initialise_Data('person');
                $GLOBALS{$fieldname} = $v;
            }
            if (sizeOf($keybits) == 3) { # normal
                $GLOBALS{$fieldname} = $v;
            }

            // XPTXT( $fieldname." = ".$v );
            
            if ($keybits[1] == "endfield") {
                
                $sfmclubperson_ts = $keybits[2];
                
                
                if (substr($sfmclubperson_ts,0,3) == "NEW") {
                    // New name
                    $persona = Get_Array('person');
                    $anyfound = "0";
                    foreach ($persona as $tperson_id) {
                        Get_Data("person",$tperson_id);
                        $testperson_email1 = strtolower($GLOBALS{'person_email1'});
                        $found = "0";
                        if ($inmatchemail1 == $testperson_email1) {
                            $found = "1";
                            $anyfound = "1";
                        }
                        if ($found == "1") {
                            XH5($GLOBALS{'person_email1'}.' already exists.');
                        }
                    }
                    if ($anyfound == "1") {
                        XTXTCOLOR("Error - this name already exists.","red");
                    }
                    $tempsname = str_replace("'", "", $inmatchsname."999");
                    $tempsname = str_replace(" ", "", $tempsname."999");
                    $tempfname = str_replace("'", "", $inmatchfname."999");
                    $tempfname = str_replace(" ", "", $tempfname."999");
                    $snamebits = str_split($tempsname);
                    $fnamebits = str_split($tempfname);
                    $newspace = "0";
                    $n = "";
                    while ($newspace == "0") {
                        $newperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
                        $newperson_id = strtolower($newperson_id);
                        $lookupnewperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
                        Check_Data("person",$lookupnewperson_id);
                        if ($GLOBALS{'IOWARNING'} == "0") {
                            if ($n == "") { $n = "1"; } else { ++$n; }
                        } else {
                            $newspace = "1";
                        }
                    }
                    // Person_ADD2_Output($window,$newperson_id,$inperson_fname,$inperson_sname,"");
                    
                    
                } else {
                    // Existing name
                    Check_Data('person',$sfmclubperson_ts);
                    if ($GLOBALS{'IOWARNING'} == "1") {
                        Initialise_Data('person');
                        // XPTXT('Initialise_Data - dmwsaction '." = ".$dmwsaction_ts);
                        $GLOBALS{'dmwsaction_dmwssuid'} = $thisdmwssu_id;
                        $GLOBALS{'dmwsaction_id'} = $dmwsaction_ts;

                    } else {

                    }

                }

                array_push($newsfmclubperson_ida,$sfmclubperson_ts);
                
                Check_Data('person',$sfmclubperson_ts);
                if ($GLOBALS{'IOWARNING'} == "1") {
                    Initialise_Data('person');
                    // XPTXT('Initialise_Data - dmwsaction '." = ".$dmwsaction_ts);
                    $GLOBALS{'dmwsaction_dmwssuid'} = $thisdmwssu_id;
                    $GLOBALS{'dmwsaction_id'} = $dmwsaction_ts;
                    
                    
                    
                } else {
                    
                    
                    
                    
                }
                Write_Data('person',$sfmclubperson_ts);
                // XPTXT('Write_Data - person '." = ".$sfmclubperson_ts);
            }
        }
        
        if ($keybits[0] == "sfmfacility") {
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
            $facilitychanged = "1";
        }
     
    }
    
    // $GLOBALS{'dmwssu_clientupdatetimestamp'} = $timestamp;
    if ( $clubchanged == "1" ) { Write_Data('sfmclub', $insfmclub_id); }
    if ( ($insfmfacility_id != "")&&($facilitychanged == "1") ) { Write_Data('sfmfacility', $insfmfacility_id); }

    BSECTION(); BSECTIONROW();
    XPTXTCOLOR("Updates applied","green");
    B_SECTIONROW();B_SECTION();
    
    if ( $indatascope == "Multi" ) { SFM_SFMCLUBUPDATEMULTI_Output($insfmclub_id,$insfmfacility_id,"CLUB"); }
    if ( $indatascope == "Club" ) { SFM_SFMCLUBUPDATECLUB_Output($insfmclub_id); }   
    if ( $indatascope == "Facility" ) { SFM_SFMCLUBUPDATEFACILITY_Output($insfmclub_id,$insfmfacility_id); }    
    if ( $indatascope == "Ground" ) { SFM_SFMCLUBUPDATEGROUND_Output($insfmclub_id,$insfmfacility_id); }
    if ( $indatascope == "Flood" ) { SFM_SFMCLUBUPDATEFLOOD_Output($insfmclub_id,$insfmfacility_id); }
    
}
        
if ($insubmitaction == "GroundGrading"){
    $insfmfacility_gradingtarget = $_REQUEST['sfmfacility_gradingtarget'];
    Check_Data('sfmclub', $insfmclub_id);
    Check_Data('accredcriteria',$insfmfacility_gradingtarget,$insfmfacility_id,"a_01");
    if ($GLOBALS{'IOWARNING'} == "1" ) {
        // Setup New Ground Grading records
        BSECTION(); BSECTIONROW(); BCOLCARD("12");
        XH2("New Ground Grading Self Assessment - ".$insfmfacility_gradingtarget);
        Check_Data('accredscheme',$insfmfacility_gradingtarget);
        $accredcriteriaa = Get_Array('accredcriteria',$insfmfacility_gradingtarget,$GLOBALS{'LOGIN_domain_id'});
        foreach ($accredcriteriaa as $accredcriteria_id) {
            Get_Data('accredcriteria',$insfmfacility_gradingtarget,$GLOBALS{'LOGIN_domain_id'},$accredcriteria_id);
            Write_Data('accredcriteria',$insfmfacility_gradingtarget,$insfmfacility_id,$accredcriteria_id);
            // XPTXTCOLOR($accredcriteria_id." ".$GLOBALS{'accredcriteria_type'}." - Created","orange");
        }
        XPTXTCOLOR("New Ground Grading Checklist for ".$GLOBALS{'accredscheme_name'}." created","green");
        
        $foundothers = "0";
        $accredschemea = Get_Array('accredscheme');
        foreach ($accredschemea as $accredscheme_id) {        
            if ($accredscheme_id != $insfmfacility_gradingtarget) {
                $foundothers = "1";
            }
        }         
        if ( $foundothers = "1" ) {
            XH3("Copy information from a previous checklist?");
            XPTXT("Please select information to be carried forward to the new assessment.");
            XBR();
            $foundothers = "0";
            $accredschemea = Get_Array('accredscheme');
            foreach ($accredschemea as $accredscheme_id) {        
                if ($accredscheme_id != $insfmfacility_gradingtarget) {
                    Check_Data('accredcriteria',$accredscheme_id,$insfmfacility_id,"a_01");
                    if ($GLOBALS{'IOWARNING'} == "0" ) {
                        Check_Data('accredscheme',$accredscheme_id);
                        $link = YPGMLINK("sfmgroundgradingresponsecopy.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$insfmclub_id).YPGMPARM("sfmfacility_id",$insfmfacility_id).YPGMPARM("accredscheme_id",$insfmfacility_gradingtarget).YPGMPARM("fromaccredscheme_id",$accredscheme_id);
                        XBR(); XLINKTXT($link,"Copy responses from ".$GLOBALS{'accredscheme_name'}." self assessment"); 
                        $foundothers = "1";
                    }
                }
            } 
            $link = YPGMLINK("sfmgroundgradingresponsecopy.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$insfmclub_id).YPGMPARM("sfmfacility_id",$insfmfacility_id).YPGMPARM("accredscheme_id",$insfmfacility_gradingtarget).YPGMPARM("fromaccredscheme_id","NoCopy");
            XBR(); XLINKTXT($link,"Don't copy any previous responses."); 
            B_COLCARD();B_SECTIONROW();B_SECTION();
        } else {
            SFM_SFMGROUNDGRADING_Output($insfmclub_id,$insfmfacility_id,$insfmfacility_gradingtarget);    
        }
    } else {
        SFM_SFMGROUNDGRADING_Output($insfmclub_id,$insfmfacility_id,$insfmfacility_gradingtarget);
    }
}

if ($insubmitaction == "FloodlightSpecification"){
    Check_Data('sfmclub', $insfmclub_id);
    SFM_SFMFLOODLIGHTSPECIFICATION_Output($insfmclub_id,$GLOBALS{'sfmclub_sfmfacilityidlist'});
}

Back_Navigator();
PageFooter("Default","Final");
?>

=======
<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');
require_once('v1_libraryroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insubmitaction = $_REQUEST['SubmitAction'];
$incurrenttab = $_REQUEST['CurrentTab'];

if ($insubmitaction == "Save") { SFM_SFMCLUBUPDATE_CSSJS(); }
if ($insubmitaction == "GroundGrading") { SFM_SFMGROUNDGRADING_CSSJS(); }
if ($insubmitaction == "FloodlightSpecification") { SFM_SFMFLOODLIGHTSPECIFICATION_CSSJS(); }

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

if ($insubmitaction == "Save") {

    Check_Data('sfmclub', $insfmclub_id);
    if ($GLOBALS{'IOWARNING'} == "1") {
        Initialise_Data('sfmclub');
        $GLOBALS{'sfmclub_id'} = $insfmclub_id;
    }
    Check_Data('sfmground', $GLOBALS{'sfmclub_groundidlist'});
    
    foreach ( $_REQUEST as $keystring => $v ) {
        // if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XPTXTCOLOR($keystring." => ".$v,"orange"); }
        $keybits = explode("_",$keystring);
        $fieldname = $keybits[0]."_".$keybits[1];
        
        if ($keybits[0] == "sfmclub") {
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
        
        if ($keybits[0] == "sfmclubperson") { // people with access to Club Records
            if ($keybits[1] == "startfield") {
                $sfmclubperson_ts = $keybits[2];
                Initialise_Data('person');
                $GLOBALS{$fieldname} = $v;
            }
            if (sizeOf($keybits) == 3) { # normal
                $GLOBALS{$fieldname} = $v;
            }

            // XPTXT( $fieldname." = ".$v );
            
            if ($keybits[1] == "endfield") {
                
                $sfmclubperson_ts = $keybits[2];
                
                
                if (substr($sfmclubperson_ts,0,3) == "NEW") {
                    // New name
                    $persona = Get_Array('person');
                    $anyfound = "0";
                    foreach ($persona as $tperson_id) {
                        Get_Data("person",$tperson_id);
                        $testperson_email1 = strtolower($GLOBALS{'person_email1'});
                        $found = "0";
                        if ($inmatchemail1 == $testperson_email1) {
                            $found = "1";
                            $anyfound = "1";
                        }
                        if ($found == "1") {
                            XH5($GLOBALS{'person_email1'}.' already exists.');
                        }
                    }
                    if ($anyfound == "1") {
                        XTXTCOLOR("Error - this name already exists.","red");
                    }
                    $tempsname = str_replace("'", "", $inmatchsname."999");
                    $tempsname = str_replace(" ", "", $tempsname."999");
                    $tempfname = str_replace("'", "", $inmatchfname."999");
                    $tempfname = str_replace(" ", "", $tempfname."999");
                    $snamebits = str_split($tempsname);
                    $fnamebits = str_split($tempfname);
                    $newspace = "0";
                    $n = "";
                    while ($newspace == "0") {
                        $newperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
                        $newperson_id = strtolower($newperson_id);
                        $lookupnewperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
                        Check_Data("person",$lookupnewperson_id);
                        if ($GLOBALS{'IOWARNING'} == "0") {
                            if ($n == "") { $n = "1"; } else { ++$n; }
                        } else {
                            $newspace = "1";
                        }
                    }
                    // Person_ADD2_Output($window,$newperson_id,$inperson_fname,$inperson_sname,"");
                    
                    
                } else {
                    // Existing name
                    Check_Data('person',$sfmclubperson_ts);
                    if ($GLOBALS{'IOWARNING'} == "1") {
                        Initialise_Data('person');
                        // XPTXT('Initialise_Data - dmwsaction '." = ".$dmwsaction_ts);
                        $GLOBALS{'dmwsaction_dmwssuid'} = $thisdmwssu_id;
                        $GLOBALS{'dmwsaction_id'} = $dmwsaction_ts;
                        
                        
                        
                    } else {
                        
                        
                        
                        
                    }
                    
                    
                    
                    
                }
                
                
                
                array_push($newsfmclubperson_ida,$sfmclubperson_ts);
                
                Check_Data('person',$sfmclubperson_ts);
                if ($GLOBALS{'IOWARNING'} == "1") {
                    Initialise_Data('person');
                    // XPTXT('Initialise_Data - dmwsaction '." = ".$dmwsaction_ts);
                    $GLOBALS{'dmwsaction_dmwssuid'} = $thisdmwssu_id;
                    $GLOBALS{'dmwsaction_id'} = $dmwsaction_ts;
                    
                    
                    
                } else {
                    
                    
                    
                    
                }
                Write_Data('person',$sfmclubperson_ts);
                // XPTXT('Write_Data - person '." = ".$sfmclubperson_ts);
            }
        }
        
        if ($keybits[0] == "sfmground") {
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
    
    // $GLOBALS{'dmwssu_clientupdatetimestamp'} = $timestamp;
    Write_Data('sfmclub', $insfmclub_id);
    Write_Data('sfmground', $GLOBALS{'sfmclub_groundidlist'});
    XPTXTCOLOR("Updates applied","green");
    SFM_SFMCLUBUPDATE_Output($insfmclub_id,"CLUB");
    
}
        
if ($insubmitaction == "GroundGrading"){
    $insfmground_gradingtarget = $_REQUEST['sfmground_gradingtarget'];
    Check_Data('sfmclub', $insfmclub_id);
    Check_Data('accredcriteria',$insfmground_gradingtarget,$insfmclub_id,"a_01");
    if ($GLOBALS{'IOWARNING'} == "1" ) {
        // Setup New Ground Grading records
        XH2("New Ground Grading Self Assessment - ".$insfmground_gradingtarget);
        Check_Data('accredscheme',$insfmground_gradingtarget);
        $accredcriteriaa = Get_Array('accredcriteria',$insfmground_gradingtarget,$GLOBALS{'LOGIN_domain_id'});
        foreach ($accredcriteriaa as $accredcriteria_id) {
            Get_Data('accredcriteria',$insfmground_gradingtarget,$GLOBALS{'LOGIN_domain_id'},$accredcriteria_id);
            Write_Data('accredcriteria',$insfmground_gradingtarget,$insfmclub_id,$accredcriteria_id);
            // XPTXTCOLOR($accredcriteria_id." ".$GLOBALS{'accredcriteria_type'}." - Created","orange");
        }
        XPTXTCOLOR("New Ground Grading Checklist for ".$GLOBALS{'accredscheme_name'}." created","green");
        
        $foundothers = "0";
        $accredschemea = Get_Array('accredscheme');
        foreach ($accredschemea as $accredscheme_id) {        
            if ($accredscheme_id != $insfmground_gradingtarget) {
                $foundothers = "1";
            }
        }         
        if ( $foundothers = "1" ) {
            XH3("Copy information from a previous checklist?");
            XPTXT("Please select information to be carried forward to the new assessment.");
            XBR();
            $foundothers = "0";
            $accredschemea = Get_Array('accredscheme');
            foreach ($accredschemea as $accredscheme_id) {        
                if ($accredscheme_id != $insfmground_gradingtarget) {
                    Check_Data('accredcriteria',$accredscheme_id,$insfmclub_id,"a_01");
                    if ($GLOBALS{'IOWARNING'} == "0" ) {
                        Check_Data('accredscheme',$accredscheme_id);
                        $link = YPGMLINK("sfmgroundgradingresponsecopy.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$insfmclub_id).YPGMPARM("accredscheme_id",$insfmground_gradingtarget).YPGMPARM("fromaccredscheme_id",$accredscheme_id);
                        XBR(); XLINKTXT($link,"Copy responses from ".$GLOBALS{'accredscheme_name'}." self assessment"); 
                        $foundothers = "1";
                    }
                }
            } 
            $link = YPGMLINK("sfmgroundgradingresponsecopy.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("accredscheme_id",$insfmground_gradingtarget).YPGMPARM("fromaccredscheme_id","NoCopy");
            XBR(); XLINKTXT($link,"Don't copy any previous responses.");   
        } else {
            SFM_SFMGROUNDGRADING_Output($insfmclub_id,$GLOBALS{'sfmclub_groundidlist'},$insfmground_gradingtarget);    
        }
    } else {
        SFM_SFMGROUNDGRADING_Output($insfmclub_id,$GLOBALS{'sfmclub_groundidlist'},$insfmground_gradingtarget);
    }
}

if ($insubmitaction == "FloodlightSpecification"){
    Check_Data('sfmclub', $insfmclub_id);
    SFM_SFMFLOODLIGHTSPECIFICATION_Output($insfmclub_id,$GLOBALS{'sfmclub_groundidlist'});
}

Back_Navigator();PageFooter("Default","Final");
?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
