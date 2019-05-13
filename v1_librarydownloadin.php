<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php"; 

Get_Common_Parameters();
GlobalRoutine();

// This routine does not require login if document is public

$loginstatus = "remote";
if ($GLOBALS{'LOGIN_person_id'} != "") {
	Get_Data("person",$GLOBALS{'LOGIN_person_id'});
	Check_Session_Validity();
	$loginstatus = "loggedin";
}
$asset_code = $_REQUEST['asset_code'];
if ((isset($_REQUEST['AssetCode'])&&$_REQUEST['AssetCode']!="")) {$asset_code = $_REQUEST["AssetCode"];}
if ((isset($_REQUEST['asset_clubid'])&&$_REQUEST['asset_clubid']!="")) {$asset_clubid = $_REQUEST["asset_clubid"];} else {$asset_clubid = $GLOBALS{'LOGIN_domain_id'}; }

Get_Data("asset",$asset_clubid,$asset_code);

$oktovieew = "0";
if ($GLOBALS{'asset_security'} == "") { $oktovieew = "1"; }
if ($GLOBALS{'asset_security'} == "0") { $oktovieew = "1"; }
if ($GLOBALS{'asset_security'} == "1") { 
	if ($loginstatus == "loggedin") { $oktovieew = "1"; }
}
if ($GLOBALS{'asset_security'} == "2") {
	if ($loginstatus == "loggedin") {
	   Get_Person_Authority();
	   if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $oktovieew = "1"; }  	
	   if (strlen(strstr($GLOBALS{'person_authority'},"AM#Domain"))>0) { $oktovieew = "1"; }  	   
	   if (strlen(strstr($GLOBALS{'person_authority'},"ORG#Domain"))>0) { $oktovieew = "1"; }
	   if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain"))>0) { $oktovieew = "1"; }		     	  		   
	}
}
if ($GLOBALS{'asset_security'} == "3") {
	if ($loginstatus == "loggedin") {
	   Get_Person_Authority();
	   if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain"))>0) { $oktovieew = "1"; }		   
	}
}

if ( $oktovieew == "1" ) {
	Download_File ($GLOBALS{'site_filepath'}.'/'.$GLOBALS{'LOGIN_domain_id'}.'/assets/'.$GLOBALS{'asset_file'},"");
} else {
	XPTXT("Sorry, you are not authorised to view this document.");
}	