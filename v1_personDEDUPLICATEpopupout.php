<?php # personDM2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
person_DEDUPLICATE_CSSJS();
PopUpHeader();
Check_Session_Validity();
$actionperson_id1 = $_REQUEST['ActionPersonId1'];
$actionperson_id2 = $_REQUEST['ActionPersonId2'];

person_DEDUPLICATE_Output($actionperson_id1,$actionperson_id2);

XBR();
XINBUTTONCLOSEWINDOW("Cancel");
PopUpFooter();

?>
