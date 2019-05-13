<?php # personDM2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');

Get_Common_Parameters();
GlobalRoutine();
Setup_MYSECTIONGROUP_CSSJS();
PopUpHeader();
Check_Session_Validity();
$sectiongroup = $_REQUEST['SectionGroup'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Get_Person_Authority();

Setup_MYSECTIONGROUP_Output($sectiongroup);

PopUpFooter();

?>
