<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,jqdatatablesfixedcolumnsmin,report";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$synchdownfilename = $_REQUEST["SynchDownFilename"];
$synchroniseappversion = $_REQUEST["SynchAppVersion"];
$sqlchangesreqd = $_REQUEST["SQLChangesReqd"];


if ($GLOBALS{'site_server'} != "W") {
    // overwrite key site file parameters just to be sure.
    Get_Data("site_dmws");  
    $GLOBALS{'site_filepath'} = "../../cgi-files";
    Write_Data("site_dmws"); 
    $GLOBALS{'domainfilepath'} = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}; 
    
    // check key file directories are in place    
    if (file_exists($GLOBALS{'site_filepath'}."/dmwsclient")) {} else {
        XPTXTCOLOR("cgi-files/dmwsclient directory created","orange"); 
        mkdir($GLOBALS{'site_filepath'}."/dmwsclient");
        mkdir($GLOBALS{'site_filepath'}."/"."/dmwsclient"."/personphotos", 0777);
        mkdir($GLOBALS{'site_filepath'}."/"."/dmwsclient"."/assets", 0777);
        mkdir($GLOBALS{'site_filepath'}."/"."/dmwsclient"."/mpdfreports", 0777);
    }
}

// $extendedtrace = $_REQUEST["ExtendedTrace"];
$extendedtrace = "No";

XH1("Application Update Installation");

// XPTXT($synchdownfilename." ".$sqlchangesreqd);

// identify the Downloads directory where the application updates zipfile is stored
if ($GLOBALS{'site_server'} == "W") { $userdir    = '../../../../../Users'; }
else { $userdir    = '../../../Users'; }
$userfoldera = scandir($userdir);

// print_r($userfoldera);

$thisuserfolder = "";
foreach ($userfoldera as $userfolder) {
    if ((strpos($userfolder, "Default") === False)
        &&(strpos($userfolder, "Public") === False)
        &&(strpos($userfolder, "User") === False)
        &&(strpos($userfolder, "user") === False)
        &&(strpos($userfolder, "LogMeInRemoteUser") === False)
        &&(strpos($userfolder, ".") === False)) {
            $thisuserfolder = $userfolder;
        }
}
if ( $thisuserfolder == "" ) { $thisuserfolder = "user";  }
// XPTXT($thisuserfolder);

$downloadfound = "0";
// XPTXT($userdir."/".$thisuserfolder."/Downloads/".$synchdownfilename);  
// $downloada = scandir($userdir."/".$thisuserfolder."/Downloads");
// print_r($downloada);
if (file_exists($userdir."/".$thisuserfolder."/Downloads/".$synchdownfilename)) {
    $downloadfound = "1";
} else {
    // try all directories again in case user of unexpected User directory   
    foreach ($userfoldera as $userfolder) {
        if (file_exists($userdir."/".$userfolder."/Downloads/".$synchdownfilename)) {
            $thisuserfolder = $userfolder;
            XPTXTCOLOR("Installed from ".$userfolder." folder","green"); 
            $downloadfound = "1";
        }
    }
}
//  XPTXT($thisuserfolder); 

if ( $downloadfound == "0" ) {
    XH2("Error: Download File Not Found");
    Back_Navigator();
    PageFooter("Default","Final");
    return;
}

$zip = new ZipArchive;
$res = $zip->open($userdir."/".$thisuserfolder."/Downloads/".$synchdownfilename);
if ($res === TRUE) { 
    if ($GLOBALS{'site_server'} == "W") { $basewwwdir    = '../../webroot'; }
    else { $basewwwdir    = '../../'; }   
    $zip->extractTo($basewwwdir);
    $zip->close();
    XBR();
    $oldsynchroniseappversion = $GLOBALS{'site_synchroniseappversion'};
    Get_Data("site_dmws");
    $GLOBALS{'site_synchroniseappversion'} = $synchroniseappversion;
    Write_Data("site_dmws");
    XPTXTCOLOR("Upgrade Completed Successfully from version ".$oldsynchroniseappversion." to version ".$synchroniseappversion,"green"); 
} else {
    XH2("Error: Zip File not extracted successfully");
    Back_Navigator();
    PageFooter("Default","Final");
    return;
}

if ( $sqlchangesreqd == "1" ) {
    XBR();
    XHRCLASS('underline');
    XH2("Apply Database Changes");
    XPTXT("This update also requires a database change");
    XFORM("setupsqlmaintainout.php","");
    XINSTDHID();
    XINHID("TestorReal","R");
    XINHID("ExtendedTrace","No");
    /*
    XTABLEINVISIBLE();
    XINSTDHID();
    XINRADIO("TestorReal","R","checked","");XTXT("Normal Mode<BR>");
    XBR();
    XTABLE();XTRODD();XTD();
    XINRADIO("TestorReal","T","","");XTXT("Test Mode (no updates made)<BR>");
    XBR();
    XINCHECKBOXYESNO("ExtendedTrace", "", "Extended Trace Information");
    XBR();
    X_TD();X_TR();X_TABLE();
    */
    XBR();
    XINSUBMIT("Update Database");
    X_FORM();  
} else {
    XBR();
    XPTXTCOLOR("Your Database is up to date. No further action is required","green");
}


Back_Navigator();
PageFooter("Default","Final");


?>


