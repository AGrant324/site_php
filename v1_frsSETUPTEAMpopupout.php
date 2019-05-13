<?php # personDM2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');

Get_Common_Parameters();
GlobalRoutine();
Setup_MYTEAM_CSSJS();
PopUpHeader();
Check_Session_Validity();
$inteamcode = $_REQUEST['team_code'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();
Setup_MYTEAM_Output($inteamcode);

PopUpFooter();

?>
