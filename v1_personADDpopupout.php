<<<<<<< HEAD
<?php # personDM2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();
$changeperson_id = $_REQUEST['ActionPersonId'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Get_Person_Authority();

Person_ADD1_Output("Popup");

PopUpFooter();

?>
=======
<?php # personDM2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();
$changeperson_id = $_REQUEST['ActionPersonId'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Get_Person_Authority();

Person_ADD1_Output("Popup");

PopUpFooter();

?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
