<<<<<<< HEAD
<?php # finsetupbanklistin.php

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
$inbank_id = $_REQUEST["BankId"];

if ($acd == "A") {
 if ($inbank_id != "") {
  Initialise_Data("bank");
  $GLOBALS{'bank_id'} = $inbank_id;
  Write_Data("bank",$inbank_id);
  Fin_SETUPBANK_Output();
 }
}
if ($acd == "C") {
 if ($inbank_id != "") {
  Get_Data("bank",$inbank_id);
  Fin_SETUPBANK_Output();
 }
}
if ($acd == "D") {
 if ($inbank_id != "") {
  Delete_Data("bank",$inbank_id);
  XH4($inbank_id." successfully deleted.");
  Fin_SETUPBANKLIST_Output();
 }
}

Back_Navigator();
PageFooter("Default","Final");

?>

=======
<?php # finsetupbanklistin.php

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
$inbank_id = $_REQUEST["BankId"];

if ($acd == "A") {
 if ($inbank_id != "") {
  Initialise_Data("bank");
  $GLOBALS{'bank_id'} = $inbank_id;
  Write_Data("bank",$inbank_id);
  Fin_SETUPBANK_Output();
 }
}
if ($acd == "C") {
 if ($inbank_id != "") {
  Get_Data("bank",$inbank_id);
  Fin_SETUPBANK_Output();
 }
}
if ($acd == "D") {
 if ($inbank_id != "") {
  Delete_Data("bank",$inbank_id);
  XH4($inbank_id." successfully deleted.");
  Fin_SETUPBANKLIST_Output();
 }
}

Back_Navigator();
PageFooter("Default","Final");

?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
