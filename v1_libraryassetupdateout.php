<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php"; 
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Library_ASSET_CSSJS();
PageHeader("Default","Final");
Back_Navigator();
Check_Session_Validity();

$acd = $_REQUEST['ACD'];
$inlibrarysection_id = $_REQUEST['LibrarySection'];
$inasset_clubid = $_REQUEST['asset_clubid'];
$inasset_code = $_REQUEST['asset_code'];

if ($acd == "A1") {
	Initialise_Data('asset');
}
if ($acd == "C") {
    Get_Data('asset',$inasset_clubid,$inasset_code);
}

// XH1($inlibrarysection_id." ".$inasset_clubid." ".$inasset_code." ".$acd);

Library_ASSET_Output($inlibrarysection_id,$inasset_clubid,$inasset_code,$acd);

Back_Navigator();
PageFooter("Default","Final");

