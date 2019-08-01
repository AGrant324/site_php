<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,jqdatatablesfixedcolumnsmin,report";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$testorreal = $_REQUEST["TestorReal"];
// $extendedtrace = $_REQUEST["ExtendedTrace"];

$extendedtrace = "Yes";

if ($testorreal == "R") {$modetext = "";} else {$modetext = '"Test Mode"';}
XH2("Synchronisation ".$modetext);
XIMG("../site_assets/Synchronise.png","50","","0");
XBR();XBR();
    
$recsep = chr(135); // double cross
$fieldsep = chr(134); // dagger
  
$relatedtablea = array ("dmwsvisit","dmwsserviceprovided","dmwsreferrerupdate","dmwsconsentwithdrawal","dmwsaction","dmwsreferral","dmwsprogress","dmwswellbeing","dmwscomplexity","dmwsattachment");
$reftablelist = "dmwstitle,dmwsgender,dmwscontract,dmwsservice,dmwsservicestatus,dmwslocationtype,dmwscontractlocation,dmwssafeguardingissuetype,dmwswosafeguardingissuetype,dmwssafeguardeetype,dmwssafeguardeereasontype,";
$reftablelist = $reftablelist."dmwseqdivbuttons,dmwsdisabilitytype,dmwsprimarycaretype,dmwssecondarycaretype,dmwsindependentlivingtype,dmwssocialisolationtype,";
$reftablelist = $reftablelist."dmwsemploymenttype,dmwssupportcommunicationtype,dmwseventscommunicationtype,dmwsreportcommunicationtype,dmwscaringresponsibilitytype,dmwsmodspecifictype,";
$reftablelist = $reftablelist."dmwsadmissiontype,dmwsadmissionreason,dmwsservicetype,dmwssufeedbacktype,dmwsreferralorg,dmwscontacttype,dmwsconsentwithdrawaltype,dmwsspecialistreferralorg,";
$reftablelist = $reftablelist."dmwsvisitlocation,dmwstimeband,dmwscomplexitytype,dmwssupporttype,dmwsreferrerorgtype,dmwsoccupationalissuetype,dmwspreviousoccupationtype";
 
XHRCLASS('underline');
XH3("Uploaded Information");

$uploadtracea = Array();
$uploaddatastring = "";

// ===== upload table fields in case of database differences ============

$tstring = $GLOBALS{'dmwssu'."^FIELDS"};
$tfields = explode('|', $tstring);
$uploaddatastring = $uploaddatastring."dmwssu_uploadheader";
foreach ($tfields as $tfieldelement) { $uploaddatastring = $uploaddatastring.$fieldsep.$tfieldelement; }
$uploaddatastring = $uploaddatastring.$recsep;

$tstring = $GLOBALS{'dmwssux'."^FIELDS"};
$tfields = explode('|', $tstring);
$uploaddatastring = $uploaddatastring."dmwssux_uploadheader";
foreach ($tfields as $tfieldelement) { $uploaddatastring = $uploaddatastring.$fieldsep.$tfieldelement; }
$uploaddatastring = $uploaddatastring.$recsep;

foreach ($relatedtablea as $relatedtable) {
    $tstring = $GLOBALS{$relatedtable."^FIELDS"};
    $tfields = explode('|', $tstring);
    $uploaddatastring = $uploaddatastring.$relatedtable."_uploadheader";
    foreach ($tfields as $tfieldelement) { $uploaddatastring = $uploaddatastring.$fieldsep.$tfieldelement; }
    $uploaddatastring = $uploaddatastring.$recsep;
}


