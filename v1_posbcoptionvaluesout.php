<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Pos_BCOPTIONVALUES_CSSJS();
PopUpHeader();
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


$inbcoption_name = $_REQUEST["bcoption_name"];

Get_Data("bcoption",$inbcoption_name);
Pos_BCOPTIONVALUES_Output($GLOBALS{'bcoption_name'});

Back_Navigator();
PopUpFooter();

?>


