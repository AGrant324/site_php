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
$insfmgroundvisit_sfmgroundid = $_REQUEST['sfmgroundvisit_sfmgroundid'];
$insfmgroundvisit_id = $_REQUEST['sfmgroundvisit_id'];

Delete_Data('sfmgroundvisit', $insfmgroundvisit_sfmgroundid, $insfmgroundvisit_id);
XPTXTCOLOR($insfmgroundvisit_sfmgroundid." ".$insfmgroundvisit_id." Deleted","green");

SFM_SFMCLUBUPDATE_Output($insfmclub_id,"GROUNDSTATUS");

Back_Navigator();
PageFooter("Default","Final");

?>



