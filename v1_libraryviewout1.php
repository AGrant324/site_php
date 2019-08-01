<<<<<<< HEAD
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
Library_LIBRARYINDEX_Output ("View",$asset_clubid);

Back_Navigator();
PageFooter("Default","Final");




=======
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
Library_LIBRARYINDEX_Output ("View",$asset_clubid);

Back_Navigator();
PageFooter("Default","Final");




>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
