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

$outputrowarray = Array();
array_push($outputrowarray, "DATAHEADER", "TABLE", "team id", "team name", "club id", "existing division id",  "new division id");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));

$sorta = Array();
$sfmteama = Get_Array("sfmteam");
foreach ( $sfmteama as $sfmteam_id ) {
    Get_Data("sfmteam",$sfmteam_id);
    $record = $GLOBALS{'sfmteam_sfmleagueid'}.$GLOBALS{'sfmteam_sfmdivisionid'}.$sfmteam_id."|".$sfmteam_id."|".$GLOBALS{'sfmteam_name'}."|".$GLOBALS{'sfmteam_sfmclubid'}."|".$GLOBALS{'sfmteam_sfmdivisionid'};
    array_push($sorta, $record);
}
sort($sorta);

foreach ( $sorta as $sortid ) {
    $outputrowarray = Array();
    $bits = explode("|",$sortid);
    array_push($outputrowarray, "DATA", "sfmteam",$bits[1],$bits[2],$bits[3],$bits[4]);
    fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));
}

$outputrowarray = Array();
array_push($outputrowarray, "DATAEND", "TABLE", "", "", "", "", "");
fputcsv($GLOBALS{'IOFDOWNLOAD'} , CSVClean($outputrowarray));


Close_File_Write ($GLOBALS{'IOFDOWNLOAD'});

if ($derror == "0") {
	Download_File ($downloadfilename,"delete");
}

?>