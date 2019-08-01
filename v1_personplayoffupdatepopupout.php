<?php # personplayoffupdateout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();

$inplayoffupdatepersonid = $_REQUEST['PlayOffUpdatePersonId'];

Check_Data("person",$inplayoffupdatepersonid);
if ($GLOBALS{'IOWARNING'} == "0") {
	person_PlayOffUpdate_Output($inplayoffupdatepersonid);
} else {
	XH2("Person Update");
	XPTXT("$inplayoffupdatepersonid - not found.");
}

PopUpFooter();

?>