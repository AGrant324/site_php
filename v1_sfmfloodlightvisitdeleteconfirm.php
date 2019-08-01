<<<<<<< HEAD
<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmfloodlightvisit_sfmfacilityid = $_REQUEST['sfmfloodlightvisit_sfmfacilityid'];
$insfmfloodlightvisit_id = $_REQUEST['sfmfloodlightvisit_id'];

SFM_SFMFLOODLIGHTVISITDELETECONFIRM_Output($insfmclub_id,$insfmfloodlightvisit_sfmfacilityid,$insfmfloodlightvisit_id);

Back_Navigator();PageFooter("Default","Final");
?>

=======
<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmfloodlightvisit_sfmgroundid = $_REQUEST['sfmfloodlightvisit_sfmgroundid'];
$insfmfloodlightvisit_id = $_REQUEST['sfmfloodlightvisit_id'];

SFM_SFMFLOODLIGHTVISITDELETECONFIRM_Output($insfmclub_id,$insfmfloodlightvisit_sfmgroundid,$insfmfloodlightvisit_id);

Back_Navigator();PageFooter("Default","Final");
?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
