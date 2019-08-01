<?php 
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$recsep = chr(135); // double cross
$fieldsep = chr(134); // dagger  

$setuppersonid = $_REQUEST["SetupPersonId"];
$setuppersonpsw = $_REQUEST["SetupPersonPsw"];

// ============ download person data=========================

$validperson = "0";
$setuppersonid = emailtolower($setuppersonid);
Check_Data('person',$setuppersonid);
if ($GLOBALS{'IOWARNING'} == "0") {	    
    $clearpsw = $setuppersonpsw;
    $encmembpsw = XCrypt($setuppersonpsw,$setuppersonid,"encrypt");
    if ($encmembpsw == $GLOBALS{'person_password'}) {
        $tstring = $GLOBALS{'person'."^FIELDS"};
        $tfields = explode('|', $tstring);
        $datastring = "person_downloadheader";
        foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$tfieldelement; }
        print "$datastring".$recsep;
        $datastring = "person_downloaddata";
        foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$GLOBALS{$tfieldelement};}
        print "$datastring".$recsep;
        $validperson = "1";
    }
}

// ============ download service user data=========================

if ($validperson == "0") {
    // print "person_downloaddata".$fieldsep.$setuppersonid." ".$setuppersonpsw." ".$encmembpsw." Invalid PersonId or Password".$recsep;
    print "person_downloaddata".$fieldsep." Invalid PersonId or Password".$recsep;
} else {

    $synchdowndmwssua = Array();
    
    $dmwssua = Get_Array('dmwssu');
    foreach ($dmwssua as $dmwssu_id) {
        Get_Data('dmwssu',$dmwssu_id);        
        /*
        $include = "0";
        if (($GLOBALS{'dmwssu_casecloseddate'} == "" )||($GLOBALS{'dmwssu_casecloseddate'} == "0000-00-00" )) {
            $dmwscontractlocationa = Get_Array('dmwscontractlocation');
            foreach ($dmwscontractlocationa as $dmwscontractlocation_id) {
                if ( $dmwscontractlocation_id == $GLOBALS{'dmwssu_dmwscontractlocationid'}) {
                    Get_Data('dmwscontractlocation',$dmwscontractlocation_id);
                    // XPTXT("MATCH|".$GLOBALS{'LOGIN_person_id'}.$recsep.$GLOBALS{'dmwscontractlocation_officerlist'}.$recsep);
                    if ( FoundInCommaList( $setuppersonid, $GLOBALS{'dmwscontractlocation_officerlist'} ) ) { $include = "1"; }
                    if ( FoundInCommaList( $setuppersonid, $GLOBALS{'dmwscontractlocation_mgrlist'} ) ) { $include = "1"; }
                }
            }
        }
        if ( $include == "1" ) { array_push($synchdowndmwssua, $dmwssu_id); }
        */
        $includeperson = "0";
        if (($GLOBALS{'dmwssu_casecloseddate'} == "" )||($GLOBALS{'dmwssu_casecloseddate'} == "0000-00-00" )) {
            if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwssu_wopersonid'}) ) { $includeperson = "1"; }
            if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwssu_otherwopersonidlist'}) ) { $includeperson = "1"; }
        }
        if ( $includeperson == "1" ) {
            $includeloc = "0";
            Check_Data('dmwscontractlocation',$GLOBALS{'dmwssu_dmwscontractlocationid'});
            if ($GLOBALS{'IOWARNING'} == "0") {
                // XPTXT("MATCH|".$GLOBALS{'LOGIN_person_id'}.$recsep.$GLOBALS{'dmwscontractlocation_officerlist'}.$recsep);
                if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_officerlist'} ) ) { $includeloc = "1"; }
                if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_mgrlist'} ) ) { $includeloc = "1"; }
                if ( $includeloc == "1" ) {
                    array_push($synchdowndmwssua, $dmwssu_id);
                }
            }
        }        
    }
    
    $tstring = $GLOBALS{'dmwssu'."^FIELDS"};
    $tfields = explode('|', $tstring);
    $datastring = "dmwssu_downloadheader";
    foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$tfieldelement; }
    print "$datastring".$recsep;
    $dmwssua = Get_Array('dmwssu');
    foreach ($dmwssua as $dmwssu_id) {
        Get_Data('dmwssu',$dmwssu_id);
        $GLOBALS{"dmwssu_clientupdatetimestamp"} = "";
        if (in_array($dmwssu_id, $synchdowndmwssua)) {
            $datastring = "dmwssu_downloaddata";
            foreach ($tfields as $tfieldelement) {
                $datastring = $datastring.$fieldsep.$GLOBALS{$tfieldelement};
            }
            print "$datastring".$recsep;
        }
    }
    
    $tstring = $GLOBALS{'dmwssux'."^FIELDS"};
    $tfields = explode('|', $tstring);
    $datastring = "dmwssux_downloadheader";
    foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$tfieldelement; }
    print "$datastring".$recsep;
    $dmwssuxa = Get_Array('dmwssux');
    foreach ($dmwssuxa as $dmwssux_id) {
        Get_Data('dmwssux',$dmwssux_id);
        if (in_array($dmwssux_id, $synchdowndmwssua)) {
            $datastring = "dmwssux_downloaddata";
            foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$GLOBALS{$tfieldelement};}
            print "$datastring".$recsep;
        }
    }
    
    $relatedtablea = array ("dmwsvisit","dmwsserviceprovided","dmwsreferrerupdate","dmwsconsentwithdrawal","dmwsaction","dmwsreferral","dmwsprogress","dmwswellbeing","dmwscomplexity");
    
    foreach ($relatedtablea as $relatedtable) {
        $tstring = $GLOBALS{$relatedtable."^FIELDS"};
        $tfields = explode('|', $tstring);
        $datastring = $relatedtable."_downloadheader";
        foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$tfieldelement; }
        print "$datastring".$recsep;
        foreach ($synchdowndmwssua as $thisdmwssu_id) {
            $relatedtableida = Get_Array($relatedtable,$thisdmwssu_id);
            foreach ($relatedtableida as $relatedtable_id) {
                Get_Data($relatedtable,$thisdmwssu_id,$relatedtable_id);
                $datastring = $relatedtable."_downloaddata";
                foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$GLOBALS{$tfieldelement};}
                print "$datastring".$recsep;
            }
        }
    }
    
    $reftablelist = "dmwstitle,dmwsgender,dmwscontract,dmwsservice,dmwsservicestatus,dmwslocationtype,dmwscontractlocation,dmwssafeguardingissuetype,dmwswosafeguardingissuetype,dmwssafeguardeetype,dmwssafeguardeereasontype,";
    $reftablelist = $reftablelist."dmwseqdivbuttons,dmwsdisabilitytype,dmwsprimarycaretype,dmwssecondarycaretype,dmwsindependentlivingtype,dmwssocialisolationtype,";
    $reftablelist = $reftablelist."dmwsemploymenttype,dmwssupportcommunicationtype,dmwseventscommunicationtype,dmwsreportcommunicationtype,dmwscaringresponsibilitytype,dmwsmodspecifictype,";
    $reftablelist = $reftablelist."dmwsadmissiontype,dmwsadmissionreason,dmwsservicetype,dmwssufeedbacktype,dmwsreferralorg,dmwscontacttype,dmwsconsentwithdrawaltype,dmwsspecialistreferralorg,";
    $reftablelist = $reftablelist."dmwsvisitlocation,dmwstimeband,dmwscomplexitytype,dmwssupporttype,dmwsreferrerorgtype,dmwsoccupationalissuetype,dmwspreviousoccupationtype";
    
    $reftablea = List2Array($reftablelist);
    
    foreach ($reftablea as $reftable) {
        $tstring = $GLOBALS{$reftable."^FIELDS"};
        $tfields = explode('|', $tstring);
        $datastring = $reftable."_downloadheader";
        foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$tfieldelement; }
        print "$datastring".$recsep;   
        $reftableida = Get_Array($reftable);
        foreach ($reftableida as $reftable_id) {
            Get_Data($reftable,$reftable_id);
            $datastring = $reftable."_downloaddata";
            foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$GLOBALS{$tfieldelement};}
            print "$datastring".$recsep;
        }
    }
}
    
?>