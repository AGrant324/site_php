<?php # javascriptdatadelete.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
Get_Common_Parameters();
GlobalRoutine();

$recsep = "^"; $fieldsep = chr(126);   // tilde
$rootkeyseparator = '+';
$mergedkeyseparator = '+';

if ($GLOBALS{'LOGIN_loginmode_id'} == "0") { Get_Data("person_".$GLOBALS{'LOGIN_service_id'},$GLOBALS{'LOGIN_person_id'}); }
else {Get_Data("person",$GLOBALS{'LOGIN_person_id'}); }

# DT=table1                                      - basic mode
# DT=table1[site=all/unique]                     - updates apply at site level
# DT=table1[rootkey=val1]                        - rootkey update
# DT=table1[mergedkey=fieldname1+fieldname2]     - unmerge key data prior to update

$indt = $_REQUEST["DT"]; # could be format dt[rootkey]
$dk = $_REQUEST["DK"];
$drk = "";
# print "<br>Delete of $indt $dk requested\n";
# Analyse which form of database update is required
$normalrequired = "1"; $siterequired = "0"; $rootkeyrequired = "0"; $mergedkeyrequired = "0";
if (strlen(strstr($indt,"["))>0) {
    $xfields = explode('[', $indt);
    $yfields = explode(']', $xfields[1]);
    $zfields = explode('=', $yfields[0]);
    $dt = $xfields[0];
    if (strlen(strstr($yfields[0],"site="))>0) {
        $normalrequired = "0"; $siterequired = "1";
    }
    if (strlen(strstr($yfields[0],"rootkey="))>0) {
        # just one rootkeylevel in this implementation
        $normalrequired = "0"; $rootkeyrequired = "1";
        $drk = $zfields[1]; // could be multiple rootkeys 	  
    }
    if (strlen(strstr($yfields[0],"mergedkey="))>0) {
        $normalrequired = "0"; $mergedkeyrequired = "1";
    }
} else {
    $dt = $indt;
}

if ($normalrequired == "1") { Delete_Data($dt,$dk); print "<br>$dt $dk deleted\n"; }
if ($siterequired == "1") { Delete_Data($dt."_".$dk); print "<br>$dt $dk deleted\n"; }
if ($rootkeyrequired == "1") {    
    if (strlen(strstr($drk,$rootkeyseparator))>0) {
        // multiple root keys
        $drka = explode($rootkeyseparator, $drk);
        if (count($drka) == 2) {
            Delete_Data($dt,$drka[0],$drka[1],$dk);
            print "<br>".$dt." ".$drka[0]." ".$drka[1]." deleted\n";
        }
        if (count($drka) == 3) {
            Delete_Data($dt,$drka[0],$drka[1],$drka[2],$dk);
            print "<br>".$dt." ".$drka[0]." ".$drka[1]." ".$drka[2]." deleted\n";
        }
    } else {
        // single rootkey
        Delete_Data($dt,$drk,$dk); 
        print "<br>$dt $dk deleted\n";
    }
}
if ($mergedkeyrequired == "1") {
 $kfields = explode($mergedkeyseparator, $dk);    
 Delete_Data($dt,$kfields[0],$kfields[1]); 
 print "<br>".$dt." ".$kfields[0]." ".$kfields[1]." deleted\n";
}

?>


