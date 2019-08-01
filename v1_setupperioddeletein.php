<?php # setupperioddeletein.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_setuproutines.php');
require_once('v1_personroutines.php');


Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$indeleteperiodid = $_REQUEST["DeletePeriod"];
if ($indeleteperiodid != "") {
	 Delete_Data("period",$indeleteperiodid);
	 // XH5($indeleteperiodid." Period Deleted");
	 foreach (Get_Array('team',$indeleteperiodid) as $xteamcode) {
	 	foreach (Get_Array('frs',$indeleteperiodid, $xteamcode) as $xfrsid) {	
	 		Delete_Data('frs',$indeleteperiodid, $xteamcode, $xfrsid);
	 		// XH5($xfrsid." Fixture Deleted");
	 	}
	 }
	 foreach (Get_Array('frspersonstattype',$indeleteperiodid) as $xstats) {
	  Delete_Data('frspersonstattype',$indeleteperiodid,$xstats);
	  // XH5($xstats." Stats Deleted");
	 } 
	 foreach (Get_Array('team',$indeleteperiodid) as $xteam) {	
	  Delete_Data('team',$indeleteperiodid,$xteam);
	  // XH5($xteam." Team Deleted");
	 }
	 foreach (Get_Array('section',$indeleteperiodid) as $xsection) {	 
	  Delete_Data('section',$indeleteperiodid,$xsection);
	  // XH5($xsection." Section Deleted");
	 }
	 foreach (Get_Array('sectiongroup',$indeleteperiodid) as $xsectiongroup) {	 
	  Delete_Data('sectiongroup',$indeleteperiodid,$xsectiongroup);
	  // XH5($xsectiongroup." SectionGroup Deleted");
	 }
	  XPTXTCOLOR($indeleteperiodid." season and all section, group, team and fixture information successfully deleted","green");	  
}

Setup_PERIOD_Output();

Back_Navigator();
PageFooter("Default","Final");

?>