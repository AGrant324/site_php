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
$inbankfile_id = $_REQUEST["BankFileId"];

if ($acd == "A") {
 $bankfilea = Get_Array('bankfile');
 $lastbankfile_id = end($bankfilea); 
 Check_Data('bankfile',$lastbankfile_id);
 if ($GLOBALS{'IOWARNING'} == "1") {$nextbankfile_id = 1;}
 else {
  $nextbankfile_id = str_replace("F", "", $GLOBALS{'bankfile_id'});
  $nextbankfile_id++;
 }	
 Initialise_Data("bankfile");
 $GLOBALS{'bankfile_id'} = "F".substr("000000000".$nextbankfile_id, -9, 9);	
 Write_Data("bankfile",$GLOBALS{'bankfile_id'});
 Fin_MAINTAINBANKFILE_Output("A");
}
if ($acd == "C") {
 if ($inbankfile_id != "") {
  Get_Data("bankfile",$inbankfile_id);
  Fin_MAINTAINBANKFILE_Output("C");
 }
}
if ($acd == "D") {
 if ($inbankfile_id != "") {
  Get_Data("bankfile",$inbankfile_id);
  Fin_MAINTAINBANKFILE_Output("D");
 }
}
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS();
$link = $link.YPGMPARM("SelectId","UPLOADBANK");  
XBR();XLINKTXT($link,"review bank file upload list and add new entry");
Back_Navigator();
PageFooter("Default","Final");

?>

