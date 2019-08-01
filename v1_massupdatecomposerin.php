<<<<<<< HEAD
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_slim.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report,bootstrapdatepicker,datepicker";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$findmode = "0";
if (isset($_POST['find_submit'])) { $findmode = "1"; }

$inmassupdate_id = $_REQUEST['massupdate_id'];
$inmenulist = $_REQUEST['menulist'];
$inmassupdate_title = $_REQUEST['massupdate_title'];
$inmassupdate_description = $_REQUEST['massupdate_description'];
$inmassupdate_primetable = $_REQUEST['massupdate_primetable'];
$inmassupdate_referencedtablelist = $_REQUEST['massupdate_referencedtablelist'];
$inmassupdate_selectionlogic = $_REQUEST['massupdate_selectionlogic'];
$inmassupdate_sortlogic = $_REQUEST['massupdate_sortlogic'];
$inmassupdate_fieldlist = $_REQUEST['massupdate_fieldlist'];
$inmassupdate_userlevel = $_REQUEST['massupdate_userlevel'];
$inmassupdate_personidlist = $_REQUEST['massupdate_personidlist'];
$inmassupdate_fontsize = $_REQUEST['massupdate_fontsize'];
$inmassupdate_linesperpage = $_REQUEST['massupdate_linesperpage'];
$inmassupdate_pagelayout = $_REQUEST['massupdate_pagelayout'];

$action = "updated";
Check_Data("massupdate",$inmassupdate_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("massupdate"); $action = "added"; }

$GLOBALS{'massupdate_id'} = $inmassupdate_id;
$GLOBALS{'massupdate_title'} = $inmassupdate_title;
$GLOBALS{'massupdate_description'} = $inmassupdate_description;
$GLOBALS{'massupdate_primetable'} = $inmassupdate_primetable;
$GLOBALS{'massupdate_referencedtablelist'} = $inmassupdate_referencedtablelist;
$GLOBALS{'massupdate_selectionlogic'} = $inmassupdate_selectionlogic;
$GLOBALS{'massupdate_sortlogic'} = $inmassupdate_sortlogic;
$GLOBALS{'massupdate_fieldlist'} = $inmassupdate_fieldlist;
$GLOBALS{'massupdate_userlevel'} = $inmassupdate_userlevel;
$GLOBALS{'massupdate_personidlist'} = $inmassupdate_personidlist;
$GLOBALS{'massupdate_fontsize'} = $inmassupdate_fontsize;
$GLOBALS{'massupdate_linesperpage'} = $inmassupdate_linesperpage;
$GLOBALS{'massupdate_pagelayout'} = $inmassupdate_pagelayout;

Write_Data("massupdate",$inmassupdate_id);

