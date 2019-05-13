<?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Webpage_BULLETINBOARDEDIT_CSSJS ();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inbulletinboard_name = $_REQUEST['bulletinboard_name'];

Webpage_BULLETINBOARDEDIT_Output ($inbulletinboard_name);

Back_Navigator();
PageFooter("Default","Final");

?>


	



