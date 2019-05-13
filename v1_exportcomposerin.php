<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_slim.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$findmode = "0";
if (isset($_POST['find_submit'])) { $findmode = "1"; } // just show database fields

$inexport_id = $_REQUEST['export_id'];
$inmenulist = $_REQUEST['menulist'];
$inexport_title = $_REQUEST['export_title'];
$inexport_description = $_REQUEST['export_description'];
$inexport_primetable = $_REQUEST['export_primetable'];
$inexport_referencedtablelist = $_REQUEST['export_referencedtablelist'];
$inexport_selectionlogic = $_REQUEST['export_selectionlogic'];
$inexport_referencedselectionlogic = $_REQUEST['export_referencedselectionlogic'];
$inexport_sortlogic = $_REQUEST['export_sortlogic'];
$inexport_fieldlist = $_REQUEST['export_fieldlist'];
$inexport_userlevel = $_REQUEST['export_userlevel'];
$inexport_personidlist = $_REQUEST['export_personidlist'];
$inexport_uploadable = $_REQUEST['export_uploadable'];

$action = "updated";
Check_Data("export",$inexport_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("export"); $action = "added"; }

$GLOBALS{'export_id'} = $inexport_id;
$GLOBALS{'export_title'} = $inexport_title;
$GLOBALS{'export_description'} = $inexport_description;
$GLOBALS{'export_primetable'} = $inexport_primetable;
$GLOBALS{'export_referencedtablelist'} = $inexport_referencedtablelist;
$GLOBALS{'export_selectionlogic'} = $inexport_selectionlogic;
$GLOBALS{'export_referencedselectionlogic'} = $inexport_referencedselectionlogic;
$GLOBALS{'export_sortlogic'} = $inexport_sortlogic;
$GLOBALS{'export_fieldlist'} = $inexport_fieldlist;
$GLOBALS{'export_userlevel'} = $inexport_userlevel;
$GLOBALS{'export_personidlist'} = $inexport_personidlist;
$GLOBALS{'export_uploadable'} = $inexport_uploadable;

Write_Data("export",$inexport_id);

if ($findmode == "1") {
	XH2("Export Composer - ".$inexport_id." - ".$inexport_title);
	Report_SETUPEXPORTCOMPOSER_Output($inexport_id,$action);
} else {
	XPTXTCOLOR("Export - ".$inexport_id." ".$inexport_title." ".$action,"green");
	XH2("Export Composer - ".$inexport_id." - ".$inexport_title);
    if ( (strlen(strstr($GLOBALS{'export_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'export_referencedselectionlogic'},'?'))>0) ) {
		$link = YPGMLINK("reportwebviewsetfilter.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$inexport_id);
		XLINKTXTNEWWINDOW($link,"view this export in browser","web_view");
	} else {
	    Report_REPORTWEBVIEW_Output( "export", $inexport_id, "", "");
	}
	XBR();
	$link = YPGMLINK("exportcomposerout.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("export_id",$inexport_id).YPGMPARM("action","update");
	XLINKTXT($link,"make further composer changes to this export");
	XBR();
	if ( $inmenulist == 'exportupdatelist' ) {
		$link = YPGMLINK("personloginselectin.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","SETUPEXPORTLIST");
		XLINKTXT($link,"show my exports list");
	}
}

Back_Navigator();
PageFooter("Default","Final");




