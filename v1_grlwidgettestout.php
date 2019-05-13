<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_grlroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Grl_GRLPLUGINTEST2_CSSJS;
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$pluginname = $_REQUEST['PluginName'];
Grl_GRLPLUGINTEST2_Output($pluginname);

Back_Navigator();
PageFooter("Default","Final");
