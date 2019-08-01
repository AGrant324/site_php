<<<<<<< HEAD
<?php # personplayoffupdateout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();

$season = $_REQUEST['Season'];
$sectionname = $_REQUEST['SectionName'];
$selectiondate = $_REQUEST['SelectionDate'];
$selectionpersonid = $_REQUEST['SelectionPersonId'];

Check_Data('person',$selectionpersonid);
if ($GLOBALS{'IOWARNING'} == "0") {
	
	XH2("Selection status for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." on ".YYYY_MM_DDtoDDsMMsYY($selectiondate)." - ".$sectionname." section" );
	
	$mysquadlist = Frs_GetMySquadList($selectionpersonid);
	if ($mysquadlist != "") {
		XH4($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." has been assigned to the following team squads");
		foreach (List2Array($mysquadlist) as $team_code) {
			Get_Data('team',$GLOBALS{'currperiodid'},$team_code);
			XTXT($GLOBALS{'team_name'});XBR();
		}
		XBR();
	} else {
		XH4($GLOBALS{'person_fname'}." has not yet been assigned to a team squad");
	}
	
	XH2("Availability");
	XTABLE();
	XTR();XTDHTXT("Date");XTDHTXT("Available");XTDHTXT("Comments");XTDHTXT("Squad Fixtures");X_TR();
	
	XTR();
	XTDTXT(YYYY_MM_DDtoDDsMMsYY($selectiondate));
	$availabilitya = GetDateAvailability('person_dateavailability',$selectiondate);
	if ( $availabilitya[0] == "Y" ) { XTD(); XTXTCOLOR("Yes","green"); X_TD(); }
	if ( $availabilitya[0] == "N" ) { XTD(); XTXTCOLOR("No","red"); X_TD(); }
	if ( $availabilitya[0] == "" ) { XTD(); XTXT("?"); X_TD(); }
	XTDTXT($availabilitya[1]);
	XTD();
	XTABLE();
	
	
	XTR();XTDHTXT("Available");XTDHTXT("Match Details");X_TR();
	$thisYYMMDD = YYYY_MM_DDtoYYMMDD($selectiondate);
	if ($mysquadlist != "") {
		foreach (List2Array($mysquadlist) as $team_code) {
			Get_Data("team",$GLOBALS{'currperiodid'},$team_code);
			$frsa = Get_Array("frs",$season,$team_code);
			foreach ($frsa as $frs_id) {
				if (( substr($frs_id,0,2)== $team_code )&&( substr($frs_id,2,6)== $thisYYMMDD )) {
					Get_Data("frs",$GLOBALS{'currperiodid'},$team_code, $frs_id);
					$thisfrs_venue = "";
					if ($GLOBALS{'frs_ha'} == "H") {
						Check_Data('venue',$GLOBALS{'frs_venue'});
						if ($GLOBALS{'IOWARNING'} == "0" ) {
							$thisfrs_venue = $GLOBALS{'venue_name'};
						}
						else { $thisfrs_venue = $GLOBALS{'frs_venue'};}
					}
					if ($GLOBALS{'frs_ha'} == "A") {
						$thisfrs_venue = $GLOBALS{'frs_venue'};
					}
					if ($GLOBALS{'frs_awayvenue'} != "") {
						$thisfrs_venue = $GLOBALS{'frs_awayvenue'};
					}
					else {$thisfrs_venue = $GLOBALS{'frs_venue'};}
					$availability = GetSelectionList('frs_playerselectedlist',$selectionpersonid,'availability');
					XTR();
					if ( $availability == "Y" ) { XTD(); XTXTCOLOR("Yes","green"); X_TD(); }
					if ( $availability == "N" ) { XTD(); XTXTCOLOR("No","red"); X_TD(); }
					if ( $availability == "" ) { XTD(); XTXT("?"); X_TD(); }
					XTD();
					XTXT( $GLOBALS{'team_name'}." v ".$GLOBALS{'frs_oppo'}." ".$GLOBALS{'frs_ha'}." ".$thisfrs_venue." ".$GLOBALS{'frs_time'} ); 
					X_TD();
					X_TR();
				}
			}
		}
	
	}
	X_TABLE();
	X_TD();
	X_TR();
	X_TABLE();
	
	
	XH2("Selection");
	XTABLE();
	XTR();XTDHTXT("Date");XTDHTXT("Selected");XTDHTXT("Confirmed");XTDHTXT("Fixture");X_TR();
	Get_Data("section",$season,$sectionname);
	$teamsarray = explode (',',$GLOBALS{'section_teams'});
	foreach ($teamsarray as $team_code)  {
		Get_Data("team",$season,$team_code);
		$frsa = Get_Array("frs",$season,$team_code);
		foreach ($frsa as $frs_id) {
			if (( substr($frs_id,0,2)== $team_code )&&( substr($frs_id,2,6)== $thisYYMMDD )) {		
				Get_Data("frs",$season,$team_code, $frs_id);
				if (GetSelectionList('frs_playerselectedlist',$selectionpersonid,'selected') == "Y" ) {		
					XTR();
					XTDTXT(YYYY_MM_DDtoDDsMMsYY($selectiondate));				
					$thisfrs_venue = "";
					if ($GLOBALS{'frs_ha'} == "H") {
						Check_Data('venue',$GLOBALS{'frs_venue'});
						if ($GLOBALS{'IOWARNING'} == "0" ) {
							$thisfrs_venue = $GLOBALS{'venue_name'};
						}
						else { $thisfrs_venue = $GLOBALS{'frs_venue'};}
					}
					if ($GLOBALS{'frs_ha'} == "A") {
						$thisfrs_venue = $GLOBALS{'frs_venue'};
					}
					if ($GLOBALS{'frs_awayvenue'} != "") {
						$thisfrs_venue = $GLOBALS{'frs_awayvenue'};
					}
					else {$thisfrs_venue = $GLOBALS{'frs_venue'};}
					$selected = GetSelectionList('frs_playerselectedlist',$selectionpersonid,'selected');
					if ( $selected == "Y" ) { XTD(); XTXTCOLOR("Yes","green"); X_TD(); }
					if ( $selected == "N" ) { XTD(); XTXTCOLOR("No","red"); X_TD(); }
					if ( $selected == "" ) { XTD(); XTXT("?"); X_TD(); }
					$confirmed = GetSelectionList('frs_playerselectedlist',$selectionpersonid,'confirmed');
					if ( $confirmed == "Y" ) { XTD(); XTXTCOLOR("Yes","green"); X_TD(); }
					if ( $confirmed == "N" ) { XTD(); XTXTCOLOR("No","red"); X_TD(); }
					if ( $confirmed == "?" ) { XTD(); XTXTCOLOR("???","orange"); X_TD(); }					
					if ( $confirmed == "" ) { XTD(); XTXT("?"); X_TD(); }					
					XTD();XTXT( $GLOBALS{'team_name'}." v ".$GLOBALS{'frs_oppo'}." ".$GLOBALS{'frs_ha'}." ".$thisfrs_venue." ".$GLOBALS{'frs_time'} );X_TD();
					X_TR();			
				}	
			}		
		}			
	}
	X_TABLE();
} else {
	XH2("No player selected.");
}
	
	
	
PopUpFooter();

=======
<?php # personplayoffupdateout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();

$season = $_REQUEST['Season'];
$sectionname = $_REQUEST['SectionName'];
$selectiondate = $_REQUEST['SelectionDate'];
$selectionpersonid = $_REQUEST['SelectionPersonId'];

Check_Data('person',$selectionpersonid);
if ($GLOBALS{'IOWARNING'} == "0") {
	
	XH2("Selection status for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." on ".YYYY_MM_DDtoDDsMMsYY($selectiondate)." - ".$sectionname." section" );
	
	$mysquadlist = Frs_GetMySquadList($selectionpersonid);
	if ($mysquadlist != "") {
		XH4($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." has been assigned to the following team squads");
		foreach (List2Array($mysquadlist) as $team_code) {
			Get_Data('team',$GLOBALS{'currperiodid'},$team_code);
			XTXT($GLOBALS{'team_name'});XBR();
		}
		XBR();
	} else {
		XH4($GLOBALS{'person_fname'}." has not yet been assigned to a team squad");
	}
	
	XH2("Availability");
	XTABLE();
	XTR();XTDHTXT("Date");XTDHTXT("Available");XTDHTXT("Comments");XTDHTXT("Squad Fixtures");X_TR();
	
	XTR();
	XTDTXT(YYYY_MM_DDtoDDsMMsYY($selectiondate));
	$availabilitya = GetDateAvailability('person_dateavailability',$selectiondate);
	if ( $availabilitya[0] == "Y" ) { XTD(); XTXTCOLOR("Yes","green"); X_TD(); }
	if ( $availabilitya[0] == "N" ) { XTD(); XTXTCOLOR("No","red"); X_TD(); }
	if ( $availabilitya[0] == "" ) { XTD(); XTXT("?"); X_TD(); }
	XTDTXT($availabilitya[1]);
	XTD();
	XTABLE();
	
	
	XTR();XTDHTXT("Available");XTDHTXT("Match Details");X_TR();
	$thisYYMMDD = YYYY_MM_DDtoYYMMDD($selectiondate);
	if ($mysquadlist != "") {
		foreach (List2Array($mysquadlist) as $team_code) {
			Get_Data("team",$GLOBALS{'currperiodid'},$team_code);
			$frsa = Get_Array("frs",$season,$team_code);
			foreach ($frsa as $frs_id) {
				if (( substr($frs_id,0,2)== $team_code )&&( substr($frs_id,2,6)== $thisYYMMDD )) {
					Get_Data("frs",$GLOBALS{'currperiodid'},$team_code, $frs_id);
					$thisfrs_venue = "";
					if ($GLOBALS{'frs_ha'} == "H") {
						Check_Data('venue',$GLOBALS{'frs_venue'});
						if ($GLOBALS{'IOWARNING'} == "0" ) {
							$thisfrs_venue = $GLOBALS{'venue_name'};
						}
						else { $thisfrs_venue = $GLOBALS{'frs_venue'};}
					}
					if ($GLOBALS{'frs_ha'} == "A") {
						$thisfrs_venue = $GLOBALS{'frs_venue'};
					}
					if ($GLOBALS{'frs_awayvenue'} != "") {
						$thisfrs_venue = $GLOBALS{'frs_awayvenue'};
					}
					else {$thisfrs_venue = $GLOBALS{'frs_venue'};}
					$availability = GetSelectionList('frs_playerselectedlist',$selectionpersonid,'availability');
					XTR();
					if ( $availability == "Y" ) { XTD(); XTXTCOLOR("Yes","green"); X_TD(); }
					if ( $availability == "N" ) { XTD(); XTXTCOLOR("No","red"); X_TD(); }
					if ( $availability == "" ) { XTD(); XTXT("?"); X_TD(); }
					XTD();
					XTXT( $GLOBALS{'team_name'}." v ".$GLOBALS{'frs_oppo'}." ".$GLOBALS{'frs_ha'}." ".$thisfrs_venue." ".$GLOBALS{'frs_time'} ); 
					X_TD();
					X_TR();
				}
			}
		}
	
	}
	X_TABLE();
	X_TD();
	X_TR();
	X_TABLE();
	
	
	XH2("Selection");
	XTABLE();
	XTR();XTDHTXT("Date");XTDHTXT("Selected");XTDHTXT("Confirmed");XTDHTXT("Fixture");X_TR();
	Get_Data("section",$season,$sectionname);
	$teamsarray = explode (',',$GLOBALS{'section_teams'});
	foreach ($teamsarray as $team_code)  {
		Get_Data("team",$season,$team_code);
		$frsa = Get_Array("frs",$season,$team_code);
		foreach ($frsa as $frs_id) {
			if (( substr($frs_id,0,2)== $team_code )&&( substr($frs_id,2,6)== $thisYYMMDD )) {		
				Get_Data("frs",$season,$team_code, $frs_id);
				if (GetSelectionList('frs_playerselectedlist',$selectionpersonid,'selected') == "Y" ) {		
					XTR();
					XTDTXT(YYYY_MM_DDtoDDsMMsYY($selectiondate));				
					$thisfrs_venue = "";
					if ($GLOBALS{'frs_ha'} == "H") {
						Check_Data('venue',$GLOBALS{'frs_venue'});
						if ($GLOBALS{'IOWARNING'} == "0" ) {
							$thisfrs_venue = $GLOBALS{'venue_name'};
						}
						else { $thisfrs_venue = $GLOBALS{'frs_venue'};}
					}
					if ($GLOBALS{'frs_ha'} == "A") {
						$thisfrs_venue = $GLOBALS{'frs_venue'};
					}
					if ($GLOBALS{'frs_awayvenue'} != "") {
						$thisfrs_venue = $GLOBALS{'frs_awayvenue'};
					}
					else {$thisfrs_venue = $GLOBALS{'frs_venue'};}
					$selected = GetSelectionList('frs_playerselectedlist',$selectionpersonid,'selected');
					if ( $selected == "Y" ) { XTD(); XTXTCOLOR("Yes","green"); X_TD(); }
					if ( $selected == "N" ) { XTD(); XTXTCOLOR("No","red"); X_TD(); }
					if ( $selected == "" ) { XTD(); XTXT("?"); X_TD(); }
					$confirmed = GetSelectionList('frs_playerselectedlist',$selectionpersonid,'confirmed');
					if ( $confirmed == "Y" ) { XTD(); XTXTCOLOR("Yes","green"); X_TD(); }
					if ( $confirmed == "N" ) { XTD(); XTXTCOLOR("No","red"); X_TD(); }
					if ( $confirmed == "?" ) { XTD(); XTXTCOLOR("???","orange"); X_TD(); }					
					if ( $confirmed == "" ) { XTD(); XTXT("?"); X_TD(); }					
					XTD();XTXT( $GLOBALS{'team_name'}." v ".$GLOBALS{'frs_oppo'}." ".$GLOBALS{'frs_ha'}." ".$thisfrs_venue." ".$GLOBALS{'frs_time'} );X_TD();
					X_TR();			
				}	
			}		
		}			
	}
	X_TABLE();
} else {
	XH2("No player selected.");
}
	
	
	
PopUpFooter();

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>