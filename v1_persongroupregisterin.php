<?php # persongroupregisterout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_SECTIONGROUPREGISTER_CSSJS ();
PopUpHeader();
Check_Session_Validity();
Get_Person_Authority();

$insectiongroupcode = $_REQUEST['SectionGroup'];
$inaction = $_REQUEST['Action'];
$insessiondateYYYY = $_REQUEST['SessionDate_YYYYpart'];
$insessiondateMM = $_REQUEST['SessionDate_MMpart'];
$insessiondateDD = $_REQUEST['SessionDate_DDpart'];
$insessiondate = $insessiondateYYYY."-".$insessiondateMM."-".$insessiondateDD;

if ( $inaction == "NewSession" ) {
	Get_Data('sectiongroup', $GLOBALS{'currperiodid'}, $insectiongroupcode);
	AddSessionToRegisterList("sectiongroup_register",$insessiondate);
	Write_Data('sectiongroup', $GLOBALS{'currperiodid'}, $insectiongroupcode);
	Person_SECTIONGROUPREGISTER_Output ($insectiongroupcode);	
}

if ( $inaction == "UpdateRegister" ) {
	Get_Data('sectiongroup', $GLOBALS{'currperiodid'}, $insectiongroupcode);
	$personida = Array();
	foreach ( Get_Array('person') as $person_id) {
		Get_Data( 'person', $person_id );
		if ( MatchLists ($GLOBALS{'person_sectiongroup'}, $insectiongroupcode) ) {
			array_push($personida, $person_id) ;
		}
	}	
	$sessiondatea = GetRegisterListDates("sectiongroup_register");
	foreach ( $sessiondatea as $sessiondate) {
		foreach ( $personida as $personid) {
			$inregisterentry = $_REQUEST[$sessiondate."_".$personid];
			UpdateRegisterList("sectiongroup_register",$sessiondate,$personid,"attended",$inregisterentry);		
		}
	}
	// Write_Data('sectiongroup', $GLOBALS{'currperiodid'}, $insectiongroupcode);
	Person_SECTIONGROUPREGISTERM_Output ($insectiongroupcode);	
}

if ( $inaction == "PrintRegister" ) {

	Person_SECTIONGROUPREGISTER_Print ($insectiongroupcode,$insessiondate);	
}







XBR();XINBUTTONCLOSEWINDOW("Cancel");
PopUpFooter();
