<?php 
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
$GLOBALS{'IOERRORcode'} = "SMSSI001";
$GLOBALS{'IOERRORmessage'} = "remconnect.txt not found";
$remconnecta = Get_File_Array("../cgi-bin/remconnect.txt");
$rema = explode("|",$remconnecta[0]);
$GLOBALS{'LOGIN_service_id'} = $rema[0];
$GLOBALS{'LOGIN_domain_id'} = $rema[1];
$GLOBALS{'LOGIN_mode_id'} = $rema[2];
GlobalRoutine();
$firetextYYYYMMDDHHMMSS = $GLOBALS{'yyyy'}."-".$GLOBALS{'mm'}."-".$GLOBALS{'dd'}." ".$GLOBALS{'acthh'}.":".$GLOBALS{'actmi'}.":".$GLOBALS{'actss'};
PopUpHeader();
XH2("SMS Out List");
print '<table border="1">';
XTR(); 
XTDTXT("To");
XTDTXT("Time");
# XTDTXT("Message");
XTDTXT("Reference");
XTDTXT("Receipt");
XTDTXT("Y");
XTDTXT("N");
XTDTXT("D");
XTDTXT("Yes");
X_TR();

$smsa = Get_2Key_Array("smsout_");
foreach ($smsa as $smskey) {
	XTR();
	$smskeya = explode('|',$smskey);
	Get_Data('smsout_'.$smskeya[0],$smskeya[1]);
	$GLOBALS{'smsout_to'} = "0".substr($GLOBALS{'smsout_to'}, 2, 10);
	$GLOBALS{'smsout_from'} = "0".substr($GLOBALS{'smsout_from'}, 2, 10);	
	XTDTXT($GLOBALS{'smsout_to'});
	XTDTXT($GLOBALS{'smsout_outtimestamp'});
	# XTDTXT($GLOBALS{'smsout_message'});
	XTDTXT($GLOBALS{'smsout_reference'});
	$link = "http://localhost/site_php/v1_smsreceivereceipt.php?";
	$link = $link.YPGMFIRSTPARM("mobile",$GLOBALS{'smsout_to'});
	$link = $link.YPGMPARM("status","0");	
	$link = $link.YPGMPARM("reference",$GLOBALS{'smsout_reference'});
	XTDLINKTXT($link,"Receipt");
	$link = "http://localhost/site_php/v1_smsreceiveresponse.php?";
	$link = $link.YPGMFIRSTPARM("source",$GLOBALS{'smsout_to'});
	$link = $link.YPGMPARM("destination",$GLOBALS{'smsout_from'});
	$link = $link.YPGMPARM("message","Y");
	$link = $link.YPGMPARM("keyword","");	
	$link = $link.YPGMPARM("time",$firetextYYYYMMDDHHMMSS);	
	XTDLINKTXT($link,"Y");	
	$link = "http://localhost/site_php/v1_smsreceiveresponse.php?";
	$link = $link.YPGMFIRSTPARM("source",$GLOBALS{'smsout_to'});
	$link = $link.YPGMPARM("destination",$GLOBALS{'smsout_from'});
	$link = $link.YPGMPARM("message","N");
	$link = $link.YPGMPARM("keyword","");
	$link = $link.YPGMPARM("time",$firetextYYYYMMDDHHMMSS);
	XTDLINKTXT($link,"N");	
	$link = "http://localhost/site_php/v1_smsreceiveresponse.php?";
	$link = $link.YPGMFIRSTPARM("source",$GLOBALS{'smsout_to'});
	$link = $link.YPGMPARM("destination",$GLOBALS{'smsout_from'});
	$link = $link.YPGMPARM("message","D");
	$link = $link.YPGMPARM("keyword","");
	$link = $link.YPGMPARM("time",$firetextYYYYMMDDHHMMSS);
	XTDLINKTXT($link,"D");	
	$link = "http://localhost/site_php/v1_smsreceiveresponse.php?";
	$link = $link.YPGMFIRSTPARM("source",$GLOBALS{'smsout_to'});
	$link = $link.YPGMPARM("destination",$GLOBALS{'smsout_from'});
	$link = $link.YPGMPARM("message","Yes");
	$link = $link.YPGMPARM("keyword","");
	$link = $link.YPGMPARM("time",$firetextYYYYMMDDHHMMSS);
	XTDLINKTXT($link,"Yes");	
	X_TR();
}
X_TABLE();
PopUpFooter();
?>

