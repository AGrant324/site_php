<<<<<<< HEAD
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

$fulldownload = $_REQUEST["FullDownload"];
// $extendedtrace = $_REQUEST["ExtendedTrace"];
$extendedtrace = "No";

XH1("Application Updates");

$recsep = chr(135); // double cross
$fieldsep = chr(134); // dagger  

// ===== Get Timestamps for each file in App ============

$uploaddatastring = "";
$uploadreporta = Array();
$foldera = array ("site_css","site_javascript","site_php","site_assets","site_sql");
$upseq = 0;
foreach ($foldera as $folder) {
    $highestfiletimestamp = "";
    $filenamea = Get_Directory_Array ("../".$folder);  
    foreach ($filenamea as $filename) {
        $fbits = explode('_',$filename);
        if (($fbits[0] == "v1")||($filename == "sqldesign.csv")||($folder == "site_assets")) {
            $filetimestamp = "T".date("YmdHis",filemtime("../".$folder."/".$filename));
            // if ($folder == "site_assets") { XPTXT($filename." ".$filetimestamp); }
            if ($filetimestamp > $highestfiletimestamp) { $highestfiletimestamp = $filetimestamp; }
        }
    }
    if ( $fulldownload == "Yes" ) {
        $uploaddatastring = $uploaddatastring.$recsep.$folder.$fieldsep."FullDownload";      
    } else {
        $uploaddatastring = $uploaddatastring.$recsep.$folder.$fieldsep.$highestfiletimestamp;    
    }
    
    array_push ($uploadreporta,$folder.$fieldsep.$highestfiletimestamp);
}

if ( $extendedtrace == "Yes" ) {
    XHRCLASS('underline');
    XH2("Current Application Level");  
    XPTXT("The following status information about your current application level has been sent to the server");   
    XDIV("reportdiv_upload","container");
    XTABLEJQDTID("reporttable_upload");
    XTHEAD();
    XTRJQDT();
    XTDTXT("Seq");
    XTDTXT("Folder");
    XTDTXT("Latest Version");
    X_TR();
    X_THEAD();
    XTBODY();

    $upseq = 0;
    foreach ($uploadreporta as $upelement) {
        $bitsa = explode($fieldsep,$upelement);
        $upseq++;
        XTRJQDT();
        XTDTXT($upseq);
        XTDTXT($bitsa[0]);
        XTDTXT(TimestamptoDDMMMYYYYbHHcMM($bitsa[1]));
        X_TR();
    }

    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv_upload");
    XCLEARFLOAT();
}

if ($GLOBALS{'site_server'} == "W") { $domainid = "dmws"; }
else { $domainid = "dmwsportal"; }

// XPTXT($uploaddatastring);

$post = array (
    'ServiceId' => "dmws",
    'DomainId' => $domainid,
    'ModeId' => $GLOBALS{'LOGIN_mode_id'},
    'PersonId' => $GLOBALS{'LOGIN_person_id'},
    'SessionId' => $GLOBALS{'LOGIN_session_id'},
    'TestorReal' => $testorreal,
    'SynchUpData' => $uploaddatastring
);


