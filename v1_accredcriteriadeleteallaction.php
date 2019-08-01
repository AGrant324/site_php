<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');

Get_Common_Parameters();
GlobalRoutine();

Setup_ACCREDSCHEME_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inaccredscheme_id = $_REQUEST['accredscheme_id'];

$accredcriteriaa = Get_Array('accredcriteria',$inaccredscheme_id,$GLOBALS{'LOGIN_domain_id'}); 
foreach ($accredcriteriaa as $accredcriteria_id) {
    Delete_Data("accredcriteria",$inaccredscheme_id,$GLOBALS{'LOGIN_domain_id'},$accredcriteria_id);
    // XPTXTCOLOR($GLOBALS{'LOGIN_domain_id'}." ".$accredcriteria_id." - Deleted","orange");   
}

XPTXTCOLOR("All criteria for  ".$inaccredscheme_id." - Deleted","green");
Setup_ACCREDSCHEME_Output();

Back_Navigator();
PageFooter("Default","Final");

?>



