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

$incarousel_name = $_REQUEST['carousel_name'];

Get_Data('carousel',$incarousel_name);

XH2('Carousel Publish - "'.$carousel_name.'"');

XPTXT('This republishes all templates that use the "'.$incarousel_name.'" carousel.');
XPTXT('It also republishes all webpages that use these templates');

$templatea = Get_Array('template',"Final");
foreach ($templatea as $template_name) {
	XHR();
	Get_Data('template',"Final",$template_name);
	if ($GLOBALS{'template_headercarouselname'} == $incarousel_name) { 
		Webpage_TEMPLATEPUBLISH_Output( "Final",$template_name );
		$webpagea = Get_Array('webpage');
		foreach ($webpagea as $webpage_name) {
			Get_Data('webpage',$webpage_name);
			if ($GLOBALS{'webpage_templatename'} == $template_name) {
				Webpage_WEBPAGEPUBLISH_Output($webpage_name);
			}
		}
	}
}

Back_Navigator();
PageFooter("Default","Final");

