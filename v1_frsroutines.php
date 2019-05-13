<?php # frsroutines.php


function Frs_AvailabilityPopup_CSSJS () {
$GLOBALS{'SITECSSOPTIONAL'} = "frsavailability";	
$GLOBALS{'SITEJSOPTIONAL'} = "jquerymin,jqueryuimin,frsavailability";
}

function Frs_Availability_Output ($season, $availabilitypersonid, $window) {
	
    XH2("My Availability");
	Get_Data("person",$availabilitypersonid);
	XFORM("frsavailabilityin.php","Availability");

	// season
	// availabilitypersonid	
	// allavailable
	// allnotavailable
	// maxformseq		
	// $formseq_frsdate	
	// $formseq_dateavailable
	// $formseq_datenotavailable
	// $formseq_datecomment		
	// $formseq_maxmatchseq
	// $formseq_$matchseq_frsid
	// $formseq_$matchseq_matchavailable
	// $formseq_$matchseq_matchnotavailable	

	XINSTDHID();
	XINHID("season",$season);
	XINHID("availabilitypersonid",$availabilitypersonid);	
	XINHID("window",$window);
		
	$sectiona = explode(",",$GLOBALS{'person_section'});
	$earliestdate = "2100-01-01"; // arbitrary default
	$latestdate = "1900-01-01"; // arbitrary default
	$regulardayofweek = "";
	foreach ($sectiona as $section_name ) {
		Get_Data_Hash('section',$GLOBALS{'currperiodid'},$section_name);
		if ($GLOBALS{'section_showdateavailability'} == "Yes") {
			if (($GLOBALS{'section_seasonstartdate'} != "")&&($GLOBALS{'section_seasonstartdate'} != "0000-00-00")) {
				if ($GLOBALS{'section_seasonstartdate'} <  $earliestdate) { $earliestdate = $GLOBALS{'section_seasonstartdate'}; }
			}
			if (($GLOBALS{'section_seasonenddate'} != "")&&($GLOBALS{'section_seasonenddate'} != "0000-00-00")) {
				if ($GLOBALS{'section_seasonenddate'} >  $latestdate) { $latestdate = $GLOBALS{'section_seasonenddate'}; }
			}
		}
	}
	
	$cumavailabilitya = Array();
	if (($earliestdate != "2100-01-01")&&($latestdate != "1900-01-01")) {
		$thisdate = $earliestdate;
		while ($thisdate <= $latestdate) {
			$availabilitya = GetDateAvailability('person_dateavailability',$thisdate);
			// XH5($thisdate."|".$availabilitya[0]."|".$availabilitya[1]);
			if ( $availabilitya[0] == "Y" ) { $tdateavailable = "Y"; $tdatenotavailable = ""; }
			if ( $availabilitya[0] == "N" ) { $tdateavailable = ""; $tdatenotavailable = "Y"; }			
			if (($availabilitya[0] != "Y")&&($availabilitya[0] != "N")) { $tdateavailable = ""; $tdatenotavailable = ""; }		
			$tdatecomment = $availabilitya[1];
			$elementstring = $thisdate."|*****||||||".$tdateavailable."|".$tdatenotavailable."|".$tdatecomment."|||"; // low ascii sort
			$cumavailabilitya[] = $elementstring;
			// XH5($elementstring);		
			$elementstring = $thisdate."|~~~~~|||||||||||"; // high ascii sort
			$cumavailabilitya[] = $elementstring;
			$thisdate = OffsetDays ($thisdate,7);
		}
		$unixTimestamp = strtotime($earliestdate);
		$regulardayofweek = date("D", $unixTimestamp); // format DDD
	}

	$mysquadlist = Frs_GetMySquadList($availabilitypersonid);
	if ($mysquadlist != "") {
		XH4("Thank you for being an active playing member. You are included in the following team squads.");
		foreach (List2Array($mysquadlist) as $team_code) {
			Get_Data('team',$GLOBALS{'currperiodid'},$team_code);
			XTXT($GLOBALS{'team_name'});XBR();
		}
		XBR();
		foreach (List2Array($mysquadlist) as $team_code) {
			Get_Data("team",$GLOBALS{'currperiodid'},$team_code);
			$frsa = Get_Array("frs",$GLOBALS{'currperiodid'},$team_code);
			foreach ($frsa as $frs_id) {		
				Get_Data("frs",$GLOBALS{'currperiodid'},$team_code, $frs_id);
				
				$unixTimestamp = strtotime($GLOBALS{'frs_date'});
				$thisdayofweek = date("D", $unixTimestamp);
				$tdateavailable = "";
				$tdatenotavailable = "";
				$tdatecomment = "";
				if ($thisdayofweek != $regulardayofweek) { // lookup extra availability status
					$availabilitya = GetDateAvailability('person_dateavailability',$GLOBALS{'frs_date'});
					// XH5($thisdate."|".$availabilitya[0]."|".$availabilitya[1]);
					if ( $availabilitya[0] == "Y" ) { $tdateavailable = "Y"; $tdatenotavailable = ""; }
					if ( $availabilitya[0] == "N" ) { $tdateavailable = ""; $tdatenotavailable = "Y"; }			
					if (($availabilitya[0] != "Y")&&($availabilitya[0] != "N")) { $tdateavailable = ""; $tdatenotavailable = ""; }		
					$tdatecomment = $availabilitya[1];
				}
				$elementstring = $GLOBALS{'frs_date'}."|*****||||||".$tdateavailable."|".$tdatenotavailable."|".$tdatecomment."|||"; // low ascii sort
				$cumavailabilitya[] = $elementstring;
				// XH5($elementstring);		
				$elementstring = $GLOBALS{'frs_date'}."|~~~~~|||||||||||"; // high ascii sort
				$cumavailabilitya[] = $elementstring;	
				# 0.date 1.teamname 2.seq 3.oppo 4.venue 5.ha 6.time 7.Availability 8.teamcode 9.frsid
				
				$thisfrs_venue = "";
				if ($GLOBALS{'frs_ha'} == "H") {
					Check_Data('venue',$GLOBALS{'frs_venue'});
					if ($GLOBALS{'IOWARNING'} == "0" ) {
						$thisfrs_venue = $GLOBALS{'venue_name'};
					}
					else { $thisfrs_venue = $GLOBALS{'frs_venue'};
					}
				}
				if ($GLOBALS{'frs_ha'} == "A") {
					$thisfrs_venue = $GLOBALS{'frs_venue'};
				}
				if ($GLOBALS{'frs_awayvenue'} != "") {
					$thisfrs_venue = $GLOBALS{'frs_awayvenue'};
				}
				else {$thisfrs_venue = $GLOBALS{'frs_venue'};
				}
				$tdateavailable = "";
				$tdatenotavailable = "";
				$tdatecomment = "";
				$availability = GetSelectionList('frs_playerselectedlist',$availabilitypersonid,'availability');
				if ( $availability == "Y" ) { $tmatchavailable = "Y"; $tmatchnotavailable = ""; }
				if ( $availability == "N" ) { $tmatchavailable = ""; $tmatchnotavailable = "Y"; }			
				if (($availability != "Y")&&($availability != "N")) { $tmatchavailable = ""; $tmatchnotavailable = ""; }			
				$elementstring = $GLOBALS{'frs_date'}."|".$GLOBALS{'team_name'}."|".$GLOBALS{'frs_seq'};				
				$elementstring = $elementstring."|".$GLOBALS{'frs_oppo'}."|".$thisfrs_venue."|".$GLOBALS{'frs_ha'}."|".$GLOBALS{'frs_time'};
				$elementstring = $elementstring."|".$tdateavailable."|".$tdatenotavailable."|".$tdatecomment;				
				$elementstring = $elementstring."|".$tmatchavailable."|".$tmatchnotavailable;				
				$elementstring = $elementstring."|".$GLOBALS{'team_code'}."|".$GLOBALS{'frs_id'};
				$cumavailabilitya[] = $elementstring;
			}
		}
		sort($cumavailabilitya);
		/*	
		foreach ($cumavailabilitya as $elementstring) {
			XH5($elementstring);	
		}
		*/
		XBR();
		XPTXTCOLOR('<b>IMPORTANT NOTE</b> - Please don'."'".'t forget to press the "Update Availability" button at the bottom of this page to ensure that your update or changes are saved',"Green");
		
		$formseq = 0;
		$matchseq = 0;
		XTABLE();
		XTR();
		XTDHTXT("Date");XTDHTXT("Available<BR>Yes/No");XTDHTXT("Comments");XTDHTXT("");XTDHTXT("Squad Fixtures<BR>Yes/No");
		X_TR();
		XTR();
		XTDHTXT("All");
		XTH();
		XINCHECKBOXYNULLID ("allavailable","allavailable","","");
		XINCHECKBOXYNULLID ("allnotavailable","allnotavailable","","");		
		X_TH();		
		XTDHTXT("");XTDHTXT("");XTDHTXT("");		
		X_TR();
		$firsttop = "1"; $firstbottom = "1";
		foreach ($cumavailabilitya as $elementstring) {
			$aa = explode('|',$elementstring);
			$tfrsdate = $aa[0];
			if ($tfrsdate >= $GLOBALS{'currentYYYY-MM-DD'}) {
				$tteamname = $aa[1];
				$tfrsseq = $aa[2];
				$tfrsoppo = $aa[3]; 
				$tfrsvenue = $aa[4]; 
				$tfraha = $aa[5]; 
				$tfrstime = $aa[6];
				$tdateavailable = $aa[7]; 
				$tdatenotavailable = $aa[8];
				$tdatecomment = $aa[9];			
				$tmatchavailable = $aa[10];
				$tmatchnotavailable = $aa[11];
				$tteamcode = $aa[12]; 
				$tfrsid = $aa[13]; 	
	
				// formseq_dateavailable_YYYY-MM-DD
				// formseq_datenotavailable_YYYY-MM-DD
				// formseq_matchavailable_frsid
				// formseq_matchnotavailable_frsid
				
				if (($tteamname == "*****")&&($firsttop == "1")) {
					$formseq++;
					XTR();
					XTD();XTXT(YYYY_MM_DDtoDDDbDDbMMMbYY($aa[0]));XBR();XBR();X_TD();
					XTD();
					XINHID($formseq."_frsdate",$tfrsdate);				
					XINCHECKBOXYNULLID ($formseq.'_dateavailable',$formseq.'_dateavailable',$tdateavailable,"");
					XINCHECKBOXYNULLID ($formseq.'_datenotavailable',$formseq.'_datenotavailable',$tdatenotavailable,"");	
					X_TD();
					XTDINTXT($formseq.'_datecomment',$tdatecomment,"40","80");
					XTDTXT("");
					XTD();
					$sep = "";
					$firsttop = "0";
					$firstbottom = "1";
				}		
				if (($aa[1] > "*****")&&($aa[1] < "~~~~~")) {			
					$matchseq++;
					XINHID($formseq."_".$matchseq."_frsid",$tfrsid);
					XTXT($sep);
					XINCHECKBOXYNULLID ($formseq."_".$matchseq."_matchavailable",$formseq."_".$matchseq."_matchavailable",$tmatchavailable,"");
					XINCHECKBOXYNULLID ($formseq."_".$matchseq."_matchnotavailable",$formseq."_".$matchseq."_matchnotavailable",$tmatchnotavailable,"");	
					XTXT( $tteamname." v ".$tfrsoppo." ".$tfraha." ".$tfrsvenue." ".$tfrstime );
					$sep = "<br>";
				}			
				if (($aa[1] == "~~~~~")&&($firstbottom == "1")) {
					XINHID($formseq."_maxmatchseq",$matchseq);
					X_TD();X_TR();
					// XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
					$firsttop = "1";
					$firstbottom = "0";	
					$matchseq = 0;
				}
			}				
		}
		X_TABLE();
		XBR();XBR();
		XINSUBMITID("SubmitButton","Update Availability");
		XINHID("maxformseq",$formseq);
		X_FORM();
	} else {
		XH4("You have not yet been assigned to a team squad");
	}
}

function Frs_Stats_Output ($season, $statspersonid, $window) {
       
    $mysectiona = List2Array(Frs_GetMySectionList($statspersonid));
    $masterstatsa = Array();
    $statsheadera = Array("Appearances","Team Won","Team Drew","Team Lost","Team GF","Team GA");
    $initialpersonstatsa = Array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    
    $customstatsindexa = Array();
    $customstatsindexstart = 5;    
    $customstatsindex = 5;
    
    foreach (Get_Array("frspersonstattype",$season) as $frspersonstattype_code)  {
        Get_Data("frspersonstattype", $season, $frspersonstattype_code);
        $statsforsectiona = List2Array($GLOBALS{'frspersonstattype_sectionlist'});
        $c = array_intersect($mysectiona, $statsforsectiona);
        if (count($c) > 0) {
            $customstatsindex++;
            $customstatsindexa[$frspersonstattype_code] = $customstatsindex;
            array_push($statsheadera,$GLOBALS{'frspersonstattype_name'}); 
        }  
    }
    
    foreach ($mysectiona as $section_name) {
        $playera = Get_Array('frspersonstat',$season,$section_name."-Appearance");
        foreach ($playera as $playerid) {
            Get_Data('frspersonstat',$season,$section_name."-Appearance",$playerid);
            if ( isset($masterstatsa[$playerid]) )  {}
            else { $masterstatsa[$playerid] = $initialpersonstatsa; }
            $masterstatsa[$playerid][0] = $GLOBALS{'frspersonstat_quantity'};
            $masterstatsa[$playerid][1] = $GLOBALS{'frspersonstat_teamwon'};
            $masterstatsa[$playerid][2] = $GLOBALS{'frspersonstat_teamdrew'};
            $masterstatsa[$playerid][3] = $GLOBALS{'frspersonstat_teamlost'};
            $masterstatsa[$playerid][4] = $GLOBALS{'frspersonstat_teamgf'};
            $masterstatsa[$playerid][5] = $GLOBALS{'frspersonstat_teamga'}; 
        }
        
        foreach (Get_Array("frspersonstattype",$season) as $frspersonstattype_code)  {
            Get_Data("frspersonstattype", $season, $frspersonstattype_code);
            $statsforsectiona = List2Array($GLOBALS{'frspersonstattype_sectionlist'});
            $c = array_intersect($mysectiona, $statsforsectiona);
            if (count($c) > 0) {
                $playera = Get_Array('frspersonstat',$season,$section_name."-".$frspersonstattype_code);
                foreach ($playera as $playerid) {
                    Get_Data('frspersonstat',$season,$section_name."-".$frspersonstattype_code,$playerid);
                    if ( isset($masterstatsa[$playerid]) )  {}
                    else { $masterstatsa[$playerid] = $initialpersonstatsa; }
                    $masterstatsa[$playerid][$customstatsindexa[$frspersonstattype_code]] = $GLOBALS{'frspersonstat_quantity'};
                }
            }
        }
    } 
       
    XDIV("reportdiv","container");
    // XINHIDID("reportwidth","reportwidth","90%");
    // XINHIDID("reportalign","reportalign","left");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("First Name");
    XTDHTXT("Last Name");
    for ($i = 0; $i < count($statsheadera); $i++) {   
        XTDHTXT($statsheadera[$i]);
    }       
    XTDHTXT("");
    X_TR();
    X_THEAD();
    XTBODY();  
    

    
    foreach ($masterstatsa as $personid => $personstatsa) {        
        // XPTXT($personid."|".$personstatsa[0]."|".$personstatsa[1]."|".$personstatsa[2]."|".$personstatsa[3]."|".$personstatsa[4]."|".$personstatsa[5]);
        Check_Data("person",$personid);
        if ($GLOBALS{'IOWARNING'} == "0") {             
            if ($statspersonid != $personid) {
                XTRJQDT();
                XTDTXT($GLOBALS{'person_fname'});
                XTDTXT($GLOBALS{'person_sname'});
                for ($i = 0; $i < count($statsheadera); $i++) {
                    XTDTXT($personstatsa[$i]);
                }
                $link = YPGMLINK("personplayerprofilepopup.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("person_id",$personid);
                # url,text,wintitle,top,left,height,width
                XTDLINKTXTNEWPOPUP($link,"Player Profile","Player Profile","center","center","500","500");  
                X_TR(); 
            } else {                            
                
                  // me first !
                XTRJQDT();
                XTDTXTCOLOR('<b>'.$GLOBALS{'person_fname'}.'</b>',"#2F79B9");
                XTDTXTCOLOR('<b>'.$GLOBALS{'person_sname'}.'</b>',"#2F79B9");
                for ($i = 0; $i < count($statsheadera); $i++) {
                    XTDTXTCOLOR('<b>'.$personstatsa[$i].'</b>',"#2F79B9");
                }
                $link = YPGMLINK("personplayerprofilepopup.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("person_id",$personid);
                # url,text,wintitle,top,left,height,width
                XTDLINKTXTNEWPOPUP($link,"Player Profile","Player Profile","center","center","500","500");
                X_TR();               
                
            }
        }
    }
    
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT(); 
    XINHID("list_sortcol",0);
    
}



function Frs_TEAMFIXTURESLIST_Output ($season, $section, $team_code) {
	$frs_idkey=$team_code.$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}."9";
	$frs_ida = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
	Get_Data("team",$GLOBALS{'currperiodid'},$team_code);
	XH3($GLOBALS{'team_name'}.' - Match Results '.$season." ".$team_code);
	$helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XTABLE();
	XTR();
	XTDHTXT("Date");
	XTDHTXTTITLE("Seq","Sequence - if multiple matches per day");
	XTDHTXT("Opposition");
	XTDHTXTTITLE("H/A","Home / Away");
	XTDHTXTTITLE("L/C/F", "League / Cup / Friendly");
	XTDHTXT("");
	XTDHTXT("Result");
	XTDHTXT("For");
	XTDHTXT("Against");
	XTDHTXT("Match Reports<br>Results & Statistics");
	XTDHTXT("Team Selection<BR>& Notification");
	X_TR();

	$frs_ida = Get_Array("frs",$GLOBALS{'currperiodid'},$team_code);
	foreach ($frs_ida as $frs_id) {
		Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
		$formteam_code = $team_code;
		$formfrs_id = $frs_id;
		XTR();
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
		XTDTXT($GLOBALS{'frs_seq'});
		$tclublink = "";
		if ($GLOBALS{'frs_oppoteamkey'} != "") {
			$teamsplit = explode('^', $GLOBALS{'frs_oppoteamkey'});
			$oppoclub_name = $teamsplit[0]; $oppoteam_name = $teamsplit[1];
			Check_Data('oppoclub',$oppoclub_name);
			if ($GLOBALS{'IOWARNING'} == "0") {
				Get_Data('oppoclub',$oppoclub_name); $tclublink = $GLOBALS{'oppoclub_link'};
			}
		}
		if ($tclublink != "") {
			XTDLINKTXT("http://$tclublink",$GLOBALS{'frs_oppo'});
		}
		else {XTDTXT($GLOBALS{'frs_oppo'});
		}
		XTDTXT($GLOBALS{'frs_ha'});
		XTDTXT($GLOBALS{'frs_lcf'});
		if ( $GLOBALS{'frs_cancellation'} == "Yes" ) { XTDTXT('<span style="color:red"><b>Cancelled</b></span>'); }
		else { XTDTXT(''); }
		XTDTXT($GLOBALS{'frs_result'});
		XTDTXT($GLOBALS{'frs_gf'});
		XTDTXT($GLOBALS{'frs_ga'});
		$FrsIdN = "FrsId";
		if ($GLOBALS{'currentYYYY-MM-DD'} >= $GLOBALS{'frs_date'}) {
			$link = YPGMLINK("frsteamresultsout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("section_name",$section).YPGMPARM("team_code",$team_code).YPGMPARM("frs_id",$frs_id);
			XTDLINKTXT($link,"update");
		} else {
			XTDTXT("");
		}
		if ($GLOBALS{'currentYYYY-MM-DD'} <= $GLOBALS{'frs_date'}) {
			$link = YPGMLINK("frsteamselectionout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("section_name",$section).YPGMPARM("team_code",$team_code).YPGMPARM("frs_id",$frs_id);
			XTDLINKTXT($link,"update");
		} else {
			$link = YPGMLINK("frsteamselectionout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("section_name",$section).YPGMPARM("team_code",$team_code).YPGMPARM("frs_id",$frs_id);
			XTDLINKTXT($link,'<font color="#D7DBDC">view</font>');
		}
		X_TR();
	}
	X_TABLE();
}

function Frs_TEAMFIXTURECARDPAGE_Output ($season, $team_code) {
	$frs_idkey=$team_code.$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}."9";
	$frs_ida = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
	Get_Data("team",$GLOBALS{'currperiodid'},$team_code);
	XH3($GLOBALS{'team_name'}.' - Fixture Card Page '.$season);
	XH3($GLOBALS{'team_leaguename'});	
	XH3("$txt1");
	XPTXT("Exclude those entries you do not wish to appear in the final print version.");
	
	XFORM("frsteamfixturecardpageprint.php","Squadlist");
	XINSTDHID();
	XINHID("season",$season);	
	XINHID("team_code",$team_code);

	XTABLE();
	XTR();
	XTDHTXT("Date");
	XTDHTXT("Opposition");
	XTDHTXT("Home<br>Away");
	XTDHTXT("League<br>Friendly");
	XTDHTXT("Venue");	
	XTDHTXT("Time");
	XTDHTXT("Info");
	XTDHTXT("Exclude");	
	X_TR();

	$frs_ida = Get_Array("frs",$GLOBALS{'currperiodid'},$team_code);
	foreach ($frs_ida as $frs_id) {
		Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
		$formteam_code = $team_code;
		$formfrs_id = $frs_id;
		XTR();
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
		XTDTXT($GLOBALS{'frs_oppo'});
		XTDTXT($GLOBALS{'frs_ha'});
		XTDTXT($GLOBALS{'frs_lcf'});
		if ($GLOBALS{'frs_ha'} == "H") {
			Check_Data('venue',$GLOBALS{'frs_venue'});
			if ($GLOBALS{'IOWARNING'} == "0" ) {
				XTDTXT($GLOBALS{'venue_name'});
			}
			else {
				XTDTXT($GLOBALS{'frs_venue'});
			}
		}
		if ($GLOBALS{'frs_ha'} == "A") {
			XTDTXT($GLOBALS{'frs_awayvenue'});
		}
		if (($GLOBALS{'frs_ha'} != "H")&&($GLOBALS{'frs_ha'} != "A")) {
			XTDTXT("");
		}
		
		XTDTXT($GLOBALS{'frs_time'});		
		XTDTXT($GLOBALS{'frs_info'});	
		XTDINCHECKBOXYESNO ('frs_excludefromfixturecard|'.$frs_id,$GLOBALS{'frs_excludefromfixturecard'},"");
		X_TR();
	}
	X_TABLE();	
	if ($GLOBALS{'team_captain'} != "") {
		$splitstra = explode(',', $GLOBALS{'team_captain'} );		
		XBR();
		$sep = "";		
		XTXT('<b>'.$GLOBALS{'team_name'}." Captain: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});$sep = " / ";
			}	
		}
		XTXT('</b>');
		XBR();
		$sep = "";
		XTXT("Mobile: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_mobiletel'});$sep = " / ";
			}
		}
		XBR();
		$sep = "";	
		XTXT("Email: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_email1'});$sep = " / ";
			}
		}				
	}
	if ($GLOBALS{'team_coach'} != "") {
		$splitstra = explode(',', $GLOBALS{'team_coach'} );
		XBR();
		$sep = "";		
		XTXT('<b>'.$GLOBALS{'team_name'}." Coach: ");
		$sep = "";
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});$sep = " / ";
			}	
		}
		XTXT('</b>');
		XBR();
		$sep = "";
		XTXT("Mobile: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_mobiletel'});$sep = " / ";
			}
		}
		XBR();
		$sep = "";
		XTXT("Email: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_email1'});$sep = " / ";
			}
		}	
	}
	
	if ($GLOBALS{'team_mgr'} != "") {
		$splitstra = explode(',', $GLOBALS{'team_mgr'} );
		XBR();		
		XTXT('<b>'.$GLOBALS{'team_name'}." Manager: ");
		$sep = "";	
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});$sep = " / ";
			}	
		}
		XTXT('</b>');
		XBR();
		$sep = "";
		XTXT("Mobile: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_mobiletel'});$sep = " / ";
			}
		}
		XBR();
		$sep = "";	
		XTXT("Email: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_email1'});$sep = " / ";
			}
		}	
	}
	XBR();XBR();
	XINSUBMIT("Show Printable Page");
	X_FORM();
}

function Frs_TEAMFIXTURECARDPAGEPRINT_Output ($season, $team_code) {
	$frs_idkey=$team_code.$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}."9";
	$frs_ida = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
	Get_Data("team",$GLOBALS{'currperiodid'},$team_code);
	XPTXT("Cut and paste the following into the publishing software");
	XHR();
	XBR();
	XH3($GLOBALS{'team_name'});
	XH3($GLOBALS{'team_leaguename'});
	XBR();
	XTABLE();
	XTR();
	XTDHTXT("Date");
	XTDHTXT("Opposition");
	XTDHTXT("Home<br>Away");
	XTDHTXT("League<br>Friendly");
	XTDHTXT("Venue");
	XTDHTXT("Time");
	XTDHTXT("Info");
	X_TR();

	$frs_ida = Get_Array("frs",$GLOBALS{'currperiodid'},$team_code);
	foreach ($frs_ida as $frs_id) {
		Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
		if ($GLOBALS{'frs_excludefromfixturecard'} != "Yes") {
			XTR();
			XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
			XTDTXT($GLOBALS{'frs_oppo'});
			XTDTXT($GLOBALS{'frs_ha'});
			XTDTXT($GLOBALS{'frs_lcf'});
			if ($GLOBALS{'frs_ha'} == "H") {
				Check_Data('venue',$GLOBALS{'frs_venue'});
				if ($GLOBALS{'IOWARNING'} == "0" ) {
					XTDTXT($GLOBALS{'venue_name'});
				}
				else {
					XTDTXT($GLOBALS{'frs_venue'});
				}
			}
			if ($GLOBALS{'frs_ha'} == "A") {
				XTDTXT($GLOBALS{'frs_awayvenue'});
			}
			if (($GLOBALS{'frs_ha'} != "H")&&($GLOBALS{'frs_ha'} != "A")) {
				XTDTXT("");
			}
	
			XTDTXT($GLOBALS{'frs_time'});
			XTDTXT($GLOBALS{'frs_info'});
			X_TR();
		}
	}
	X_TABLE();

	if ($GLOBALS{'team_captain'} != "") {
		$splitstra = explode(',', $GLOBALS{'team_captain'} );
		XBR();
		$sep = "";
		XTXT('<b>'.$GLOBALS{'team_name'}." Captain: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});$sep = " / ";
			}
		}
		XTXT('</b>');
		XBR();
		$sep = "";
		XTXT("Mobile: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_mobiletel'});$sep = " / ";
			}
		}
		XBR();
		$sep = "";
		XTXT("Email: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_email1'});$sep = " / ";
			}
		}
	}
	if ($GLOBALS{'team_coach'} != "") {
		$splitstra = explode(',', $GLOBALS{'team_coach'} );
		XBR();
		$sep = "";
		XTXT('<b>'.$GLOBALS{'team_name'}." Coach: ");
		$sep = "";
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});$sep = " / ";
			}
		}
		XTXT('</b>');
		XBR();
		$sep = "";
		XTXT("Mobile: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_mobiletel'});$sep = " / ";
			}
		}
		XBR();
		$sep = "";
		XTXT("Email: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_email1'});$sep = " / ";
			}
		}
	}

	if ($GLOBALS{'team_mgr'} != "") {
		$splitstra = explode(',', $GLOBALS{'team_mgr'} );
		XBR();
		XTXT('<b>'.$GLOBALS{'team_name'}." Manager: ");
		$sep = "";
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});$sep = " / ";
			}
		}
		XTXT('</b>');
		XBR();
		$sep = "";
		XTXT("Mobile: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_mobiletel'});$sep = " / ";
			}
		}
		XBR();
		$sep = "";
		XTXT("Email: ");
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTXT($sep.$GLOBALS{'person_email1'});$sep = " / ";
			}
		}
	}
}

