<?php # personDM2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();

$actionperson_id1 = $_REQUEST['ActionPersonId1'];
$actionperson_id2 = $_REQUEST['ActionPersonId2'];

if (isset($_REQUEST['Master'])) { $masterperson_id = $_REQUEST['Master']; } else { $masterperson_id = ""; }
if (isset($_REQUEST['Delete'])) { $deleteperson_id = $_REQUEST['Delete']; } else { $deleteperson_id = ""; }
$slaveperson_id = "";

if (isset($_REQUEST['SendEmail'])) { $sendemail = "1"; } else { $sendemail = "0"; }
if ($masterperson_id == $actionperson_id1) { $slaveperson_id = $actionperson_id2; }
if ($masterperson_id == $actionperson_id2) { $slaveperson_id = $actionperson_id1; }

XH2("De-Duplicate person records");
$goahead = "1";

if (($masterperson_id == $deleteperson_id)&&($masterperson_id != "")) {
	XH4("You cannot delete the new master record - please retry.");	
	$goahead = "0";	
}
if ($masterperson_id == "") {
	XH4("No Master record Selected - please retry.");
	$goahead = "0";
}

if ( $goahead == "1") {
	
	XH3("Record ".$masterperson_id." used as master.");
	
	Get_Data('person', $slaveperson_id);
	$tstring = $GLOBALS{"person^FIELDS"}; $tfields = explode('|', $tstring);
	foreach ($tfields as $tfieldelement) {
		$GLOBALS["slave_".$tfieldelement] = $GLOBALS[$tfieldelement];
	}
	Get_Data('person', $masterperson_id);
	$tstring = $GLOBALS{"person^FIELDS"}; $tfields = explode('|', $tstring);
	foreach ($tfields as $tfieldelement) {
		if (($GLOBALS[$tfieldelement] == "")&&($GLOBALS["slave_".$tfieldelement] != "")) {
			$GLOBALS[$tfieldelement] = $GLOBALS["slave_".$tfieldelement];
			XPTXT($tfieldelement." - ".$GLOBALS["slave_".$tfieldelement]." Copied from ".$slaveperson_id);
		} 
	}
	Write_Data('person', $masterperson_id);
	
	
	# ===== Qualifications and Job Roles ======================
	$qualificationa = Get_Array('personqualification',$slaveperson_id);
	foreach ($qualificationa as $qualification_id) {
		Get_Data('personqualification',$slaveperson_id, $qualification_id);
		Check_Data('personqualification',$masterperson_id, $qualification_id);
		if ($GLOBALS{'IOWARNING'} == "1") {
			Write_Data('personqualification',$masterperson_id, $qualification_id);
			XH5("Qualification ".$qualification_id." - copied from ".$slaveperson_id);
		}
	}
	$jobrolea = Get_Array('personjobrole',$slaveperson_id);
	foreach ($jobrolea as $jobrole_id) {
		Get_Data('personjobrole',$slaveperson_id, $jobrole_id);
		Check_Data('personjobrole',$masterperson_id, $jobrole_id);		
		if ($GLOBALS{'IOWARNING'} == "1") {
			Write_Data('personjobrole',$masterperson_id, $jobrole_id);
			XH5("Jobrole ".$jobrole_id." - copied from ".$slaveperson_id);
		}
	}

	#====== sections, teams and frs stats ========================
	foreach (Get_Array("section",$GLOBALS{'currperiodid'}) as $section_name) {	
		Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
		$GLOBALS{'checkreplacepersoninlist'} = "0";
		checkreplacepersoninlist("Section Leader ",$teamcode,$slaveperson_id,$masterperson_id,'section_leader');
		checkreplacepersoninlist("Section Person Managers ",$teamcode,$slaveperson_id,$masterperson_id,'section_personmgrs');
		if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"ocz"))>0) {			
			checkreplacepersoninlist("Section Results Managers ",$teamcode,$slaveperson_id,$masterperson_id,'section_resmgrs');		
		}
		if ($GLOBALS{'checkreplacepersoninlist'} = "1") { Write_Data("section",$GLOBALS{'currperiodid'},$section_name); }
		if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"ocz"))>0) {
			$teama = &List2Array($GLOBALS{'section_teams'});
			foreach ($teama as $teamcode) {
				Check_Data("team",$GLOBALS{'currperiodid'},$teamcode);
				if ($GLOBALS{'IOWARNING'} == "0") {
					$GLOBALS{'checkreplacepersoninlist'} = "0";
					checkreplacepersoninlist("Team Captain ",$teamcode,$slaveperson_id,$masterperson_id,'team_captain');				
					checkreplacepersoninlist("Team Results Managers ",$teamcode,$slaveperson_id,$masterperson_id,'team_resmgrs');                  ;				
					checkreplacepersoninlist("Team Manager",$teamcode,$slaveperson_id,$masterperson_id,'team_mgr');
					checkreplacepersoninlist("Team Coach ",$teamcode,$slaveperson_id,$masterperson_id,'team_coach');
					checkreplacepersoninlist("Team Squadd ",$teamcode,$slaveperson_id,$masterperson_id,'team_squadlist');
					checkreplacepersoninlist("Team Helpers ",$teamcode,$slaveperson_id,$masterperson_id,'team_helpers');
					if ($GLOBALS{'checkreplacepersoninlist'} = "1") { Write_Data("team",$GLOBALS{'currperiodid'},$teamcode); }
					$frsa = Get_Array('frs',$GLOBALS{'currperiodid'},$teamcode);
					foreach ($frsa as $frsid) {
						Get_Data('frs',$GLOBALS{'currperiodid'},$teamcode,$frsid);
						#  XPTXT("FRSID ".$frsid." ".$GLOBALS{'frs_statslist'});
						if ($GLOBALS{'frs_statslist'} != "") {		
							$statsa = explode('|',$GLOBALS{'frs_statslist'});
							foreach ($statsa as $stat) {
								# bbra,G,2
								$statbits = explode(',',$stat);
								if ($statbits[0] == $slaveperson_id) { 
									$GLOBALS{'frs_statslist'} = replacepersoninlist($slaveperson_id,$masterperson_id,$GLOBALS{'frs_statslist'}); 
									Write_Data('frs',$GLOBALS{'currperiodid'},$teamcode,$frsid);
									XPTXT("FRS Stat Replaced ".$frsid);
								}
			
							}
						}	
					}
				}
			}
		}
	}
	
	if ($deleteperson_id != "") {
		XH5("Old records deleted ==============>".$deleteperson_id);
		Delete_Data("person", $deleteperson_id);
		XH5("Record ".$deleteperson_id." deleted.");		
		$qualificationa = Get_Array('personqualification',$deleteperson_id);
		foreach ($qualificationa as $qualification_id) {
			Delete_Data('personqualification',$deleteperson_id, $qualification_id);
			XH5("Qualification ".$deleteperson_id." ".$qualification_id." - deleted");
		}
		$jobrolea = Get_Array('personjobrole',$deleteperson_id);
		foreach ($jobrolea as $jobrole_id) {
			Delete_Data('personjobrole',$deleteperson_id, $jobrole_id);
			XH5("Jobrole ".$deleteperson_id." ".$jobrole_id." - deleted");
		}					
	}
	
	if ($sendemail == "1") {
		XH4("The following Email has been sent to ".$masterperson_id);

		$person_passwordclear = XCrypt($GLOBALS{"person_password"},$foundperson_id,"decrypt");
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		$emailsubject = 'Access confirmation '.$GLOBALS{'domain_longname'};
		
		
		if ($GLOBALS{'person_email3'} == "") {
			$emailto = $GLOBALS{'person_email1'};
			$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
			$mainmessage = $mainmessage.'We have been performing some administration on our membership records. This is just to inform you of your login credentials.<br><br>';
		} else {
			$emailto = $GLOBALS{'person_email3'};
			$mainmessage = 'Dear '.$GLOBALS{'person_parentfname'}.'<br><br>';
			$mainmessage = $mainmessage.'We have been performing some administration on our membership records. This is just to inform you of your login credentials.<br><br>';
		}
		$mainmessage = $mainmessage.'Your '.$GLOBALS{'domain_longname'}.' Personal Id is "'.$masterperson_id.'" and the password is "'.$person_passwordclear.'" (Case Sensitive!). ';
		$mainmessage = $mainmessage.'Please do not share or disclose your password to other people. <br><br>';
		$mainmessage = $mainmessage.'To login to the website use the Login Button on the navigation menu and then follow the instructions. <br><br>';
		$mainmessage = $mainmessage.'Could we ask you to now login and check that your people/contact details are up to date. ';
		$mainmessage = $mainmessage.'This information will be the master for all club communications. <br><br>';
		$emailcontent = $mainmessage.'<br><br>Many Thanks. <br><br> '.$askingperson_fname.' <br>';
		
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);		
		
	}
}

XBR();
XINBUTTONCLOSEWINDOW("Cancel");
PopUpFooter();




?>
