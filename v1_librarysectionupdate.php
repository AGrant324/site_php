<?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');

Get_Common_Parameters();
GlobalRoutine();
Setup_LIBRARYSECTION_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Setup_LIBRARYSECTION_Output();

Back_Navigator();
PageFooter("Default","Final");

?>

