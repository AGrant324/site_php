<<<<<<< HEAD
<?php 
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');


Get_Common_Parameters();
GlobalRoutine();

$recsep = chr(135); // double cross
$fieldsep = chr(134); // dagger  

// ============ upload reference and service user data =========================

$tablefielda = Array();
$refdownloadreqd = Array();
$testorreal = $_REQUEST["TestorReal"];
$synchupdata = $_REQUEST["SynchUpData"];

$synchupdataa = explode($recsep,$synchupdata);
foreach ($synchupdataa as $synchupdataelement) {    
    $fielddataa = explode($fieldsep,$synchupdataelement);
    $identifiera = explode("_",$fielddataa[0]);
    $thistable = $identifiera[0];
    $recordtype = $identifiera[1];
    
    if ( $recordtype == "uploadheader" ) { 
        $tablefielda[$thistable] = $synchupdataelement;
    }
    
    if ( $recordtype == "uploaddata" ) { 
        if ( $thistable == "dmwssu" ) {           
           $thisdmwssu_id = $fielddataa[2];
           if (strlen(strstr($thisdmwssu_id,"New"))>0) { 
               $newdmwssu_ida = Array();
               $olddmwssu_ida = Get_Array('dmwssu');
               $highestdmwssu_id = "SU00000";
               foreach ($olddmwssu_ida as $tdmwssu_id) {
                   if ( $tdmwssu_id > $highestdmwssu_id ) { $highestdmwssu_id = $tdmwssu_id; }
               }
               $highestdmwssu_seq = str_replace("SU", "", $highestdmwssu_id);
               $highestdmwssu_seq++;
               $thisdmwssu_id = "SU".substr(("00000".$highestdmwssu_seq), -5);
           } else {
                // ========== Clean out existing data for this case =============
                Check_Data("dmwssu",$thisdmwssu_id);
                if ($GLOBALS{'IOWARNING'} == "0") {
                    if ($testorreal == "R") { Delete_Data("dmwssu",$thisdmwssu_id); }
                    $datastring = "dmwssu"."_uploadstatus";
                    $datastring = $datastring.$fieldsep.$thisdmwssu_id;
                    $datastring = $datastring.$fieldsep."OK";
                    $datastring = $datastring.$fieldsep."Old Record Deleted Successfully";
                    print $datastring.$recsep;
                }
                Check_Data("dmwssux",$thisdmwssu_id);
                if ($GLOBALS{'IOWARNING'} == "0") {
                    if ($testorreal == "R") { Delete_Data("dmwssux",$thisdmwssu_id); }
                    $datastring = "dmwssux"."_uploadstatus";
                    $datastring = $datastring.$fieldsep.$thisdmwssu_id;
                    $datastring = $datastring.$fieldsep."OK";
                    $datastring = $datastring.$fieldsep."Old Record Deleted Successfully";
                    print $datastring.$recsep;
                }
                $relatedtablea = array ("dmwsvisit","dmwsserviceprovided","dmwsreferrerupdate","dmwsconsentwithdrawal","dmwsaction","dmwsreferral","dmwsprogress","dmwswellbeing","dmwscomplexity","dmwsattachment");               
                foreach ($relatedtablea as $relatedtable) {
                    $relatedtableida = Get_Array($relatedtable,$thisdmwssu_id);
                    foreach ($relatedtableida as $relatedtable_id) {
                        if ($testorreal == "R") { Delete_Data($relatedtable,$thisdmwssu_id,$relatedtable_id); }
                        $datastring = $relatedtable."_uploadstatus";
                        $datastring = $datastring.$fieldsep.$thisdmwssu_id;
                        $datastring = $datastring.$fieldsep.$relatedtable_id;
                        $datastring = $datastring.$fieldsep."OK";
                        $datastring = $datastring.$fieldsep."Old Record Deleted Successfully";
                        print $datastring.$recsep;
                    }
                }
            }
        }

        // ========== Update central server with uploaded data =============
        Initialise_Data($thistable);
        $tstring = $tablefielda[$thistable];
        $tfields = explode($fieldsep, $tstring);
        $fi = 0;
        foreach ($tfields as $tfieldelement) {
            
            // ====== temportary code to convert keys ========
            if ($tfieldelement == "dmwssu_dmwscontractid") {
                if ($fielddataa[$fi] == "H&N") { $fielddataa[$fi] = "HandN"; }
                if ($fielddataa[$fi] == "Som&Bris") { $fielddataa[$fi] = "SomAndBr"; }
            }
            if ($tfieldelement == "dmwssu_dmwscontractlocationid") {
                if ($fielddataa[$fi] == "Avon&Somerset") { $fielddataa[$fi] = "AvonAndSomerset"; }         
            }
            // ===============================================
            
            $GLOBALS{$tfieldelement} = $fielddataa[$fi];
            $fi++;
        }     
        if ($GLOBALS{$thistable."^KEYS"} == "2") {         
            if ($testorreal == "R") { Write_Data($thistable,$thisdmwssu_id); }
            $datastring = $thistable."_uploadstatus";
            $datastring = $datastring.$fieldsep.$thisdmwssu_id;
            $datastring = $datastring.$fieldsep."OK";
            $datastring = $datastring.$fieldsep.$thistable." Record Updated Successfully";
            print $datastring.$recsep;
        }
        if ($GLOBALS{$thistable."^KEYS"} == "3") {            
            if ($thistable == "dmwsattachment") { $fielddataa[3][0] = "T"; } // override new entries
            if ($testorreal == "R") { Write_Data($thistable,$thisdmwssu_id,$fielddataa[3]); }
            $datastring = $thistable."_uploadstatus";
            $datastring = $datastring.$fieldsep.$thisdmwssu_id;
            $datastring = $datastring.$fieldsep.$fielddataa[3];
            $datastring = $datastring.$fieldsep."OK";
            $datastring = $datastring.$fieldsep." Record Updated Successfully";
            print $datastring.$recsep;
        }
    }
    
    if ( $recordtype == "refdatatimestamp" ) {
        $serverhighestupdatetimestamp = "";
        $reftableida = Get_Array($thistable);
        foreach ($reftableida as $reftable_id) {
            Get_Data($thistable,$reftable_id);
            if ($GLOBALS{$thistable."_lastupdatetimestamp"} > $serverhighestupdatetimestamp) { $serverhighestupdatetimestamp = $GLOBALS{$thistable."_lastupdatetimestamp"};  }
        }
        $clienthighestupdatetimestamp = $fielddataa[1];
        if ( $clienthighestupdatetimestamp < $serverhighestupdatetimestamp) {
            $refdownloadreqd[$thistable] = "1";
        } else {
            $refdownloadreqd[$thistable] = "0";
        }
    }
    
} 