// ===== find out which service users have been changed/added ============
$upseq = 0;
$previousdmwssua = Array();
$previousdmwssunamea = Array();
$synchupdmwssua = Array();
$dmwssua = Get_Array('dmwssu');
foreach ($dmwssua as $dmwssu_id) {   
    Get_Data('dmwssu',$dmwssu_id);
    Check_Data('dmwssux',$dmwssu_id);
    array_push($previousdmwssua, $dmwssu_id); 
    array_push($previousdmwssunamea, $GLOBALS{'dmwssux_fname'}." ".$GLOBALS{'dmwssux_sname'}); 
    if ($GLOBALS{'dmwssu_clientupdatetimestamp'} != "" ) {
        if (substr_count($GLOBALS{'dmwssu_clientupdatetimestamp'}, '(No Synch)') > 0) { } else {
            if ($GLOBALS{'IOWARNING'} == "1") {
                XPTXTCOLOR("ERROR ".$dmwssu_id." NO MATCHING DMWSSUX RECORD","red");
            } else {
                array_push($synchupdmwssua, $dmwssu_id); 
            }
        }
    }
}

// ===== upload any changed information for service users ============
$updatesfound = "0";
foreach ($synchupdmwssua as $dmwssu_id) {
    $updatesfound = "1";
    Get_Data('dmwssu',$dmwssu_id);
    Get_Data('dmwssux',$dmwssu_id);
    $uploaddatastring = $uploaddatastring."dmwssu_uploaddata";
    $tstring = $GLOBALS{'dmwssu'."^FIELDS"}; $tfields = explode('|', $tstring);    
    $uploadrecord = ""; foreach ($tfields as $tfieldelement) { $uploadrecord = $uploadrecord.$fieldsep.$GLOBALS{$tfieldelement}; }
    $uploaddatastring = $uploaddatastring.$uploadrecord.$recsep;
    XPTXT("Changes to ".$GLOBALS{'dmwssux_fname'}." ".$GLOBALS{'dmwssux_sname'}."  uploaded");
    $upseq++;
    $uploadtraceelement = $upseq;
    $uploadtraceelement = $uploadtraceelement.$fieldsep.'dmwssu';
    $uploadtraceelement = $uploadtraceelement.$fieldsep.$dmwssu_id;
    $uploadtraceelement = $uploadtraceelement.$fieldsep.mb_strimwidth(str_replace($fieldsep, '_', $uploadrecord), 0, 100, "");
    array_push($uploadtracea, $uploadtraceelement); 

    $uploaddatastring = $uploaddatastring."dmwssux_uploaddata";
    $tstring = $GLOBALS{'dmwssux'."^FIELDS"}; $tfields = explode('|', $tstring);   
    $uploadrecord = ""; foreach ($tfields as $tfieldelement) { $uploadrecord = $uploadrecord.$fieldsep.$GLOBALS{$tfieldelement}; }
    $uploaddatastring = $uploaddatastring.$uploadrecord.$recsep;
    $upseq++;
    $uploadtraceelement = $upseq;
    $uploadtraceelement = $uploadtraceelement.$fieldsep.'dmwssux';
    $uploadtraceelement = $uploadtraceelement.$fieldsep.$dmwssux_id;
    $uploadtraceelement = $uploadtraceelement.$fieldsep.mb_strimwidth(str_replace($fieldsep, '_', $uploadrecord), 0, 100, "");
    array_push($uploadtracea, $uploadtraceelement); 

    foreach ($relatedtablea as $relatedtable) {
        $relatedtableida = Get_Array($relatedtable,$dmwssu_id);
        foreach ($relatedtableida as $relatedtable_id) {
            Get_Data($relatedtable,$dmwssu_id,$relatedtable_id);
            $uploaddatastring = $uploaddatastring.$relatedtable."_uploaddata"; 
            $tstring = $GLOBALS{$relatedtable."^FIELDS"}; $tfields = explode('|', $tstring);   
            $uploadrecord = ""; foreach ($tfields as $tfieldelement) { $uploadrecord = $uploadrecord.$fieldsep.$GLOBALS{$tfieldelement}; }
            $uploaddatastring = $uploaddatastring.$uploadrecord.$recsep;
            $upseq++;
            $uploadtraceelement = $upseq;
            $uploadtraceelement = $uploadtraceelement.$fieldsep.$relatedtable;
            $uploadtraceelement = $uploadtraceelement.$fieldsep.$dmwssu_id;
            $uploadtraceelement = $uploadtraceelement.$fieldsep.mb_strimwidth(str_replace($fieldsep, '_', $uploadrecord), 0, 100, "");
            array_push($uploadtracea, $uploadtraceelement); 
        }
    }
}