function Frs_FRSSQUADCHOOSER_Output () {
	XH3("Team Squad Setup");
	$teamsa = Person_TeamVisibility_Array("change");
	$teamcodelist = ""; $teamcodesep = "";
	$teamnamelist = ""; $teamnamesep = "";	
	foreach ($teamsa as $tteam_code) {
		Get_Data("team",$GLOBALS{'currperiodid'},$tteam_code);
		$teamcodelist = $teamcodelist.$teamcodesep.$tteam_code; $teamcodesep = ",";
		$teamnamelist = $teamnamelist.$teamnamesep.$GLOBALS{'team_name'}; $teamnamesep = ",";
	}
	$xhash = Lists2Hash($teamcodelist, $teamnamelist);
	XFORM("frssquadselectionin.php","frssquadin");
	XINSTDHID();	
	XTABLE();
	XTR();XTDTXT("Team Squad");XTDINSELECTHASH ($xhash,"team_code","");X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Select");X_TR();
	X_TABLE();	
	X_FORM();	
}

function Frs_GetMySquadList ($personid) {
	$teamsa = Get_Array('team',$GLOBALS{'currperiodid'});
	$teamcodelist = ""; $teamcodesep = "";
	foreach ($teamsa as $tteam_code) {
		Get_Data('team',$GLOBALS{'currperiodid'},$tteam_code);
		$teamsquadlist = $GLOBALS{'team_squadlist'}.",";
		$searchfield = $personid.",";			
		if (strpos($teamsquadlist, $searchfield) !== FALSE) {
			$teamcodelist = $teamcodelist.$teamcodesep.$tteam_code; $teamcodesep = ",";
		}
	}
	return $teamcodelist;
}

function Frs_GetMySquadListHash ($teamsquadlista ,$personid) {
	$teamcodelist = ""; $teamcodesep = "";
	foreach ($teamsquadlista as $key => $value) {
		$searchfield = $personid.",";
		if (strpos($value, $searchfield) !== FALSE) {
			$teamcodelist = $teamcodelist.$teamcodesep.$key; $teamcodesep = ",";
		}
	}
	return $teamcodelist;
}


function Frs_GetMySectionList ($personid) { 
    $sectionnamelist = ""; $sectionnamesep = "";
    $squadcodea = List2Array(Frs_GetMySquadList ($personid)); 
    foreach (Get_Array("section",$GLOBALS{'currperiodid'}) as $section_name) {
        Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
        $teamcodea = List2Array($GLOBALS{'section_teams'});       
        $c = array_intersect($squadcodea, $teamcodea);
        if (count($c) > 0) {
            $sectionnamelist = $sectionnamelist.$sectionnamesep.$section_name; $sectionnamesep = ",";
        }       
    }
    // XPTXT($sectionnamelist);
    return $sectionnamelist;
}

function Frs_FRSSQUADSELECTION_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "jquerymin,jqueryuimin,globalroutines,ioroutines,personselectionpopup,viewaspopup,jqdatatablesmin,frssquadselection";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Frs_FRSSQUADSELECTION_Output ($season, $team_code) {
	Get_Data('team',$season,$team_code);
	$helplink = "Setup/Setup_MASTERS_Output/setup_masters_output.html"; Help_Link();
	XH3("Squad - ".$GLOBALS{'team_name'});
	XPTXTCOLOR("Don't forget to save your updated squad list after you have made changes !","green");
	XFORM("frssquadselectionin.php","Squadlist");
	XINSTDHID();
	XINHID("team_code",$team_code);
	XINHID("team_squadlist",$GLOBALS{'team_squadlist'});
	XTABLEJQDTID("squadtable");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("Id");XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Age");XTDHTXT("EMail");XTDHTXT("Mobile");XTDHTXT("Type");XTDHTXT("ShirtNo");XTDHTXT("Paid Date");XTDHTXT("Paid");XTDHTXT("");XTDHTXT("");
	X_TR();
	X_THEAD();
	XTBODY();
	X_TBODY();
	X_TABLE();
	
	XINHID("squadtable_modified","");  // updated to Yes if table changed
	XH4("Add Squad Member");
	XTXT('Enter names (or part names) and press "Add to Squad"');XBR();
	XTABLE();
	XTR();XTDTXT("First Name");XTDINTXTID("person_fname_presearch","person_fname_presearch","","20","30");X_TR();
	XTR();XTDTXT("Surname");XTDINTXTID("person_sname_presearch","person_sname_presearch","","20","30");X_TR();
	XTR();XTDTXT("");XTD();XINBUTTONID("SquadButton","Add to Squad");X_TD();X_TR();
	X_TABLE();
	XBR();XBR();
	XINSUBMITID("SubmitButton","Save Updated Squad List");
	X_FORM();
	XTXTID("TRACETEXT","");

	$GLOBALS{'PersonSelectPopupParameters'} = array(
	 "this,person_id|person_sname|person_fname|person_section|person_email1|person_mobiletel|person_type|person_shirtnumber|person_paiddate|person_paidperiodid|person_dob|person_position",
	 "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90|person_position,Position,90",
 	 // "rows,SquadButton,Add_To_Squad,team_squadlist(addto),squadtable(person_id+person_fname+person_sname+person_dob[AgeFilter=18]+person_email1+person_mobiletel+person_type+person_paiddate+person_paidperiodid[RAGCompare=".$season."]+remove+update),100",
	 "datatablerows,SquadButton,Add_To_Squad,team_squadlist(addto),squadtable(person_id+person_fname+person_sname+person_dob[AgeFilter=18]+person_email1+person_mobiletel+person_type+person_shirtnumber+person_paiddate+person_paidperiodid[RAGCompare=".$season."]+remove+update),100",
	 "person_id",
	 "all",
	 "Squad,center,center,1000,600",
	 "view",
	 "singleaddtolist"
	);
}

function Frs_FRSSQUADPLANNER_CSSJS () {
$GLOBALS{'SITEJSOPTIONAL'} = "jquerymin,jqueryuimin,viewaspopup,frssquadplanner";
}

function Frs_FRSSQUADPLANNER_Output ($season, $team_code) {
	XH3("Team Squad Planner");
	
	$yesback = "#99FFCC";
	$noback = "#FFCCCC";
	$confirmedback = "#88D388";	
	Get_Data('team',$season,$team_code);
	$helplink = "Setup/Setup_MASTERS_Output/setup_masters_output.html"; Help_Link();
	XH3("Squad - ".$GLOBALS{'team_name'});
	XHR();
	XH3("Key");
	XTABLE();XTRODD();XTDTXTWIDTH("Available","150");XTDBACKCOLOR($yesback);XINCHECKBOXYN("availablekeybox","","");X_TR();X_TABLE();
	XTABLE();XTRODD();XTDTXTWIDTH("Not Available","150");XTDBACKCOLOR($noback);XINCHECKBOXYN("notavailablekeybox","","");X_TR();X_TABLE();	
	XTABLE();XTRODD();XTDTXTWIDTH("Availability Not Known","150");XTDBACKCOLOR("");XINCHECKBOXYN("notknownkeybox","","");X_TR();X_TABLE();
	XTABLE();XTRODD();XTDTXTWIDTH("Selected and Confirmed","150");XTDBACKCOLOR($confirmedback);XINCHECKBOXYN("confirmedkeybox","","");X_TR();X_TABLE();		
	XBR();
	XTABLE();XTRODD();XTDTXTWIDTH("Planned or Selected","150");XTDBACKCOLOR("");XINCHECKBOXYN("plannedkeybox","Y","");X_TR();X_TABLE();	
	XBR();
	XHR();
	XPTXT("Note: Squad members shown in surname order (hover over to check name) -->");
	XFORM("frssquadplannerin.php","Squadlist");
	XINSTDHID();
	XINHID("team_code",$team_code);
	XINHID("team_squadlist",$GLOBALS{'team_squadlist'});
	$squada = explode(',',$GLOBALS{'team_squadlist'});
	$firstheader = "1";		
	if ($GLOBALS{'team_squadlist'} != "") {
		XTABLE();
		$headcountmax = 10; $headcount = $headcountmax+1; 
		$future = "0";
		$frs_ida = Get_Array("frs",$GLOBALS{'currperiodid'},$team_code);
		foreach ($frs_ida as $frs_id) {
			$headcount++;
			if ($headcount > $headcountmax) {	
				$headcount = 0;
				XTR();
				XTDHTXT("Date");XTDHTXT("Opposition");XTDHTXT("H/A");XTDHTXT("Time");XTDTXT("");				
				$sepcount = -1;
				foreach ($squada as $personid) {
					Check_Data('person',$personid);
					if ($GLOBALS{'IOWARNING'} == "0") { 							
						$sepcount++;
						if ($sepcount >5 ) { XTDHTXT("");$sepcount = 0; } 
						XTDHTXTTITLE($personid."<br>".$GLOBALS{'person_shirtnumber'}, $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}); 
					}
					// else {  XTDHTXTTITLE($personid, "Not Found"); }
				}		
				X_TR();	

				if ( $firstheader == "1" ) {
					$firstheader = "0";
					XTR();XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");				
					$sepcount = -1;
					foreach ($squada as $personid) {
						Check_Data('person',$personid);
						if ($GLOBALS{'IOWARNING'} == "0") {						
							$sepcount++;
							if ($sepcount >5 ) {
								XTDHTXT("");$sepcount = 0;
							}
							$link = YPGMLINK("frsavailabilityout.php");
							$link = $link.YPGMSTDPARMS().YPGMPARM("season",$GLOBALS{'currperiodid'}).YPGMPARM("availabilitypersonid",$personid);
							// XTDLINKTXTNEWWINDOW($link,"avail","availability");
							// url,text,wintitle,top,left,height,width
							XTDLINKTXTNEWPOPUP($link,"avail","availability","center","center","600","1000");
						}
						// else {  XTDHTXTTITLE($personid, "Not Found");}
					}
					X_TR();
				}
				
			}
			Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
			$formteam_code = $team_code;
			$formfrs_id = $frs_id;
			if (($GLOBALS{'currentYYYY-MM-DD'} <= $GLOBALS{'frs_date'})&&($future == "0")) {
			  	$future = "1";
				XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");
				$sepcount = -1;
				foreach ($squada as $personid) { $sepcount++; if ($sepcount >5 ) { XTDHTXT(""); $sepcount = 0; } XTDHTXT(""); }
				
			} 
			XTR();
			XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
			XTDTXT($GLOBALS{'frs_oppo'});
			XTDTXT($GLOBALS{'frs_ha'});
			XTDTXT($GLOBALS{'frs_time'});
			XTDTXT("");
			$sepcount = -1;
			foreach ($squada as $personid) {
				Check_Data('person',$personid);
				if ($GLOBALS{'IOWARNING'} == "0") {				
					$sepcount++;
					if ($sepcount >5 ) { XTDTXT("");$sepcount = 0; } 
					$currentplanned = GetSelectionList('frs_playerselectedlist',$personid,'planned');
					$currentavailability = GetSelectionList('frs_playerselectedlist',$personid,'availability');
					$currentselected = GetSelectionList('frs_playerselectedlist',$personid,'selected');								
					$currentnotified = GetSelectionList('frs_playerselectedlist',$personid,'notified');
					$currentconfirmed = GetSelectionList('frs_playerselectedlist',$personid,'confirmed');
	
					if ($currentselected == "Y") { $currentplanned = "Y"; } 
					
					$backgroundcolor = "";
					if ($currentavailability == "Y") { $backgroundcolor = $yesback; } 
					if ($currentavailability == "N") { $backgroundcolor = $noback; } 
					if ($currentconfirmed == "Y") { $backgroundcolor = $confirmedback; } 			
					if ($backgroundcolor != "") { XTDBACKCOLOR($backgroundcolor); } 					
					else {XTD();}
					
					if ($GLOBALS{'currentYYYY-MM-DD'} <= $GLOBALS{'frs_date'}) {
						XINCHECKBOXYN ($frs_id."_".$personid,$currentplanned,"");	
					} else {
						if ($currentplanned == "Y") { XTXT("P"); }
						else { XTXT(""); }
					}
					X_TD();
				}
			}		
			X_TR();
		}
		X_TABLE();
		XBR();XBR();
		
		XINSUBMITID("SubmitButton","Update my planned selection plan");
		X_FORM();				
	} else {
		XH3("There is no squad selected for this team");
	}
	XHR();
	
	XTABLEINVISIBLE();
	XTR();
	$link = YPGMLINK("frssquadavailabilityreminder.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("team_code",$team_code);
	# link,imagesrc,width,height,border,wintitle,top,left,height,width	
	XTD();XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/AVAILABILITYREMINDER.png","100","100","0","AvailabilityReminder","center","center","90%","90%");X_TD();
	X_TR();
	X_TABLE();
}


function Frs_FRSTEAMRESULTS_CSSJS () {
$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
$GLOBALS{'SITEJSOPTIONAL'} = "tinymcecallupload,tinymceinit,globalroutines,ioroutines,jqdatatablesmin,frsresults,personselectionpopup";
$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Frs_FRSTEAMRESULTS_Output ($season, $section, $team_code, $frsid) {

	// ========== list coding ====================================
	// frs_statslist bbra,G,2|gcho,G,1|bloc,S,Yes|rstr,G,1  =  personid,atatcode,statvalue|personid,atatcode,statvalue
	Get_Data('section', $season, $section);
	Get_Data('team', $season, $team_code);
	Get_Data('frs', $season, $team_code,$frsid);
	if ($GLOBALS{'section_sportid'} == "") { Get_Data("sport_".$GLOBALS{'domain_sportid'}); } 
	else { Get_Data("sport_".$GLOBALS{'section_sportid'}); }
	XH3('Match Results, Reports & Statistics ('.$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}." ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}).")");
	# XH3($season."|".$section."|".$team_code."|".$frsid);
	$helplink = "ResultsMaster/Mass_Result/mass_result"; Help_Link;
	XFORMUPLOAD("frsteamresultsin.php","teamresults");
	XINSTDHID();
	XINHID("team_code",$team_code);
	XINHID("section_name",$section);
	XINHID("FrsId",$frsid);
	XINHID("TinyMCEUploadTo","FRS");
	XINHID("TinyMCEUploadId",$frsid);
	XINHID('frs_statslist',$GLOBALS{'frs_statslist'});
	XINHID('currperiodid',$GLOBALS{'currperiodid'});	
	$bits = str_split($frs_id);
	$fixdate = $bits[2].$bits[3].$bits[4].$bits[5].$bits[6].$bits[7];
	XH5("Match Result");
	XTABLE();
	# XTR();XTDHTXT("Information");XTDHTXT("Old Value");XTDHTXT("");X_TR();
	$xhash = List2Hash("Won,Lost,Drew");
	XTR();XTDTXT("Result"."&nbsp;&nbsp;");XTDINSELECTHASH($xhash,"frs_result",$GLOBALS{'frs_result'});X_TR();
	XTR();XTDTXT($GLOBALS{'sport_resultunit'}."For"."&nbsp;&nbsp;");XTDINTXT("frs_gf",$GLOBALS{'frs_gf'},"2","3");X_TR();
	XTR();XTDTXT($GLOBALS{'sport_resultunit'}."Against"."&nbsp;&nbsp;");XTDINTXT("frs_ga",$GLOBALS{'frs_ga'},"2","3");X_TR();
	X_TABLE();
	
	# ======== set lookup tables ==============================
	$squada = explode(',',$GLOBALS{'team_squadlist'});
	$idlist = ""; $idsep = "";
	$namelist = ""; $namesep = "";
	if ($GLOBALS{'team_squadlist'} != "") {	
		foreach ($squada as $spersonid) {
			Check_Data('person',$spersonid);
			if ($GLOBALS{'IOWARNING'} == "0") {
				$idlist = $idlist . $idsep . $spersonid; $idsep = ",";		
				$namelist = $namelist . $namesep . $GLOBALS{'person_fname'} . " " . $GLOBALS{'person_sname'}; $namesep = ",";
			}		
		}
	}
	$shash = Lists2Hash($idlist, $namelist);
	
	XH5("Match Statistics");
	XTABLE();
		XTR();
			XTD();
				XH5("Existing Stats");
				XTABLEID('matchstats_table');
				X_TABLE();
			X_TD();
			XTDIMG ( $GLOBALS{'site_asseturl'}."/leftarrow.png","100","180","0");
			XTD();
				XH5("Create New Entry");
				XTABLE();
					XTR();
						XTDHTXT("Find Person");
						XTDHTXT("Selected Person");
						foreach (Get_Array_Hash('frspersonstattype', $season) as $frspersonstattype) {
							Get_Data('frspersonstattype', $season, $frspersonstattype);
							if ( FoundInCommaList($section,$GLOBALS{'frspersonstattype_sectionlist'}) ) {
								XTDHTXT($GLOBALS{'frspersonstattype_name'});
							}
						}
					X_TR();
					XTR();
						XTD();
							XTABLE();
								XTR();XTD();
									XTXT("From Squadlist");XBR();
									XINSELECTHASH($shash,"AddSquadPersonId","");
								X_TD();X_TR();
								XTR();XTD();
									XTXT("Other");XBR();	
									XINBUTTONID("AddSearchPerson","Search");
								X_TD();X_TR();
							X_TABLE();
						X_TD();
						XTD();
						XTXTID("AddStatPersonName",".........");
						XINHID("AddStatPersonId","");
						X_TD();
						foreach (Get_Array_Hash('frspersonstattype', $season) as $frspersonstattype) {
							Get_Data_Hash('frspersonstattype', $season, $frspersonstattype);
							if ( FoundInCommaList($section,$GLOBALS{'frspersonstattype_sectionlist'}) ) {
								XTD();
								if ($GLOBALS{'frspersonstattype_values'} == "Numeric" ) {
									XINSELECTHASH(List2Hash("1,2,3,4,5,6,7,8,9,10,11,12"),"AddStatValue_".$GLOBALS{'frspersonstattype_code'},""); 
								}
								if ($GLOBALS{'frspersonstattype_values'} == "Checkbox" ) {
									XINCHECKBOXID("AddStatValue_".$GLOBALS{'frspersonstattype_code'},"AddStatValue_".$GLOBALS{'frspersonstattype_code'},Yes,"","");	
								}				
								X_TD();
							}
						}
					X_TR();
				X_TABLE();
				XBR();
				XINBUTTONID("AddStatSubmit","Add to Stats");
			X_TD();
		X_TR();
	X_TABLE();
	
	XBR();
	if ($GLOBALS{'frs_reportvalidation'} == "No") {$validationtext = "(Not yet published - unvalidated)"; }
	else {$validationtext = "(Published)"; }
	
	XH5("Match Report - $validationtext");
	XPTXT('Match Summary');
	XINTEXTAREA("frs_reportheadline",$GLOBALS{'frs_reportheadline'},"3","100");
	XPTXT('Full Match Report');
	XINTEXTAREAMCE("frs_report",$GLOBALS{'frs_report'},"20","100");
	XBR();

	XPTXT('Live Stream Video Code - eg M1_170319_1');
	XINTXT("frs_videostream",$GLOBALS{'frs_videostream'},"12","24");
	XPTXT('Video Notes');
	XINTEXTAREA("frs_videostreamcommentary",$GLOBALS{'frs_videostreamcommentary'},"3","100");
	
	XBR();XBR();
	XINCHECKBOXYESNO("frs_reportvalidation",$GLOBALS{'frs_reportvalidation'},"<b>Validation: </b>I confirm that this match report does not contain any derogatory remarks that would cause offence to club members, opponents or officials.
	Note: The report will not be published unless you have confirmed this.");
	
	XBR();XBR();
	
	XINSUBMIT("Update Match Results");
	X_FORM();
	
	XBR();
	XTABLEINVISIBLE();XTR();XTDFIXED("800");	
	XTXTID("TRACETEXT","");
	X_TD();X_TR();X_TABLE();	
	XBR();
	Go_Back_To_ResultsList;XBR();Go_Back_To_FSRU_Menu;
	
	$GLOBALS{'PersonSelectPopupParameters'} = array(
	 "other,person_domainid|person_id|person_sname|person_fname|person_section",
	 "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
	 "field,AddSearchPerson,Select,AddStatPersonId,AddStatPersonName,100",
	 "person_id",
	 "all",
	 "Stats Select,center,center,800,600",
	 "view",
	 "singlereplacelist"
	);

}

function Frs_FRSTEAMSELECTION_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";	
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup,frsselection";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Frs_FRSTEAMSELECTION_Output ($season, $section, $team_code, $frsid) {
	
	// ========== list coding ====================================
	// frs_playerselectedlist  bbra,Yes,Yes,Yes,Meet|gcho,Yes,Yes,No,Direct|bloc,Yes,Yes,Direct,Meet  .  personid,availabilitycode,selectedcode,notifiedcode,confirmedcode,travelcode
	// frs_officialselectedlist  bbra,Yes,Yes,Yes,Meet|gcho,Yes,Yes,No,Direct|bloc,Yes,Yes,Direct,Meet  .  personid,availabilitycode,selectedcode,notifiedcode,confirmedcode,travelcode	
	// availabilitycode = Y,N,Null
	// selectedcode = Y,N,Null
	// notifiedcode = Y,Null
	// confirmedcode = Y,N,Null
	// travelcode = M,D,Null
	
	// M2T=No      Input Field  Confirmation     Travel
	// =================================================                         
	// Email          Y            Y             Null
	// EMail          N            N             Null
	// SMS            Y            Y             Null           
	// SMS            N            N             Null           
	//
	// M2T=Yes     Input Field  Confirmation     Travel
	// =================================================                         
	// Email          M            Y             M
	// Email          D            Y             D	
	// EMail          N            N             Null
	// SMS            Y            Y             M           
	// SMS            M            Y             M         
	// SMS            D            Y             D	
	// SMS            N            N             Null	
	
	Get_Data('section', $season, $section);
	Get_Data('team', $season, $team_code);
	Get_Data('frs', $season, $team_code,$frsid);

	if ($GLOBALS{'section_sportid'} == "") { Get_Data("sport_".$GLOBALS{'domain_sportid'}); }
	else { Get_Data("sport_".$GLOBALS{'section_sportid'}); }
	$title = "Fixture and Team Selection (".$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}).")";
	$smstitle = $GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'});
	XH2($title);
	if ($GLOBALS{'currentYYYY-MM-DD'} > $GLOBALS{'frs_date'}) {
	    XTXTCOLOR("Please note that this fixture has already taken place.","red");
	}
	XH3ID("SelectionAlert","");
	XINHID("SMSTitle",$smstitle);
	XINHID("SMSHA",$GLOBALS{'frs_ha'});

	$helplink = "ResultsMaster/Mass_Result/mass_result"; Help_Link;

	XBR();
	XHR();	
	XH2('Fixture Details');	
	XFORM("frsteamselectionin.php","teamresults");
	XINSTDHID();
	XINHID("team_code",$team_code);
	XINHID("section_name",$section);
	XINHID("FrsId",$frsid);
	XINHID("TinyMCEUploadTo","FRS");
	XINHID("TinyMCEUploadId",$frsid);
	XINHID('currperiodid',$GLOBALS{'currperiodid'});

	XTABLE();
	if ($GLOBALS{'frs_ha'} == "H") {
		$xhash = Get_SelectArrays_Hash ("venue","venue_code","venue_name","venue_code","","" );
		XTR();XTDTXT("Home Venue");XTDINSELECTHASH($xhash,'frs_venue',$GLOBALS{'frs_venue'});X_TR();
		$frs_meettotravel = "No";
	}
	if ($GLOBALS{'frs_ha'} == "A") {
		XTR();XTDTXT("Away Venue");XTDINTXTID('frs_awayvenue','frs_awayvenue',$GLOBALS{'frs_awayvenue'},"30","60");X_TR();
		$frs_meettotravel = "Yes";
	}
	if ($GLOBALS{'frs_meettotravel'} != "") { $frs_meettotravel = $GLOBALS{'frs_meettotravel'}; }
	
	XTR();XTDTXT("Match Start Time eg 14:30");XTDINTXTID('frs_time','frs_time',$GLOBALS{'frs_time'},"6","12");X_TR();	
	XTR();XTDTXT("Match End Time");XTDINTXT('frs_timeend',$GLOBALS{'frs_timeend'},"6","12");X_TR();	
	XTR();XTDTXT("Meeting Arrangements<br>(Keep it short for SMS!)");XTDINTXTID("frs_meet","frs_meet",$GLOBALS{'frs_meet'},"60","80");X_TR();
	XTR();XTDTXT('Meet to Travel enabled.');XTDINCHECKBOXYESNOID('frs_meettotravel','frs_meettotravel',$frs_meettotravel,"Tick this if you have a prearranged travel meeting point. (Default for Away Matches)");X_TR();
	XTR();XTDTXT("Additional Information<br>(Shows on email only)");XTDINTEXTAREA("frs_meetextra",$GLOBALS{'frs_meetextra'},"5","100");X_TR();	
	XTR();XTDTXT("Match Cancelled");XTDINCHECKBOXYESNOID('frs_cancellation','frs_cancellation',$GLOBALS{'frs_cancellation'},"Shows game as cancelled on fixture list, and sets up cancellation emails and texts to send out");X_TR();	

	X_TABLE();
	XBR();
	XHR();
	XH2('Preview Generated Text Message');
	$tvenue_name = "";
	if ($GLOBALS{'frs_ha'} == "H") {
		Check_Data('venue',$GLOBALS{'frs_venue'});
		if ($GLOBALS{'IOWARNING'} == "0") {
			$tvenue_name = $GLOBALS{'venue_name'};
		}
		else { $tvenue_name = $GLOBALS{'frs_venue'};
		}
	} else {
		$tvenue_name = $GLOBALS{'frs_awayvenue'};
	}
	$smsalert = "";
	if ($GLOBALS{'frs_cancellation'} == "Yes" ) {
		$smsalert = "MATCH CANCELLED - ";
	}
	$smsmessage = $smsalert.$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' - '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'})." ";
	$smsmessage = $smsmessage.$tvenue_name." ";
	if ($GLOBALS{'frs_cancellation'} != "Yes" ) {
		$smsmessage = $smsmessage.$GLOBALS{'frs_time'}." Start ";	
		$smsmessage = $smsmessage.$GLOBALS{'frs_meet'};
		if ($frs_meettotravel == "Yes" ) {
			$smsmessage = $smsmessage." - Reply Y (Meet), D (Direct) or N";
		} else {
			$smsmessage = $smsmessage." - Reply Y or N";
		}
	}	
	$textremoved = "0";
	$extra = 0;
	$origmessagelength = strlen($smsmessage);
	if (strlen($smsmessage) > 155) {
		$textremoved = "1";
		$extra = strlen($smsmessage) - 155;
		$lengthmeet = strlen($GLOBALS{'frs_meet'}) - $extra;
		$frontmeet = substr($GLOBALS{'frs_meet'},0,$lengthmeet);
		$backmeet = substr($GLOBALS{'frs_meet'},$lengthmeet,$extra);
		$smsmessage = $smsalert.$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' - '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'})." ";
		$smsmessage = $smsmessage.$tvenue_name." ";
		$smsmessage = $smsmessage.$GLOBALS{'frs_time'}." Start ";
		if ($GLOBALS{'frs_cancellation'} != "Yes" ) {		
			$smsmessage = $smsmessage.$frontmeet.'<span style="color:red">'.$backmeet.'</span>';
			if ($frs_meettotravel == "Yes" ) {
				$smsmessage = $smsmessage." - Reply Y (Meet), D (Direct) or N";
			} else {
				$smsmessage = $smsmessage." - Reply Y or N";
			}
		}
	}
	$reducedmessagelength = $origmessagelength - $extra;
	if ( $textremoved == "1" ) {
		 $smscountmessage = '<span style="color:red">Text message exceeds max 155. If you take no action, size will be reduced from '.$origmessagelength.' to '.$reducedmessagelength.' by removing red characters</span>';
		 $smscountmessage = $smscountmessage.YBR();
		 if ($GLOBALS{'frs_ha'} == "A") {		 
		 	$smscountmessage = $smscountmessage.'<span style="color:red">Suggest you shorten Meeting Arrangements or Away Venue to fit.</span>';
		 } else {
		 	$smscountmessage = $smscountmessage.'<span style="color:red">Suggest you shorten Meeting Arrangements to fit.</span>';
		 }
		 XTXTID("smscount",$smscountmessage);
	} else {
		 XTXTID("smscount",'<span style="color:green">Text message '.$origmessagelength.' characters. (MAX is 155).</span>');
	}
	XBR();
	XTABLE();
	XTR();XTDFIXED("600");XTXTID("smsview",$smsmessage);X_TD();X_TR();
	X_TABLE();
	
	XHR();

	if ($GLOBALS{'frs_selectiondraft'} == "Yes") {
		XH2('Selection - <span style="color:red"><b>Draft (Not yet published)</b></span>');
	}
		else { XH2('Selection');
	}	

	XH3($GLOBALS{'sport_officialsname'});
	
	$officialcount = 0;
	$selectedofficiala = GetSelectionListPersonIds ('frs_officialselectedlist',"all","");
	foreach ($selectedofficiala as $selectedofficialid)  {
		$officialcount++;
	}
	
	if ( $officialcount > 0 ) {
		XTABLE();
		XTR();XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Age");XTDHTXT("Email");XTDHTXT("Mobile");XTDHTXT("Planned");
		XTDHTXT("Available");XTDHTXT("Selected");XTDHTXT("Notified");XTDHTXT("Confirmed");XTDHTXT("Travel");X_TR();
		$selectedofficiala = GetSelectionListPersonIds('frs_officialselectedlist',"selected","Y");
		foreach ($selectedofficiala as $selectedofficialid) {
			$personid = $selectedofficialid;
			Check_Data('person',$personid);
			if ($GLOBALS{'IOWARNING'} == "0") {
				XTR();XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
				$underage = UnderAge(18,$GLOBALS{'person_dob'});
				if ($underage) {
					XTDTXT(Age($GLOBALS{'person_dob'},19));
				}
				else { XTDTXT("");
				}
				XTDTXT(Chosen_Person_Email());
				XTDTXT(Chosen_Person_SMS());
				XTDTXT(SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'planned')));
				XTDTXT(SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'availability')));
				XTDINCHECKBOXYN('official_'.$personid,GetSelectionList('frs_officialselectedlist',$personid,'selected'),"");
				if ( SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'notified')) == "Yes" ) {
					$link = YPGMLINK("notificationlogout.php");
					$link = $link.YPGMSTDPARMS().YPGMPARM("NotificationType","TeamSelection").YPGMPARM("NotificationEventId",$frsid).YPGMPARM("NotificationPersonId",$personid);
					XTDLINKTXTNEWWINDOW($link,"Yes","Notifications");
				} else {
					XTDTXT("");
				}
				XTD();
				$confirmedtxt = SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'confirmed'));
				if (($confirmedtxt != "Yes" )&&($confirmedtxt != "No" )&&($confirmedtxt != "???" )) {
					XTXT("");
				} else {
					$txtcolor = "black";
					if ($confirmedtxt == "Yes" ) { $txtcolor = "green"; }
					if ($confirmedtxt == "No" ) { $txtcolor = "red"; }
					if ($confirmedtxt == "???" ) { $txtcolor = "orange"; }
					$link = YPGMLINK("notificationlogout.php");
					$link = $link.YPGMSTDPARMS().YPGMPARM("NotificationType","TeamSelection").YPGMPARM("NotificationEventId",$frsid).YPGMPARM("NotificationPersonId",$personid);
					XLINKTXTCOLORNEWWINDOW($link,$confirmedtxt,$txtcolor,"Notifications");
				}
				X_TD();
				$traveltxt = SelectionTitle(GetSelectionList('frs_officialselectedlist',$personid,'travel'));					
				if ($frs_meettotravel == "Yes" ) {
					XTDTXT($traveltxt);
				} else {
					XTDTXT("");
				}			
			}
		}	
		X_TABLE();	
	
	}
	
	XH4("Select Additional ".$GLOBALS{'sport_officialsname'});
	$extraofficialselectedlist = ""; $sep = "";
	XINHID("extraofficialselectedlist",$extraofficialselectedlist);
	XTABLEID("extraofficialselectedtable");
	XTR();XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Age");XTDHTXT("EMail");XTDHTXT("Mobile");XTDHTXT("");X_TR();
	X_TABLE();
	XTABLE();
	XINBUTTONIDSPECIAL("SelectOfficialButton","info","Select ".$GLOBALS{'sport_officialsname'});X_TD();X_TR();	
	X_TABLE();
	
	XBR();XBR();
	XH3('Team Selection');
	XTABLE();
	XTR();XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Age");XTDHTXT("Email");XTDHTXT("Mobile");XTDHTXT("Preferred Position");XTDHTXT("ShirtNo");XTDHTXT("");
	XTDHTXT("Planned");XTDHTXT("Available");XTDHTXT("Selected");XTDHTXT("Notified");XTDHTXT("Confirmed");XTDHTXT("Travel");X_TR();	

	$sortarray = Array();
	$squada = explode(',',$GLOBALS{'team_squadlist'});
	$tidyupa = Array();
	$selectedplayera = GetSelectionListPersonIds ('frs_playerselectedlist',"all","");
	$totalplayera = array_unique ( array_merge ($squada, $selectedplayera) );
	foreach ($totalplayera as $personid)  {
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {	
			if ( SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'selected')) == "Yes" ) { $selectedsortcode = "1"; } 
			else { $selectedsortcode = "2"; }
			$record =  $selectedsortcode."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid;
			array_push($sortarray, $record);
		}
	}
	sort($sortarray);	
	
	$lastcode = "9";
	foreach ($sortarray as $record)  {
		$bitsa = explode('|',$record);
		if (($bitsa[0] != $lastcode) && ($lastcode != "9")) { 
		    XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");
		    XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
		}
		$lastcode = $bitsa[0];
		$personid = $bitsa[3];	
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {      		    
    	   $tidyup = "0";	    
    	   if (!in_array($personid, $squada)) {
    	       if ( GetSelectionList('frs_playerselectedlist',$personid,'selected') != "Y" ) {
    	           $tidyup = "1";
    	           // XPTXTCOLOR($personid." not is squad - or selected","red");
    	           array_push($tidyupa, $personid);
    	       }
    	   }
    	   if ($tidyup == "0") {
    			XTR();XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
    			$underage = UnderAge(18,$GLOBALS{'person_dob'});
    			if ($underage) { XTDTXT(Age($GLOBALS{'person_dob'},19)); }
    			else { XTDTXT(""); }
    			XTDTXT(Chosen_Person_Email());
    			XTDTXT(Chosen_Person_SMS());
    			XTDTXT($GLOBALS{'person_position'});
    			XTDTXT($GLOBALS{'person_shirtnumber'});
    			if (in_array($personid, $squada)) { XTDTXT('Squad'); }
    			else { XTDTXT('NonSquad'); }			
    			XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'planned')));
    			XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'availability')));
    			XTDINCHECKBOXYN('player_'.$personid,GetSelectionList('frs_playerselectedlist',$personid,'selected'),"");
    			if ( SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'notified')) == "Yes" ) {
    				$link = YPGMLINK("notificationlogout.php");
    				$link = $link.YPGMSTDPARMS().YPGMPARM("NotificationType","TeamSelection").YPGMPARM("NotificationEventId",$frsid).YPGMPARM("NotificationPersonId",$personid);			
    				XTDLINKTXTNEWWINDOW($link,"Yes","Notifications");
    			} else {
    				XTDTXT("");
    			}
    			XTD();
    			$confirmedtxt = SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'confirmed'));
    			if (($confirmedtxt != "Yes" )&&($confirmedtxt != "No" )&&($confirmedtxt != "???" )) {
    				XTXT("");
    			} else {
    				$txtcolor = "black";
    				if ($confirmedtxt == "Yes" ) { $txtcolor = "green"; }
    				if ($confirmedtxt == "No" ) { $txtcolor = "red"; }
    				if ($confirmedtxt == "???" ) { $txtcolor = "orange"; }
    				$link = YPGMLINK("notificationlogout.php");
    				$link = $link.YPGMSTDPARMS().YPGMPARM("NotificationType","TeamSelection").YPGMPARM("NotificationEventId",$frsid).YPGMPARM("NotificationPersonId",$personid);
    				XLINKTXTCOLORNEWWINDOW($link,$confirmedtxt,$txtcolor,"Notifications");;
    			}	
    			X_TD();
    			$traveltxt = SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'travel'));
    			if ($frs_meettotravel == "Yes" ) {
    				XTDTXT($traveltxt);
    			} else {
    				XTDTXT("");
    			}
            }
		}	
	}
	X_TABLE();


	XH4("Select Additional Non Squad Players");
	$extranonsquadselectedlist = ""; $sep = "";	
	XINHID("extranonsquadselectedlist",$extranonsquadselectedlist);
	XTABLEID("extranonsquadselectedtable");
	XTR();XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Age");XTDHTXT("EMail");XTDHTXT("Mobile");XTDHTXT("");X_TR();
	X_TABLE();
	XTABLE();
	XINBUTTONIDSPECIAL("SelectPlayerButton","info","Select a Non Squad Player");X_TD();X_TR();
	X_TABLE();
	XBR();
	XINCHECKBOXYESNO("frs_selectiondraft",$GLOBALS{'frs_selectiondraft'},"Keep as draft only - Dont publish yet");XBR();
	XBR();
	XHR();
	XBR();
	XTABLEINVISIBLE();XTR();
	XTD();XINSUBMITID("SubmitButton","Update Match Arrangements and Selection");X_TD();
	XTDIMGFLEX($GLOBALS{'site_asseturl'}."/SaveReminder.png");
	X_TR();X_TABLE();
	X_FORM();	
	XHR();
	$section_name = GetSectionFromTeamCode($team_code);
	Get_Data('section',$GLOBALS{'currperiodid'},$section_name);
	if ($GLOBALS{'section_showdateavailability'} == "Yes") {
		XH3("View existing team selections and available players across ".$section_name." section.");	
		$link = YPGMLINK("frsselectionsummaryout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("Section",$section_name).YPGMPARMDATE ("SelectionDate",$GLOBALS{'frs_date'});
		XTD();XLINKIMGNEWWINDOW($link,$GLOBALS{'site_asseturl'}."/CLUBAVAILABILITY.png","ClubAvailability","100","100","");X_TD();
	}
	$GLOBALS{'PersonSelectPopupParameters'} = array(
		 "this,person_id|person_sname|person_fname|person_section|person_email1|person_mobiletel|person_type|person_paiddate|person_dob|person_position",
		 "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90|person_position,Position,90",
		 "rows,SelectPlayerButton,SelectPlayer,extranonsquadselectedlist(addto),extranonsquadselectedtable(person_fname+person_sname+person_dob[AgeFilter=18]+person_email1+person_mobiletel+remove),120|rows,SelectOfficialButton,SelectUmpire,extraofficialselectedlist(addto),extraofficialselectedtable(person_fname+person_sname+person_dob[AgeFilter=18]+person_email1+person_mobiletel+remove),120",
		 "person_id",
		 "active",
		 "TeamSelection,center,center,800,600",
		 "view",
		 "singleaddtolist"
	);
		
	if (!empty($tidyupa)) {	    
	    foreach ($tidyupa as $personid)  { 
	        if ($GLOBALS{'LOGIN_person_id'} == "bbra") {
                XPTXTCOLOR($personid." removed","red");
	        }
            DeleteFromSelectionList('frs_playerselectedlist',$nonselectedplayerid);
	    }
	    if ($GLOBALS{'LOGIN_person_id'} == "bbra") {
            XPTXT("REWRITE ".$season." ".$team_code." ".$frsid);
        }    
        // Write_Data('frs', $season, $team_code,$frsid);
	}
}

