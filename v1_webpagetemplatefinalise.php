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

$intemplate_name = $_REQUEST['template_name'];

Check_Data('template',"Draft",$intemplate_name);
if ($GLOBALS{'IOWARNING'} == "0" ) { 	
	Write_Data('template',"Final",$intemplate_name);
	Delete_Data('template',"Draft",$intemplate_name);	
	Webpage_TEMPLATEPUBLISH_Output( "Final",$intemplate_name );
	Webpage_WEBPAGEPUBLISHALLSELECTED_Output( $intemplate_name );		
	
	XH2('Template Finalise - "'.$intemplate_name.'"');
	XPTXT("The template has been successfully finalised");	
	
} else {
	XH2('Template Finalise - "'.$intemplate_name.'"');
	XPTXT("Error: ".$intemplate_name." draft template does not exist.");
}
Back_Navigator();
PageFooter("Default","Final");
