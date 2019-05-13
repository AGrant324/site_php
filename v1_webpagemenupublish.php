<?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inmenu_id = $_REQUEST['menu_id'];
Get_Data("menu",$inmenu_id);

Webpage_MENUPUBLISH_Output($inmenu_id);
Webpage_TEMPLATEPUBLISHALL_Output();
Webpage_WEBPAGEPUBLISHALL_Output();

XBR();
$link = YPGMLINK("webpagemenuitemupdate.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("menu_id",$inmenu_id);
XLINKTXT($link,"make further changes to this menu");

XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","MENUUPDATE");
XLINKTXT($link,"show my menu list");


Back_Navigator();
PageFooter("Default","Final");

?>