$ch = curl_init($GLOBALS{'site_synchroniseurl'}."/site_php/v1_dmwsclientappsynchroniseprovider.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// XPTXT($response);

// close the connection, release resources used
curl_close($ch);

$anychangesreqd = "0";
$sqlchangesreqd = "0";
$downloadfilename = "";
$downloadreporta = Array();
$responsea = explode($recsep,$response);
foreach ($responsea as $responseelement) {
    if ( $responseelement != "" ) {
        // folder filename timestamp prevhighesttimestamp
        $bitsa = explode($fieldsep,$responseelement);
        array_push ($downloadreporta,$responseelement);
        if ($bitsa[1] == "sqldesign.csv") { $sqlchangesreqd = "1";}
        if ($bitsa[0] == "ZIPFILENAME") { $downloadfilename = $bitsa[1];}
        else { $anychangesreqd = "1"; }
    }
}    

if ( $anychangesreqd == "1" ) {    
    XBR();
    XHRCLASS('underline');
    // XH2("Step 1: Download and Apply Application Updates");
    XPTXT("The following application updates are required");   
    XDIV("reportdiv_download","container");
    XTABLEJQDTID("reporttable_download");
    XTHEAD();
    XTRJQDT();
    XTDTXT("Seq");
    XTDTXT("Folder");
    XTDTXT("File");
    XTDTXT("Latest Version");
    XTDTXT("Prev Folder Version");
    X_TR();
    X_THEAD();
    XTBODY();  
    $downseq = 0;
    foreach ($downloadreporta as $responseelement) {
        // folder filename timestamp prevhighesttimestamp
        $bitsa = explode($fieldsep,$responseelement);
        if ($bitsa[0] == "ZIPFILENAME") { 
            $downloadfilename = $bitsa[1];
            $synchroniseappversion = $bitsa[2];
        } else {
            $downseq++;
            XTRJQDT();
            XTDTXT($downseq);
            XTDTXT($bitsa[0]);
            XTDTXT($bitsa[1]);
            XTDTXT(TimestamptoDDMMMYYYYbHHcMM($bitsa[2]));
            XTDTXT(TimestamptoDDMMMYYYYbHHcMM($bitsa[3]));
            X_TR();
        }
    } 
    
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv_".$uploadcsv[1]);
    XCLEARFLOAT();
    
    XBR();
    
    if ($GLOBALS{'site_server'} == "W") { $domainid = "dmws"; }
    else { $domainid = "dmwsportal"; }
    
    XBR();XBR();
    $link = $GLOBALS{'site_synchroniseurl'}."/site_php/v1_dmwsclientappsynchronisedownload.php?";
    $link = $link.YPGMPARM("ServiceId","dmws");
    $link = $link.YPGMPARM("DomainId",$domainid);
    $link = $link.YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'});
    $link = $link.YPGMPARM("PersonId",$GLOBALS{'LOGIN_person_id'});
    $link = $link.YPGMPARM("SessionId",$GLOBALS{'LOGIN_session_id'});
    $link = $link.YPGMPARM("SynchDownFilename",$downloadfilename);
    $link = $link.YPGMPARM("SynchAppVersion",$synchroniseappversion);
    XTXT("Step 1: ");
    XLINKBUTTON ($link,"Download the Updates and Save");
    XTXT(" (Note: No need to Open Folder or View Downloads after saving.)");
    
    XBR();XBR();
    $link = YPGMLINK("dmwsclientappinstall.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("SynchDownFilename",$downloadfilename).YPGMPARM("SynchAppVersion",$synchroniseappversion).YPGMPARM("SQLChangesReqd",$sqlchangesreqd);
    XTXT("Step 2: ");
    if ($GLOBALS{'site_server'} == "W") {
        XPTXT("This is test mode - Manually install the application updates");
    } else {
        XLINKBUTTON ($link,"Install the Updates");
    }
       
} else { 
    XBR();XBR();
    XPTXTCOLOR("Your Application is up to date. No further updates are required","green");
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
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,jqdatatablesfixedcolumnsmin,report";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$fulldownload = $_REQUEST["FullDownload"];
// $extendedtrace = $_REQUEST["ExtendedTrace"];
$extendedtrace = "No";

XH1("Application Updates");

$recsep = chr(135); // double cross
$fieldsep = chr(134); // dagger  

// ===== Get Timestamps for each file in App ============

$uploaddatastring = "";
$uploadreporta = Array();
$foldera = array ("site_css","site_javascript","site_php","site_assets","site_sql");
$upseq = 0;
foreach ($foldera as $folder) {
    $highestfiletimestamp = "";
    $filenamea = Get_Directory_Array ("../".$folder);  
    foreach ($filenamea as $filename) {
        $fbits = explode('_',$filename);
        if (($fbits[0] == "v1")||($filename == "sqldesign.csv")||($folder == "site_assets")) {
            $filetimestamp = "T".date("YmdHis",filemtime("../".$folder."/".$filename));
            // if ($folder == "site_assets") { XPTXT($filename." ".$filetimestamp); }
            if ($filetimestamp > $highestfiletimestamp) { $highestfiletimestamp = $filetimestamp; }
        }
    }
    if ( $fulldownload == "Yes" ) {
        $uploaddatastring = $uploaddatastring.$recsep.$folder.$fieldsep."FullDownload";      
    } else {
        $uploaddatastring = $uploaddatastring.$recsep.$folder.$fieldsep.$highestfiletimestamp;    
    }
    
    array_push ($uploadreporta,$folder.$fieldsep.$highestfiletimestamp);
}

if ( $extendedtrace == "Yes" ) {
    XHRCLASS('underline');
    XH2("Current Application Level");  
    XPTXT("The following status information about your current application level has been sent to the server");   
    XDIV("reportdiv_upload","container");
    XTABLEJQDTID("reporttable_upload");
    XTHEAD();
    XTRJQDT();
    XTDTXT("Seq");
    XTDTXT("Folder");
    XTDTXT("Latest Version");
    X_TR();
    X_THEAD();
    XTBODY();

    $upseq = 0;
    foreach ($uploadreporta as $upelement) {
        $bitsa = explode($fieldsep,$upelement);
        $upseq++;
        XTRJQDT();
        XTDTXT($upseq);
        XTDTXT($bitsa[0]);
        XTDTXT(TimestamptoDDMMMYYYYbHHcMM($bitsa[1]));
        X_TR();
    }

    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv_upload");
    XCLEARFLOAT();
}

if ($GLOBALS{'site_server'} == "W") { $domainid = "dmws"; }
else { $domainid = "dmwsportal"; }

// XPTXT($uploaddatastring);

$post = array (
    'ServiceId' => "dmws",
    'DomainId' => $domainid,
    'ModeId' => $GLOBALS{'LOGIN_mode_id'},
    'PersonId' => $GLOBALS{'LOGIN_person_id'},
    'SessionId' => $GLOBALS{'LOGIN_session_id'},
    'TestorReal' => $testorreal,
    'SynchUpData' => $uploaddatastring
);


$ch = curl_init($GLOBALS{'site_synchroniseurl'}."/site_php/v1_dmwsclientappsynchroniseprovider.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// XPTXT($response);

// close the connection, release resources used
curl_close($ch);

$anychangesreqd = "0";
$sqlchangesreqd = "0";
$downloadfilename = "";
$downloadreporta = Array();
$responsea = explode($recsep,$response);
foreach ($responsea as $responseelement) {
    if ( $responseelement != "" ) {
        // folder filename timestamp prevhighesttimestamp
        $bitsa = explode($fieldsep,$responseelement);
        array_push ($downloadreporta,$responseelement);
        if ($bitsa[1] == "sqldesign.csv") { $sqlchangesreqd = "1";}
        if ($bitsa[0] == "ZIPFILENAME") { $downloadfilename = $bitsa[1];}
        else { $anychangesreqd = "1"; }
    }
}    

if ( $anychangesreqd == "1" ) {    
    XBR();
    XHRCLASS('underline');
    // XH2("Step 1: Download and Apply Application Updates");
    XPTXT("The following application updates are required");   
    XDIV("reportdiv_download","container");
    XTABLEJQDTID("reporttable_download");
    XTHEAD();
    XTRJQDT();
    XTDTXT("Seq");
    XTDTXT("Folder");
    XTDTXT("File");
    XTDTXT("Latest Version");
    XTDTXT("Prev Folder Version");
    X_TR();
    X_THEAD();
    XTBODY();  
    $downseq = 0;
    foreach ($downloadreporta as $responseelement) {
        // folder filename timestamp prevhighesttimestamp
        $bitsa = explode($fieldsep,$responseelement);
        if ($bitsa[0] == "ZIPFILENAME") { 
            $downloadfilename = $bitsa[1];
            $synchroniseappversion = $bitsa[2];
        } else {
            $downseq++;
            XTRJQDT();
            XTDTXT($downseq);
            XTDTXT($bitsa[0]);
            XTDTXT($bitsa[1]);
            XTDTXT(TimestamptoDDMMMYYYYbHHcMM($bitsa[2]));
            XTDTXT(TimestamptoDDMMMYYYYbHHcMM($bitsa[3]));
            X_TR();
        }
    } 
    
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv_".$uploadcsv[1]);
    XCLEARFLOAT();
    
    XBR();
    
    if ($GLOBALS{'site_server'} == "W") { $domainid = "dmws"; }
    else { $domainid = "dmwsportal"; }
    
    XBR();XBR();
    $link = $GLOBALS{'site_synchroniseurl'}."/site_php/v1_dmwsclientappsynchronisedownload.php?";
    $link = $link.YPGMPARM("ServiceId","dmws");
    $link = $link.YPGMPARM("DomainId",$domainid);
    $link = $link.YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'});
    $link = $link.YPGMPARM("PersonId",$GLOBALS{'LOGIN_person_id'});
    $link = $link.YPGMPARM("SessionId",$GLOBALS{'LOGIN_session_id'});
    $link = $link.YPGMPARM("SynchDownFilename",$downloadfilename);
    $link = $link.YPGMPARM("SynchAppVersion",$synchroniseappversion);
    XTXT("Step 1: ");
    XLINKBUTTON ($link,"Download the Updates and Save");
    XTXT(" (Note: No need to Open Folder or View Downloads after saving.)");
    
    XBR();XBR();
    $link = YPGMLINK("dmwsclientappinstall.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("SynchDownFilename",$downloadfilename).YPGMPARM("SynchAppVersion",$synchroniseappversion).YPGMPARM("SQLChangesReqd",$sqlchangesreqd);
    XTXT("Step 2: ");
    if ($GLOBALS{'site_server'} == "W") {
        XPTXT("This is test mode - Manually install the application updates");
    } else {
        XLINKBUTTON ($link,"Install the Updates");
    }
       
} else { 
    XBR();XBR();
    XPTXTCOLOR("Your Application is up to date. No further updates are required","green");
}


Back_Navigator();
PageFooter("Default","Final");


?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
