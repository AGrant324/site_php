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

Get_Data("person_".$GLOBALS{'LOGIN_service_id'},$GLOBALS{'LOGIN_person_id'});
if ($GLOBALS{'LOGIN_session_id'} != $GLOBALS{'person_session'}) {
    PageHeader("Default","Final");
    Back_Navigator();  
    XPTXTCOLOR("Unauthorised access"."red");
    Back_Navigator();
    PageFooter("Default","Final");
} else {
    Person_Login_Select_CSSJS();
    $GLOBALS{'dashboardsectionsprovided'} = "1";
    PageHeader("Default","Final");
    Back_Navigator();     
    XBR();XTXTCOLOR('Logged into "'.$GLOBALS{'LOGIN_domain_id'}.'" as site manager',"red");XBR();
    $GLOBALS{'person_authority'} = "DM#Domain";
    $GLOBALS{'person_authoritymessage'} = "Site Manager Authority"; 
    Person_Login_Select_Output();
    Back_Navigator();
    PageFooter("Default","Final");
}

?>