// ============ download service user data=========================

$synchdowndmwssua = Array();

$dmwssua = Get_Array('dmwssu');
foreach ($dmwssua as $dmwssu_id) {
    Get_Data('dmwssu',$dmwssu_id);
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
    if (in_array($dmwssu_id, $synchdowndmwssua)) {
        Get_Data('dmwssu',$dmwssu_id);
        $datastring = "dmwssu_downloaddata";
        foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$GLOBALS{$tfieldelement};}
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
    if (in_array($dmwssux_id, $synchdowndmwssua)) {
        Get_Data('dmwssux',$dmwssux_id);
        $datastring = "dmwssux_downloaddata";
        foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$GLOBALS{$tfieldelement};}
        print "$datastring".$recsep;
    }
}



$relatedtablea = array ("dmwsvisit","dmwsserviceprovided","dmwsreferrerupdate","dmwsconsentwithdrawal","dmwsaction","dmwsreferral","dmwsprogress","dmwswellbeing","dmwscomplexity","dmwsattachment");

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
    if ( $refdownloadreqd[$reftable] == "1" ) {
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

=======
<?php 
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');


Get_Common_Parameters();
GlobalRoutine();

$recsep = chr(135); // double cross
$fieldsep = chr(134); // dagger  

// ============ upload reference and service user data =========================

$tablefielda = Array();
$refdownloadreqd = Array();
$testorreal = $_REQUEST["TestorReal"];
$synchupdata = $_REQUEST["SynchUpData"];

$synchupdataa = explode($recsep,$synchupdata);
foreach ($synchupdataa as $synchupdataelement) {    
    $fielddataa = explode($fieldsep,$synchupdataelement);
    $identifiera = explode("_",$fielddataa[0]);
    $thistable = $identifiera[0];
    $recordtype = $identifiera[1];
    
    if ( $recordtype == "uploadheader" ) { 
        $tablefielda[$thistable] = $synchupdataelement;
    }
    
    if ( $recordtype == "uploaddata" ) { 
        if ( $thistable == "dmwssu" ) {           
           $thisdmwssu_id = $fielddataa[2];
           if (strlen(strstr($thisdmwssu_id,"New"))>0) { 
               $newdmwssu_ida = Array();
               $olddmwssu_ida = Get_Array('dmwssu');
               $highestdmwssu_id = "SU00000";
               foreach ($olddmwssu_ida as $tdmwssu_id) {
                   if ( $tdmwssu_id > $highestdmwssu_id ) { $highestdmwssu_id = $tdmwssu_id; }
               }
               $highestdmwssu_seq = str_replace("SU", "", $highestdmwssu_id);
               $highestdmwssu_seq++;
               $thisdmwssu_id = "SU".substr(("00000".$highestdmwssu_seq), -5);
           } else {
                // ========== Clean out existing data for this case =============
                Check_Data("dmwssu",$thisdmwssu_id);
                if ($GLOBALS{'IOWARNING'} == "0") {
                    if ($testorreal == "R") { Delete_Data("dmwssu",$thisdmwssu_id); }
                    $datastring = "dmwssu"."_uploadstatus";
                    $datastring = $datastring.$fieldsep.$thisdmwssu_id;
                    $datastring = $datastring.$fieldsep."OK";
                    $datastring = $datastring.$fieldsep."Old Record Deleted Successfully";
                    print $datastring.$recsep;
                }
                Check_Data("dmwssux",$thisdmwssu_id);
                if ($GLOBALS{'IOWARNING'} == "0") {
                    if ($testorreal == "R") { Delete_Data("dmwssux",$thisdmwssu_id); }
                    $datastring = "dmwssux"."_uploadstatus";
                    $datastring = $datastring.$fieldsep.$thisdmwssu_id;
                    $datastring = $datastring.$fieldsep."OK";
                    $datastring = $datastring.$fieldsep."Old Record Deleted Successfully";
                    print $datastring.$recsep;
                }
                $relatedtablea = array ("dmwsvisit","dmwsserviceprovided","dmwsreferrerupdate","dmwsconsentwithdrawal","dmwsaction","dmwsreferral","dmwsprogress","dmwswellbeing","dmwscomplexity","dmwsattachment");               
                foreach ($relatedtablea as $relatedtable) {
                    $relatedtableida = Get_Array($relatedtable,$thisdmwssu_id);
                    foreach ($relatedtableida as $relatedtable_id) {
                        if ($testorreal == "R") { Delete_Data($relatedtable,$thisdmwssu_id,$relatedtable_id); }
                        $datastring = $relatedtable."_uploadstatus";
                        $datastring = $datastring.$fieldsep.$thisdmwssu_id;
                        $datastring = $datastring.$fieldsep.$relatedtable_id;
                        $datastring = $datastring.$fieldsep."OK";
                        $datastring = $datastring.$fieldsep."Old Record Deleted Successfully";
                        print $datastring.$recsep;
                    }
                }
            }
        }

        // ========== Update central server with uploaded data =============
        Initialise_Data($thistable);
        $tstring = $tablefielda[$thistable];
        $tfields = explode($fieldsep, $tstring);
        $fi = 0;
        foreach ($tfields as $tfieldelement) {
            
            // ====== temportary code to convert keys ========
            if ($tfieldelement == "dmwssu_dmwscontractid") {
                if ($fielddataa[$fi] == "H&N") { $fielddataa[$fi] = "HandN"; }
                if ($fielddataa[$fi] == "Som&Bris") { $fielddataa[$fi] = "SomAndBr"; }
            }
            if ($tfieldelement == "dmwssu_dmwscontractlocationid") {
                if ($fielddataa[$fi] == "Avon&Somerset") { $fielddataa[$fi] = "AvonAndSomerset"; }         
            }
            // ===============================================
            
            $GLOBALS{$tfieldelement} = $fielddataa[$fi];
            $fi++;
        }     
        if ($GLOBALS{$thistable."^KEYS"} == "2") {         
            if ($testorreal == "R") { Write_Data($thistable,$thisdmwssu_id); }
            $datastring = $thistable."_uploadstatus";
            $datastring = $datastring.$fieldsep.$thisdmwssu_id;
            $datastring = $datastring.$fieldsep."OK";
            $datastring = $datastring.$fieldsep.$thistable." Record Updated Successfully";
            print $datastring.$recsep;
        }
        if ($GLOBALS{$thistable."^KEYS"} == "3") {            
            if ($thistable == "dmwsattachment") { $fielddataa[3][0] = "T"; } // override new entries
            if ($testorreal == "R") { Write_Data($thistable,$thisdmwssu_id,$fielddataa[3]); }
            $datastring = $thistable."_uploadstatus";
            $datastring = $datastring.$fieldsep.$thisdmwssu_id;
            $datastring = $datastring.$fieldsep.$fielddataa[3];
            $datastring = $datastring.$fieldsep."OK";
            $datastring = $datastring.$fieldsep." Record Updated Successfully";
            print $datastring.$recsep;
        }
    }
    
    if ( $recordtype == "refdatatimestamp" ) {
        $serverhighestupdatetimestamp = "";
        $reftableida = Get_Array($thistable);
        foreach ($reftableida as $reftable_id) {
            Get_Data($thistable,$reftable_id);
            if ($GLOBALS{$thistable."_lastupdatetimestamp"} > $serverhighestupdatetimestamp) { $serverhighestupdatetimestamp = $GLOBALS{$thistable."_lastupdatetimestamp"};  }
        }
        $clienthighestupdatetimestamp = $fielddataa[1];
        if ( $clienthighestupdatetimestamp < $serverhighestupdatetimestamp) {
            $refdownloadreqd[$thistable] = "1";
        } else {
            $refdownloadreqd[$thistable] = "0";
        }
    }
    
} 

// ============ download service user data=========================

$synchdowndmwssua = Array();

$dmwssua = Get_Array('dmwssu');
foreach ($dmwssua as $dmwssu_id) {
    Get_Data('dmwssu',$dmwssu_id);
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
    if (in_array($dmwssu_id, $synchdowndmwssua)) {
        Get_Data('dmwssu',$dmwssu_id);
        $datastring = "dmwssu_downloaddata";
        foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$GLOBALS{$tfieldelement};}
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
    if (in_array($dmwssux_id, $synchdowndmwssua)) {
        Get_Data('dmwssux',$dmwssux_id);
        $datastring = "dmwssux_downloaddata";
        foreach ($tfields as $tfieldelement) { $datastring = $datastring.$fieldsep.$GLOBALS{$tfieldelement};}
        print "$datastring".$recsep;
    }
}



$relatedtablea = array ("dmwsvisit","dmwsserviceprovided","dmwsreferrerupdate","dmwsconsentwithdrawal","dmwsaction","dmwsreferral","dmwsprogress","dmwswellbeing","dmwscomplexity","dmwsattachment");

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
    if ( $refdownloadreqd[$reftable] == "1" ) {
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

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>