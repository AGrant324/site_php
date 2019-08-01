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

$incurrperiodid = $_REQUEST["CurrPeriod"];
$innewperiodid = $_REQUEST["NewPeriod"];
$indeleteperiodid = $_REQUEST["DeletePeriod"];
$showoutputagain = "0";
if ( $innewperiodid != "" ) { 
 $GLOBALS{'period_id'} = $innewperiodid;
 Write_Data("period",$innewperiodid);
 foreach (Get_Array('team',$GLOBALS{'currperiodid'}) as $xteam) {	
  Get_Data('team',$GLOBALS{'currperiodid'},$xteam);
  Write_Data('team',$innewperiodid,$xteam);
 }
 foreach (Get_Array('section',$GLOBALS{'currperiodid'}) as $xsection) {	
  Get_Data('section',$GLOBALS{'currperiodid'},$xsection);
  Write_Data('section',$innewperiodid,$xsection);
 }
 foreach (Get_Array('sectiongroup',$GLOBALS{'currperiodid'}) as $xsectiongroup) {	 
  Get_Data('sectiongroup',$GLOBALS{'currperiodid'},$xsectiongroup);
  Write_Data('sectiongroup',$innewperiodid,$xsectiongroup);
 }
 foreach (Get_Array('frspersonstattype',$GLOBALS{'currperiodid'}) as $xstats) {	 
  Get_Data('frspersonstattype',$GLOBALS{'currperiodid'},$xstats);
  Write_Data('frspersonstattype',$innewperiodid,$xstats);
 }
 XPTXTCOLOR($innewperiodid." successfully setup","green"); 
 $showoutputagain = "1";
} 
if ($incurrperiodid != "") {
 $GLOBALS{'currperiodid'} = $incurrperiodid;
 $GLOBALS{'domain_currperiodid'} = $incurrperiodid; 
 Write_Data("domain");
 XPTXTCOLOR($GLOBALS{'domain_currperiodid'}." defined as current season","green");
 $showoutputagain = "1";
}
if ($indeleteperiodid != "") { Setup_PERIOD_Delete_Check($indeleteperiodid); }
if ($showoutputagain == "1") { Setup_PERIOD_Output();}	

Back_Navigator();
PageFooter("Default","Final");

?>