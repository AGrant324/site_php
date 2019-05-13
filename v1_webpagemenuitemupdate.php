<?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_MENUITEMUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inmenu_id = $_REQUEST['menu_id'];

Webpage_MENUITEMUPDATE_Output($inmenu_id);

XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","MENUUPDATE");
XLINKTXT($link,"show my menu list");   

Back_Navigator();
PageFooter("Default","Final");

?>

