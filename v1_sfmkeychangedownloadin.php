<?php # setupdownloadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');


Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();
$downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/datadownload_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".csv";
$GLOBALS{'IOFDOWNLOAD'} = Open_File_Write ($downloadfilename);

$derror = "0";

// === sfmteam ================================
$outputrowarray = Array();
array_push($outputrowarray, "DATAHEADER", "sfmteam", "team id", "team name", "new team id", "new team name");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));

$sfmteama = Get_Array("sfmteam");
sort($sfmteama);
foreach ( $sfmteama as $sfmteam_id ) {
    Get_Data("sfmteam",$sfmteam_id);
    $outputrowarray = Array();
    array_push($outputrowarray, "DATA", "sfmteam",$sfmteam_id,$GLOBALS{'sfmteam_name'},"","");
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));
}

$outputrowarray = Array();
array_push($outputrowarray, "DATAEND", "sfmteam", "", "", "", "");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));
$outputrowarray = Array();
array_push($outputrowarray, "", "", "", "", "", "");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));

// === sfmclub ================================
$outputrowarray = Array();
array_push($outputrowarray, "DATAHEADER", "sfmclub", "club id", "club name", "new club id", "new club name");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));

$sfmcluba = Get_Array("sfmclub");
sort($sfmcluba);
foreach ( $sfmcluba as $sfmclub_id ) {
    Get_Data("sfmclub",$sfmclub_id);
    $outputrowarray = Array();
    array_push($outputrowarray, "DATA", "sfmclub",$sfmclub_id,$GLOBALS{'sfmclub_name'},"","");
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));
}

$outputrowarray = Array();
array_push($outputrowarray, "DATAEND", "sfmclub", "", "", "", "");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));
$outputrowarray = Array();
array_push($outputrowarray, "", "", "", "", "", "");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));


// === sfmfaciity ================================
$outputrowarray = Array();
array_push($outputrowarray, "DATAHEADER", "sfmfacility", "facility id", "facility name", "new facility id", "new facility name");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));

$sfmfacilitya = Get_Array("sfmfacility");
sort($sfmfacilitya);
foreach ( $sfmfacilitya as $sfmfacility_id ) {
    Get_Data("sfmfacility",$sfmfacility_id);
    $outputrowarray = Array();
    array_push($outputrowarray, "DATA", "sfmfacility",$sfmfacility_id,$GLOBALS{'sfmfacility_name'},"","");
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));
}

$outputrowarray = Array();
array_push($outputrowarray, "DATAEND", "sfmfacility", "", "", "", "");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));
$outputrowarray = Array();
array_push($outputrowarray, "", "", "", "", "", "");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));

// === sfmleague ================================
$outputrowarray = Array();
array_push($outputrowarray, "DATAHEADER", "sfmleague", "league id", "league name", "new league id", "new league name");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));

$sfmleaguea = Get_Array("sfmleague");
sort($sfmleaguea);
foreach ( $sfmleaguea as $sfmleague_id ) {
    Get_Data("sfmleague",$sfmleague_id);
    $outputrowarray = Array();
    array_push($outputrowarray, "DATA", "sfmleague",$sfmleague_id,$GLOBALS{'sfmleague_name'},"","");
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));
}

$outputrowarray = Array();
array_push($outputrowarray, "DATAEND", "sfmleague", "", "", "", "");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));
$outputrowarray = Array();
array_push($outputrowarray, "", "", "", "", "", "");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));

// === sfmdivision ================================
$outputrowarray = Array();
array_push($outputrowarray, "DATAHEADER", "sfmdivision", "division id", "division name", "new division id", "new division name");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));

$sfmdivisiona = Get_Array("sfmdivision");
sort($sfmdivisiona);
foreach ( $sfmdivisiona as $sfmdivision_id ) {
    Get_Data("sfmdivision",$sfmdivision_id);
    $outputrowarray = Array();
    array_push($outputrowarray, "DATA", "sfmdivision",$sfmdivision_id,$GLOBALS{'sfmdivision_name'},"","");
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));
}

$outputrowarray = Array();
array_push($outputrowarray, "DATAEND", "sfmdivision", "", "", "", "");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));

Close_File_Write ($GLOBALS{'IOFDOWNLOAD'});

if ($derror == "0") {
    Download_File ($downloadfilename,"delete");
}

?>