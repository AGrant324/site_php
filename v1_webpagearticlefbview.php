<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_FBARTICLEVIEW_CSSJS();
PopUpHeader();
Check_Session_Validity();

$inarticle_id = $_REQUEST['article_id'];

Webpage_FBARTICLEVIEW_Output($inarticle_id);

PopUpFooter();