function Frs_FRSRECALCULATESTATS_Output ($tseason) {
	Frs_FRSRECALCULATEPERSONSTATS_Output ($tseason);	
	Frs_FRSRECALCULATETEAMSTATS_Output ($tseason);	
}

function Frs_FRSRECALCULATEPERSONSTATS_Output ($tseason) {
	XPTXT("Recalculated Person Stats for - ".$tseason);
	
	DeleteAll_Data('frspersonstat',$tseason);
	foreach (Get_Array("section",$GLOBALS{'currperiodid'}) as $section_name) {	
		Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
		$teama = List2Array($GLOBALS{'section_teams'});
		# XH5($GLOBALS{'section_teams'});
		foreach ($teama as $teamcode) {
			$frsa = Get_Array('frs',$tseason,$teamcode);
			foreach ($frsa as $frsid) {
				Get_Data('frs',$tseason,$teamcode,$frsid);				
				$playera = GetSelectionListPersonIds ('frs_playerselectedlist',"confirmed","Y");
				foreach ($playera as $playerid) {
				    Check_Data('frspersonstat',$GLOBALS{'currperiodid'},$section_name."-Appearance",$playerid);
    				if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data('frspersonstat'); }    				
    				if ( $GLOBALS{'frs_result'} != "" ) {
        				$GLOBALS{'frspersonstat_quantity'}++;
        				if ( $GLOBALS{'frs_result'} == "Won" ) { $GLOBALS{'frspersonstat_teamwon'}++; }
        				if ( $GLOBALS{'frs_result'} == "Drew" ) {$GLOBALS{'frspersonstat_teamdrew'}++;}
        				if ( $GLOBALS{'frs_result'} == "Lost" ) {$GLOBALS{'frspersonstat_teamlost'}++;}
        				$GLOBALS{'frspersonstat_teamgf'} = $GLOBALS{'frspersonstat_teamgf'} + $GLOBALS{'frs_gf'};
        				$GLOBALS{'frspersonstat_teamga'} = $GLOBALS{'frspersonstat_teamga'} + $GLOBALS{'frs_ga'};
        				Write_Data('frspersonstat',$GLOBALS{'currperiodid'},$section_name."-Appearance",$playerid);
        				if ($GLOBALS{'LOGIN_person_id'} == "bbra") {
        				    XPTXT($frsid." ".$section_name."-Appearance"." ".$playerid);
        				}    
    				}
				}
				
				# XPTXT($frsid." ".$GLOBALS{'frs_statslist'});				
				if ($GLOBALS{'frs_statslist'} != "") {		
					$statsa = explode('|',$GLOBALS{'frs_statslist'});
					foreach ($statsa as $stat) {
						# bbra,G,2
						$statbits = explode(',',$stat);
						Check_Data('frspersonstat',$tseason,$section_name."-".$statbits[1],$statbits[0]);
						if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data('frspersonstat'); }						
						Check_Data("frspersonstattype",$GLOBALS{'currperiodid'},$statbits[1]);
						if ($GLOBALS{'IOWARNING'} == "0") {
							if ($GLOBALS{'frspersonstattype_values'} == "Numeric" ) {
								$GLOBALS{'frspersonstat_quantity'} = $GLOBALS{'frspersonstat_quantity'} + $statbits[2];
							}
							if ($GLOBALS{'frspersonstattype_values'} == "Checkbox" ) {
								$GLOBALS{'frspersonstat_quantity'} = $GLOBALS{'frspersonstat_quantity'} + 1;
							}
							if ($GLOBALS{'LOGIN_person_id'} == "bbra") {
								XBR();XTXT($tseason." ".$section_name." ".$statbits[1]." ".$statbits[0]." ".$statbits[2]." ".$GLOBALS{'frspersonstat_quantity'}." - Updated");
							}
							Write_Data('frspersonstat',$tseason,$section_name."-".$statbits[1],$statbits[0]);
						}
					}
				}	
			}
		}
		
	}
}

function Frs_FRSRECALCULATETEAMSTATS_Output ($tseason) {
	XPTXT("Recalculated Team Stats for - ".$tseason);

	DeleteAll_Data('frsteamstat',$tseason);
	$rawstatsa = Array();
	$teama = Get_Array('team',$tseason);
	foreach ($teama as $teamcode) {
		$frsa = Get_Array('frs',$tseason,$teamcode);
		foreach ($frsa as $frsid) {
			Get_Data('frs',$tseason,$teamcode,$frsid);
			# XPTXT($frsid." ".$GLOBALS{'frs_statslist'});
			Check_Data('frsteamstat',$tseason,$teamcode);
			if ($GLOBALS{'IOWARNING'} == "1") {	Initialise_Data('frsteamstat');	}
			if ( $GLOBALS{'frs_result'} != "" ) {$GLOBALS{'frsteamstat_played'}++; }
			if ( $GLOBALS{'frs_result'} == "Won" ) {$GLOBALS{'frsteamstat_won'}++;}
			if ( $GLOBALS{'frs_result'} == "Drew" ) {$GLOBALS{'frsteamstat_drew'}++;}		
			if ( $GLOBALS{'frs_result'} == "Lost" ) {$GLOBALS{'frsteamstat_lost'}++;}		
			$GLOBALS{'frsteamstat_gf'} = $GLOBALS{'frsteamstat_gf'} + $GLOBALS{'frs_gf'};
			$GLOBALS{'frsteamstat_ga'} = $GLOBALS{'frsteamstat_ga'} + $GLOBALS{'frs_ga'};			
			# if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XBR();XTXT($tseason." ".$teamcode." - Updated"); }
			Write_Data('frsteamstat',$tseason,$teamcode);			
		}
	}
}

function UpdateSelectionList($listfieldname,$personid,$parametername,$parametervalue) {
# XH5($listfieldname." ".$personid." ".$parametername." ".$parametervalue);	
# XH5("INPUT = ".$GLOBALS{$listfieldname});	
// Format:  personid,planned,availability,selected,notified,confirmed,travel|personid,planned,availability,selected,notified,confirmed,travel	
$list = $GLOBALS{$listfieldname};
$listh = Array();

# XH5('existinglist '.$list);
if ($list != "") {
	$lista = explode('|',$list);
	foreach ($lista as $listelement) {
		if ($listelement != "") {
			$listbits = explode(',',$listelement);
			$listh[$listbits[0]] = $listelement;
		}
	}
}
if (array_key_exists($personid, $listh)) {
	$listbits = explode(',',$listh[$personid]);
	$uplannedcode = $listbits[1];	 
	$uavailabilitycode = $listbits[2];
	$uselectedcode = $listbits[3];
	$unotifiedcode = $listbits[4];
	$uconfirmedcode = $listbits[5];
	$utravelcode = $listbits[6];
} else {
	$uplannedcode = "";
	$uavailabilitycode = "";	
	$uselectedcode = "";
	$unotifiedcode = "";
	$uconfirmedcode = "";
	$utravelcode = "";
}
if ( $parametername == "planned" ) { $uplannedcode = $parametervalue; }
if ( $parametername == "availability" ) { $uavailabilitycode = $parametervalue; }
if ( $parametername == "selected" ) { $uselectedcode = $parametervalue; }
if ( $parametername == "notified" ) { $unotifiedcode = $parametervalue; }
if ( $parametername == "confirmed" ) { $uconfirmedcode = $parametervalue; }
if ( $parametername == "travel" ) { $utravelcode = $parametervalue; }
$listh[$personid] = $personid.",".$uplannedcode.",".$uavailabilitycode.",".$uselectedcode.",".$unotifiedcode.",".$uconfirmedcode.",".$utravelcode;
# XH5("listh[$personid] = ".$listh[$personid]);		
		
$updatedlist = ""; $sep = "";
foreach ($listh as $key => $value) { $updatedlist = $updatedlist.$sep.$value; $sep = "|";}
# XH5("OUTPUT = ".$updatedlist);
$GLOBALS{$listfieldname} = $updatedlist;
}

function GetSelectionList ($listfieldname,$personid,$parametername) {
// parameter = planned,availability,selected,notified,confirmed,travel
$parametervalue	= "";
if ($GLOBALS{$listfieldname} != "") {
	$lista = explode('|',$GLOBALS{$listfieldname});
	foreach ($lista as $listelement) {
		if ($listelement != "") {
			$listbits = explode(',',$listelement);
			if ($listbits[0] == $personid) {
				if ( $parametername == "planned" ) { $parametervalue = $listbits[1]; }				
				if ( $parametername == "availability" ) { $parametervalue = $listbits[2]; }
				if ( $parametername == "selected" ) { $parametervalue = $listbits[3]; }		
				if ( $parametername == "notified" ) { $parametervalue = $listbits[4]; }
				if ( $parametername == "confirmed" ) { $parametervalue = $listbits[5]; }
				if ( $parametername == "travel" ) { $parametervalue = $listbits[6]; }
			}
		}				
	}
}
return $parametervalue;
}

function DeleteFromSelectionList($listfieldname,$personid) {
	# XH5($listfieldname." ".$personid." ".$parametername." ".$parametervalue);
	# XH5("INPUT = ".$GLOBALS{$listfieldname});
	$list = $GLOBALS{$listfieldname};
	$listh = Array();
	
	# XH5('existinglist '.$list);
	if ($list != "") {
		$lista = explode('|',$list);
		foreach ($lista as $listelement) {
			if ($listelement != "") {
				$listbits = explode(',',$listelement);
				$listh[$listbits[0]] = $listelement;
			}
		}
	}
	if (array_key_exists($personid, $listh)) {
		unset($listh[$personid]);
	} 
	$updatedlist = ""; $sep = "";
	foreach ($listh as $key => $value) {
		$updatedlist = $updatedlist.$sep.$value; $sep = "|";
	}
	# XH5("OUTPUT = ".$updatedlist);
	$GLOBALS{$listfieldname} = $updatedlist;
}


function GetSelectionListPersonIds ($listfieldname,$parametername,$parametervalue) {
	// parameter = planned,availability,selected,notified,confirmed,travel
	$personida	= Array();
	if ($GLOBALS{$listfieldname} != "") {
		$lista = explode('|',$GLOBALS{$listfieldname});
		foreach ($lista as $listelement) {
			if ($listelement != "") {
				$listbits = explode(',',$listelement);
				if ( $parametername == "planned" ) {
					if ( $parametervalue == $listbits[1] ) { array_push($personida, $listbits[0]) ;}
				}
				if ( $parametername == "availability" ) {
					if ( $parametervalue == $listbits[2] ) { array_push($personida, $listbits[0]) ;}
				}
				if ( $parametername == "selected" ) {
					if ( $parametervalue == $listbits[3] ) { array_push($personida, $listbits[0]) ;}
				}
				if ( $parametername == "notified" ) {
					if ( $parametervalue == $listbits[4] ) { array_push($personida, $listbits[0]) ;}
				}
				if ( $parametername == "confirmed" ) {
					if ( $parametervalue == $listbits[5] ) { array_push($personida, $listbits[0]) ;}
				}
				if ( $parametername == "travel" ) {
					if ( $parametervalue == $listbits[6] ) { array_push($personida, $listbits[0]) ;}
				}
				if ( $parametername == "all" ) {
					array_push($personida, $listbits[0]);
				}
			}
		}
	}
	return $personida;
}

function UpdateDateAvailabilityList($listfieldname,$date,$availability,$comment) {
	// XH5($listfieldname."|".$date."|".$availability."|".$comment);
	// XH5("INPUT = ".$GLOBALS{$listfieldname});
	// Format:  date|availability|comment^date|availability|comment^date|availability|comment
	$list = $GLOBALS{$listfieldname};
	$listh = Array();
	# XH5('existinglist '.$list);
	if ($list != "") {
		$lista = explode('^',$list);
		foreach ($lista as $listelement) {
			if ($listelement != "") {
				$listbits = explode('|',$listelement);
				$listh[$listbits[0]] = $listelement;
			}
		}
	}	
	$listh[$date] = $date."|".$availability."|".$comment;
	# XH5("listh[$personid] = ".$listh[$personid]);
	
	$updatedlist = ""; $sep = "";
	foreach ($listh as $key => $value) {
		$updatedlist = $updatedlist.$sep.$value; $sep = "^";
	}
	// XH5("OUTPUT = ".$updatedlist);
	$GLOBALS{$listfieldname} = $updatedlist;
}

function GetDateAvailability ($listfieldname,$date) {
	// return availability[0],comment[1]
	$availabilitya = Array();
	if ($GLOBALS{$listfieldname} != "") {
		$lista = explode('^',$GLOBALS{$listfieldname});
		foreach ($lista as $listelement) {
			if ($listelement != "") {
				$listbits = explode('|',$listelement);
				if ($listbits[0] == $date) {
					$availabilitya[0] = $listbits[1];
					$availabilitya[1] = $listbits[2];
				}
			}
		}
	}
	// XH5($date." ".$availabilitya[0]." ".$availabilitya[1]);
	return $availabilitya;
}



function SelectionTitle ($code) {
	$title = "";
	if ( $code == "Y" ) { $title = "Yes"; }				
	if ( $code == "N" ) { $title = "No"; }
	if ( $code == "M" ) { $title = "Meet"; }		
	if ( $code == "D" ) { $title = "Direct"; }
	if ( $code == "?" ) { $title = "???"; }	
	return $title;	
}