if ( $updatesfound == "0" ) {
    XPTXT("No Changes have been found to upload");
}

// ===== provide latest timestamp information for reference tables ============
$reftablea = List2Array($reftablelist);
foreach ($reftablea as $reftable) {
    $highestupdatetimestamp = "";
    $reftableida = Get_Array($reftable);
    foreach ($reftableida as $reftable_id) {
        Get_Data($reftable,$reftable_id);
        if ($GLOBALS{$reftable."_lastupdatetimestamp"} > $highestupdatetimestamp) { $highestupdatetimestamp = $GLOBALS{$reftable."_lastupdatetimestamp"};  }
    }
    $uploaddatastring = $uploaddatastring.$reftable."_refdatatimestamp";
    $uploaddatastring = $uploaddatastring.$fieldsep.$highestupdatetimestamp;
    $uploaddatastring = $uploaddatastring.$recsep;
    $upseq++;
    $uploadtraceelement = $upseq;
    $uploadtraceelement = $uploadtraceelement.$fieldsep.$reftable;
    $uploadtraceelement = $uploadtraceelement.$fieldsep."Last Update";
    $uploadtraceelement = $uploadtraceelement.$fieldsep.$GLOBALS{$reftable."_lastupdatetimestamp"};
    array_push($uploadtracea, $uploadtraceelement); 
}

XBR();XTXTID("reportshowhide_upload","Show More Detail");XBR();

XDIV("reportdiv_upload","container");
XTABLEJQDTID("reporttable_upload");
XTHEAD();
XTRJQDT();
XTDTXT("Seq");
XTDTXT("Table");
XTDTXT("Key");
XTDTXT("Information");
X_TR();
X_THEAD();
XTBODY();

foreach ($uploadtracea as $uploadtraceelement) {
    $uploadtracefieldsa = explode($fieldsep,$uploadtraceelement);
    XTRJQDT();
    XTDTXT($uploadtracefieldsa[0]);
    XTDTXT($uploadtracefieldsa[1]);
    XTDTXT($uploadtracefieldsa[2]);
    XTDTXT($uploadtracefieldsa[3]);
    X_TR();
}    
    
X_TBODY();
X_TABLE();
X_DIV("reportdiv_upload");
XCLEARFLOAT();

/*
XH1("Raw Input");
$uploaddatastringa = explode($recsep,$uploaddatastring);
foreach ($uploaddatastringa as $responseelement) { XPTXT( $responseelement); }
*/

if ($GLOBALS{'site_server'} == "W") { $domainid = "dmws"; }
else { $domainid = "dmwsportal"; }

$post = array (
    'ServiceId' => "dmws",
    'DomainId' => $domainid,
    'ModeId' => $GLOBALS{'LOGIN_mode_id'},
    'PersonId' => $GLOBALS{'LOGIN_person_id'},
    'SessionId' => $GLOBALS{'LOGIN_session_id'},
    'TestorReal' => $testorreal,
    'SynchUpData' => $uploaddatastring
);

