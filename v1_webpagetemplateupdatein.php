<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$intemplate_status = $_REQUEST['template_status'];
$intemplate_name = $_REQUEST['template_name'];
$intemplate_dashboardstyle = $_REQUEST['template_dashboardstyle'];
$intemplate_navtopmenuenabled = $_REQUEST['template_navtopmenuenabled'];
$intemplate_headercarouselname = $_REQUEST['template_headercarouselname'];
$intemplate_fullwidthenabled = $_REQUEST['template_fullwidthenabled'];
$intemplate_sidebar = $_REQUEST['template_sidebar'];
$intemplate_sidebarwidth = $_REQUEST['template_sidebarwidth'];
$intemplate_sidebarname = $_REQUEST['template_sidebarname'];
$intemplate_footermenuquantity = $_REQUEST['template_footermenuquantity'];
$inpublish = $_REQUEST['publish'];

Check_Data("template",$intemplate_status,$intemplate_name);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("template"); $action = "added"; }

$GLOBALS{'template_status'} = $intemplate_status;
$GLOBALS{'template_name'} = $intemplate_name;
$GLOBALS{'template_dashboardstyle'} = $intemplate_dashboardstyle;
$GLOBALS{'template_navtopmenuenabled'} = $intemplate_navtopmenuenabled;
$GLOBALS{'template_headercarouselname'} = $intemplate_headercarouselname;
$GLOBALS{'template_fullwidthenabled'} = $intemplate_fullwidthenabled;
$GLOBALS{'template_sidebar'} = $intemplate_sidebar;
$GLOBALS{'template_sidebarwidth'} = $intemplate_sidebarwidth;
$GLOBALS{'template_sidebarname'} = $intemplate_sidebarname;
$GLOBALS{'template_footermenuquantity'} = $intemplate_footermenuquantity;

Write_Data("template",$intemplate_status,$intemplate_name);
XPTXTCOLOR("Template updated successfully","green");

if ( $inpublish == "Yes" ) {
	// XPTXT("You have requested that this template is published");
	Webpage_TEMPLATEPUBLISH_Output( $intemplate_status,$intemplate_name );
	Webpage_WEBPAGEPUBLISHALLSELECTED_Output( $intemplate_name );
}

Webpage_TEMPLATEUPDATELIST_Output ();

Back_Navigator();
PageFooter("Default","Final");


