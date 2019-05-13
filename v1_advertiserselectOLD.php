<?php # personloginout.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
Get_Common_Parameters();
GlobalRoutine();
$reqdcategory = $_GET['AdvertiserCategory'];
$error = "0"; 
$message = "";
$advertisername = "";
$advertiserimagesrc = "";
$advertiserlink = "";
$advertisertext = "";
if ($GLOBALS{'LOGIN_mode_id'} == "0" ) { $aref = "advertiser_".$GLOBALS{'LOGIN_service_id'}; $bannerurlbase = $GLOBALS{'site_wwwurl'}; } 
else { $aref = "advertiser"; $bannerurlbase = $GLOBALS{'domainwwwurl'}; }
$advertisersa = Get_Array($aref);
$tadvertisersa = Array();
foreach ($advertisersa as $advertiser_name) {
  Get_Data($aref,$advertiser_name);
  if ($GLOBALS{'advertiser_category'} == $reqdcategory) {
	for ($i = 0; $i < intval($GLOBALS{'advertiser_freq'}); $i++) {
  		$taelement = $advertiser_name;
  		array_push($tadvertisersa, $taelement);  		
	}
  }
}
if (sizeof($tadvertisersa) > 0) {
 $selectedindex = rand ( 0 , sizeof($tadvertisersa)-1 );
 Get_Data($aref,$tadvertisersa[$selectedindex]);
 $advertisername = $GLOBALS{'advertiser_name'};
 $advertiserimagesrc = $bannerurlbase."/domain_advertisers/".$GLOBALS{'advertiser_banner'};
 $advertiserlink = $GLOBALS{'advertiser_website'};
 $advertisertext = $GLOBALS{'advertiser_text'};
} 
print "$error|$message|$advertisername|$advertiserimagesrc|$advertiserlink|$advertisertext"
?>