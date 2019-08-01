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
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,globalroutines,highcharts,exporting,jqueryhighcharttable,report,reportgraphcapture,highcharttable,jqueryconfirm";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$findmode = "0";
if (isset($_POST['find_submit'])) { $findmode = "1"; } // just show database fields

$inreport_id = $_REQUEST['report_id'];
$inmenulist = $_REQUEST['menulist'];
$inreport_title = $_REQUEST['report_title'];
$inreport_description = $_REQUEST['report_description'];
$inreport_primetable = $_REQUEST['report_primetable'];
$inreport_referencedtablelist = $_REQUEST['report_referencedtablelist'];
$inreport_selectionlogic = $_REQUEST['report_selectionlogic'];
$inreport_referencedselectionlogic = $_REQUEST['report_referencedselectionlogic'];
$inreport_sortlogic = $_REQUEST['report_sortlogic'];
$inreport_fieldlist = $_REQUEST['report_fieldlist'];
$inreport_userlevel = $_REQUEST['report_userlevel'];
$inreport_personidlist = $_REQUEST['report_personidlist'];
$inreport_fontsize = $_REQUEST['report_fontsize'];
$inreport_linesperpage = $_REQUEST['report_linesperpage'];
$inreport_pagelayout = $_REQUEST['report_pagelayout'];
$inreport_pagemargins = $_REQUEST['report_pagemargins'];
$inreport_dashboardfavourite = $_REQUEST['report_dashboardfavourite'];
$inreport_favouriteicontext = $_REQUEST['report_favouriteicontext'];
$inreport_maxselection = $_REQUEST['report_maxselection'];
$inreport_maxexecutiontime = $_REQUEST['report_maxexecutiontime'];
$inreport_uploadable = $_REQUEST['report_uploadable'];
$inreport_graphtype = $_REQUEST['report_graphtype'];
$inreport_graphstacked = $_REQUEST['report_graphstacked'];
$inreport_graphcaption = $_REQUEST['report_graphcaption'];
$inreport_graphinverted = $_REQUEST['report_graphinverted'];
$inreport_graphtableparms = $_REQUEST['report_graphtableparms'];
$inreport_graphthparms = $_REQUEST['report_graphthparms'];
$inreport_graphhiderawdata = $_REQUEST['report_graphhiderawdata'];

$action = "updated";
Check_Data("report",$inreport_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("report"); $action = "added"; }

$GLOBALS{'report_id'} = $inreport_id;
$GLOBALS{'report_title'} = $inreport_title;
$GLOBALS{'report_description'} = $inreport_description;
$GLOBALS{'report_primetable'} = $inreport_primetable;
$GLOBALS{'report_referencedtablelist'} = $inreport_referencedtablelist;
$GLOBALS{'report_selectionlogic'} = $inreport_selectionlogic;
$GLOBALS{'report_referencedselectionlogic'} = $inreport_referencedselectionlogic;
$GLOBALS{'report_sortlogic'} = $inreport_sortlogic;
$GLOBALS{'report_fieldlist'} = $inreport_fieldlist;
$GLOBALS{'report_userlevel'} = $inreport_userlevel;
$GLOBALS{'report_personidlist'} = $inreport_personidlist;
$GLOBALS{'report_fontsize'} = $inreport_fontsize;
$GLOBALS{'report_linesperpage'} = $inreport_linesperpage;
$GLOBALS{'report_pagelayout'} = $inreport_pagelayout;
$GLOBALS{'report_pagemargins'} = $inreport_pagemargins;
$GLOBALS{'report_dashboardfavourite'} = $inreport_dashboardfavourite;
$GLOBALS{'report_favouriteicontext'} = $inreport_favouriteicontext;
$GLOBALS{'report_maxselection'} = $inreport_maxselection;
$GLOBALS{'report_maxexecutiontime'} = $inreport_maxexecutiontime;
$GLOBALS{'report_uploadable'} = $inreport_uploadable;
$GLOBALS{'report_graphtype'} = $inreport_graphtype;
$GLOBALS['report_graphstacked'] = $inreport_graphstacked;
$GLOBALS['report_graphcaption'] = $inreport_graphcaption;
$GLOBALS['report_graphinverted'] = $inreport_graphinverted;
$GLOBALS['report_graphtableparms'] = $inreport_graphtableparms;
$GLOBALS['report_graphthparms'] = $inreport_graphthparms;
$GLOBALS['report_graphhiderawdata'] = $inreport_graphhiderawdata;

Write_Data("report",$inreport_id);

