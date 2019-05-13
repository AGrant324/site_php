<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();
$mergedkeyseparator = '+';;

# DT=table1                                      - basic mode
# DT=table1[site=all]                            - updates apply at site level
# DT=table1[fieldvalue=fieldname:val1/val2/val3] - normal update
# DT=table1[rootkey=val1]                        - rootkey update
# DT=table1[mergedkey=fieldname1+fieldname2]     - unmerge key data prior to update

$indt = $_REQUEST["DT"]; # could be format dt[rootkey] or vatrate[mergedkey=vatrate_id+vatrate_dateeffective]
$dk = $_REQUEST["DK"];
$ds = $_REQUEST["DS"];
$drk = "";

print "<br>Update to $indt | $dk | $ds requested\n";

/*
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
   $drk = $zfields[1];
  }  
  if (strlen(strstr($yfields[0],"mergedkey="))>0) {
   $normalrequired = "0"; $mergedkeyrequired = "1";
  }
} else {
  $dt = $indt;
}

$tstring = $GLOBALS{$dt."^FIELDS"}; $xfields = explode('|', $tstring);
$yfields = Array();
$zfields = array_merge($xfields,$yfields);

if ($mergedkeyrequired == "1") {
 $dsbits = explode($mergedkeyseparator, $ds);
 $ds = $dsbits[0]."|".$dsbits[1];  # CHECK  - does not allow for $mergedkeyseparator character in data
} 
 
$sfields = explode('|', $ds);

$i=0;
foreach ($zfields as $zfieldelement) {
 # print "<br>".$zfieldelement." - ".$sfields[$i];
 $GLOBALS[$zfieldelement] = $sfields[$i];
 $i++;
}

if ($normalrequired == "1") { Write_Data($dt,$dk); }
if ($siterequired == "1") { Write_Data($dt."_".$dk); }
if ($rootkeyrequired == "1") { Write_Data($dt,$drk,$dk); }
if ($mergedkeyrequired == "1") { Write_Data($dt,$sfields[1],$sfields[2]); }

print "<br>Update to $dt $dk performed\n";
*/


?>


