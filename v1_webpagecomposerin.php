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

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inwebpage_name = $_REQUEST['webpage_name'];
$inwebpage_html = $_REQUEST['webpage_html'];
$inwebpage_pluginlist = $_REQUEST['webpage_pluginlist'];
$inwebpage_templatename = $_REQUEST['webpage_templatename'];
$inwebpage_sidebarname = $_REQUEST['webpage_sidebarname'];
$inwebpage_controller = $_REQUEST['webpage_controller'];
$inwebpage_userid = $_REQUEST['webpage_userid'];
$inwebpage_format = $_REQUEST['webpage_format'];
$inpublish = $_REQUEST['publish'];

XH2("Webpage Composer - ".$inwebpage_name);
$action = "updated";
Check_Data("webpage",$inwebpage_name);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("webpage"); $action = "added"; }

if ($action == "added") {
	$GLOBALS{'webpage_address'} = $inwebpage_name.'.html';
}
$GLOBALS{'webpage_html'} = $inwebpage_html;
$GLOBALS{'webpage_pluginlist'} = $inwebpage_pluginlist;
$GLOBALS{'webpage_templatename'} = $inwebpage_templatename;
$GLOBALS{'webpage_sidebarname'} = $inwebpage_sidebarname;
$GLOBALS{'webpage_controller'} = $inwebpage_controller;
$GLOBALS{'webpage_userid'} = $inwebpage_userid;
$GLOBALS{'webpage_format'} = $inwebpage_format;
Write_Data("webpage",$inwebpage_name);
XPTXT($inwebpage_name." updated using ".$inwebpage_templatename." template.");

if ( $inpublish == "Yes" ) {
	Webpage_WEBPAGEPUBLISH_Output($inwebpage_name);
}

XFORM ("webpagecomposerout.php", "WebpageChange");
XINSTDHID();
XINHID("webpage_name",$inwebpage_name);
XINSUBMIT ("Make further changes to this page");
X_FORM();
XBR();

Webpage_WEBPAGEASSIGNTOMENU_Output($inwebpage_name);

/*
XH2("This is how the webpage will be displayed");
XHR();

Webpage_WEBPAGEPREVIEW_Output($inwebpage_templatename,$inwebpage_html,"hide");
*/

Back_Navigator();
PageFooter("Default","Final");


