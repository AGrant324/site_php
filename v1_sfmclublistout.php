<?php # personLUin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
SFM_SFMLISTS_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inlisttype = $_REQUEST['ListType'];

if ( $inlisttype === "BYLEAGUE" ) {
    $insfmleague_id = $_REQUEST['sfmleague_id'];
    SFM_SFMBYLEAGUELIST_Output();
}

if ( $inlisttype == "LEAGUE2CLUB" ) {
    $insfmleague_id = $_REQUEST['sfmleague_id'];
    SFM_SFMLEAGUE2TEAMLIST_Output($insfmleague_id);
}

if ( $inlisttype === "BYCOUNTY" ) {
    $insfmcounty_id = $_REQUEST['sfmcounty_id'];
    SFM_SFMBYCOUNTYLIST_Output();
}

if ( $inlisttype == "COUNTY2CLUB" ) {
    $insfmclub_id = $_REQUEST['sfmcounty_id'];
    SFM_SFMCOUNTY2CLUBLIST_Output($insfmcounty_id);
}

if ( $inlisttype == "SEARCH" ) {
    SFM_SFMSEARCHLIST_Output();
}

Back_Navigator();
PageFooter("Default","Final");

?>
