<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMLLTAPPSETLIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

SFM_SFMLLTAPPSETLIST_Output();

Back_Navigator();
PageFooter("Default","Final");
