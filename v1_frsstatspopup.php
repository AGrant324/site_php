<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();

if ( $GLOBALS{'LOGIN_frame_id'} == "F") { FBHeader(); Back_Navigator();} 
else { PopUpHeader(); }

// This routine does not require login

$incurrentperiodid = $_REQUEST['CurrentPeriodId'];
$insectioncode = $_REQUEST['SectionCode'];

$ibits = explode('-',$insectioncode);
$sectionname = $ibits[0];
$frspersonstattypecode = $ibits[1];

Get_Data_Hash("frspersonstattype",$GLOBALS{'currperiodid'},$frspersonstattypecode);
$statscount = 0;
$personresultsa = Array();
$rperson_ida = Get_Array("frspersonstat",$GLOBALS{'currperiodid'},$insectioncode);
foreach ($rperson_ida as $rperson_id) {	
 # XH5("CHECK ".$section_name."-".$frspersonstattype_code." ".$rperson_id)." ".$GLOBALS{'frspersonstat_quantity'};
 Check_Data("frspersonstat",$GLOBALS{'currperiodid'},$insectioncode,$rperson_id);
 if ($GLOBALS{'IOWARNING'} == "0" ) {
	Check_Data("person",$rperson_id);
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		# XH5("USE ".$section_name."-".$frspersonstattype_code." ".$rperson_id)." ".$GLOBALS{'frspersonstat_quantity'};
		$resultsstring = substr("0000".$GLOBALS{'frspersonstat_quantity'},-4)."|".$rperson_id;
		array_push($personresultsa, $resultsstring);
		$statscount++;
	}
 }
}

if ($statscount > 0) {
	$sortedpersonresultsa = $personresultsa;
	rsort($sortedpersonresultsa);
	XTD();
	XH2($sectionname." Section - ".$GLOBALS{'frspersonstattype_title'});
	XTABLE();
	foreach ($sortedpersonresultsa as $element) {		
		$rbits = explode('|',$element);
		Get_Data("person",$rbits[1]);
		XTR();
		$from = $GLOBALS{'domainfilepath'}."/personphotos/".$GLOBALS{'person_photo'};
		if (($GLOBALS{'person_photo'} != "")&&(file_exists($from))) {
			$imagefilebits = explode('.', $GLOBALS{'person_photo'});
			$imagetype = $imagefilebits[1];
			$phototempname = "temp_".$rbits[1].".".$imagetype;
			$to = $GLOBALS{'domainwwwpath'}."/domain_temp/".$phototempname;
			copy($from, $to);
			$photofullsitename = $GLOBALS{'domainwwwurl'}."/domain_temp/".$phototempname;
			XTD();XIMGWIDTH($photofullsitename,"100");X_TD();
		} else {
		 	XTDTXT("");
		}
		XTDTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});
		XTDTXT(RemoveLeadingZeros($rbits[0]));
		X_TR();
	}
	X_TABLE();
}
if ( $GLOBALS{'LOGIN_frame_id'} == "F") { Back_Navigator(); FBFooter(); } 
else { PopUpFooter(); }

