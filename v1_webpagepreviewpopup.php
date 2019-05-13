<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$inwebpage_templatename = $_REQUEST['webpage_templatename'];
$inwebpage_sidebarname = $_REQUEST['webpage_sidebarname'];
$inwebpage_html = $_REQUEST['webpage_html'];

PageHeader("Default","Final");

XH3("");XINBUTTONCLOSEWINDOW("Close this preview");

Webpage_WEBPAGEPREVIEW_Output($inwebpage_templatename, $inwebpage_sidebarname, $inwebpage_html);

XBR();XHR();
XINBUTTONCLOSEWINDOW("Close this preview");
PageFooter("Default","Final");

?>
