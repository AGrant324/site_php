<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Library_LIBRARYINDEX_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$asset_clubid = $_REQUEST['asset_clubid'];

Library_LIBRARYINDEX_Output ("Maintain",$asset_clubid);

Back_Navigator();
PageFooter("Default","Final");

