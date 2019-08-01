<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
 
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inmassupdate_id = $_REQUEST['massupdate_id'];
$thisselectionlogic = "";

Get_Data("massupdate",$inmassupdate_id);
$primetable = $GLOBALS{'massupdate_primetable'};
if ( $GLOBALS{'massupdate_selectionlogic'} != "" ) {
	$thisselectionlogic = $GLOBALS{'massupdate_selectionlogic'};
	$seltestina = explodeAND($GLOBALS{'massupdate_selectionlogic'});
	$seltestouta = Array();
	foreach ( $seltestina as $seltestin) {
		$selbits = explodeCOMP($seltestin);
		if (isset($_REQUEST[$selbits[0]])) {
			$selbits[2] = $_REQUEST[$selbits[0]];
		}
		array_push($seltestouta, $selbits[0].$selbits[1].$selbits[2]);
	}
}
$thisselectionlogic = rebuildAND($seltestouta);

XH2("Mass Update Form - ".$inmassupdate_id." - ".$GLOBALS{'massupdate_title'});

XH4("The following updates have been processed");

$massupdate_fieldlist = Replace_CRandLF($GLOBALS{'massupdate_fieldlist'},"|");
$massupdate_fieldlist = str_replace('||', '|', $massupdate_fieldlist);
if ( substr($massupdate_fieldlist, -1) == '|' ) {
	substr_replace($string ,"",-1);
}
// XPTXT("$".$massupdate_fieldlist.'$');
$fieldsa = explode('|',$massupdate_fieldlist);

$selectfieldvaluea = Array(); $selectfieldcompa = Array(); $selectfieldformata = Array();
if ( $thisselectionlogic != "" ) {		
	$thisselectionlogic = str_replace(')', '', $thisselectionlogic);
	$thisselectionlogic = str_replace('(', '', $thisselectionlogic);		
	$seltesta = explodeAND($thisselectionlogic);
	$fi = 0;
	foreach ( $seltesta as $seltest) {	
	    $fi++;
		$selbits = explodeCOMP($seltest);
		$selectfieldcompa{$fi."_".$selbits[0]} = $selbits[1];		
		$selectfieldvaluea{$fi."_".$selbits[0]} = $selbits[2];
		$selectfieldformata{$fi."_".$selbits[0]} = $selbits[3];
	}
}
$sortfieldname = $GLOBALS{'massupdate_sortlogic'};

$primetableida = Get_NKey_Array($primetable);
$sortselecteda = Array();
foreach ( $primetableida as $primetableid) {
	$ida = explode('|',$primetableid);
	if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$ida[0]); }		
	if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$ida[0],$ida[1]); }
	if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$ida[0],$ida[1],$ida[2]); }	
	$selected = "1";
	foreach($selectfieldvaluea as $k => $v) {
	    $kbits = explode("_",$k);
	    $kfield = $kbits[1]."_".$kbits[2];
	    $selected = ReSelection($selected,$kfield,$selectfieldcompa{$k},$v);
	}
	if ($sortfieldname == "" ) { $sortfieldvalue = ""; }
	else { $sortfieldvalue = $GLOBALS{$sortfieldname}; }
	if ($selected == "1") { array_push($sortselecteda, $sortfieldvalue."|".$primetableid); }
}	
if ($sortfieldname != "" ) { sort($sortselecteda); }

foreach ( $sortselecteda as $sortselectedid) {
	$sida = explode('|',$sortselectedid);
	if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$sida[1]); $keyref=$sida[1];}		
	if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$sida[1],$sida[2]); $keyref=$sida[1]."-".$sida[2];}		
	if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$sida[1],$sida[2],$sida[3]); $keyref=$sida[1]."-".$sida[2]."-".$sida[3];}	
	
	$updatesmade = "0";
	
	foreach ($fieldsa as $field) {
		$tfield = str_replace(")",",)",$field);
		$nbits = explode("(",$tfield);		
		$fieldname = $nbits[0];
		$hbits = explode("_",$nbits[0]);
		$fieldtitle = $hbits[1];
		$tbits = explode("Input=",$tfield);
		$ubits = explode(",",$tbits[1]);
		$inputtype = $ubits[0];									
		if ( $inputtype != "TITLE" ) {	
			if (isset($_REQUEST[$fieldname."_".$keyref])) {
				$oldvalue = $GLOBALS{$fieldname};
				$GLOBALS{$fieldname} = $_REQUEST[$fieldname."_".$keyref];
				if ( $GLOBALS{$fieldname} != $oldvalue) {
					XPTXTCOLOR('<b>'.$fieldtitle.'</b> changed from "'.$oldvalue.'" to "'.$GLOBALS{$fieldname}.'"',"green");
					$updatesmade = "1";
				}
				if (array_key_exists($primetable."_massupdatelog", $GLOBALS)) {
				    $GLOBALS{$primetable.'_massupdatelog'} = AddToMassUpdateLog($GLOBALS{$primetable.'_massupdatelog'}, $fieldname, $oldvalue, $GLOBALS{$fieldname});
				}
			}
		} else {
			XBR();XPTXT("============== ".$GLOBALS{$fieldname}." ==============");			
		}
	}
	if ($updatesmade == "1") {
		$GLOBALS{'corsite_massupdatelog'} = $tcorsite_massupdatelog;
		if ($GLOBALS{$primetable."^KEYS"} == "2") { Write_Data($primetable,$sida[1]); }		
		if ($GLOBALS{$primetable."^KEYS"} == "3") { Write_Data($primetable,$sida[1],$sida[2]); }
		if ($GLOBALS{$primetable."^KEYS"} == "4") { Write_Data($primetable,$sida[1],$sida[2],$sida[3]); }
	} else {
		XPTXT("No changes made");
	}	
}

XBR();
XHR();
XBR();
$link = YPGMLINK("massupdateformout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$inmassupdate_id);
XLINKTXT($link,"return to mass update form");
XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","MASSUPDATELIST");
XLINKTXT($link,"show my massupdate forms list");

Back_Navigator();
PageFooter("Default","Final");




?>

