<?php
require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";   
require_once "v1_siteroutines.php";
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();$inaccount_registrationkey = $_REQUEST['account_registrationkey'];$validkey = "0";if (strlen(strstr($inaccount_registrationkey,"Grassr00ts_")) > 0) {    $kbits = explode("_",$inaccount_registrationkey);    $packageid = $kbits[1];    Check_Data("package_".$packageid);    if ($GLOBALS{'IOWARNING'} == "0" ) { $validkey = "1"; }}if ( $validkey == "1" ) {       Account_RegistrationByKey2_Output($packageid);} else {    XPTXTCOLOR("Invalid Registration Key - Please try again","red");    XBR();    Account_RegistrationByKey1_Output();     }
Back_Navigator();
PageFooter("Default","Final");
