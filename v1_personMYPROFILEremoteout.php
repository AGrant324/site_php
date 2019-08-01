<<<<<<< HEAD
<?php # personMYPROFILEremoteout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters_Using_CGI();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity(); 
Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Get_Person_Authority();
Person_MYPROFILE_Output();
XH3("Press Update to make changes, check the results, and then close this browser window when you have finished.... Thanks");	

PageFooter("Default","Final");

?>


=======
<?php # personMYPROFILEremoteout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters_Using_CGI();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity(); 
Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Get_Person_Authority();
Person_MYPROFILE_Output();
XH3("Press Update to make changes, check the results, and then close this browser window when you have finished.... Thanks");	

PageFooter("Default","Final");

?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
