<?php # personLUin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();


$keychangetable = "";
$oldsfmclubkey = "";
$oldsfmteamkey = "";
$oldsfmfacilitykey = "";


if((isset($_REQUEST['sfmclub_id'])&&$_REQUEST['sfmclub_id']!="")) { $keychangetable = "sfmclub"; $oldsfmclub_id = $_REQUEST['sfmclub_id'];  }   
if((isset($_REQUEST['sfmteam_id'])&&$_REQUEST['sfmteam_id']!="")) { $keychangetable = "sfmteam"; $oldsfmteam_id = $_REQUEST['sfmteam_id'];  }   
if((isset($_REQUEST['sfmfacility_id'])&&$_REQUEST['sfmfacility_id']!="")) { $keychangetable = "sfmfacility"; $oldsfmfacility_id = $_REQUEST['sfmfacility_id'];  }   

XFORMUPLOAD("sfmkeychangein.php","sfmkeychangeform");
XINSTDHID();

if ( $keychangetable == "sfmclub" ) {
    ClubChange ($oldsfmclub_id); 
}
if ( $keychangetable == "sfmteam" ) {
    TeamChange ($oldsfmteam_id);
}
if ( $keychangetable == "sfmfacility" ) {
    FacilityChange ($oldsfmfacility_id); 
}
XBR();
XHR();
XINSUBMIT("Update");
X_FORM();

Back_Navigator();
PageFooter("Default","Final");



function ClubChange ($oldsfmclub_id) {
    Get_Data("sfmclub",$oldsfmclub_id);
    XH3("Club Key Change - ".$oldsfmclub_id);
    XHR();
    XH3COLOR("Club","green");
    BROW();
    BCOLCOLOR("gray","white","3");BTXT("Old Key");B_COL();
    BCOLCOLOR("gray","white","3");BTXT("New Key");B_COL();
    B_ROW();
    BROW();
    BCOLTXT($oldsfmclub_id,"3");
    BCOLINTXT("newsfmclub_id","","3");
    B_ROW();
    XHR();
    XH3("Other Key Changes (optional)");
    XBR();
    XH3COLOR("Teams","green");
    BROW();
    BCOLCOLOR("gray","white","3");BTXT("Old Key");B_COL();
    BCOLCOLOR("gray","white","3");BTXT("New Key");B_COL();
    B_ROW();
    $teama = List2Array($GLOBALS{'sfmclub_sfmteamidlist'});
    foreach ($teama as $oldsfmteam_id) {
        BROW();
        BCOLTXT($oldsfmteam_id,"3");
        BCOLINTXT("newsfmteam_id","","3");
        B_ROW();
    }
    XBR();
    XH3COLOR("Facilities","green");
    BROW();
    BCOLCOLOR("gray","white","3");BTXT("Old Key");B_COL();
    BCOLCOLOR("gray","white","3");BTXT("New Key");B_COL();
    B_ROW();
    $facilitya = List2Array($GLOBALS{'sfmclub_sfmfacilityidlist'});
    foreach ($facilitya as $oldsfmfacility_id) {
        BROW();
        BCOLTXT($oldsfmfacility_id,"3");
        BCOLINTXT("newsfmfacility_id","","3");
        B_ROW();
    }   
}
function TeamChange ($oldsfmteam_id) {
    Get_Data("sfmteam",$oldsfmteam_id);
    XH3("Team Key Change - ".$oldsfmteam_id);
    XHR();
    XH3COLOR("Team","green");
    BROW();
    BCOLCOLOR("gray","white","3");BTXT("Old Key");B_COL();
    BCOLCOLOR("gray","white","3");BTXT("New Key");B_COL();
    B_ROW();
    BROW();
    BCOLTXT($oldsfmteam_id,"3");
    BCOLINTXT("newsfmteam_id","","3");
    B_ROW();
    XHR();
    XH3("Other Key Changes (optional)");
    XBR();
    XH3COLOR("Club","green");
    BROW();
    BCOLCOLOR("gray","white","3");BTXT("Old Key");B_COL();
    BCOLCOLOR("gray","white","3");BTXT("New Key");B_COL();
    B_ROW();
    BROW();
    BCOLTXT($GLOBALS{'sfmteam_sfmclubid'},"3");
    BCOLINTXT("newsfmclub_id","","3");
    B_ROW();
    XBR();
    XH3COLOR("Facilities","green");
    BROW();
    BCOLCOLOR("gray","white","3");BTXT("Old Key");B_COL();
    BCOLCOLOR("gray","white","3");BTXT("New Key");B_COL();
    B_ROW();
    $facilitya = List2Array($GLOBALS{'sfmteam_sfmfacilityidlist'});
    foreach ($facilitya as $oldsfmfacility_id) {
        BROW();
        BCOLTXT($oldsfmfacility_id,"3");
        BCOLINTXT("newsfmfacility_id","","3");
        B_ROW();
    }   
}
function FacilityChange ($oldsfmfacility_id) {
    Get_Data("sfmfacility",$oldsfmfacility_id);
    XH3("Facility Key Change - ".$oldsfmfacility_id);
    XHR();
    XH3COLOR("Facility","green");
    BROW();
    BCOLCOLOR("gray","white","3");BTXT("Old Key");B_COL();
    BCOLCOLOR("gray","white","3");BTXT("New Key");B_COL();
    B_ROW();
    BROW();
    BCOLTXT($oldsfmfacility_id,"3");
    BCOLINTXT("newsfmfacility_id","","3");
    B_ROW();
    XHR();
    XH3("Other Key Changes (optional)");
    XBR();
    XH3COLOR("Clubs","green");
    BROW();
    BCOLCOLOR("gray","white","3");BTXT("Old Key");B_COL();
    BCOLCOLOR("gray","white","3");BTXT("New Key");B_COL();
    B_ROW();
    $cluba = List2Array($GLOBALS{'sfmfacility_sfmclubidlist'});
    foreach ($cluba as $oldsfmclub_id) {
        BROW();
        BCOLTXT($oldsfmclub_id,"3");
        BCOLINTXT("newsfmclub_id","","3");
        B_ROW();
    }
    XBR();
    XH3COLOR("Teams","green");
    BROW();
    BCOLCOLOR("gray","white","3");BTXT("Old Key");B_COL();
    BCOLCOLOR("gray","white","3");BTXT("New Key");B_COL();
    B_ROW();
    $teama = List2Array($GLOBALS{'sfmfacility_sfmteamidlist'});
    foreach ($teama as $oldsfmteam_id) {
        BROW();
        BCOLTXT($oldsfmteam_id,"3");
        BCOLINTXT("newsfmteam_id","","3");
        B_ROW();
    } 
}



?>