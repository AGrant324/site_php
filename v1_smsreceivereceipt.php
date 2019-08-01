<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

$GLOBALS{'IOERRORcode'} = "SMSRC001";
$GLOBALS{'IOERRORmessage'} = "remconnect.txt not found";
$remconnecta = Get_File_Array("../cgi-bin/remconnect.txt");
$rema = explode("|",$remconnecta[0]);
$GLOBALS{'LOGIN_service_id'} = $rema[0];
$GLOBALS{'LOGIN_domain_id'} = $rema[1];
$GLOBALS{'LOGIN_mode_id'} = $rema[2];

GlobalRoutine();

$smsmobile = IntlPhoneNumber($_REQUEST['mobile']);
$smsstatus = $_REQUEST['status'];
$smsreference = $_REQUEST['reference'];

$xsmstimestampout = "";
$xsmstxntype = "";
$xsmsgroupref = "";
$xsmspersonid = "";
$rbitsa = explode('-',$smsreference);
if (isset($rbitsa[0])) { $xsmstimestampout = $rbitsa[0]; }
if (isset($rbitsa[1])) { $xsmstxntype = $rbitsa[1]; }
if (isset($rbitsa[2])) { $xsmsgroupref = $rbitsa[2]; }
if (isset($rbitsa[3])) { $xsmspersonid = $rbitsa[3]; }

Check_Data("smsout_".$smsmobile,$xsmstimestampout);
if ($GLOBALS{'IOWARNING'} == "0") { 
	$GLOBALS{'smsreceipt_domainid'} = $GLOBALS{'smsout_domainid'};
	$GLOBALS{'smsreceipt_status'} = $smsstatus;
	$GLOBALS{'smsreceipt_reference'} = $smsreference;
	$GLOBALS{'smsreceipt_expirytimestamp'} = $GLOBALS{'smsout_expirytimestamp'};;	
	Write_Data("smsreceipt_".$smsmobile,$xsmstimestampout);
} 
?>

