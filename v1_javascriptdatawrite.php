<?php # javascriptdatawrite.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$recsep = "^"; $fieldsep = chr(126);   // tilde

$rootkeyseparator = '+';
$mergedkeyseparator = '+';

# DT=table1                                      - basic mode
# DT=table1[site=all/unique]                     - updates apply at site level
# DT=table1[rootkey=val1]                        - rootkey update
# DT=table1[rootkey=val1+val2]                   - multiple rootkey update
# DT=table1[mergedkey=fieldname1+fieldname2]     - unmerge key data prior to update

// [DT] => personjobrole[mergedkey=personjobrole_personid+personjobrole_jobroleid]
// [DK] => bbra+JFINCON
// [DS] => personjobrole_domainid~havanthockeyclub^personjobrole_personid+personjobrole_jobroleid~bbra+JFINCON^personjobrole_description~cw

$indt = $_REQUEST["DT"]; # could be format dt[rootkey] or dt[rootkey1+rootkey2] or vatrate[mergedkey=vatrate_id+vatrate_dateeffective]
$dk = $_REQUEST["DK"];
$ds = $_REQUEST["DS"];
$drk = "";
$dk1 = ""; $dk2 = ""; // merged keys


// reverse encoding to get html through mod security
$ds = Write_Decode($ds);

// print "<br>Update to $indt | $dk | $ds requested\n";

# Analyse which form of database update is required
$normalrequired = "1"; $siterequired = "0"; $rootkeyrequired = "0"; $mergedkeyrequired = "0";


// Step 1 - Analyse Update Type and read in existing record (Initialise if not)
if (strlen(strstr($indt,"["))>0) {
    // ====== special fields ======
    $xfields = explode('[', $indt);
    $yfields = explode(']', $xfields[1]);
    $zfields = explode('=', $yfields[0]);
    $dt = $xfields[0];
    if (strlen(strstr($yfields[0],"site="))>0) {
        $normalrequired = "0"; $siterequired = "1";
        Check_Data($dt."_".$dk); 
    }
    if (strlen(strstr($yfields[0],"rootkey="))>0) {
        $normalrequired = "0"; $rootkeyrequired = "1";
        $drk = $zfields[1];  // could contain multiple keys
        if (strlen(strstr($drk,$rootkeyseparator))>0) {
            // multiple root keys
            $drka = explode($rootkeyseparator, $drk);
            if (count($drka) == 2) {
                Check_Data($dt,$drka[0],$drka[1],$dk);
            }
            if (count($drka) == 3) {
                Check_Data($dt,$drka[0],$drka[1],$drka[2],$dk);
            }
        } else {
            // single rootkey
            Check_Data($dt,$drk,$dk);
        }   
    }  
    if (strlen(strstr($yfields[0],"mergedkey="))>0) {
        $normalrequired = "0"; $mergedkeyrequired = "1";
        $vfields = explode($mergedkeyseparator, $dk);
        $dk1 = $vfields[0];
        $dk2 = $vfields[1];
        Check_Data($dt,$dk1,$dk2);
    }
} else {
        // ==== normal fields ======
        $dt = $indt;
        Check_Data($dt,$dk);
}
if ($GLOBALS{'IOWARNING'} == "1") {
    Initialise_Data($dt);
}

// Step 2 - Populate data in the updated records

$sfields = explode($recsep, $ds);
$si = 0;
foreach ($sfields as $sfieldelement) { 
    if (($si < 2)&&(strlen(strstr($sfieldelement,$mergedkeyseparator)))>0) {
        // fielda+fieldb~val1+val2
        $mfields = explode($fieldsep, $sfieldelement);
        $kfields = explode($mergedkeyseparator, $mfields[0]);
        $vfields = explode($mergedkeyseparator, $mfields[1]);      
        $GLOBALS[$kfields[0]] = $vfields[0];
        $GLOBALS[$kfields[1]] = $vfields[1];
    } else {
        // fielda~val1^fieldb~val2
        $wfields = explode($fieldsep, $sfieldelement);
        $GLOBALS[$wfields[0]] = $wfields[1];        
    }
    $si++;
}
$tstring = $GLOBALS{$dt."^FIELDS"}; 
$tfields = explode('|', $tstring);	
if (in_array($dt."_lastupdatetimestamp", $tfields)) {
    $GLOBALS{$dt."_lastupdatetimestamp"} = $GLOBALS{'currenttimestamp'};
}

// Step 3 - Write the new records

if ($normalrequired == "1") { 
    Write_Data($dt,$dk); 
    print "<br>Update to $dt $dk performed\n"; 
}
if ($siterequired == "1") { 
    Write_Data($dt."_".$dk); 
    print "<br>Update to $dt $dk performed\n"; 
}
if ($rootkeyrequired == "1") {
    if (strlen(strstr($drk,$rootkeyseparator))>0) {
        // multiple root keys
        $drka = explode($rootkeyseparator, $drk);
        if (count($drka) == 2) {
            Write_Data($dt,$drka[0],$drka[1],$dk);
            print "<br>Update to ".$dt." ".$drka[0]." ".$drka[1]." ".$dk." performed\n";
        }
        if (count($drka) == 3) {
            Write_Data($dt,$drka[0],$drka[1],$drka[2],$dk);
            print "<br>Update to ".$dt." ".$drka[0]." ".$drka[1]." ".$drka[2]." ".$dk." performed\n";        
        }    
    } else {
        // single rootkey
        Write_Data($dt,$drk,$dk); 
        print "<br>Update to $dt $drk $dk performed\n";
    }
}
if ($mergedkeyrequired == "1") { 
    Write_Data($dt,$dk1,$dk2);
    print "<br>Update to $dt $dk1 $dk2 performed\n"; 
}


function Write_Decode ($reverseinstring) {
	// This is a way of getting through mod_security and avoid issues with post string
	$outstring = strrev($reverseinstring);;
	$outstring = str_replace('^LT^', '<', $outstring);
	$outstring = str_replace('^GT^', '>', $outstring);
	$outstring = str_replace('^AND^', '&', $outstring);	
// 	$outstring = str_replace('^TILDE^', chr(126), $outstring);	
	return $outstring;
}

?>