if ($findmode == "1") { // just show database fields
	XH2("Report Composer - ".$inreport_id." - ".$inreport_title);
	Report_SETUPREPORTCOMPOSER_Output($inreport_id,$action);	
} else {
	XPTXTCOLOR("Report - ".$inreport_id." ".$inreport_title." ".$action,"green");
	XH2("Report Composer - ".$inreport_id." - ".$inreport_title);
    if ( (strlen(strstr($GLOBALS{'report_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'report_referencedselectionlogic'},'?'))>0) ) {	    
		$link = YPGMLINK("reportwebviewsetfilter.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$inreport_id);
		XLINKTXTNEWWINDOW($link,"view this report in browser","web_view");
	} else {
	    Report_REPORTWEBVIEW_Output( "report", $inreport_id, "", "");	
		XHR();				
	}
	
	XBR();
	$link = YPGMLINK("reportcomposerout.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("report_id",$inreport_id).YPGMPARM("action","update");
	XLINKTXT($link,"make further composer changes to this report");
	
	XBR();	
	if ( $inmenulist == 'reportupdatelist' ) {
		$link = YPGMLINK("personloginselectin.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","SETUPREPORTLIST");
		XLINKTXT($link,"show my reports list");
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
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,globalroutines,highcharts,exporting,jqueryhighcharttable,report,reportgraphcapture,highcharttable,jqueryconfirm";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$findmode = "0";
if (isset($_POST['find_submit'])) { $findmode = "1"; } // just show database fields

$inreport_id = $_REQUEST['report_id'];
$inmenulist = $_REQUEST['menulist'];
$inreport_title = $_REQUEST['report_title'];
$inreport_description = $_REQUEST['report_description'];
$inreport_primetable = $_REQUEST['report_primetable'];
$inreport_referencedtablelist = $_REQUEST['report_referencedtablelist'];
$inreport_selectionlogic = $_REQUEST['report_selectionlogic'];
$inreport_referencedselectionlogic = $_REQUEST['report_referencedselectionlogic'];
$inreport_sortlogic = $_REQUEST['report_sortlogic'];
$inreport_fieldlist = $_REQUEST['report_fieldlist'];
$inreport_userlevel = $_REQUEST['report_userlevel'];
$inreport_personidlist = $_REQUEST['report_personidlist'];
$inreport_fontsize = $_REQUEST['report_fontsize'];
$inreport_linesperpage = $_REQUEST['report_linesperpage'];
$inreport_pagelayout = $_REQUEST['report_pagelayout'];
$inreport_pagemargins = $_REQUEST['report_pagemargins'];
$inreport_dashboardfavourite = $_REQUEST['report_dashboardfavourite'];
$inreport_favouriteicontext = $_REQUEST['report_favouriteicontext'];
$inreport_maxselection = $_REQUEST['report_maxselection'];
$inreport_maxexecutiontime = $_REQUEST['report_maxexecutiontime'];
$inreport_uploadable = $_REQUEST['report_uploadable'];
$inreport_graphtype = $_REQUEST['report_graphtype'];
$inreport_graphstacked = $_REQUEST['report_graphstacked'];
$inreport_graphcaption = $_REQUEST['report_graphcaption'];
$inreport_graphinverted = $_REQUEST['report_graphinverted'];
$inreport_graphtableparms = $_REQUEST['report_graphtableparms'];
$inreport_graphthparms = $_REQUEST['report_graphthparms'];
$inreport_graphhiderawdata = $_REQUEST['report_graphhiderawdata'];

$action = "updated";
Check_Data("report",$inreport_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("report"); $action = "added"; }

$GLOBALS{'report_id'} = $inreport_id;
$GLOBALS{'report_title'} = $inreport_title;
$GLOBALS{'report_description'} = $inreport_description;
$GLOBALS{'report_primetable'} = $inreport_primetable;
$GLOBALS{'report_referencedtablelist'} = $inreport_referencedtablelist;
$GLOBALS{'report_selectionlogic'} = $inreport_selectionlogic;
$GLOBALS{'report_referencedselectionlogic'} = $inreport_referencedselectionlogic;
$GLOBALS{'report_sortlogic'} = $inreport_sortlogic;
$GLOBALS{'report_fieldlist'} = $inreport_fieldlist;
$GLOBALS{'report_userlevel'} = $inreport_userlevel;
$GLOBALS{'report_personidlist'} = $inreport_personidlist;
$GLOBALS{'report_fontsize'} = $inreport_fontsize;
$GLOBALS{'report_linesperpage'} = $inreport_linesperpage;
$GLOBALS{'report_pagelayout'} = $inreport_pagelayout;
$GLOBALS{'report_pagemargins'} = $inreport_pagemargins;
$GLOBALS{'report_dashboardfavourite'} = $inreport_dashboardfavourite;
$GLOBALS{'report_favouriteicontext'} = $inreport_favouriteicontext;
$GLOBALS{'report_maxselection'} = $inreport_maxselection;
$GLOBALS{'report_maxexecutiontime'} = $inreport_maxexecutiontime;
$GLOBALS{'report_uploadable'} = $inreport_uploadable;
$GLOBALS{'report_graphtype'} = $inreport_graphtype;
$GLOBALS['report_graphstacked'] = $inreport_graphstacked;
$GLOBALS['report_graphcaption'] = $inreport_graphcaption;
$GLOBALS['report_graphinverted'] = $inreport_graphinverted;
$GLOBALS['report_graphtableparms'] = $inreport_graphtableparms;
$GLOBALS['report_graphthparms'] = $inreport_graphthparms;
$GLOBALS['report_graphhiderawdata'] = $inreport_graphhiderawdata;

Write_Data("report",$inreport_id);

if ($findmode == "1") { // just show database fields
	XH2("Report Composer - ".$inreport_id." - ".$inreport_title);
	Report_SETUPREPORTCOMPOSER_Output($inreport_id,$action);	
} else {
	XPTXTCOLOR("Report - ".$inreport_id." ".$inreport_title." ".$action,"green");
	XH2("Report Composer - ".$inreport_id." - ".$inreport_title);
    if ( (strlen(strstr($GLOBALS{'report_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'report_referencedselectionlogic'},'?'))>0) ) {	    
		$link = YPGMLINK("reportwebviewsetfilter.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$inreport_id);
		XLINKTXTNEWWINDOW($link,"view this report in browser","web_view");
	} else {
	    Report_REPORTWEBVIEW_Output( "report", $inreport_id, "", "");	
		XHR();				
	}
	
	XBR();
	$link = YPGMLINK("reportcomposerout.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("report_id",$inreport_id).YPGMPARM("action","update");
	XLINKTXT($link,"make further composer changes to this report");
	
	XBR();	
	if ( $inmenulist == 'reportupdatelist' ) {
		$link = YPGMLINK("personloginselectin.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","SETUPREPORTLIST");
		XLINKTXT($link,"show my reports list");
	}
}


Back_Navigator();
PageFooter("Default","Final");




>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
