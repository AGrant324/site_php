<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inwebpage_name = $_REQUEST['webpage_name'];

Delete_Data("webpage",$inwebpage_name);
XPTXT('Webpage - "'.$inwebpage_name.'" deleted');

$menua = Get_Array('menu');
foreach ($menua as $menu_id) {
	Get_Data('menu', $menu_id);
	$menuitema = Get_Array('menuitem',$menu_id);
	foreach ($menuitema as $menuitem_id) {
		Get_Data('menuitem',$menu_id,$menuitem_id);
		if (($GLOBALS{'menuitem_targettype'} == "Webpage")&&( $GLOBALS{'menuitem_webpagename'} == $inwebpage_name )) {
			Delete_Data('menuitem', $menu_id, $menuitem_id);
			XPTXT('Webpage - "'.$inwebpage_name.'" removed from "'.$GLOBALS{'menu_title'}.'" menu.');		
		}
	}
}
Get_Person_Authority();
Webpage_WEBPAGECOMPOSERLIST_Output();



Back_Navigator();
PageFooter("Default","Final");


