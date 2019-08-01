<<<<<<< HEAD
<?php # personNEWMAILout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_MYJOBROLE_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$inperson_id = $_REQUEST['person_id'];

Person_MYJOBROLE_Output($inperson_id);

Back_Navigator();
PageFooter("Default","Final");

=======
<?php # personNEWMAILout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_MYJOBROLE_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$inperson_id = $_REQUEST['person_id'];

Person_MYJOBROLE_Output($inperson_id);

Back_Navigator();
PageFooter("Default","Final");

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>