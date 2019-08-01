<<<<<<< HEAD
<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_Login_Select_CSSJS();
Get_Person_Authority();
Set_Person_Session();
$GLOBALS{'dashboardsectionsprovided'} = "1";
PageHeader("Default","Final");
// This routine does not require login
Back_Navigator();

$loginmultiple_id = $_REQUEST['MultiplePersonId'];
$GLOBALS{'LOGIN_person_id'} = $loginmultiple_id;
Get_Data("person",$loginmultiple_id);

Set_Menu();

Person_Login_Select_Output();

Back_Navigator();
PageFooter("Default","Final");

?>

=======
<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_Login_Select_CSSJS();
PageHeader("Default","Final");
// This routine does not require login
Back_Navigator();

$loginmultiple_id = $_REQUEST['MultiplePersonId'];
$GLOBALS{'LOGIN_person_id'} = $loginmultiple_id;
Get_Data("person",$loginmultiple_id);

Get_Person_Authority();
Set_Person_Session();
Set_Menu();
Person_Login_Select_Output();

Back_Navigator();
PageFooter("Default","Final");

?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
