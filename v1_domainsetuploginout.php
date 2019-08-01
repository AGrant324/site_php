<?php #domainsetupout

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";   
require_once "v1_siteroutines.php";

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Domain_Setup_Login_Output();

Back_Navigator();
PageFooter("Default","Final");


