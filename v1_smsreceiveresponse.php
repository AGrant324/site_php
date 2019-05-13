<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

# print "Content-type: text/html\n\n";
# print "<P>----- TRACE HEADER ------<BR>";

$GLOBALS{'IOERRORcode'} = "SMSRS001";
$GLOBALS{'IOERRORmessage'} = "remconnect.txt not found";
$remconnecta = Get_File_Array("../cgi-bin/remconnect.txt");
$rema = explode("|",$remconnecta[0]);
$GLOBALS{'LOGIN_service_id'} = $rema[0];
$GLOBALS{'LOGIN_domain_id'} = $rema[1];
$GLOBALS{'LOGIN_mode_id'} = $rema[2];

GlobalRoutine();

$smssource = IntlPhoneNumber($_REQUEST['source']); # respondee number
$smsdestination = IntlPhoneNumber($_REQUEST['destination']); # Firetext number
$smsmessage = $_REQUEST['message'];
$smskeyword = "";
if (isset($_REQUEST['keyword'])) { $smskeyword = $_REQUEST['keyword']; }
$smstime = $_REQUEST['time'];
$csmstime = substr($smstime, 0, 4).substr($smstime, 5, 2).substr($smstime, 8, 2).substr($smstime, 11, 2).substr($smstime, 14, 2).substr($smstime, 17, 2);

# Check all sms messages that were sent to this person before the response timestamp but which have not yet been processed  

$outtimestampa = Get_Array("smsout_".$smssource);
$matchedtimestamp = "";
foreach ($outtimestampa as $outtimestamp)  {
	if ($csmstime > $outtimestamp) { 
		Get_Data("smsout_".$smssource,$outtimestamp);
		$matchedresponse = MatchSMSresponse( $GLOBALS{'smsout_domainid'},$GLOBALS{'smsout_reference'},$smsmessage);
		if ( $matchedresponse != "" ) { $matchedtimestamp = $outtimestamp; }
	}
}

if ($matchedtimestamp != "") {
	Get_Data("smsout_".$smssource,$matchedtimestamp);
	$GLOBALS{'smsin_domainid'} = $GLOBALS{'smsout_domainid'};
	// $GLOBALS{'smsin_topersonid'} = $GLOBALS{'smsout_topersonid'};
	$GLOBALS{'smsin_from'} = $smsdestination;
	// $GLOBALS{'smsin_frompersonid'} = $GLOBALS{'smsout_frompersonid'};
	$GLOBALS{'smsin_message'} = $smsmessage;
	$GLOBALS{'smsin_keyword'} = $smskeyword;
	$GLOBALS{'smsin_reference'} = $GLOBALS{'smsout_reference'};
	$GLOBALS{'smsin_expirytimestamp'} = $GLOBALS{'smsout_expirytimestamp'};;	
	Write_Data("smsin_".$smssource,$csmstime);
	$smstimestampout = "";
	$smstxntype = "";
	$smsgroupref = "";
	$smspersonid = "";
	$rbitsa = explode('-',$GLOBALS{'smsin_reference'});
	if (isset($rbitsa[0])) { $smstimestampout = $rbitsa[0]; }
	if (isset($rbitsa[1])) { $smstxntype = $rbitsa[1]; }
	if (isset($rbitsa[2])) { $smsgroupref = $rbitsa[2]; }
	if (isset($rbitsa[3])) { $smspersonid = $rbitsa[3]; }
	if ( $smstxntype == "SquadInvite") { 
		$response = ParseSMSResponse( $smsmessage, "A,D" ); 
	} 
	if ( $smstxntype == "TeamSelection") {
		TeamSelection_SMS_Response($GLOBALS{'smsin_domainid'},$smsgroupref,$smspersonid,ParseSMSResponse( $GLOBALS{'smsin_message'}, "Y,N,D,M" ));
	}	
	if ( $smstxntype == "EventInvite") {
		$response = ParseSMSResponse( $smsmessage, "A,D" );
	}		
} else {
	$GLOBALS{'smsin_domainid'} = "";
	// $GLOBALS{'smsin_topersonid'} = "";
	$GLOBALS{'smsin_from'} = $smsdestination;
	// $GLOBALS{'smsin_frompersonid'} = "";
	$GLOBALS{'smsin_message'} = $smsmessage;
	$GLOBALS{'smsin_keyword'} = $smskeyword;
	$GLOBALS{'smsin_reference'} = "";
	$GLOBALS{'smsin_expirytimestamp'} = "";	
	Write_Data("smsin_".$smssource,$csmstime);
}


