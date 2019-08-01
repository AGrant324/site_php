<?php # frsteamresultin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Webpage_FBDRAWVIEW_CSSJS();
PopUpHeader();
// Check_Session_Validity();
$indraw_id = $_REQUEST['draw_id'];
Webpage_FBDRAWVIEW_Output($indraw_id);
PopUpFooter();


