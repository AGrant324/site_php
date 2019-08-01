<<<<<<< HEAD
<?php # personLIin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();
Get_Person_Authority();

$limode = $_REQUEST['LIMode'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Person_LIST_Output($limode);
Back_Navigator();
=======
<?php # personLIin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();
Get_Person_Authority();

$limode = $_REQUEST['LIMode'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Person_LIST_Output($limode);
Back_Navigator();
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
PageFooter("Default","Final");