function Frs_FRSSQUADEMAILSMS_Output ($season, $team_code) {
	Get_Data('team', $season, $team_code);
	XH1("Team Communication - ".$GLOBALS{'team_name'});
	$helplink = "ResultsMaster/Mass_Result/mass_result"; Help_Link;

	if ($GLOBALS{'team_squadlist'} != "") {
		$squada = explode(',',$GLOBALS{'team_squadlist'});
		$sortarray = Array();
		foreach ($squada as $personid)  {
			Check_Data('person',$personid);
			if ($GLOBALS{'IOWARNING'} == "0") {
				$record =  "1"."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid;
				array_push($sortarray, $record);
			}
		}
		if ($GLOBALS{'team_coach'} != "") {
			$splitstra = List2Array($GLOBALS{'team_coach'});
			foreach ($splitstra as $personid)  {
				Check_Data('person',$personid);
				if ($GLOBALS{'IOWARNING'} == "0") {
					$record =  "0"."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid;
					array_unshift($sortarray, $record);
				}
			}
		}
		if ($GLOBALS{'team_mgr'} != "") {
			$splitstra = List2Array($GLOBALS{'team_mgr'});
			foreach ($splitstra as $personid)  {
				Check_Data('person',$personid);
				if ($GLOBALS{'IOWARNING'} == "0") {
					$record =  "0"."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid;
					array_unshift($sortarray, $record);
				}
			}
		}
		
		sort($sortarray);
		
		XFORM("frssquademailsmsin.php","ConfirmActionForm");
		XINSTDHID();
		XINHID("team_code",$team_code);
		XINHID("ConfirmActionText","This will generate SMS and EMails. Do you wish to continue");
		XINHID("ConfirmActionStatus","No");
		XINHID("Purpose","Communication");
		XHR();
		XH2("Step 1: Compose Messages");
		XPTXT("Enter either an SMS Text Message or an Email Message - or Both");		
		XH3("SMS Message");
		XTABLE();XTR();
		XTDTXTWIDTH("Max 160 Characters","100");
		XTDINTEXTAREA("SMSMessage","","2","80");
		X_TR();X_TABLE();
		XH3("Email Message");
		XTABLE();XTR();
		XTDTXTWIDTH("Subject","100");XTDINTXT("EmailSubject","","100","80");		
		X_TR();XTR();
		XTDTXTWIDTH("Message","100");XTDINTEXTAREA("EmailMessage","","10","80");		
		X_TR();X_TABLE();
		XBR();
		XHR();
		XH2("Step 2: Select Distribution");
		XTABLE();
		XTR();XTDHTXT("Id");XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Email");XTDHTXT("Mobile");XTDHTXT("Send To");X_TR();
		$firstnonselected = "0";
		foreach ($sortarray as $record)  {
			$bitsa = explode('|',$record);
			if (($bitsa[0] == "1") && ($firstnonselected == "0")) {
				$firstnonselected = "1";
				XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
			}
			$personid = $bitsa[3];
			Get_Data('person',$personid);
			XTR();XTDTXT($personid);XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
			if (ValidEmail(Chosen_Person_Email())) { XTDTXT(Chosen_Person_Email()); }
			else { XTDTXTRED(Chosen_Person_Email()); }
			if (ValidMobile(Chosen_Person_SMS())) { XTDTXT(Chosen_Person_SMS()); }
			else { XTDTXTRED(Chosen_Person_SMS()); }	
			XTDINCHECKBOXYESNO('sendto_'.$personid,"No","");
			X_TR();
		}
		X_TABLE();
		XBR();XBR();
		XINCHECKBOXCONFIRMACTION("Test","No","Preview Mode - Allows Email/SMS messages to be checked before sending");XBR();
		XBR();
		XINSUBMITID("ConfirmActionSubmit","Send out Emails/SMSs");
		X_FORM();
	} else {
		XH2("No Squad defined for this team");		
	}
}

function Frs_FRSSQUADAVAILABILITYREMINDER_Output ($season, $team_code ) {
    Get_Data('team', $season, $team_code);
    XH1("Availability Reminder - ".$GLOBALS{'team_name'});

    $nonavailabilitycounta = Array();
    $squada = explode(',',$GLOBALS{'team_squadlist'});
    $sortarray = Array();
    foreach ($squada as $personid)  { 
        Check_Data('person',$personid);
        if ($GLOBALS{'IOWARNING'} == "0") {
            $nonavailabilitycounta[$personid] = 0;
            $record =  "1"."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid;
            array_push($sortarray, $record);
        }
    }
    
    if ($GLOBALS{'team_squadlist'} != "") {
        $frs_ida = Get_Array("frs",$GLOBALS{'currperiodid'},$team_code);
        foreach ($frs_ida as $frs_id) {  
            Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
            $formteam_code = $team_code;
            $formfrs_id = $frs_id;
            if ($GLOBALS{'currentYYYY-MM-DD'} <= $GLOBALS{'frs_date'}) {
                foreach ($squada as $personid) {
                    Check_Data('person',$personid);
                    if ($GLOBALS{'IOWARNING'} == "0") {
                        $currentavailability = GetSelectionList('frs_playerselectedlist',$personid,'availability');                       
                        if ($currentavailability == "") { $nonavailabilitycounta[$personid]++; }
                    }
                }
            }
        }

        sort($sortarray);
        
        XFORM("frssquademailsmsin.php","ConfirmActionForm");
        XINSTDHID();
        XINHID("team_code",$team_code);
        XINHID("ConfirmActionText","This will generate EMails. Do you wish to continue");
        XINHID("ConfirmActionStatus","No");
        XINHID("Purpose","AvailabilityReminder");
        XHR();
        XH2("Step 1: Review Suggested Email");  
        XTABLE();XTR();
        XTDTXTWIDTH("Subject","100");XTDINTXT("EmailSubject","Match Availability","100","80");
        X_TR();XTR();
        $message = 'It appears that you have not yet entered your availability for some forthcoming matches.'."\n"."\n".'Please sign into the club website to do this, or click the My Availability icon at the bottom of this email..'."\n"."\n".'Thank You';       
        XTDTXTWIDTH("Message","100");XTDINTEXTAREA("EmailMessage",$message,"10","80");
        X_TR();X_TABLE();     
        XBR();
        XHR();
        XH2("Step 2: Review Distribution");
        XTABLE();
        XTR();XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Email");XTDHTXT("Outstanding");XTDHTXT("Send To");X_TR();
        foreach ($sortarray as $record)  {
            $bitsa = explode('|',$record);
            $personid = $bitsa[3];
            Get_Data('person',$personid);
            XTR();XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
            if (ValidEmail(Chosen_Person_Email())) { XTDTXT(Chosen_Person_Email()); }
            else { XTDTXTRED(Chosen_Person_Email()); }
            XTDTXT($nonavailabilitycounta[$personid]);
            if ( $nonavailabilitycounta[$personid] > 0 ) { XTDINCHECKBOXYESNO('sendto_'.$personid,"Yes",""); }
            else { XTDINCHECKBOXYESNO('sendto_'.$personid,"No",""); }
            X_TR();
        }
        X_TABLE();
        XBR();XBR();
        XINCHECKBOXCONFIRMACTION("Test","No","Preview Mode - Allows Email/SMS messages to be checked before sending");XBR();
        XBR();
        XINSUBMITID("ConfirmActionSubmit","Send out Emails/SMSs");
        X_FORM();
    } else {
        XH2("No Squad defined for this team");
    }
}

function Frs_WEBSTYLE_Output() {
	print "<style>\n";
	print ".eaclass {\n";
	print "	border-radius: 25px;\n";
	print "	border: 2px solid #cccccc;\n";
	print "	padding: 30px;\n";
	print "	width: 90%;\n";
	print "	-webkit-box-shadow: 3px 3px 5px 5px #eee;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */\n";
	print "	-moz-box-shadow:    3px 3px 5px 5px #eee;  /* Firefox 3.5 - 3.6 */\n";
	print "	box-shadow:         3px 3px 5px 5px #eee;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */\n";
	print "</style>\n";
}

function Frs_FBSTYLE_Output() {
	print "<style>\n";
	print ".eaclass {\n";
	print "	border-radius: 25px;\n";
	print "	border: 2px solid #cccccc;\n";
	print "	padding: 5%;\n";
	print "	width: 90%;\n";
	print "	-webkit-box-shadow: 3px 3px 5px 5px #eee;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */\n";
	print "	-moz-box-shadow:    3px 3px 5px 5px #eee;  /* Firefox 3.5 - 3.6 */\n";
	print "	box-shadow:         3px 3px 5px 5px #eee;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */\n";
	print "</style>\n";
}

function Frs_FRSTEAMRESULTDISPLAY_CSSJS () {
    $GLOBALS{'EXTERNALJSOPTIONAL'} = "//player.wowza.com/player/latest/wowzaplayer.min.js"; 
    $GLOBALS{'SITEJSOPTIONAL'} = "frsteamresultdisplay"; 
}

function Frs_FRSTEAMRESULTDISPLAY_Output ($season, $team_code, $frs_id) {
	Get_Data("team",$season,$team_code);
	Get_Data("frs",$season,$team_code,$frs_id);
	XBR();
	XDIV($frs_id,"eaclass" );
	if ( $GLOBALS{'team_photo'} != "" ) {
		XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'team_photo'},"100%");XBR();XBR();
	}
	XH1(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'})." : ".$GLOBALS{'team_name'}." vs ".$GLOBALS{'frs_oppo'});
	if ($GLOBALS{'frs_ha'} == "H") {
		Check_Data('venue',$GLOBALS{'frs_venue'}); 
		if ($GLOBALS{'IOWARNING'} == "0" ) { XH3("Home - ".$GLOBALS{'venue_name'}); }
		else { XH3("Home - ".$GLOBALS{'frs_awayvenue'}); }
	}
	if ($GLOBALS{'frs_ha'} == "A") { 
		XH3("Away - ".$GLOBALS{'frs_awayvenue'}); 
	}
	if ($GLOBALS{'frs_lcf'} == "L") { XH3("League"); }
	if ($GLOBALS{'frs_lcf'} == "C") { XH3("Cup"); }	
	if ($GLOBALS{'frs_lcf'} == "F") { XH3("Friendly"); }
	
	XH3($GLOBALS{'frs_result'}." ".$GLOBALS{'frs_gf'}." - ".$GLOBALS{'frs_ga'});
	XH4($GLOBALS{'frs_reportheadline'});
	if ($GLOBALS{'frs_reportphotofilename'} != "") { 
	  XIMGFLEX($GLOBALS{'domainwwwurl'}."/domain_frs/".$GLOBALS{'frs_reportphotofilename'});XBR(); 
	  XTXT($GLOBALS{'frs_reportphotocaption'});XBR();XBR(); 
	}
	XPTXT($GLOBALS{'frs_report'});
	

	if ($GLOBALS{'frs_statslist'} != "") {
		
		$statsa = explode('|',$GLOBALS{'frs_statslist'});
		$stattypea = Get_Array("frspersonstattype",$season);
		foreach ($stattypea as $stattype) {
			Get_Data("frspersonstattype",$season,$stattype);
			$stattypecount = 0;
			foreach ($statsa as $stat) {	
				# bbra,G,2
				$statbits = explode(',',$stat);
				if ( $statbits[1] == $stattype ) { $stattypecount++; }
			}
			if ( $stattypecount > 0 ) {
				XH3( $GLOBALS{'frspersonstattype_name'} );
				foreach ($statsa as $stat) {
					# bbra,G,2
					$statbits = explode(',',$stat);
					if ( $statbits[1] == $stattype ) {
						Check_Data("person",$statbits[0]);
						if ($GLOBALS{'IOWARNING'} == "0" ) {
							$statvalue = "";
							if ($GLOBALS['frspersonstattype_values'] == "Numeric" ) {
								$statvalue = $statbits[2];
							}
							XTXT( $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$statvalue );XBR();	
						}
					}
				}
			}
		}	
	}
    
	if ($GLOBALS{'frs_videostream'} != "") {
	    XHR();
	    XH3( "Video Stream" );
	    XINHIDID("team_videostreamvisibility","team_videostreamvisibility",$GLOBALS{'team_videostreamvisibility'});
	    XPTXTID("frs_videostreamcommentary",$GLOBALS{'frs_videostreamcommentary'});  
	    print '<div id="playerElement" style="width:100%; height:0; padding:0 0 56.25% 0"></div>'."\n";
	    print '<p><script type="text/javascript">WowzaPlayer.create("playerElement",{"license":"PLAY1-377Ut-yfkxn-XH9KV-wNx7B-Gwdbr","title":"Havant Hockey Club","description":"","sourceURL":"https%3A%2F%2F1393025411.rsc.cdn77.org%2Fhavanthc%2F'.$GLOBALS{'frs_videostream'}.'%2Fplaylist.m3u8%3FDVR","autoPlay":false,"volume":"75","mute":false,"loop":false,"audioOnly":false,"uiShowQuickRewind":true,"uiQuickRewindSeconds":"30"});</script><br/>'."\n";
	}
	
	X_DIV($frs_id);
	XBR();
	/*
	@messages = split($LF, $GLOBALS{'frs_report'}, -1);
	foreach $message (@messages) {
	 $message=~s/mce-//g;
	 if ($message =~ m#readmore.gif#) {}
	 else { GetTXT("$message\n"); }
	}
	*/
}

function Frs_FRSTEAMSELECTIONDISPLAY_Output ($season, $team_code, $frsid) {
	Get_Data('frs', $season, $team_code,$frsid);
	Get_Data('team', $season, $team_code);
	Get_Array('venue');
	XDIV($frsid,"eaclass" );
	if ( $GLOBALS{'team_photo'} != "" ) {
		XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'team_photo'},"100%");XBR();XBR();
	}
	XH2($GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' - '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
	if ($GLOBALS{'frs_ha'} == "H") {
		Check_Data('venue',$GLOBALS{'frs_venue'});
		if ($GLOBALS{'IOWARNING'} == "0" ) {
			XPTXT("Venue: ".$GLOBALS{'venue_name'}."</br>");
		}
		else { 
			XPTXT("Venue: ".$GLOBALS{'frs_venue'}."</br>");
		}
	}
	if ($GLOBALS{'frs_ha'} == "A") {
		XPTXT("Venue: ".$GLOBALS{'frs_awayvenue'}."</br>");
	}	
	XPTXT("Start Time: ".$GLOBALS{'frs_time'}."</br>");
	XPTXT("Arrangements: ".$GLOBALS{'frs_meet'}."</br></br>");
/*
	if ($GLOBALS{'frs_meetextra'} != "") {
		XPTXT("Information: ".$GLOBALS{'frs_meetextra'}."</br></br>");
	}
*/	
	if ($GLOBALS{'frs_selectiondraft'} != "Yes") {
		
		XPTXT("<hr>Selected for this match:-</br>");		
		$selectedplayera = GetSelectionListPersonIds ('frs_playerselectedlist',"all","");
		foreach ($selectedplayera as $personid)  {
		// $squada = explode(',',$GLOBALS{'team_squadlist'});	
		// foreach ($squada as $personid)  {
			Check_Data("person",$personid);
			if ($GLOBALS{'IOWARNING'} == "0") {
				if ( GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y" ) {
					XBR();
					$colour = "black";
					if ( GetSelectionList('frs_playerselectedlist',$personid,'confirmed') == "Y" ) {$colour = "green";}
					if ( GetSelectionList('frs_playerselectedlist',$personid,'confirmed') == "N" ) {$colour = "red";}
					if ( GetSelectionList('frs_playerselectedlist',$personid,'confirmed') == "?" ) {$colour = "orange";}								
					XTXTCOLOR($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},$colour);
				}
			}
		}
		
		
		XPTXT("<hr>Officials:-</br>");
		$selectedofficiala = GetSelectionListPersonIds ('frs_officialselectedlist',"all","");
		foreach ($selectedofficiala as $personid)  {
			// $squada = explode(',',$GLOBALS{'team_squadlist'});
			// foreach ($squada as $personid)  {
			Check_Data("person",$personid);
			if ($GLOBALS{'IOWARNING'} == "0") {
				if ( GetSelectionList('frs_officialselectedlist',$personid,'selected') == "Y" ) {
					XBR();
					$colour = "black";
					if ( GetSelectionList('frs_officialselectedlist',$personid,'confirmed') == "Y" ) {$colour = "green";}
					if ( GetSelectionList('frs_officialselectedlist',$personid,'confirmed') == "N" ) {$colour = "red";}	
					if ( GetSelectionList('frs_officialselectedlist',$personid,'confirmed') == "?" ) {$colour = "orange";}		
					XTXTCOLOR($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},$colour);
				}
			}
		}		
		
	}
	X_DIV($frsid);
}

function Frs_RESULTSBOARD_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";	
	$GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepickerYYYYMMDD";
}

function Frs_RESULTSBOARD_Output ($season,$section) {
	if ($season == "Current") { $seasonname = "Current Season"; }
	else { $seasonname = $season; }
	$GLOBALS{'currperiodid'} = $season;  // CHECK
	XH3("Results Board for ".$seasonname);
	if ( $GLOBALS{'LOGIN_frame_id'} != "F") {
		foreach (Get_Array_Hash("period") as $xperiodid)  {
			if ($xperiodid != $season) {
				$link = YPGMLINK("frsresultsboardout.php");
				$link = $link.YPGMMINPARMS().YPGMPARM("Season",$xperiodid);
				XLINKTXT($link,"View $xperiodid results"); XBR();
			}
		}
		XBR();
		XTABLE();
		XTR();XTDHTXT("Quick summary for all teams");X_TR();
		$link = YPGMLINK("frslastweeksresultsout.php");
		$link = $link.YPGMMINPARMS().YPGMPARM("Season",$season).YPGMPARM("Section","All");
		XTR();XTDLINKTXT($link,"Last weeks results and match reports");X_TR();
		$link = YPGMLINK("frsnextweeksfixturesout.php");
		$link = $link.YPGMMINPARMS().YPGMPARM("Season",$season);
		XTR();XTDLINKTXT($link,"Next fixture for each team");X_TR();
		$link = YPGMLINK("frsnextweeksscheduleout.php");
		$link = $link.YPGMMINPARMS().YPGMPARM("Season",$season);
		XTR();XTDLINKTXT($link,"Schedule of fixtures for next weekend");X_TR();
		XTR();XTD();
		XFORM("frsdatescheduleout.php","dateschedule");
		XINSTDHID();
		XINHID("Season",$season);
		XTABLE();
		XTR();XTDHTXT("Schedule of fixtures for a specific date");XTDHTXT("");X_TR();
		XTR();XTDTXT("date - dd/mm/yyyy");XTDINDATEYYYY_MM_DD("FixResSelDate","");X_TR();
		XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
		X_TABLE();
		X_FORM();
		X_TD();X_TR();
		X_TABLE();
	}
	XBR();XBR();
	foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $section_name)  {	
		$showsection = "1";
		if (($justsection != "")&&($section_name != $justsection)) {
			$showsection = "0";
		}
		if ($showsection == "1") {
			XTABLE();
			XTR();XTDHTXT($section_name); X_TR();
			XTR();XTD();
			XTABLE();
			XTR();
			foreach (Get_Array_Hash("frspersonstattype",$GLOBALS{'currperiodid'}) as $frspersonstattype_code)  {	
				Get_Data_Hash("frspersonstattype",$GLOBALS{'currperiodid'},$frspersonstattype_code);
				$statscount = 0;
				if ($GLOBALS{'frspersonstattype_msdisplay'} == "Yes") {
					$personresultsa = Array();
					$rperson_ida = Get_Array("frspersonstat",$GLOBALS{'currperiodid'},$section_name."-".$frspersonstattype_code);
					foreach ($rperson_ida as $rperson_id)  {	
						# XH5("CHECK ".$section_name."-".$frspersonstattype_code." ".$rperson_id)." ".$GLOBALS{'frspersonstat_quantity'};
						Check_Data("frspersonstat",$GLOBALS{'currperiodid'},$section_name."-".$frspersonstattype_code,$rperson_id);
						if ($GLOBALS{'IOWARNING'} == "0" ) {

							Check_Data("person",$rperson_id);
							if ($GLOBALS{'IOWARNING'} == "0" ) {
				    			# XH5("USE ".$section_name."-".$frspersonstattype_code." ".$rperson_id)." ".$GLOBALS{'frspersonstat_quantity'};
								$resultsstring = substr("0000".$GLOBALS{'frspersonstat_quantity'},-4)."|".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
								array_push($personresultsa, $resultsstring);
								$statscount++;
							}
						}
					}
					if ($statscount > 0) {
						$sortedpersonresultsa = $personresultsa;
						rsort($sortedpersonresultsa);
						XTD();
						XTXT($GLOBALS{'frspersonstattype_title'});
						XTABLE();
						$maxcount = $GLOBALS{'frspersonstattype_mscount'};
						$count = 0;
						foreach ($sortedpersonresultsa as $element)  {	
							$rbits = explode('|', $element );
							if ($count < $maxcount) {
								XTR();
								XTDTXT($rbits[1]);
								XTDTXT(RemoveLeadingZeros($rbits[0]));
								X_TR();
								$count++;
							}
						}
						X_TABLE();
						$link = YEXTPGMLINK("frsstatsdisplay.php").YPGMMINPARMS().YPGMPARM("CurrentPeriodId",$GLOBALS{'currperiodid'}).YPGMPARM("SectionCode",$section_name."-".$frspersonstattype_code);
						if ( $GLOBALS{'LOGIN_frame_id'} == "F") { XLINKTXT( $link, "More.."); }  // keep on same window
						else { XLINKTXTNEWPOPUP( $link, "More..", "Stats", "center", "center", "500", "300"); } // open new window
						X_TD();
					}
				}
			}

			X_TR();
			X_TABLE();
			X_TD();X_TR();
			XTR();XTD();
			XTABLE();
			XTR();
			XTDHTXT("team");XTDHTXT("played");XTDHTXT("won");XTDHTXT("drew");XTDHTXT("lost");XTDHTXT("for");XTDHTXT("away");
			// XTDHTXT("Fixtures<BR>& Results");XTDHTXT("Match<BR>Reports");XTDHTXT("Selection");XTDHTXT("League");
			XTDHTXT("Fixtures<BR>& Results");XTDHTXT("Selection");XTDHTXT("League");
			X_TR();

			Get_Data_Hash("section",$GLOBALS{'currperiodid'},$section_name);
			$teamsarray = explode (',',$GLOBALS{'section_teams'});
			foreach ($teamsarray as $team_code)  {	
				Get_Data_Hash("team",$GLOBALS{'currperiodid'},$team_code);
				XTR();
				XTDTXT($GLOBALS{'team_name'});
				Check_Data("frsteamstat",$GLOBALS{'currperiodid'},$team_code);
				if ($GLOBALS{'IOWARNING'} == "0") {
					XTDTXTC($GLOBALS{'frsteamstat_played'});
					XTDTXTC($GLOBALS{'frsteamstat_won'});
					XTDTXTC($GLOBALS{'frsteamstat_drew'});
					XTDTXTC($GLOBALS{'frsteamstat_lost'});
					XTDTXTC($GLOBALS{'frsteamstat_gf'});
					XTDTXTC($GLOBALS{'frsteamstat_ga'});
				} else {
					XTDTXTC("");XTDTXTC("");XTDTXTC("");XTDTXTC("");XTDTXTC("");XTDTXTC("");
				}
				$link = YEXTPGMLINK("frsteamfixturesout.php").YPGMMINPARMS();
				$link = $link.YPGMPARM("FixResSelTeam",$team_code).YPGMPARM("Season",$GLOBALS{'currperiodid'}).YPGMPARM("team_code",$team_code);
				XTDLINKTXT($link,"view");
				/*
				$link = YPGMLINK("frsteamresultsdisplay.php").YPGMSTDPARMS();
				$link = $link.YPGMPARM("team_code",$team_code).YPGMPARM("Season",$GLOBALS{'currperiodid'}).YPGMPARM("section_name",$section_name);
				XTDLINKTXT($link,"view");
				*/
				$link = YEXTPGMLINK("frsteamselectiondisplay.php").YPGMMINPARMS();
				$link = $link.YPGMPARM("team_code",$team_code).YPGMPARM("Season",$GLOBALS{'currperiodid'}).YPGMPARM("section_name",$section_name);
				XTDLINKTXT($link,"view");
				$searchstring = '<form';
				if (strlen(strstr($GLOBALS{'team_leaguelink'},$searchstring))>0) {	
					XTDTXT($GLOBALS{'team_leaguelink'});
				}
				else { XTDLINKTXT(Field2URL($GLOBALS{'team_leaguelink'}),$GLOBALS{'team_leaguename'});
				}
				X_TR();
			}
			X_TABLE();
			X_TD();
			X_TR();
			XTR();XTD();
			X_TD();X_TR();
			X_TABLE();
			XBR();XBR();
		}
	}

	XDIV("cal1Containerouter","yui-skin-sam");
	XDIV("cal1Container","");
	X_DIV("cal1Container");
	X_DIV("cal1Containerouter");
}

function Frs_ScoreboardTable_Print($section) {
	if ($section == "") {
		print "<P>No Subsection selected - Please retry</>";
		exit;
	}
	Get_Data_Hash('section',$GLOBALS{'currperiodid'},$section);
	$sectionlist = $GLOBALS{'section_teams'};
	XH3("Last Week's Results Scoreboard for $section club teams.");
	XTABLE();
	XTR();
	XTDHTXT("Date");XTDHTXT("Team");XTDHTXT("Opposition");XTDHTXT("Home Away");XTDHTXT("League Cup");
	XTDHTXT("Result");XTDHTXT("F");XTDHTXT("A");XTDHTXT("Match Report");XTDHTXT("League Link");
	X_TR();
	$fixturesfound = "0";
	$tsectionsarray = Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes");
	foreach ($tsectionsarray as $tsection_name)  {	
		if (($tsection_name == $section)||($section == "All")) {
			Get_Data_Hash('section',$GLOBALS{'currperiodid'},$tsection_name);
			$sectionlist = $GLOBALS{'section_teams'};
			foreach (Get_Array_Hash_SortSelect('team',$GLOBALS{'currperiodid'},"team_seq","","") as $team_code)  {	
				if (strlen(strstr($sectionlist,$team_code))>0) {
					Get_Data("team",$GLOBALS{'currperiodid'},$team_code);
					$dirfiles = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
					$filekey=$team_code.$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}."9";
					$n=0;
					foreach ($dirfiles as $tryfilename)  {	
						if ($tryfilename <= $filekey) {
							$n++;
						}
					}
					if ($n > 0) {
						$fixturesfound = "1";
						$xfilename = $dirfiles[$n-1];
						$bits = explode ('.',$xfilename);
						$frs_id = $bits[0];
						Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
						XTR();
						XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));XTDTXT($GLOBALS{'team_name'});XTDTXT($GLOBALS{'frs_oppo'});XTDTXT($GLOBALS{'frs_ha'});XTDTXT($GLOBALS{'frs_lcf'});
						XTDTXT($GLOBALS{'frs_result'});XTDTXT($GLOBALS{'frs_gf'});XTDTXT($GLOBALS{'frs_ga'});
						$bits = str_split($frs_id);
						$frs_dateyy = $bits[2].$bits[3];
						$frs_datemm = $bits[4].$bits[5];
						$frs_datedd = $bits[6].$bits[7];
						if (($GLOBALS{'frs_report'} != "")||($GLOBALS{'frs_reportheadline'} != "")) {	
							$link = YPGMLINK("frsteamresultdisplay.php").YPGMMINPARMS();
							$link = $link.YPGMPARM("Season",$season).YPGMPARM("frs_id",$frs_id);
							XTDLINKTXT($link,"view");
						} else {XTDTXT("");
						}
						XTDLINKTXT("http://".$GLOBALS{'team_leaguelink'},$GLOBALS{'team_leaguename'});
						X_TR();
					}
				}
			}
		}
	}
	X_TABLE();
	if ($fixturesfound == "0") {
		print "<P>No fixtures have yet taken place\n";
	}
}