$ch = curl_init($GLOBALS{'site_synchroniseurl'}."/site_php/v1_dmwsclientsynchronisedataexchanger.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

/*
XH1("Raw Response");
// print $response."\n"; 
$responsea = explode($recsep,$response);
foreach ($responsea as $responseelement) { XPTXT( $responseelement); }
*/

XBR();
XHRCLASS('underline');
XH3("Downloaded Information");

$downloadtracea = Array(); 

$downseq = 0;
$newdmwssua = Array();
$responsea = explode($recsep,$response);
foreach ($responsea as $responseelement) {
    $fielddataa = explode($fieldsep,$responseelement);
    $identifiera = explode("_",$fielddataa[0]);
    $thistable = $identifiera[0];
    $recordtype = $identifiera[1];
    if ( $recordtype == "uploadstatus" ) {
        // dmwsvisit_uploaddata key1 status statusmessage
        if ($GLOBALS{$thistable."^KEYS"} == "2") {            
            if ($fielddataa[2] == "OK") { $statuscolor = "green"; }
            else { $statuscolor = "red"; }
            // XPTXTCOLOR($thistable." ".$fielddataa[1]." ".$fielddataa[2]." "." ".$fielddataa[3]." ".$fielddataa[4],$statuscolor);
        }
        if ($GLOBALS{$thistable."^KEYS"} == "3") {
            if ($fielddataa[3] == "OK") { $statuscolor = "green"; }
            else { $statuscolor = "red"; }
            // XPTXTCOLOR($thistable." ".$fielddataa[1]." ".$fielddataa[2]." "." ".$fielddataa[3]." ".$fielddataa[4]." ".$fielddataa[5],$statuscolor);
        } 
        $downseq++;
        $downloadtraceelement = $downseq;
        $downloadtraceelement = $downloadtraceelement.$fieldsep.$identifiera[0];
        $downloadtraceelement = $downloadtraceelement.$fieldsep."uploadstatus";
        $downloadtraceelement = $downloadtraceelement.$fieldsep.mb_strimwidth(str_replace($fieldsep, '_', $responseelement), 0, 100, "");
        array_push($downloadtracea, $downloadtraceelement); 
    }
    
    if ( $recordtype == "downloadheader" ) {
        
        $fieldnamea = $fielddataa;
        
        $downseq++;
        $downloadtraceelement = $downseq;
        $downloadtraceelement = $downloadtraceelement.$fieldsep.$identifiera[0];
        $downloadtraceelement = $downloadtraceelement.$fieldsep."downloadheader";
        $downloadtraceelement = $downloadtraceelement.$fieldsep.mb_strimwidth(str_replace($fieldsep, '_', $responseelement), 0, 100, "");
        array_push($downloadtracea, $downloadtraceelement); 

        if ($GLOBALS{$thistable."^KEYS"} == "2") {            
            $tablek1ida = Get_Array($thistable);
            foreach ($tablek1ida as $table_k1id) {
                $deletetext = " would be deleted";
                if ($testorreal == "R") { Delete_Data($thistable,$table_k1id); $deletetext = " deleted"; }
                $downseq++;
                $downloadtraceelement = $downseq;
                $downloadtraceelement = $downloadtraceelement.$fieldsep.$identifiera[0];
                $downloadtraceelement = $downloadtraceelement.$fieldsep.$table_k1id;
                $downloadtraceelement = $downloadtraceelement.$fieldsep."Old information ".$deletetext;
                array_push($downloadtracea, $downloadtraceelement); 
            }
        }
        if ($GLOBALS{$thistable."^KEYS"} == "3") {
            $tablek1ida = Get_Array($thistable);
            foreach ($tablek1ida as $table_k1id) {
                $tablek2ida = Get_Array($thistable,$table_k1id);               
                foreach ($tablek2ida as $table_k2id) {
                    $deletetext = " would be deleted";
                    if ($testorreal == "R") { Delete_Data($thistable,$table_k1id,$table_k2id); $deletetext = " deleted"; }
                    $downseq++;
                    $downloadtraceelement = $downseq;
                    $downloadtraceelement = $downloadtraceelement.$fieldsep.$identifiera[0];
                    $downloadtraceelement = $downloadtraceelement.$fieldsep.$table_k1id."-".$table_k2id;
                    $downloadtraceelement = $downloadtraceelement.$fieldsep."Old information ".$deletetext;
                    array_push($downloadtracea, $downloadtraceelement); 
                }
            }
        }
    }
    if ( $recordtype == "downloaddata" ) {
        $downseq++;
        Initialise_Data($thistable);
        /*
        $tstring = $GLOBALS{$thistable."^FIELDS"};
        $tfields = explode('|', $tstring);
        $fi = 0;
        foreach ($tfields as $tfieldelement) {
            $fi++;
            $GLOBALS{$fieldnamea} = $fielddataa[$fi];
        } 
        */
        $fi = 0;
        foreach ($fieldnamea as $tfieldname) {
            $GLOBALS{$tfieldname} = $fielddataa[$fi];
            $fi++;
        } 
        if ($thistable == "dmwssu") { 
            $GLOBALS{'dmwssu_clientupdatetimestamp'} = ""; 
            array_push($newdmwssua, $fielddataa[2]); 
        }
        if ($GLOBALS{$thistable."^KEYS"} == "2") {
            if ($testorreal == "R") { Write_Data($thistable,$fielddataa[2]); }
            $key = $fielddataa[2];
        }
        if ($GLOBALS{$thistable."^KEYS"} == "3") {
            $tablek1ida = Get_Array($thistable);
            if ($testorreal == "R") { Write_Data($thistable,$fielddataa[2],$fielddataa[3]); }
            $key = $fielddataa[2]."-".$fielddataa[3];
        }
        if ($thistable == "dmwssux") {
            XPTXT("Latest information for ".$fielddataa[5]." ".$fielddataa[4]." downloaded");
        }
        if ( FoundInCommaList($thistable,$reftablelist) ) {
            XPTXT("Reference table ".$identifiera[0]." ".$key." ".$fielddataa[3]." downloaded");
        }        
        $downseq++;
        $downloadtraceelement = $downseq;
        $downloadtraceelement = $downloadtraceelement.$fieldsep.$identifiera[0];
        $downloadtraceelement = $downloadtraceelement.$fieldsep.$key;
        $downloadtraceelement = $downloadtraceelement.$fieldsep.mb_strimwidth(str_replace($fieldsep, '_', $responseelement), 0, 100, "");
        array_push($downloadtracea, $downloadtraceelement); 
    }
} 

$pi = 0;
foreach ($previousdmwssua as $previousdmwssu_id) {   
    if (in_array($previousdmwssu_id, $newdmwssua)) { } else {
        if (strlen(strstr($previousdmwssu_id,"New"))>0) { } else {
            XPTXTCOLOR("Service User ".$previousdmwssu_id." (".$previousdmwssunamea[$pi].") no longer available offline","red");
        }
    }
    $pi++;
}


XBR();XTXTID("reportshowhide_download","Show More Detail");XBR();

XDIV("reportdiv_download","container");
XTABLEJQDTID("reporttable_download");
XTHEAD();
XTRJQDT();
XTDTXT("Seq");
XTDTXT("Table");
XTDTXT("Key");
XTDTXT("Information");
X_TR();
X_THEAD();
XTBODY(); 

foreach ($downloadtracea as $downloadtraceelement) {
    $downloadtracefieldsa = explode($fieldsep,$downloadtraceelement);
    XTRJQDT();
    XTDTXT($downloadtracefieldsa[0]);
    XTDTXT($downloadtracefieldsa[1]);
    XTDTXT($downloadtracefieldsa[2]);
    XTDTXT($downloadtracefieldsa[3]);
    X_TR();
}  
   
X_TBODY();
X_TABLE();
X_DIV("reportdiv_download");
XCLEARFLOAT();

XBR();
$link = YPGMLINK("dmwssulistout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("ListStatus","Open");
XLINKBUTTON($link,"Return to My Case List");

Back_Navigator();
PageFooter("Default","Final");


?>


