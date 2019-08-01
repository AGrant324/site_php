<?php # frsteamresultin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Webpage_FBEVENTVIEW_CSSJS();
PopUpHeader();
Check_Session_Validity();
$inevent_id = $_REQUEST['event_id'];
Webpage_FBEVENTVIEW_Output($inevent_id);
PopUpFooter();


