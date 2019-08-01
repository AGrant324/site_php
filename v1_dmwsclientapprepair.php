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

XH1("Application Repair");

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
// $downloada = scandir($userdir."/".$thisuserfolder."/Downloads");
// print_r($downloada);
// XPTXT($userdir."/".$thisuserfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientapprepairfiles.zip");
if (file_exists($userdir."/".$thisuserfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientapprepairfiles.zip")) {
    XPTXTCOLOR("Installed from ".$userfolder." folder","green"); 
    $downloadfound = "1";
} else {
    // try all directories again in case user of unexpected User directory   
    foreach ($userfoldera as $userfolder) {
        if (file_exists($userdir."/".$userfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientapprepairfiles.zip")) {
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
$res = $zip->open($userdir."/".$thisuserfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientapprepairfiles.zip");
if ($res === TRUE) {
    // if ($GLOBALS{'site_server'} == "W") { $basewwwdir    = '../../webroot/site_php/'; }
    // else { $basewwwdir    = '../../site_php/'; }
    if ($GLOBALS{'site_server'} == "W") { $basewwwdir    = '../site_php/'; }
    else { $basewwwdir    = '../site_php/'; }
    $zip->extractTo($basewwwdir);
    $zip->close();
    XBR();
    XPTXTCOLOR("Repair Completed Successfully","green");
} else {
    XH2("Error: Zip File not extracted successfully");
    Back_Navigator();
    PageFooter("Default","Final");
    return;
}

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

XH1("Application Repair");

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
// $downloada = scandir($userdir."/".$thisuserfolder."/Downloads");
// print_r($downloada);
// XPTXT($userdir."/".$thisuserfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientapprepairfiles.zip");
if (file_exists($userdir."/".$thisuserfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientapprepairfiles.zip")) {
    XPTXTCOLOR("Installed from ".$userfolder." folder","green"); 
    $downloadfound = "1";
} else {
    // try all directories again in case user of unexpected User directory   
    foreach ($userfoldera as $userfolder) {
        if (file_exists($userdir."/".$userfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientapprepairfiles.zip")) {
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
$res = $zip->open($userdir."/".$thisuserfolder."/Downloads/".$GLOBALS{'codeversion'}."_dmwsclientapprepairfiles.zip");
if ($res === TRUE) {
    // if ($GLOBALS{'site_server'} == "W") { $basewwwdir    = '../../webroot/site_php/'; }
    // else { $basewwwdir    = '../../site_php/'; }
    if ($GLOBALS{'site_server'} == "W") { $basewwwdir    = '../site_php/'; }
    else { $basewwwdir    = '../site_php/'; }
    $zip->extractTo($basewwwdir);
    $zip->close();
    XBR();
    XPTXTCOLOR("Repair Completed Successfully","green");
} else {
    XH2("Error: Zip File not extracted successfully");
    Back_Navigator();
    PageFooter("Default","Final");
    return;
}

Back_Navigator();
PageFooter("Default","Final");


?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
