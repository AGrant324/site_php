<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insidebar_name = $_REQUEST['sidebar_name'];

Webpage_SIDEBARDELETECONFIRM_Output($insidebar_name);

Back_Navigator();
PageFooter("Default","Final");