function Frs_TEAMFIXTURES_Output($season, $team_code) {
	$dirfiles = Get_Array('frs',$season, $team_code);
	Get_Data("team",$season,$team_code);
	XH1("Match Fixtures - ".$GLOBALS{'team_name'});
	if ($GLOBALS{'team_leaguelink'} != "") {
		$txt1 = 'View League Results - <a href="http://'.$GLOBALS{'team_leaguelink'}.'">'.$GLOBALS{'team_leaguename'}.'</a>';
	}
	XH3("$txt1");

	if ($GLOBALS{'team_mgr'} != "") {
		$txt2 = "Email Team Manager - ";
		$sep = "";
		$splitstra = explode(',', $GLOBALS{'team_mgr'} );
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				$sendtorole = $GLOBALS{'team_name'}." Team Manager";
				$sendtoid = $tperson_id;
				$link = YPGMLINK("personSEroleemailout.php").YPGMMINPARMS();
				$link = $link.YPGMPARM("SendToRole",$sendtorole).YPGMPARM("SendToId",$sendtoid);
				$txt2 = $txt2.$sep.'<a href="'.$link.'">'.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.'</a>';
				if ($GLOBALS{'person_publicdirectory'} == '') {
					$GLOBALS{'person_publicdirectory'} = '3';
				}
				if ($GLOBALS{'person_publicdirectory'} >= "1") {
					$txt2 = $txt2." | Email - ".$GLOBALS{'person_email1'};
				}
				if ($GLOBALS{'person_publicdirectory'} >= "2") {
					$txt2 = $txt2." | Mobile - ".$GLOBALS{'person_mobiletel'};
				}
				if ($GLOBALS{'person_publicdirectory'} >= "3") {
					$txt2 = $txt2." | Tel - ".$GLOBALS{'person_hometel'};
				}
				$sep = "<br/>_________________or ";
			}
		}
		XH4($txt2);
	}

	if ($GLOBALS{'team_captain'} != "") {
		$txt2 = "Email Team Captain - ";
		$sep = "";
		$splitstra = explode(',', $GLOBALS{'team_captain'} );
		foreach ($splitstra as $tperson_id)  {	
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				$sendtorole = $GLOBALS{'team_name'}." Team Captain";
				$sendtoid = $tperson_id;
				$link = YPGMLINK("personSEroleemailout.php").YPGMMINPARMS();
				$link = $link.YPGMPARM("SendToRole",$sendtorole).YPGMPARM("SendToId",$sendtoid);
				$txt2 = $txt2.$sep.'<a href="'.$link.'">'.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.'</a>';
				if ($GLOBALS{'person_publicdirectory'} == '') {
					$GLOBALS{'person_publicdirectory'} = '3';
				}
				if ($GLOBALS{'person_publicdirectory'} >= "1") {
					$txt2 = $txt2." | Email - ".$GLOBALS{'person_email1'};
				}
				if ($GLOBALS{'person_publicdirectory'} >= "2") {
					$txt2 = $txt2." | Mobile - ".$GLOBALS{'person_mobiletel'};
				}
				if ($GLOBALS{'person_publicdirectory'} >= "3") {
					$txt2 = $txt2." | Tel - ".$GLOBALS{'person_hometel'};
				}
				$sep = "<br/>_________________or ";
			}
		}
		XH4($txt2);
	}

	if ($GLOBALS{'team_coach'} != "") {
		$txt2 = "Email Team Coach - ";
		$sep = "";
		$splitstra = explode(',', $GLOBALS{'team_coach'} );
		foreach ($splitstra as $tperson_id)  {
			Check_Data("person",$tperson_id);
			if ($GLOBALS{'IOWARNING'} == "0") {
				$sendtorole = $GLOBALS{'team_name'}." Team Coach";
				$sendtoid = $tperson_id;
				$link = YPGMLINK("personSEroleemailout.php").YPGMMINPARMS();
				$link = $link.YPGMPARM("SendToRole",$sendtorole).YPGMPARM("SendToId",$sendtoid);
				$txt2 = $txt2.$sep.'<a href="'.$link.'">'.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.'</a>';
				if ($GLOBALS{'person_publicdirectory'} == '') {
					$GLOBALS{'person_publicdirectory'} = '3';
				}
				if ($GLOBALS{'person_publicdirectory'} >= "1") {
					$txt2 = $txt2." | Email - ".$GLOBALS{'person_email1'};
				}
				if ($GLOBALS{'person_publicdirectory'} >= "2") {
					$txt2 = $txt2." | Mobile - ".$GLOBALS{'person_mobiletel'};
				}
				if ($GLOBALS{'person_publicdirectory'} >= "3") {
					$txt2 = $txt2." | Tel - ".$GLOBALS{'person_hometel'};
				}
				$sep = "<br/>____________or ";
			}
		}
		XH4($txt2);
	}
	XHR();
	
	XTABLE();
	XTR();
	XTDHTXT("Date");XTDHTXT("Opposition");XTDHTXT("Home/<BR>Away");XTDHTXT("League/<BR>Cup");XTDHTXT("Venue");
	XTDHTXT("Time");XTDHTXT("Info");
	XTDHTXT("");XTDHTXT("Result");XTDHTXT("F");XTDHTXT("A");XTDHTXT("Match Report");
	X_TR();
	$fixturesfound = "0";
	foreach ($dirfiles as $xfilename)  {		
		$fixturesfound = "1";
		$bits = explode('.', $xfilename );
		$frs_id = $bits[0];
		Get_Data("frs",$season,$team_code,$frs_id);
		XTR();
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));	
		$tclublink = "";
		if ($GLOBALS{'frs_oppoteamkey'} != "") {
			$teamsplit = explode('^', $GLOBALS{'frs_oppoteamkey'} );
			$oppoclub_name = $teamsplit[0]; $oppoteam_name = $teamsplit[1];
			Check_Data('oppoclub',$oppoclub_name);
			if ($GLOBALS{'IOWARNING'} == "0") {
				Get_Data('oppoclub',$oppoclub_name); $tclublink = $GLOBALS{'oppoclub_link'};
			}
		}
		if ($tclublink != "") {
			XTDLINKTXT("http://$tclublink",$GLOBALS{'frs_oppo'});
		}
		else {XTDTXT($GLOBALS{'frs_oppo'});
		}
		XTDTXT($GLOBALS{'frs_ha'});XTDTXT($GLOBALS{'frs_lcf'});
		if ($GLOBALS{'frs_ha'} == "H") {
			Check_Data('venue',$GLOBALS{'frs_venue'});
			if ($GLOBALS{'IOWARNING'} == "0" ) {
				XTDLINKTXT("http://".$GLOBALS{'venue_link'},$GLOBALS{'venue_name'});
			}
			else {  
				XTDTXT($GLOBALS{'frs_venue'});
			}
		}
		if ($GLOBALS{'frs_ha'} == "A") {
			XTDTXT($GLOBALS{'frs_awayvenue'});
		}
		if (($GLOBALS{'frs_ha'} != "H")&&($GLOBALS{'frs_ha'} != "A")) {
			XTDTXT("");
		}
		/*
		$tvenue_name = ""; $tvenue_link = ""; $tempvenuetxt = "";
		if ($GLOBALS{'frs_venue'} != "") {
			Get_Data_Hash('venue',$GLOBALS{'frs_venue'});
			if ($GLOBALS{'IOWARNING'} == "0") {
				$tvenue_name = $GLOBALS{'venue_name'};
				$tvenue_link = "http://".$GLOBALS{'venue_link'};
				$tempvenuetxt = $tvenue_name; # temp nasty
			}
			else { $tvenue_name = $GLOBALS{'frs_venue'};
			$tempvenuetxt = $tvenue_name; # temp nasty
			}
		}
		if (($GLOBALS{'frs_netvenueref'} != "")&&($tvenue_link == "")) {
			if (ExtractNetRef($GLOBALS{'frs_netvenueref'},0) == "LOCAL") {
				$tvenue_code = ExtractNetRef($GLOBALS{'frs_netvenueref'},1);
				Get_Data_Hash('venue',$tvenue_code);
				$tvenue_name = $GLOBALS{'venue_name'};
				$tvenue_link = "http://".$GLOBALS{'venue_link'};
			}
			else {
				$tvenue_name = &Network_Venue_Name($oppoclub_name, $GLOBALS{'frs_netvenueref'});
				$tvenue_link = &Network_Venue_Link($oppoclub_name, $GLOBALS{'frs_netvenueref'});
			}
		}
		# if ($tvenue_link != "") {XTDLINKTXT($tvenue_link,$tvenue_name);} else {XTDTXT($tvenue_name);};
		XTDTXT($tempvenuetxt); # temp nasty
		*/
		XTDTXT($GLOBALS{'frs_time'});XTDTXT($GLOBALS{'frs_info'});
		if ($GLOBALS{'frs_cancellation'} == "Yes") {
			$cancelled = '<span style="color:red"><b>Cancelled</b></span>';
		} else {$cancelled = "";
		} XTDTXT($cancelled);
		XTDTXT($GLOBALS{'frs_result'});XTDTXT($GLOBALS{'frs_gf'});XTDTXT($GLOBALS{'frs_ga'});
		if (($GLOBALS{'frs_report'} != "")||($GLOBALS{'frs_reportheadline'} != "")) {
			$link = YPGMLINK("frsteamresultdisplay.php").YPGMMINPARMS();
			$link = $link.YPGMPARM("Season",$season).YPGMPARM("frs_id",$frs_id);
			XTDLINKTXT($link,"view");
		} else {XTDTXT("");
		}
		X_TR();
	}
	X_TABLE();
	if ($fixturesfound == "0") {
		print "<P>No fixtures have yet been entered\n";
	}
}

function ExtractNetRef ($netref, $netrefindex) {
	$netrefsplit = explode('~', $netref );
	$extractnetref = $netrefsplit[$netrefindex];
	$extractnetref = str_replace('}', "", $extractnetref);
	$extractnetref = str_replace('{', "", $extractnetref);	
	return $extractnetref;
}

function Frs_LASTWEEKSRESULTSUPDATELIST($season, $section) {
	XHR();
	XH3("Update Recent Club Results - ".$section);
	XTABLE();
	XTR();
	XTDHTXT("Date");
	XTDHTXT("Seq");
	XTDHTXT("Team");
	XTDHTXT("Opposition");
	XTDHTXT("H/A");
	XTDHTXT("L/C/F");
	XTDHTXT("Result");
	XTDHTXT("For");
	XTDHTXT("Against");
	XTDHTXT("Update Results,<BR>Match Reports");
	X_TR();
	foreach (Get_Array_Hash_SortSelect("section",$season,"section_seq","section_frs","Yes") as $section_name)  {
		if (($section == "All")||($section == $section_name)) {
			Get_Data_Hash('section',$GLOBALS{'currperiodid'},$section_name);
			$sectionlist = $GLOBALS{'section_teams'};

			$fixturesfound = "0";
			foreach (Get_Array_Hash_SortSelect('team',$season,"team_seq","","") as $team_code)  {
				if (strlen(strstr($sectionlist,$team_code))>0) {
					Get_Data("team",$season,$team_code);
					if ($GLOBALS{'IOWARNING'} != "1") {
						$frsa = Get_Array('frs',$season, $team_code);
						$latestreportfrs_id = "";
						$lastweeksreportfound = "0";
						$todayfrs_id=$team_code.$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}."1";
						foreach ($frsa as $frs_id) {
							if ($frs_id < $todayfrs_id) {
								Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
								if ($GLOBALS{'frs_result'} == "") {
									$fixturesfound = "1";
									XTR();
									XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
									XTDTXT($GLOBALS{'frs_seq'});
									XTDTXT($GLOBALS{'team_name'});
									$tclublink = "";
									if ($GLOBALS{'frs_oppoteamkey'} != "") {
										$teamsplit = explode('^', $GLOBALS{'frs_oppoteamkey'});
										$oppoclub_name = $teamsplit[0]; $oppoteam_name = $teamsplit[1];
										Check_Data('oppoclub',$oppoclub_name);
										if ($GLOBALS{'IOWARNING'} == "0") {
											Get_Data('oppoclub',$oppoclub_name); $tclublink = $GLOBALS{'oppoclub_link'};
										}
									}
									if ($tclublink != "") {
										XTDLINKTXT("http://$tclublink",$GLOBALS{'frs_oppo'});
									}
									else {XTDTXT($GLOBALS{'frs_oppo'});
									}
									XTDTXT($GLOBALS{'frs_ha'});
									XTDTXT($GLOBALS{'frs_lcf'});
									XTDTXT($GLOBALS{'frs_result'});
									XTDTXT($GLOBALS{'frs_gf'});
									XTDTXT($GLOBALS{'frs_ga'});
									$link = YPGMLINK("frsteamresultsout.php");
									$link = $link.YPGMSTDPARMS().YPGMPARM("section_name",$section).YPGMPARM("team_code",$team_code).YPGMPARM("frs_id",$frs_id);
									XTDLINKTXT($link,"update");
									X_TR();
								}
							}
						}
					}
				}
			}
			if ($fixturesfound == "0") {
				print "<P>No fixtures require updating\n";
			}
			X_TABLE();
			XBR();
			XHR();
		}
	}
}




function Frs_LASTWEEKSRESULTS_Output($season,$section) {
	XH1("Latest Match Results and Reports");
	Frs_LASTWEEKSRESULTS_Generate($season,$section);
}

function Frs_NEWSLASTWEEKSRESULTS_Output($season) {
	XBR();
	print "<h2>"."Latest Match Results and Reports".'</h2>';;
	XBR();	
	Frs_LASTWEEKSRESULTS_Generate($season, "All");
}

function Frs_LASTWEEKSRESULTS_Generate($season, $section) {
	XHR();
	foreach (Get_Array_Hash_SortSelect("section",$season,"section_seq","section_frs","Yes") as $section_name)  {
		if (($section == "All")||($section == $section_name)) {
			Get_Data_Hash('section',$GLOBALS{'currperiodid'},$section_name);
			$sectionlist = $GLOBALS{'section_teams'};
	
			print "<h2>".$GLOBALS{'section_name'}." Section".'</h2>';;
			print"<table><tr>\n";
			foreach (Get_Array_Hash("frspersonstattype",$season) as $frspersonstattype_code)  {	
				Get_Data_Hash("frspersonstattype",$GLOBALS{'currperiodid'},$frspersonstattype_code);
				$statscount = 0;
				if ($GLOBALS{'frspersonstattype_msdisplay'} == "Yes") {
					$personresultsa = Array();
					$rperson_ida = Get_Array("frspersonstat",$season,$section_name."-".$frspersonstattype_code);
					foreach ($rperson_ida as $rperson_id)  {
						# XH5("CHECK ".$section_name."-".$frspersonstattype_code." ".$rperson_id)." ".$GLOBALS{'frspersonstat_quantity'};
						Check_Data("frspersonstat",$season,$section_name."-".$frspersonstattype_code,$rperson_id);
						if ($GLOBALS{'IOWARNING'} == "0" ) {
							Check_Data("person",$rperson_id);
							if ($GLOBALS{'IOWARNING'} == "0" ) {
								# XH5("USE ".$section_name."-".$frspersonstattype_code." ".$rperson_id)." ".$GLOBALS{'frspersonstat_quantity'};
								$resultsstring = substr("0000".$GLOBALS{'frspersonstat_quantity'},-4)."|".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
								array_push($personresultsa, $resultsstring) ;
								$statscount++;
							}
						}
					}
					if ($statscount > 0) {
						$sortedpersonresultsa = $personresultsa;
						rsort($sortedpersonresultsa);
						XTDTOP();
						print '<small>'.$GLOBALS{'frspersonstattype_title'}.'</small>';
						XTABLE();
						$maxcount = $GLOBALS{'frspersonstattype_mscount'};
						$count = 0;
						foreach ($sortedpersonresultsa as $element)  {	
							$rbits = explode('|',$element);
							if ($count < $maxcount) {
								XTR();
								XTDTXT($rbits[1]);
								XTDTXT(RemoveLeadingZeros($rbits[0]));
								X_TR();
								$count++;
							}
						}
						X_TABLE();
						$link = YEXTPGMLINK("frsstatsdisplay.php").YPGMMINPARMS().YPGMPARM("CurrentPeriodId",$GLOBALS{'currperiodid'}).YPGMPARM("SectionCode",$section_name."-".$frspersonstattype_code);
						if ( $GLOBALS{'LOGIN_frame_id'} == "F") { // keep on same window
							XLINKTXT( $link, "<small>More..</small>");
						} else { // open new window
							XLINKTXTNEWWINDOW( $link, "<small>More..</small>", "Stats");
						}
						XBR();
						X_TD();
						XTD();X_TD();
					}
				}
			}
			print"</tr></table><br>\n";
	
			$fixturesfound = "0";
			foreach (Get_Array_Hash_SortSelect('team',$season,"team_seq","","") as $team_code)  {
				if (strlen(strstr($sectionlist,$team_code))>0) {	
					Get_Data("team",$season,$team_code);
					if ($GLOBALS{'IOWARNING'} != "1") {
						$frsa = Get_Array('frs',$season, $team_code);
						$latestreportfrs_id = "";
						$lastweeksreportfound = "0";					
						$todayfrs_id=$team_code.$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}."1";
						foreach ($frsa as $frs_id) {
							if ($frs_id < $todayfrs_id) {
								$fixturesfound  = "1";
								Get_Data("frs",$season,$team_code,$frs_id);
								$latestreportfrs_id = $frs_id;
								if (DaysDifference($GLOBALS{'currentYYYY-MM-DD'},$GLOBALS{'frs_date'}) < 7) {
									if (($GLOBALS{'frs_report'} != "")||($GLOBALS{'frs_reportheadline'} != "")||($GLOBALS{'frs_gf'} != "")||($GLOBALS{'frs_ga'} != "")) {
										Frs_LASTWEEKSRESULTS_Match_Generate($season, $frs_id);
										$lastweeksreportfound = "1";
									}
								}
							}
						}
						if (($latestreportfrs_id != "")&&($lastweeksreportfound == "0")) {
							Get_Data("frs",$season,$team_code,$latestreportfrs_id);
							if (($GLOBALS{'frs_report'} != "")||($GLOBALS{'frs_reportheadline'} != "")) {
								# XH2($GLOBALS{'currperiodid'}."|".$team_code."|".$latestreportfrs_id);
								Frs_LASTWEEKSRESULTS_Match_Generate($season, $latestreportfrs_id);
							}
						}
					}
				}
			}
			if ($fixturesfound == "0") {
				print "<P>No fixtures have yet taken place\n";
			}
			XBR();
			XHR();
		}		
	}
}

function Frs_LASTWEEKSRESULTS_Match_Generate ($season,$frs_id) {
	// XBR();
	if ($GLOBALS{'frs_ha'} == "A") {
		XH3($GLOBALS{'frs_oppo'}."&nbsp;&nbsp;&nbsp;&nbsp;<big>".'<span style="color:green">'.$GLOBALS{'frs_ga'}." - ".$GLOBALS{'frs_gf'}."</big></span>&nbsp;&nbsp;&nbsp;&nbsp;".$GLOBALS{'domain_shortname'}." ".$GLOBALS{'team_name'}.'<span style="color:silver">'."&nbsp;&nbsp;&nbsp;------- ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}).'</span">');
		// print "<h3>".$GLOBALS{'frs_oppo'}."&nbsp;&nbsp;&nbsp;&nbsp;<big>".'<span style="color:green">'.$GLOBALS{'frs_ga'}." - ".$GLOBALS{'frs_gf'}."</big></span>&nbsp;&nbsp;&nbsp;&nbsp;".$GLOBALS{'domain_shortname'}." ".$GLOBALS{'team_name'}."&nbsp;&nbsp;&nbsp;------- ".YYbMMbDDtoDDsMMsYY($GLOBALS{'frs_date'})."</h3>\n";
	} else {
		XH3($GLOBALS{'domain_shortname'}." ".$GLOBALS{'team_name'}."&nbsp;&nbsp;&nbsp;&nbsp;<big>".'<span style="color:green">'.$GLOBALS{'frs_gf'}." - ".$GLOBALS{'frs_ga'}."</big></span>&nbsp;&nbsp;&nbsp;&nbsp;".$GLOBALS{'frs_oppo'}.'<span style="color:silver">'."&nbsp;&nbsp;&nbsp;------- ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}).'</span">');
		// print "<h3>".$GLOBALS{'domain_shortname'}." ".$GLOBALS{'team_name'}."&nbsp;&nbsp;&nbsp;&nbsp;<big>".'<span style="color:green">'.$GLOBALS{'frs_gf'}." - ".$GLOBALS{'frs_ga'}."</big></span>&nbsp;&nbsp;&nbsp;&nbsp;".$GLOBALS{'frs_oppo'}."&nbsp;&nbsp;&nbsp;------- ".YYbMMbDDtoDDsMMsYY($GLOBALS{'frs_date'})."</h3>\n";
	}
	$introduction = "1"; $truncation = "0";

	if (($GLOBALS{'frs_report'} != "")||($GLOBALS{'frs_reportheadline'} != "")) {	
		if ($GLOBALS{'frs_reportheadline'} != "") {
			XTXT($GLOBALS{'frs_reportheadline'}."\n");
		} else {
			$cleanedreport = CleanReportText($GLOBALS{'frs_report'});
			$reportlength = strlen($cleanedreport);
			if ($reportlength > 300 ) {
				$report = substr($cleanedreport, 0, 300)." .....\n";
				$truncation = "1";
			}
			else {$report = $cleanedreport."\n";
			}
			XTXT("$report\n");
		}
		$link = YEXTPGMLINK("frsteamresultdisplay.php").YPGMMINPARMS();
		$link = $link.YPGMPARM("Season",$season).YPGMPARM("frs_id",$frs_id);
		XBR();
		if ( $GLOBALS{'LOGIN_frame_id'} == "F") { // keep on same window
			XLINKIMGFLEX($link,"http:".$GLOBALS{'site_asseturl'}."/readmore.gif");
		} else { // open new window
			XLINKIMGFLEXNEWWINDOW($link,"http:".$GLOBALS{'site_asseturl'}."/readmore.gif","matchreport");
		}
		XBR();
	}
	
}

function CleanReportText ($intext) {
	$outtext = "";
	$chara = str_split($intext);
	$tabstatus = "0";
	foreach ($chara as $char)  {
		if ($tabstatus == "1") { $tabtext = $tabtext.$char; }
		if ($char == '<') { $tabstatus = "1"; $tabtext = $char; }
		if ($char == '>') { $tabstatus = "2";  }
		if ($tabstatus == "0") {$outtext = $outtext.$char;}
		if ($tabstatus == "2") {
			$retaintab = "0";
			if ($tabtext == "<br>" ) { $retaintab = "1"; }
			if ($tabtext == "</br>" ) { $retaintab = "1"; }
			if ($tabtext == "</br>" ) {$retaintab = "1"; }
			if ($retaintab == "1" ) {$outtext = $outtext.$tabtext; }
			$tabstatus = "0";
		}
	}
	return $outtext;
}

function Frs_NEXTWEEKSFIXTURES_Output($season) {
	XH1("Next fixture for each team.");
	$helplink = "ResultsMaster/Results_Mass2_Output_CF/mass_output2_cf.html"; Help_Link;
	XTABLE();
	XTR();
	XTDHTXT("Date");XTDHTXT("Team");XTDHTXT("Opposition");XTDHTXT("Home/<BR>Away");XTDHTXT("League/<BR>Cup");XTDHTXT("Venue");
	XTDHTXT("Time");XTDHTXT("Info");XTDHTXT("");
	X_TR();
	foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $section_name)  {
		Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
		$teamsarray = explode(',',$GLOBALS{'section_teams'});
		foreach ($teamsarray as $team_code)  {	
			Get_Data_Hash("team",$GLOBALS{'currperiodid'},$team_code);
			$frs_ida = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
			rsort($frs_ida);
			Get_Data_Hash("team",$GLOBALS{'currperiodid'},$team_code);
			$frs_idkey=$team_code.$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}."1";
			$frs_id = "";
			foreach ($frs_ida as $tfrs_id)  {
				if ($tfrs_id >= $frs_idkey) {
					$frs_id = $tfrs_id;
				}
			}
			Check_Data('frs',$GLOBALS{'currperiodid'},$team_code,$frs_id);
			if ( $GLOBALS{'IOWARNING'} == "0") {
				XTR();
				XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));XTDTXT($GLOBALS{'team_name'});
				XTDTXT($GLOBALS{'frs_oppo'});XTDTXT($GLOBALS{'frs_ha'}); XTDTXT($GLOBALS{'frs_lcf'});
				if ($GLOBALS{'frs_ha'} == "H") {
					Check_Data('venue',$GLOBALS{'frs_venue'});
					if ($GLOBALS{'IOWARNING'} == "0" ) {
						XTDLINKTXT("http://".$GLOBALS{'venue_link'},$GLOBALS{'venue_name'});
					}
					else {
						XTDTXT($GLOBALS{'frs_venue'});
					}
				}
				if ($GLOBALS{'frs_ha'} == "A") {
					XTDTXT($GLOBALS{'frs_awayvenue'});
				}				
				/*
				if (($GLOBALS{'frs_netvenueref'} != "")&&($tvenue_link == "")) {
					if (ExtractNetRef($GLOBALS{'frs_netvenueref'},0) == "LOCAL") {
						$tvenue_code = ExtractNetRef($GLOBALS{'frs_netvenueref'},1);
						Get_Data_Hash('venue',$tvenue_code);
						$tvenue_name = $GLOBALS{'venue_name'};
						$tvenue_link = "http://".$GLOBALS{'venue_link'};
					}
					else {
						$tvenue_name = Network_Venue_Name($oppoclub_name, $GLOBALS{'frs_netvenueref'});
						$tvenue_link = Network_Venue_Link($oppoclub_name, $GLOBALS{'frs_netvenueref'});
					}
				}
				#  if ($tvenue_link ne "") {XTDLINKTXT($tvenue_link,$tvenue_name);} else {XTDTXT($tvenue_name);};
				XTDTXT($tempvenuetxt); # temp nasty
				*/
				XTDTXT($GLOBALS{'frs_time'});XTDTXT($GLOBALS{'frs_info'});
				if ($GLOBALS{'frs_cancellation'} == "Yes") {
					$cancelled = '<span style="color:red"><b>Cancelled</b></span>';
				} else {$cancelled = "";
				} XTDTXT($cancelled);
				X_TR();
			}
		}
	}
	X_TABLE();
}

function Frs_NEXTWEEKSSCHEDULE_Output($season) {
	
	date_default_timezone_set('Europe/London');
	$day = date("D");
	$satoffsetdays = array("Mon"=> 5, "Tue"=> 4,  "Wed"=> 3,  "Thu"=> 2,  "Fri"=> 1,  "Sat"=> 0,  "Sun"=> -1);
	$sunoffsetdays = array("Mon"=> 6, "Tue"=> 5,  "Wed"=> 4,  "Thu"=> 3,  "Fri"=> 2,  "Sat"=> 1,  "Sun"=> 0);	
	$now = time();
	$secs_in_day = (3600 * 24); # seconds in hour * 24
	$satdays_hence = $now + ($satoffsetdays[$day] * $secs_in_day);
	$sundays_hence = $now + ($sunoffsetdays[$day] * $secs_in_day);
	
	$tarr = localtime($satdays_hence, true);
	$datedd = substr("00".strval($tarr["tm_mday"]), -2);
	$datemm = substr("00".strval($tarr["tm_mon"]+1), -2);
	$dateyyyy = strval($tarr["tm_year"]+1900);	
	$satdate = $dateyyyy."-".$datemm."-".$datedd;
	Frs_DATESCHEDULE_Output($season, $satdate);
	
	$tarr = localtime($sundays_hence, true);
	$datedd = substr("00".strval($tarr["tm_mday"]), -2);
	$datemm = substr("00".strval($tarr["tm_mon"]+1), -2);
	$dateyyyy = strval($tarr["tm_year"]+1900);
	$sundate = $dateyyyy."-".$datemm."-".$datedd;
	Frs_DATESCHEDULE_Output($season, $sundate);

}

