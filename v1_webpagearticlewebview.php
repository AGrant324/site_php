<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_ARTICLEVIEW_CSSJS();

PageHeader("Default","Final");
Back_Navigator();

$inarticle_id = $_REQUEST['article_id'];

Webpage_ARTICLEVIEW_Output($inarticle_id);

Back_Navigator();
PageFooter("Default","Final");
