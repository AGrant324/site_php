<?php # personchatmessagein.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_TEAMCHAT_CSSJS();
PageHeader("Default","Final");
Back_Navigator();
Check_Session_Validity();

$inchatviewerpersonid = $_REQUEST["chatviewerpersonid"];
$inchatmessage_threadset = $_REQUEST["chatmessage_threadset"];
$inchatmessage_threadid = $_REQUEST["chatmessage_threadid"];
$inchatmessage_threadtitle = $_REQUEST["chatmessage_threadtitle"];
$inchatmessage_message = $_REQUEST["chatmessage_message"];
$inchatmessage_personid = $inchatviewerpersonid;
if (isset($_REQUEST['chatmessage_personid'])) {	   // Helps testing
	$inchatmessage_personid = $_REQUEST["chatmessage_personid"];
	XTXTCOLOR("TEST MODE: Messages send on behalf of ".$inchatmessage_personid,"red");XBR();	
}
$inchatmessage_test = "No";
if (isset($_REQUEST['chatmessage_test'])) {   // Helps testing	
	$inchatmessage_test = $_REQUEST["chatmessage_test"]; 
	XTXTCOLOR("TEST MODE: Dont send emails = ".$inchatmessage_test,"red");XBR();
}

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$askingperson_id = $GLOBALS{'LOGIN_person_id'};
$askingperson_email = Chosen_Person_Email();
if ( $askingperson_email == "") { $askingperson_email = $GLOBALS{'person_email3'}; }
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};

if ( $inchatmessage_threadid == 'new' ) {
	$highestchatmessage_threadid = "TH00001";
	$chatmessagea = Get_Array('chatmessage',$inchatmessage_threadset);
	foreach ($chatmessagea as $chatmessage_timestamp) {
		Get_Data('chatmessage',$inchatmessage_threadset,$chatmessage_timestamp);
		if ( $GLOBALS{'chatmessage_threadid'} > $highestchatmessage_threadid) {
			$highestchatmessage_threadid = $GLOBALS{'chatmessage_threadid'};
		}
	}
	$threadidindex = str_replace("TH", "", $highestchatmessage_threadid);
	$threadidindex++;
	$newchatmessage_threadid = "TH".substr("000000000".$threadidindex, -5);
}

Initialise_Data("chatmessage");

$GLOBALS{'chatmessage_personid'} = $inchatmessage_personid; 
Get_Data("person",$GLOBALS{'chatmessage_personid'});
if ( $inchatmessage_threadid == 'new' ) { $GLOBALS{'chatmessage_threadid'} = $newchatmessage_threadid; }
else { $GLOBALS{'chatmessage_threadid'} = $inchatmessage_threadid; }
$GLOBALS{'chatmessage_threadtitle'} = $inchatmessage_threadtitle;
$GLOBALS{'chatmessage_message'} = $inchatmessage_message;
$GLOBALS{'chatmessage_sentbyemail'} = "Yes";
$GLOBALS{'chatmessage_sentbysms'} = "No";
Write_Data("chatmessage",$inchatmessage_threadset,$GLOBALS{'currentYYYYMMDDHHMMSS'});

$threadtype = substr($inchatmessage_threadset,0,2);
if ( $threadtype == "TM" ) {
	$team_code = substr($inchatmessage_threadset,-2);
	Check_Data('team',$GLOBALS{'currperiodid'},$team_code );
	$squada = explode(',',$GLOBALS{'team_squadlist'});
	// if ($inchatmessage_personid == "bbra") { $squada = Array('bbra');}
	foreach ($squada as $squadpersonid)  {
		Check_Data("person",$squadpersonid);
		$emailfrom = $askingperson_email;
		$esep = "";
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = "TeamChat - ".$GLOBALS{'team_name'}." - ".$inchatmessage_threadtitle;
		$mainmessage = $inchatmessage_message."<br><br>";
		$mainmessage = $mainmessage.$askingperson_fname." ".$askingperson_sname."<br><br>";
		$link = YPGMLINK("personchatmessageremoteout.php").YPGMMINPARMS().YPGMPARM("chatviewerpersonid",$squadpersonid);
		$link = $link.YPGMPARM("chatmessage_threadset",$inchatmessage_threadset).YPGMPARM("chatmessage_threadid",$GLOBALS{'chatmessage_threadid'});
		$Ylinkinsert = YLINKIMGNEWWINDOW(MakeUrlHTTP($link),MakeUrlHTTP($GLOBALS{'site_asseturl'})."/JoinTheConversation.png","Conversation","200","50","");		
		$mainmessage = $mainmessage.$Ylinkinsert."<br><br>";		
		$emailcontent = $mainmessage;
		$emailfooter1 = $GLOBALS{'domain_longname'};
		$emailfooter2 = "";
		if ($GLOBALS{'IOWARNING'} == "0") {
			if (ValidEmail(Chosen_Person_Email())) {
			    $emailto = Chosen_Person_Email();
				$esep = ",";
				if ($inchatmessage_test == "Yes") {
					Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
				} else {
					HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
				}
			} else {
				XBR();XTXTCOLOR("No valid email found for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red");
			}
		}
	}
	
}

Person_TEAMCHAT_Output("loggedin",$inchatviewerpersonid,$inchatmessage_threadset, $GLOBALS{'chatmessage_threadid'});

Back_Navigator();
PageFooter("Default","Final");

?>
