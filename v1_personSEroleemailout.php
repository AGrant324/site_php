<<<<<<< HEAD
<?php # personSERolemailout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
// This routine does not require login
Back_Navigator();

$sendtorole = $_REQUEST['SendToRole'];
$sendtoid = $_REQUEST['SendToId'];

$GLOBALS{'LOGIN_person_id'}  = $sendtoid; Check_Data("person",$GLOBALS{'LOGIN_person_id'});
Person_SEroleEmail_Output($sendtorole,$sendtoid);

Back_Navigator();
PageFooter("Default","Final");

?>

=======
<?php # personSERolemailout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
// This routine does not require login
Back_Navigator();

$sendtorole = $_REQUEST['SendToRole'];
$sendtoid = $_REQUEST['SendToId'];

$GLOBALS{'LOGIN_person_id'}  = $sendtoid; Check_Data("person",$GLOBALS{'LOGIN_person_id'});
Person_SEroleEmail_Output($sendtorole,$sendtoid);

Back_Navigator();
PageFooter("Default","Final");

?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
