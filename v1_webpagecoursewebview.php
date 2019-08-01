<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
// Webpage_COURSEVIEW_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$incourse_id = $_REQUEST['course_id'];

Webpage_COURSEVIEW_Output($incourse_id);

Back_Navigator();
PageFooter("Default","Final");