function MatchSMSresponse ($domainid, $reference, $returnmessage) {
	
	// CHECK
	// This looks wrong it doesnt match the reference as expected - the reference would have been updated in smsout by the receipt oon successful delivery
	// All it does is to test that there is a valid response for this type of transactrion	
	
	$response = "";
	# timestampout-txntype-groupref-personid
	$smstxntype = "";
	$rbitsa = explode('-',$reference);
	if (isset($rbitsa[0])) { $smstimestampout = $rbitsa[0]; }
	if (isset($rbitsa[1])) { $smstxntype = $rbitsa[1]; }
	if (isset($rbitsa[2])) { $smsgroupref = $rbitsa[2]; }
	if (isset($rbitsa[3])) { $smspersonid = $rbitsa[3]; }
	if ( $smstxntype == "SquadInvite") { 
		$response = ParseSMSResponse( $returnmessage, "A,D" ); 
	} 
	if ( $smstxntype == "TeamSelection") {
		$response = ParseSMSResponse( $returnmessage, "Y,N,D,M" );
	}	
	if ( $smstxntype == "EventInvite") {
		$response = ParseSMSResponse( $returnmessage, "A,D" );
	}	
	return $response;
}

function TeamSelection_SMS_Response($domainid,$smsgroupref,$smspersonid,$smsconfirmationstatus) {
	# L11809271
	# XH4($domainid." ".$smsgroupref." ".$smspersonid." ".$smsconfirmationstatus);
	$ibits = str_split($smsgroupref);
	$teamcode = $ibits[0].$ibits[1];
	Check_Data("frs_".$domainid,$GLOBALS{'currperiodid'},$teamcode,$smsgroupref);
	if ($GLOBALS{'IOWARNING'} == "0") {
		$confirmationstatus = "";
		if ($smsconfirmationstatus == "Y" ) { $confirmationstatus = "Y"; }
		if ($smsconfirmationstatus == "M" ) { $confirmationstatus = "Y"; }	
		if ($smsconfirmationstatus == "D" ) { $confirmationstatus = "Y"; }			
		if ($smsconfirmationstatus == "N" ) { $confirmationstatus = "N"; }
		if ($smsconfirmationstatus == "?" ) { $confirmationstatus = "?"; }
				
		UpdateSelectionList('frs_playerselectedlist',$smspersonid,'confirmed',$confirmationstatus);
		$travelstatus = "";				
		if ($smsconfirmationstatus == "Y" ) { $travelstatus = "M"; }
		if ($smsconfirmationstatus == "M" ) { $travelstatus = "M"; }		
		if ($smsconfirmationstatus == "D" ) { $travelstatus = "D"; }		
		if ($smsconfirmationstatus == "N" ) { $travelstatus = ""; }
		if ($smsconfirmationstatus == "?" ) { $travelstatus = ""; }		
		
		UpdateSelectionList('frs_playerselectedlist',$smspersonid,'travel',$travelstatus);
		# XH4($GLOBALS{'frs_playerselectedlist'});
		Write_Data("frs_".$domainid,$GLOBALS{'currperiodid'},$teamcode,$smsgroupref);
	}	
}

function ParseSMSResponse( $message, $codelist ) {
	# XH4($message." ".$codelist);
	$message = ltrim($message);
	$codefound = "";
	if ( $message != "" ) { $codefound = "?"; }
	$codea = explode(',',$codelist);
	foreach ($codea as $code) {
		$codeupper = strtoupper($code);
		$codelower = strtolower($code);
		if (substr($message, 0, 1) == $codeupper ) { $codefound = $code; } 
		if (substr($message, 0, 1) == $codelower ) { $codefound = $code; } 			
	}
	# XH4($codefound);
	return($codefound);	
}



?>

