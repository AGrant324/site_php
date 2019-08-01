<<<<<<< HEAD
<?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inbulletinboard_name = $_REQUEST['bulletinboard_name'];

// Webpage_PluginTriggerChanged_Output($inbulletinboard_name);
Webpage_PluginTriggerChanged_Output("bulletin");

Back_Navigator();
PageFooter("Default","Final");

?>

=======
<?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inbulletinboard_name = $_REQUEST['bulletinboard_name'];

// Webpage_PluginTriggerChanged_Output($inbulletinboard_name);
Webpage_PluginTriggerChanged_Output("bulletin");

Back_Navigator();
PageFooter("Default","Final");

?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
