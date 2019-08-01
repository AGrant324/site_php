<<<<<<< HEAD
<?php # personLUin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMLLTAPPPITCHLIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmleague_id = $_REQUEST['sfmleague_id'];

SFM_SFMLLTAPPPITCHLIST_Output($insfmleague_id);

Back_Navigator();
PageFooter("Default","Final");

?>
=======
<?php # personLUin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMLLTAPPCLUBLIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmset_id = $_REQUEST['sfmset_id'];

SFM_SFMLLTAPPCLUBLIST_Output($insfmset_id);

Back_Navigator();
PageFooter("Default","Final");

?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
