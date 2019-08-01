<<<<<<< HEAD
<?php # personloginout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
Get_Common_Parameters();
GlobalRoutine();

if (Keep_Alive() == "1") { print "1,".$GLOBALS{'person_sessiontime'}; }
else { print "0,Error"; }	

=======
<?php # personloginout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
Get_Common_Parameters();
GlobalRoutine();

if (Keep_Alive() == "1") { print "1,".$GLOBALS{'person_sessiontime'}; }
else { print "0,Error"; }	

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>