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
$insfmfloodlightvisit_sfmgroundid = $_REQUEST['sfmfloodlightvisit_sfmgroundid'];
$insfmfloodlightvisit_id = $_REQUEST['sfmfloodlightvisit_id'];

Delete_Data('sfmfloodlightvisit', $insfmfloodlightvisit_sfmgroundid, $insfmfloodlightvisit_id);
XPTXTCOLOR($insfmfloodlightvisit_sfmgroundid." ".$insfmfloodlightvisit_id." Deleted","green");

SFM_SFMCLUBUPDATE_Output($insfmclub_id,"FLOODSTATUS");

Back_Navigator();
PageFooter("Default","Final");

?>