if ($findmode == "1") { 
	XH2("Mass Update Composer - ".$inmassupdate_id." - ".$inmassupdate_title);
	Report_SETUPMASSUPDATECOMPOSER_Output($inmassupdate_id,$action);	
} else {
	XPTXTCOLOR("Mass Update - ".$inmassupdate_id." ".$inmassupdate_title." ".$action,"green");	
	XH2("Mass Update Composer - ".$inmassupdate_id." - ".$inmassupdate_title);
	if (strlen(strstr($GLOBALS{'massupdate_selectionlogic'},'?'))>0) {
		$link = YPGMLINK("massupdateformsetfilter.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$inmassupdate_id);
		XLINKTXTNEWWINDOW($link,"launch this mass update form","web_view");
	} else {
		Report_MASSUPDATEFORM_Output( $inmassupdate_id, "" );	
		XBR();
		XHR();
	}
	XBR();	
	$link = YPGMLINK("massupdatecomposerout.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$inmassupdate_id).YPGMPARM("action","update");
	XLINKTXT($link,"make further composer changes to ths massupdate form template");
	XBR();
	if ( $inmenulist == 'massupdateupdatelist' ) {
		$link = YPGMLINK("personloginselectin.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMASSUPDATELIST");
		XLINKTXT($link,"show my massupdate forms list");
	}
}


Back_Navigator();
PageFooter("Default","Final");




=======
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_slim.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report,bootstrapdatepicker,datepicker";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$findmode = "0";
if (isset($_POST['find_submit'])) { $findmode = "1"; }

$inmassupdate_id = $_REQUEST['massupdate_id'];
$inmenulist = $_REQUEST['menulist'];
$inmassupdate_title = $_REQUEST['massupdate_title'];
$inmassupdate_description = $_REQUEST['massupdate_description'];
$inmassupdate_primetable = $_REQUEST['massupdate_primetable'];
$inmassupdate_referencedtablelist = $_REQUEST['massupdate_referencedtablelist'];
$inmassupdate_selectionlogic = $_REQUEST['massupdate_selectionlogic'];
$inmassupdate_sortlogic = $_REQUEST['massupdate_sortlogic'];
$inmassupdate_fieldlist = $_REQUEST['massupdate_fieldlist'];
$inmassupdate_userlevel = $_REQUEST['massupdate_userlevel'];
$inmassupdate_personidlist = $_REQUEST['massupdate_personidlist'];
$inmassupdate_fontsize = $_REQUEST['massupdate_fontsize'];
$inmassupdate_linesperpage = $_REQUEST['massupdate_linesperpage'];
$inmassupdate_pagelayout = $_REQUEST['massupdate_pagelayout'];

$action = "updated";
Check_Data("massupdate",$inmassupdate_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("massupdate"); $action = "added"; }

$GLOBALS{'massupdate_id'} = $inmassupdate_id;
$GLOBALS{'massupdate_title'} = $inmassupdate_title;
$GLOBALS{'massupdate_description'} = $inmassupdate_description;
$GLOBALS{'massupdate_primetable'} = $inmassupdate_primetable;
$GLOBALS{'massupdate_referencedtablelist'} = $inmassupdate_referencedtablelist;
$GLOBALS{'massupdate_selectionlogic'} = $inmassupdate_selectionlogic;
$GLOBALS{'massupdate_sortlogic'} = $inmassupdate_sortlogic;
$GLOBALS{'massupdate_fieldlist'} = $inmassupdate_fieldlist;
$GLOBALS{'massupdate_userlevel'} = $inmassupdate_userlevel;
$GLOBALS{'massupdate_personidlist'} = $inmassupdate_personidlist;
$GLOBALS{'massupdate_fontsize'} = $inmassupdate_fontsize;
$GLOBALS{'massupdate_linesperpage'} = $inmassupdate_linesperpage;
$GLOBALS{'massupdate_pagelayout'} = $inmassupdate_pagelayout;

Write_Data("massupdate",$inmassupdate_id);

if ($findmode == "1") { 
	XH2("Mass Update Composer - ".$inmassupdate_id." - ".$inmassupdate_title);
	Report_SETUPMASSUPDATECOMPOSER_Output($inmassupdate_id,$action);	
} else {
	XPTXTCOLOR("Mass Update - ".$inmassupdate_id." ".$inmassupdate_title." ".$action,"green");	
	XH2("Mass Update Composer - ".$inmassupdate_id." - ".$inmassupdate_title);
	if (strlen(strstr($GLOBALS{'massupdate_selectionlogic'},'?'))>0) {
		$link = YPGMLINK("massupdateformsetfilter.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$inmassupdate_id);
		XLINKTXTNEWWINDOW($link,"launch this mass update form","web_view");
	} else {
		Report_MASSUPDATEFORM_Output( $inmassupdate_id, "" );	
		XBR();
		XHR();
	}
	XBR();	
	$link = YPGMLINK("massupdatecomposerout.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$inmassupdate_id).YPGMPARM("action","update");
	XLINKTXT($link,"make further composer changes to ths massupdate form template");
	XBR();
	if ( $inmenulist == 'massupdateupdatelist' ) {
		$link = YPGMLINK("personloginselectin.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMASSUPDATELIST");
		XLINKTXT($link,"show my massupdate forms list");
	}
}


Back_Navigator();
PageFooter("Default","Final");




>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
