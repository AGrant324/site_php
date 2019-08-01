<<<<<<< HEAD
<?php # personloginout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_processroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Process_DESIGN_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$processtemplate_id = $_REQUEST['processtemplate_id'];

Process_DESIGN_Output($processtemplate_id);

Back_Navigator();
PageFooter("Default","Final");

=======
<?php # personloginout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_processroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Process_DESIGN_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$processtemplate_id = $_REQUEST['processtemplate_id'];

Process_DESIGN_Output($processtemplate_id);

Back_Navigator();
PageFooter("Default","Final");

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>