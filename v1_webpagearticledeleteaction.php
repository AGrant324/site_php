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

$inarticle_id = $_REQUEST['article_id'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();
Delete_Data("article",$inarticle_id);
XPTXT("Article - ".$inarticle_id." deleted");
Webpage_PluginTriggerChanged_Output("article");

Webpage_ARTICLEUPDATELIST_Output();

Back_Navigator();
PageFooter("Default","Final");


