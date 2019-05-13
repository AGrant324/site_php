<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMCLUBUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$incurrenttab = $_REQUEST['CurrentTab'];
if ( $incurrenttab == "" ) { $incurrenttab = "CLUB"; }

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

SFM_SFMCLUBUPDATE_Output($insfmclub_id,$incurrenttab);

Back_Navigator();PageFooter("Default","Final");
?>

