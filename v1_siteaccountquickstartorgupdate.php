<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_siteroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Site_QSORG_CSSJS (); 
PageHeader("Default","Final");

$quickstart_accountid = $_REQUEST['quickstart_accountid'];

Site_QSORG_Output($quickstart_accountid);

Back_Navigator();
PageFooter("Default","Final");

