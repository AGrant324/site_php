<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_FBCOURSEVIEW_CSSJS();
PopUpHeader();
Check_Session_Validity();

$incourse_id = $_REQUEST['course_id'];

Webpage_FBCOURSEVIEW_Output($incourse_id);

PopUpFooter();


