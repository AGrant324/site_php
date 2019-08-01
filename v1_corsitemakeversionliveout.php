<<<<<<< HEAD
<?php # corhistoryuploadin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();$incorsite_id = $_REQUEST['corsite_id'];$incorsite_version = $_REQUEST['corsite_version'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});Cor_CORSITEMAKEVERSIONLIVE_Output($incorsite_id,$incorsite_version);Back_Navigator();PageFooter("Default","Final");
?>

=======
<?php # corhistoryuploadin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();$incorsite_id = $_REQUEST['corsite_id'];$incorsite_version = $_REQUEST['corsite_version'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});Cor_CORSITEMAKEVERSIONLIVE_Output($incorsite_id,$incorsite_version);Back_Navigator();PageFooter("Default","Final");
?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