function Frs_DATESCHEDULE_Output($season, $date) {
	XHR();
	$dayofweek = date("l", strtotime($date));
	XH1("Schedule for ".$dayofweek." ".YYYY_MM_DDtoDDsMMsYY($date));
	$hfa = Array();
	$uhfa = Array();
	$hva = Array();
	$afa = Array();
	$fixturesfound = "0";
	$earliesthomeslot = "99:99"; $latesthomeslot = "00:00";
	foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $section_name)  {
		Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
		$teamsarray = explode(',',$GLOBALS{'section_teams'});
		foreach ($teamsarray as $team_code)  {
			$frsa = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
			foreach ($frsa as $frs_id)  {
				$fixturesfound = "1";
				$bits = str_split($frs_id);
				$fileyymmdd = $bits[2].$bits[3].$bits[4].$bits[5].$bits[6].$bits[7];
				$bits = str_split($date);
				$checkyymmdd = $bits[2].$bits[3].$bits[5].$bits[6].$bits[8].$bits[9];
				if ($fileyymmdd == $checkyymmdd) {
					Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
					$ttime1 = $GLOBALS{'frs_time'};
					if ($ttime1 == "") { $ttime1 = "?";	}
					$ttime2 = $GLOBALS{'frs_timeend'};
					if ($ttime2 == "") {
						if ($ttime1 == "?") { $ttime2 = "?"; } 
						else { $ttime2 = OffsetMinutes ($ttime1,75); }	
					}
					if ($GLOBALS{'frs_ha'} == "H") {
						if (!in_array($GLOBALS{'frs_venue'}, $hva)) { array_push($hva, $GLOBALS{'frs_venue'}); }
						if ($ttime1 != "?") {
							array_push($hfa, $ttime1."#F#".$frs_id."#".$GLOBALS{'frs_venue'}."#".$ttime2);
							if ($ttime1 < $earliesthomeslot) {
								$earliesthomeslot = $ttime1;
							}
							if ($ttime1 > $latesthomeslot) {
								$latesthomeslot = $ttime1;
							}
							if ($ttime2 != "?") {							
								if ($ttime2 > $latesthomeslot) {
									$latesthomeslot = $ttime2;
								}
							}
							
							
							
							
						} else {
							array_push($uhfa, $ttime1."#F#".$frs_id."#".$GLOBALS{'frs_venue'}."#".$ttime2);
						}
					}
	
					if ($GLOBALS{'frs_ha'} == "A") {
						array_push($afa, $ttime1."#F#".$frs_id);
					}
				}
			}
		}
	}

	$venuea = Get_Array("venue");
	foreach ($venuea as $venue_code)  {
		Get_Data("venue", $venue_code);
		if ($GLOBALS{'venue_bookable'} == "Yes") {
			$bookinga = Get_Array("booking", $venue_code);
			foreach ($bookinga as $booking_id)  {
				Get_Data("booking", $venue_code, $booking_id);
				$booking_datestart = $GLOBALS{'booking_datestart'};
				$booking_dateend = $GLOBALS{'booking_dateend'};	
				if (($booking_dateend == "")||($booking_dateend == "0000-00-00")) {$booking_dateend = $booking_datestart;}
				$bookingthisday = "0";
				// XPTXT("DDD  ".$date."|".$booking_datestart."|".$booking_dateend);
				if (($booking_datestart == $booking_dateend)&&($date == $booking_datestart)) { // single booking
					$bookingthisday = "1";
				} else {
					if (($date >= $booking_datestart)&&($date <= $booking_dateend)) {
						if ($GLOBALS{'booking_weeklyrepeating'} == "Yes") { 
							$bookingday = date("l", strtotime($booking_datestart));
							$thisday = date("l", strtotime($date));;
							if ($thisday == $bookingday) { $bookingthisday = "1"; } // valid day match within period							
						} else {
							$bookingthisday = "1"; // valid day in contiguous period
						}
					}	
				}
				if ( $bookingthisday == "1" ) {
					Get_Data("venue", $GLOBALS{'booking_venuecode'});
					if ($GLOBALS{'venue_bookable'} == "Yes") {
						array_push($hfa, $GLOBALS{'booking_timestart'}."#B#".$venue_code."|".$booking_id."#".$GLOBALS{'booking_venuecode'}."#".$GLOBALS{'booking_timeend'});
						if (!in_array($GLOBALS{'booking_venuecode'}, $hva)) {
							array_push($hva, $GLOBALS{'booking_venuecode'});
						}
						if ($GLOBALS{'booking_timestart'} < $earliesthomeslot) {
							$earliesthomeslot = $GLOBALS{'booking_timestart'};
						}
						if ($GLOBALS{'booking_timestart'} > $latesthomeslot) {
							$latesthomeslot = $GLOBALS{'booking_timestart'};
						}
						if ($GLOBALS{'booking_timeend'} != "") {
							if ($GLOBALS{'booking_timeend'} > $latesthomeslot) {
								$latesthomeslot = $GLOBALS{'booking_timeend'};
							}
						}
					}
				}
			}
		}
	}		
		
	

	$coursea = Get_Array("course");
	foreach ($coursea as $course_id)  {
		Get_Data("course", $course_id);
		$course_datestart = $GLOBALS{'course_datestart'};
		$course_dateend = $GLOBALS{'course_dateend'};
		if (($course_dateend == "")||($course_dateend == "0000-00-00")) {
			$course_dateend = $course_datestart;
		}
		$bookingthisday = "0";
		// XPTXT("DDD  ".$date."|".$course_datestart."|".$course_dateend);
		if (($course_datestart == $course_dateend)&&($date == $course_datestart)) {
			// single booking
			$bookingthisday = "1";
		} else {
			if (($date >= $course_datestart)&&($date <= $course_dateend)) {
				// XPTXT("DDD  ".$date."|".$course_datestart."|".$course_dateend."|".$GLOBALS{'course_weeklyrepeating'});
				if ($GLOBALS{'course_weeklyrepeating'} == "Yes") {
					$bookingday = date("l", strtotime($course_datestart));
					$thisday = date("l", strtotime($date));;
					if ($thisday == $bookingday) {
						$bookingthisday = "1";
					} // valid day match within period
				} else {
					$bookingthisday = "1"; // valid day in contiguous period
				}
			}
		}
		if ( $bookingthisday == "1" ) {
			Get_Data("venue", $GLOBALS{'course_venuecode'});
			if ($GLOBALS{'venue_bookable'} == "Yes") {
				array_push($hfa, $GLOBALS{'course_timestart'}."#C#".$course_id."#".$GLOBALS{'course_venuecode'}."#".$GLOBALS{'course_timeend'});
				if (!in_array($GLOBALS{'course_venuecode'}, $hva)) { array_push($hva, $GLOBALS{'course_venuecode'}); }
				if ($GLOBALS{'course_timestart'} < $earliesthomeslot) {
					$earliesthomeslot = $GLOBALS{'course_timestart'};
				}
				if ($GLOBALS{'course_timestart'} > $latesthomeslot) {
					$latesthomeslot = $GLOBALS{'course_timestart'};
				}
				if ($GLOBALS{'course_timeend'} != "") {
					if ($GLOBALS{'course_timeend'} > $latesthomeslot) {
						$latesthomeslot = $GLOBALS{'course_timeend'};
					}
				}
			}
		}
	}

	$highlightuptoa = Array();
	foreach ($hva as $hv) {
		$highlightuptoa[$hv] = "";
	}
	
	XH2("Home Fixtures");
	if(empty($hfa)){
		print "<P>No home fixtures have been found for this date\n";			
	} else {

		if ( $GLOBALS{'LOGIN_frame_id'} != "F" ) {  // Full Format
			sort($hfa);
			/*
			XHR();
			XPTXT($earliesthomeslot." - ".$latesthomeslot);
			foreach ($hfa as $hf)  { XPTXT($hf); }
			*/			
			$schedule = Array();
			for ($hh = 0; $hh < 24; $hh++) {
				for ($mm = 0; $mm < 4; $mm++) {
					$stime = substr("0".$hh,-2).":".substr("0".($mm*15),-2);
					array_push($schedule, $stime);
				}
			}
		
			$slotindex = 0;
			foreach ($schedule as $slot)  {
				if ($slot == $latesthomeslot) {
					$latestslotindex = $slotindex + 5;
				}
				$slotindex++;
			}
			if ($latestslotindex > count($schedule)-1) {$latestslotindex = $schedule[end($schedule)];}
			$latesthomeslot = $schedule[$latestslotindex];
		
			XTABLE(); 
			XTR();XTDHTXT("Time");
			$hvindex = 0; $thishvindex = 0;
			foreach ($hva as $hv)  {
				Check_Data('venue',$hv);
				if ( $GLOBALS{'IOWARNING'} == "0") { XTDHTXT($GLOBALS{'venue_name'}); }
				else {XTDHTXT($hv);	}
			}
			X_TR();
			XTR();XTDTXT("");
			$hvindex = 0; $thishvindex = 0;
			foreach ($hva as $hv)  {
				$link = YPGMLINK("bookingvenueschedulein.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("venue_code",$hv).YPGMPARM("season",$season);
				$dd = substr($date, 8, 2);
				$mm = substr($date, 5, 2);
				$yyyy = substr($date, 0, 4);
				$link = $link.YPGMPARM("requesteddate_YYYYpart",$yyyy).YPGMPARM("requesteddate_MMpart",$mm).YPGMPARM("requesteddate_DDpart",$dd);				
				XTDLINKTXT($link,"weekly schedule");
			}
			X_TR();
			$slotindex = 0;
			foreach ($schedule as $slot)  {
				if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
					if (substr($slot,3,2) == "00") {
						XTR(); XTDHTXT("");
						foreach ($hva as $hv )  {
							XTDHTXT("");
						}
						X_TR();
					}
				}
				if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
					XTR();
				}
				$hvindex = 0;
				foreach ($hva as $hv)  {
					$ftext = ""; $sep = "";
					foreach ($hfa as $hf)  {
						$bits = explode('#',$hf);
						$ttime = $bits[0];
						$type = $bits[1];
						$id = $bits[2];
						$tvenue = $bits[3];
						$ttimeend = $bits[4];
						if ($slotindex == count($schedule)-1) {$nextslot = "99.99";}  else {$nextslot = $schedule[$slotindex+1];}
						if (($ttime >= $slot)&&($ttime < $nextslot)&&($tvenue == $hv)) {
							if ($type == "F") {
								$bits = str_split($id);
								$tteam_code = $bits[0].$bits[1];
								Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$id);
								Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
								$tteam_name = $GLOBALS{'team_name'};
								if ($ttimeend == "?") { $ttimeendtxt = ""; }
								else { $ttimeendtxt = " (until ".$ttimeend.")"; }
								$ttimeendtxt = "";
								$ftext = $ftext.$sep.$tteam_name." v ".$GLOBALS{'frs_oppo'}.$ttimeendtxt;
								if ($ttimeend > $highlightuptoa[$hv]) { $highlightuptoa[$hv] = $ttimeend; }
								$sep = "<br>";
							}
							if ($type == "B") {
								$bits = explode('|',$id);
								Get_Data("booking",$bits[0],$bits[1]);
								if ($ttimeend == "?") { $ttimeendtxt = ""; }
								else { $ttimeendtxt = " (until ".$ttimeend.")"; }
								$ftext = $ftext.$sep.$GLOBALS{'booking_title'}.$ttimeendtxt;
								if ($ttimeend > $highlightuptoa[$hv]) { $highlightuptoa[$hv] = $ttimeend; }							
								$sep = "<br>";
							}
							if ($type == "C") {
								Get_Data("course",$id);
								Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
								if ($ttimeend == "?") { $ttimeendtxt = ""; }
								else { $ttimeendtxt = " (until ".$ttimeend.")"; }
								$ftext = $ftext.$sep.$GLOBALS{'coursecategory_name'}." - ".$GLOBALS{'course_title'}.$ttimeendtxt;
								if ($ttimeend > $highlightuptoa[$hv]) { $highlightuptoa[$hv] = $ttimeend; }								
								$sep = "<br>";
							}
						}
					}
					if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
						if ($hvindex == 0) {
							XTDTXT($slot);
						}
						if ($ftext != "") {
							XTDTXTHIGHLIGHT($ftext);
						} else {
							if ($slot > $highlightuptoa[$hv] ) { $highlightuptoa[$hv] = ""; }
							if (($highlightuptoa[$hv] != "")&&($slot < $highlightuptoa[$hv])) { XTDTXTHIGHLIGHT($ftext);  }
							else { XTDTXT($ftext); }
						}
					}
					$hvindex++;
				}
				if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
					X_TR();
				}
				$slotindex++;
			}
			X_TABLE();
		} else {	// Facebook condensed format
			XTABLE();
			XTR();XTDHTXT("Time");XTDHTXT("Team");XTDHTXT("Opposition");XTDHTXT("Venue");X_TR();
			sort($hfa);
			foreach ($hfa as $hf)  {
				$bits = explode('#',$hf);
				$ttime = $bits[0];
				$type = $bits[1];
				$frs_id = $bits[2];
				$bits = str_split($frs_id);
				$tteam_code = $bits[0].$bits[1];
				Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$frs_id);
				Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
				$tteam_name = $GLOBALS{'team_name'};
				XTR();XTDTXT($ttime);XTDTXT($GLOBALS{'team_name'});XTDTXT($GLOBALS{'frs_oppo'});XTDTXT($GLOBALS{'frs_venue'});X_TR();
			}
			X_TABLE();
		} 
	}

	if(empty($uhfa)){	
	} else {
		XH3("Home Fixtures not yet scheduled");
		XTABLE();
		XTR();XTDHTXT("Time");XTDHTXT("Team");XTDHTXT("Opposition");XTDHTXT("Venue");X_TR();
		sort($uhfa);
		foreach ($uhfa as $uhf)  {
			$bits = explode('#',$uhf);
			$ttime = $bits[0];
			$type = $bits[1];
			$frs_id = $bits[2];
			$bits = str_split($frs_id);
			$tteam_code = $bits[0].$bits[1];
			Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$frs_id);
			Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
			$tteam_name = $GLOBALS{'team_name'};
			XTR();XTDTXT($ttime);XTDTXT($GLOBALS{'team_name'});XTDTXT($GLOBALS{'frs_oppo'});XTDTXT($GLOBALS{'frs_venue'});X_TR();
		}
		X_TABLE();
	}
	
	XH2("Away Fixtures");
	if(empty($afa)){
		print "<P>No away fixtures have been found for this date\n";
	} else {
		XTABLE();
		XTR();XTDHTXT("Time");XTDHTXT("Team");XTDHTXT("Opposition");XTDHTXT("Venue");X_TR();
		sort($afa);
		foreach ($afa as $af)  {
			$bits = explode('#',$af);
			$ttime = $bits[0];
			$type = $bits[1];
			$frs_id = $bits[2];
			$bits = str_split($frs_id);
			$tteam_code = $bits[0].$bits[1];
			Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$frs_id);
			Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
			$tteam_name = $GLOBALS{'team_name'};
			XTR();XTDTXT($ttime);XTDTXT($GLOBALS{'team_name'});XTDTXT($GLOBALS{'frs_oppo'});XTDTXT($GLOBALS{'frs_awayvenue'});X_TR();
		}
		X_TABLE();
	}
	
}

function Frs_FBRESULTSMENU_Output ($season,$section){
	// $photofullsitename = "https:".$GLOBALS{'domainwwwurl'}."/domain_style/LatestFR.jpg";
	XIMGWIDTH($photofullsitename,"100%");
	$link = YEXTPGMLINKHTTPS("frslastweeksresultsout.php");
	$link = $link.YPGMMINPARMS().YPGMPARM("Section",$viewsection).YPGMPARM("Season",$GLOBALS{'currperiodid'}).YPGMPARM("Section","All");
	XLINKH3($link,"Latest results and match reports");
	$link = YEXTPGMLINKHTTPS("frsnextweeksfixturesout.php");
	$link = $link.YPGMMINPARMS().YPGMPARM("Section",$viewsection).YPGMPARM("Season",$GLOBALS{'currperiodid'});
	XLINKH3($link,"Next fixture for each team");
	$link = YEXTPGMLINKHTTPS("frsnextweeksscheduleout.php");
	$link = $link.YPGMMINPARMS().YPGMPARM("Section",$viewsection).YPGMPARM("Season",$GLOBALS{'currperiodid'});
	XLINKH3($link,"Schedule of fixtures for next weekend");
	$link = YEXTPGMLINKHTTPS("frsresultsboardout.php");
	$link = $link.YPGMMINPARMS().YPGMPARM("Section",$viewsection).YPGMPARM("Season",$GLOBALS{'currperiodid'});
	XLINKH3($link,"Results board for ".$GLOBALS{'currperiodid'});
}


function Frs_FBLASTWEEKSRESULTS_Output($season) {
	$GLOBALS{'LOGIN_frame_id'} = "F";
	$newfbstring = "<br>\n";
	$oldfbstring = "\n";
	foreach (Get_Array_Hash_SortSelect("section",$season,"section_seq","section_frs","Yes") as $section_name)  {
		Get_Data_Hash('section',$GLOBALS{'currperiodid'},$section_name);
		$sectionlist = $GLOBALS{'section_teams'};

		$newfbstring = $newfbstring."<h2>".$GLOBALS{'section_name'}." Section"."</h2>\n";
		$oldfbstring = $oldfbstring."<big><big>".$GLOBALS{'section_name'}." Section"."</big></big>\n\n";

		$fixturesfound = "0";
		foreach (Get_Array_Hash_SortSelect('team',$season,"team_seq","","") as $team_code)  {
			if (strlen(strstr($sectionlist,$team_code))>0) {	
				Get_Data("team",$season,$team_code);
				if ($GLOBALS{'IOWARNING'} != "1") {
					$frsa = Get_Array('frs',$season, $team_code);
					$latestreportfrs_id = "";
					$lastweeksreportfound = "0";					
					$todayfrs_id=$team_code.$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}."1";
					foreach ($frsa as $frs_id) {
						if ($frs_id < $todayfrs_id) {
							$fixturesfound  = "1";
							Get_Data("frs",$season,$team_code,$frs_id);
							$latestreportfrs_id = $frs_id;
							if (DaysDifference($GLOBALS{'currentYYYY-MM-DD'},$GLOBALS{'frs_date'}) < 7) {
								if (($GLOBALS{'frs_report'} != "")||($GLOBALS{'frs_reportheadline'} != "")) {
									$newfbstring = $newfbstring.Frs_FBLASTWEEKSRESULTS_Match_Generate($season, $frs_id, "New");
									$oldfbstring = $oldfbstring.Frs_FBLASTWEEKSRESULTS_Match_Generate($season, $frs_id, "Old");
									$lastweeksreportfound = "1";
								}
							}
						}
					}
					if (($latestreportfrs_id != "")&&($lastweeksreportfound == "0")) {
						Get_Data("frs",$season,$team_code,$latestreportfrs_id);
						if (($GLOBALS{'frs_report'} != "")||($GLOBALS{'frs_reportheadline'} != "")) {
							# XH2($GLOBALS{'currperiodid'}."|".$team_code."|".$latestreportfrs_id);
							$newfbstring = $newfbstring.Frs_FBLASTWEEKSRESULTS_Match_Generate($season, $frs_id, "New");
							$oldfbstring = $oldfbstring.Frs_FBLASTWEEKSRESULTS_Match_Generate($season, $frs_id, "Old");
						}
					}
				}
			}
		}
		if ($fixturesfound == "0") {
			print "<P>No fixtures have yet taken place\n";
		}
		$newfbstring = $newfbstring."<br>\n";
		$oldfbstring = $oldfbstring."\n";
	}
	$link = YEXTPGMLINK("frsfbresultsmenuout.php").YPGMMINPARMS();
	$link = $link.YPGMPARM("Season",$GLOBALS{'currperiodid'});

	$newfbstring = $newfbstring.YLINKTXT($link,"<b>"."Fixtures and Results Menu"."</b>"."<br>");   
	$oldfbstring = $oldfbstring.YLINKTXT($link,"<b>"."Fixtures and Results Menu"."</b>"); 	
	$newfbstring = $newfbstring."</br>\n";
	$oldfbstring = $oldfbstring."\n";	
	
	XH1("Facebook - Latest Match Reports");
	XHR();
	XH2("If you have the New Version of the Facebook Note App");
	$imagelink = $GLOBALS{'site_asseturl'}."/NewFaceBookNote.jpg";
	XIMGFLEX($imagelink);
	XPTXT('Copy and Paste the following where you see "write something"');
	XPTXT('(This only seems to work properly using Firefox or Chrome browser !!  )');
	XBR();
	XTABLE();
	print '<table width="850" border="1">'."\n";
	print '<tr>'."\n";
	XTD();
	print $newfbstring;
	XBR();
	X_TD();X_TR();
	X_TABLE();
	XBR();
	XHR();XBR();
	
	XH2("If you have the Old Version of the Facebook Note App");
	$imagelink = $GLOBALS{'site_asseturl'}."/OldFaceBookNote.jpg";
	XIMGFLEX($imagelink);
	XPTXT("Copy and Paste the following into the note textbox");
	XBR();
	XTEXTAREA("candptext","30","130");
	print $oldfbstring;
	X_TEXTAREA();
	XBR();
	XHR();XBR();	
}

function Frs_FBLASTWEEKSRESULTS_Match_Generate ($season,$frs_id,$newold) {
	$rstring = "";
	$link = YEXTPGMLINK("frsteamresultdisplay.php").YPGMMINPARMS();
	$link = $link.YPGMPARM("Season",$GLOBALS{'currperiodid'}).YPGMPARM("frs_id",$frs_id);	
	if ($GLOBALS{'frs_ha'} == "A") {
		if ($newold == "New") {
	 		$rstring = $rstring.YLINKTXT($link,"<b>".$GLOBALS{'frs_oppo'}."&nbsp;&nbsp;&nbsp;&nbsp;<big>".$GLOBALS{'frs_ga'}." - ".$GLOBALS{'frs_gf'}."</big>&nbsp;&nbsp;&nbsp;&nbsp;".$GLOBALS{'domain_shortname'}." ".$GLOBALS{'team_name'}."</b>"."<br>");   
		} else {
	 		$rstring = $rstring.YLINKTXT($link,"<b>".$GLOBALS{'frs_oppo'}."&nbsp;&nbsp;&nbsp;&nbsp;<big>".$GLOBALS{'frs_ga'}." - ".$GLOBALS{'frs_gf'}."</big>&nbsp;&nbsp;&nbsp;&nbsp;".$GLOBALS{'domain_shortname'}." ".$GLOBALS{'team_name'}."</b>"); 		
		}
	} else {
		if ($newold == "New") {
			$rstring = $rstring.YLINKTXT($link,"<b>".$GLOBALS{'domain_shortname'}." ".$GLOBALS{'team_name'}."&nbsp;&nbsp;&nbsp;&nbsp;<big>".$GLOBALS{'frs_gf'}." - ".$GLOBALS{'frs_ga'}."</big>&nbsp;&nbsp;&nbsp;&nbsp;".$GLOBALS{'frs_oppo'}."</b>"."<br>");  		
		} else {	 
			$rstring = $rstring.YLINKTXT($link,"<b>".$GLOBALS{'domain_shortname'}." ".$GLOBALS{'team_name'}."&nbsp;&nbsp;&nbsp;&nbsp;<big>".$GLOBALS{'frs_gf'}." - ".$GLOBALS{'frs_ga'}."</big>&nbsp;&nbsp;&nbsp;&nbsp;".$GLOBALS{'frs_oppo'}."</b>");  
		}
	}
	$truncation = "0"; 

	if (($GLOBALS{'frs_report'} != "")||($GLOBALS{'frs_reportheadline'} != "")) {
		if ($GLOBALS{'frs_reportheadline'} != "") {
			$headlinelength = strlen($GLOBALS{'frs_reportheadline'});
			if ($headlinelength > 100 ) {$headline = substr($GLOBALS{'frs_reportheadline'}, 0, 100); $truncation = "1";}
			else {$headline = $GLOBALS{'frs_reportheadline'};}
	 		$rstring = $rstring.$headline;			
		} else {
			$cleanedreport = CleanReportText($GLOBALS{'frs_report'});
			$reportlength = strlen($cleanedreport);
			if ($reportlength > 100 ) {$report = substr($cleanedreport, 0, 100)."\n"; $truncation = "1";}
			else {$report = $cleanedreport."\n";}
		 	if ($newold == "New") { $rstring = $rstring.$report; }
			else { $rstring = $rstring.$report; } 			
		}
	 	if ($newold == "New") { $rstring = $rstring.YLINKTXT($link,"....more")."<br><br>"; }
		else { $rstring = $rstring.YLINKTXT($link,"....more")."\n"; }		
			
	} else {
		if ($newold == "New") { $rstring = $rstring."<br>"; }
		else { $rstring = $rstring."\n"; }	
	}	
	return $rstring;
}


function Frs_FBNEXTWEEKSSCHEDULE_Output($season) {
	$GLOBALS{'LOGIN_frame_id'} = "F";
	$newfbstring = "<br>\n";
	$oldfbstring = "\n";
	date_default_timezone_set('Europe/London');
	$day = date("D");
	$satoffsetdays = array("Mon"=> 5, "Tue"=> 4,  "Wed"=> 3,  "Thu"=> 2,  "Fri"=> 1,  "Sat"=> 0,  "Sun"=> -1);
	$sunoffsetdays = array("Mon"=> 6, "Tue"=> 5,  "Wed"=> 4,  "Thu"=> 3,  "Fri"=> 2,  "Sat"=> 1,  "Sun"=> 0);
	$now = time();
	$secs_in_day = (3600 * 24); # seconds in hour * 24
	$satdays_hence = $now + ($satoffsetdays[$day] * $secs_in_day);
	$sundays_hence = $now + ($sunoffsetdays[$day] * $secs_in_day);

	$tarr = localtime($satdays_hence, true);
	$datedd = substr("00".strval($tarr["tm_mday"]), -2);
	$datemm = substr("00".strval($tarr["tm_mon"]+1), -2);
	$dateyyyy = strval($tarr["tm_year"]+1900);
	$satdate = $dateyyyy."-".$datemm."-".$datedd;
	$newfbstring = $newfbstring.Frs_FBDATESCHEDULE_Output($season, $satdate, "Saturday","New");
	$oldfbstring = $oldfbstring.Frs_FBDATESCHEDULE_Output($season, $satdate, "Saturday","Old");
	$tarr = localtime($sundays_hence, true);
	$datedd = substr("00".strval($tarr["tm_mday"]), -2);
	$datemm = substr("00".strval($tarr["tm_mon"]+1), -2);
	$dateyyyy = strval($tarr["tm_year"]+1900);
	$sundate = $dateyyyy."-".$datemm."-".$datedd;
	$newfbstring = $newfbstring.Frs_FBDATESCHEDULE_Output($season, $sundate, "Sunday","New");
	$oldfbstring = $oldfbstring.Frs_FBDATESCHEDULE_Output($season, $sundate, "Sunday","Old");

	XH1("Facebook - Upcoming Fixtures");
	XHR();
	XH2("If you have the New Version of the Facebook Note App");
	$imagelink = $GLOBALS{'site_asseturl'}."/NewFaceBookNote.jpg";
	XIMGFLEX($imagelink);
	XPTXT('Copy and Paste the following where you see "write something"');
	XPTXT('(This only seems to work properly using Firefox or Chrome browser !!  )');
	XBR();
	XTABLE();
	print '<table width="850" border="1">'."\n";
	print '<tr>'."\n";
	XTD();
	print $newfbstring;
	XBR();
	X_TD();X_TR();
	X_TABLE();
	XBR();
	XHR();XBR();
	
	XH2("If you have the Old Version of the Facebook Note App");
	$imagelink = $GLOBALS{'site_asseturl'}."/OldFaceBookNote.jpg";
	XIMGFLEX($imagelink);
	XPTXT("Copy and Paste the following into the note textbox");
	XBR();
	XTEXTAREA("candptext","30","130");
	print $oldfbstring;
	X_TEXTAREA();
	XBR();
	XHR();XBR();
}

