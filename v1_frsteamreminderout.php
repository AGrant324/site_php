<?php # frsresultsboardout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_TEAMREMINDER_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

Frs_TEAMREMINDER_Output();

Back_Navigator();
PageFooter("Default","Final");
 