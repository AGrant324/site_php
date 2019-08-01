<?php # corhistoryuploadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Cor_CORSITEVERSIONINGOUT_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$incorsite_id = $_REQUEST['corsite_id'];
$inoldcorsite_version = $_REQUEST['oldcorsite_version'];
$innewcorsite_version = $_REQUEST['newcorsite_version'];

// ======== This code is also used in corsitemakeversionlive ==============

Get_Data('corsite',$incorsite_id,$inoldcorsite_version);	

// Step1: Find highest sequence numbers for referenced tables

$corcomm_ida = Get_Array('corcomm');
$highestcorcomm_id = "CO00000";
foreach ($corcomm_ida as $corcomm_id) { 
	if ( $corcomm_id > $highestcorcomm_id ) { $highestcorcomm_id = $corcomm_id; }
}
$highestcorcomm_seq = str_replace("CO", "", $highestcorcomm_id);

$corresi_ida = Get_Array('corresi');
$highestcorresi_id = "RE00000";
foreach ($corresi_ida as $corresi_id) { 
	if ( $corresi_id > $highestcorresi_id ) { $highestcorresi_id = $corresi_id; }
}
$highestcorresi_seq = str_replace("RE", "", $highestcorresi_id);

$coroutletcomms_ida = Get_Array('coroutletcomms');
$highestcoroutletcomms_id = "OC00000";
foreach ($coroutletcomms_ida as $coroutletcomms_id) {
	if ( $coroutletcomms_id > $highestcoroutletcomms_id ) {
		$highestcoroutletcomms_id = $coroutletcomms_id;
	}
}
$highestcoroutletcomms_seq = str_replace("OC", "", $highestcoroutletcomms_id);

$corsurvey_ida = Get_Array('corsurvey');
$highestcorsurvey_id = "SU00000";
foreach ($corsurvey_ida as $corsurvey_id) { 
	if ( $corsurvey_id > $highestcorsurvey_id ) {$highestcorsurvey_id = $corsurvey_id;} 
}
$highestcorsurvey_seq = str_replace("SU", "", $highestcorsurvey_id);

// Step 2: Copy existing commercial residential and surveys

$newcorcommlist = ""; $newcorcommsep = "";
$corsite_dispcorcommidlista = List2Array($GLOBALS{'corsite_dispcorcommidlist'});
foreach ($corsite_dispcorcommidlista as $tcorcomm_id) {
	Check_Data('corcomm',$tcorcomm_id);
	if ($GLOBALS{'IOWARNING'} == "0") {
		$highestcorcomm_seq++;
		$newcorcomm_id = "CO".substr(("00000".$highestcorcomm_seq), -5);		
		$GLOBALS{"corcomm_corsiteversion"} = $innewcorsite_version;
		Write_Data('corcomm',$newcorcomm_id);
		$newcorcommlist = $newcorcommlist.$newcorcommsep.$newcorcomm_id;
		$newcorcommsep = ",";
		// XPTXTCOLOR("Replicated Commercial ".$tcorcomm_id."  => ".$newcorcomm_id,"green");
	}
}

$newcorresilist = ""; $newcorresisep = "";
$corsite_dispcorresiidlista = List2Array($GLOBALS{'corsite_dispcorresiidlist'});
foreach ($corsite_dispcorresiidlista as $tcorresi_id) {
	Check_Data('corresi',$tcorresi_id);
	if ($GLOBALS{'IOWARNING'} == "0") {
		$highestcorresi_seq++;	
		$newcorresi_id = "RE".substr(("00000".$highestcorresi_seq), -5);
		$GLOBALS{"corresi_corsiteversion"} = $innewcorsite_version;
		Write_Data('corresi',$newcorresi_id);
		$newcorresilist = $newcorresilist.$newcorresisep.$newcorresi_id;
		$newcorresisep = ",";
		// XPTXTCOLOR("Replicated Residence ".$tcorresi_id."  => ".$newcorresi_id,"green");
	}
}

$newcoroutletcommslist = ""; $newcoroutletcommssep = "";
$corsite_dispcoroutletcommsidlista = List2Array($GLOBALS{'corsite_proposalcoroutletcommsidlist'});
foreach ($corsite_dispcoroutletcommsidlista as $tcoroutletcomms_id) {
	Check_Data('coroutletcomms',$tcoroutletcomms_id);
	if ($GLOBALS{'IOWARNING'} == "0") {
		$highestcoroutletcomms_seq++;
		$newcoroutletcomms_id = "OC".substr(("00000".$highestcoroutletcomms_seq), -5);
		$GLOBALS{"coroutletcomms_corsiteversion"} = $innewcorsite_version;
		Write_Data('coroutletcomms',$newcoroutletcomms_id);
		$newcoroutletcommslist = $newcoroutletcommslist.$newcoroutletcommssep.$newcoroutletcomms_id;
		$newcoroutletcommssep = ",";
		// XPTXTCOLOR("Replicated Commercial ".$tcoroutletcomms_id."  => ".$newcoroutletcomms_id,"green");
	}
}

$corsurveylist = ""; $corsurveysep = "";
$corsite_plgsurveylista = List2Array($GLOBALS{'corsite_plgsurveylist'});
foreach ($corsite_plgsurveylista as $tcorsurvey_id) {
	Check_Data('corsurvey',$tcorsurvey_id);
	if ($GLOBALS{'IOWARNING'} == "0") {
		$highestcorsurvey_seq++;
		$newcorsurvey_id = "SU".substr(("00000".$highestcorsurvey_seq), -5);
		$GLOBALS{"corsurvey_corsiteversion"} = $innewcorsite_version;
		Write_Data('corsurvey',$newcorsurvey_id);
		$newcorsurveylist = $newcorsurveylist.$newcorsurveysep.$newcorsurvey_id;
		$newcorsurveysep = ",";
		// XPTXTCOLOR("Replicated Survey ".$tcorsurvey_id."  => ".$newcorsurvey_id,"green");
	}
}

$GLOBALS{'corsite_dispcorcommidlist'} = $newcorcommlist;
$GLOBALS{'corsite_dispcorresiidlist'} = $newcorresilist;
$GLOBALS{'corsite_proposalcoroutletcommsidlist'} = $newcoroutletcommslist;
$GLOBALS{'corsite_plgsurveylist'} = $newcorsurveylist;
$GLOBALS{'corsite_lastupdatetimestamp'} = $GLOBALS{'currenttimestamp'};
$GLOBALS{'corsite_lastupdatepersonid'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'corsite_lastupdatetype'} = "Create New Version";

Write_Data('corsite',$incorsite_id,$innewcorsite_version);
XPTXTCOLOR($innewcorsite_version.' version of '.$GLOBALS{'corsite_site'}.'/'.$inoldcorsite_version.' created',"green");	

Cor_CORSITEVERSIONINGOUT_Output($incorsite_id,$innewcorsite_version);

Back_Navigator();
PageFooter("Default","Final");

?>