function Frs_FBDATESCHEDULE_Output($season, $date, $day, $newold) {
	$rstring = "";
	if ($newold == "New") {	$rstring = $rstring."<h1>"."Fixture Schedule for ".$day." ".YYYY_MM_DDtoDDsMMsYY($date)."</h1>\n";} 
	else {$rstring = $rstring."<big><big>"."Fixture Schedule for ".$day." ".YYYY_MM_DDtoDDsMMsYY($date)."</big></big>\n\n";	}
	$hfa = Array();
	$uhfa = Array();
	$hva = Array();
	$afa = Array();
	$fixturesfound = "0";
	$earliesthomeslot = "99:99"; $latesthomeslot = "00:00";
	foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $section_name)  {
		Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
		$teamsarray = explode(',',$GLOBALS{'section_teams'});
		foreach ($teamsarray as $team_code)  {
			$dirfiles = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
			foreach ($dirfiles as $frs_id)  {
				$fixturesfound = "1";
				$bits = str_split($frs_id);
				$fileyymmdd = $bits[2].$bits[3].$bits[4].$bits[5].$bits[6].$bits[7];
				$bits = str_split($date);
				$checkyymmdd = $bits[2].$bits[3].$bits[5].$bits[6].$bits[8].$bits[9];
				if ($fileyymmdd == $checkyymmdd) {
					Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
					$ttime1 = $GLOBALS{'frs_time'};
					$ttime1 = str_replace(':', "", $ttime1);
					$ttime1 = str_replace('.', "", $ttime1);
					$ttime1 = str_replace('-', "", $ttime1);
					$ttime1 = str_replace(' ', "", $ttime1);
					if (strlen($ttime1) == 3) {
						$ttime1 = "0".$ttime1;
					}
					if ($ttime1 == "") {
						$ttime1 = "?";
					}
					else {$ttime1 = substr($ttime1,0,2).":".substr($ttime1,2,2);
					}

					if ($GLOBALS{'frs_ha'} == "H") {
						$newvenue = "1";
						foreach ($hva as $hv)  {
							if ($GLOBALS{'frs_venue'} == $hv) {
								$newvenue = "0";
							}
						}
						if ($newvenue == "1") {
							array_push($hva, $GLOBALS{'frs_venue'});
						}
						if ($ttime1 != "?") {
							array_push($hfa, $ttime1."#".$frs_id."#".$GLOBALS{'frs_venue'});
							if ($ttime1 < $earliesthomeslot) {
								$earliesthomeslot = $ttime1;
							}
							if ($ttime1 > $latesthomeslot) {
								$latesthomeslot = $ttime1;
							}
						} else {
							array_push($uhfa, $ttime1."#".$frs_id."#".$GLOBALS{'frs_venue'});
						}
					}

					if ($GLOBALS{'frs_ha'} == "A") {
						array_push($afa, $ttime1."#".$frs_id);
					}
				}
			}
		}
	}
	if ($newold == "New") {	$rstring = $rstring."<h2>"."Home Fixtures"."</h2>\n";} 
	else {	$rstring = $rstring."<big><big>"."Home Fixtures"."</big></big>\n\n";}
	if(empty($hfa)){
		if ($newold == "New") {	$rstring = $rstring."<p>"."No home fixtures have been found for this date"."</p>\n";} 
		else {$rstring = $rstring."<big>"."No home fixtures have been found for this date"."</big>\n\n";}	
	} else {
		sort($hfa);
		foreach ($hfa as $hf)  {
			$bits = explode('#',$hf);
			$ttime = $bits[0];
			$frs_id = $bits[1];
			$bits = str_split($frs_id);
			$tteam_code = $bits[0].$bits[1];
			Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$frs_id);
			Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
			$tteam_name = $GLOBALS{'team_name'};
			$matchline = $ttime." ".$GLOBALS{'team_name'}." v ".$GLOBALS{'frs_oppo'}." - ".$GLOBALS{'frs_venue'};
			$link = YEXTPGMLINK("frsteamselectiondisplay.php").YPGMMINPARMS();
			$link = $link.YPGMPARM("Season",$GLOBALS{'currperiodid'}).YPGMPARM("team_code",$tteam_code);
			if ($newold == "New") {	$rstring = $rstring.YLINKTXT($link,$matchline)."<br>"; }
			else {	$rstring = $rstring.YLINKTXT($link,$matchline); }
		}
	}

	if(empty($uhfa)){
	} else {
		if ($newold == "New") {	$rstring = $rstring."<h2>"."Home Fixtures not yet scheduled"."</h2>\n";	} 
		else {$rstring = $rstring."<big>"."<big><big>"."Home Fixtures not yet scheduled"."</big></big>\n\n";}
		sort($uhfa);
		foreach ($uhfa as $uhf)  {
			$bits = explode('#',$uhf);
			$ttime = $bits[0];
			$frs_id = $bits[1];
			$bits = str_split($frs_id);
			$tteam_code = $bits[0].$bits[1];
			Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$frs_id);
			Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
			$tteam_name = $GLOBALS{'team_name'};
			$matchline = $ttime." ".$GLOBALS{'team_name'}." v ".$GLOBALS{'frs_oppo'}." - ".$GLOBALS{'frs_venue'};
			$link = YEXTPGMLINK("frsteamselectiondisplay.php").YPGMMINPARMS();
			$link = $link.YPGMPARM("Season",$GLOBALS{'currperiodid'}).YPGMPARM("team_code",$tteam_code);
			if ($newold == "New") {	$rstring = $rstring.YLINKTXT($link,$matchline)."<br>"; }
			else {	$rstring = $rstring.YLINKTXT($link,$matchline); }
		}
	}
	
	if ($newold == "New") {	$rstring = $rstring."<h2>"."Away Fixtures"."</h2>\n";} 
	else {	$rstring = $rstring."<big><big>"."Away Fixtures"."</big></big>\n\n";}
	if(empty($afa)){
		if ($newold == "New") {	$rstring = $rstring."<p>"."No away fixtures have been found for this date"."</p>\n";} 
		else {$rstring = $rstring."<big>"."No away fixtures have been found for this date"."</big>\n\n";}
	} else {
		sort($afa);
		foreach ($afa as $af)  {
			$bits = explode('#',$af);
			$ttime = $bits[0];
			$frs_id = $bits[1];
			$bits = str_split($frs_id);
			$tteam_code = $bits[0].$bits[1];
			Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$frs_id);
			Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
			$tteam_name = $GLOBALS{'team_name'};
			$matchline = $ttime." ".$GLOBALS{'team_name'}." v ".$GLOBALS{'frs_oppo'}." - ".$GLOBALS{'frs_awayvenue'};
			$link = YEXTPGMLINK("frsteamselectiondisplay.php").YPGMMINPARMS();
			$link = $link.YPGMPARM("Season",$GLOBALS{'currperiodid'}).YPGMPARM("team_code",$tteam_code);
			if ($newold == "New") {	$rstring = $rstring.YLINKTXT($link,$matchline)."<br>"; }
			else {	$rstring = $rstring.YLINKTXT($link,$matchline); }
		}
	}
	return $rstring;
}
function Go_Back_To_FSRU_Menu() {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS.YPGMPARM("SelectId","FRSUPDATEMENU");		
	XLINKTXT($link,"<< Fixtures, Results and Selection Menu");
}

function Frs_FRSUPDATEMENU_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepickerYYYYMMDD";		
}

function Frs_FRSUPDATEMENU_Output() {
	XH3("Fixtures, Results and Selection Menu - ".$GLOBALS{'currperiodid'});
	
	XFORM("frsupdatemenuin.php","frsmenu");
	XINSTDHID();
	Get_Person_Authority();	
	if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionLeader="))>0) { $ssauthorised = "1"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionRM="))>0) { $ssauthorised = "1"; }	
	if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain#,"))>0) { $ssauthorised = "1"; }	
	if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain#,"))>0) { $ssauthorised = "1"; }	

	BTABHEADERCONTAINER();
	BTABHEADERITEMACTIVE("Team","Update a specific Team");
	BTABHEADERITEM("Section","Update by Club Section");
	B_TABHEADERCONTAINER();
	
	BTABCONTENTCONTAINER();
	BTABCONTENTITEMACTIVE("Team");
	XTABLE();	
	XTR();XTH();
	$teamlist = Array();
	foreach (Get_Array_Hash('team',$GLOBALS{'currperiodid'}) as $tteam_code)  {	
		Get_Data_Hash('team',$GLOBALS{'currperiodid'},$tteam_code);
		array_push($teamlist,$GLOBALS{'team_seq'}."|".$tteam_code);
	}	
	print '<SELECT NAME="TeamCode">'."\n";
	print '<OPTION VALUE="" SELECTED>Select Team</OPTION>'."\n";
	foreach ($teamlist as $teamlistelement)  {
		$tbits = explode('|',$teamlistelement);
		$authorised = "0";
		if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamCaptain="))>0) { $authorised = "1"; } 
		if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamMgr="))>0) { $authorised = "1"; }	  
		if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamCoach="))>0) { $authorised = "1"; } 
		if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamRM="))>0) { $authorised = "1"; }	
		if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionLeader="))>0) { $authorised = "1"; } 
		if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionRM="))>0) { $authorised = "1"; }
		if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain#,"))>0) { $authorised = "1"; } 
		if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain#,"))>0) { $authorised = "1"; }				    
		if ($authorised == "1") { 
		    Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tbits[1]);   
		  	print'<OPTION VALUE="'.$tbits[1].'">'.$GLOBALS{'team_name'}.'</OPTION>'."\n"; 
		}
	}
	print"</SELECT>\n";
	X_TH();
	XTDHTXT("");
	X_TR();
	XTR();XTDTXT("Team results for recent matches");XTDINRADIO("SelectId","TR","","");X_TR();
	XTR();XTDTXT("Team fixture list");XTDINRADIO("SelectId","TA","","");X_TR();
	XTR();XTDTXT("Fixture Card Page");XTDINRADIO("SelectId","TF","","");X_TR();	
	X_TABLE();
	B_TABCONTENTITEM();
	
	if ($ssauthorised == "1") {
		BTABCONTENTITEM("Section");;
		XTABLE();	
		XTR();XTH();
		print'<SELECT NAME="Section">';print"\n";
		print'<OPTION VALUE="" SELECTED>Select Subsection</OPTION>'."\n";
		$authorised = "0";
		foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $tsection_name)  {
		  	if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionLeader="))>0) { $authorised = "1"; } 
			if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionRM="))>0) { $authorised = "1"; }
			if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain#,"))>0) { $authorised = "1"; } 
			if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain#,"))>0) { $authorised = "1"; }		   
			if ($authorised == "1") { 
				print'<OPTION VALUE="'.$tsection_name.'">'.$tsection_name.'</OPTION>'."\n";
			}
		}
		print"</SELECT>\n";
		X_TH();
		XTDHTXT("");
		X_TR();
		XTR();XTDTXT("Club results for last week");XTDINRADIO("SelectId","CR","","");
		X_TR();X_TABLE();
		B_TABCONTENTITEM();
	}
	
	BTABCONTENTCONTAINER();;
	XINSUBMIT("Go");
	X_FORM();
}

function Frs_TEAMFIXTURESUPDATE_Output($season, $team_code) {
	$frsa = Get_Array('frs',$season, $team_code);
	Get_Data("team",$season,$team_code);
	XH1("Match Fixtures Update- ".$GLOBALS{'team_name'});
	XFORM("frsteamfixturesaddin.php","frsfixtureadd");
	XINSTDHID();	
	XINHID('season',$season);
	XINHID('team_code',$team_code);	
	XTABLE();
	XTR();
	XTDHTXT("Date");XTDHTXT("Seq");XTDHTXT("Opposition");XTDHTXT("H/A");XTDHTXT("Lg/<br>Cup/<br>Fr");XTDHTXT("Venue");
	XTDHTXT("Time<br> eg 14:30");XTDHTXT("Time End<br>(optional)");XTDHTXT("Info");
	XTDHTXT("");XTDHTXT("Update");XTDHTXT("Delete");
	X_TR();
	$fixturesfound = "0";
	foreach ($frsa as $frsid)  {
		$fixturesfound = "1";
		$bits = explode('.', $frsid );
		$frs_id = $bits[0];
		Get_Data("frs",$season,$team_code,$frs_id);
		XTR();
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
		XTDTXT($GLOBALS{'frs_seq'});
		$tclublink = "";
		if ($GLOBALS{'frs_oppoteamkey'} != "") {
			$teamsplit = explode('^', $GLOBALS{'frs_oppoteamkey'} );
			$oppoclub_name = $teamsplit[0]; $oppoteam_name = $teamsplit[1];
			Check_Data('oppoclub',$oppoclub_name);
			if ($GLOBALS{'IOWARNING'} == "0") {
				Get_Data('oppoclub',$oppoclub_name); $tclublink = $GLOBALS{'oppoclub_link'};
			}
		}
		if ($tclublink != "") {
			XTDLINKTXT("http://$tclublink",$GLOBALS{'frs_oppo'});
		}
		else {XTDTXT($GLOBALS{'frs_oppo'});
		}
		XTDTXT($GLOBALS{'frs_ha'});
		XTDTXT($GLOBALS{'frs_lcf'});
		if ($GLOBALS{'frs_ha'} == "H") {
			Check_Data('venue',$GLOBALS{'frs_venue'});
			if ($GLOBALS{'IOWARNING'} == "0" ) {
				XTDTXT($GLOBALS{'venue_name'});
			}
			else { 
				XTDTXT($GLOBALS{'frs_venue'});
			}
		}
		if ($GLOBALS{'frs_ha'} == "A") {
			XTDTXT($GLOBALS{'frs_awayvenue'});
		}
		if (($GLOBALS{'frs_ha'} != "A")&&($GLOBALS{'frs_ha'} != "H")) {
			XTDTXT("");
		}		
		/*
		$tvenue_name = ""; $tvenue_link = ""; $tempvenuetxt = "";
		if ($GLOBALS{'frs_venue'} != "") {
			Get_Data_Hash('venue',$GLOBALS{'frs_venue'});
			if ($GLOBALS{'IOWARNING'} == "0") {
				$tvenue_name = $GLOBALS{'venue_name'};
				$tvenue_link = "http://".$GLOBALS{'venue_link'};
				$tempvenuetxt = $tvenue_name; # temp nasty
			}
			else { $tvenue_name = $GLOBALS{'frs_venue'};
			$tempvenuetxt = $tvenue_name; # temp nasty
			}
		}		
		if (($GLOBALS{'frs_netvenueref'} != "")&&($tvenue_link == "")) {
			if (ExtractNetRef($GLOBALS{'frs_netvenueref'},0) == "LOCAL") {
				$tvenue_code = ExtractNetRef($GLOBALS{'frs_netvenueref'},1);
				Get_Data_Hash('venue',$tvenue_code);
				$tvenue_name = $GLOBALS{'venue_name'};
				$tvenue_link = "http://".$GLOBALS{'venue_link'};
			}
			else {
				$tvenue_name = &Network_Venue_Name($oppoclub_name, $GLOBALS{'frs_netvenueref'});
				$tvenue_link = &Network_Venue_Link($oppoclub_name, $GLOBALS{'frs_netvenueref'});
			}
		}
		# if ($tvenue_link != "") {XTDLINKTXT($tvenue_link,$tvenue_name);} else {XTDTXT($tvenue_name);};
		XTDTXT($tempvenuetxt); # temp nasty
		*/
		
		XTDTXT($GLOBALS{'frs_time'});
		XTDTXT($GLOBALS{'frs_timeend'});		
		XTDTXT($GLOBALS{'frs_info'});
		if ($GLOBALS{'frs_cancellation'} == "Yes") { $cancelled = '<span style="color:red"><b>Cancelled</b></span>';	} 
		else {$cancelled = "";} 
		XTDTXT($cancelled);
		$link = YPGMLINK("frsteamfixtureupdateout.php").YPGMSTDPARMS();
		$link = $link.YPGMPARM("season",$season).YPGMPARM('team_code',$team_code).YPGMPARM("frs_id",$frs_id);
		XTDLINKTXT($link,"update");
		$link = YPGMLINK("frsteamfixturedeleteconfirm.php").YPGMSTDPARMS();
		$link = $link.YPGMPARM("season",$season).YPGMPARM('team_code',$team_code).YPGMPARM("frs_id",$frs_id);
		XTDLINKTXT($link,"delete");
		X_TR();
	}
	XTR();
	XTDHTXT("Date");XTDHTXT("Seq");XTDHTXT("Opposition");XTDHTXT("H/A");XTDHTXT("Lg/<br>Cup/<br>Fr");XTDHTXT("Venue");
	XTDHTXT("Time<br> eg 14:30");XTDHTXT("Info");
	XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");
	X_TR();

	for ( $formseq=1; $formseq<21; $formseq++) {
		XTR();
		XTDINDATEYYYY_MM_DD('frs_date'.$formseq, "");
		XTDINTXT('frs_seq'.$formseq,"","1","2");
		XTDINTXT('frs_oppo'.$formseq,"","20","30");	
		XTDINSELECTHASH(List2Hash("H,A"),'frs_ha'.$formseq,"");
		XTDINSELECTHASH(List2Hash("L,C,F"),'frs_lcf'.$formseq,"");
		XTD();
		$xhash = Get_SelectArrays_Hash ("venue","venue_code","venue_name","venue_code","","" );
		XTXT("Home:");XINSELECTHASH($xhash,'frs_venue'.$formseq,"");XBR();
		XTXT("Away:");XINTXT('frs_awayvenue'.$formseq,"","30","60");
		X_TD();
		XTDINTXT('frs_time'.$formseq,"","5","8");
		XTDINTXT('frs_timeend'.$formseq,"","5","8");				
		XTDINTXT('frs_info'.$formseq,"","5","8");			
		XTDTXT("");XTDTXT("");XTDTXT("");
		X_TR();
	};
	X_TABLE();
	XBR();
	XINSUBMIT("Add Fixtures");
	X_FORM();
}

function Frs_TEAMFIXTUREDELETECONFIRM_Output($season, $team_code, $frs_id) {
	Get_Data('team', $season, $team_code);
	Get_Data('frs', $season, $team_code, $frs_id);
	XH2($GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' - '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));	
	XPTXT("Are you sure you want to delete this fixture");
	XBR();
	XFORM("frsteamfixturedeleteaction.php","deletefixture");
	XINSTDHID();
	XINHID("season",$season);	
	XINHID("team_code",$team_code);
	XINHID("frs_id",$frs_id);
	XINSUBMIT("Confirm Fixture Deletion");
	X_FORM();
	XBR();
	XINBUTTONBACK("Cancel");
}

function Frs_TEAMFIXTUREUPDATE_Output($season, $team_code, $frs_id) {
	Get_Data('team', $season, $team_code);
	Get_Data('frs', $season, $team_code, $frs_id);
	XH2($GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' - '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
	XFORM("frsteamfixtureupdatein.php","deletefixture");
	XINSTDHID();
	XINHID("season",$season);
	XINHID("team_code",$team_code);
	XINHID("frs_id",$frs_id);
	XTABLE();
	XTR();XTDTXT("Seq");XTDINTXT('frs_seq',$GLOBALS{'frs_seq'},"1","2");X_TR();
	XTR();XTDTXT("Opposition");XTDINTXT('frs_oppo',$GLOBALS{'frs_oppo'},"20","30");X_TR();
	XTR();XTDTXT("Home/Away");XTDINSELECTHASH(List2Hash("H,A"),'frs_ha',$GLOBALS{'frs_ha'});X_TR();XBR();
	XTR();XTDTXT("League/Cup/Friendly");XTDINSELECTHASH(List2Hash("L,C,F"),'frs_lcf',$GLOBALS{'frs_lcf'});X_TR();
	XTR();XTDTXT("Venue");
	XTD();
	if ($GLOBALS{'frs_ha'} == "H") {
		$xhash = Get_SelectArrays_Hash ("venue","venue_code","venue_name","venue_code","","" );
		XTXT("Home:");XINSELECTHASH($xhash,'frs_venue',$GLOBALS{'frs_venue'});
	}
	if ($GLOBALS{'frs_ha'} == "A") {
		XTXT("Away:");XINTXT('frs_awayvenue',$GLOBALS{'frs_awayvenue'},"30","60");
	}	
	X_TD();	
	X_TR();
	XTR();XTDTXT("Time - eh 14:30");XTDINTXT('frs_time',$GLOBALS{'frs_time'},"5","8");X_TR();
	XTR();XTDTXT("Time End (optional)");XTDINTXT('frs_timeend',$GLOBALS{'frs_timeend'},"5","8");X_TR();	
	XTR();XTDTXT("Info");XTDINTXT('frs_info',$GLOBALS{'frs_info'},"5","8");X_TR();	
	X_TABLE();
	XBR();
	XINSUBMIT("Update Fixture");
	X_FORM();
}

function Frs_FRSSELECTIONSUMMARYMENU_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepickerYYYYMMDD";	
}

function Frs_FRSSELECTIONSUMMARYMENU_Output( $season, $section_name ) {
	if ( $section_name != "all" ) { XH2("Availability and Selection Summary for ".$section_name." section"); }
	else { XH2("Availability and Selection Summary"); } 
	Get_Person_Authority();	
	if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionLeader="))>0) { $ssauthorised = "1"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionRM="))>0) { $ssauthorised = "1"; }	
	if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain#,"))>0) { $ssauthorised = "1"; }	
	if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain#,"))>0) { $ssauthorised = "1"; }

	XFORM("frsselectionsummaryout.php","frsselectionsummaryout");
	XINSTDHID();
	XINHID("Season",$season);
	XTABLE();	
	if ( $section_name != "all" ) { 
		XINHID("Section",$section_name);
	} else {	
		XTR();XTDTXT("Section");
		XTD();
		print'<SELECT NAME="Section">';print"\n";
		print'<OPTION VALUE="" SELECTED>Select Subsection</OPTION>'."\n";
		$authorised = "0";
		foreach (Get_Array_Hash_SortSelect("section",$season,"section_seq","section_frs","Yes") as $tsection_name)  {
		  	if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionLeader="))>0) { $authorised = "1"; } 
			if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionRM="))>0) { $authorised = "1"; }
			if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain#,"))>0) { $authorised = "1"; } 
			if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain#,"))>0) { $authorised = "1"; }
			Get_Data("section",$season,$tsection_name);
			if ($GLOBALS{'section_showdateavailability'} != "Yes") { $authorised = "0"; }		   
			if ($authorised == "1") { 
				print'<OPTION VALUE="'.$tsection_name.'">'.$tsection_name.'</OPTION>'."\n";
			}
		}
		print"</SELECT>\n";	
		X_TD();X_TR();
	}	
	XTR();XTDTXT("date - dd/mm/yyyy");XTDINDATEYYYY_MM_DD("SelectionDate","");X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
	
}

function Frs_FRSSELECTIONSUMMARY_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";		
}

