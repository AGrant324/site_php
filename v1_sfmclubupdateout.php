<<<<<<< HEAD
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


$incurrenttab = $_REQUEST['CurrentTab'];
if ( $incurrenttab == "" ) { $incurrenttab = "FACILITY"; }

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

if ( $GLOBALS{'LOGIN_orgtype_id'} == "Club" ) { 
    if ( $incurrenttab = "CLUB" ) {
        SFM_SFMCLUBUPDATECLUB_Output($insfmclub_id);
    }
    if ( $incurrenttab = "GROUNDSTATUS" ) {
        SFM_SFMCLUBUPDATEGROUND_Output($insfmclub_id,$insfmfacility_id);
    }
    if ( $incurrenttab = "FLOODSTATUS" ) {
        SFM_SFMCLUBUPDATEFLOOD_Output($insfmclub_id,$insfmfacility_id);  
    }    
} else {
    SFM_SFMCLUBUPDATEMULTI_Output($insfmclub_id,$insfmfacility_id,$incurrenttab);
}
    
Back_Navigator();
PageFooter("Default","Final");
?>

=======
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

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
