<<<<<<< HEAD
<?php # frssquadslectin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Get_Person_Authority();
PopUpHeader();
Check_Session_Validity();
$inteamcode = $_REQUEST['team_code'];
Get_Data("team",$GLOBALS{'currperiodid'},$inteamcode);
XH2("Squad Selection Planner - ".$GLOBALS{'team_name'});// print_r($_REQUEST);// $requestcount = 0;
if ($GLOBALS{'team_squadlist'} != "") {
	$squada = explode(',',$GLOBALS{'team_squadlist'});
	$frs_ida = Get_Array("frs",$GLOBALS{'currperiodid'},$team_code);
	foreach ($frs_ida as $frs_id) {		// XPTXT($frs_id);
		Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);		if ($GLOBALS{'currentYYYY-MM-DD'} <= $GLOBALS{'frs_date'}) {	
			foreach ($squada as $personid) {	
				if (isset($_REQUEST[$frs_id.'_'.$personid])) {
					$plannedcode = $_REQUEST[$frs_id.'_'.$personid];	
					UpdateSelectionList('frs_playerselectedlist',$personid,'planned',$plannedcode);					$requestcount++;					// XPTXT($requestcount." ==> ".$frs_id.'_'.$personid." ==>".$plannedcode);
				}
			}
			Write_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);		}
	}
}
XPTXT("Updates completed successfully");
XBR();XINBUTTONCLOSEWINDOW("Close");Frs_FRSSQUADPLANNER_Output($GLOBALS{'currperiodid'},$inteamcode);
XBR();XINBUTTONCLOSEWINDOW("Close");
PopUpFooter();
=======
<?php # frssquadslectin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Get_Person_Authority();
PopUpHeader();
Check_Session_Validity();
$inteamcode = $_REQUEST['team_code'];
Get_Data("team",$GLOBALS{'currperiodid'},$inteamcode);
XH2("Squad Selection Planner - ".$GLOBALS{'team_name'});// print_r($_REQUEST);// $requestcount = 0;
if ($GLOBALS{'team_squadlist'} != "") {
	$squada = explode(',',$GLOBALS{'team_squadlist'});
	$frs_ida = Get_Array("frs",$GLOBALS{'currperiodid'},$team_code);
	foreach ($frs_ida as $frs_id) {		// XPTXT($frs_id);
		Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);		if ($GLOBALS{'currentYYYY-MM-DD'} <= $GLOBALS{'frs_date'}) {	
			foreach ($squada as $personid) {	
				if (isset($_REQUEST[$frs_id.'_'.$personid])) {
					$plannedcode = $_REQUEST[$frs_id.'_'.$personid];	
					UpdateSelectionList('frs_playerselectedlist',$personid,'planned',$plannedcode);					$requestcount++;					// XPTXT($requestcount." ==> ".$frs_id.'_'.$personid." ==>".$plannedcode);
				}
			}
			Write_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);		}
	}
}
XPTXT("Updates completed successfully");
XBR();XINBUTTONCLOSEWINDOW("Close");Frs_FRSSQUADPLANNER_Output($GLOBALS{'currperiodid'},$inteamcode);
XBR();XINBUTTONCLOSEWINDOW("Close");
PopUpFooter();
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
