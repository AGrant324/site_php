<<<<<<< HEAD
<?php # frsteamselectionin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

$GLOBALS{'IOERRORcode'} = "FRSR001";
$GLOBALS{'IOERRORmessage'} = "remconnect.txt not found";
$remconnecta = Get_File_Array("../cgi-bin/remconnect.txt");
$rema = explode("|",$remconnecta[0]);
$GLOBALS{'LOGIN_service_id'} = $rema[0];
$GLOBALS{'LOGIN_domain_id'} = $rema[1]; // CHECK
$GLOBALS{'LOGIN_mode_id'} = $rema[2];
GlobalRoutine();

// XPTXT($GLOBALS{'LOGIN_service_id'}."|".$GLOBALS{'LOGIN_domain_id'}."|".$GLOBALS{'LOGIN_mode_id'});

$intest = "No"; // Cron by default
$inpreview = "No"; // Preview generated emails but dont send
$thisyy = $GLOBALS{'yy'};
$thismm = $GLOBALS{'mm'};
$thisdd = $GLOBALS{'dd'};
$thisyyymmdd = $GLOBALS{'currentYYYY-MM-DD'};
if (isset($_REQUEST['Test'])) { $intest = $_REQUEST['Test']; } // Manual test of Cron Job
if ($intest == "Yes") {	
	$inpreview = $_REQUEST['Preview']; // Manual test of Cron Job
	PageHeader("Default","Final");
	Back_Navigator();
	$thisyy = substr($_REQUEST['Date_YYYYpart'],2,2);
	$thismm = $_REQUEST['Date_MMpart'];
	$thisdd = $_REQUEST['Date_DDpart'];
	$thisyyymmdd = "20".$thisyy."-".$thismm."-".$thisdd;
	XH2("Selection reminder simulation for ".YYYY_MM_DDtoDDbMMMbYY($thisyyymmdd));
	if ($inpreview == "Yes") {	XH3("Note: This is a preview only - no emails have actually been sent."); }
	else { XH3("The following emails have been sent."); }	
}	

foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $section_name)  {
	Get_Data_Hash('section',$GLOBALS{'currperiodid'},$section_name);
	$sectionlist = $GLOBALS{'section_teams'};
	foreach (Get_Array_Hash_SortSelect('team',$GLOBALS{'currperiodid'},"team_seq","","") as $team_code)  {
		if (strlen(strstr($sectionlist,$team_code))>0) {
			Get_Data("team",$GLOBALS{'currperiodid'},$team_code);
			if ($GLOBALS{'IOWARNING'} != "1") {
				if ($GLOBALS{'team_selectionreminder'} != "No" ) {
					$frsa = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
					$todayfrs_id = $team_code.$thisyy.$thismm.$thisdd."1";
					foreach ($frsa as $frs_id) {
						if ($frs_id > $todayfrs_id) {
							Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
							// XPTXT($thisyyymmdd." vs ".$GLOBALS{'frs_date'}." ".DaysDifference($GLOBALS{'frs_date'},$thisyyymmdd));
							if (DaysDifference($GLOBALS{'frs_date'},$thisyyymmdd) == 1) {
								$playera = GetSelectionListPersonIds ('frs_playerselectedlist',"selected","Y");
								$officiala = GetSelectionListPersonIds ('frs_officialselectedlist',"selected","Y");
								$selectednamelist = "";
								$officialnamelist = "";
								foreach ($playera as $personid)  {
									$confirmstatus = GetSelectionList('frs_playerselectedlist',$personid,'confirmed');
									if ($confirmstatus != "N") {
										$traveltxt = "";
										if ($frs_meettotravel == "Yes" ) {
											$traveltxt = " - ".SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'travel'));
										}
										Check_Data("person",$personid);
										if ($GLOBALS{'IOWARNING'} == "0") {
											$selectednamelist = $selectednamelist.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.$traveltxt.'<br/>';
										}
									}
								}
								foreach ($officiala as $personid)  {
									$confirmstatus = GetSelectionList('frs_officialselectedlist',$personid,'confirmed');
									if ($confirmstatus != "N") {
										$traveltxt = "";
										if ($frs_meettotravel == "Yes" ) {
											$traveltxt = " - ".SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'travel'));
										}
										Check_Data("person",$personid);
										if ($GLOBALS{'IOWARNING'} == "0") {
											$officialnamelist = $officialnamelist.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.'<br/>';
										}
									}
								}
								foreach ($playera as $personid)  {
									$confirmstatus = GetSelectionList('frs_playerselectedlist',$personid,'confirmed');
									if ($confirmstatus != "N") {
										Check_Data("person",$personid);
										if ($GLOBALS{'IOWARNING'} == "0") {
											SendReminderEmail ($intest, $inpreview, $selectednamelist,$officialnamelist);
										}
									}
								}
								foreach ($officiala as $personid)  {
									$confirmstatus = GetSelectionList('frs_officialselectedlist',$personid,'confirmed');
									if ($confirmstatus != "N") {
										Check_Data("person",$personid);
										if ($GLOBALS{'IOWARNING'} == "0") {
											SendReminderEmail ($intest, $inpreview, $selectednamelist,$officialnamelist);
										}
									}	
								}
							}	
						}		
					}
				} else {
					if ($intest == "Yes") {
						XH3( $GLOBALS{'team_name'}." does not require reminders to be sent." );
					}
				}
			}
		}
	}				
}	
if ($intest == "Yes") {
	Back_Navigator();
	PageFooter("Default","Final");								
}							
								
