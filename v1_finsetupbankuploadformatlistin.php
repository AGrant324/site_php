<?php # finseupuploadformatlistin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


$acd = $_REQUEST["ACD"];
$inbankupload_id = $_REQUEST["BankuploadId"];

if ($acd == "A") {
 if ($inbankupload_id != "") {
  Initialise_Data("bankupload");
  $GLOBALS{'bankupload_id'} = $inbankupload_id;
  Write_Data("bankupload",$inbankupload_id);
  Fin_SETUPBANKUPLOADFORMATOLD_Output();
 }
}
if ($acd == "C") {
 if ($inbankupload_id != "") {
  Get_Data("bankupload",$inbankupload_id);
  Fin_SETUPBANKUPLOADFORMATOLD_Output();
 }
}
if ($acd == "D") {
 if ($inbankupload_id != "") {
  Delete_Data("bankupload",$inbankupload_id);
  XH4($inbankupload_id." successfully deleted.");
  Fin_SETUPBANKUPLOADFORMATLISTOLD_Output();
 }
}

Back_Navigator();
PageFooter("Default","Final");

?>

