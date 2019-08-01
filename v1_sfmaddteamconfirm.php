<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');
require_once('v1_libraryroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

XH3("Add New Team");
XHR(); 
XBR();

$innewsfmteam_name = $_REQUEST['newsfmteam_name'];
$innewsfmteam_id = $_REQUEST['newsfmteam_id'];
$insfmdivision_id = $_REQUEST['sfmdivision_id'];
$insfmclub_id = $_REQUEST['sfmclub_id'];
$innewsfmclub_name = $_REQUEST['newsfmclub_name'];
$innewsfmclub_id = $_REQUEST['newsfmclub_id'];
$insfmfacility_id = $_REQUEST['sfmfacility_id'];
$innewsfmfacility_name = $_REQUEST['newsfmfacility_name'];
$innewsfmfacility_id = $_REQUEST['newsfmfacility_id'];

$dataerror = "0";
$existingclub = "0";
$existingfacility = "0";

// auto create input keys from name

$innewsfmteam_id = preg_replace("/[^A-Za-z0-9]/", '', $innewsfmteam_name);
if (($insfmfacility_id == "")&&($innewsfmfacility_name == "")) { 
    $innewsfmfacility_name = $innewsfmteam_name; 
    $innewsfmfacility_id = preg_replace("/[^A-Za-z0-9]/", '', $innewsfmteam_name); 
    
}  
if (($insfmclub_id == "")&&($innewsfmclub_name == "")) { 
    $innewsfmclub_name = $innewsfmteam_name;     
    $innewsfmclub_id = preg_replace("/[^A-Za-z0-9]/", '', $innewsfmteam_name); 
}   

// placeholders set as inputs
$thissfmteam_id = $innewsfmteam_id;
$thissfmteam_name = $innewsfmteam_name;
$thissfmdivision_id = $insfmdivision_id;
$thissfmdivision_name = $insfmdivision_name;
$thissfmclub_id = $insfmclub_id;
$thissfmclub_name = $insfmclub_name;
$thissfmfacility_id = $insfmfacility_id;
$thissfmfacility_name = $insfmfacility_name;

// basic edits
if ( $innewsfmteam_name == "" ) {
    XPTXTCOLOR("No Team name entered","red");
    $dataerror = "1";
}

if ( ($insfmfacility_id == "" )&&( $innewsfmfacility_name == "" ) ) {
    XPTXTCOLOR("No Facility name entered","red");
    $dataerror = "1";
}

if ( $insfmdivision_id == "" ) {
    XPTXTCOLOR("No division entered","red");
    $dataerror = "1";
} else {
    Check_Data("sfmdivision",$insfmdivision_id);
    if ($GLOBALS{'IOWARNING'} == "1" ) { 
        XPTXTCOLOR("Division ".$insfmdivision_id." does not exist.");
        $dataerror = "1";
    } else {
        $thissfmdivision_id = $insfmdivision_id;
        $thissfmdivision_name = $GLOBALS{'sfmdivision_name'};
    }
}

if ( $insfmfacility_id == "" ) {
    // new facility
    Check_Data("sfmfacility",$innewsfmfacility_id);
    if ($GLOBALS{'IOWARNING'} == "0" ) { 
        XPTXTCOLOR("Facility ".$innewsfmclub_id." already exists - Please check.","red");
        $dataerror = "1";
    }
    $thissfmfacility_id = $innewsfmfacility_id;
    $thissfmfacility_name = $innewsfmfacility_name;
} else {
    // existing faciity
    $existingfacility = "1";
    Check_Data("sfmfacility",$insfmfacility_id);
    if ($GLOBALS{'IOWARNING'} == "1" ) { 
        XPTXTCOLOR("Facility ".$insfmfacility_id." does not exist.","red");
        $dataerror = "1";
    }
    $thissfmfacility_id = $insfmfacility_id;
    $thissfmfacility_name = $GLOBALS{'sfmfacility_name'};
}

if ( $insfmclub_id == "" ) {
    // new club
    Check_Data("sfmclub",$innewsfmclub_id);
    if ($GLOBALS{'IOWARNING'} == "0" ) { 
        XPTXTCOLOR("Club ".$innewsfmclub_id." already exists - Please check.","red");
        $dataerror = "1";
    }
    $thissfmclub_id = $innewsfmclub_id;
    $thissfmclub_name = $innewsfmclub_name;
} else { 
    // existing club
    $existingclub = "1";
    Check_Data("sfmclub",$insfmclub_id);
    if ($GLOBALS{'IOWARNING'} == "1" ) { 
        XPTXTCOLOR("Club ".$insfmclub_id." does not exist.");
        $dataerror = "1";
    }
    $thissfmclub_id = $insfmclub_id;
    $thissfmclub_name = $GLOBALS{'sfmclub_name'};
}
    
if ( $dataerror == "0" ) {
    
    XH3("The team will be set up as follows:");
    
    BROW();
    BCOLTXT("Team Name","2");
    BCOLTXT($thissfmteam_name,"3");
    BCOLTXTRIGHT("Id","1");
    BCOLTXT($thissfmteam_id,"3");    
    B_ROW();
    BROW();
    BCOLTXT("Division Name","2");
    BCOLTXT($thissfmdivision_name,"3");
    BCOLTXTRIGHT("Id","1");
    BCOLTXT($thissfmdivision_id,"3");    
    B_ROW();
    BROW();
    BCOLTXT("Facility Name","2");
    BCOLTXT($thissfmfacility_name,"3");
    BCOLTXTRIGHT("Id","1");
    BCOLTXT($thissfmfacility_id,"3");
    if ( $existingfacility == "0" ) { BCOLTXT("Newly created Facility","3"); }
    else { BCOLTXT("Existing Facility","3"); }
    B_ROW();
    BROW();
    BCOLTXT("Club Name","2");
    BCOLTXT($thissfmclub_name,"3");
    BCOLTXTRIGHT("Id","1");
    BCOLTXT($thissfmclub_id,"3");   
    if ( $existingclub == "0" ) { BCOLTXT("Newly created Club","3"); }
    else { BCOLTXT("Existing Club","3"); }
    B_ROW();

    XHR();
    $link = YPGMLINK("sfmaddteamaction.php").YPGMSTDPARMS();
    $link = $link.YPGMPARM("sfmteam_id",$thissfmteam_id);   
    $link = $link.YPGMPARM("sfmteam_name",$thissfmteam_name);
    $link = $link.YPGMPARM("sfmdivision_id",$thissfmdivision_id);
    $link = $link.YPGMPARM("sfmfacility_id",$thissfmfacility_id);    
    $link = $link.YPGMPARM("sfmfacility_name",$thissfmfacility_name);    
    $link = $link.YPGMPARM("sfmclub_id",$thissfmclub_id);
    $link = $link.YPGMPARM("sfmclub_name",$thissfmclub_name);

    XLINKBUTTON($link,"I'm OK with this. Please proceed to add the team.");
    XBR();XBR();
    XLINKBACKBUTTON("Cancel.");
    XBR();
} else {   
    XHR();
    
    XH3("Data Entered:");
    
    BROW();
    BCOLTXT("Team Name","2");
    BCOLTXT($thissfmteam_name,"3");
    BCOLTXTRIGHT("Id","1");
    BCOLTXT($thissfmteam_id,"3");    
    B_ROW();
    BROW();
    BCOLTXT("Division Name","2");
    BCOLTXT($thissfmdivision_name,"3");
    BCOLTXTRIGHT("Id","1");
    BCOLTXT($thissfmdivision_id,"3");    
    B_ROW();
    BROW();
    BCOLTXT("Facility Name","2");
    BCOLTXT($thissfmfacility_name,"3");
    BCOLTXTRIGHT("Id","1");
    BCOLTXT($thissfmfacility_id,"3");
    if ( $existingfacility == "0" ) { BCOLTXT("Newly created Facility","3"); }
    else { BCOLTXT("Existing Facility","3"); }
    B_ROW();
    BROW();
    BCOLTXT("Club Name","2");
    BCOLTXT($thissfmclub_name,"3");
    BCOLTXTRIGHT("Id","1");
    BCOLTXT($thissfmclub_id,"3");   
    if ( $existingclub == "0" ) { BCOLTXT("Newly created Club","3"); }
    else { BCOLTXT("Existing Club","3"); }
    B_ROW();
    XBR();XBR();
    XLINKBACKBUTTON("Please correct errors.");
    XBR();
}

Back_Navigator();
PageFooter("Default","Final");
?>

