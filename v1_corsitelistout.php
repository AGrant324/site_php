<<<<<<< HEAD
<?php # corhistoryuploadin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Cor_CORSITELIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$incorsite_corprogramme = $_REQUEST['corsite_corprogramme'];
$infullactive = $_REQUEST['FullActive'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Cor_CORSITELIST_Output($infullactive,$incorsite_corprogramme);

Back_Navigator();
PageFooter("Default","Final");
?>



=======
<?php # corhistoryuploadin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Cor_CORSITELIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$incorsite_corprogramme = $_REQUEST['corsite_corprogramme'];
$infullactive = $_REQUEST['FullActive'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Cor_CORSITELIST_Output($infullactive,$incorsite_corprogramme);

Back_Navigator();
PageFooter("Default","Final");
?>



>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
