<?php #bulletinboardpublish.php

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

XH2("Menu Assignment");

$menua = Get_Array('menu');
foreach ($menua as $menu_id) {
	Get_Data('menu',$menu_id);
	if(isset($_REQUEST["menu_id_".$menu_id])) {
		if ($_REQUEST["menu_id_".$menu_id] == "Yes") {
			$menuitem_ida = Get_Array("menuitem",$menu_id);
			$highestmenuitem_id = "MI00000";
			foreach ($menuitem_ida as $menuitem_id) {
				$highestmenuitem_id = $menuitem_id;
			}
			$highestmenuitem_seq = str_replace("MI", "", $highestmenuitem_id);
			$highestmenuitem_seq++;
			$newmenuitem_id = "MI".substr(("00000".$highestmenuitem_seq), -5);
			Initialise_Data("menuitem");
			$GLOBALS{'menuitem_parentmenuitemname'} = "";
			$GLOBALS{'menuitem_seq'} = "99";
			$GLOBALS{'menuitem_text'} = $inwebpage_name;
			$GLOBALS{'menuitem_targettype'} = "Webpage";
			$GLOBALS{'menuitem_webpagename'} = $inwebpage_name;		
			$GLOBALS{'menuitem_url'} = "";
			$GLOBALS{'menuitem_hide'} = "Display";				
			Write_Data("menuitem",$menu_id,$newmenuitem_id);
			XPTXT($inwebpage_name.' added to '.$GLOBALS{'menu_title'}.' menu as '.$newmenuitem_id);
			Webpage_MENUPUBLISH_Output($menu_id);
		}
	}
}


Back_Navigator();
PageFooter("Default","Final");

?>

