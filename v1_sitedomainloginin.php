<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
$inaccount_id = $_REQUEST['account_id'];

$GLOBALS{'LOGIN_domain_id'} = $inaccount_id;
$GLOBALS{'LOGIN_loginmode_id'} = "0";
$GLOBALS{'LOGIN_mode_id'} = "2";
GlobalRoutine();
Person_Login_Select_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

Get_Data("person_".$GLOBALS{'LOGIN_service_id'},$GLOBALS{'LOGIN_person_id'});
if ($GLOBALS{'LOGIN_session_id'} != $GLOBALS{'person_session'}) {
 print "Unauthorised access.\n";
} else {
 XBR();XTXTCOLOR('Logged into "'.$GLOBALS{'LOGIN_domain_id'}.'" as site manager',"red");XBR();
 $GLOBALS{'person_authority'} = "DM#Domain";
 $GLOBALS{'person_authoritymessage'} = "Site Manager Authority"; 
 Person_Login_Select_Output();
}

Back_Navigator();
PageFooter("Default","Final");

?>

