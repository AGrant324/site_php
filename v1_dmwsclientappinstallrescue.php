<<<<<<< HEAD
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

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

XH1("Application Installer Rescue");

// identify the Downloads directory
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
if (file_exists($userdir."/".$thisuserfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientappinstall.php")) {
    $downloadfound = "1";
} else {
    // try all directories again in case user of unexpected User directory   
    foreach ($userfoldera as $userfolder) {
        if ($userdir."/".$thisuserfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientappinstall.php") {
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

$fromfile = $userdir."/".$thisuserfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientappinstall.php";
$tofile = $GLOBALS{'codeversion'}."_dmwsclientappinstall.php";
copy($fromfile,$tofile);

Back_Navigator();
PageFooter("Default","Final");


?>


=======
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

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

XH1("Application Installer Rescue");

// identify the Downloads directory
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
if (file_exists($userdir."/".$thisuserfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientappinstall.php")) {
    $downloadfound = "1";
} else {
    // try all directories again in case user of unexpected User directory   
    foreach ($userfoldera as $userfolder) {
        if ($userdir."/".$thisuserfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientappinstall.php") {
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

$fromfile = $userdir."/".$thisuserfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientappinstall.php";
$tofile = $GLOBALS{'codeversion'}."_dmwsclientappinstall.php";
copy($fromfile,$tofile);

Back_Navigator();
PageFooter("Default","Final");


?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
