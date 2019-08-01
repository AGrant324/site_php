<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$insidebar_html = $_REQUEST['sidebar_html'];
Webpage_SIDEBARPREVIEW_CSSJS();
PageHeader("Default","Final");

XH3("");XINBUTTONCLOSEWINDOW("Close this preview");

Webpage_SIDEBARPREVIEW_Output("Default", $insidebar_html);

XBR();XHR();XINBUTTONCLOSEWINDOW("Close this preview");
PageFooter("Default","Final");

?>
