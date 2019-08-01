<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMCLUBUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmfacility_id = $_REQUEST['sfmfacility_id'];
$inaccredscheme_id = $_REQUEST['accredscheme_id'];

Check_Data('accredscheme',$inaccredscheme_id);
$accredcriteriaa = Get_Array('accredcriteria',$inaccredscheme_id,$insfmfacility_id);
foreach ($accredcriteriaa as $accredcriteria_id) {
    Delete_Data('accredcriteria',$inaccredscheme_id,$insfmfacility_id,$accredcriteria_id);
    // XPTXTCOLOR($accredcriteria_id." ".$GLOBALS{'accredcriteria_type'}." - Deleted","orange");
}

XPTXTCOLOR("All information for ".$GLOBALS{'accredscheme_name'}." Deleted","green");

if ( $GLOBALS{'LOGIN_orgtype_id'} == "Club" ) { 
    SFM_SFMCLUBUPDATEGROUND_Output($insfmclub_id,$insfmfacility_id); 
} else {
    SFM_SFMCLUBUPDATEMULTI_Output($insfmclub_id,$insfmfacility_id,"GROUNDSTATUS");
}

Back_Navigator();
PageFooter("Default","Final");

?>



