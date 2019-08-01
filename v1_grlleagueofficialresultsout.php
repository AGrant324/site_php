<<<<<<< HEAD
<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_grlroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Grl_LeagueOfficialResults_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$parma = Array("L-Premier");
Grl_LeagueOfficialResults_Output($parma);

Back_Navigator();
PopUpFooter();
=======
<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_grlroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Grl_LeagueOfficialResults_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$parma = Array("L-Premier");
Grl_LeagueOfficialResults_Output($parma);

Back_Navigator();
PopUpFooter();
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
