<<<<<<< HEAD
<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";   
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Library_LIBRARYMAINTAIN_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$inlibrarysection_id = $_REQUEST['LibrarySection'];
$asset_clubid = $_REQUEST['asset_clubid'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

Library_LIBRARYMAINTAIN_Output2($inlibrarysection_id,$asset_clubid);

Back_Navigator();
PageFooter("Default","Final");




=======
<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";   
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$inlibrarysection_id = $_REQUEST['LibrarySection'];
$asset_clubid = $_REQUEST['asset_clubid'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

Library_LIBRARYMAINTAIN_Output2($inlibrarysection_id,$asset_clubid);

Back_Navigator();
PageFooter("Default","Final");




>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
