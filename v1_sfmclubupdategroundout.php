<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMCLUBUPDATE_CSSJS();
$GLOBALS{'dashboardsectionsprovided'} = "1";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $GLOBALS{'LOGIN_org_id'};
if((isset($_REQUEST['sfmclub_id'])&&$_REQUEST['sfmclub_id']!="")) {
    $insfmclub_id = $_REQUEST['sfmclub_id'];
}
$insfmfacility_id = $_REQUEST['sfmfacility_id'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

SFM_SFMCLUBUPDATEGROUND_Output($insfmclub_id,$insfmfacility_id);

Back_Navigator();PageFooter("Default","Final");
?>

