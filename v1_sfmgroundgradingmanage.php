<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMCLUBUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insfmclub_id = $_REQUEST['sfmclub_id'];
$insfmfacility_id = $_REQUEST['sfmfacility_id'];
$inaccredscheme_id = $_REQUEST['accredscheme_id'];

SFM_SFMGROUNDGRADINGMANAGE_Output($insfmclub_id,$insfmfacility_id);

Back_Navigator();
PageFooter("Default","Final");

?>



