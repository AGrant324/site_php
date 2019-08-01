<<<<<<< HEAD
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

$inbulletin_id = $_REQUEST['bulletin_id'];
$fixedbulletinboard = $_REQUEST['FixedBulletinBoard'];
$returnto = $_REQUEST['ReturnTo'];

Webpage_BULLETINDELETECONFIRM_Output($inbulletin_id,$fixedbulletinboard,$returnto);

Back_Navigator();
PageFooter("Default","Final");


=======
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

$inbulletin_id = $_REQUEST['bulletin_id'];
$fixedbulletinboard = $_REQUEST['FixedBulletinBoard'];
$returnto = $_REQUEST['ReturnTo'];

Webpage_BULLETINDELETECONFIRM_Output($inbulletin_id,$fixedbulletinboard,$returnto);

Back_Navigator();
PageFooter("Default","Final");


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
