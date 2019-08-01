<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

XH3("Add New Team");
XHR(); 
XBR();

$insfmteam_id = $_REQUEST['sfmteam_id'];
$insfmteam_name = $_REQUEST['sfmteam_name'];        
$insfmdivision_id = $_REQUEST['sfmdivision_id'];
$insfmclub_id = $_REQUEST['sfmclub_id'];
$infmclub_name = $_REQUEST['sfmclub_name'];
$insfmfacility_id = $_REQUEST['sfmfacility_id'];
$insfmfacility_name = $_REQUEST['sfmfacility_name'];

$loaderror = "0";

$sfmleagueid_id = "";
Check_Data("sfmdivision",$insfmdivision_id);
if ($GLOBALS{'IOWARNING'} == "0" ) {
    $sfmleagueid_id = $GLOBALS{'sfmdivision_sfmleagueid'};
    $thisgender = $GLOBALS{'sfmdivision_gender'};
    $thisgradingtarget = $GLOBALS{'sfmdivision_gradingtarget'};
    $thisstep = $GLOBALS{'sfmdivision_step'};
} else {
    XPTXTCOLOR("Error: Division ".$insfmdivision_id." not found","red");
    $loaderror = "1";
}

Check_Data('sfmteam',$insfmteam_id);
if ($GLOBALS{'IOWARNING'} == "1" ) {
    Initialise_Data('sfmteam');
    $GLOBALS{'sfmteam_name'} = $insfmteam_name;
    $GLOBALS{'sfmteam_sfmclubid'} = $insfmclub_id;
    $GLOBALS{'sfmteam_sfmfacilityidlist'} = $insfmfacility_id;
    $GLOBALS{'sfmteam_sfmdivisionid'} = $insfmdivision_id;
    $GLOBALS{'sfmteam_sfmleagueid'} = $sfmleagueid_id;
    $GLOBALS{'sfmteam_gradingtarget'} = $thisgradingtarget;
    $GLOBALS{'sfmteam_gender'} = $thisgender;
} else {
    XPTXTCOLOR("Error: Team ".$insfmteam_id." already exists","red");
    $loaderror = "1";
}

Check_Data('sfmfacility',$insfmfacility_id);
if ($GLOBALS{'IOWARNING'} == "1" ) { 
    Initialise_Data('sfmfacility'); 
    $GLOBALS{'sfmfacility_name'} = $insfmfacility_name;
}
$GLOBALS{'sfmfacility_sfmclubidlist'} = CommaList_Add($GLOBALS{'sfmfacility_sfmclubidlist'}, $insfmclub_id);
$GLOBALS{'sfmfacility_sfmteamidlist'} = CommaList_Add($GLOBALS{'sfmfacility_sfmteamidlist'}, $insfmteam_id);
$GLOBALS{'sfmfacility_sfmleagueidlist'} = CommaList_Add($GLOBALS{'sfmfacility_sfmleagueidlist'}, $sfmleague_id);
$GLOBALS{'sfmfacility_sfmdivisionidlist'} = CommaList_Add($GLOBALS{'sfmfacility_sfmdivisionidlist'}, $sfmdivision_id);

Check_Data('sfmclub',$insfmclub_id);
if ($GLOBALS{'IOWARNING'} == "1" ) {
    Initialise_Data('sfmclub');
    $GLOBALS{'sfmclub_name'} = $insfmclub_name;
    $GLOBALS{'sfmclub_gender'} = $thisgender;
} 
$GLOBALS{'sfmclub_sfmfacilityidlist'} = CommaList_Add($GLOBALS{'sfmclub_sfmfacilityidlist'}, $insfmfacility_id);
$GLOBALS{'sfmclub_sfmteamidlist'} = CommaList_Add($GLOBALS{'sfmclub_sfmteamidlist'}, $insfmteam_id);
$GLOBALS{'sfmclub_sfmleagueidlist'} = CommaList_Add($GLOBALS{'sfmclub_sfmleagueidlist'}, $sfmleague_id);
$GLOBALS{'sfmclub_sfmdivisionidlist'} = CommaList_Add($GLOBALS{'sfmclub_sfmdivisionidlist'}, $sfmdivision_id);

if ($loaderror == "0") {
    Write_Data('sfmteam',$insfmteam_id);  
    Write_Data('sfmclub',$insfmclub_id);  
    Write_Data('sfmfacility',$insfmfacility_id);
    XPTXTCOLOR("Team ".$insfmteam_id." added successfully","green");
    XBR();
    // SFM_SFMDATALISTSUPDATE_Output ();
}

Back_Navigator();
PageFooter("Default","Final");
?>