function SendReminderEmail ($intest, $inpreview, $selectednamelist, $officialnamelist) {		
	$tvenue_name = "";
	if ($GLOBALS{'frs_ha'} == "H") {
		Check_Data('venue',$GLOBALS{'frs_venue'});
		if ($GLOBALS{'IOWARNING'} == "0") { $tvenue_name = $GLOBALS{'venue_name'}; }
		else { $tvenue_name = $GLOBALS{'frs_venue'}; }
	} else { 
		$tvenue_name = $GLOBALS{'frs_awayvenue'};
	}	
	
	$toperson_email = "";
	$ccperson_email = "";
	$underage = UnderAge(18,$GLOBALS{'person_dob'});
	if ($underage) {
		if ($GLOBALS{'person_email1'} != "") {
			$toperson_email = $GLOBALS{'person_email1'};
			if ($GLOBALS{'person_email3'} != $GLOBALS{'person_email1'}) {
				$ccperson_email = $GLOBALS{'person_email3'};
			}
		} else {
			$toperson_email = $GLOBALS{'person_email3'};
		}
	} else {
		$toperson_email = $GLOBALS{'person_email1'};
	}
	$emailto = $toperson_email;
	$emailcc = $ccperson_email;
	$emailbcc = "";				
	$emailexpirydate = AddMonth("20".$infrsid[2].$infrsid[3]."-".$infrsid[4].$infrsid[5]."-".$infrsid[6].$infrsid[7],1);
	$emailfrompersonid = "automated";  // automated
	$emailtopersonid = $GLOBALS{'person_id'};
	$emailreference = $GLOBALS{'currentYYYYMMDDHHMMSS'}."-TeamSelection-".$infrsid."-".$personid;				
	$emailfrom =  $GLOBALS{'domain_defaultemailaddress'};	
	$emailfooter1 = $GLOBALS{'domain_longname'};  // automated
	$emailfooter2 = "";
	
	$emailsubject = $GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' - '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'});
	$mainmessage = 'Dear '.$GLOBALS{'person_fname'}."<br/><br/>";
	$mainmessage = $mainmessage.'<font color="green">Just a reminder about your next match.</font>'."<br/><br/>";		
	$mainmessage = $mainmessage."Opposition: ".$GLOBALS{'frs_oppo'}."<br/>";			
	$mainmessage = $mainmessage."Venue: ".$tvenue_name."<br/>";
	$mainmessage = $mainmessage."Start Time: ".$GLOBALS{'frs_time'}."<br/>";
	if ($GLOBALS{'frs_meet'} != "") { $mainmessage = $mainmessage."Arrangements: ".$GLOBALS{'frs_meet'}."<br/><br/>"; }
	if ($GLOBALS{'frs_meetextra'} != "") { $mainmessage = $mainmessage.$GLOBALS{'frs_meetextra'}."<br/><br/>"; }
	$mainmessage = $mainmessage."<hr>Our team for this match is:-<br/><br/>";
	$mainmessage = $mainmessage.$selectednamelist."<br/>";
	$mainmessage = $mainmessage."<hr>Umpire(s):-<br/><br/>";
	$mainmessage = $mainmessage.$officialnamelist."<br/>";	
 
	$eventa = Get_Array("event");
	foreach ($eventa as $event_id)  {
	    Get_Data("event",$event_id);
	    if (($GLOBALS{'event_publicationstatus'} == "Published")&&($GLOBALS{'event_date'} >= $GLOBALS{'currentYYYY-MM-DD'})&&($GLOBALS{'event_showinemail'} == "Yes") ) {
    		$link = YPGMLINK("webpageeventwebview.php");
    		$link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);		
    		$mainmessage = $mainmessage.'<table border="0"><tr><td border="0">';
    		$mainmessage = $mainmessage.'<table border="0"><tr>';
    		if ($GLOBALS{'event_featuredimage'} != "") {
    			$mainmessage = $mainmessage.'<td border="0"><br>'.'<a href="'.$link.'"><img src="http:'.$GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'}.'" width="200" /></a>';
    			$mainmessage = $mainmessage.'<td border="0"> </td>';			
    		}
    		$mainmessage = $mainmessage.'<td border="0">'.YH3($GLOBALS{'event_title'}).'<br>'.$GLOBALS{'event_excerpt'}."..".YLINKTXT($link,"Read More..");
    
    		$mainmessage = $mainmessage.'</td>';		
    		$mainmessage = $mainmessage.'</tr></table>';		
    		$mainmessage = $mainmessage.'</td></tr></table>';	
	    }		
	}
	
	$emailcontent = $mainmessage."<br><br>Automated Message - Please do not respond.<br><br>";

	// if ($emailto == "barry.bradley@connectivesolutions.co.uk") {
	// if ($GLOBALS{'person_id'} == "bbra") {  // Testing limitation
	if ($intest == "Yes") {	$displaymode = "display"; }
	else { $displaymode = "silent"; }		
	if ($inpreview == "Yes") {	Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); }			
	else { HTMLEmailRecorded_Output($displaymode,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2,$emailfrompersonid,$emailtopersonid,$emailreference,$emailexpirydate); }	
	// }
	// }
}				
							
								
								
