<<<<<<< HEAD
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$testorreal = $_REQUEST["TestorReal"];

XH2("DMWS Data Removal - ".$testorreal);

$persona = Get_Array('person');
foreach ($persona as $person_id) {
    if ( $person_id != "cset" ) {
        if ($testorreal == "R") { Delete_Data("person",$person_id); }
        XPTXT("person ".$person_id." Deleted");
    }
}

$dmwssua = Get_Array('dmwssu');
foreach ($dmwssua as $thisdmwssu_id) {
    Check_Data("dmwssu",$thisdmwssu_id);
    if ($GLOBALS{'IOWARNING'} == "0") {
        if ($testorreal == "R") { Delete_Data("dmwssu",$thisdmwssu_id); }
        XPTXT("dmwssu ".$thisdmwssu_id." Deleted");
    }
    Check_Data("dmwssux",$thisdmwssu_id);
    if ($GLOBALS{'IOWARNING'} == "0") {
        if ($testorreal == "R") { Delete_Data("dmwssux",$thisdmwssu_id); }
        XPTXT("dmwssux ".$thisdmwssu_id." Deleted");
    }
    $relatedtablea = array ("dmwsvisit","dmwsserviceprovided","dmwsreferrerupdate","dmwsconsentwithdrawal","dmwsaction","dmwsreferral","dmwsprogress","dmwswellbeing","dmwscomplexity","dmwsattachment");
    foreach ($relatedtablea as $relatedtable) {
        $relatedtableida = Get_Array($relatedtable,$thisdmwssu_id);
        foreach ($relatedtableida as $relatedtable_id) {
            if ($testorreal == "R") { Delete_Data($relatedtable,$thisdmwssu_id,$relatedtable_id); }
            XPTXT($relatedtable." ".$thisdmwssu_id." ".$relatedtable_id." Deleted");
        }
    }
}

$reftablelist = "dmwstitle,dmwsgender,dmwscontract,dmwsservice,dmwsservicestatus,dmwslocationtype,dmwscontractlocation,dmwssafeguardingissuetype,dmwswosafeguardingissuetype,";
$reftablelist = $reftablelist."dmwseqdivbuttons,dmwsdisabilitytype,dmwsprimarycaretype,dmwssecondarycaretype,dmwsindependentlivingtype,dmwssocialisolationtype,";
$reftablelist = $reftablelist."dmwsemploymenttype,dmwssupportcommunicationtype,dmwseventscommunicationtype,dmwsreportcommunicationtype,dmwscaringresponsibilitytype,dmwsmodspecifictype,";
$reftablelist = $reftablelist."dmwsadmissiontype,dmwsadmissionreason,dmwsservicetype,dmwssufeedbacktype,dmwsreferralorg,dmwscontacttype,dmwsconsentwithdrawaltype,dmwsspecialistreferralorg,";
$reftablelist = $reftablelist."dmwsvisitlocation,dmwstimeband,dmwscomplexitytype,dmwssupporttype,dmwsreferrerorgtype,dmwsoccupationalissuetype,dmwspreviousoccupationtype,";
$reftablelist = $reftablelist."dmwssafeguardeereasontype,dmwssafeguardeetype,dmwswosafeguardingissuetype";
$reftablea = List2Array($reftablelist);

foreach ($reftablea as $reftable) {
    $reftableida = Get_Array($reftable);
    foreach ($reftableida as $reftable_id) {
        if ($testorreal == "R") { Delete_Data($reftable,$reftable_id); }
        XPTXT($reftable." ".$reftable_id." Deleted");
    }
}

Back_Navigator();
PageFooter("Default","Final");
?>


=======
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$testorreal = $_REQUEST["TestorReal"];

XH2("DMWS Data Removal - ".$testorreal);

$persona = Get_Array('person');
foreach ($persona as $person_id) {
    if ( $person_id != "cset" ) {
        if ($testorreal == "R") { Delete_Data("person",$person_id); }
        XPTXT("person ".$person_id." Deleted");
    }
}

$dmwssua = Get_Array('dmwssu');
foreach ($dmwssua as $thisdmwssu_id) {
    Check_Data("dmwssu",$thisdmwssu_id);
    if ($GLOBALS{'IOWARNING'} == "0") {
        if ($testorreal == "R") { Delete_Data("dmwssu",$thisdmwssu_id); }
        XPTXT("dmwssu ".$thisdmwssu_id." Deleted");
    }
    Check_Data("dmwssux",$thisdmwssu_id);
    if ($GLOBALS{'IOWARNING'} == "0") {
        if ($testorreal == "R") { Delete_Data("dmwssux",$thisdmwssu_id); }
        XPTXT("dmwssux ".$thisdmwssu_id." Deleted");
    }
    $relatedtablea = array ("dmwsvisit","dmwsserviceprovided","dmwsreferrerupdate","dmwsconsentwithdrawal","dmwsaction","dmwsreferral","dmwsprogress","dmwswellbeing","dmwscomplexity","dmwsattachment");
    foreach ($relatedtablea as $relatedtable) {
        $relatedtableida = Get_Array($relatedtable,$thisdmwssu_id);
        foreach ($relatedtableida as $relatedtable_id) {
            if ($testorreal == "R") { Delete_Data($relatedtable,$thisdmwssu_id,$relatedtable_id); }
            XPTXT($relatedtable." ".$thisdmwssu_id." ".$relatedtable_id." Deleted");
        }
    }
}

$reftablelist = "dmwstitle,dmwsgender,dmwscontract,dmwsservice,dmwsservicestatus,dmwslocationtype,dmwscontractlocation,dmwssafeguardingissuetype,dmwswosafeguardingissuetype,";
$reftablelist = $reftablelist."dmwseqdivbuttons,dmwsdisabilitytype,dmwsprimarycaretype,dmwssecondarycaretype,dmwsindependentlivingtype,dmwssocialisolationtype,";
$reftablelist = $reftablelist."dmwsemploymenttype,dmwssupportcommunicationtype,dmwseventscommunicationtype,dmwsreportcommunicationtype,dmwscaringresponsibilitytype,dmwsmodspecifictype,";
$reftablelist = $reftablelist."dmwsadmissiontype,dmwsadmissionreason,dmwsservicetype,dmwssufeedbacktype,dmwsreferralorg,dmwscontacttype,dmwsconsentwithdrawaltype,dmwsspecialistreferralorg,";
$reftablelist = $reftablelist."dmwsvisitlocation,dmwstimeband,dmwscomplexitytype,dmwssupporttype,dmwsreferrerorgtype,dmwsoccupationalissuetype,dmwspreviousoccupationtype,";
$reftablelist = $reftablelist."dmwssafeguardeereasontype,dmwssafeguardeetype,dmwswosafeguardingissuetype";
$reftablea = List2Array($reftablelist);

foreach ($reftablea as $reftable) {
    $reftableida = Get_Array($reftable);
    foreach ($reftableida as $reftable_id) {
        if ($testorreal == "R") { Delete_Data($reftable,$reftable_id); }
        XPTXT($reftable." ".$reftable_id." Deleted");
    }
}

Back_Navigator();
PageFooter("Default","Final");
?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
