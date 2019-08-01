<<<<<<< HEAD
<?php # setupuploadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

// print_r($_FILES);

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,jqdatatablesfixedcolumnsmin,uploadreport";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$testorreal = $_REQUEST["TestorReal"];
$firstorconfirm = $_REQUEST["FirstOrConfirm"];
$extendedtrace = $_REQUEST["ExtendedTrace"];
if ( isset($_REQUEST['LastFileTimeStamp']) ) { $inlastfiletimestamp = $_REQUEST["LastFileTimeStamp"]; } else { $inlastfiletimestamp = ""; }


if ($testorreal == "R") {$modetext = "Real Mode";} else {$modetext = "Test Mode";}
print '<h2>Data Upload - "'.$modetext.'"</h2>'."\n";

if ( $firstorconfirm == "First" ) {
    $maxfilesize = "10000000";
    $continuewithupload  = "1";
    $uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"dataupload.csv","csv",$maxfilesize,"","","","");
    # uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
    // return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
    $uploadstringa = explode("|",$uploadstring);
    $uploaderrorcode = $uploadstringa[0];
    $uploadmessage = $uploadstringa[1];
    $uploadfilename = $uploadstringa[2];
    $uploadfilenamea = explode(".",$uploadfilename);
    $uploadfiletype = $uploadfilenamea[1];
} else {   
    $lastfiletimestamp = date ("ymdHis", filemtime($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/dataupload.csv"));
    // XPTXT($inlastfiletimestamp." ".$lastfiletimestamp);
    if ( $inlastfiletimestamp == $lastfiletimestamp) {
        $uploaderrorcode = "0";        
    } else {
        $uploadmessage = "Cannot find uploaded file. Please re-load from previous step.";
        $uploaderrorcode = "1";
    }
}

if ($uploaderrorcode == "0") { 
    if ( ($firstorconfirm == "First" )&&($testorreal == "T") ) {
        $lastfiletimestamp = date ("ymdHis", filemtime($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/dataupload.csv"));
        XHR();
        $link = YPGMLINK("setupuploadin.php").YPGMSTDPARMS();
        $link = $link.YPGMPARM("TestorReal","R");
        $link = $link.YPGMPARM("FirstOrConfirm","Confirm");
        $link = $link.YPGMPARM("ExtendedTrace",$extendedtrace);
        $link = $link.YPGMPARM("LastFileTimeStamp",$lastfiletimestamp);
        XLINKBUTTON($link,"I'm OK with this Test. Now process the data upload in Real mode.");
        XBR();XBR();
        XLINKBACKBUTTON("Cancel.");
        XBR();
        XHR();
    }
	Upload_Data($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/dataupload.csv",$testorreal,$extendedtrace);
} else {
	XPTXT($uploadmessage,"red");
}

Back_Navigator();
PageFooter("Default","Final");

?>

=======
<?php # setupuploadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

// print_r($_FILES);

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,jqdatatablesfixedcolumnsmin,uploadreport";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$testorreal = $_REQUEST["TestorReal"];
$firstorconfirm = $_REQUEST["FirstOrConfirm"];
$extendedtrace = $_REQUEST["ExtendedTrace"];
if ( isset($_REQUEST['LastFileTimeStamp']) ) { $inlastfiletimestamp = $_REQUEST["LastFileTimeStamp"]; } else { $inlastfiletimestamp = ""; }


if ($testorreal == "R") {$modetext = "Real Mode";} else {$modetext = "Test Mode";}
print '<h2>Data Upload - "'.$modetext.'"</h2>'."\n";

if ( $firstorconfirm == "First" ) {
    $maxfilesize = "10000000";
    $continuewithupload  = "1";
    $uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"dataupload.csv","csv",$maxfilesize,"","","","");
    # uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
    // return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
    $uploadstringa = explode("|",$uploadstring);
    $uploaderrorcode = $uploadstringa[0];
    $uploadmessage = $uploadstringa[1];
    $uploadfilename = $uploadstringa[2];
    $uploadfilenamea = explode(".",$uploadfilename);
    $uploadfiletype = $uploadfilenamea[1];
} else {   
    $lastfiletimestamp = date ("ymdHis", filemtime($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/dataupload.csv"));
    // XPTXT($inlastfiletimestamp." ".$lastfiletimestamp);
    if ( $inlastfiletimestamp == $lastfiletimestamp) {
        $uploaderrorcode = "0";        
    } else {
        $uploadmessage = "Cannot find uploaded file. Please re-load from previous step.";
        $uploaderrorcode = "1";
    }
}

if ($uploaderrorcode == "0") { 
    if ( ($firstorconfirm == "First" )&&($testorreal == "T") ) {
        $lastfiletimestamp = date ("ymdHis", filemtime($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/dataupload.csv"));
        XHR();
        $link = YPGMLINK("setupuploadin.php").YPGMSTDPARMS();
        $link = $link.YPGMPARM("TestorReal","R");
        $link = $link.YPGMPARM("FirstOrConfirm","Confirm");
        $link = $link.YPGMPARM("ExtendedTrace",$extendedtrace);
        $link = $link.YPGMPARM("LastFileTimeStamp",$lastfiletimestamp);
        XLINKBUTTON($link,"I'm OK with this Test. Now process the data upload in Real mode.");
        XBR();XBR();
        XLINKBACKBUTTON("Cancel.");
        XBR();
        XHR();
    }
	Upload_Data($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/dataupload.csv",$testorreal,$extendedtrace);
} else {
	XPTXT($uploadmessage,"red");
}

Back_Navigator();
PageFooter("Default","Final");

?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
