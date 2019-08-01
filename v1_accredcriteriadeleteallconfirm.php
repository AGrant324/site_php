<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');

Get_Common_Parameters();
GlobalRoutine();

Setup_ACCREDSCHEMECRITERIA_CSSJS ();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inaccredscheme_id = $_REQUEST['accredscheme_id'];

Setup_ACCREDCRITERIADELETEALLCONFIRM_Output ($inaccredscheme_id);

Back_Navigator();
PageFooter("Default","Final");

?>



