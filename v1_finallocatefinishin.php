<<<<<<< HEAD
<?php # finallocatefinishin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Fin_ALLOCATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


$bankorcash = $_REQUEST["BankorCash"];
XH3("Allocation of $bankorcash records completed");

Back_Navigator();
PageFooter("Default","Final");

?>


=======
<?php # finallocatefinishin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Fin_ALLOCATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


$bankorcash = $_REQUEST["BankorCash"];
XH3("Allocation of $bankorcash records completed");

Back_Navigator();
PageFooter("Default","Final");

?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
