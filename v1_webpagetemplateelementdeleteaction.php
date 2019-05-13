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

$intemplateelement_name = $_REQUEST['templateelement_name'];

Delete_Data("templateelement",$intemplateelement_name);
XPTXT('Template Element - "'.$intemplateelement_name.'" deleted');

Webpage_TEMPLATEELEMENTUPDATELIST_Output();

Back_Navigator();
PageFooter("Default","Final");


