<<<<<<< HEAD
<?php # personPWin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,pwfcookie";

PageHeader("Default","Final");

$inpasswordtype = $_REQUEST['PasswordType'];

if ( $inpasswordtype == "M" ) { Person_PWFmember_Output(); }
else { Person_PWFfamily_Output(); }

Back_Navigator();
PageFooter("Default","Final");
=======
<?php # personPWin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,pwfcookie";

PageHeader("Default","Final");

$inpasswordtype = $_REQUEST['PasswordType'];

if ( $inpasswordtype == "M" ) { Person_PWFmember_Output(); }
else { Person_PWFfamily_Output(); }

Back_Navigator();
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
