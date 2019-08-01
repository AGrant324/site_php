<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";   
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Library_ACCREDVIEWLIST_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$accredscheme_id = $_REQUEST['accredscheme_id'];
$accredcriteria_clubid = $_REQUEST['accredcriteria_clubid'];

Library_ACCREDVIEWLIST_Output($accredscheme_id,$accredcriteria_clubid,"Maintain","");

Back_Navigator();
PageFooter("Default","Final");




