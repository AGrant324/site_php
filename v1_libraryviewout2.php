<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";   
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Library_LIBRARYVIEW_2_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$librarysection_id = $_REQUEST['LibrarySection'];
$asset_clubid = $_REQUEST['asset_clubid'];

Get_Person_Authority();
Library_LIBRARYVIEW_Output2($librarysection_id,$asset_clubid);

Back_Navigator();
PageFooter("Default","Final");