=======
<?php # frsteamselectionin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

$GLOBALS{'IOERRORcode'} = "FRSR001";
$GLOBALS{'IOERRORmessage'} = "remconnect.txt not found";
$remconnecta = Get_File_Array("../cgi-bin/remconnect.txt");
$rema = explode("|",$remconnecta[0]);
$GLOBALS{'LOGIN_service_id'} = $rema[0];
$GLOBALS{'LOGIN_domain_id'} = $rema[1]; // CHECK
$GLOBALS{'LOGIN_mode_id'} = $rema[2];
GlobalRoutine();

// XPTXT($GLOBALS{'LOGIN_service_id'}."|".$GLOBALS{'LOGIN_domain_id'}."|".$GLOBALS{'LOGIN_mode_id'});

$intest = "No"; // Cron by default
$inpreview = "No"; // Preview generated emails but dont send
$thisyy = $GLOBALS{'yy'};
$thismm = $GLOBALS{'mm'};
$thisdd = $GLOBALS{'dd'};
$thisyyymmdd = $GLOBALS{'currentYYYY-MM-DD'};
if (isset($_REQUEST['Test'])) { $intest = $_REQUEST['Test']; } // Manual test of Cron Job
if ($intest == "Yes") {	
	$inpreview = $_REQUEST['Preview']; // Manual test of Cron Job
	PageHeader("Default","Final");
	Back_Navigator();
	$thisyy = substr($_REQUEST['Date_YYYYpart'],2,2);
	$thismm = $_REQUEST['Date_MMpart'];
	$thisdd = $_REQUEST['Date_DDpart'];
	$thisyyymmdd = "20".$thisyy."-".$thismm."-".$thisdd;
	XH2("Selection reminder simulation for ".YYYY_MM_DDtoDDbMMMbYY($thisyyymmdd));
	if ($inpreview == "Yes") {	XH3("Note: This is a preview only - no emails have actually been sent."); }
	else { XH3("The following emails have been sent."); }	
}	

foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $section_name)  {
	Get_Data_Hash('section',$GLOBALS{'currperiodid'},$section_name);
	$sectionlist = $GLOBALS{'section_teams'};
	foreach (Get_Array_Hash_SortSelect('team',$GLOBALS{'currperiodid'},"team_seq","","") as $team_code)  {
		if (strlen(strstr($sectionlist,$team_code))>0) {
			Get_Data("team",$GLOBALS{'currperiodid'},$team_code);
			if ($GLOBALS{'IOWARNING'} != "1") {
				if ($GLOBALS{'team_selectionreminder'} != "No" ) {
					$frsa = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
					$todayfrs_id = $team_code.$thisyy.$thismm.$thisdd."1";
					foreach ($frsa as $frs_id) {
						if ($frs_id > $todayfrs_id) {
							Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
							// XPTXT($thisyyymmdd." vs ".$GLOBALS{'frs_date'}." ".DaysDifference($GLOBALS{'frs_date'},$thisyyymmdd));
							if (DaysDifference($GLOBALS{'frs_date'},$thisyyymmdd) == 1) {
								$playera = GetSelectionListPersonIds ('frs_playerselectedlist',"selected","Y");
								$officiala = GetSelectionListPersonIds ('frs_officialselectedlist',"selected","Y");
								$selectednamelist = "";
								$officialnamelist = "";
								foreach ($playera as $personid)  {
									$confirmstatus = GetSelectionList('frs_playerselectedlist',$personid,'confirmed');
									if ($confirmstatus != "N") {
										$traveltxt = "";
										if ($frs_meettotravel == "Yes" ) {
											$traveltxt = " - ".SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'travel'));
										}
										Check_Data("person",$personid);
										if ($GLOBALS{'IOWARNING'} == "0") {
											$selectednamelist = $selectednamelist.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.$traveltxt.'<br/>';
										}
									}
								}
								foreach ($officiala as $personid)  {
									$confirmstatus = GetSelectionList('frs_officialselectedlist',$personid,'confirmed');
									if ($confirmstatus != "N") {
										$traveltxt = "";
										if ($frs_meettotravel == "Yes" ) {
											$traveltxt = " - ".SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'travel'));
										}
										Check_Data("person",$personid);
										if ($GLOBALS{'IOWARNING'} == "0") {
											$officialnamelist = $officialnamelist.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.'<br/>';
										}
									}
								}
								foreach ($playera as $personid)  {
									$confirmstatus = GetSelectionList('frs_playerselectedlist',$personid,'confirmed');
									if ($confirmstatus != "N") {
										Check_Data("person",$personid);
										if ($GLOBALS{'IOWARNING'} == "0") {
											SendReminderEmail ($intest, $inpreview, $selectednamelist,$officialnamelist);
										}
									}
								}
								foreach ($officiala as $personid)  {
									$confirmstatus = GetSelectionList('frs_officialselectedlist',$personid,'confirmed');
									if ($confirmstatus != "N") {
										Check_Data("person",$personid);
										if ($GLOBALS{'IOWARNING'} == "0") {
											SendReminderEmail ($intest, $inpreview, $selectednamelist,$officialnamelist);
										}
									}	
								}
							}	
						}		
					}
				} else {
					if ($intest == "Yes") {
						XH3( $GLOBALS{'team_name'}." does not require reminders to be sent." );
					}
				}
			}
		}
	}				
}	
if ($intest == "Yes") {
	Back_Navigator();
	PageFooter("Default","Final");								
}							
								
