<?php # personloginout.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
Get_Common_Parameters();
GlobalRoutine();$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,pwfcookie";
PageHeader("Default","Final");
// This routine does not require login
Back_Navigator();
XH3("Access to Website - Parents of Junior Members");
# # $helplink = "Person/Person_PWE_Output/person_pwe_output.html"; Help_Link;
XPTXT("We have now moved our Junior details on a secure part of the Club Website. This will enable you to keep contact details up to date in case of emergencies etc.");
XPTXT("It also allows you to renew membership for the current season.");
XPTXT("Please complete the following details and we will send you your login details to your registerd email address.");
XPTXT("Once you have received these details, you will be able to login via the main Login page.");
XBR();
XFORM("personPWFJin.php","access");
XINSTDHID();
XINHID("VE","");
XTABLE();
XTR();XTDTXT("Childs First Name");XTDINTXT("PersonFName","","20","30");X_TR();
XTR();XTDTXT("Childs Surname");XTDINTXT("PersonSName","","20","30");X_TR();
XTR();XTDTXT("Childs Date of Birth");XTDINDATEYYYY_MM_DD("PersonDOB","");X_TR();
XTR();XTDTXT("Parent's Email");XTDINTXT("PersonEmail3","","40","50");X_TR();
XTR();XTDTXT("");XTDINSUBMIT("Please email me my Access Details");X_TR();
X_TABLE();
X_FORM();
Back_Navigator();
PageFooter("Default","Final");
?>