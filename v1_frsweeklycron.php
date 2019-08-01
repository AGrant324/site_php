<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

$GLOBALS{'IOERRORcode'} = "FWC001";
$GLOBALS{'IOERRORmessage'} = "remconnect.txt not found";
$remconnecta = Get_File_Array("../cgi-bin/remconnect.txt");

$rema = explode("|",$remconnecta[0]);
$GLOBALS{'LOGIN_service_id'} = $rema[0];
$GLOBALS{'LOGIN_domain_id'} = $rema[1];
$GLOBALS{'LOGIN_mode_id'} = $rema[2];	

GlobalRoutine();

Get_Data('person',"bbra");
$GLOBALS{'person_willingtohelp'} = date("D M d, Y G:i a");
Write_Data('person',"bbra");
?>

