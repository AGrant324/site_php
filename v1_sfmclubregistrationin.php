<?php # personloginin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();
$insfmset_id = $_REQUEST['sfmset_id'];
$insfmset_clubregistrationkey = $_REQUEST['sfmset_clubregistrationkey'];Check_Data("sfmset",$insfmset_id);if ($GLOBALS{'IOWARNING'} != "0") {    XPTXTCOLOR("Sorry this Registration Group has not been recognised.","red");    SFM_ClubRegistration_Output();} else {    if ($insfmset_clubregistrationkey != $GLOBALS{'sfmset_clubregistrationkey'}) {        XPTXTCOLOR("Sorry this Registration Key has not been recognised.","red");        SFM_ClubRegistration_Output();    } else {        SFM_ClubRegistrationCompletion_Output($insfmset_id);    }}
Back_Navigator();
PageFooter("Default","Final");

?>

