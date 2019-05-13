<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


$inbcoptionset_name = $_REQUEST["bcoptionset_name"];

Get_Data("bcoptionset",$inbcoptionset_name);
Pos_BCOPTIONSETRULES_Output($inbcoptionset_name);

Back_Navigator();
PopUpFooter();

?>


