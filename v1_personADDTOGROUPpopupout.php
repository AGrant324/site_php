<<<<<<< HEAD
<?php # personDM2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_ADDTOGROUPSEARCH_CSSJS();
PopUpHeader();
Check_Session_Validity();
$sectiongroup = $_REQUEST['SectionGroup'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Get_Person_Authority();

Person_ADDTOGROUPSEARCH_Output($sectiongroup);

PopUpFooter();

?>
=======
<?php # personDM2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_ADDTOGROUPSEARCH_CSSJS();
PopUpHeader();
Check_Session_Validity();
$sectiongroup = $_REQUEST['SectionGroup'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Get_Person_Authority();

Person_ADDTOGROUPSEARCH_Output($sectiongroup);

PopUpFooter();

?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
