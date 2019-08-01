<<<<<<< HEAD
<?php # corhistoryuploadin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Dmws_DMWSSULIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inliststatus = $_REQUEST['ListStatus'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Dmws_DMWSSULIST_Output($inliststatus);

Back_Navigator();
PageFooter("Default","Final");
?>

=======
<?php # corhistoryuploadin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Dmws_DMWSSULIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inliststatus = $_REQUEST['ListStatus'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Dmws_DMWSSULIST_Output($inliststatus);

Back_Navigator();
PageFooter("Default","Final");
?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
