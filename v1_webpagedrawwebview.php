<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_DRAWVIEW_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$indraw_id = $_REQUEST['draw_id'];

Webpage_DRAWVIEW_Output($indraw_id);

Back_Navigator();
PageFooter("Default","Final");

