<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Cor_CORSITELIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$incorsite_id = $_REQUEST['corsite_id'];
$incorsite_version = $_REQUEST['corsite_version'];
$inlist = $_REQUEST['List'];

Check_Data('corsite',$incorsite_id,$incorsite_version);
if ($GLOBALS{'IOWARNING'} == "0") {	
	$corsite_dispcorcommidlista = List2Array($GLOBALS{'corsite_dispcorcommidlist'});
	foreach ($corsite_dispcorcommidlista as $corcomm_id) {
		Check_Data('corcomm',$corcomm_id);
		if ($GLOBALS{'IOWARNING'} == "0") {
			Delete_Data('corcomm',$corcomm_id);
			// XPTXTCOLOR("Deleted Old Version Commercial ".$corcomm_id,"green");
		}
	}	
	$corsite_dispcorresiidlista = List2Array($GLOBALS{'corsite_dispcorresiidlist'});
	foreach ($corsite_dispcorresiidlista as $corresi_id) {
		Check_Data('corresi',$corresi_id);
		if ($GLOBALS{'IOWARNING'} == "0") {
			Delete_Data('corresi',$corresi_id);
			// XPTXTCOLOR("Deleted Old Version Residence ".$corresi_id,"green");
		}
	}
	$corsite_dispcoroutletcommsidlista = List2Array($GLOBALS{'corsite_proposalcoroutletcommsidlist'});
	foreach ($corsite_dispcoroutletcommsidlista as $coroutletcomms_id) {
		Check_Data('coroutletcomms',$coroutletcomms_id);
		if ($GLOBALS{'IOWARNING'} == "0") {
			Delete_Data('coroutletcomms',$coroutletcomms_id);
			// XPTXTCOLOR("Deleted Old Version Outlet Comms ".$coroutletcomms_id,"green");
		}
	}
	$corsite_plgsurveylista = List2Array($GLOBALS{'corsite_plgsurveylist'});
	foreach ($corsite_plgsurveylista as $corsurvey_id) {
		Check_Data('corsurvey',$corsurvey_id);
		if ($GLOBALS{'IOWARNING'} == "0") {
			Delete_Data('corsurvey',$corsurvey_id);
			// XPTXTCOLOR("Deleted Old Version Survey ".$corsurvey_id,"green");
		}
	}
	$corsitecommsa = Get_Array('corsitecomms',$incorsite_id);
	foreach ($corsitecommsa as $corsitecomms_timestamp) {
		Check_Data('corsitecomms',$incorsite_id,$corsitecomms_timestamp);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$tcorsitea = Get_Array('corsite',$incorsite_id);
			if ( count($tcorsitea) == 1 ) { // only delete if last site version (incl live)
				Delete_Data('corsitecomms',$incorsite_id,$corsitecomms_timestamp);
				// XPTXTCOLOR("Deleted Old Version Comments ".$incorsite_id."/".$corsitecomms_timestamp,"green");
			} else {
				// XPTXTCOLOR("Cannot delete Old Version Comments ".$incorsite_id."/".$corsitecomms_timestamp,"red");
			}
		}
	}	

	Delete_Data("corsite",$incorsite_id,$incorsite_version);
	XPTXTCOLOR("Site - ".$incorsite_id." ".$incorsite_version." deleted","green");
	if ($inlist == "CORSITEVERSIONINGOUT") {	    
	    $link = YPGMLINK("corsiteversioningout.php");
	    $link = $link.YPGMSTDPARMS().YPGMPARM("corsite_id",$corsite_id).YPGMPARM("corsite_version",$corsite_version);
	    XLINKBUTTON($link,"Close");
	} else {
	   XINBUTTONCLOSEWINDOWLEFT("Close"); 	    
	}
}

Back_Navigator();
PageFooter("Default","Final");

?>


