<<<<<<< HEAD
<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php"; 
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Library_ACCREDEVIDENCEMAINTAIN_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$inaccredscheme_id = $_REQUEST['accredscheme_id'];
$inaccredcriteria_clubid = $_REQUEST['accredcriteria_clubid'];
$inaccredcriteria_id = $_REQUEST['accredcriteria_id'];

Library_ACCREDEVIDENCEMAINTAIN_Output($inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id,"");

Back_Navigator();
PageFooter("Default","Final");




=======
<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php"; 
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Library_ACCREDEVIDENCEMAINTAIN_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$inaccredscheme_id = $_REQUEST['accredscheme_id'];
$inaccredcriteria_clubid = $_REQUEST['accredcriteria_clubid'];
$inaccredcriteria_id = $_REQUEST['accredcriteria_id'];

Library_ACCREDEVIDENCEMAINTAIN_Output($inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id,"");

Back_Navigator();
PageFooter("Default","Final");




>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
