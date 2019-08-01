<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insidebar_name = $_REQUEST['sidebar_name'];
$insidebar_html = $_REQUEST['sidebar_html'];
$inpublish = $_REQUEST['publish'];

Check_Data("sidebar",$insidebar_name);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("sidebar"); $action = "added"; }

$GLOBALS{'sidebar_name'} = $insidebar_name;
$GLOBALS{'sidebar_html'} = $insidebar_html;

Write_Data("sidebar",$insidebar_name);
XPTXTCOLOR('Sidebar "'.$insidebar_name.'" updated successfully',"green");

if ( $inpublish == "Yes" ) {
	XPTXT("You have requested that this sidebar is published");
	Webpage_SIDEBARPUBLISH_Output( $insidebar_name );
}

Webpage_SIDEBARCOMPOSERLIST_Output ();

Back_Navigator();
PageFooter("Default","Final");

