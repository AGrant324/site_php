<<<<<<< HEAD
<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_Login_Select_CSSJS();
$GLOBALS{'dashboardsectionsprovided'} = "1";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

if((isset($_REQUEST['SpecialAction'])&&$_REQUEST['SpecialAction']!="")) {
  $specialaction = $_REQUEST["SpecialAction"];
  if ($specialaction == "DeleteDomainTempFiles") { Utility_DeleteDomainTempFiles (); }	
}
if ( $GLOBALS{'LOGIN_loginmode_id'} == "0" ) {
  XBR();XTXTCOLOR('Logged into "'.$GLOBALS{'LOGIN_domain_id'}.'" as site manager',"red");XBR();	
  $GLOBALS{'person_authority'} = "DM#Domain";
  $GLOBALS{'person_authoritymessage'} = "Site Manager Authority"; 	
} else { 
  Get_Person_Authority(); 
}
Person_Login_Select_Output();	

Back_Navigator();
PageFooter("Default","Final");

?>
=======
<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_Login_Select_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

if((isset($_REQUEST['SpecialAction'])&&$_REQUEST['SpecialAction']!="")) {
  $specialaction = $_REQUEST["SpecialAction"];
  if ($specialaction == "DeleteDomainTempFiles") { Utility_DeleteDomainTempFiles (); }	
}
if ( $GLOBALS{'LOGIN_loginmode_id'} == "0" ) {
  XBR();XTXTCOLOR('Logged into "'.$GLOBALS{'LOGIN_domain_id'}.'" as site manager',"red");XBR();	
  $GLOBALS{'person_authority'} = "DM#Domain";
  $GLOBALS{'person_authoritymessage'} = "Site Manager Authority"; 	
} else { 
  Get_Person_Authority(); 
}	
Person_Login_Select_Output();	

Back_Navigator();
PageFooter("Default","Final");

?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
