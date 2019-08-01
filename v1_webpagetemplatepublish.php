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

XH2('Template Publish - "'.$intemplate_name.'"');

XPTXT('This also republishes all webpages that use the "'.$intemplate_name.'" template.');
XHR();
Webpage_TEMPLATEPUBLISH_Output( $intemplate_status,$intemplate_name );
$webpagea = Get_Array('webpage');
foreach ($webpagea as $webpage_name) {
	Get_Data('webpage',$webpage_name);
	if ($GLOBALS{'webpage_templatename'} == $intemplate_name) {
		Webpage_WEBPAGEPUBLISH_Output($webpage_name);
	}
}

Back_Navigator();
PageFooter("Default","Final");

