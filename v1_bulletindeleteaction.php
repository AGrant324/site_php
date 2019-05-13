<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$inbulletin_id = $_REQUEST['bulletin_id'];
$fixedbulletinboard = $_REQUEST['FixedBulletinBoard'];
$returnto = $_REQUEST['ReturnTo'];
if ( $returnto == "BULLETINCREATEC" ) {
	Webpage_BULLETINCREATEC_CSSJS();
}
if ( $returnto == "BulletinBoardEdit" ) {
	Webpage_BULLETINBOARDEDIT_CSSJS();
}

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("bulletin",$inbulletin_id);

Delete_Data("bulletin",$inbulletin_id);
XPTXT('Bulletin - "'.$inbulletin_id.'" deleted');

if ( $returnto == "BULLETINCREATEC" ) {
	Webpage_BULLETINCREATEC_Output ($GLOBALS{'bulletin_ref'}, $GLOBALS{'bulletin_target'}, $GLOBALS{'bulletin_anchor'}, $GLOBALS{'bulletin_periodid'}, $fixedbulletinboard);
}
if ( $returnto == "BulletinBoardEdit" ) {
	Webpage_BULLETINBOARDEDIT_Output ($GLOBALS{'bulletin_bulletinboardname'});
}


Back_Navigator();
PageFooter("Default","Final");


