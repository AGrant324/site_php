<?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Webpage_BULLETINEDIT_CSSJS ();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

// this edits a specific bulletin already on a bulletin board

$inbulletinboard_name = $_REQUEST["bulletinboard_name"];
$inbulletin_id = $_REQUEST["bulletin_id"];
$inbulletin_date = $_REQUEST["bulletin_date_YYYYpart"]."-".$_REQUEST["bulletin_date_MMpart"]."-".$_REQUEST["bulletin_date_DDpart"];
$inbulletin_anchor = $_REQUEST["bulletin_anchor"];
$inbulletin_header = $_REQUEST["bulletin_header"];
$inbulletin_text = $_REQUEST["bulletin_text"];
$inbulletin_image = $_REQUEST['bulletin_image_imagename'];
$inimagefilepath = expandSymbolicPath($inimagefilepath);
$inbulletin_hide = $_REQUEST["bulletin_hide"];
$republish = $_REQUEST["RePublish"];

Get_Data('bulletin', $inbulletin_id);

$GLOBALS{'bulletin_date'} = $inbulletin_date;
$GLOBALS{'bulletin_anchor'} = $inbulletin_anchor;
$GLOBALS{'bulletin_periodid'} = $GLOBALS{'currperiodid'};
$GLOBALS{'bulletin_header'} = $inbulletin_header;
$GLOBALS{'bulletin_text'} = $inbulletin_text;	
$GLOBALS{'bulletin_image'} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{'bulletin_image'},$inbulletin_image);
$GLOBALS{'bulletin_hide'} = $inbulletin_hide;
$GLOBALS{'bulletin_link'} = BulletinLink ($GLOBALS{'bulletin_ref'},$GLOBALS{'bulletin_target'},$inbulletin_anchor,$GLOBALS{'bulletin_periodid'}); 
Write_Data('bulletin', $inbulletin_id);
XPTXTCOLOR("Bulletin updated","green"); 
if ($republish == "Yes") {
	XHR();
	foreach (Get_Array('webpage') as $webpage_name) {
	    Get_Data("webpage",$webpage_name);
	    if (FoundInCommaList("[BulletinBoard:Name=".$inbulletinboard_name.";",$GLOBALS{'webpage_pluginlist'})) {
	        Plugin_BulletinBoard_Publish($webpage_name,Array($inbulletinboard_name));
	    }
	}
}
XHR();
Webpage_BULLETINBOARDEDIT_Output ($inbulletinboard_name); 		


Back_Navigator();
PageFooter("Default","Final");

?>


	



