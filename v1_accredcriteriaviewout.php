<<<<<<< HEAD
<?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');
require_once('v1_setuproutines.php');

Get_Common_Parameters();
GlobalRoutine();

Setup_ACCREDSCHEMECRITERIA_CSSJS ();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inaccredscheme_id = $_REQUEST['accredscheme_id'];

Library_ACCREDVIEWLIST_Output($inaccredscheme_id,$GLOBALS{'LOGIN_domain_id'},"Maintain","");

Back_Navigator();
PageFooter("Default","Final");

?>


	



=======
<?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');
require_once('v1_setuproutines.php');

Get_Common_Parameters();
GlobalRoutine();

Setup_ACCREDSCHEMECRITERIA_CSSJS ();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inaccredscheme_id = $_REQUEST['accredscheme_id'];

Library_ACCREDVIEWLIST_Output($inaccredscheme_id,$GLOBALS{'LOGIN_domain_id'},"Maintain","");

Back_Navigator();
PageFooter("Default","Final");

?>


	



>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