function Frs_FRSSELECTIONSUMMARY_Output( $season, $section_name, $selectiondate ) {

	// XPTXTCOLOR("Beta Version - This function is still under development","red");
	// XPTXTCOLOR("future 'update' function (not currently enabled) will allow player/umpire status to be changed","red"  );	
	XH2("Availability and Selection Summary for ".YYYY_MM_DDtoDDsMMsYY($selectiondate)." - ".$section_name." section" );

	/*	
	// This is the popup version.. problem with global variables	
	XHR();
	XH2("Show player availability and selection");
	XINHID("Season",$season);	
	XINHID("SectionName",$section_name);	
	XINHID("SelectionDate",$selectiondate);
	XINHIDID("SelectionPersonId","SelectionPersonId","");	
	XTABLE();
	XTR();XTDTXT("Step 1: Enter Name or Part Name");
	XTD();
	XINTXTID("person_fname_presearch","person_fname_presearch","","20","30");XTXT("First Name");XBR();
	XINTXTID("person_sname_presearch","person_sname_presearch","","20","30");XTXT("Surname");	
	X_TD();
	X_TR();
	XTR();XTDTXT("Step 2: Lookup");XTD(); XINBUTTONIDSPECIAL("Lookup","info","Lookup"); X_TD();X_TR();	
	XTR();XTDTXT("Step 3: Check Name");XTD();XTXTID("SelectionPersonName","");X_TD();X_TR();
	XTR();XTDTXT("Step 4: ");XTD();XINBUTTONID("ShowButton","Show Availability and Selection");X_TD();X_TR();
	X_TABLE();
	*/
	XHR();
	XH2("Show player availability and selection");
	XFORMNEWWINDOW("personplayoffstatusout.php","playoffstatus","playoffstatus");
	XINSTDHID();
	XINHID("Season",$season);
	XINHID("SectionName",$section_name);
	XINHID("SelectionDate",$selectiondate);
	XINHIDID("SelectionPersonId","SelectionPersonId","");
	XTABLE();
	XTR();XTDTXT("Step 1: Enter Name or Part Name");
	XTD();
	XINTXTID("person_fname_presearch","person_fname_presearch","","20","30");XTXT("First Name");XBR();
	XINTXTID("person_sname_presearch","person_sname_presearch","","20","30");XTXT("Surname");
	X_TD();
	X_TR();
	XTR();XTDTXT("Step 2: Lookup");XTD(); XINBUTTONIDSPECIAL("Lookup","info","Lookup"); X_TD();X_TR();
	XTR();XTDTXT("Step 3: Check Name");XTD();XTXTID("SelectionPersonName","");X_TD();X_TR();
	XTR();XTDTXT("Step 4: ");XTDINSUBMIT("Show Availability and Selection");X_TR();
	X_TABLE();
	X_FORM();
	
	
	$teamseqa = Array();
	$teamsquadlista = Array();
	$teamsa = Get_Array('team',$GLOBALS{'currperiodid'});
	foreach ($teamsa as $tteam_code) {
		Get_Data('team',$GLOBALS{'currperiodid'},$tteam_code);
		$teamseqa[$tteam_code] = $GLOBALS{'team_seq'};
		$teamsquadlista[$tteam_code] = $GLOBALS{'team_squadlist'};
	}
	
	$personavailabilitya = Array();  // dateavailability|selected|lowestsquadseq|squadlist
	$personselectedmatcha = Array(); // count
	$persona = Get_Array('person');
	foreach ($persona as $personid) {
		Get_Data('person',$personid);
		$availabilitya = GetDateAvailability('person_dateavailability',$selectiondate);
		$exclude = "0";
		// XPTXT($personid." - ".$availabilitya[0]);
		if ($availabilitya[0] == "N") { $exclude = "1"; }
		if (($availabilitya[0] == "")&&($GLOBALS{'person_activeplayer'} != "Yes")) { $exclude = "1"; }
	 	if (Frs_GetMySquadListHash($teamsquadlista,$personid) != "")  { 
	 		$exclude = "0";
			if ($GLOBALS{'person_activeplayer'} != "Yes") {
				$GLOBALS{'person_activeplayer'} = "Yes";
				Write_Data('person',$personid);
			}
	 	}
		$person_section = $GLOBALS{'person_section'}.",";	 	
	 	if (strlen(strstr($person_section,$section_name.","))>0) {} else { $exclude = "1"; } 	 	
		if ( $exclude != "1" ) { 
			$personavailabilitya[$personid] = $availabilitya[0].'|'."".'|'."999".'|'.Frs_GetMySquadListHash($teamsquadlista,$personid); 
		} 
	}	

	/*
	foreach ($personavailabilitya as $key => $value) {
		// dateavailability|selected|lowestsquadseq|squadlist
		$availabilitystring = $personavailabilitya[$key];
		XPTXT($key."=".$availabilitystring);
	}	
	*/
	
	$thisYYMMDD = YYYY_MM_DDtoYYMMDD($selectiondate);
	Get_Data("section",$season,$section_name);
	$teamsarray = explode (',',$GLOBALS{'section_teams'});
	foreach ($teamsarray as $team_code)  {
		Get_Data("team",$season,$team_code);
		$frsa = Get_Array("frs",$season,$team_code);
		foreach ($frsa as $frs_id) {
			if (( substr($frs_id,0,2)== $team_code )&&( substr($frs_id,2,6)== $thisYYMMDD )) {		
				Get_Data("frs",$season,$team_code, $frs_id);
				XHR();
				XH2($GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' - '.YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
				XH3('Squad Players');					
				XTABLE();
				XTR();XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Age");XTDHTXT("Email");XTDHTXT("Mobile");XTDHTXT("Position");XTDHTXT("ShirtNo");XTDHTXT("Planned");
				XTDHTXT("Available");XTDHTXT("Selected");XTDHTXT("Notified");XTDHTXT("Confirmed");XTDHTXT("Travel");X_TR();		
				$squada = explode(',',$GLOBALS{'team_squadlist'});
				foreach ($squada as $personid)  {
					Check_Data('person',$personid);
					if ($GLOBALS{'IOWARNING'} == "0") {
						XTR();XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
						$underage = UnderAge(18,$GLOBALS{'person_dob'});
						if ($underage) {
							XTDTXT(Age($GLOBALS{'person_dob'},19));
						}
						else { XTDTXT("");
						}
						XTDTXT(Chosen_Person_Email());
						XTDTXT(Chosen_Person_SMS());
						XTDTXT($GLOBALS{'person_position'});
						XTDTXT($GLOBALS{'person_shirtnumber'});
						XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'planned')));
						XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'availability')));
						if (GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y" ) {
							XTDTXT("<b>".SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'selected'))."</b>");
						} else {
							XTDTXT("");
						}
						if ( SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'notified')) == "Yes" ) {
							$link = YPGMLINK("notificationlogout.php");
							$link = $link.YPGMSTDPARMS().YPGMPARM("NotificationType","TeamSelection").YPGMPARM("NotificationEventId",$frs_id).YPGMPARM("NotificationPersonId",$personid);
							XTDLINKTXTNEWWINDOW($link,"Yes","Notifications");
						} else {
							XTDTXT("");
						}
						XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'confirmed')));
						XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'travel')));
						X_TR();
						if (array_key_exists($personid,$personavailabilitya)) {
							$availabilitystring = $personavailabilitya[$personid];
							// XPTXT($personid."=".$availabilitystring);
							$availabilitya = explode('|',$availabilitystring);
							if (GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y" ) {
								$availabilitya[1] = "Y";
								$personselectedmatcha[$personid] = $personselectedmatcha[$personid].$frs_id."|";
							}
							// dateavailability|selected|lowestsquadseq|squadlist
							$personavailabilitya[$personid] = $availabilitya[0].'|'.$availabilitya[1].'|'.$availabilitya[2].'|'.$availabilitya[3];
						}
					}
				}
				X_TABLE();	

				
				$nonsquadcount = 0;
				$selectedplayera = GetSelectionListPersonIds ('frs_playerselectedlist',"all","");
				foreach ($selectedplayera as $selectedplayerid)  {
					if (in_array($selectedplayerid, $squada)) {
					}
					else { $nonsquadcount++;
					}
				}
				
				if ( $nonsquadcount > 0 ) {
					XH3('Non Squad Players');
					XTABLE();
					XTR();XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Age");XTDHTXT("Email");XTDHTXT("Mobile");XTDHTXT("Position");XTDHTXT("ShirtNo");XTDHTXT("Planned");
					XTDHTXT("Available");XTDHTXT("Selected");XTDHTXT("Notified");XTDHTXT("Confirmed");XTDHTXT("Travel");X_TR();
					$selectedplayera = GetSelectionListPersonIds ('frs_playerselectedlist',"all","");
					foreach ($selectedplayera as $selectedplayerid)  {
						if (in_array($selectedplayerid, $squada)) {
						}
						else {
							$personid = $selectedplayerid;
							Check_Data('person',$personid);
							if ($GLOBALS{'IOWARNING'} == "0") {
								XTR();XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
								$underage = UnderAge(18,$GLOBALS{'person_dob'});
								if ($underage) {
									XTDTXT(Age($GLOBALS{'person_dob'},19));
								}
								else { XTDTXT("");
								}
								XTDTXT(Chosen_Person_Email());
								XTDTXT(Chosen_Person_SMS());
								XTDTXT($GLOBALS{'person_position'});
								XTDTXT($GLOBALS{'person_shirtnumber'});
								XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'planned')));
								XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'availability')));
								if (GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y" ) {
									XTDTXT("<b>".SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'selected'))."</b>");
								} else {
									XTDTXT("");
								}								
								if ( SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'notified')) == "Yes" ) {
									$link = YPGMLINK("notificationlogout.php");
									$link = $link.YPGMSTDPARMS().YPGMPARM("NotificationType","TeamSelection").YPGMPARM("NotificationEventId",$frs_id).YPGMPARM("NotificationPersonId",$personid);
									XTDLINKTXTNEWWINDOW($link,"Yes","Notifications");
								} else {
									XTDTXT("");
								}
								XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'confirmed')));
								XTDTXT(SelectionTitle(GetSelectionList('frs_playerselectedlist',$personid,'travel')));
								X_TR();
								
								if (GetSelectionList('frs_playerselectedlist',$personid,'selected') == "Y" ) {
									if (array_key_exists($personid,$personavailabilitya)) {
										$availabilitystring = $personavailabilitya[$personid];
										$availabilitya = explode('|',$availabilitystring);
										$availabilitya[1] = "Y";
										// dateavailability|selected|lowestsquadseq|squadlist
										$personavailabilitya[$personid_id] = $availabilitya[0].'|'.$availabilitya[1].'|'.$availabilitya[2].'|'.$availabilitya[3];
									}							
								}
							}
						}
					}
					X_TABLE();
				}				
				
				
				
			}
		}
	}
	XHRCLASS("underline");
	
	$personknownavailabilitydisplaya = Array();
	$personunknownavailabilitydisplaya = Array();	
	foreach ($personavailabilitya as $key => $value) {
		// dateavailability|selected|lowestsquadseq|squadlist
		$availabilitystring = $personavailabilitya[$key];
		// XPTXT($key." ".$availabilitystring);		
		$availabilitya = explode('|',$availabilitystring);
		if (($availabilitya[0] == "Y")&&($availabilitya[1] != "Y")) {
			array_push($personknownavailabilitydisplaya,$availabilitya[2]."|".$key."|".$availabilitya[3]);
		}
		if (($availabilitya[0] == "")&&($availabilitya[1] != "Y")) {
			array_push($personunknownavailabilitydisplaya,$availabilitya[2]."|".$key."|".$availabilitya[3]);
		}
	}	
	sort($personknownavailabilitydisplaya);
	sort($personunknownavailabilitydisplaya);	
	
	XHR();
	XH2("Available - not yet selected");	
	XTABLE();
	XTR();XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Age");XTDHTXT("Email");XTDHTXT("Mobile");XTDHTXT("Position");XTDHTXT("ShirtNo");XTDHTXT("SquadList");XTDHTXT("Active Player");XTDHTXT("Active Umpire");XTDHTXT("Update");X_TR();
	foreach ($personknownavailabilitydisplaya as $element) {
		// dateavailability|selected|lowestsquadseq|squadlist
		$availabilitydisplaya = explode('|',$element);
		$personid = $availabilitydisplaya[1];
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			XTR();XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
			$underage = UnderAge(18,$GLOBALS{'person_dob'});
			if ($underage) {
				XTDTXT(Age($GLOBALS{'person_dob'},19));
			}
			else { XTDTXT("");
			}
			XTDTXT(Chosen_Person_Email());
			XTDTXT(Chosen_Person_SMS());
			XTDTXT($GLOBALS{'person_position'});
			XTDTXT($GLOBALS{'person_shirtnumber'});
			XTDTXT( $availabilitydisplaya[2] );
			XTDTXT( $GLOBALS{'person_activeplayer'} );
			XTDTXT( $GLOBALS{'person_activeofficial'} );	
			$link = YPGMLINK("personplayoffupdatepopupout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("PlayOffUpdatePersonId",$personid);
			XTDLINKTXTNEWPOPUP($link,"update","Update","center","center","800","800");
			
			X_TR();
		}
	}
	X_TABLE();
	
	
	
	XHR();
	XH2("Unknown availabiity - not yet selected");
	XTABLE();
	XTR();XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Age");XTDHTXT("Email");XTDHTXT("Mobile");XTDHTXT("Position");XTDHTXT("ShirtNo");XTDHTXT("SquadList");XTDHTXT("Active Player");XTDHTXT("Active Umpire");XTDHTXT("Update");X_TR();
	foreach ($personunknownavailabilitydisplaya as $element) {
		// dateavailability|selected|lowestsquadseq|squadlist
		$availabilitydisplaya = explode('|',$element);
		$personid = $availabilitydisplaya[1];
		Check_Data('person',$personid);
		if ($GLOBALS{'IOWARNING'} == "0") {
			XTR();XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
			$underage = UnderAge(18,$GLOBALS{'person_dob'});
			if ($underage) {
				XTDTXT(Age($GLOBALS{'person_dob'},19));
			}
			else { XTDTXT("");
			}
			XTDTXT(Chosen_Person_Email());
			XTDTXT(Chosen_Person_SMS());
			XTDTXT($GLOBALS{'person_position'});
			XTDTXT($GLOBALS{'person_shirtnumber'});
			XTDTXT( $availabilitydisplaya[2] );
			XTDTXT( $GLOBALS{'person_activeplayer'} );
			XTDTXT( $GLOBALS{'person_activeofficial'} );	
			$link = YPGMLINK("personplayoffupdatepopupout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("PlayOffUpdatePersonId",$personid);
			XTDLINKTXTNEWPOPUP($link,"update","Update","center","center","800","800");
			X_TR();
		}
	}
	X_TABLE();	
	
	XHR();
	XH2("Selected for multiple matches on ".YYYY_MM_DDtoDDsMMsYY($selectiondate));
	XTABLE();
	XTR();XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("H/A");XTDHTXT("Venue");XTDHTXT("Time");XTDHTXT("Match");X_TR();
	foreach ($personselectedmatcha as $key => $value) {	
		// XPTXT($key." ".$value);
		$frsida = explode('|',$value);
		if (count($frsida) > 2 ) {
			foreach ($frsida as $frsid) {
				if ( $frsid != "" ) {
					Get_Data('person',$key);
					$team_code = substr($frsid,0,2);
					Get_Data("team",$season,$team_code);
					Get_Data("frs",$season,$team_code, $frsid);
					XTR();
					// XTDTXT($GLOBALS{'person_id'});
					XTDTXT($GLOBALS{'person_fname'});
					XTDTXT($GLOBALS{'person_sname'});
					XTDTXT($GLOBALS{'frs_ha'});
					if ($GLOBALS{'frs_ha'} == "H") {
						XTDTXT($GLOBALS{'frs_venue'});
					}
					if ($GLOBALS{'frs_ha'} == "A") {
						XTDTXT($GLOBALS{'frs_awayvenue'});
					}
					XTDTXT($GLOBALS{'frs_time'});
					XTDTXT($GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'});
					X_TR();
				}
			}
			XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
		}
	}
	X_TABLE();
	
    $GLOBALS{'PersonSelectPopupParameters'} = array(
		"this,person_id|person_sname|person_fname|person_section",
		"person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
		"field,Lookup,Select,SelectionPersonId,SelectionPersonName,100",
		"person_id",
		"all",
		"search,center,center,800,600",
	  	"view",
		"singlereplacelist"
	);
}

function SquadlistExpander( ) {

    
    
    
}

function Frs_TEAMREMINDER_CSSJS( ) {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepickerYYYYMMDD";
}

function Frs_TEAMREMINDER_Output( ) {
	XH2("Generate match reminder emails");
	XFORM("frsteamreminderin.php","frsselectionsummaryout");
	XINSTDHID();
	XINHID("Test","Yes");
	XTABLE();
	XTR();XTDTXT("date - dd/mm/yyyy<br>Day before matches.");XTDINDATEYYYY_MM_DD("Date","");X_TR();
	XTR();XTDTXT("Preview generated emails.<br>Do not actually send.");XTD();XINCHECKBOXYESNO("Preview","Yes","");X_TD();X_TR();		
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
}

function Frs_SHIRTNUMBERCHOOSER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqueryconfirm";
}


function Frs_SHIRTNUMBERCHOOSER_Output ($personidlist) {
    
    $thispersonid = $personidlist;
    
    Get_Data("person",$thispersonid);
    if ($GLOBALS{'person_shirtnumber'} != "" ) {
        XPTXTCOLOR("Shirt number ".$GLOBALS{'person_shirtnumber'}." is allocated to you","orange");
    }
    
    XH3("Choose my Shirt Number - ".$personidlist);

    /*
    frsplayernumberset_code
    frsplayernumberset_name
    frsplayernumberset_max
 
    frsplayernumber_setcode
    frsplayernumber_code - shirtnumber
    frsplayernumber_allocationtype
    frsplayernumber_personid
    frsplayernumber_teamcode
    */
    
    
    $shirtmatrixallocationset = Array();
    $shirtmatrixsetcode = Array();
    $shirtmatrixpersonid = Array();
    $shirtmatrixfname = Array();
    $shirtmatrixsname = Array();
    $shirtmatrixteamcode = Array();    
    $shirtmatrixteamname = Array();
    
    $frsplayernumber_codea = Get_Array("frsplayernumber","Club");
    foreach ( $frsplayernumber_codea as $frsplayernumber_code ) {
        Get_Data("frsplayernumber","Club",$frsplayernumber_code);
        $shirtindex = $frsplayernumber_code;        
        $shirtmatrixallocationtype[$shirtindex] = $GLOBALS{'frsplayernumber_allocationtype'};
        $shirtmatrixpersonid[$shirtindex] = $GLOBALS{'frsplayernumber_personid'};
        if ( $GLOBALS{'frsplayernumber_allocationtype'} == "Player" ) {
            Check_Data("person",$GLOBALS{'frsplayernumber_personid'});
            if ($GLOBALS{'IOWARNING'} == "0" ) {
                $shirtmatrixfname[$shirtindex] = $GLOBALS{'person_fname'};
                $shirtmatrixsname[$shirtindex] = $GLOBALS{'person_sname'}; 
            } else {
                $shirtmatrixfname[$shirtindex] = "";
                $shirtmatrixsname[$shirtindex] = "";
            }
        } else {
            $shirtmatrixfname[$shirtindex] = "";
            $shirtmatrixsname[$shirtindex] = "";    
        }
   
        $shirtmatrixteamcode[$shirtindex] = $GLOBALS{'frsplayernumber_teamcode'};
        if ( $GLOBALS{'frsplayernumber_allocationtype'} == "Team" ) {
            Check_Data("team",$GLOBALS{'currperiodid'},$GLOBALS{'frsplayernumber_teamcode'});
            if ($GLOBALS{'IOWARNING'} == "0" ) {
                $shirtmatrixteamname[$shirtindex] = $GLOBALS{'team_name'};
            } else {
                $shirtmatrixteamname[$shirtindex] = "";  
            }  
        } else {
            $shirtmatrixteamname[$shirtindex] = "";           
        }
    }
    
    XDIV("simpletablediv_shirtnumbertable","container");
    XTABLECOMPACTJQDTID("simpletabletable_shirtnumbertable");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("ShirtNo");XTDHTXT("Allocated To:");XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Team");XTDHTXT("Select");XTDHTXT("De-Select");
    X_TR();
    X_THEAD();
    XTBODY();
    
    for ($si = 1; $si <= 999; $si++) {
        if (array_key_exists($si, $shirtmatrixallocationtype)) {
            XTRJQDT();
            XTDTXT($si);XTDTXT($shirtmatrixallocationtype[$si]);XTDTXT($shirtmatrixfname[$si]);XTDTXT($shirtmatrixsname[$si]);XTDTXT($shirtmatrixteamname[$si]);

            if ( $thispersonid == $shirtmatrixpersonid[$si]  ) {
                XTD(); XBUTTONSPECIAL('#',"Allocated to Me",'success'); X_TD();
                $link = YPGMLINK("frsshirtnumberchooserin.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("person_id",$thispersonid).YPGMPARM("frsplayernumber_code",$si).YPGMPARM("action","DeSelect");  
                XTD(); XLINKBUTTONSPECIAL($link,"De-Allocate",'danger'); X_TD();               
            } else {
                XTD(); XLINKBUTTONSPECIAL('#',"Allocated",'warning'); X_TD();
                XTDTXT("");   
            }
            X_TR();
        } else {
            XTRJQDT();
            XTDHTXT($si);XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");
            XTD();
            $link = YPGMLINK("frsshirtnumberchooserin.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("person_id",$thispersonid).YPGMPARM("frsplayernumber_code",$si).YPGMPARM("action","Select");
            XLINKBUTTONSPECIAL($link,"Available",'primary');
            X_TD();
            XTDTXT("");
            X_TR();
            X_TR();
        }        
    }
    
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_shirtnumbertable");
    XCLEARFLOAT();
    XBR();
}

function Frs_SHIRTNUMBERADMIN_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,personselectionpopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Frs_SHIRTNUMBERADMIN_Output ($atype,$arangestart,$arangeend,$apersonid,$ateamcode,$aaction) {
    
    XH3("Shirt Number Administration");
    XPTXT('Note: For validation reasons De-Allocation requests must reverse exactly the original Allocation settings.'); 
    XBR();
    
    XFORM("frsshirtnumberadminin.php","ShirtAdmin");    
    XINSTDHID();
    XTABLE();
    XTR();XTDTXT("Allocation Type"); XTDINRADIOHASH (List2Hash("Player,Team,Reserved"),"AllocationType",$atype); X_TR();
    XTR();XTDTXT("Range Start"); XTDINTXT("AllocationRangeStart",$arangestart,"3","3"); X_TR();
    XTR();XTDTXT("Range End"); XTDINTXT("AllocationRangeEnd",$arangeend,"3","3"); X_TR();
    XTR();XTDTXT("Player");
    XTD();
    XINTXTID("AllocationPersonId","AllocationPersonId",$apersonid,"10","20");
    XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
    XTXTID("AllocationPersonName",View_Person_List(""));
    X_TD();
    X_TR();
    XTR();XTDTXT("Team");XTD();
    $xhash = Get_SelectArrays_Hash ("team",$GLOBALS{'currperiodid'},"team_code","team_name","team_code","","" );
    $xhash[""] = "Not Applicable";
    XINSELECTHASH($xhash,'AllocationTeamcode',$ateamcode);
    X_TD();
    X_TR();
    XTR();XTDTXT("Action"); XTDINRADIOHASH (List2Hash("Allocate,DeAllocate"),"AllocationAction",$aaction); X_TR();
    XTR();XTDTXT(""); XTDINSUBMIT("Go"); X_TR();
    X_TABLE();
    XHR();
    XBR();    
    
    $shirtmatrixallocationset = Array();
    $shirtmatrixsetcode = Array();
    $shirtmatrixpersonid = Array();
    $shirtmatrixfname = Array();
    $shirtmatrixsname = Array();
    $shirtmatrixteamcode = Array();
    $shirtmatrixteamname = Array();
    
    $frsplayernumber_codea = Get_Array("frsplayernumber","Club");
    foreach ( $frsplayernumber_codea as $frsplayernumber_code ) {
        Get_Data("frsplayernumber","Club",$frsplayernumber_code);
        $shirtindex = $frsplayernumber_code;
        $shirtmatrixallocationtype[$shirtindex] = $GLOBALS{'frsplayernumber_allocationtype'};
        $shirtmatrixpersonid[$shirtindex] = $GLOBALS{'frsplayernumber_personid'};
        if ( $GLOBALS{'frsplayernumber_allocationtype'} == "Player" ) {
            Check_Data("person",$GLOBALS{'frsplayernumber_personid'});
            if ($GLOBALS{'IOWARNING'} == "0" ) {
                $shirtmatrixfname[$shirtindex] = $GLOBALS{'person_fname'};
                $shirtmatrixsname[$shirtindex] = $GLOBALS{'person_sname'};
            } else {
                $shirtmatrixfname[$shirtindex] = "";
                $shirtmatrixsname[$shirtindex] = "";
            }
        } else {
            $shirtmatrixfname[$shirtindex] = "";
            $shirtmatrixsname[$shirtindex] = "";
        }
        
        $shirtmatrixteamcode[$shirtindex] = $GLOBALS{'frsplayernumber_teamcode'};
        if ( $GLOBALS{'frsplayernumber_allocationtype'} == "Team" ) {
            Check_Data("team",$GLOBALS{'currperiodid'},$GLOBALS{'frsplayernumber_teamcode'});
            if ($GLOBALS{'IOWARNING'} == "0" ) {
                $shirtmatrixteamname[$shirtindex] = $GLOBALS{'team_name'};
            } else {
                $shirtmatrixteamname[$shirtindex] = "";
            }
        } else {
            $shirtmatrixteamname[$shirtindex] = "";
        }
    }
    
    XDIV("simpletablediv_shirtnumbertable","container");
    XTABLECOMPACTJQDTID("simpletabletable_shirtnumbertable");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("ShirtNo");XTDHTXT("Allocated To:");XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Team");XTDHTXT("Status");
    X_TR();
    X_THEAD();
    XTBODY();
    
    for ($si = 1; $si <= 999; $si++) {
        if (array_key_exists($si, $shirtmatrixallocationtype)) {
            XTRJQDT();
            XTDTXT($si);XTDTXT($shirtmatrixallocationtype[$si]);XTDTXT($shirtmatrixfname[$si]);XTDTXT($shirtmatrixsname[$si]);XTDTXT($shirtmatrixteamname[$si]);
            XTD(); XBUTTONSPECIAL("Allocated",'success'); X_TD();
            X_TR();
        } else {
            XTRJQDT();
            XTDHTXT($si);XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");
            XTD();XBUTTONSPECIAL("Available",'primary');X_TD();
            X_TR();
        }
    }
    
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_shirtnumbertable");
    XCLEARFLOAT();
    XBR();
    
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "this,person_id|person_sname|person_fname|person_section",
        "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
        "field,Lookup,Select,AllocationPersonId,AllocationPersonName,100",
        "person_id",
        "all",
        "search,center,center,800,600",
        "view",
        "buildfulllist"
    );
}

function Frs_SHIRTNUMBERPERSONRESET_Output () { 
    XH2("Shirt Number Person Reset");
    XPTXT("This utility updates the person records with the shirt numbers from the shirt allocation table.");
    XBR();XBR();
    $frsplayernumber_codea = Get_Array("frsplayernumber","Club");
    foreach ( $frsplayernumber_codea as $frsplayernumber_code ) {
        Get_Data("frsplayernumber","Club",$frsplayernumber_code);
        $shirtindex = $frsplayernumber_code;
        if ( $GLOBALS{'frsplayernumber_allocationtype'} == "Player" ) {
            Check_Data("person",$GLOBALS{'frsplayernumber_personid'});
            if ($GLOBALS{'IOWARNING'} == "0" ) {
                XPTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." assigned shirt number ".$shirtindex);
                $GLOBALS{'person_shirtnumber'} = $shirtindex;     
                Write_Data("person",$GLOBALS{'frsplayernumber_personid'});
            }
        }
    }    
}

function Frs_EMAIL_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Frs_EMAIL_Output() {
    $parm0 = "EMail Style|emailstyle||emailstyle_name|emailstyle_name|25|No";
    $parm1 = "";
    $parm1 = $parm1."emailstyle_name|Yes|Name|60|Yes|Name|KeyText,25,25^";
    $parm1 = $parm1."emailstyle_fontface|No||60|Yes|Font Face|InputSelectFromList,Arial+Times New Roman^";
    $parm1 = $parm1."emailstyle_fontsize|No||60|Yes|Font Size|InputSelectFromList,8px+10px+12px+14px+16px^";
    $parm1 = $parm1."emailstyle_fontcolor|No||60|Yes|Font Colour|InputSelectFromList,Black+Blue+Gray+Navy^";
    $parm1 = $parm1."emailstyle_hfontface|No||60|Yes|Header Font Face|InputSelectFromList,Arial+Times New Roman^";
    $parm1 = $parm1."emailstyle_hfontsize|No||60|Yes|Header Font Size|InputSelectFromList,8px+10px+12px+14px+16px+18px+20px+22px^";
    $parm1 = $parm1."emailstyle_hfontcolor|No||60|Yes|Header Font Colour|InputSelectFromList,Black+Blue+Gray+Navy^";
    if ($GLOBALS{'LOGIN_mode_id'} == "0" ) {
        $bannerurlbase = "GLOBALSITEWWWURL";
    } else { $bannerurlbase = "GLOBALDOMAINWWWURL";
    }
    $bannerurldir = $bannerurlbase."/domain_style";
    if ($GLOBALS{'LOGIN_mode_id'} == "0" ) {
        $bannerfilebase = "GLOBALSITEWWWPATH";
    } else { $bannerfilebase = "GLOBALDOMAINWWWPATH";
    }
    $bannerfiledir = $bannerfilebase."/domain_style";
    $parm1 = $parm1."emailstyle_headerimage|No||60|Yes|Header Image - 500x50|InputImage,$bannerurldir,$bannerfiledir,500,50,EmailHeaderImage,emailstyle_headerimage^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}



?>