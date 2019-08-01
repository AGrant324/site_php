<<<<<<< HEAD
<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();
$actionpersonid = $_REQUEST['ActionPersonId'];
$actionparameter = $_REQUEST['ActionParameter'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();
Get_Data("person",$actionpersonid);
$GLOBALS{'person_sectiongroup'} = CommaList_Add($GLOBALS{'person_sectiongroup'},$actionparameter);
Write_Data("person",$actionpersonid);
XH3("Assign person to My Group - ".$tsectiongroup);
XPTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." assigned to ".$actionparameter." Group");
XINBUTTONCLOSEWINDOW("Close");
PopUpFooter();
?>
=======
<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();
$actionpersonid = $_REQUEST['ActionPersonId'];
$actionparameter = $_REQUEST['ActionParameter'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();
Get_Data("person",$actionpersonid);
$GLOBALS{'person_sectiongroup'} = CommaList_Add($GLOBALS{'person_sectiongroup'},$actionparameter);
Write_Data("person",$actionpersonid);
XH3("Assign person to My Group - ".$tsectiongroup);
XPTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." assigned to ".$actionparameter." Group");
XINBUTTONCLOSEWINDOW("Close");
PopUpFooter();
?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
