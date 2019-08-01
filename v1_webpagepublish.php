<?php #bulletinboardpublish.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inwebpage_name = $_REQUEST['webpage_name'];
Get_Data('webpage',$inwebpage_name);

Webpage_WEBPAGEPUBLISH_Output($inwebpage_name);
Webpage_WEBPAGEASSIGNTOMENU_Output($GLOBALS{'webpage_templatename'}, $inwebpage_name);	

Back_Navigator();
PageFooter("Default","Final");

?>