function SendReminderEmail ($intest, $inpreview, $selectednamelist, $officialnamelist) {		
	$tvenue_name = "";
	if ($GLOBALS{'frs_ha'} == "H") {
		Check_Data('venue',$GLOBALS{'frs_venue'});
		if ($GLOBALS{'IOWARNING'} == "0") { $tvenue_name = $GLOBALS{'venue_name'}; }
		else { $tvenue_name = $GLOBALS{'frs_venue'}; }
	} else { 
		$tvenue_name = $GLOBALS{'frs_awayvenue'};
	}	
	
	$toperson_email = "";
	$ccperson_email = "";
	$underage = UnderAge(18,$GLOBALS{'person_dob'});
	if ($underage) {
		if ($GLOBALS{'person_email1'} != "") {
			$toperson_email = $GLOBALS{'person_email1'};
			if ($GLOBALS{'person_email3'} != $GLOBALS{'person_email1'}) {
				$ccperson_email = $GLOBALS{'person_email3'};
			}
		} else {
			$toperson_email = $GLOBALS{'person_email3'};
		}
	} else {
		$toperson_email = $GLOBALS{'person_email1'};
	}
	$emailto = $toperson_email;
	$emailcc = $ccperson_email;
	$emailbcc = "";				
	$emailexpirydate = AddMonth("20".$infrsid[2].$infrsid[3]."-".$infrsid[4].$infrsid[5]."-".$infrsid[6].$infrsid[7],1);
	$emailfrompersonid = "automated";  // automated
	$emailtopersonid = $GLOBALS{'person_id'};
	$emailreference = $GLOBALS{'currentYYYYMMDDHHMMSS'}."-TeamSelection-".$infrsid."-".$personid;				
	$emailfrom =  $GLOBALS{'domain_defaultemailaddress'};	
	$emailfooter1 = $GLOBALS{'domain_longname'};  // automated
	$emailfooter2 = "";
	
	$emailsubject = $GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' - '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'});
	$mainmessage = 'Dear '.$GLOBALS{'person_fname'}."<br/><br/>";
	$mainmessage = $mainmessage.'<font color="green">Just a reminder about your next match.</font>'."<br/><br/>";		
	$mainmessage = $mainmessage."Opposition: ".$GLOBALS{'frs_oppo'}."<br/>";			
	$mainmessage = $mainmessage."Venue: ".$tvenue_name."<br/>";
	$mainmessage = $mainmessage."Start Time: ".$GLOBALS{'frs_time'}."<br/>";
	if ($GLOBALS{'frs_meet'} != "") { $mainmessage = $mainmessage."Arrangements: ".$GLOBALS{'frs_meet'}."<br/><br/>"; }
	if ($GLOBALS{'frs_meetextra'} != "") { $mainmessage = $mainmessage.$GLOBALS{'frs_meetextra'}."<br/><br/>"; }
	$mainmessage = $mainmessage."<hr>Our team for this match is:-<br/><br/>";
	$mainmessage = $mainmessage.$selectednamelist."<br/>";
	$mainmessage = $mainmessage."<hr>Umpire(s):-<br/><br/>";
	$mainmessage = $mainmessage.$officialnamelist."<br/>";	
 
	$eventa = Get_Array("event");
	foreach ($eventa as $event_id)  {
	    Get_Data("event",$event_id);
	    if (($GLOBALS{'event_publicationstatus'} == "Published")&&($GLOBALS{'event_date'} >= $GLOBALS{'currentYYYY-MM-DD'})&&($GLOBALS{'event_showinemail'} == "Yes") ) {
    		$link = YPGMLINK("webpageeventwebview.php");
    		$link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);		
    		$mainmessage = $mainmessage.'<table border="0"><tr><td border="0">';
    		$mainmessage = $mainmessage.'<table border="0"><tr>';
    		if ($GLOBALS{'event_featuredimage'} != "") {
    			$mainmessage = $mainmessage.'<td border="0"><br>'.'<a href="'.$link.'"><img src="http:'.$GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'}.'" width="200" /></a>';
    			$mainmessage = $mainmessage.'<td border="0"> </td>';			
    		}
    		$mainmessage = $mainmessage.'<td border="0">'.YH3($GLOBALS{'event_title'}).'<br>'.$GLOBALS{'event_excerpt'}."..".YLINKTXT($link,"Read More..");
    
    		$mainmessage = $mainmessage.'</td>';		
    		$mainmessage = $mainmessage.'</tr></table>';		
    		$mainmessage = $mainmessage.'</td></tr></table>';	
	    }		
	}
	
	$emailcontent = $mainmessage."<br><br>Automated Message - Please do not respond.<br><br>";

	// if ($emailto == "barry.bradley@connectivesolutions.co.uk") {
	// if ($GLOBALS{'person_id'} == "bbra") {  // Testing limitation
	if ($intest == "Yes") {	$displaymode = "display"; }
	else { $displaymode = "silent"; }		
	if ($inpreview == "Yes") {	Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); }			
	else { HTMLEmailRecorded_Output($displaymode,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2,$emailfrompersonid,$emailtopersonid,$emailreference,$emailexpirydate); }	
	// }
	// }
}				
							
								
								
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
